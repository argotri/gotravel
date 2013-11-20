-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 25. Juli 2013 jam 12:37
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kuliah_gotravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_tempat`
--

CREATE TABLE IF NOT EXISTS `kategori_tempat` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `kategori_tempat`
--

INSERT INTO `kategori_tempat` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Tempat Nongkrong'),
(2, 'Tempat Belanja'),
(3, 'Tempat Makan'),
(4, 'Tempat Ibadah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_wisata`
--

CREATE TABLE IF NOT EXISTS `kategori_wisata` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `kategori_wisata`
--

INSERT INTO `kategori_wisata` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Wisata Alam'),
(2, 'Wisata Makanan'),
(3, 'Wisata Religi'),
(4, 'Wisata Sejarah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_tempat`
--

CREATE TABLE IF NOT EXISTS `list_tempat` (
  `id_tempat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tempat` varchar(30) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `keterangan_tempat` text NOT NULL,
  `lat` varchar(30) NOT NULL,
  `long` varchar(30) NOT NULL,
  `url_foto` varchar(200) NOT NULL,
  PRIMARY KEY (`id_tempat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `list_tempat`
--

INSERT INTO `list_tempat` (`id_tempat`, `nama_tempat`, `id_kategori`, `keterangan_tempat`, `lat`, `long`, `url_foto`) VALUES
(4, 'Carefour', 2, 'Carefour Mojokerto Adalah Sebuah pusat perbelanjaan terbaru di kota Mojokerto , Terdapat Berbagai macam Kebutuhan yang dapat anda Dapatkan disini', '-7.471751', '112.442186', 'http://3.bp.blogspot.com/-4IzVZPuS_Lg/TdZd_Q-_d2I/AAAAAAAAArY/kzJ4j--ETpo/s1600/crfindonesia.JPG'),
(5, 'Benteng Pancasila', 2, 'Jalan Benteng Pancasila, Kecamatan Magersari merupakan pusat keramaian terbaru di kota Mojokerto. Di Jalan Ini terdapat Pusat Jualan PKL yang menjual beragam produk dari produk garmen sampai sepatu dan tas. selain itu juga Jalan Benteng Pancasila tau biasa disebut Benpas merupakan tempat berkumpul kawula muda Mojokerto dan wilayah sekitarnya seperti Sidoarjo, Jombang, Lamongan, Nganjuk, Kediri, Surabaya hingga Pasuruan di malam minggu dan di hari libur nasional.', '-7.472347', '112.443731', 'http://1.bp.blogspot.com/-YqQUtUweL1I/UNmMup-PUhI/AAAAAAAADSo/ediKyIGbxA0/s1600/25+12+benpas.jpg'),
(6, 'Gama Cafe', 1, 'Gama Cafe Sebenarnya adalah sebuah cafe dekat Pom Bensin Gajah Mada , Lokasi ini sering digunakan sebagai tempat Nongkrong Dikarenakan Adanya internet Gratis dan dekat Dengan Jogging Track Mojokerto', '-7.459369', '112.440041', 'http://p.twimg.com/A8yBrDBCUAIkrHS.jpg:large'),
(7, 'Pasar Tanjung Anyar', 2, 'Pasar Terbesar Di Kota Mojokerto , Merupakan pusat jual Beli Kota Mojokerto', '-7.4669444', '112.436667', 'http://mojokertomedia.com/wp-content/uploads/2012/06/pasar-tanjung-mojokerto.jpg'),
(8, 'Pasar Besar Mojosari', 2, 'Pasar Terbesar Di Sekitar Mojosari letaknya terdapat pada jalan Alternatif Ke surabaya maupun ke pacet dari arah Surabaya , Kota Mojokerto Maupun sekitarnya , Terdapat beberapa Cidera mata dari Mojokerto untuk dibawa pulang', '-7.514166667', '112.5569444', 'http://www.majamojokerto.com/img_box/photo/headline/pasar-tradisi11.jpg'),
(9, 'Jogging Track Mojokerto', 1, 'Jogging Track Mojokerto Merupakan Tempat Pinggir Sungai Brantas yang biasa digunakan warga mojokerto untuk berkumpul di sore dan malam hari , sambil menikmati tenggelamnya matahari', '-7.457858', '112.438241', 'http://1.bp.blogspot.com/_5NVJ7Vw2mLw/SGW47f5saXI/AAAAAAAAAJw/XZtEZTSPfbY/s320/IMG_0056.JPG'),
(10, 'Taman Brantas Indah Mojokerto', 1, 'Taman Brantas Indah ( TBI ) Adalah Tempat Berkumpul di pinggir Sungai Brantas sisi Kabupaten Mojokerto , hanya saja , lebih banyak kegiatan yang terdapat Disini dari pada Pada Jogging Track Mojokerto , Disini Banyak terdapat event di waktu - waktu tertentu , Tempat ini juga Menjadi Ajang Penyalur hobi diantaranya Perahu Motor , Air craft dan panjat tebing', '-7.456475', '112.43749', 'http://jawatimuran.files.wordpress.com/2012/06/taman-brantas-indah-tbi001.jpg'),
(11, 'KFC', 3, 'Siapa yang tidak kenal KFC ini , bertempat di Pertigaan utama Pusat Mojokerto , restorant ini berdiri tegak dan sangat laris', '-7.463815', '112.435559', 'http://mw2.google.com/mw-panoramio/photos/small/57236901.jpg'),
(12, 'Rocket Chiken', 3, 'Rocket Chiken merupakan restoran cepat saji yang terdapat di Kawasan yang hampir sama dengan KFC Mojokerto , dengan spesialisasi ayamnya , Disini anda akan dihadirkan sajian yang murah namun tidak murahan', '-7.463156', '112.435023', 'https://sphotos-a.xx.fbcdn.net/hphotos-ash3/s320x320/576990_281100011989366_1497434568_n.jpg'),
(13, 'Masjid Agung Al-Fattah', 4, 'Masjid agung ini adalah masjid yang terbesar di kota mojokerto , terletak tepat di sebelah Barat Alun - Alun Kota Mojokerto', '-7.463198', '112.43086', 'http://3.bp.blogspot.com/_ttog97k089w/THXOaExfF2I/AAAAAAAABso/tMAUnCCoc5w/s400/masjid+mojokerto.jpeg'),
(14, 'Gereja Katolik St. Yosef', 4, 'Gereja ini adalah salah satu gereja tertua di mojokerto , Gereja ini tepat berada di pusatkota mojokerto.', '-7.462794', '112.43616', 'http://3.bp.blogspot.com/-gq6WGTOwpe4/UIrOurdsY2I/AAAAAAAACbA/gVWCqOTAgdU/s1600/IMG_5151.JPG'),
(15, 'Klenteng Hok Siang Kiong', 4, 'Klenteng Hok Siang Kiong didirikan pada jaman Belanda sekitar tahun 1823. Sedangkan Vihara Metta Sraddha didirikan pada tahun 1955. Lokasi Klenteng dan Vihara ini berada di Jl. Residen Pamudji. Ciri khas yang menonjol pada bangunan Klenteng dan Vihara ini adalah arsitekturnya khas Cina.', '-7.466624', '112.435323', 'http://optimisindonesia.net/wp-content/uploads/2010/11/Klenteng-Hok-Sian-Kiong-Mojokerto.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_wisata`
--

CREATE TABLE IF NOT EXISTS `list_wisata` (
  `id_wisata` int(11) NOT NULL AUTO_INCREMENT,
  `nama_wisata` varchar(30) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `keterangan_pariwisata` text NOT NULL,
  `lat` varchar(30) NOT NULL,
  `long` varchar(30) NOT NULL,
  `url_foto` varchar(200) NOT NULL,
  PRIMARY KEY (`id_wisata`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `list_wisata`
--

INSERT INTO `list_wisata` (`id_wisata`, `nama_wisata`, `id_kategori`, `keterangan_pariwisata`, `lat`, `long`, `url_foto`) VALUES
(1, 'Alun - Alun Mojokerto', 4, 'Alun-alun Kota Mojokerto terletak di pusat kota. Bagi warga Kota Mojokerto dan sekitarnya dulu merupakan tempat rekreasi sekaligus sebagai sarana bersantai bagi keluarga di akhir pekan.namun Sekarang Alun - Alun di kosongkan dan Pedagangnya di Pindahkan ke Jl.Benteng Pancasila yang tidak jauh dari Kediaman Walikota Mojokerto.', '-7.463369', '112.431869', 'http://3.bp.blogspot.com/--UDeWpZXLbw/T-r6awVG5tI/AAAAAAAAAb8/Ny88UN5BrkQ/s320/alun+-+alun+mojokerto.jpg'),
(2, 'Air Terjun Dlundung', 1, 'Alam pegunungan yang sejuk dan terdapat rimbunan pohon yang masih alami membuat air terjun Dlundung sebagai tempat wisata yang menarik untuk dikunjungi. Tempat wisata yang indah ini mudah untuk dicapai karena letaknya yang hanya berjarak 43 km dari pusat kota Mojokerto tepatnya di desa Kemloko Kec. Trawas sekitar 43km menuju arah selatan Mojokerto, dapat dicapai menggunakan mobil atau sepeda motor. Tempat wisata ini sangat cocok untuk bersantai dan melepas rasa lelah, untuk remaja yang suka berkemah, di kawasan wisata ini juga tersedia areal perkemahan yang cukup luas dan juga nyaman.', '-7.681389', '112.5941667', 'http://4.bp.blogspot.com/-qqGDpaSMr6c/Ubq88HcYK5I/AAAAAAAACTE/n5zShL7c9kc/s1600/AIR+TERJUN+DLUNDUNG.gif'),
(3, 'Air Terjun Grenjengan', 1, 'Air Terjun Grenjengan berlokasi di Kawasan Wisata Pacet lereng utara Gunung Welirang. Tidak jauh dari lokasi wisata air terjun ini juga terdapat sebuah air terjun lain yaitu Coban Canggu. Letaknya di Desa Padusan, Kec. Pacet, Kab. Mojokerto. Jarak dari pusat kota Mojokerto sekitar 31 km atau sekitar 2,9 km dari pusat kota Pacet menuju arah selatan. Akses untuk menuju Kawasan Wisata Pacet ini sangat mudah, dapat menggunakan kendaraan roda dua atau empat, dan kondisi jalan yang sudah baik.', '-7.681111111', '112.5477778', 'http://1.bp.blogspot.com/-Tl6uRazmNbE/Ubq9Uehc39I/AAAAAAAACTM/g-52mmP-CWU/s200/Air+Terjun+Grenjengan.jpg'),
(4, 'Air Terjun Coban Canggu', 1, 'Air Terjun Coban Canggu mempunyai ketinggian sekitar 71 meter dan batu cada yang kokoh pada dindingnya. Di bawah air terjun ini ada sebuah kolam penampungan yang bisa digunakan untuk bermain air atau hanya sekedar berendam. Objek wisata ini berada tidak jauh dari Kawasan Wisata Pacet yang ada di lereng utara Gunung Welirang pada ketinggian kurang lebih 800 meter. Lokasinya hanya berjarak beberapa ratus meter dari pintu masuk kawasan wisata tersebut.', '-7.681111111', '112.5477778', 'http://3.bp.blogspot.com/-e_hayV6wUwQ/Ubq95fgM_0I/AAAAAAAACTU/uD-ZDNuPy3o/s1600/Air+Terjun+Coban+Canggu.JPG'),
(5, 'Air Terjun Coban Kembar Watu O', 1, 'Coban Watu Ondo juga sering disebut Coban Kembar terletak di dalam kawasan Taman Hutan Rakyat Raden Soerjo yang ada di bawah lereng Gunung Welirang dan berbatasan antara Mojokerto dan kota Batu. Tepatnya terletak di Dusun sendi, Desa Pacet, Kec. Pacet, Kab. Mojokerto. Berjarak sekitar 9 km dari ibukota kec. Pacet atau 3 km menuju arah barat dari pintu masuk Pemandian Air Panas Cangar.', '-7.701806', '112.548824', 'http://3.bp.blogspot.com/-DWHVltzrhb8/Ubq_KWxgKAI/AAAAAAAACTk/H6AG-HAy1KY/s1600/Air+Terjun+Coban+Kembar+Watu+Ondo.jpg'),
(6, 'Wana Wisata Air Panas', 1, 'Satu arah dengan tempat pemandian Ubalan hanya saja jalannya lebih menanjak sedikit. Sumber air hangat yang dipercaya dapat menyembuhkan berbagai macam penyakit ini khususnya penyakit kulit. Keadaan lingkungan sekitar masih alami dan dikelilingi oleh rimbunnya pohon hutan pinus dan semak belukar dan memiliki udara yang sejuk dan nyaman. Sumber air panas Pacet menyediakan tempat bak penampungan yang cukup luas. Disini juga ada kolam renang air dingin yang cukup bersih. Fasilitas yang tersedia seperti lapangan parkir yang luas dan aman serta lokasi khusus souvenir, buah-buahan segar, sayur khas Pacet dan makanan minuman yang cukup tersedia 24 jam', '-7.67111111', '112.5397222', 'http://3.bp.blogspot.com/-gxPJSpkViac/UbrCOP4HcBI/AAAAAAAACUw/vz6sRCIfnIE/s1600/Wana+Wisata+Air+Panas.jpg'),
(7, 'Pemandian Ubalan', 1, 'Lokasi pemandian Ubalan ini mudah untuk dicapai, tepatnya di Desa Padusan Kec. Pacet, Mojokerto dan memiliki lingkungan yang masih tampak alami. Pepohonan terlihat subur mengelilingi objek wisata ini, air kolam yang bersih dan sejuk cocok untuk berenang dan menghilangkan stress. Tempat ini dilengkapi dengan tempat mainan anak. Banyak warga sekitar menjajakan oleh-oleh khas Pacet seperti sayuran dan buah-buahan.', '-7.685283', '112.547225', 'http://4.bp.blogspot.com/-8T8TrGcJTjc/UbrCIncqiEI/AAAAAAAACUk/oexC13upajA/s200/Pemandian+Ubalan.jpg'),
(8, 'Candi Bajang Ratu', 4, 'Terletak di Desa Temon, Keca. Trowulan. Candi ini terbuat dari batu bata merah dengan ketinggian sekitar 16 meter, lebar 6 meter dan panjangnya sekitar 6,74 meter. Candi ini juga dihiasi relief kepala garuda, matahari yang diapit naga, kepala kala yang diapit singa serta binatang bertelinga panjang. Pada bagian sayap terpahat relief cerita Rama dan pada bagian kaki candi terpahat relief cerita Sritanjung. Candi Bajang Ratu berfungsi sebagai gapura pintu masuk bangunan suci. Lokasinya mudah untuk dijangkau dengan kendaraan pribadi ataupun kendaraan umum.', '-7.5677778', '112.398611111', 'http://1.bp.blogspot.com/-PnpgJ3ovISQ/Ubq_SFjKrlI/AAAAAAAACTs/oo9W05Rh-DA/s200/Candi+Bajangratu.jpg'),
(9, 'Candi Brahu dan Gentong', 4, 'Lokasinya di desa Bejijong, Kec. Trowulan. Candi Brahu terbuat dari bata yang berasal dari jaman empu Sendok Majapahit. Candi ini adalah candi agama Budha, Candi Brahu tidak memiliki hiasan, hanya saja pada bagian atap ada sisa bagian dasar stupa. Sekitar candi banyak ditemukan benda-benda seperti candi agama buddha pada umumnya. Menurut legenda dari cerita rakyat Candi Brahu adalah tempat penyimpanan abu para raja-raja Majapahit yaitu Brawijaya, pembakaran raja-raja Majapahit diantaranya adalah Brawijaya I,II,II dan IV. Setelah dibakar, kemudian abunya disimpan di dalam goa yang ada dalam candi.', '-7.5427776', '112.3741667', 'http://1.bp.blogspot.com/-c2sO8Fub_uI/UbrAdjjLh_I/AAAAAAAACT8/T-acrWInsFg/s200/Candi+Brahu.jpg'),
(10, 'Candi Tikus', 4, 'Bangunan ini terbuat dari batu bata merah dengan ketinggian sekitar 5 meter, panjang 25 meter dan lebarnya 23 meter ini konon dahulunya adalah taman air yang menjadi tempat bersuci dari putri-putri kerajaan Majapahit. Ada mitos yang mengatakan bahwa air yang mengalir di Candi Tikus bersumber dari Gunung Mahameru. Sampai sekarang masih ada petani yang mempercayai air yang ada di Candi Tikus dapat digunakan sebagai penolak atau pengusir hama tikus di sawah. Candi ini mudah untuk dicapai baik dengan kendaraan pribadi maupun angkutan umum. Terletak di Desa Temon Kec. Trowulan dan tidak jauh dari lokasi situs Candi Bajangratu.', '-7.5716667', '112.4033333', 'http://4.bp.blogspot.com/-Iyh7WUa7lLk/UbrAqxLV5bI/AAAAAAAACUE/qJN04CVFReM/s200/candi_tikus.gif'),
(11, 'Candi Wringin Lawang', 4, 'Diperkirakan candi ini dahulu digunakan sebagai pintu gerbang utama untuk masuk ke kerajaan Majapahit. Bentuknya seperti gapura belah (candi Bentar). Terbuat dari batu bata dengan tinggi sekitar 13 m panjang 13 m lebar 11 m. Menurut cerita dari rakyat, gapura Wringin Lawang adalah salah satu pintu masuk untuk ke alun-alun Majapahit. Dulunya di dekat gapura juga terdapat paseban atau tempat menunggu untuk orang-orang yang ingin sowan kepada raja. Candi ini disebut Candi Wringin Lawang karena konon dulu didekat candi ini ditumbuhi dua pohon beringin besar yang berjajar. Candi ini berlokasi di Desa Jati Pasar, Kec. Trowulan, di tepi jalan Raya Surabaya, mudah untuk diakses baik dengan angkutan umum, kendaraan pribadi atau kendaraan roda dua.', '-7.5419444', '112.3908333', 'http://2.bp.blogspot.com/-bPQd59YFzyY/UbrBJG9hbEI/AAAAAAAACUM/Yr7tsUaw2rI/s1600/Candi+Wringin+lawang.jpg'),
(12, 'Kolam Segaran', 4, 'Kolam Segaran, sebuah kolam luas yang terletak di situs ibukota Kerajaan Majapahit di Trowulan. Keberadaannya hingga kini masih menjadi perdebatan di antara para ahli sejarah dan arkeolog. Untuk apa kolam ini dibangun dan fungsinya sebagai apa? Masih menyisakan misteri yang belum terjawab tuntas', '-7.55777778', '112.3827778', 'http://2.bp.blogspot.com/-eZnolUTFb2s/UbrBqv7kSbI/AAAAAAAACUc/8v07-4GsYvY/s200/Kolam+Segaran.jpg'),
(13, 'maha vihara Majapahit', 3, 'Maha Vihara Majapahit merupakan sebuah tempat beribadah umat beragama Buddha yang berlokasi di Desa Bejijong, Kota Mojokerto, Jawa Timur. Objek penelitian menggunakan desain interior dan arsitektur ruang Dhammasala yang mengacu pada akulturasi budaya Jawa dengan tradisi Buddhist. Interior ruang Dhammasala ini mengandung identitas budaya Jawa, antara lain arsitektur hingga ragam hias Jawa. Dalam penelitian ini yang dibahas ialah sejauh mana proses akulturasi budaya Jawa dengan tradisi Buddhist dapat diterapkan pada objek penelitian, pengumpulan data dilakukan dengan studi referensi,observasi, dan wawancara langsung dengan membandingkan antara budaya Jawa dengan tradisi Buddhist pada ruang Dhammasala Maha Vihara Majapahit, menggunakan metode deskriptif dengan tabel yang disertai gambar, dan foto, maka dapat diketahui pola akulturasi budaya Jawa dengan tradisi Buddhist pada ruang Dhammasala tersebut, kondisi yang paling dominan terjadi adalah absorbsi budaya Jawa kedalam tradisi Buddhist, hal ini terjadi karena adanya aplikasi budaya Jawa yang dominan kedalam sebuah Vihara yang menganut tradisi Buddhist.', '-7.55611111', '112.3697222', 'http://3.bp.blogspot.com/-T8tsRYccIjQ/UbrFpj7R-iI/AAAAAAAACVY/a9TaRRcBCQk/s640/Maha+Vihara+Majapahit.JPG'),
(14, 'Makam Troloyo', 3, 'Situs komplek makam Troloyo adalah merupakan suatu komplek pemakaman Islam di jaman kerajaan Majapahit, situs ini terletak di wilayah Desa Sentonorejo, Kecamatan Trowulan, Kabupaten Mojokerto. Saat ini komplek makam tersebut telah dibangun sedemikian rupa sehingga menghilangkan ciri khas aslinya sebagai suatu situs peninggalan purbakala dari jaman kerajaan Majapahit', '-7.57583333', '112.3805556', 'http://3.bp.blogspot.com/-tUhYFkjoXHY/TZ9DNBFxVPI/AAAAAAAAAH4/zQUdr3DzE5s/s1600/TRALAYA_3.jpg'),
(15, 'Onde - Onde Boliem', 2, 'Menyediakan berbagai macam Onde onde mulai dari keciput hingga onde - onde super yang sangat lezat , cocok buat Buah tangan sebelum meninggalkan Mojokerto', '-7.466135', '112.440173', 'http://3.bp.blogspot.com/-OY1Zxo9nMak/TWqI8_6LWSI/AAAAAAAAAAY/Weawfshb8Ac/s220/DSC00027.JPG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `versi`
--

CREATE TABLE IF NOT EXISTS `versi` (
  `cur_ver` int(11) NOT NULL,
  PRIMARY KEY (`cur_ver`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `versi`
--

INSERT INTO `versi` (`cur_ver`) VALUES
(13);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
