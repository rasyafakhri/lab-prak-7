CREATE DATABASE IF NOT EXISTS `praktikum7_db`;
USE `praktikum7_db`;

CREATE TABLE IF NOT EXISTS `mahasiswa` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama_lengkap` VARCHAR(255) NOT NULL,
    `nim` VARCHAR(9) UNIQUE NOT NULL,
    `program_studi` VARCHAR(100) NOT NULL,
    `semester` INT NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contoh data (opsional, untuk pengujian)
INSERT INTO `mahasiswa` (`nama_lengkap`, `nim`, `program_studi`, `semester`, `email`)
VALUES
    ('Budi Wicaksono', '210101001', 'Teknik Informatika', 4, 'budi.wicaksono@kampus.ac.id'),
    ('Siti Nurhaliza', '220202999', 'Sistem Informasi', 1, 'siti.nur@domain.com');
