<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan 4 - User Defined Function</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .box { background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0; max-width: 550px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; color: #1e40af; font-size: 1.4rem; }
        .item { margin: 10px 0; font-size: 0.95rem; }
        a { color: #2563eb; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Implementasi Custom Function di PHP</h1>
        <?php
        // 1. Function Menghitung Diskon
        function hitungDiskon(float $harga, float $persen): float {
            $potongan = $harga * ($persen / 100);
            return $harga - $potongan;
        }

        // 2. Eksperimen Mandiri 3: Function format harga ke mata uang Rupiah
        function formatRupiah(float $angka): string {
            return "Rp" . number_format($angka, 0, ",", ".");
        }

        // 3. Function Tambahan: Menghitung Luas Persegi Panjang
        function hitungLuasPersegiPanjang(float $panjang, float $lebar): float {
            return $panjang * $lebar;
        }

        // 4. Function Tambahan: Menentukan Status Kelulusan
        function cekKelulusan(float $nilai): string {
            return ($nilai >= 60) ? "<span style='color:green;'>Lulus</span>" : "<span style='color:red;'>Tidak Lulus</span>";
        }

        $hargaAsli = 150000;
        $persenDiskon = 10;
        $hargaAkhir = hitungDiskon($hargaAsli, $persenDiskon);
        ?>

        <div class="item"><strong>Harga Awal:</strong> <?= formatRupiah($hargaAsli) ?></div>
        <div class="item"><strong>Diskon:</strong> <?= $persenDiskon ?>%</div>
        <div class="item"><strong>Harga Setelah Diskon:</strong> <?= formatRupiah($hargaAkhir) ?></div>
        <hr style="margin: 15px 0; border: none; border-top: 1px dashed #cbd5e1;">
        <div class="item"><strong>Luas Persegi Panjang (P=8, L=4):</strong> <?= hitungLuasPersegiPanjang(8, 4) ?> cm²</div>
        <div class="item"><strong>Status Mahasiswa (Nilai 75):</strong> <?= cekKelulusan(75) ?></div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #e2e8f0;">
        <p><a href="index.php">&larr; Kembali ke Menu Praktikum</a></p>
    </div>
</body>
</html>