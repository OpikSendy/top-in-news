-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2026 at 02:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_top_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `news_id`, `name`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 'Budi Santoso', 'Berita yang sangat informatif! Terima kasih Top In News.', '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(2, 2, 'Ani Rahayu', 'Wah, mengejutkan sekali! Tidak menyangka bisa secepat ini.', '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(3, 3, 'Dian Kusuma', 'Sumber berita terpercaya. Terus berkarya Top In News!', '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(4, 4, 'Rizky Pratama', 'Informasi yang sangat berguna. Langsung saya share ke grup.', '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(5, 5, 'Siti Nurhaliza', 'Mantap beritanya, semoga terus update ya kak!', '2026-04-24 21:56:39', '2026-04-24 21:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_18_073009_create_news_table', 1),
(5, '2026_04_23_152459_create_comments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'news',
  `is_live` tinyint(1) NOT NULL DEFAULT 0,
  `is_trending` tinyint(1) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'published',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `description`, `content`, `image`, `category`, `type`, `is_live`, `is_trending`, `views`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'news', 'news', 'gagah', NULL, 'https://picsum.photos/800/600', 'Technology', 'news', 1, 1, 29, 'published', NULL, '2026-04-24 08:08:38', '2026-04-24 23:39:12'),
(2, 'Apple Luncurkan iPhone 17 dengan Chip A19 Bionic, Performa 40% Lebih Cepat', 'apple-luncurkan-iphone-17-dengan-chip-a19-bionic-performa-40-lebih-cepat-1', 'Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.', '<p>Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=10', 'Technology', 'news', 0, 1, 12461, 'published', NULL, '2026-04-24 21:56:39', '2026-04-25 01:01:13'),
(3, 'Google DeepMind Rilis AI Model Terbaru yang Bisa Memahami Video Real-time', 'google-deepmind-rilis-ai-model-terbaru-yang-bisa-memahami-video-real-time-2', 'Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.', '<p>Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=11', 'Technology', 'news', 1, 1, 9802, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 23:04:43'),
(4, 'Microsoft Akuisisi Startup AI Indonesia Senilai 500 Juta Dolar', 'microsoft-akuisisi-startup-ai-indonesia-senilai-500-juta-dolar-3', 'Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.', '<p>Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=12', 'Technology', 'news', 0, 0, 7200, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(5, 'Meta Quest 4 Hadir dengan Fitur Mixed Reality yang Mengubah Cara Kerja Tim Remote', 'meta-quest-4-hadir-dengan-fitur-mixed-reality-yang-mengubah-cara-kerja-tim-remote-4', 'Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.', '<p>Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=13', 'Technology', 'news', 0, 0, 5100, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(6, 'Indonesia Masuk 10 Besar Negara dengan Pertumbuhan Startup Tercepat di Asia', 'indonesia-masuk-10-besar-negara-dengan-pertumbuhan-startup-tercepat-di-asia-5', 'Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.', '<p>Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=14', 'Technology', 'news', 0, 1, 8300, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(7, 'IHSG Tembus 8.000, Analis Prediksi Bull Run Akhir Tahun yang Kuat', 'ihsg-tembus-8000-analis-prediksi-bull-run-akhir-tahun-yang-kuat-6', 'Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.', '<p>Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=15', 'Business', 'news', 1, 1, 15200, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(8, 'Bank Indonesia Tahan Suku Bunga di Level 5.75%, Rupiah Menguat ke 15.400', 'bank-indonesia-tahan-suku-bunga-di-level-575-rupiah-menguat-ke-15400-7', 'Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.', '<p>Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=16', 'Business', 'news', 0, 0, 6800, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(9, 'Gojek dan Tokopedia Merger: GoTo Siap IPO di Bursa New York Tahun Ini', 'gojek-dan-tokopedia-merger-goto-siap-ipo-di-bursa-new-york-tahun-ini-8', 'Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.', '<p>Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=17', 'Business', 'news', 0, 1, 11300, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(10, 'Harga Minyak Dunia Naik 3% Setelah OPEC+ Umumkan Pemangkasan Produksi', 'harga-minyak-dunia-naik-3-setelah-opec-umumkan-pemangkasan-produksi-9', 'Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.', '<p>Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=18', 'Business', 'news', 0, 0, 4500, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(11, 'Investasi Asing di Indonesia Capai Rekor 1.200 Triliun Rupiah di Kuartal Pertama', 'investasi-asing-di-indonesia-capai-rekor-1200-triliun-rupiah-di-kuartal-pertama-10', 'Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.', '<p>Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=19', 'Business', 'news', 0, 0, 3903, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 23:40:03'),
(12, 'Timnas Indonesia Lolos ke Piala Dunia 2026! Garuda Taklukkan Australia 2-1', 'timnas-indonesia-lolos-ke-piala-dunia-2026-garuda-taklukkan-australia-2-1-11', 'Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.', '<p>Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=20', 'Sports', 'news', 1, 1, 48000, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(13, 'Real Madrid Juara Liga Champions, Mbappe Cetak Hat-trick di Final', 'real-madrid-juara-liga-champions-mbappe-cetak-hat-trick-di-final-12', 'Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.', '<p>Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=21', 'Sports', 'news', 0, 1, 32000, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(14, 'BRI Liga 1: Persib Bandung Kembali Puncak Klasemen Setelah Hajar Persija 3-0', 'bri-liga-1-persib-bandung-kembali-puncak-klasemen-setelah-hajar-persija-3-0-13', 'Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.', '<p>Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=22', 'Sports', 'news', 0, 0, 9800, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(15, 'Kevin Sanjaya dan Marcus Fernaldi Raih Emas di BWF World Championships', 'kevin-sanjaya-dan-marcus-fernaldi-raih-emas-di-bwf-world-championships-14', 'Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.', '<p>Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=23', 'Sports', 'news', 0, 1, 14500, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(16, 'MotoGP Mandalika 2026 Dibuka, Tiket Ludes dalam 6 Jam', 'motogp-mandalika-2026-dibuka-tiket-ludes-dalam-6-jam-15', 'Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.', '<p>Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=24', 'Sports', 'news', 0, 0, 7200, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(17, 'WHO Keluarkan Panduan Baru: 8.000 Langkah Per Hari Sudah Cukup untuk Kesehatan Optimal', 'who-keluarkan-panduan-baru-8000-langkah-per-hari-sudah-cukup-untuk-kesehatan-optimal-16', 'Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.', '<p>Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=25', 'Health', 'news', 0, 1, 18700, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(18, 'Vaksin HIV Fase 3 Berhasil: Efektivitas 89% pada Uji Klinis Global', 'vaksin-hiv-fase-3-berhasil-efektivitas-89-pada-uji-klinis-global-17', 'Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.', '<p>Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=26', 'Health', 'news', 0, 1, 22400, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(19, 'Studi Harvard: Tidur 7 Jam Lebih Efektif dari Suplemen Mahal untuk Imunitas', 'studi-harvard-tidur-7-jam-lebih-efektif-dari-suplemen-mahal-untuk-imunitas-18', 'Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.', '<p>Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=27', 'Health', 'news', 0, 0, 8900, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(20, 'BPJS Kesehatan Kini Cover Operasi Bariatric untuk Penderita Obesitas Ekstrem', 'bpjs-kesehatan-kini-cover-operasi-bariatric-untuk-penderita-obesitas-ekstrem-19', 'Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.', '<p>Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=28', 'Health', 'news', 0, 0, 5600, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(21, '10 Destinasi Wisata Tersembunyi di Nusa Tenggara yang Wajib Dikunjungi 2026', '10-destinasi-wisata-tersembunyi-di-nusa-tenggara-yang-wajib-dikunjungi-2026-20', 'Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.', '<p>Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=29', 'Lifestyle', 'news', 0, 1, 11200, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(22, 'Tren \"Slow Living\" Menyebar di Kalangan Gen Z: Bosan dengan Hustle Culture', 'tren-slow-living-menyebar-di-kalangan-gen-z-bosan-dengan-hustle-culture-21', 'Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.', '<p>Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=30', 'Lifestyle', 'news', 0, 0, 6700, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(23, 'Resep Viral: Nasi Goreng Truffle ala Chef Renatta yang Bisa Dibuat di Rumah', 'resep-viral-nasi-goreng-truffle-ala-chef-renatta-yang-bisa-dibuat-di-rumah-22', 'Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.', '<p>Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=31', 'Lifestyle', 'news', 0, 0, 9300, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(24, 'Batik Kontemporer Indonesia Pukau Paris Fashion Week, Desainer Lokal Mendunia', 'batik-kontemporer-indonesia-pukau-paris-fashion-week-desainer-lokal-mendunia-23', 'Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.', '<p>Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=32', 'Lifestyle', 'news', 0, 1, 7800, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(25, 'Presiden Prabowo Resmikan Ibu Kota Nusantara sebagai Pusat Pemerintahan Penuh', 'presiden-prabowo-resmikan-ibu-kota-nusantara-sebagai-pusat-pemerintahan-penuh-24', 'Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.', '<p>Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=33', 'Politics', 'news', 1, 1, 34500, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(26, 'DPR Sahkan RUU Perlindungan Data Pribadi yang Lama Ditunggu', 'dpr-sahkan-ruu-perlindungan-data-pribadi-yang-lama-ditunggu-25', 'Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.', '<p>Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=34', 'Politics', 'news', 0, 0, 8200, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(27, 'ASEAN Summit 2026 di Jakarta: 10 Poin Kesepakatan Penting yang Ditandatangani', 'asean-summit-2026-di-jakarta-10-poin-kesepakatan-penting-yang-ditandatangani-26', 'Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.', '<p>Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=35', 'Politics', 'news', 0, 0, 5400, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(28, 'Film \"Gundala 2\" Pecahkan Rekor Box Office Indonesia, Raup 200 Miliar di Pekan Pertama', 'film-gundala-2-pecahkan-rekor-box-office-indonesia-raup-200-miliar-di-pekan-pertama-27', 'Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.', '<p>Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=36', 'Entertainment', 'news', 0, 1, 19800, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(29, 'BLACKPINK Umumkan World Tour 2026, Jakarta Jadi Salah Satu Kota yang Disambangi', 'blackpink-umumkan-world-tour-2026-jakarta-jadi-salah-satu-kota-yang-disambangi-28', 'Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.', '<p>Dalam konferensi pers yang digelar kemarin, pihak berwenang membeberkan detail mengejutkan tentang situasi terkini. Ribuan orang yang hadir terkejut dengan besarnya skala perubahan yang akan segera terwujud. Ini menjadi momentum bersejarah yang dicatat dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=37', 'Entertainment', 'news', 0, 1, 41000, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(30, 'Joyland Festival 2026: Lineup Lengkap Diumumkan, 80 Artis dari 20 Negara', 'joyland-festival-2026-lineup-lengkap-diumumkan-80-artis-dari-20-negara-29', 'Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.', '<p>Setelah melalui proses panjang selama lebih dari dua tahun, akhirnya hasil yang ditunggu-tunggu telah tiba. Tim yang terlibat menyebutkan bahwa kerja keras dan dedikasi adalah kunci utama keberhasilan ini. Apresiasi mengalir dari berbagai penjuru dunia.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=38', 'Entertainment', 'news', 0, 0, 8700, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39');
INSERT INTO `news` (`id`, `title`, `slug`, `description`, `content`, `image`, `category`, `type`, `is_live`, `is_trending`, `views`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(31, 'NASA Konfirmasi: Teleskop James Webb Temukan Tanda-tanda Kehidupan di Planet K2-18b', 'nasa-konfirmasi-teleskop-james-webb-temukan-tanda-tanda-kehidupan-di-planet-k2-18b-30', 'Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.', '<p>Data yang dikumpulkan dari 50 negara menunjukkan tren yang konsisten dan tidak terbantahkan. Para analis terkemuka sepakat bahwa ini adalah perubahan struktural yang akan bertahan lama. Investasi di sektor ini diprediksi melonjak drastis dalam waktu dekat.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=39', 'Science', 'news', 0, 1, 55000, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(32, 'BRIN Indonesia Berhasil Kembangkan Baterai Natrium yang Lebih Murah dari Lithium', 'brin-indonesia-berhasil-kembangkan-baterai-natrium-yang-lebih-murah-dari-lithium-31', 'Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.', '<p>Para ahli mengungkapkan bahwa perkembangan ini merupakan terobosan terbesar dalam dekade ini. Ribuan pengguna telah merasakan manfaatnya secara langsung di kehidupan sehari-hari. Komunitas global merespons positif dan menyebutnya sebagai era baru yang penuh harapan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=40', 'Science', 'news', 0, 1, 12300, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39'),
(33, 'Ilmuwan Berhasil Cetak Organ Jantung 3D Pertama yang Berfungsi Penuh', 'ilmuwan-berhasil-cetak-organ-jantung-3d-pertama-yang-berfungsi-penuh-32', 'Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.', '<p>Laporan terbaru menunjukkan angka yang sangat signifikan dan melebihi ekspektasi semua pihak. Para pemangku kepentingan menyambut kabar ini dengan antusias. Dampak jangka panjangnya diprediksi akan terasa hingga lima tahun ke depan.</p><p>Perkembangan ini tidak lepas dari kontribusi berbagai pihak yang telah bekerja keras tanpa kenal lelah. Selama berbulan-bulan, tim yang terdiri dari para profesional berpengalaman berkolaborasi untuk mewujudkan hal yang semula dianggap mustahil.</p><h2>Apa Artinya Bagi Kita?</h2><p>Implikasi dari berita ini sangat luas dan menyentuh berbagai aspek kehidupan masyarakat. Para pakar menekankan pentingnya kesiapan semua pihak dalam menyambut perubahan yang segera datang ini.</p><p>Tidak hanya di tingkat nasional, dampaknya juga akan dirasakan secara global. Negara-negara maju sudah mulai mempersiapkan strategi adaptasi mereka masing-masing.</p><h2>Langkah Selanjutnya</h2><p>Pihak terkait telah mengumumkan roadmap yang jelas untuk memastikan transisi berjalan mulus dan menguntungkan semua pihak. Publik diminta untuk tetap memantau perkembangan situasi ini.</p>', 'https://picsum.photos/800/500?random=41', 'Science', 'news', 0, 0, 29000, 'published', NULL, '2026-04-24 21:56:39', '2026-04-24 21:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ZaxylqnynWkzrkCtjAB8tl1yfRoyfOpP0OB4Sj1C', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlZ1ODBpNzIxRzN2QjBJQ094M1pFNnpqQmNGZExYbENOaXBzU21JQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXRhaWwtbmV3cy8yIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwtbmV3cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777104077),
('zcI3aMZPf9O5QocuhbfJIrgdTQCO1c6A55YiH78Y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmZJWHpzTEJTUzZROGU4NWVjZ01lRWI3MDc3aXhtZ0luRFZxU1FrTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90b3AtbmV3cyI7czo1OiJyb3V0ZSI7czo4OiJ0b3AtbmV3cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777100004);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-04-24 08:07:59', '$2y$12$vJ7cUC/bzOwpqCZmmILzX.ImnDpkNX4XaS3fzSdHRwE56rVouW/t6', 'AQTvj4OLqk', '2026-04-24 08:08:00', '2026-04-24 08:08:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_news_id_foreign` (`news_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
