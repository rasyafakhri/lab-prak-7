<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan 7 - Pengolahan Data Sederhana</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .box { background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0; max-width: 500px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; color: #1e40af; font-size: 1.4rem; }
        .form-group { margin-bottom: 14px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 0.9rem; }
        input { width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 4px; }
        button { padding: 9px 18px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; }
        button:hover { background: #1d4ed8; }
        .result-box { margin-top: 20px; padding: 14px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; }
        .error-box { margin-top: 20px; padding: 14px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px; color: #991b1b; }
        a { color: #2563eb; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Kalkulator Belanja Sederhana</h1>
        
        <?php
        $error = null;
        $subtotal = null;
        $barang = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $barang = trim($_POST["barang"] ?? "");
            $hargaInput = $_POST["harga"] ?? "";
            $jumlahInput = $_POST["jumlah"] ?? "";

            // Validasi server-side
            if ($barang === "" || !is_numeric($hargaInput) || !ctype_digit((string)$jumlahInput) || (float)$hargaInput < 0 || (int)$jumlahInput < 1) {
                $error = "Periksa kembali data Anda: nama barang wajib diisi, harga harus positif, dan jumlah minimal 1.";
            } else {
                $harga = (float)$hargaInput;
                $jumlah = (int)$jumlahInput;
                $subtotal = $harga * $jumlah;
            }
        }
        ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="barang">Nama Barang:</label>
                <input id="barang" name="barang" type="text" required value="<?= htmlspecialchars($barang, ENT_QUOTES, 'UTF-8') ?>" placeholder="Contoh: Flashdisk 32GB">
            </div>
            <div class="form-group">
                <label for="harga">Harga Satuan (Rp):</label>
                <input id="harga" name="harga" type="number" min="0" step="100" required value="<?= htmlspecialchars($_POST['harga'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Contoh: 65000">
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Beli:</label>
                <input id="jumlah" name="jumlah" type="number" min="1" step="1" required value="<?= htmlspecialchars($_POST['jumlah'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Minimal 1">
            </div>
            <button type="submit">Hitung Transaksi</button>
        </form>

        <?php if ($error !== null): ?>
            <div class="error-box">
                <p>⚠️ <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php elseif ($subtotal !== null): ?>
            <div class="result-box">
                <h3 style="color:#166534; margin-bottom: 8px;">Ringkasan Transaksi:</h3>
                <p><strong>Nama Barang:</strong> <?= htmlspecialchars($barang, ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Subtotal:</strong> Rp<?= number_format($subtotal, 0, ',', '.') ?></p>
            </div>
        <?php endif; ?>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #e2e8f0;">
        <p><a href="index.php">&larr; Kembali ke Menu Praktikum</a></p>
    </div>
</body>
</html>