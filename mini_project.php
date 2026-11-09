<?php
/**
 * Praktikum 7: Pemrograman Server-Side dengan PHP
 * File: mini_project.php
 * Deskripsi: Form Penginputan Data Mahasiswa dengan Validasi Server-Side & Database MySQL
 * Standar UI/UX: Pro Max & Anti-Slop (Aksesibilitas, Kontras WCAG AA, Hierarchy Bersih)
 */

// 1. KONFIGURASI DATABASE (Default Laragon: user=root, pass=kosong)
$host       = '127.0.0.1';
$dbname     = 'praktikum7_db';
$user       = 'root';
$pass       = '';
$charset    = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// 2. INISIALISASI VARIABEL
$nama       = '';
$nim        = '';
$prodi      = '';
$semester   = '';
$email      = '';

$errors       = [];
$field_errors = [];
$is_success   = false;
$submit_time  = '';

// 3. HANDLE POST REQUEST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $nim      = isset($_POST['nim']) ? trim($_POST['nim']) : '';
    $prodi    = isset($_POST['prodi']) ? trim($_POST['prodi']) : '';
    $semester = isset($_POST['semester']) ? trim($_POST['semester']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';

    // --- VALIDASI SERVER-SIDE ---
    if ($nama === '') {
        $msg = 'Nama Lengkap wajib diisi.';
        $errors[] = $msg; $field_errors['nama'] = $msg;
    }

    if ($nim === '') {
        $msg = 'NIM wajib diisi.';
        $errors[] = $msg; $field_errors['nim'] = $msg;
    } elseif (!ctype_digit($nim) || strlen($nim) !== 9) {
        $msg = 'NIM harus berupa angka murni dan memiliki panjang tepat 9 digit.';
        $errors[] = $msg; $field_errors['nim'] = $msg;
    }

    if ($prodi === '') {
        $msg = 'Program Studi wajib dipilih.';
        $errors[] = $msg; $field_errors['prodi'] = $msg;
    }

    if ($semester === '') {
        $msg = 'Semester wajib diisi.';
        $errors[] = $msg; $field_errors['semester'] = $msg;
    } elseif (!filter_var($semester, FILTER_VALIDATE_INT) || (int)$semester < 1 || (int)$semester > 14) {
        $msg = 'Semester harus berupa angka dalam rentang 1 sampai 14.';
        $errors[] = $msg; $field_errors['semester'] = $msg;
    }

    if ($email === '') {
        $msg = 'Email wajib diisi.';
        $errors[] = $msg; $field_errors['email'] = $msg;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Format Email tidak valid (contoh: user@example.com).';
        $errors[] = $msg; $field_errors['email'] = $msg;
    }

    // --- SIMPAN KE DATABASE JIKA VALIDASI LOLOS ---
    if (empty($errors)) {
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);

            $sql = "INSERT INTO mahasiswa (nama_lengkap, nim, program_studi, semester, email) 
                    VALUES (:nama, :nim, :prodi, :semester, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nama'     => $nama,
                ':nim'      => $nim,
                ':prodi'    => $prodi,
                ':semester' => (int)$semester,
                ':email'    => $email,
            ]);

            $is_success  = true;
            $submit_time = date('d-m-Y H:i:s') . ' WIB';

        } catch (PDOException $e) {
            // Tangani error Duplicate Entry (Kode SQLSTATE 23000)
            if ($e->getCode() == '23000') {
                if (strpos($e->getMessage(), 'nim') !== false) {
                    $msg = 'NIM sudah terdaftar di database.';
                    $errors[] = $msg; $field_errors['nim'] = $msg;
                } elseif (strpos($e->getMessage(), 'email') !== false) {
                    $msg = 'Email sudah terdaftar di database.';
                    $errors[] = $msg; $field_errors['email'] = $msg;
                } else {
                    $errors[] = 'Data duplikat: ' . $e->getMessage();
                }
            } else {
                // Error database lain (koneksi, syntax, dll)
                $errors[] = 'Gagal menyimpan ke database: ' . $e->getMessage();
            }
        }
    }
}

function escape(string $data): string {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum 7 - Mini Project Data Mahasiswa</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg-page: #f1f5f9;
            --surface: #ffffff;
            --border-default: #cbd5e1;
            --border-subtle: #e2e8f0;
            --border-focus: #1d4ed8;
            --text-heading: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
            --primary: #1d4ed8;
            --primary-hover: #1e40af;
            --primary-active: #172554;
            --danger-bg: #ffe4e6;
            --danger-border: #fecdd3;
            --danger-text: #9f1239;
            --success-bg: #f0fdf4;
            --success-border: #bbf7d0;
            --success-text: #166534;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--bg-page);
            color: var(--text-body);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            line-height: 1.5;
        }
        .container {
            width: 100%;
            max-width: 620px;
            background: var(--surface);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0, 0, 0, 0.04);
            padding: 32px 28px;
            border: 1px solid var(--border-subtle);
        }
        .nav-back {
            display: inline-block;
            font-size: 0.85rem;
            color: var(--text-muted);
            text-decoration: none;
            margin-bottom: 16px;
            font-weight: 500;
        }
        .nav-back:hover { color: var(--primary); text-decoration: underline; }
        .header {
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border-subtle);
            padding-bottom: 16px;
        }
        .header h1 {
            font-size: 1.4rem;
            color: var(--text-heading);
            font-weight: 700;
            letter-spacing: -0.01em;
            margin-bottom: 4px;
        }
        .header p {
            font-size: 0.9rem;
            color: var(--text-muted);
        }
        .alert-error {
            background-color: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
            padding: 14px 18px;
            border-radius: 6px;
            margin-bottom: 24px;
        }
        .alert-error h3 {
            font-size: 0.92rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .alert-error ul {
            padding-left: 20px;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text-heading);
        }
        .required { color: #dc2626; font-weight: bold; }
        input[type="text"],
        input[type="number"],
        input[type="email"],
        select {
            width: 100%;
            min-height: 44px;
            padding: 9px 13px;
            border: 1px solid var(--border-default);
            border-radius: 6px;
            font-size: 0.93rem;
            color: var(--text-heading);
            background-color: var(--surface);
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        input:focus, select:focus {
            outline: none;
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.18);
        }
        .is-invalid {
            border-color: #dc2626 !important;
            background-color: #fffbfb !important;
        }
        .is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.18) !important;
        }
        .inline-feedback {
            display: block;
            font-size: 0.8rem;
            color: #b91c1c;
            margin-top: 5px;
            font-weight: 500;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 540px) {
            .form-row { grid-template-columns: 1fr; }
            .container { padding: 24px 18px; }
        }
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }
        .btn {
            flex: 1;
            min-height: 44px;
            padding: 10px 18px;
            font-size: 0.93rem;
            font-weight: 600;
            border-radius: 6px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: background-color 0.15s ease, border-color 0.15s ease;
            text-align: center;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-submit {
            background-color: var(--primary);
            color: #ffffff;
        }
        .btn-submit:hover {
            background-color: var(--primary-hover);
        }
        .btn-submit:active {
            background-color: var(--primary-active);
        }
        .btn-reset {
            background-color: #f8fafc;
            color: var(--text-body);
            border: 1px solid var(--border-default);
        }
        .btn-reset:hover {
            background-color: #f1f5f9;
            color: var(--text-heading);
        }
        .card-success {
            background: var(--surface);
        }
        .success-banner {
            background-color: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--success-text);
            padding: 14px 18px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-weight: 600;
            font-size: 0.92rem;
        }
        .meta-stamp {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-bottom: 18px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid var(--border-subtle);
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 24px;
        }
        .summary-table th, .summary-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-subtle);
            font-size: 0.9rem;
        }
        .summary-table th {
            width: 36%;
            color: var(--text-muted);
            font-weight: 600;
            background-color: #f8fafc;
        }
        .summary-table td {
            color: var(--text-heading);
            font-weight: 500;
        }
        .summary-table tr:last-child th,
        .summary-table tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="index.php" class="nav-back">&larr; Kembali ke Portal Praktikum</a>

    <div class="header">
        <h1>Praktikum 7 - Pemrograman Server-Side</h1>
        <p>Formulir Pendaftaran & Validasi Data Mahasiswa</p>
    </div>

    <?php if ($is_success): ?>
        <!-- Tampilan Ringkasan Data Ketika Validasi Berhasil (Form Disembunyikan) -->
        <div class="card-success">
            <div class="success-banner">
                Validasi Berhasil: Data mahasiswa telah diterima dan diproses oleh server.
            </div>

            <div class="meta-stamp">
                Waktu Penerimaan Server: <strong><?= escape($submit_time) ?></strong>
            </div>

            <table class="summary-table">
                <tr>
                    <th>Nama Lengkap</th>
                    <td><?= escape($nama) ?></td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td><?= escape($nim) ?></td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td><?= escape($prodi) ?></td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <td><?= escape($semester) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= escape($email) ?></td>
                </tr>
            </table>

            <div class="button-group">
                <a href="mini_project.php" class="btn btn-submit">Input Data Baru</a>
                <a href="index.php" class="btn btn-reset">Menu Praktikum</a>
            </div>
        </div>

    <?php else: ?>
        <!-- Menampilkan Pesan Error Validasi dengan Warna Latar Merah Muda -->
        <?php if (!empty($errors)): ?>
            <div class="alert-error" role="alert">
                <div class="alert-error-title">Terjadi Kesalahan Validasi:</div>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= escape($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form HTML Menggunakan Metode POST -->
        <form action="mini_project.php" method="POST" autocomplete="off" novalidate>
            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="nama" name="nama"
                    value="<?= escape($nama) ?>"
                    placeholder="Masukkan nama lengkap Anda"
                    class="<?= isset($field_errors['nama']) ? 'is-invalid' : '' ?>"
                    aria-invalid="<?= isset($field_errors['nama']) ? 'true' : 'false' ?>"
                    aria-describedby="nama-error"
                >
                <?php if (isset($field_errors['nama'])): ?>
                    <span id="nama-error" class="inline-feedback"><?= escape($field_errors['nama']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="nim">NIM <span class="required">*</span></label>
                <input type="text" id="nim" name="nim" 
                    value="<?= escape($nim) ?>" 
                    maxlength="9" 
                    placeholder="Contoh: 210101001 (9 digit angka)"
                    class="<?= isset($field_errors['nim']) ? 'is-invalid' : '' ?>"
                    aria-invalid="<?= isset($field_errors['nim']) ? 'true' : 'false' ?>"
                    aria-describedby="nim-error"
                >
                <?php if (isset($field_errors['nim'])): ?>
                    <span id="nim-error" class="inline-feedback"><?= escape($field_errors['nim']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="prodi">Program Studi <span class="required">*</span></label>
                <select id="prodi" name="prodi"
                    class="<?= isset($field_errors['prodi']) ? 'is-invalid' : '' ?>"
                    aria-invalid="<?= isset($field_errors['prodi']) ? 'true' : 'false' ?>"
                    aria-describedby="prodi-error"
                >
                    <option value="">-- Pilih Program Studi --</option>
                    <option value="Teknik Informatika" <?= $prodi === 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                    <option value="Sistem Informasi" <?= $prodi === 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                    <option value="Teknik Komputer" <?= $prodi === 'Teknik Komputer' ? 'selected' : '' ?>>Teknik Komputer</option>
                    <option value="Rekayasa Perangkat Lunak" <?= $prodi === 'Rekayasa Perangkat Lunak' ? 'selected' : '' ?>>Rekayasa Perangkat Lunak</option>
                    <option value="Manajemen Informatika" <?= $prodi === 'Manajemen Informatika' ? 'selected' : '' ?>>Manajemen Informatika</option>
                </select>
                <?php if (isset($field_errors['prodi'])): ?>
                    <span id="prodi-error" class="inline-feedback"><?= escape($field_errors['prodi']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="semester">Semester <span class="required">*</span></label>
                    <input 
                        type="number" 
                        id="semester" 
                        name="semester" 
                        min="1" 
                        max="14" 
                        value="<?= escape($semester) ?>" 
                        placeholder="1 - 14"
                        class="<?= isset($field_errors['semester']) ? 'is-invalid' : '' ?>"
                        aria-invalid="<?= isset($field_errors['semester']) ? 'true' : 'false' ?>"
                        aria-describedby="semester-error"
                    >
                    <?php if (isset($field_errors['semester'])): ?>
                        <span id="semester-error" class="inline-feedback"><?= escape($field_errors['semester']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?= escape($email) ?>" 
                        placeholder="nama@domain.com"
                        class="<?= isset($field_errors['email']) ? 'is-invalid' : '' ?>"
                        aria-invalid="<?= isset($field_errors['email']) ? 'true' : 'false' ?>"
                        aria-describedby="email-error"
                    >
                    <?php if (isset($field_errors['email'])): ?>
                        <span id="email-error" class="inline-feedback"><?= escape($field_errors['email']) ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tombol Submit dan Reset -->
            <div class="button-group">
                <button type="submit" class="btn btn-submit">Submit Data</button>
                <button type="reset" class="btn btn-reset" onclick="window.location.href='mini_project.php'">Reset</button>
            </div>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
