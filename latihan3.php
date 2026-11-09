<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan 3 - Perulangan dan Array</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .box { background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0; max-width: 500px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; color: #1e40af; font-size: 1.4rem; }
        ol { padding-left: 24px; margin-top: 12px; line-height: 1.8; }
        a { color: #2563eb; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Daftar Mahasiswa (Array & Foreach)</h1>
        <?php
        // Array awal ditambah minimal tiga nama mahasiswa baru sesuai modul
        $mahasiswa = ["Alya", "Bima", "Citra", "Doni", "Eka Pratama", "Farhan Maulana", "Gita Savitri"];
        ?>
        <ol>
            <?php foreach ($mahasiswa as $nama): ?>
                <li><?= htmlspecialchars($nama) ?></li>
            <?php endforeach; ?>
        </ol>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #e2e8f0;">
        <p><a href="index.php">&larr; Kembali ke Menu Praktikum</a></p>
    </div>
</body>
</html>