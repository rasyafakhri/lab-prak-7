<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan 5 - Form Metode GET & Pencarian</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .box { background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0; max-width: 550px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; color: #1e40af; font-size: 1.4rem; }
        input[type="text"] { width: 70%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 4px; }
        button { padding: 8px 16px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        .result-box { margin-top: 20px; padding: 14px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; }
        ul { padding-left: 20px; margin-top: 8px; }
        a { color: #2563eb; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Pencarian Data (Metode GET)</h1>
        
        <!-- Form GET -->
        <form method="GET" action="">
            <label for="kata" style="display:block; margin-bottom: 6px; font-weight: 600;">Cari Nama Mahasiswa:</label>
            <div style="display:flex; gap: 8px;">
                <input id="kata" name="kata" type="text" placeholder="Masukkan nama..." value="<?= htmlspecialchars($_GET['kata'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <button type="submit">Cari</button>
            </div>
        </form>

        <?php
        // Eksperimen Mandiri 2: Ubah contoh GET agar dapat mencari nama dari array data sederhana
        $daftarMahasiswa = ["Alya Safitri", "Bima Sakti", "Citra Kirana", "Doni Salman", "Eka Pratama", "Farhan Maulana", "Gita Savitri"];

        if (isset($_GET["kata"])) {
            $kata = trim($_GET["kata"]);
            echo "<div class='result-box'>";
            echo "<p><strong>Kata kunci pencarian:</strong> " . htmlspecialchars($kata, ENT_QUOTES, "UTF-8") . "</p>";

            if ($kata !== "") {
                // Cari nama yang mengandung kata kunci (case-insensitive)
                $hasilCari = array_filter($daftarMahasiswa, function($nama) use ($kata) {
                    return stripos($nama, $kata) !== false;
                });

                if (!empty($hasilCari)) {
                    echo "<p style='margin-top:8px;'><strong>Hasil Ditemukan:</strong></p><ul>";
                    foreach ($hasilCari as $nama) {
                        echo "<li>" . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p style='color: #b91c1c; margin-top:8px;'>Tidak ada mahasiswa yang cocok dengan kata kunci tersebut.</p>";
                }
            } else {
                echo "<p style='color: #64748b; margin-top:8px;'>Menampilkan seluruh data karena kata kunci kosong:</p><ul>";
                foreach ($daftarMahasiswa as $nama) {
                    echo "<li>" . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "</li>";
                }
                echo "</ul>";
            }
            echo "</div>";
        }
        ?>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #e2e8f0;">
        <p><a href="index.php">&larr; Kembali ke Menu Praktikum</a></p>
    </div>
</body>
</html>