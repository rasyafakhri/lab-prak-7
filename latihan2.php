<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan 2 - Variabel, Operator, dan Percabangan</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .box { background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0; max-width: 550px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; color: #1e40af; font-size: 1.4rem; }
        .result-item { margin: 8px 0; font-size: 0.95rem; }
        .grade { font-size: 1.2rem; font-weight: bold; color: #16a34a; }
        a { color: #2563eb; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Perhitungan Nilai dan Percabangan</h1>
        <?php
        $nama = "Siti";
        $tugas = 85;
        $uts = 78;
        $uas = 90;

        // Bobot: Tugas 30%, UTS 30%, UAS 40%
        $nilaiAkhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);

        // Eksperimen Mandiri 1: Rata-rata dari tiga komponen nilai
        $rataRata = ($tugas + $uts + $uas) / 3;

        // Penentuan Predikat Nilai
        if ($nilaiAkhir >= 85) {
            $predikat = "A (Sangat Baik)";
        } elseif ($nilaiAkhir >= 75) {
            $predikat = "B (Baik)";
        } elseif ($nilaiAkhir >= 60) {
            $predikat = "C (Cukup)";
        } else {
            $predikat = "D (Kurang)";
        }
        ?>

        <div class="result-item"><strong>Nama Mahasiswa:</strong> <?= htmlspecialchars($nama) ?></div>
        <div class="result-item"><strong>Nilai Tugas (30%):</strong> <?= $tugas ?></div>
        <div class="result-item"><strong>Nilai UTS (30%):</strong> <?= $uts ?></div>
        <div class="result-item"><strong>Nilai UAS (40%):</strong> <?= $uas ?></div>
        <div class="result-item"><strong>Nilai Rata-rata:</strong> <?= number_format($rataRata, 2) ?></div>
        <div class="result-item"><strong>Nilai Akhir Terbobot:</strong> <?= number_format($nilaiAkhir, 2) ?></div>
        <div class="result-item"><strong>Predikat:</strong> <span class="grade"><?= $predikat ?></span></div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #e2e8f0;">
        <p><a href="index.php">&larr; Kembali ke Menu Praktikum</a></p>
    </div>
</body>
</html>