-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Jun 2023 pada 08.56
-- Versi server: 10.3.38-MariaDB-cll-lve
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhadri_tubes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category` char(10) NOT NULL,
  `img` char(100) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `category`, `img`, `detail`) VALUES
(1, 'Man', '645102b787dc8.png', 'Nike hadir dengan produk keren dan inovatif untuk pria yang aktif dan ingin tampil stylish sekaligus nyaman. Dapatkan segera produk Nike untuk pria Anda dan rasakan pengalaman olahraga atau sehari-hari yang lebih baik. Mari tampil gaya dengan Nike!'),
(2, 'Woman', '645102d9cf251.png', '\r\nNike menghadirkan produk-produk stylish dan inovatif yang dibuat khusus untuk memenuhi kebutuhan para wanita yang aktif dan ingin tampil modis sekaligus nyaman. Dapatkan segera produk Nike untuk wanita Anda dan nikmati pengalaman olahraga atau sehari-hari yang lebih baik. Yuk, tampil percaya diri dan fashionable dengan Nike!'),
(3, 'Kids', '645103ef5ee81.png', 'Nike mempersembahkan produk-produk keren dan fungsional untuk anak-anak yang ingin tampil stylish sekaligus nyaman saat beraktivitas. Dapatkan segera produk Nike untuk anak-anak Anda dan biarkan mereka menikmati pengalaman berolahraga atau beraktivitas sehari-hari yang menyenangkan dan menyehatkan. Yuk, beraktivitas dengan gaya bersama Nike!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id_transaksi` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `feedback_text` text NOT NULL,
  `feedback_rating` int(11) DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id_transaksi`, `id_product`, `feedback_text`, `feedback_rating`, `feedback_date`) VALUES
(984135085, 8, 'Bahannya enak di tangan!', 5, '2023-05-21 15:22:32'),
(523462148, 8, 'sekarang buruk', 1, '2023-05-21 15:23:29'),
(498816011, 17, 'Bahannya nyaman dan enak untuk dipakai semingguan!', 5, '2023-05-21 16:52:26'),
(1287620196, 13, 'Mirip Hans Di FF', 5, '2023-05-21 23:03:34'),
(1895774437, 6, 'Cewe gw', 5, '2023-05-21 23:13:27'),
(1677813965, 14, 'Sempit banget, pengeriman lambat, packing rusak', 2, '2023-05-21 23:16:38'),
(1272481284, 12, 'Udh sempit,beli kebanyakan,mahal pula,pajaknya 11% tai,mending beli di glodok ', 1, '2023-05-21 23:17:38'),
(473678674, 12, 'keren ', 5, '2023-06-11 11:56:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_transaksi` int(11) NOT NULL,
  `payment_method` char(255) NOT NULL,
  `payment_code` char(255) NOT NULL,
  `transaction_status` char(255) NOT NULL,
  `status_code` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_transaksi`, `payment_method`, `payment_code`, `transaction_status`, `status_code`) VALUES
(2041946031, 'bni', '9885424201985275', 'paid', '200'),
(498816011, 'bca', '54242931564', 'paid', '200'),
(984135085, 'bca', '54242107109', 'paid', '200'),
(425534051, 'qris', '8bfb04ec-c936-4c0b-8d9e-76744fdd100c', 'expire', '407'),
(200459724, 'bca', '54242923968', 'cancel', '200'),
(2073314413, 'qris', '0dda56a7-5756-4e66-8489-4adbe478e911', 'expire', '407'),
(523462148, 'bca', '54242484417', 'paid', '200'),
(1287620196, 'bni', '9885424284771441', 'paid', '200'),
(1907838938, 'qris', '43c04d69-64d9-4a1e-bbf0-37349570ae5d', 'cancel', '200'),
(1677813965, 'echannel', '70012774047376074', 'paid', '200'),
(1895774437, 'bca', '54242350173', 'paid', '200'),
(1272481284, 'bca', '54242144204', 'paid', '200'),
(1452292489, '0', '0', '0', '0'),
(2132128110, 'bca', '54242030917', 'paid', '200'),
(1872301418, 'qris', '4d6f38f9-b68d-47e2-a337-43ff8a921ed1', 'cancel', '200'),
(984641489, 'bca', '54242309149', 'expire', '407'),
(169013750, 'qris', '50f94e69-6934-4005-9a4f-27ccd41f5292', 'expire', '407'),
(1032591827, '0', '0', '0', '0'),
(1808100567, 'qris', 'e6f474c0-0138-4911-81e1-a08f88b9e20b', 'expire', '407'),
(213305193, 'bni', '9885424249532563', 'cancel', '200'),
(744294352, 'gopay', '-', 'paid', '200'),
(1294827599, 'bca', '54242493899', 'cancel', '200'),
(512507881, 'bca', '54242446932', 'cancel', '200'),
(1173645280, 'qris', '32816c5d-e7c4-4bb3-9a51-77d1e1c1d3ee', 'cancel', '200'),
(403370907, 'qris', '3477928d-eda6-4406-ad1a-f310daa64ba9', 'expire', '407'),
(473678674, 'bca', '54242015711', 'paid', '200'),
(68544316, 'bni', '9885424213609157', 'cancel', '200'),
(2049938318, '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product` char(255) NOT NULL,
  `img` char(100) NOT NULL,
  `detail` text NOT NULL,
  `price` int(11) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_ukuran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `product`, `img`, `detail`, `price`, `id_category`, `id_ukuran`) VALUES
(1, 'Nike Sportswear A.I.R. Icon Fleece', '64510e64bc490.jpg', '<p>Love hoodies? Duh, silly question because who doesn&#39;t? This Nike Sportswear hoodie is made from soft, cosy fleece. Those super-colourful graphics are designed by our artist-in-residence (AIR). The Nike FlyEase front pocket makes sure your things never fall out while you move around. And there&#39;s even a name tag so you can personalise it with your preferred name and identity&mdash;the choice is always yours.</p>\r\n\r\n<ul>\r\n	<li>Colour Shown: Black</li>\r\n	<li>Style: DX5032-010</li>\r\n</ul>\r\n', 799999, 3, 1),
(2, 'Nike Culture of Basketball', '64510e91a3745.png', '<p>The Nike Culture of Basketball hoodie is made for all types of ballers from serious hoopers to those who just love the game. Soft fleece means it&#39;s super-comfy, plus mesh adds a hoops-like feel. The loose fit gives a roomy feel so you can move freely going to and from the courts.</p>\r\n', 599999, 3, 1),
(3, 'Nike Dri-FIT Run Division Rise 365', '64510ea558d65.jpg', 'A warm breeze meets cool speed in this sweat-wicking Rise 365 Tank. It&#039;s a spin on our racing vest with a relaxed, lightweight and breathable feel for those hot runs. We gave it the Run Division treatment with reflective-design elements and a pouch pocket that lets you pack the shirt away when you need to layer down.', 649000, 1, 1),
(4, 'Nike Dri-FIT ADV TechKnit Ultra', '64510ec10e5a4.png', 'Light like air. Cool like a breeze. The Nike Dri-FIT ADV TechKnit Ultra Top uses breathable, sweat-wicking technology to help keep the heat out and let you focus on the road ahead. Its advanced design is geared for movement, so you can fly freely through your stride. This product is made from 100% recycled polyester fibres.', 819000, 1, 1),
(5, 'Nike Swoosh On The Run', '64510ecd111de.png', 'Feel confident and go all out without having to leave anything behind in this medium-support sports bra. 3 mesh-lined pockets hold your phone, a snack or an extra layer so you can explore without limits. The lightweight, sewn-in spacer lining feels breathable while still giving you a little coverage, and sweat-wicking tech helps you keep your cool on the run.', 859000, 2, 1),
(6, 'Nike Dri-FIT ADV Run Division', '64510ee32495f.jpeg', 'Cool weather shouldn&#039;t keep you from your run. This wool top delivers lightweight warmth and sweat-wicking performance to help keep you comfortable and dry from start to finish.', 1169000, 2, 1),
(7, 'Nike ACG Women&#039;s Short-Sleeve T-Shirt', '64510f02b5ec1.png', '<p>Loose, roomy, outdoor ready. The Nike ACG T-Shirt keeps things comfy for the journey. This product is made from 100% sustainable materials, using a blend of both recycled polyester and organic cotton fibres. The blend is at least 10% recycled fibres or at least 10% organic cotton fibres.</p>\r\n\r\n<ul>\r\n	<li>Colour Shown: Cobalt Bliss/Summit White</li>\r\n	<li>Style: DJ3647-415</li>\r\n</ul>\r\n', 429000, 2, 1),
(8, 'Nike Sportswear Essentials Women&#039;s Woven Varsity Bomber Jacket', '64510f1d318d0.png', '<p>In this lightweight, loose-fitting bomber, you can cover up without hiding your style. Smooth Ripstop fabric is structured but sheer, so you can let your favourite prints and colours shine through.</p>\r\n\r\n<ul>\r\n	<li>Colour Shown: White/Black</li>\r\n	<li>Style: DV7973-100</li>\r\n</ul>\r\n', 1599000, 2, 1),
(9, 'Nike Dri-FIT Run Division Women&#039;s Short-Sleeve Running Top', '64510f369505a.jpg', 'Set your own pace in this easy-fitting top. Crafted from a lightweight wool blend that helps keep you cool and dry in warm weather, it&#039;s great worn on its own or layered on brisk mornings.\r\n', 949000, 2, 1),
(10, 'Nike Pegasus 40 Women&#039;s Road Running Shoes', '64511012103c6.png', 'A springy ride for every run, the Peg&#039;s familiar, just-for-you feel returns to help you accomplish your goals. This version has the same responsiveness and neutral support you love but with improved comfort in those sensitive areas of your foot, like the arch and toes. Whether you&#039;re logging long marathon miles, squeezing in a speed session before the sun goes down or hopping into a spontaneous group jaunt, it&#039;s still the established road runner you can put your faith in, day after day, run after run.\r\n', 2099000, 2, 2),
(11, 'Nike ACG Storm-FIT', '64511031246b7.png', 'Open your pack and grab this lightweight, waterproof jacket when wind and rain make their way into your adventure. Cinch the hood and hem to keep the storm out and your focus on fun. When the storm calls it quits, pack the jacket into its own pocket and throw it in your bag for the next round.\r\n', 2099000, 2, 1),
(12, 'Nike Air Force 1 React Men&#039;s Shoes', '6451104bdb8ed.png', 'Split your time between classic and new with this fresh, off-court look. Fusing modern comfort with hoops style, the AF-1 React delivers a futuristic sensation. Its responsive foam midsole puts tech in the perfect position, while the rich mixture of materials add a translucent touch to the storied Basketball shoe.', 2249000, 1, 2),
(13, 'Nike Sportswear Premium Essentials Men&#039;s T-Shirt', '6451109a8c357.png', 'The Nike Sportswear Premium Essentials T-Shirt has a loose fit for a carefree, comfortable look. Its heavyweight organic cotton fabric feels thick and soft. This product is made from at least 75% organic cotton fibres.', 499000, 1, 1),
(14, 'Jordan Series ES Men&#039;s Shoes', '645110a4d748d.png', '<p>Inspired by Mike&#39;s backyard battles with his older brother Larry, the Jordan Series references their legendary sibling rivalry throughout the design. The rubber sole offers more than just impressive traction&mdash;it also tells the story of how MJ came to be #23. Look for the hidden reminder to &quot;Swing for the Fence&quot;, a direct quote from Larry to his little bro.</p>\r\n\r\n<ul>\r\n	<li>Colour Shown: Alligator/Sail</li>\r\n	<li>Style: DN1856-300</li>\r\n</ul>\r\n', 1299000, 1, 2),
(15, 'Nike Dri-FIT Run Division Stride Men&#039;s Running Shorts', '645110ae2a72a.png', 'Our Stride shorts are made to move, with a soft outer layer and a stretchy inner layer that go together to give you support and comfort. We gave them the Run Division treatment, with reflective design graphics and a back pocket that can hold a top when you need to layer down.', 829000, 1, 1),
(16, 'Nike Invincible 3 Men&#039;s Road Running Shoes', '645114ac1188b.png', 'With maximum cushioning to support every mile, the Invincible 3 gives you our highest level of comfort underfoot to help you stay on your feet today, tomorrow and beyond. Designed to help keep you on the run, it&#039;s super supportive and bouncy, so that you can propel down your preferred path and come back for your next run feeling ready and reinvigorated.', 2849000, 1, 2),
(17, 'Nike Sportswear Older Kids&#039; (Girls&#039;) Crop T-Shirt', '645114b764490.png', 'Cropped tees = LOVE. Forever. This Nike tee is made from soft cotton that&#039;s comfy to rock all day long. Pro tip: Match this crop top with high-waisted bottoms, and your easy-made outfit is ready to go.', 269000, 3, 1),
(18, 'Nike Air Zoom Pegasus 40 Older Kids&#039; Road Running Shoes', '645114c03b3be.png', '40 years. Generations of running. The Pegasus 40 reps the past and future of Nike Running. Whether you&#039;re gearing up for a school athletics competition, athletics training or fun runs (like your gym class mile), this shoe is for runners of all levels. They&#039;re breathable so your feet stay cool with every lap. Zoom Air and bouncy foam team up for the cushioning you need to feel comfortable with every stride. It&#039;s time to fly!', 1399000, 3, 2),
(19, 'Nike Sportswear Older Kids&#039; (Girls&#039;) Woven Jacket', '645114cc13b9c.png', 'Tracksuit jackets are awesome. Why? You can wear them at school, the park or wherever you go. Casual enough that you can pair it with almost anything. And it&#039;s lightweight, loose fitting and durable a layer you&#039;ll love to rock. Plus, it&#039;s stamped by the Swoosh on both sides for double the approval.', 699000, 3, 2),
(20, 'Nike Sportswear Older Kids&#039; T-Shirt', '645114d9c69cd.png', 'We got inspired by kid artists like you in creating this Nike tee. Fun and colourful, you&#039;ll want to wear this anywhere and everywhere. And oh, oh! Check out the name tag on the bottom. Be creative write your name with pens, markers, whatever you like. We wanna see your artsy side come out.', 319000, 3, 1),
(21, 'Nike Team Hustle D 11 Older Kids&#039; Basketball Shoes', '645114e21cabd.png', '<p>Ready for new basketball shoes? How about for gym class or just playing outside? Meet the Nike Team Hustle D 11. With this edition of our Team Hustle D series, our top priority is kicks that are super easy to get on and off. Elastic laces give you a wide opening while a big strap secures your fit. Plus, you get plush cushioning. The ultimate basketball and playtime shoe is back and ready to play.</p>\r\n', 899000, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `jenis` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id_role`, `jenis`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `id_users`, `status`) VALUES
(68544316, '2023-06-11 12:03:16', 13, 200),
(169013750, '2023-05-30 17:54:52', 17, 407),
(200459724, '2023-05-18 01:15:15', 14, 200),
(213305193, '2023-05-30 21:46:58', 18, 200),
(403370907, '2023-06-11 11:51:22', 19, 407),
(425534051, '2023-05-09 15:20:13', 14, 407),
(473678674, '2023-06-11 11:54:40', 19, 200),
(498816011, '2023-05-09 13:13:58', 14, 200),
(512507881, '2023-06-10 18:06:36', 13, 200),
(523462148, '2023-05-21 15:22:59', 14, 200),
(744294352, '2023-05-31 01:12:30', 13, 200),
(984135085, '2023-05-09 15:15:28', 14, 200),
(984641489, '2023-05-23 15:39:50', 13, 407),
(1032591827, '2023-05-30 20:08:26', 17, 0),
(1173645280, '2023-06-11 11:47:58', 19, 200),
(1272481284, '2023-05-21 23:14:28', 15, 200),
(1287620196, '2023-05-19 00:50:22', 14, 200),
(1294827599, '2023-06-10 18:01:32', 13, 200),
(1452292489, '2023-05-21 23:41:50', 14, 0),
(1677813965, '2023-05-21 23:14:52', 16, 200),
(1808100567, '2023-05-30 21:45:56', 18, 407),
(1872301418, '2023-05-23 13:16:18', 13, 200),
(1895774437, '2023-05-21 23:12:15', 15, 200),
(1907838938, '2023-05-21 23:02:28', 14, 200),
(2041946031, '2023-05-08 19:38:21', 14, 200),
(2049938318, '2023-06-11 12:10:48', 13, 0),
(2073314413, '2023-05-18 01:28:03', 14, 407),
(2132128110, '2023-05-23 13:15:06', 13, 200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `ukuran` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi`, `id_product`, `qty`, `price`, `ukuran`) VALUES
(2041946031, 9, 1, 949000, 'S'),
(498816011, 17, 1, 269000, 'L'),
(984135085, 8, 1, 1599000, 'S'),
(425534051, 20, 1, 319000, 'S'),
(200459724, 11, 1, 2099000, 'S'),
(2073314413, 13, 1, 499000, 'S'),
(1287620196, 13, 1, 499000, 'XXL'),
(523462148, 8, 1, 1599000, 'S'),
(1907838938, 21, 1, 899000, '38'),
(1907838938, 12, 2000000, 2147483647, '38'),
(1895774437, 6, 1, 1169000, 'S'),
(1677813965, 14, 1, 1299000, '40'),
(1272481284, 12, 2147483647, 2147483647, '38'),
(1452292489, 11, 2147483647, 2147483647, 'XXL'),
(2132128110, 19, 1, 699000, '38'),
(1872301418, 17, 1, 269000, 'S'),
(984641489, 17, 1, 269000, 'S'),
(169013750, 1, 1, 799999, 'S'),
(1032591827, 10, 1, 2099000, '38'),
(1808100567, 5, 1, 859000, 'S'),
(1808100567, 6, 1, 1169000, 'S'),
(213305193, 1, 1, 799999, 'S'),
(744294352, 13, 1, 499000, 'S'),
(1294827599, 4, 1, 819000, 'S'),
(512507881, 13, 1, 499000, 'S'),
(1173645280, 17, 1, 269000, 'S'),
(403370907, 14, 1, 1299000, '38'),
(473678674, 12, 1, 2249000, '38'),
(68544316, 7, 1, 429000, 'S'),
(2049938318, 21, 1, 899000, '38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukuran`
--

CREATE TABLE `ukuran` (
  `id_ukuran` int(11) NOT NULL,
  `ukuran1` char(5) NOT NULL,
  `ukuran2` char(5) NOT NULL,
  `ukuran3` char(5) NOT NULL,
  `ukuran4` char(5) NOT NULL,
  `ukuran5` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ukuran`
--

INSERT INTO `ukuran` (`id_ukuran`, `ukuran1`, `ukuran2`, `ukuran3`, `ukuran4`, `ukuran5`) VALUES
(1, 'S', 'M', 'L', 'XL', 'XXL'),
(2, '38', '39', '40', '41', '42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` char(50) NOT NULL,
  `email` char(150) NOT NULL,
  `password` char(255) NOT NULL,
  `address` char(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `img` char(100) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `email`, `password`, `address`, `tgl_lahir`, `img`, `id_role`) VALUES
(13, 'bhadrika05', 'bhadrika05@gmail.com', '$2y$10$0aG9q9F7KE2FcBCetW113OX9Ly4s81RaNt1SptuAitw.5hqnj68a6', 'Jl. Wasinghton DC, Cimahi Utara, Kota Bekasi, Jawa Timur, Amerika Serikat.', '2000-01-01', '648455cf14e1f.jpg', 1),
(14, 'bhadrika0523', 'bhadrika05@gmail.com', '$2y$10$dkKVHnsb76Ci2/KjMdZXxeG4cns1Nj5UkwyATwO8TFeMEVrUvD/OW', 'blalblba', '3232-02-23', 'dummy.jpg', 2),
(15, 'kuromen', 'hapexadi@tutuapp.bid', '$2y$10$R93eW.JXy0yT9fsXvvBJs.o675EsLVXXZDhYYxoZyECTGlSk6I0gC', 'efeefefef', '2023-05-24', 'dummy.jpg', 2),
(16, 'evpieszi', 'nxthlia.gt@gmail.com', '$2y$10$TnyDeSIyGQ3Ed0.Knbial.05IzB4C0RAQ/ei9umhXjesGO6TP8/Sa', 'timor', '2001-11-11', 'dummy.jpg', 2),
(17, '&lt;h1&gt;nara&lt;/h1&gt;', 'narapati.nara@josjos.com', '$2y$10$mUASe9GGT7.ivQ.Hbw71/eX1.jCb0MENfUD0Ho4jcBXuPsKE9PicS', 'Setiabudhi', '2003-09-08', '6475d56b004d9.jpeg', 2),
(18, 'bangtampan', 'bangtampan@gmail.com', '$2y$10$HPIMyS5bwjBxKjPFLvpCKOM1bLiTj47jQ802vzJRnCXl51t26kiNO', 'Kepo Ah', '2003-09-08', 'dummy.jpg', 2),
(19, 'asd', 'asd@mail', '$2y$10$DzxtXawC0cVh96b4cnX9muW05UOGbqewv.orlWBoLSp0rH2oqdXbK', 'aasdd', '2023-06-06', 'dummy.jpg', 2),
(20, 'z', 'z@mail.com', '$2y$10$xLieSxfIZxYgUbl4zSQYDO6Ak6d/erGsMbBE4qYAJKZ5pYoJI8Icu', 'qwerty', '2023-06-11', 'dummy.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id_users` int(11) DEFAULT NULL,
  `token` char(255) NOT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id_users`, `token`, `expired`) VALUES
(13, '648410b3019b9', '2023-06-11 12:57:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_ukuran` (`id_ukuran`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD KEY `id_users` (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `id_ukuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_ukuran`) REFERENCES `ukuran` (`id_ukuran`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD CONSTRAINT `user_token_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
