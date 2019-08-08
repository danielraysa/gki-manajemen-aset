-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2019 at 06:46 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gki_backup`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` int(11) NOT NULL,
  `nama_aset` varchar(30) NOT NULL,
  `nomor_aset` varchar(4) NOT NULL,
  `id_pengadaan` int(11) NOT NULL,
  `harga_aset` int(11) NOT NULL,
  `tanggal_pengadaan` date NOT NULL,
  `lokasi_aset` int(11) NOT NULL,
  `masa_manfaat` int(11) NOT NULL,
  `gambar` text,
  `tgl_added` date NOT NULL,
  `aset_pinjam` int(11) NOT NULL,
  `status_pinjam` int(11) NOT NULL,
  `status_aset` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id_aset`, `nama_aset`, `nomor_aset`, `id_pengadaan`, `harga_aset`, `tanggal_pengadaan`, `lokasi_aset`, `masa_manfaat`, `gambar`, `tgl_added`, `aset_pinjam`, `status_pinjam`, `status_aset`) VALUES
(1, 'Keyboard Yamaha PSR-710', '', 0, 1, '0000-00-00', 0, 0, NULL, '2018-08-03', 0, 0, ''),
(2, 'Mixer Yamaha', '', 0, 1, '0000-00-00', 0, 0, NULL, '2018-08-04', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_BARANG` varchar(10) NOT NULL,
  `ID_KATEGORI` varchar(10) NOT NULL,
  `NAMA_BARANG` varchar(50) DEFAULT NULL,
  `STATUS_BARANG` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `ID_KATEGORI`, `NAMA_BARANG`, `STATUS_BARANG`) VALUES
('1', '1', 'Gitar Elektrik', 'Aktif'),
('1NDLKBS7WK', 'N8YFPKZNGD', 'Speaker Aktif', 'Aktif'),
('2', '1', 'Keyboard Elektrik', 'Aktif'),
('2QZQRINJ2N', 'N8YFPKZNGD', 'Mic Kabel', 'Aktif'),
('3', '2', 'Mobil', 'Aktif'),
('3CATX9AU4J', '1', 'Drum Set', 'Aktif'),
('4', '3', 'Kamera', 'Aktif'),
('51IT1WGTAB', 'N8YFPKZNGD', 'Jack XLR', 'Aktif'),
('8FTYMA3W2K', '23LTLPLUSM', 'Komputer', 'Aktif'),
('8QJ70Z4FQS', 'MKV6VN939J', 'Walkie Talkie (HT)', 'Aktif'),
('9SVZMCDU3Z', '2', 'Sepeda Motor', 'Aktif'),
('ALX7Y7V7OC', '7X5WSADGC6', 'Scanner', 'Aktif'),
('AU4IEPMC2I', 'N8YFPKZNGD', 'Mixer Audio', 'Aktif'),
('FFS9UL1O51', '3', 'Kamera Video', 'Aktif'),
('GKIT2ZA9DT', 'N8YFPKZNGD', 'Speaker Pasif', 'Aktif'),
('GWHAKXNZ5Q', '1', 'Piano Elektrik', 'Aktif'),
('HZFPYLWZKD', 'SODH1U79U8', 'AC', 'Aktif'),
('IGGEWK7AZ8', '1', 'Bass Elektrik', 'Aktif'),
('KMMU9FHWZP', '7X5WSADGC6', 'Printer', 'Aktif'),
('KORQ2JSJ1N', 'N8YFPKZNGD', 'TV LED', 'Aktif'),
('N7FPL2HFAZ', '1', 'Bass Akustik', 'Aktif'),
('NQL3B21RGV', '1', 'Cajoon', 'Aktif'),
('T5EXQ3KH87', 'N8YFPKZNGD', 'Mic Condensor', 'Aktif'),
('TBQZ1YLZA8', 'N8YFPKZNGD', 'Mic Wireless', 'Aktif'),
('TXDJWF6OZ8', '1', 'Gitar Akustik', 'Aktif'),
('UZ4P0W6DUE', 'MKV6VN939J', 'Router', 'Aktif'),
('VQ1D8ZPOPB', '23LTLPLUSM', 'Laptop', 'Aktif'),
('WOL3ZG96BQ', 'MKV6VN939J', 'Modem Wifi', 'Aktif'),
('XWHI6OAN9W', 'N8YFPKZNGD', 'Amplifier', 'Aktif'),
('YU9666UFRF', '1', 'Piano', 'Aktif'),
('Z9JEYA6ANG', 'N8YFPKZNGD', 'Proyektor', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_aset`
--

CREATE TABLE `daftar_aset` (
  `ID_ASET` varchar(10) NOT NULL,
  `ID_MERK` varchar(6) NOT NULL,
  `ID_RUANGAN` varchar(6) NOT NULL,
  `ID_USULAN_TAMBAH` varchar(10) DEFAULT NULL,
  `ID_KOMISI` varchar(6) NOT NULL,
  `ID_STATUS` varchar(6) NOT NULL,
  `NAMA_ASET` varchar(50) DEFAULT NULL,
  `KODE_ASET` varchar(30) DEFAULT NULL,
  `SERI_MODEL` varchar(50) DEFAULT NULL,
  `HARGA_PEMBELIAN` int(11) DEFAULT NULL,
  `TANGGAL_PEMBELIAN` date DEFAULT NULL,
  `MASA_MANFAAT` int(11) DEFAULT NULL,
  `NILAI_RESIDU` int(11) DEFAULT NULL,
  `PERBOLEHAN_PINJAM` int(11) DEFAULT NULL,
  `FOTO_ASET` text,
  `STATUS_ASET` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_aset`
--

INSERT INTO `daftar_aset` (`ID_ASET`, `ID_MERK`, `ID_RUANGAN`, `ID_USULAN_TAMBAH`, `ID_KOMISI`, `ID_STATUS`, `NAMA_ASET`, `KODE_ASET`, `SERI_MODEL`, `HARGA_PEMBELIAN`, `TANGGAL_PEMBELIAN`, `MASA_MANFAAT`, `NILAI_RESIDU`, `PERBOLEHAN_PINJAM`, `FOTO_ASET`, `STATUS_ASET`) VALUES
('0KBHNTA5TX', 'ZKZCZ4', '4ISKF9', 'X75EPL', '1', '1', 'Mic Dynamic AKG P5i', 'F1519D001', 'P5i', 1700000, '2019-06-07', 5, 100000, 1, 'AKG-P5i.jpg', 'Aktif'),
('178SQIVSFU', 'XYWWG0', '2', '134N4Z', '4PDSW0', '1', 'AC', 'E0119M001', 'a', 4000000, '2019-07-25', 4, 300000, 1, 'laptop.png', 'Aktif'),
('18BWKIPH6U', 'RRVVTQ', '2', 'M5HAXK', 'JM9K1L', '1', 'Laptop Asus VivoBook X441SA', 'J0419F001', 'X441SA', 6300000, '2019-06-08', 4, 500000, 1, '15524491_b29fd128-390e-4965-8aa1-7cebcdd1e29b.jpeg', 'Aktif'),
('1D2N9E0JYM', 'ZKZCZ4', '4ISKF9', 'X75EPL', '1', '1', 'Mic Dynamic AKG P5i', 'F1519D002', 'P5i', 1700000, '2019-06-07', 5, 100000, 1, 'AKG-P5i.jpg', 'Aktif'),
('5HD08SHO9K', 'ZKZCZ4', '4ISKF9', 'X75EPL', '1', '1', 'Mic Dynamic AKG P5i', 'F1519D003', 'P5i', 1700000, '2019-06-07', 5, 100000, 1, 'AKG-P5i.jpg', 'Aktif'),
('5IRSBBSNWI', 'EFJ1C0', '1', '72E3SG', 'XGG2WG', '1', 'TV LG 32 Inch', 'H0119D002', '32LK500', 2100000, '2019-06-08', 5, 200000, 0, '636967_df2a32d8-405d-40e2-b077-a91d762e791d_720_907.png', 'Aktif'),
('5P4HQ0ECQF', '1', '1', '1', '1', '1', 'Yamaha DGX-570', 'DASA1091', 'DGX-570', 34123123, '2019-04-07', 4, 1000000, 1, NULL, 'Tidak Aktif'),
('67V8YNZOK9', 'MOSJ1W', '6C7JBK', 'YTGMOQ', '4PDSW0', '1', 'Mitsubishi L300 Minibus', 'E4019N001', 'L300', 300000000, '2019-07-17', 8, 30000000, 1, 'jualmobilbaru_mitsubishi_l300mb_2_1426957401-500x334.jpg', 'Aktif'),
('9376PZXMBG', 'EFJ1C0', '1', '72E3SG', 'XGG2WG', '1', 'TV LG 32 Inch', 'H0119D008', '32LK500', 2100000, '2019-06-08', 5, 200000, 0, '636967_df2a32d8-405d-40e2-b077-a91d762e791d_720_907.png', 'Aktif'),
('A0WKZFBPQ6', 'XYWWG0', '2', '134N4Z', '4PDSW0', '1', 'AC', 'E0119M002', 'a', 4000000, '2019-07-25', 4, 300000, 1, 'laptop.png', 'Aktif'),
('A5RZ64KA9M', 'TPO3S5', 'PCHXOQ', 'WHB1GX', '4PDSW0', '1', 'Supra X 125 Hitam', 'E5019N001', 'Supra X 125', 18000000, '2019-06-25', 5, 2500000, 0, 'Honda-Supra-X-125-FI-IIMS-2019-799x499.jpg', 'Aktif'),
('ABZJ2B0O4O', 'ZKZCZ4', '4ISKF9', 'X75EPL', '1', '1', 'Mic Dynamic AKG P5i', 'F1519D007', 'P5i', 1700000, '2019-06-07', 5, 100000, 1, 'AKG-P5i.jpg', 'Aktif'),
('B0E8BB7L34', 'CY0V9E', '1', 'LCTO5M', 'ZKASYU', '1', 'Wireless Mic Shure X2000M', 'D0119D002', 'X2000M', 1650000, '2019-06-07', 5, 100000, 1, '6620410_39b9d015-4382-4327-bff0-6403e50b61ed_1712_1180.jpeg', 'Aktif'),
('COF8LUY4HU', '1', '1', '1', '1', '1', 'Yamaha PSR-910', 'A0419G001', 'PSR-910', 34123123, '2019-04-15', 4, 10000, 1, '1okk.png', 'Aktif'),
('E4Y0Z8I9R0', '1', '2', '9', '3', '1', 'Avanza', 'A0619G001', '1500cc', 140000000, '2019-04-15', 5, 10000000, 1, 'avanza.jpeg', 'Aktif'),
('E4Y0Z8I9R1', '1', '2', NULL, '3', '1', 'Avanza Putih', 'A0616G001', '1500cc', 140000000, '2016-04-15', 5, 10000000, 1, 'avanza.jpeg', 'Aktif'),
('EUZ7W9FIVZ', 'EFJ1C0', '1', '72E3SG', 'XGG2WG', '1', 'TV LG 32 Inch', 'H0119D005', '32LK500', 2100000, '2019-06-08', 5, 200000, 0, '636967_df2a32d8-405d-40e2-b077-a91d762e791d_720_907.png', 'Aktif'),
('G2E4HOBKYD', 'ZKZCZ4', '4ISKF9', 'X75EPL', '1', '1', 'Mic Dynamic AKG P5i', 'F1519D008', 'P5i', 1700000, '2019-06-07', 5, 100000, 1, 'AKG-P5i.jpg', 'Aktif'),
('I1F4JT9H67', 'DQRX33', '2', 'ATUPFQ', 'JM9K1L', '1', 'Printer Epson L120', 'J0419G001', 'L120', 1500000, '2019-05-27', 4, 100000, 1, '1514291408549.jpg', 'Aktif'),
('IZ18SOMALH', '2', '6C7JBK', '9', '4PDSW0', '1', 'Avanza Hitam 1500cc', 'E4019N001', '1500cc', 140000000, '2019-04-17', 8, 50000000, 1, 'toyota-avanza.jpg', 'Aktif'),
('JA9UTJQ2N7', 'CY0V9E', '1', 'LCTO5M', 'ZKASYU', '1', 'Wireless Mic Shure X2000M', 'D0119D001', 'X2000M', 1650000, '2019-06-07', 5, 100000, 1, '6620410_39b9d015-4382-4327-bff0-6403e50b61ed_1712_1180.jpeg', 'Aktif'),
('KGJDP6NTFQ', 'DQRX33', '9V81UY', 'WHFH7S', 'JM9K1L', '1', 'Proyektor Epson EB-S400', 'J1119D002', 'EB-S400', 4700000, '2019-06-08', 5, 200000, 1, '11149940_18546bc7-6bb1-4412-aa96-386da143d669_1500_1500.jpg', 'Aktif'),
('OKBUNQUYJY', 'DQRX33', '9V81UY', 'WHFH7S', 'JM9K1L', '1', 'Proyektor Epson EB-S400', 'J1119D001', 'EB-S400', 4700000, '2019-06-08', 5, 200000, 1, '11149940_18546bc7-6bb1-4412-aa96-386da143d669_1500_1500.jpg', 'Aktif'),
('OL5SNVUQQH', 'ZKZCZ4', '1', 'VJF1XQ', 'ZKASYU', '1', 'Mic Condenser AKG C1000S', 'D0119D002', 'C1000S', 2400000, '2019-06-07', 5, 100000, 1, '2356629_8afe4dd1-df76-48a5-bc89-f3acf865d23a.jpg', 'Aktif'),
('ONKBQ7JB64', 'ZKZCZ4', '4ISKF9', 'X75EPL', '1', '1', 'Mic Dynamic AKG P5i', 'F1519D006', 'P5i', 1700000, '2019-06-07', 5, 100000, 1, 'AKG-P5i.jpg', 'Aktif'),
('PKYRFW8FW6', 'ZKZCZ4', '1', 'VJF1XQ', 'ZKASYU', '1', 'Mic Condenser AKG C1000S', 'D0119D001', 'C1000S', 2400000, '2019-06-07', 5, 100000, 1, '2356629_8afe4dd1-df76-48a5-bc89-f3acf865d23a.jpg', 'Aktif'),
('PTUGOXFF2D', 'V5UBWT', '2', 'XMN8I8', 'JM9K1L', '1', 'Scanner Canon Lide 120', 'J0419G001', 'Lide 120', 800000, '2019-05-27', 4, 150000, 0, 'background1.jpg', 'Aktif'),
('Q7DS3Q7FU6', 'EFJ1C0', '1', '72E3SG', 'XGG2WG', '1', 'TV LG 32 Inch', 'H0119D006', '32LK500', 2100000, '2019-06-08', 5, 200000, 0, '636967_df2a32d8-405d-40e2-b077-a91d762e791d_720_907.png', 'Aktif'),
('QA3NI5ZS1J', 'RRVVTQ', '2', 'F9UCOM', 'XGG2WG', '1', 'Laptop Asus ROG GL503GE', 'H0419F001', 'GL503GE', 15400000, '2019-06-08', 4, 2000000, 1, '48577584_bd9234ee-d7e1-4497-904f-5f9afa4a5321_700_421.jpg', 'Aktif'),
('S1PMCSJ1O3', 'EFJ1C0', '1', '72E3SG', 'XGG2WG', '1', 'TV LG 32 Inch', 'H0119D001', '32LK500', 2100000, '2019-06-08', 5, 200000, 0, '636967_df2a32d8-405d-40e2-b077-a91d762e791d_720_907.png', 'Aktif'),
('S30461X1YV', 'CY0V9E', '1', 'LCTO5M', 'ZKASYU', '1', 'Wireless Mic Shure X2000M', 'D0119D004', 'X2000M', 1650000, '2019-06-07', 5, 100000, 1, '6620410_39b9d015-4382-4327-bff0-6403e50b61ed_1712_1180.jpeg', 'Aktif'),
('SF7D3UBU4V', '3', '4ISKF9', '10', '1', '1', 'Gitar Ibanez RX-2000 Hitam', 'F1519B001', 'RX-2000', 2000000, '2019-04-17', 4, 500000, 1, NULL, 'Aktif'),
('T13I4M0KA0', 'ZKZCZ4', '4ISKF9', 'X75EPL', '1', '1', 'Mic Dynamic AKG P5i', 'F1519D005', 'P5i', 1700000, '2019-06-07', 5, 100000, 1, 'AKG-P5i.jpg', 'Aktif'),
('THBHMDHT6I', 'CY0V9E', '1', 'LCTO5M', 'ZKASYU', '1', 'Wireless Mic Shure X2000M', 'D0119D003', 'X2000M', 1650000, '2019-06-07', 5, 100000, 1, '6620410_39b9d015-4382-4327-bff0-6403e50b61ed_1712_1180.jpeg', 'Aktif'),
('TQFTMVZ0CF', 'EFJ1C0', '1', '72E3SG', 'XGG2WG', '1', 'TV LG 32 Inch', 'H0119D003', '32LK500', 2100000, '2019-06-08', 5, 200000, 0, '636967_df2a32d8-405d-40e2-b077-a91d762e791d_720_907.png', 'Aktif'),
('UJS075PIY2', 'EFJ1C0', '1', '72E3SG', 'XGG2WG', '1', 'TV LG 32 Inch', 'H0119D007', '32LK500', 2100000, '2019-06-08', 5, 200000, 0, '636967_df2a32d8-405d-40e2-b077-a91d762e791d_720_907.png', 'Aktif'),
('W40NE4GNTM', 'TPO3S5', '6C7JBK', '076FIY', '4PDSW0', '1', 'Vario 150 eSP Merah', 'E4019N001', 'Vario 150 eSP', 24000000, '2019-06-25', 5, 3000000, 0, 'Honda-Vario-150-Tahun-2019-Matte-Red.jpg', 'Aktif'),
('WOQRMUPTB3', 'ZKZCZ4', '1', 'VJF1XQ', 'ZKASYU', '1', 'Mic Condenser AKG C1000S', 'D0119D003', 'C1000S', 2400000, '2019-06-07', 5, 100000, 1, '2356629_8afe4dd1-df76-48a5-bc89-f3acf865d23a.jpg', 'Aktif'),
('Y05YD215IY', 'EFJ1C0', '1', '72E3SG', 'XGG2WG', '1', 'TV LG 32 Inch', 'H0119D004', '32LK500', 2100000, '2019-06-08', 5, 200000, 0, '636967_df2a32d8-405d-40e2-b077-a91d762e791d_720_907.png', 'Aktif'),
('YFFFGD3EFI', 'ZKZCZ4', '1', 'VJF1XQ', 'ZKASYU', '1', 'Mic Condenser AKG C1000S', 'D0119D004', 'C1000S', 2400000, '2019-06-07', 5, 100000, 1, '2356629_8afe4dd1-df76-48a5-bc89-f3acf865d23a.jpg', 'Aktif'),
('YPFP8BH2TF', 'ZKZCZ4', '4ISKF9', 'X75EPL', '1', '1', 'Mic Dynamic AKG P5i', 'F1519D004', 'P5i', 1700000, '2019-06-07', 5, 100000, 1, 'AKG-P5i.jpg', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `ID_DETIL_PINJAM` varchar(10) NOT NULL,
  `ID_ASET` varchar(10) DEFAULT NULL,
  `ID_PEMINJAMAN` varchar(10) DEFAULT NULL,
  `CATATAN` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`ID_DETIL_PINJAM`, `ID_ASET`, `ID_PEMINJAMAN`, `CATATAN`) VALUES
('06CC2WO23S', 'SF7D3UBU4V', 'V1C6YW21UV', NULL),
('07Z2U39UCZ', 'B0E8BB7L34', 'CO9CS23KNX', NULL),
('0Q7PCF8ZLQ', 'COF8LUY4HU', 'YWHATHY5EH', 'baik'),
('1FTP73N6IW', '5HD08SHO9K', 'SR5G0OZH6F', NULL),
('2Q0NUCHBL3', 'QA3NI5ZS1J', 'YWHATHY5EH', 'baik'),
('2ZY6FLCERE', 'I1F4JT9H67', '3ON476FACW', 'baik'),
('3FRNVL696B', '0KBHNTA5TX', 'CE4QVW7WFJ', 'baik'),
('3Q1WXVFS94', 'COF8LUY4HU', 'V39PU3BH72', NULL),
('4HOLL4HOWK', 'COF8LUY4HU', 'AUUY5W5ZXV', NULL),
('526CYJLDRQ', '18BWKIPH6U', '61U9QKC9MB', NULL),
('55HNQQK9HR', '18BWKIPH6U', 'YWHATHY5EH', 'baik'),
('5IK6YXSATZ', 'COF8LUY4HU', 'CE4QVW7WFJ', 'baik'),
('64NW03GNPV', 'E4Y0Z8I9R0', 'ESTWEAMXT1', 'baik'),
('6K6BDLBRE4', '0KBHNTA5TX', '61U9QKC9MB', NULL),
('6Y26DBIO2H', 'COF8LUY4HU', '29GOR3EF55', NULL),
('74SPV7WAYO', '18BWKIPH6U', 'T8MNWK4CIG', NULL),
('7Q8GFQMDYX', 'B0E8BB7L34', 'F6LTHV8OWU', NULL),
('8IMRMBEZI5', 'I1F4JT9H67', 'YK32A1A3QA', NULL),
('9DVFNJID0K', 'COF8LUY4HU', '17WK23WWP5', 'kondisi baik'),
('AFIZCCO55X', 'COF8LUY4HU', '76N2L8BHQI', 'baik'),
('BEVGEGE1P7', 'COF8LUY4HU', '8DURVCUQSC', 'baik'),
('BLAWF8KSFW', '1D2N9E0JYM', 'XCPQ68NLTU', NULL),
('C2WJXOFKXE', 'YFFFGD3EFI', '29GOR3EF55', NULL),
('C5MO1NIJO2', 'I1F4JT9H67', 'KDAZ3GJ27Y', NULL),
('CMFWXOCZE0', 'SF7D3UBU4V', 'AUUY5W5ZXV', NULL),
('DUTMDY1KUN', 'COF8LUY4HU', '2COUAGDN6Y', NULL),
('E5Y6KSKYS9', 'SF7D3UBU4V', '76N2L8BHQI', 'senar putus'),
('GFBZXYCAAO', 'WOQRMUPTB3', '29GOR3EF55', NULL),
('GSEHRLGCT6', 'COF8LUY4HU', '66OSQJRKGU', NULL),
('GWVXBOO4X9', 'COF8LUY4HU', 'F6LTHV8OWU', NULL),
('JTYSWXED9Q', '0KBHNTA5TX', 'SR5G0OZH6F', NULL),
('MPH09VJNZJ', 'SF7D3UBU4V', '8DURVCUQSC', 'baik'),
('OQ261D19D4', '18BWKIPH6U', '960666ID9I', 'kondisi baik'),
('P0DO8SVQV2', '5HD08SHO9K', 'XCPQ68NLTU', NULL),
('Q4PZ93J32B', '18BWKIPH6U', 'Y4EZ63KM28', 'ok'),
('Q9K82MNIOG', '18BWKIPH6U', 'EQFVVX2O2T', 'baik'),
('SAY1KSDGO4', 'SF7D3UBU4V', 'Q2S2J1707C', 'baik'),
('SBGIJ0MQY1', 'IZ18SOMALH', 'N37OIPFUHJ', 'baik'),
('T506X4MO5I', 'I1F4JT9H67', 'YWHATHY5EH', 'tinta habis'),
('T88F8BZTEE', 'IZ18SOMALH', 'ESTWEAMXT1', 'perlu ganti ban'),
('T9G92349UJ', '0KBHNTA5TX', 'XCPQ68NLTU', NULL),
('TF8KWLX83M', 'QA3NI5ZS1J', 'Y4EZ63KM28', 'ok'),
('UUR0NJB6KJ', '5P4HQ0ECQF', '8DURVCUQSC', 'baik'),
('VGKBC8WMR1', 'I1F4JT9H67', 'N37OIPFUHJ', 'tinta habis'),
('VQGDU1QVNH', 'COF8LUY4HU', 'Q2S2J1707C', 'baik'),
('W3Z385LFIP', 'OKBUNQUYJY', 'YK32A1A3QA', NULL),
('WNIHAUVOYA', 'COF8LUY4HU', '6Z87ZVH9KR', NULL),
('YF3HJGDEOA', '18BWKIPH6U', 'N7GAY89S9A', NULL),
('YKBFBWW5NA', 'SF7D3UBU4V', 'K86EH9QETD', NULL),
('ZD9OM7VV0D', '18BWKIPH6U', '3ON476FACW', 'baik'),
('ZEPWJWFMQM', 'JA9UTJQ2N7', 'CO9CS23KNX', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detil_usulan_pengadaan`
--

CREATE TABLE `detil_usulan_pengadaan` (
  `ID_USULAN_TAMBAH` varchar(10) NOT NULL,
  `ID_PENGADAAN` varchar(10) NOT NULL,
  `ID_BARANG` varchar(10) NOT NULL,
  `BARANG_USULAN` varchar(50) NOT NULL,
  `HARGA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_usulan_pengadaan`
--

INSERT INTO `detil_usulan_pengadaan` (`ID_USULAN_TAMBAH`, `ID_PENGADAAN`, `ID_BARANG`, `BARANG_USULAN`, `HARGA`) VALUES
('0266DW', '5JYWGCOMK2', '4', 'Canon EOS 750D', 9500000),
('076FIY', '6FEA35OUWD', '9SVZMCDU3Z', 'Vario 150 eSP Merah', 24000000),
('1', '1', '2', 'Yamaha PSR-910', 34123123),
('10', 'U7O59FVV5C', '1', 'Gitar Ibanez', 2000000),
('134N4Z', 'BA42TDY13Q', 'HZFPYLWZKD', 'AC', 4000000),
('2', '1', '3', 'Transportasi', 131212512),
('281AX6', 'PCIKOCPWQ9', '4', 'Canon EOS 750D', 7500000),
('3', '2', '2', 'Yamaha psr', 12990000),
('4', '2', '1', 'Corgs', 1231412),
('72E3SG', 'CBMOP58VK9', 'KORQ2JSJ1N', 'TV LG 32 Inch', 2100000),
('9', 'U7O59FVV5C', '3', 'Avanza', 140000000),
('ATUPFQ', '7MVBFRFE92', 'KMMU9FHWZP', 'Printer Epson L120', 1500000),
('CJ1QMJ', 'G24ZIOQCB5', '4', 'Canon EOS 750D', 6000000),
('F9UCOM', '565RCH5L8T', 'VQ1D8ZPOPB', 'Laptop Asus ROG GL503GE', 15400000),
('H5S1UR', 'ZIIJIK57CT', '4', 'Canon EOS 750D', 8000000),
('LCTO5M', 'S00MFO1E0Z', 'TBQZ1YLZA8', 'Wireless Mic Shure X2000M', 1650000),
('LPYIYY', '1AXS2NTK7W', '8QJ70Z4FQS', 'HT Baofeng BF UV5R', 300000),
('M5HAXK', '565RCH5L8T', 'VQ1D8ZPOPB', 'Laptop Asus VivoBook X441SA', 6300000),
('VJF1XQ', 'S00MFO1E0Z', 'T5EXQ3KH87', 'Mic Condenser AKG C1000S', 2400000),
('VM8GOM', 'QQTC4HY65P', 'IGGEWK7AZ8', 'Bass Ibanez', 2500000),
('VNHMKP', '5JYWGCOMK2', '4', 'Canon EOS 3000D', 4800000),
('WHB1GX', '6FEA35OUWD', '9SVZMCDU3Z', 'Supra X 125 Hitam', 18000000),
('WHFH7S', 'CBMOP58VK9', 'Z9JEYA6ANG', 'Proyektor Epson EB-S400', 4700000),
('X75EPL', 'S00MFO1E0Z', '2QZQRINJ2N', 'Mic Dynamic AKG P5i', 1700000),
('XMN8I8', '7MVBFRFE92', 'ALX7Y7V7OC', 'Scanner Canon Lide 120', 800000),
('XZCCXX', 'QQTC4HY65P', 'AU4IEPMC2I', 'Mixer Allen & Heath Qu-24', 38000000),
('Y49C93', '4BA2CT3NEW', '1', 'Gitar Cord', 2000000),
('YTGMOQ', 'SSAXJRLWH0', '3', 'Mitsubishi L300', 300000000),
('ZDTTO1', 'N4OVYRZF0N', 'HZFPYLWZKD', 'AC Sharp', 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `detil_usulan_penghapusan`
--

CREATE TABLE `detil_usulan_penghapusan` (
  `ID_USULAN_HAPUS` varchar(10) NOT NULL,
  `ID_ASET` varchar(10) DEFAULT NULL,
  `ID_PENGHAPUSAN` varchar(10) NOT NULL,
  `CATATAN` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_usulan_penghapusan`
--

INSERT INTO `detil_usulan_penghapusan` (`ID_USULAN_HAPUS`, `ID_ASET`, `ID_PENGHAPUSAN`, `CATATAN`) VALUES
('6QLBF77JBL', '5P4HQ0ECQF', 'DFW358LVGJ', 'Tidak Aktif'),
('CE4PJ28I14', 'E4Y0Z8I9R0', '0816UDQZ0A', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `ID_KATEGORI` varchar(10) NOT NULL,
  `NAMA_KATEGORI` varchar(50) DEFAULT NULL,
  `KODE_KATEGORI` varchar(50) DEFAULT NULL,
  `STATUS_KATEGORI` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `KODE_KATEGORI`, `STATUS_KATEGORI`) VALUES
('1', 'Alat Musik', 'B', 'Aktif'),
('2', 'Transportasi', 'N', 'Aktif'),
('23LTLPLUSM', 'Komputer', 'F', 'Aktif'),
('3', 'Multimedia', 'MM', 'Aktif'),
('468TKQ0Z46', 'Peralatan K3', 'O', 'Aktif'),
('6WL9HDDQDG', 'Support Audio & Visual', 'E', 'Aktif'),
('7X5WSADGC6', 'Support Komputer', 'G', 'Aktif'),
('BKCURMOIRE', 'Peralatan K3', 'O', 'Aktif'),
('MKV6VN939J', 'Komunikasi', 'H', 'Aktif'),
('N8YFPKZNGD', 'Audio & Visual', 'D', 'Aktif'),
('S6ZP4NCYNM', 'Pendukung Kebaktian', 'R', 'Aktif'),
('SODH1U79U8', 'Lightning & Kelistrikan', 'M', 'Aktif'),
('UO1YWYN940', 'Support Alat Musik', 'C', 'Aktif'),
('UOVSQGWURM', 'Alat Kesehatan/Klinik', 'J', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `komisi_jemaat`
--

CREATE TABLE `komisi_jemaat` (
  `ID_KOMISI` varchar(6) NOT NULL,
  `NAMA_KOMISI` varchar(50) DEFAULT NULL,
  `KODE_KOMISI` varchar(10) DEFAULT NULL,
  `STATUS_KOMISI` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komisi_jemaat`
--

INSERT INTO `komisi_jemaat` (`ID_KOMISI`, `NAMA_KOMISI`, `KODE_KOMISI`, `STATUS_KOMISI`) VALUES
('04GRQP', 'Komisi Dewasa', 'A', 'Aktif'),
('1', 'Komisi Pemuda Remaja', 'F', 'Aktif'),
('2', 'Komisi Anak', 'G', 'Aktif'),
('2MR0JZ', 'P2KM', 'B', 'Aktif'),
('3', 'Komisi Senior', 'C', 'Aktif'),
('4PDSW0', 'P2SG', 'E', 'Aktif'),
('JM9K1L', 'Kantor', 'J', 'Aktif'),
('U7MEHG', 'Panitia Hari Besar (PHB)', 'I', 'Aktif'),
('XGG2WG', 'Multimedia (MM)', 'H', 'Aktif'),
('ZKASYU', 'Kolitmuger', 'D', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `nama_gereja` varchar(100) NOT NULL,
  `alamat_gereja` varchar(200) NOT NULL,
  `logo_web` text NOT NULL,
  `logo_icon` text NOT NULL,
  `logo_print` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `nama_web` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`nama_gereja`, `alamat_gereja`, `logo_web`, `logo_icon`, `logo_print`, `no_telp`, `nama_web`) VALUES
('Gereja Kristen Indonesia Sidoarjo', 'Jl. Trunojoyo No. 39A, Sidoarjo', 'logo-gki-vector-1.svg', 'logogki.ico', 'logoGKI.jpg', '031-8921922', 'GKISarpras');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `ID_MERK` varchar(6) NOT NULL,
  `NAMA_MERK` varchar(50) DEFAULT NULL,
  `STATUS_MERK` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`ID_MERK`, `NAMA_MERK`, `STATUS_MERK`) VALUES
('1', 'Yamaha', 'Aktif'),
('2', 'Toyota', 'Aktif'),
('3', 'Ibanez', 'Aktif'),
('598I4G', 'No Merk', 'Aktif'),
('5IARXF', 'Nikon', 'Aktif'),
('A4LT1H', 'Lenovo', 'Aktif'),
('CXD6FR', 'Dell', 'Aktif'),
('CY0V9E', 'Shure', 'Aktif'),
('DQRX33', 'Epson', 'Aktif'),
('EFJ1C0', 'LG', 'Aktif'),
('EFJN3X', 'BenQ', 'Aktif'),
('F60ZZN', 'Daihatsu', 'Aktif'),
('FXS1W5', 'Toyota', 'Aktif'),
('I9HADH', 'Daikin', 'Aktif'),
('MNB4I4', 'Panasonic', 'Aktif'),
('MOSJ1W', 'Mitsubishi', 'Aktif'),
('RRVVTQ', 'Asus', 'Aktif'),
('TPO3S5', 'Honda', 'Aktif'),
('TWB2Q4', 'Sennheiser', 'Aktif'),
('V5UBWT', 'Canon', 'Aktif'),
('VO9LKP', 'Samsung', 'Aktif'),
('W9XOKH', 'Roland', 'Aktif'),
('XPNBH9', 'Acer', 'Aktif'),
('XYWWG0', 'Daikin', 'Aktif'),
('ZKZCZ4', 'AKG', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `ID_NOTIF` int(11) NOT NULL,
  `TABEL_REF` varchar(50) NOT NULL,
  `ID_REF` varchar(10) NOT NULL,
  `TGL_NOTIF` datetime NOT NULL,
  `READ_NOTIF` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`ID_NOTIF`, `TABEL_REF`, `ID_REF`, `TGL_NOTIF`, `READ_NOTIF`) VALUES
(1, 'peminjaman_aset', 'CO9CS23KNX', '2019-07-16 23:06:34', 0),
(2, 'pengadaan_aset', '5JYWGCOMK2', '2019-07-17 22:45:01', 1),
(3, 'pengadaan_aset', 'SSAXJRLWH0', '2019-07-17 23:51:33', 0),
(4, 'pengadaan_aset', '1AXS2NTK7W', '2019-07-18 00:26:16', 1),
(5, 'pengadaan_aset', 'G24ZIOQCB5', '2019-07-18 00:26:22', 1),
(6, 'pengadaan_aset', 'PCIKOCPWQ9', '2019-07-18 10:24:01', 0),
(7, 'peminjaman_aset', '2COUAGDN6Y', '2020-08-30 11:08:07', 1),
(8, 'peminjaman_aset', 'V39PU3BH72', '2020-08-30 11:09:36', 1),
(9, 'peminjaman_aset', 'V1C6YW21UV', '2019-07-18 11:11:16', 1),
(10, 'pengadaan_aset', 'BA42TDY13Q', '2019-07-25 20:41:13', 0),
(11, 'peminjaman_aset', 'N7GAY89S9A', '2019-07-25 21:17:47', 1),
(12, 'peminjaman_aset', '6Z87ZVH9KR', '2019-07-26 21:48:14', 1),
(13, 'pengadaan_aset', 'ZIIJIK57CT', '2019-08-06 01:38:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaan_aset`
--

CREATE TABLE `pemeliharaan_aset` (
  `ID_PEMELIHARAAN` varchar(10) NOT NULL,
  `ID_ASET` varchar(10) DEFAULT NULL,
  `HASIL_PEMELIHARAAN` varchar(200) DEFAULT NULL,
  `BIAYA_PEMELIHARAAN` int(11) DEFAULT NULL,
  `TANGGAL_PENJADWALAN` date DEFAULT NULL,
  `BATAS_PENJADWALAN` date DEFAULT NULL,
  `TANGGAL_PEMELIHARAAN` datetime DEFAULT NULL,
  `SELESAI_PEMELIHARAAN` datetime DEFAULT NULL,
  `NOTIF` int(11) NOT NULL,
  `STATUS_PEMELIHARAAN` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemeliharaan_aset`
--

INSERT INTO `pemeliharaan_aset` (`ID_PEMELIHARAAN`, `ID_ASET`, `HASIL_PEMELIHARAAN`, `BIAYA_PEMELIHARAAN`, `TANGGAL_PENJADWALAN`, `BATAS_PENJADWALAN`, `TANGGAL_PEMELIHARAAN`, `SELESAI_PEMELIHARAAN`, `NOTIF`, `STATUS_PEMELIHARAAN`) VALUES
('3A3RRZNJTR', '67V8YNZOK9', NULL, NULL, '2020-08-29', NULL, NULL, NULL, 0, 'Aktif'),
('3LWSTLUALZ', 'A5RZ64KA9M', NULL, NULL, '2019-09-23', NULL, NULL, NULL, 1, 'Aktif'),
('5AV406OHO6', '18BWKIPH6U', 'pengecekan mainboard', 0, '2019-06-20', NULL, '2019-06-20 00:00:00', '2019-06-20 00:00:00', 1, 'Selesai'),
('8DJCOKGSJP', 'A5RZ64KA9M', 'ganti ban', 200000, '2019-07-23', NULL, '2019-07-26 00:00:00', '2019-07-27 00:00:00', 1, 'Selesai'),
('CD276MRNPY', '5P4HQ0ECQF', 'penggantian layar lcd', 100000, '2019-04-13', '2019-04-20', '2019-05-22 00:00:00', '2019-05-22 00:00:00', 0, 'Selesai'),
('CTDU0ZCY0T', '5P4HQ0ECQF', NULL, NULL, '2019-05-26', NULL, NULL, NULL, 0, 'Dihapus'),
('D6JT46P862', '178SQIVSFU', NULL, NULL, '2019-07-29', NULL, NULL, NULL, 1, 'Aktif'),
('DIE39653R7', '67V8YNZOK9', 'ganti aki', 800000, '2020-07-29', NULL, '2020-07-29 00:00:00', '2020-07-29 00:00:00', 0, 'Selesai'),
('DPOYNJK5XV', 'COF8LUY4HU', 'pengecekan & pembersihan', 0, '2019-05-18', NULL, '2019-05-27 00:00:00', '2019-05-27 00:00:00', 0, 'Selesai'),
('DRFEJS2JHA', 'IZ18SOMALH', 'ganti aki', 400000, '2019-04-18', '2019-04-25', '2019-05-01 00:00:00', '2019-05-04 00:00:00', 0, 'Selesai'),
('GSJV4UX366', '5P4HQ0ECQF', 'penggantian lcd keyboard', 250000, '2019-06-07', NULL, '2019-06-07 00:00:00', '2019-06-07 00:00:00', 0, 'Selesai'),
('GW3ERINZ91', 'IZ18SOMALH', 'ganti velg + ban depan', 600000, '2019-06-07', NULL, '2019-06-08 00:00:00', '2019-06-10 00:00:00', 1, 'Selesai'),
('K68BGPQ0H4', 'IZ18SOMALH', NULL, NULL, '2019-09-10', NULL, NULL, NULL, 1, 'Aktif'),
('KE81QU4WQR', 'SF7D3UBU4V', NULL, NULL, '2020-06-24', NULL, NULL, NULL, 0, 'Aktif'),
('LLOJ69GWMF', '5P4HQ0ECQF', NULL, NULL, '2019-06-01', NULL, NULL, NULL, 0, 'Dihapus'),
('PUAJ4OO3CG', 'E4Y0Z8I9R0', NULL, NULL, '2019-09-25', NULL, NULL, NULL, 0, 'Aktif'),
('PX0XK3FCCB', 'I1F4JT9H67', 'ganti cartridge', 150000, '2019-07-01', NULL, '2019-07-13 00:00:00', '2019-07-13 00:00:00', 1, 'Selesai'),
('PXS9NIZEZB', '5P4HQ0ECQF', NULL, NULL, '2019-05-14', NULL, NULL, NULL, 0, 'Dihapus'),
('R6E664ZJPS', 'E4Y0Z8I9R1', 'ganti oli mesin', 1200000, '2019-06-27', NULL, '2019-06-27 00:00:00', '2019-06-27 00:00:00', 1, 'Selesai'),
('S1M2QT434H', '5P4HQ0ECQF', 'Pengecekan biasa', 0, '2019-05-20', NULL, '2019-06-24 00:00:00', '2019-06-25 00:00:00', 0, 'Selesai'),
('SSGQQMRYYL', 'SF7D3UBU4V', 'ganti senar', 80000, '2019-05-31', NULL, '2019-06-24 00:00:00', '2019-06-24 00:00:00', 0, 'Selesai'),
('TEFZ4H77FP', 'I1F4JT9H67', NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, 'Aktif'),
('TS6P0SNUEY', 'E4Y0Z8I9R0', 'ganti mesin', 1400000, '2019-05-11', NULL, '2019-05-18 00:00:00', '2019-05-25 00:00:00', 0, 'Selesai'),
('V5K0FWE146', 'OKBUNQUYJY', 'perbaikan lensa proyektor', 500000, '2019-06-27', NULL, '2019-06-27 00:00:00', '2019-06-27 00:00:00', 1, 'Selesai'),
('XUZTCOY6Q1', '18BWKIPH6U', NULL, NULL, '2020-07-30', NULL, NULL, NULL, 1, 'Aktif'),
('ZL3R5QNOD5', 'E4Y0Z8I9R0', 'penggantian aki, kampas rem', 3000000, '2019-04-15', '2019-04-20', '2019-05-01 00:00:00', '2019-05-01 00:00:00', 0, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaan_berkala`
--

CREATE TABLE `pemeliharaan_berkala` (
  `ID_PENJADWALAN` varchar(10) NOT NULL,
  `ID_ASET` varchar(10) NOT NULL,
  `PILIHAN` varchar(20) NOT NULL,
  `FREKUENSI` varchar(10) DEFAULT NULL,
  `JARAK_INTERVAL` int(11) DEFAULT NULL,
  `STATUS_BERKALA` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemeliharaan_berkala`
--

INSERT INTO `pemeliharaan_berkala` (`ID_PENJADWALAN`, `ID_ASET`, `PILIHAN`, `FREKUENSI`, `JARAK_INTERVAL`, `STATUS_BERKALA`) VALUES
('1VDEGOO66E', '67V8YNZOK9', 'bulan', NULL, NULL, 'Aktif'),
('8G5I0JR0EL', 'IZ18SOMALH', 'custom', 'Bulan', 3, 'Aktif'),
('FPY0W4LHVI', 'SF7D3UBU4V', 'tahun', NULL, NULL, 'Aktif'),
('HOJMECMU6Y', 'E4Y0Z8I9R0', 'custom', 'Bulan', 4, 'Aktif'),
('K1NK66RQHR', 'COF8LUY4HU', 'bulan', NULL, NULL, 'Aktif'),
('KPCN6AGWWU', 'A5RZ64KA9M', 'custom', 'Bulan', 2, 'Aktif'),
('UL1R08TQTK', '178SQIVSFU', 'custom', 'Bulan', 3, 'Aktif'),
('UWAKFTEE0Y', 'I1F4JT9H67', 'awal_bulan', NULL, NULL, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_aset`
--

CREATE TABLE `peminjaman_aset` (
  `ID_PEMINJAMAN` varchar(10) NOT NULL,
  `ID_USER` varchar(10) NOT NULL,
  `ID_KOMISI` varchar(6) DEFAULT NULL,
  `NAMA_PEMINJAM` varchar(30) DEFAULT NULL,
  `NO_HP` varchar(20) DEFAULT NULL,
  `KETERANGAN_PINJAM` varchar(200) DEFAULT NULL,
  `HASIL_PENGAJUAN` varchar(10) DEFAULT NULL,
  `TANGGAL_PENGAJUAN` datetime DEFAULT NULL,
  `TANGGAL_PEMINJAMAN` date DEFAULT NULL,
  `TANGGAL_PENGEMBALIAN` date DEFAULT NULL,
  `REALISASI_PENGEMBALIAN` datetime DEFAULT NULL,
  `STATUS_PEMINJAMAN` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman_aset`
--

INSERT INTO `peminjaman_aset` (`ID_PEMINJAMAN`, `ID_USER`, `ID_KOMISI`, `NAMA_PEMINJAM`, `NO_HP`, `KETERANGAN_PINJAM`, `HASIL_PENGAJUAN`, `TANGGAL_PENGAJUAN`, `TANGGAL_PEMINJAMAN`, `TANGGAL_PENGEMBALIAN`, `REALISASI_PENGEMBALIAN`, `STATUS_PEMINJAMAN`) VALUES
('17WK23WWP5', '4', '1', 'Anel', '0987654321', 'wasdfgh', 'Diterima', '2019-04-12 01:48:37', '2019-04-25', '2019-04-27', '2019-05-16 00:00:00', 'Aktif'),
('29GOR3EF55', 'ADSHJ128SD', '3', NULL, '082113130251', 'acara lansia', 'Ditolak', '2019-06-07 11:44:16', '2019-07-01', '2019-07-03', NULL, 'Aktif'),
('2COUAGDN6Y', 'JNOZ120MX4', '04GRQP', NULL, '081232457234', 'buat acara agustusan', 'Diterima', '2020-08-30 11:07:23', '2020-08-31', '2020-09-01', NULL, 'Aktif'),
('3ON476FACW', 'AJHDAJ1289', '1', NULL, '088228481240', 'keperluan kesekretariatan retret', 'Diterima', '2019-06-07 05:13:27', '2019-06-26', '2019-06-28', '2019-06-29 00:00:00', 'Aktif'),
('61U9QKC9MB', 'JNOZ120MX4', '04GRQP', NULL, '0989283618', 'coba pinjam', 'Pending', '2019-07-18 11:13:16', '2019-07-19', '2019-07-20', NULL, 'Aktif'),
('66OSQJRKGU', 'JNOZ120MX4', '04GRQP', NULL, '0987654321', 'coba keyoboard', 'Ditolak', '2019-05-28 19:32:04', '2019-05-28', '2019-05-28', NULL, 'Aktif'),
('6Z87ZVH9KR', '4', '2MR0JZ', NULL, '08553099099', 'acara p2km', 'Diterima', '2019-07-26 21:47:11', '2019-07-31', '2019-08-01', NULL, 'Aktif'),
('76N2L8BHQI', '5', '04GRQP', NULL, '083856181054', 'testing', 'Diterima', '2019-05-21 15:57:57', '2019-06-01', '2019-06-08', '2019-06-15 00:00:00', 'Aktif'),
('8DURVCUQSC', '4', '2', NULL, '08998111648', 'Untuk persiapan acara', 'Diterima', '2019-05-15 11:25:54', '2019-05-22', '2019-05-29', '2019-06-03 00:00:00', 'Aktif'),
('960666ID9I', 'ADSHJ128SD', 'XGG2WG', NULL, '09876542341', 'editing video', 'Diterima', '2019-06-13 02:12:01', '2019-06-26', '2019-06-27', '2019-06-27 00:00:00', 'Aktif'),
('AUUY5W5ZXV', 'JNOZ120MX4', '04GRQP', NULL, '0987654321', 'latihan KA', 'Ditolak', '2019-05-28 19:18:57', '2019-05-28', '2019-05-28', NULL, 'Aktif'),
('CE4QVW7WFJ', 'ADSHJ128SD', '1', NULL, '081232457234', 'untuk acara retret', 'Diterima', '2019-06-27 15:47:14', '2019-07-01', '2019-07-06', '2019-07-08 00:00:00', 'Aktif'),
('CO9CS23KNX', '5', '1', NULL, '0787574123', 'mengisi pujian', 'Diterima', '2019-07-09 14:52:52', '2019-07-27', '2019-07-28', NULL, 'Aktif'),
('EQFVVX2O2T', 'ADSHJ128SD', '04GRQP', NULL, '081232457234', 'ngedit video', 'Diterima', '2019-06-27 16:00:30', '2019-06-28', '2019-06-29', '2019-06-29 00:00:00', 'Aktif'),
('ESTWEAMXT1', 'JNOZ120MX4', 'U7MEHG', NULL, '082113130251', 'transportasi pembicara', 'Diterima', '2019-05-28 17:34:53', '2019-05-30', '2019-06-01', '2019-06-05 00:00:00', 'Aktif'),
('F6LTHV8OWU', '4', '2', NULL, '089754221114', 'Latihan solo vokal', 'Diterima', '2019-07-06 06:48:59', '2019-07-31', '2019-08-02', NULL, 'Aktif'),
('K86EH9QETD', 'JNOZ120MX4', '2', NULL, '', 'acara KA', 'Ditolak', '2019-05-28 17:38:14', '2019-05-29', '2019-05-30', NULL, 'Aktif'),
('KDAZ3GJ27Y', 'JNOZ120MX4', '04GRQP', NULL, '', '', 'Ditolak', '2019-05-28 18:28:41', '2019-05-28', '2019-05-28', NULL, 'Aktif'),
('N37OIPFUHJ', 'JNOZ120MX4', '2MR0JZ', NULL, '082113130251', 'acara baksos', 'Diterima', '2019-05-28 17:28:13', '2019-05-28', '2019-05-31', '2019-06-05 00:00:00', 'Aktif'),
('N7GAY89S9A', '4', '1', NULL, '08553099099', 'tes pinjem', 'Diterima', '2019-07-25 21:09:55', '2019-07-26', '2019-07-31', NULL, 'Aktif'),
('Q2S2J1707C', 'JNOZ120MX4', '04GRQP', NULL, '082113130251', 'lomba kpr', 'Diterima', '2019-05-28 17:29:32', '2019-05-31', '2019-06-01', '2019-06-03 00:00:00', 'Aktif'),
('SR5G0OZH6F', 'AJHDAJ1289', '04GRQP', NULL, '0982471824', 'coba', 'Pending', '2019-07-23 21:45:03', '2019-07-27', '2019-07-28', NULL, 'Aktif'),
('T8MNWK4CIG', 'JNOZ120MX4', '3', NULL, '09892161', 'pembuatan laporan komisi senior', 'Ditolak', '2019-07-09 02:11:13', '2019-07-16', '2019-07-17', NULL, 'Aktif'),
('V1C6YW21UV', 'JNOZ120MX4', '04GRQP', NULL, '081232457234', 'main gitar', 'Diterima', '2019-07-18 11:10:58', '2019-07-19', '2019-07-20', NULL, 'Aktif'),
('V39PU3BH72', 'JNOZ120MX4', '04GRQP', NULL, '081232457234', 'acara rumah', 'Diterima', '2020-08-30 11:09:03', '2020-09-03', '2020-09-05', NULL, 'Aktif'),
('XCPQ68NLTU', 'ADSHJ128SD', '1', NULL, '098765121324', 'acara pemuda remaja', 'Ditolak', '2019-06-13 02:00:41', '2019-06-22', '2019-06-24', NULL, 'Aktif'),
('Y4EZ63KM28', 'JNOZ120MX4', '2', NULL, '091236714287', 'editing video komisi anak', 'Diterima', '2019-06-13 04:50:11', '2019-07-06', '2019-07-07', '2019-07-08 00:00:00', 'Aktif'),
('YK32A1A3QA', 'AJHDAJ1289', '2MR0JZ', NULL, '08978542', 'testing proyek', 'Ditolak', '2019-07-09 02:56:27', '2019-07-17', '2019-07-19', NULL, 'Aktif'),
('YWHATHY5EH', '4', '1', NULL, '081935012351', 'edit video myfaith mystory', 'Diterima', '2019-07-04 23:47:18', '2019-07-15', '2019-07-17', '2019-07-17 00:00:00', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_aset`
--

CREATE TABLE `pengadaan_aset` (
  `ID_PENGADAAN` varchar(10) NOT NULL,
  `ID_USER` varchar(10) DEFAULT NULL,
  `KETERANGAN_USULAN` varchar(200) DEFAULT NULL,
  `TANGGAL_USULAN` datetime DEFAULT NULL,
  `TANGGAL_MODIFIKASI` datetime DEFAULT NULL,
  `TANGGAL_APPROVE` datetime DEFAULT NULL,
  `HASIL_APPROVAL` varchar(10) DEFAULT NULL,
  `STATUS_USULAN` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan_aset`
--

INSERT INTO `pengadaan_aset` (`ID_PENGADAAN`, `ID_USER`, `KETERANGAN_USULAN`, `TANGGAL_USULAN`, `TANGGAL_MODIFIKASI`, `TANGGAL_APPROVE`, `HASIL_APPROVAL`, `STATUS_USULAN`) VALUES
('1', '3', 'Usulan 1', '2019-03-25 01:15:47', '2019-03-25 01:15:47', '2019-03-27 00:00:00', 'Diterima', 'Aktif'),
('1AXS2NTK7W', '3', 'untuk komunikasi antar panitia/petugas multimedia', '2019-06-24 16:58:10', NULL, '2019-07-18 00:26:16', 'Diterima', 'Aktif'),
('2', '3', 'Usulan ke 2', '2019-03-26 13:40:53', '2019-03-26 13:40:53', '2019-03-29 00:00:00', 'Ditolak', 'Aktif'),
('4BA2CT3NEW', '3', 'untuk pemuda', '2019-04-18 16:04:56', NULL, NULL, 'Diterima', 'Aktif'),
('565RCH5L8T', '67ZM8J5L5S', 'keperluan kantor dan multimedia untuk editing', '2019-06-06 23:45:21', NULL, '2019-06-06 23:45:30', 'Diterima', 'Aktif'),
('5JYWGCOMK2', '3', 'keperluan multimedia untuk dokumentasi', '2019-06-24 16:20:45', NULL, '2019-07-17 22:45:01', 'Diterima', 'Aktif'),
('6FEA35OUWD', 'B1M4SPOQ78', 'untuk mobilitas pendeta', '2019-06-24 17:26:43', NULL, '2019-06-25 00:00:00', 'Diterima', 'Aktif'),
('7MVBFRFE92', 'B1M4SPOQ78', 'keperluan kantor gereja', '2019-05-23 23:52:35', NULL, '2019-05-24 14:54:31', 'Diterima', 'Aktif'),
('BA42TDY13Q', 'B1M4SPOQ78', 'Mitsuhshi 2PK non converter', '2019-07-25 20:39:55', NULL, '2019-07-25 20:41:13', 'Diterima', 'Aktif'),
('CBMOP58VK9', '67ZM8J5L5S', 'untuk menampilkan teks lagu/kebutuhan presentasi', '2019-06-07 00:17:18', NULL, '2019-06-07 00:18:34', 'Diterima', 'Aktif'),
('G24ZIOQCB5', 'B1M4SPOQ78', 'kebutuhan acara paskah', '2019-06-25 14:43:32', NULL, '2019-07-18 00:26:22', 'Diterima', 'Aktif'),
('N4OVYRZF0N', '67ZM8J5L5S', 'AC 2PK', '2019-07-26 00:25:03', NULL, NULL, 'Pending', 'Aktif'),
('PCIKOCPWQ9', '67ZM8J5L5S', 'untuk foto acara gereja baru', '2019-07-18 10:23:36', NULL, '2019-07-18 10:24:01', 'Diterima', 'Aktif'),
('QQTC4HY65P', '3', 'keperluan ibadah', '2019-06-13 00:41:57', NULL, '2019-06-25 01:14:06', 'Diterima', 'Aktif'),
('S00MFO1E0Z', 'B1M4SPOQ78', 'kebutuhan kantoria dan paduan suara', '2019-06-06 23:25:32', NULL, '2019-06-06 23:26:20', 'Diterima', 'Aktif'),
('SSAXJRLWH0', '67ZM8J5L5S', 'transportasi massal', '2019-06-25 14:15:13', NULL, '2019-07-17 23:51:33', 'Diterima', 'Aktif'),
('U7O59FVV5C', '3', 'Untuk keperluan pemuda', '2019-04-15 09:11:50', NULL, NULL, 'Diterima', 'Aktif'),
('ZIIJIK57CT', '67ZM8J5L5S', 'penambahan untuk dokumentasi', '2019-07-26 00:29:32', NULL, '2019-08-06 01:38:26', 'Diterima', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `penghapusan_aset`
--

CREATE TABLE `penghapusan_aset` (
  `ID_PENGHAPUSAN` varchar(10) NOT NULL,
  `ID_USER` varchar(10) DEFAULT NULL,
  `TANGGAL_USULAN` datetime DEFAULT NULL,
  `KETERANGAN_PENGHAPUSAN` varchar(200) DEFAULT NULL,
  `TANGGAL_PENGHAPUSAN` date DEFAULT NULL,
  `HASIL_APPROVAL` varchar(10) DEFAULT NULL,
  `TANGGAL_APPROVAL` datetime DEFAULT NULL,
  `STATUS_USULAN` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penghapusan_aset`
--

INSERT INTO `penghapusan_aset` (`ID_PENGHAPUSAN`, `ID_USER`, `TANGGAL_USULAN`, `KETERANGAN_PENGHAPUSAN`, `TANGGAL_PENGHAPUSAN`, `HASIL_APPROVAL`, `TANGGAL_APPROVAL`, `STATUS_USULAN`) VALUES
('0816UDQZ0A', '67ZM8J5L5S', '2019-07-29 10:49:52', 'sering rusak', NULL, 'Pending', NULL, 'Aktif'),
('DFW358LVGJ', '3', '2019-05-17 05:09:58', 'rusak total', '2019-05-27', 'Diterima', '2019-05-26 00:00:00', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `ID_RUANGAN` varchar(6) NOT NULL,
  `NAMA_RUANGAN` varchar(50) DEFAULT NULL,
  `KODE_RUANGAN` varchar(10) DEFAULT NULL,
  `STATUS_RUANGAN` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`ID_RUANGAN`, `NAMA_RUANGAN`, `KODE_RUANGAN`, `STATUS_RUANGAN`) VALUES
('1', 'Gereja Lt-1 R Kebaktian', '01', 'Aktif'),
('1Y4VCO', 'Gereja  Lt-1  R2 (R kesehatan)', '03', 'Aktif'),
('2', 'Gereja  Lt-1  R3 (kantor)', '04', 'Aktif'),
('4ISKF9', 'Gereja  Lt-2  R KPR', '15', 'Aktif'),
('53LWNE', 'Gereja Lt-1 R1 (konsistori)', '02', 'Aktif'),
('6C4NML', 'Gereja Lt-2 Kamar Tidur', '13', 'Aktif'),
('6C7JBK', 'Pastori 1', '40', 'Aktif'),
('9V81UY', 'Gereja  Lt-2 R Rapat', '11', 'Aktif'),
('B6971A', 'Gereja R6  Lt-1 (Gudang)', '06', 'Aktif'),
('F7D42F', 'Gereja Lt-2 Gudang', '16', 'Aktif'),
('PCHXOQ', 'Pastori 2', '50', 'Aktif'),
('WFW3PI', 'Gereja  Lt-2 R Perpus', '12', 'Aktif'),
('XH8GJQ', 'Gereja  Lt-1 R4 (dapur)', '05', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `ID_STATUS` varchar(10) NOT NULL,
  `NAMA_STATUS` varchar(20) DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID_STATUS`, `NAMA_STATUS`, `STATUS`) VALUES
('1', 'Aktif', 'Aktif'),
('2', 'Tidak Aktif', 'Aktif'),
('3', 'Rusak', 'Aktif'),
('4', 'Maintenance', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` varchar(10) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `NAMA_LENGKAP` varchar(50) DEFAULT NULL,
  `ROLE` varchar(20) NOT NULL,
  `FOTO_USER` text,
  `KETERANGAN` varchar(50) DEFAULT NULL,
  `STATUS_USER` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA_LENGKAP`, `ROLE`, `FOTO_USER`, `KETERANGAN`, `STATUS_USER`) VALUES
('1', 'admin', 'admin', 'Admin', 'Administrator', 'user2-160x160.jpg', 'Hak akses penuh', 'Tidak Aktif'),
('2', 'ketuamj', 'ketuamj', 'Pak Ketua', 'Ketua MJ', 'user2-160x160.jpg', 'Untuk melihat laporan', 'Aktif'),
('3', 'mjbid4', 'mjbid4', 'Pak Anggota', 'Anggota MJ', 'user2-160x160.jpg', 'Untuk transaksi aset', 'Aktif'),
('4', 'kpr', 'kpr', 'Daniel', 'Peminjam', 'user2-160x160.jpg', 'Untuk peminjaman (KPR)', 'Aktif'),
('5', 'ka', 'ka', 'Raysa', 'Peminjam', 'user2-160x160.jpg', 'Untuk peminjaman (KA)', 'Aktif'),
('67ZM8J5L5S', 'dhani', 'dhani', 'Dhani', 'Anggota MJ', 'user2-160x160.jpg', NULL, 'Aktif'),
('ADSHJ128SD', 'piyo', 'piyo', 'Olivia', 'Peminjam', 'user2-160x160.jpg', NULL, 'Aktif'),
('AJHDAJ1289', 'ruth', 'ruth', 'Daniella Ruth', 'Peminjam', 'user2-160x160.jpg', NULL, 'Aktif'),
('B1M4SPOQ78', 'anggota', 'anggota', 'Pak ANggota 2', 'Anggota MJ', 'user2-160x160.jpg', NULL, 'Aktif'),
('JNOZ120MX4', 'ongky', 'ongky', 'Ongky', 'Peminjam', 'user2-160x160.jpg', NULL, 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`);

--
-- Indexes for table `daftar_aset`
--
ALTER TABLE `daftar_aset`
  ADD PRIMARY KEY (`ID_ASET`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`ID_DETIL_PINJAM`);

--
-- Indexes for table `detil_usulan_pengadaan`
--
ALTER TABLE `detil_usulan_pengadaan`
  ADD PRIMARY KEY (`ID_USULAN_TAMBAH`);

--
-- Indexes for table `detil_usulan_penghapusan`
--
ALTER TABLE `detil_usulan_penghapusan`
  ADD PRIMARY KEY (`ID_USULAN_HAPUS`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indexes for table `komisi_jemaat`
--
ALTER TABLE `komisi_jemaat`
  ADD PRIMARY KEY (`ID_KOMISI`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`ID_MERK`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`ID_NOTIF`);

--
-- Indexes for table `pemeliharaan_aset`
--
ALTER TABLE `pemeliharaan_aset`
  ADD PRIMARY KEY (`ID_PEMELIHARAAN`);

--
-- Indexes for table `pemeliharaan_berkala`
--
ALTER TABLE `pemeliharaan_berkala`
  ADD PRIMARY KEY (`ID_PENJADWALAN`);

--
-- Indexes for table `peminjaman_aset`
--
ALTER TABLE `peminjaman_aset`
  ADD PRIMARY KEY (`ID_PEMINJAMAN`);

--
-- Indexes for table `pengadaan_aset`
--
ALTER TABLE `pengadaan_aset`
  ADD PRIMARY KEY (`ID_PENGADAAN`);

--
-- Indexes for table `penghapusan_aset`
--
ALTER TABLE `penghapusan_aset`
  ADD PRIMARY KEY (`ID_PENGHAPUSAN`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`ID_RUANGAN`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID_STATUS`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `ID_NOTIF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
