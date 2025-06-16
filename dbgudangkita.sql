-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2025 pada 11.27
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbgudangkita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `IDAdmin` int(10) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `No_Telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`IDAdmin`, `Nama`, `Email`, `Password`, `No_Telepon`) VALUES
(2, 'admin', 'admin@gmail.com', '123', '083948574832'),
(6, 'admin2', 'admin2@gmail.com', '123', '083948392834'),
(7, 'admin3', 'admin3@gmail.com', '123', '083948372832');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `IDPegawai` varchar(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `No_Telepon` varchar(15) NOT NULL,
  `Alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`IDPegawai`, `Nama`, `Email`, `Password`, `No_Telepon`, `Alamat`) VALUES
('PG003', 'Fauzan Wicaksono', 'fauzan@gmail.com', '123', '082736483723', 'jakarta utara'),
('PG004', 'yosua', 'yosua@gmail.com', '123', '082937463745', 'Planet bekasi no 99'),
('PG005', 'acep', 'acep@gmail.com', '123', '083948392832', 'Cimahi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `IDPembelian` varchar(10) NOT NULL,
  `IDSupplier` varchar(10) NOT NULL,
  `IDProduk` varchar(10) NOT NULL,
  `Tanggal` datetime NOT NULL,
  `Jumlahitem` int(11) NOT NULL,
  `Hargasatuan` float NOT NULL,
  `Totalharga` float NOT NULL,
  `Metodepembayaran` enum('Transfer bank','Tunai','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`IDPembelian`, `IDSupplier`, `IDProduk`, `Tanggal`, `Jumlahitem`, `Hargasatuan`, `Totalharga`, `Metodepembayaran`) VALUES
('PEM001', 'SUP001', 'PRD001', '2025-01-10 09:00:00', 10, 6000000, 60000000, 'Transfer bank'),
('PEM002', 'SUP002', 'PRD002', '2025-02-15 10:30:00', 5, 5000000, 25000000, 'Tunai'),
('PEM003', 'SUP003', 'PRD003', '2025-03-05 08:00:00', 8, 4000000, 32000000, 'Transfer bank'),
('PEM004', 'SUP001', 'PRD004', '2025-03-20 13:00:00', 6, 5500000, 33000000, 'Tunai'),
('PEM005', 'SUP002', 'PRD005', '2025-04-01 14:30:00', 12, 3500000, 42000000, 'Transfer bank'),
('PEM006', 'SUP003', 'PRD001', '2025-04-18 11:00:00', 5, 6100000, 30500000, 'Tunai'),
('PEM007', 'SUP002', 'PRD002', '2025-05-03 10:00:00', 6, 5100000, 30600000, 'Transfer bank'),
('PEM008', 'SUP001', 'PRD003', '2025-05-15 16:00:00', 7, 3950000, 27650000, 'Tunai'),
('PEM009', 'SUP003', 'PRD004', '2025-06-05 09:45:00', 3, 5600000, 16800000, 'Transfer bank'),
('PEM010', 'SUP001', 'PRD005', '2025-06-10 15:15:00', 10, 3400000, 34000000, 'Tunai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `IDPesanan` int(10) NOT NULL,
  `IDProduk` varchar(10) NOT NULL,
  `Tanggalpesanan` datetime NOT NULL,
  `Jumlahitem` int(11) NOT NULL,
  `Totalharga` float NOT NULL,
  `Metodepembayaran` enum('Transfer Bank','Tunai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`IDPesanan`, `IDProduk`, `Tanggalpesanan`, `Jumlahitem`, `Totalharga`, `Metodepembayaran`) VALUES
(1, 'PRD001', '2025-01-12 11:00:00', 5, 35000000, 'Tunai'),
(2, 'PRD001', '2025-01-20 13:00:00', 5, 37000000, 'Transfer Bank'),
(3, 'PRD002', '2025-02-18 14:30:00', 5, 32000000, 'Tunai'),
(4, 'PRD003', '2025-03-08 10:15:00', 8, 48000000, 'Transfer Bank'),
(5, 'PRD004', '2025-03-22 09:45:00', 6, 36000000, 'Tunai'),
(6, 'PRD005', '2025-04-05 13:30:00', 12, 50000000, 'Transfer Bank'),
(7, 'PRD001', '2025-04-22 12:00:00', 5, 34000000, 'Tunai'),
(8, 'PRD002', '2025-05-05 09:30:00', 6, 34500000, 'Transfer Bank'),
(9, 'PRD003', '2025-05-18 14:00:00', 7, 42000000, 'Tunai'),
(10, 'PRD004', '2025-06-06 10:30:00', 3, 21000000, 'Transfer Bank'),
(11, 'PRD005', '2025-06-12 15:00:00', 10, 39000000, 'Tunai'),
(12, 'PRD001', '2025-06-14 11:30:00', 2, 15000000, 'Transfer Bank'),
(13, 'PRD003', '2025-05-20 08:00:00', 3, 20000000, 'Tunai'),
(14, 'PRD002', '2025-06-01 13:45:00', 1, 6000000, 'Tunai'),
(15, 'PRD005', '2025-06-15 17:00:00', 5, 20000000, 'Transfer Bank');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `IDProduk` varchar(10) NOT NULL,
  `Namaproduk` varchar(100) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Stok` int(10) NOT NULL,
  `Kategoriproduk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`IDProduk`, `Namaproduk`, `Harga`, `Deskripsi`, `Stok`, `Kategoriproduk`) VALUES
('PRD001', 'Samsung Galaxy A14', 2400000, 'HP Samsung entry-level dengan layar besar dan baterai 5000mAh', 50, 'Samsung'),
('PRD002', 'Samsung Galaxy S23', 13999000, 'Flagship Samsung dengan Snapdragon 8 Gen 2 dan kamera 50MP', 25, 'Samsung'),
('PRD003', 'Xiaomi Redmi Note 12', 2999000, 'HP Xiaomi dengan AMOLED 120Hz dan Snapdragon 685', 40, 'Xiaomi'),
('PRD004', 'Xiaomi 13T Pro', 7999000, 'HP flagship Xiaomi dengan kamera Leica dan performa tinggi', 15, 'Xiaomi'),
('PRD005', 'OPPO A57', 2099000, 'HP OPPO dengan desain tipis, 5000mAh dan fast charging', 35, 'OPPO'),
('PRD006', 'OPPO Reno10 5G', 5999000, 'HP OPPO mid-high dengan kamera telephoto dan RAM besar', 18, 'OPPO'),
('PRD007', 'Vivo Y16', 1799000, 'HP Vivo murah dengan baterai 5000mAh dan desain elegan', 45, 'Vivo'),
('PRD008', 'Vivo V29 5G', 6299000, 'HP Vivo stylish dengan kamera 50MP dan layar AMOLED', 20, 'Vivo'),
('PRD009', 'Realme C55', 2299000, 'HP Realme dengan Mini Capsule dan pengisian cepat', 42, 'Realme'),
('PRD010', 'Realme 11 Pro+', 6499000, 'HP Realme premium dengan kamera 200MP dan RAM besar', 16, 'Realme'),
('PRD011', 'Infinix Hot 30i', 1499000, 'HP Infinix murah dengan RAM besar dan desain modern', 60, 'Infinix'),
('PRD012', 'Infinix Zero 30', 4299000, 'HP Infinix high-end dengan kamera 108MP dan 4K selfie', 22, 'Infinix'),
('PRD013', 'iPhone 14', 14999000, 'HP Apple dengan chip A15 dan desain premium', 10, 'Apple'),
('PRD014', 'iPhone SE 2022', 7499000, 'iPhone kecil dan ringan dengan performa A15 Bionic', 8, 'Apple'),
('PRD015', 'Huawei Nova 11i', 3299000, 'HP Huawei stylish dengan kamera 48MP dan 8GB RAM', 30, 'Huawei'),
('PRD016', 'Huawei P60 Pro', 13999000, 'Flagship Huawei dengan teknologi XMAGE dan desain mewah', 6, 'Huawei'),
('PRD017', 'Nokia C31', 1599000, 'HP Nokia murah dengan layar besar dan baterai tahan lama', 38, 'Nokia'),
('PRD018', 'Nokia G60 5G', 4999000, 'HP Nokia dengan Snapdragon 695 dan Android murni', 12, 'Nokia'),
('PRD019', 'ASUS ROG Phone 7', 12999000, 'HP ASUS gaming kelas atas dengan sistem pendingin canggih', 9, 'ASUS'),
('PRD020', 'ASUS Zenfone 10', 8999000, 'HP kompak ASUS dengan Snapdragon 8 Gen 2 dan OIS', 14, 'ASUS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `IDSupplier` varchar(10) NOT NULL,
  `Namasupplier` varchar(100) NOT NULL,
  `Alamat` text NOT NULL,
  `No_Telepon` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Kategoriproduk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`IDSupplier`, `Namasupplier`, `Alamat`, `No_Telepon`, `Email`, `Kategoriproduk`) VALUES
('SUP001', 'CV Teknologi Maju', 'Jl. Merdeka No. 10, Jakarta', '081234567890', 'info@tekmaju.com', 'Samsung'),
('SUP002', 'PT Gawai Global', 'Jl. Soekarno Hatta No. 25, Bandung', '082345678901', 'kontak@gawaiglobal.co.id', 'Xiaomi'),
('SUP003', 'UD Selular Jaya', 'Jl. Asia Afrika No. 5, Surabaya', '083456789012', 'udselularjaya@gmail.com', 'OPPO'),
('SUP004', 'CV Ponsel Cerdas', 'Jl. Diponegoro No. 88, Semarang', '084567890123', 'sales@ponselcerdas.id', 'Vivo'),
('SUP005', 'PT Andalan Teknologi', 'Jl. Braga No. 20, Jakarta', '085678901234', 'admin@andalan.tech', 'Realme'),
('SUP006', 'UD Komunika Selaras', 'Jl. Ganesha No. 1, Bandung', '086789012345', 'komunika.selaras@yahoo.com', 'Infinix'),
('SUP007', 'CV Gadget Nusantara', 'Jl. Slamet Riyadi No. 9, Solo', '087890123456', 'nusantaragadget@outlook.com', 'Apple'),
('SUP008', 'PT Solusi Mobile', 'Jl. Pahlawan No. 19, Medan', '088901234567', 'info@solusimobile.com', 'Huawei'),
('SUP009', 'UD Global Gadget', 'Jl. Kalimantan No. 7, Malang', '089012345678', 'globalgadget@gmail.com', 'Nokia'),
('SUP010', 'CV Digital Cell', 'Jl. Veteran No. 15, Yogyakarta', '081112223334', 'cs@digitalcell.id', 'ASUS');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDAdmin`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`IDPegawai`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`IDPembelian`),
  ADD KEY `IDSupplier` (`IDSupplier`),
  ADD KEY `IDProduk` (`IDProduk`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`IDPesanan`),
  ADD KEY `IDProduk` (`IDProduk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`IDProduk`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`IDSupplier`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `IDAdmin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `IDPesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`IDSupplier`) REFERENCES `supplier` (`IDSupplier`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`IDProduk`) REFERENCES `produk` (`IDProduk`);

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`IDProduk`) REFERENCES `produk` (`IDProduk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
