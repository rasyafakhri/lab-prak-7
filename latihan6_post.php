<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan 6 - Form Metode POST</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .box { background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0; max-width: 500px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; color: #1e40af; font-size: 1.4rem; }
        .form-group { margin-bottom: 14px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 0.9rem; }
        input[type="text"] { width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 4px; }
        button { padding: 9px 18px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; }
        button:hover { background: #1d4ed8; }
        .result-box { margin-top: 20px; padding: 14px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; }
        .error-box { margin-top: 20px; padding: 14px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px; color: #991b1b; }
        a { color: #2563eb; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Input Data (Metode POST)</h1>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input id="nama" name="nama" type="text" required placeholder="Masukkan nama...">
            </div>
            <div class="form-group">
                <label for="prodi">Program Studi:</label>
                <input id="prodi" name="prodi" type="text" required placeholder="Contoh: Teknik Informatika">
            </div>
            <button type="submit" name="kirim">Kirim Data</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nama = trim($_POST["nama"] ?? "");
            $prodi = trim($_POST["prodi"] ?? "");

            if ($nama === "" || $prodi === "") {
                echo "<div class='error-box'><p>Semua kolom wajib diisi.</p></div>";
            } else {
                echo "<div class='result-box'>";
                echo "<h3 style='margin-bottom:8px; color:#166534;'>Data Diterima di Server:</h3>";
                echo "<p><strong>Nama:</strong> " . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "</p>";
                echo "<p><strong>Program Studi:</strong> " . htmlspecialchars($prodi, ENT_QUOTES, "UTF-8") . "</p>";
                echo "</div>";
            }
        }
        ?>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #e2e8f0;">
        <p><a href="index.php">&larr; Kembali ke Menu Praktikum</a></p>
    </div>
</body>
</html>