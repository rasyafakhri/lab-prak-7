<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum 7 - Pemrograman Server-Side PHP</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            padding: 40px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.07);
            border: 1px solid #e2e8f0;
        }
        h1 { color: #0f172a; font-size: 1.7rem; margin-bottom: 8px; }
        p.subtitle { color: #64748b; margin-bottom: 24px; font-size: 0.95rem; }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
            margin-top: 20px;
        }
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            transition: all 0.2s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card:hover {
            border-color: #2563eb;
            box-shadow: 0 4px 12px rgba(37,99,235,0.1);
            transform: translateY(-2px);
        }
        .card h3 { font-size: 1rem; color: #1e40af; margin-bottom: 6px; }
        .card p { font-size: 0.85rem; color: #64748b; line-height: 1.4; }
        .badge {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 9999px;
            margin-top: 10px;
            width: fit-content;
        }
        .badge-lat { background: #e0f2fe; color: #0369a1; }
        .badge-main { background: #dcfce7; color: #15803d; }
    </style>
</head>
<body>
<div class="container">
    <h1>Praktikum 7: Pemrograman Server-Side dengan PHP</h1>
    <p class="subtitle">Laboratorium Pemrograman Web - Teknik Informatika</p>
    
    <div class="grid">
        <a href="latihan1.php" class="card">
            <div>
                <h3>Latihan 1: Menjalankan PHP</h3>
                <p>Mengeksekusi sintaks dasar PHP dan menampilkan waktu server.</p>
            </div>
            <span class="badge badge-lat">Latihan 1</span>
        </a>
        <a href="latihan2.php" class="card">
            <div>
                <h3>Latihan 2: Variabel & Logika</h3>
                <p>Operator nilai akhir mahasiswa dan penentuan predikat grade.</p>
            </div>
            <span class="badge badge-lat">Latihan 2</span>
        </a>
        <a href="latihan3.php" class="card">
            <div>
                <h3>Latihan 3: Array & Perulangan</h3>
                <p>Menampilkan daftar nama mahasiswa dengan perulangan foreach.</p>
            </div>
            <span class="badge badge-lat">Latihan 3</span>
        </a>
        <a href="latihan4.php" class="card">
            <div>
                <h3>Latihan 4: Custom Function</h3>
                <p>Function hitungDiskon dan konversi mata uang Rupiah.</p>
            </div>
            <span class="badge badge-lat">Latihan 4</span>
        </a>
        <a href="latihan5_get.php" class="card">
            <div>
                <h3>Latihan 5: Form Metode GET</h3>
                <p>Menangkap data query URL dan fitur pencarian nama mahasiswa.</p>
            </div>
            <span class="badge badge-lat">Latihan 5</span>
        </a>
        <a href="latihan6_post.php" class="card">
            <div>
                <h3>Latihan 6: Form Metode POST</h3>
                <p>Pengiriman data secara aman melalui HTTP POST body.</p>
            </div>
            <span class="badge badge-lat">Latihan 6</span>
        </a>
        <a href="latihan7.php" class="card">
            <div>
                <h3>Latihan 7: Pengolahan Data</h3>
                <p>Kalkulator transaksi belanja barang dan validasi numerik.</p>
            </div>
            <span class="badge badge-lat">Latihan 7</span>
        </a>
        <a href="mini_project.php" class="card" style="border-color: #86efac; background: #f0fdf4;">
            <div>
                <h3 style="color: #166534;">Mini Project: Form Mahasiswa</h3>
                <p>Validasi server-side lengkap, sanitasi input, dan UI responsif.</p>
            </div>
            <span class="badge badge-main">Proyek Utama</span>
        </a>
    </div>
</div>
</body>
</html>
