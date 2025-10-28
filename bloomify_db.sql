-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 02:15 AM
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
-- Database: `bloomify_db`
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
-- Table structure for table `florists`
--

CREATE TABLE `florists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `start_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `rating` decimal(2,1) NOT NULL DEFAULT 0.0,
  `is_always_closed` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `florists`
--

INSERT INTO `florists` (`id`, `name`, `slug`, `address`, `city`, `latitude`, `longitude`, `image`, `open_time`, `close_time`, `start_price`, `rating`, `is_always_closed`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Kaninara Florist', 'kaninara-florist', 'Jl. Kaliurang Km. 13, Besi, Sleman, Yogyakarta', 'Yogyakarta', -7.6968021, 110.4173035, 'uploads/florists/kaninara.png', '09:00:00', '21:00:00', 10000.00, 4.8, 0, NULL, '2025-10-11 08:56:24', NULL),
(2, 'Ren Florist Co.', 'ren-florist-co', 'Jl. Cendrawasih No.3 Mrican Caturtunggal Depok Sleman Yogyakarta', 'Yogyakarta', -7.7790105, 110.3889128, 'uploads/florists/renflorist.png', '10:00:00', '21:00:00', 15000.00, 4.8, 0, NULL, '2025-10-11 08:56:24', NULL),
(3, 'Kaning Bouquet and Gift Florist', 'kaning-bouquet-and-gift-florist', 'Jl. Gambir, Karangasem, Caturtunggal, Depok, Sleman, Yogyakarta', 'Yogyakarta', -7.7676535, 110.3876326, 'uploads/florists/kaning.png', '08:00:00', '23:00:00', 8000.00, 4.9, 0, NULL, '2025-10-11 08:56:24', NULL),
(4, 'Beverly Florist Jogja', 'beverly-florist-jogja', 'Karang Gayam, Caturtunggal, Depok, Sleman, Yogyakarta', 'Yogyakarta', -7.7675798, 110.3920422, 'uploads/florists/beverly.png', '10:00:00', '23:59:00', 8000.00, 4.9, 0, NULL, '2025-10-11 08:56:24', NULL),
(5, 'Halia Florist', 'halia-florist', 'Jl. Gambir Baru, Karangasem, Karang Gayam, Sleman, Yogyakarta', 'Yogyakarta', -7.7641360, 110.3888805, 'uploads/florists/halia.png', '09:00:00', '21:00:00', 15000.00, 4.8, 1, NULL, '2025-10-11 08:56:24', NULL),
(6, 'Lupy Florist', 'lupy-florist', 'Jl. Flamboyan No. 34D, Karang Gayam, Depok, Sleman Yogyakarta', 'Yogyakarta', -7.7659065, 110.3902355, 'uploads/florists/lupy.png', '09:00:00', '10:00:00', 12000.00, 4.5, 1, NULL, '2025-10-11 08:56:24', NULL),
(7, 'Blumefleur Florist Jakarta', 'blumefleur-florist', 'Jl. Pulau Pantara P4 No.62, RT.7/RW.9, Permata Buana, Kec. Kembangan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta', 'Jakarta', -6.1690062, 106.7405248, 'uploads/florists/blumefleur.png', '09:00:00', '21:00:00', 20000.00, 4.7, 0, NULL, '2025-10-11 08:56:24', NULL),
(8, 'SERA Florist Bandung', 'sera-florist', 'Gg. Cigadung Pesantren Timur II No.2, Cigadung, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat', 'Bandung', -6.8772928, 107.6278293, 'uploads/florists/sera.png', '10:00:00', '21:00:00', 15000.00, 4.8, 0, NULL, '2025-10-11 08:56:24', NULL),
(9, 'Outerbloom Florist Jakarta', 'outerbloom-florist', 'ITC Kuningan - Lantai 9, Jl. Prof. DR. Satrio No.9 lt 9, RT.7/RW.2, Kuningan, Karet Kuningan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta', 'Jakarta', -6.2181561, 106.8284154, 'uploads/florists/outerbloom.png', '09:00:00', '21:00:00', 12000.00, 4.8, 1, NULL, '2025-10-11 08:56:24', NULL),
(10, 'Tiara Florist', 'tiara-florist', 'Cipaganti Coblong, Jl. Wastukencana, Tamansari, Kec. Bandung Wetan, Kota Bandung, Jawa Barat', 'Bandung', -6.8963656, 107.6067192, 'uploads/florists/tiara.png', '09:00:00', '21:00:00', 20000.00, 4.6, 1, NULL, '2025-10-11 08:56:24', NULL),
(11, 'Park Florist', 'park-florist', 'Jl. Kayoon No.38B, Embong Kaliasin, Kec. Genteng, Surabaya, Jawa Timur', 'Surabaya', -7.2662016, 112.7467669, 'uploads/florists/park.png', '09:00:00', '23:00:00', 15000.00, 4.4, 1, NULL, '2025-10-11 08:56:24', NULL),
(12, 'Kayoon Flower Market', 'kayoon-flower-market', 'Jl. Kayoon street No.20 L, Embong Kaliasin, Kec. Genteng, Surabaya, Jawa Timur', 'Surabaya', -7.2644988, 112.7481402, 'uploads/florists/kayoon.png', '09:00:00', '21:00:00', 12000.00, 4.8, 0, NULL, '2025-10-11 08:56:24', NULL);

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
(4, '2025_10_08_070115_create_personal_access_tokens_table', 2),
(5, '2025_10_11_011804_create_florists_table', 3),
(6, '2025_10_11_054615_create_products_table', 4),
(7, '2025_10_12_050627_create_testimonials_table', 5),
(8, '2025_10_12_124658_create_orders_table', 6),
(9, '2025_10_14_061219_add_payment_fields_to_orders_table', 7),
(10, '2025_10_14_131047_create_orders_table', 8),
(11, '2025_10_14_214541_add_order_code_to_orders_table', 9),
(12, '2025_10_14_215736_add_order_event_timestamps_to_orders_table', 10),
(13, '2025_10_14_223220_update_status_enum_in_orders_table', 11),
(14, '2025_10_14_224012_update_status_enum_in_orders_table', 12),
(15, '2025_10_15_090322_add_role_to_users_table', 13),
(16, '2025_10_15_090458_add_user_id_to_florists_table', 14),
(17, '2025_10_15_092906_add_florist_relation_to_users_table', 15),
(18, '2025_10_23_152947_add_latitude_longitude_to_florists_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `florist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `pickup_method` enum('Pick Up','Delivery Go-Send','Delivery Florist') NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `paper_bag` enum('Plastic','Paper Bag') NOT NULL DEFAULT 'Plastic',
  `greeting_card` tinyint(1) NOT NULL DEFAULT 0,
  `greeting_message` text DEFAULT NULL,
  `additional_request` text DEFAULT NULL,
  `payment_method` enum('Transfer Bank','QRIS') DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `payment_status` enum('Pending','Paid','Failed') NOT NULL DEFAULT 'Pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `prepared_at` timestamp NULL DEFAULT NULL,
  `ready_at` timestamp NULL DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `status` enum('Pending','Confirmed','Processing','Ready to Ship','Out for Delivery','Delivered','Cancelled') DEFAULT 'Pending',
  `total_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `florist_id`, `product_id`, `customer_name`, `customer_phone`, `address`, `quantity`, `pickup_method`, `pickup_date`, `pickup_time`, `paper_bag`, `greeting_card`, `greeting_message`, `additional_request`, `payment_method`, `sender_name`, `payment_proof`, `payment_status`, `paid_at`, `prepared_at`, `ready_at`, `shipped_at`, `delivered_at`, `status`, `total_price`, `slug`, `created_at`, `updated_at`) VALUES
(14, 'BLOOMY58384', 6, 4, 32, 'Ayudya', '08112345678', 'safdfsd', 1, 'Delivery Florist', '2025-10-16', '10:00:00', 'Paper Bag', 0, NULL, NULL, 'QRIS', 'ayud', 'order/payment/elwgNJqpe89LvIBHHrzZHztKELoVF2kCjSRzJkWt.png', 'Paid', '2025-10-15 15:04:11', '2025-10-15 15:06:11', '2025-10-17 03:29:44', '2025-10-17 03:30:11', '2025-10-17 03:43:49', 'Delivered', 1495500.00, 'rosy-rhapsody-3', '2025-10-15 15:03:45', '2025-10-17 03:43:49');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `florists_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `flowers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`flowers`)),
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `florists_id`, `name`, `slug`, `description`, `price`, `flowers`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Blossom Joy', 'blossom-joy', 'Blossom Joy Bouquet is the embodiment of everlasting joy and cheerful exuberance in full bloom. This arrangement blends soft and bright colors to create a captivating visual harmony—ranging from the warm hues of peach, the vibrant glow of orange, to a refreshing touch of light blue.', 560000.00, '[\"Gerbera Daisy\",\"Ranunculus\",\"Carnation (Anyelir Light Green)\",\"Chrysanthemum\",\"Carnation (Anyelir Peach)\",\"Cosmos Daisy (White and Pink)\",\"Delphinium\",\"Buttercup Yellow\"]', 'uploads/products/kaninara/blossom.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(2, 1, 'Luna Love Bouquet', 'luna-love-bouquet', 'Luna Love Bouquet menghadirkan nuansa romansa lembut di bawah sinar bulan. Kombinasi mawar merah dan putih dengan sentuhan eucalyptus menciptakan kesan elegan dan penuh kasih.', 1500000.00, '[\"Red Rose\",\"White Rose\",\"Eucalyptus Leaves\",\"Baby\\u2019s Breath\"]', 'uploads/products/kaninara/lunalove.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(3, 1, 'Scarlet Heart', 'scarlet-heart', 'Scarlet Heart Bouquet melambangkan cinta yang berapi dan penuh semangat. Mawar merah tua dipadukan dengan carnation merah muda memberi kesan berani namun lembut.', 890000.00, '[\"Red Rose\",\"Pink Carnation\",\"Ruscus Leaves\"]', 'uploads/products/kaninara/scarletheart.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(4, 1, 'Petal Party', 'petal-party', 'Petal Party Bouquet adalah pesta warna dan keceriaan. Campuran bunga daisy, tulip, dan mawar mini menciptakan tampilan segar yang cocok untuk hadiah penuh kebahagiaan.', 50000.00, '[\"Mini Rose\",\"Daisy\",\"Tulip\",\"Green Chrysanthemum\"]', 'uploads/products/kaninara/petalparty.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(5, 1, 'Bloomette', 'bloomette', 'Bloomette Bouquet menampilkan pesona bunga kecil berwarna pastel dengan gaya modern. Cocok untuk hadiah ringan namun berkesan.', 30000.00, '[\"Pink Rose\",\"White Chrysanthemum\",\"Lavender\",\"Eucalyptus\"]', 'uploads/products/kaninara/bloomette.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(7, 1, 'Pure Amour', 'pure-amour', 'Pure Amour Bouquet adalah simbol cinta yang tulus dan suci. Kombinasi bunga putih dan pink lembut menjadikannya pilihan ideal untuk momen spesial.', 65000.00, '[\"White Rose\",\"Pink Rose\",\"White Lily\",\"Eucalyptus\"]', 'uploads/products/kaninara/pureamour.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(8, 1, 'Luna Belle', 'luna-belle', 'Luna Belle Bouquet memancarkan keanggunan malam yang lembut. Perpaduan mawar merah muda dan lily putih memberikan nuansa feminin yang menawan.', 200000.00, '[\"Pink Rose\",\"White Lily\",\"Eucalyptus\",\"Ruscus Leaves\"]', 'uploads/products/kaninara/lunabelle.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(9, 1, 'Warm Embrace', 'warm-embrace', 'Warm Embrace Bouquet menghadirkan kehangatan kasih dengan kombinasi mawar merah dan putih yang elegan, sempurna untuk mengungkapkan cinta dan perhatian.', 55000.00, '[\"Red Rose\",\"White Rose\",\"Baby\\u2019s Breath\",\"Eucalyptus Leaves\"]', 'uploads/products/kaninara/warmembrace.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(10, 2, 'Sugar Fields', 'sugar-fields', 'Sugar Fields Bouquet adalah buket manis dengan warna pastel yang menenangkan. Kombinasi bunga mawar dan hydrangea putih memberikan kesan lembut dan romantis.', 270000.00, '[\"White Rose\",\"Peach Rose\",\"White Hydrangea\"]', 'uploads/products/ren/sugarfields.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(11, 2, 'Honey Dusk', 'honey-dusk', 'Honey Dusk Bouquet terinspirasi dari kehangatan matahari sore. Warna kuning keemasan bunga sunflower dan tulip memberi energi positif dan semangat.', 230000.00, '[\"Sunflower\",\"Yellow Tulip\",\"Solidago\",\"Green Foliage\"]', 'uploads/products/ren/honeydusk.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(12, 2, 'Moonveil', 'moonveil', 'Moonveil Bouquet menampilkan kombinasi lembut mawar putih dan lavender yang mencerminkan ketenangan malam. Cocok untuk ucapan selamat dan doa tulus.', 190000.00, '[\"White Rose\",\"Lavender\",\"Silver Dust Leaf\"]', 'uploads/products/ren/moonveil.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(13, 2, 'Morning Dew', 'morning-dew', 'Morning Dew Bouquet menghadirkan kesegaran pagi dengan paduan lily putih dan hydrangea biru, mencerminkan awal hari yang cerah dan penuh harapan.', 520000.00, '[\"White Lily\",\"Blue Hydrangea\",\"Eucalyptus\"]', 'uploads/products/ren/morningdew.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(14, 2, 'Daisy Whispers', 'daisy-whispers', 'Daisy Whispers Bouquet adalah simbol keceriaan dan ketulusan. Kombinasi bunga daisy putih dan kuning membuat siapa pun tersenyum melihatnya.', 130000.00, '[\"White Daisy\",\"Yellow Daisy\",\"Green Button Mum\"]', 'uploads/products/ren/daisywhispers.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(15, 2, 'Violet Mist', 'violet-mist', 'Violet Mist Bouquet menghadirkan nuansa misterius dan elegan melalui kombinasi bunga ungu lembut dan putih. Ideal untuk hadiah elegan.', 845000.00, '[\"Purple Rose\",\"White Lily\",\"Lavender\",\"Eucalyptus\"]', 'uploads/products/ren/violetmist.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(16, 2, 'Roselia Grace', 'roselia-grace', 'Roselia Grace Bouquet menghadirkan keanggunan klasik dengan mawar merah muda dan lily putih. Buket ini memancarkan keindahan yang tenang dan berkelas.', 665000.00, '[\"Pink Rose\",\"White Lily\",\"Eucalyptus Leaves\"]', 'uploads/products/ren/roseliagrace.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(17, 2, 'Midnight Bloom', 'midnight-bloom', 'Midnight Bloom Bouquet menghadirkan perpaduan gelap dan mewah dengan bunga ungu tua dan biru kehitaman, cocok untuk acara malam yang elegan.', 150000.00, '[\"Dark Purple Tulip\",\"Blue Iris\",\"Eucalyptus\"]', 'uploads/products/ren/midnightbloom.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(18, 2, 'Lilac Haze', 'lilac-haze', 'Lilac Haze Bouquet menampilkan bunga lilac lembut dengan aroma manis dan warna pastel yang menenangkan, menciptakan suasana romantis nan tenang.', 200000.00, '[\"Lilac\",\"Lavender\",\"White Rose\"]', 'uploads/products/ren/lilachaze.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(19, 3, 'Golden Verse', 'golden-verse', 'Golden Verse Bouquet bersinar dengan pesona keemasan. Kombinasi sunflower, tulip kuning, dan gerbera menghadirkan nuansa ceria dan optimis, sempurna untuk ucapan selamat atau semangat baru.', 100000.00, '[\"Sunflower\",\"Yellow Tulip\",\"Yellow Gerbera Daisy\",\"Solidago (Goldenrod)\",\"Greenery Filler\"]', 'uploads/products/kaning/goldenverse.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(20, 3, 'Velvet Promise', 'velvet-promise', 'Velvet Promise Bouquet memancarkan keanggunan mewah dengan kombinasi mawar merah marun dan lily putih, melambangkan cinta dan janji yang tulus.', 350000.00, '[\"Red Velvet Rose\",\"White Lily\",\"Baby\\u2019s Breath\",\"Eucalyptus Leaves\"]', 'uploads/products/kaning/velvetpromise.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(21, 3, 'Mocha Petals', 'mocha-petals', 'Mocha Petals Bouquet menghadirkan nuansa hangat dan lembut. Campuran bunga dengan warna coklat keemasan dan krim menciptakan kesan elegan dan modern.', 50000.00, '[\"Champagne Rose\",\"Beige Carnation\",\"Brown Chrysanthemum\",\"Eucalyptus\"]', 'uploads/products/kaning/mochapetals.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(22, 3, 'Lilac Veil', 'lilac-veil', 'Lilac Veil Bouquet tampil anggun dengan nuansa ungu lembut dan putih. Cocok untuk momen istimewa yang memancarkan kedamaian dan keindahan.', 120000.00, '[\"Lilac\",\"Lavender\",\"White Rose\",\"Silver Dust Leaf\"]', 'uploads/products/kaning/lilacveil.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(23, 3, 'Rosewood Charm', 'rosewood-charm', 'Rosewood Charm Bouquet menampilkan pesona klasik dengan perpaduan mawar merah muda dan daun kehijauan yang menenangkan.', 75000.00, '[\"Pink Rose\",\"Peach Carnation\",\"Eucalyptus Leaves\",\"Ruscus\"]', 'uploads/products/kaning/rosewoodcharm.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(24, 3, 'Ivory Whisper', 'ivory-whisper', 'Ivory Whisper Bouquet mencerminkan kelembutan dan ketulusan. Kombinasi bunga putih dan krim menghadirkan kesan murni dan elegan.', 85000.00, '[\"White Rose\",\"Cream Tulip\",\"Baby\\u2019s Breath\",\"Eucalyptus\"]', 'uploads/products/kaning/ivorywhisper.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(25, 3, 'Evergreen Tale', 'evergreen-tale', 'Evergreen Tale Bouquet menggabungkan warna hijau alami dengan bunga putih untuk menghadirkan kesan segar, natural, dan penuh kehidupan.', 200000.00, '[\"White Lily\",\"Green Hydrangea\",\"Fern Leaf\",\"Eucalyptus\"]', 'uploads/products/kaning/evergreentale.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(26, 3, 'Blush Haven', 'blush-haven', 'Blush Haven Bouquet menghadirkan kombinasi bunga lembut bernuansa pink pastel yang romantis dan menenangkan.', 95000.00, '[\"Pink Rose\",\"Blush Peony\",\"White Daisy\",\"Eucalyptus\"]', 'uploads/products/kaning/blushhaven.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(27, 4, 'Tulip Tales', 'tulip-tales', 'Tulip Tales Bouquet adalah kisah elegan dari bunga tulip berbagai warna yang menggambarkan cinta dan harapan baru.', 140000.00, '[\"Pink Tulip\",\"Yellow Tulip\",\"White Tulip\",\"Eucalyptus\"]', 'uploads/products/beverly/tuliptales.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(28, 4, 'Sun Dancer', 'sun-dancer', 'Sun Dancer Bouquet penuh energi dan keceriaan. Perpaduan sunflower dan gerbera kuning memberikan semangat positif pada setiap momen.', 115000.00, '[\"Sunflower\",\"Yellow Gerbera Daisy\",\"Solidago\",\"Green Leaves\"]', 'uploads/products/beverly/sundancer.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(29, 4, 'Blush Reverie', 'blush-reverie', 'Blush Reverie Bouquet membawa suasana mimpi romantis dengan bunga berwarna lembut dan aroma manis yang menenangkan.', 90000.00, '[\"Pink Rose\",\"White Chrysanthemum\",\"Peach Carnation\"]', 'uploads/products/beverly/blushreverie.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(30, 4, 'Vanilla Bloom', 'vanilla-bloom', 'Vanilla Bloom Bouquet menonjolkan keindahan klasik bunga putih dan krem yang sederhana namun elegan.', 300000.00, '[\"White Lily\",\"Cream Rose\",\"Eucalyptus\",\"Fern Leaf\"]', 'uploads/products/beverly/vanillabloom.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(31, 4, 'Golden Serenade', 'golden-serenade', 'Golden Serenade Bouquet memadukan warna kuning dan oranye hangat, menggambarkan kehangatan cinta dan persahabatan sejati.', 250000.00, '[\"Yellow Rose\",\"Orange Tulip\",\"Sunflower\",\"Solidago\"]', 'uploads/products/beverly/goldenserenade.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(32, 4, 'Rosy Rhapsody', 'rosy-rhapsody', 'Rosy Rhapsody Bouquet menampilkan kemewahan mawar merah muda dan putih dalam harmoni indah yang menawan.', 1450000.00, '[\"Pink Rose\",\"White Rose\",\"Baby\\u2019s Breath\",\"Eucalyptus\"]', 'uploads/products/beverly/rosyrhapsody.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(33, 4, 'Sunlit Grace', 'sunlit-grace', 'Sunlit Grace Bouquet bercahaya lembut seperti sinar matahari pagi. Kombinasi bunga kuning dan putih memberikan kesan hangat dan damai.', 125000.00, '[\"Yellow Rose\",\"White Lily\",\"Solidago\",\"Green Foliage\"]', 'uploads/products/beverly/sunlitgrace.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(34, 4, 'Apricot Whisper', 'apricot-whisper', 'Apricot Whisper Bouquet menghadirkan kelembutan warna peach dan krim yang elegan, sempurna untuk hadiah penuh cinta dan ketulusan.', 195000.00, '[\"Peach Rose\",\"Cream Tulip\",\"Baby\\u2019s Breath\",\"Eucalyptus Leaves\"]', 'uploads/products/beverly/apricotwhisper.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(35, 4, 'Honey Bloom', 'honey-bloom', 'Honey Bloom Bouquet menggabungkan warna keemasan dan krem untuk menciptakan suasana hangat dan menenangkan seperti cahaya sore hari.', 95000.00, '[\"Sunflower\",\"Yellow Tulip\",\"Cream Carnation\",\"Greenery\"]', 'uploads/products/beverly/honeybloom.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(36, 7, 'Arctic Bloom', 'arctic-bloom', 'Eternal Love Bouquet adalah ekspresi abadi dari kasih mendalam dan komitmen yang tak tergoyahkan. Buket elegan ini menampilkan mawar merah dan putih klasik, melambangkan cinta yang penuh gairah dan pengabdian murni, dilengkapi daun eucalyptus untuk menambah keindahan alami.', 256000.00, '[\"Red Rose\",\"White Rose\",\"Eucalyptus Leaves\"]', 'uploads/products/jardinelle/arcticbloom.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(37, 7, 'Violet Grace', 'violet-grace', 'Sunshine Delight Bouquet adalah perayaan yang memancarkan kehangatan, kebahagiaan, dan energi hidup yang ceria. Buket ini memadukan warna kuning cerah dari bunga matahari, gerbera daisy yang ceria, dan tulip kuning, menciptakan tampilan yang hidup dan menyenangkan untuk setiap kesempatan.', 60000.00, '[\"Sunflower\",\"Gerbera Daisy (Yellow)\",\"Yellow Tulip\",\"Solidago (Goldenrod)\",\"Greenery Filler\"]', 'uploads/products/jardinelle/violetgrace.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(38, 7, 'Moonlight Whisper', 'moonlight-whisper', 'Elegance in Bloom Bouquet adalah rangkaian bunga yang anggun dan memancarkan keindahan abadi. Memadukan mawar merah muda lembut, lily putih yang halus, dan dedaunan hijau yang subur, buket ini sempurna untuk menyampaikan rasa hormat dan kekaguman pada momen spesial.', 490000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/jardinelle/moonlightwhisper.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(39, 7, 'Slate Rose', 'slate-rose', 'Sunshine Delight Bouquet menghadirkan kombinasi warna cerah yang memancarkan kebahagiaan. Buket ini menampilkan bunga matahari, gerbera daisy kuning, tulip kuning, dan dedaunan hijau, sempurna untuk momen yang menyenangkan.', 100000.00, '[\"Sunflower\",\"Gerbera Daisy (Yellow)\",\"Yellow Tulip\",\"Solidago (Goldenrod)\",\"Greenery Filler\"]', 'uploads/products/jardinelle/slaterose.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(40, 7, 'Golden Soft Peach', 'golden-soft-peach', 'Elegance in Bloom Bouquet adalah rangkaian bunga yang anggun dan memancarkan pesona klasik. Buket ini memadukan mawar merah muda lembut, lily putih, baby\'s breath, dan dedaunan eucalyptus untuk kesan yang harmonis.', 87000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\"]', 'uploads/products/jardinelle/goldensoft.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(41, 7, 'Blush Muse', 'blush-muse', 'Romance in Bloom Bouquet adalah ekspresi kasih yang hangat dan penuh gairah. Buket ini memadukan mawar merah dan putih, baby\'s breath (gypsophila), serta daun eucalyptus yang menambah nuansa romantis.', 75000.00, '[\"Red Rose\",\"White Rose\",\"Baby\'s Breath (Gypsophila)\",\"Eucalyptus Leaves\"]', 'uploads/products/jardinelle/blushmuse.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(42, 7, 'Rosé Allure', 'rose-allure', 'Elegance in Bloom Bouquet menampilkan perpaduan lembut antara mawar merah muda, lily putih, baby\'s breath, dan dedaunan eucalyptus, sempurna untuk menyampaikan rasa hormat dan kekaguman.', 95000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/jardinelle/roseallure.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(43, 7, 'Crimson Royale', 'crimson-royale', 'Romance in Bloom Bouquet adalah simbol cinta dan pengabdian yang mendalam. Buket ini menampilkan mawar merah dan putih, baby\'s breath (gypsophila), dan daun eucalyptus untuk menambah kesan romantis.', 175000.00, '[\"Red Rose\",\"White Rose\",\"Baby\'s Breath (Gypsophila)\",\"Eucalyptus Leaves\"]', 'uploads/products/jardinelle/crimsonroyale.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(44, 7, 'Lilac Serenity', 'lilac-serenity', 'Romance in Bloom Bouquet menghadirkan kombinasi lembut mawar merah dan putih, baby\'s breath, serta daun eucalyptus, ideal untuk momen yang penuh kasih.', 90000.00, '[\"Red Rose\",\"White Rose\",\"Baby\'s Breath (Gypsophila)\",\"Eucalyptus Leaves\"]', 'uploads/products/jardinelle/lilacserenity.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(45, 8, 'Daisy Delight', 'daisy-delight', 'Elegance in Bloom Bouquet adalah rangkaian anggun yang memadukan mawar merah muda, lily putih, baby\'s breath, dan dedaunan hijau untuk momen istimewa.', 90000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/florya/daisydelight.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(46, 8, 'Orchid Charm', 'orchid-charm', 'Romance in Bloom Bouquet menampilkan keindahan abadi dengan mawar merah dan putih, baby\'s breath (gypsophila), dan daun eucalyptus yang menambah kesan elegan.', 1250000.00, '[\"Red Rose\",\"White Rose\",\"Baby\'s Breath (Gypsophila)\",\"Eucalyptus Leaves\"]', 'uploads/products/florya/orchidcharm.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(47, 8, 'Golden Meadow', 'golden-meadow', 'Elegance in Bloom Bouquet memadukan mawar merah muda, lily putih, baby\'s breath, dan daun eucalyptus, menciptakan buket yang menawan untuk momen spesial.', 370000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/florya/goldenmeadow.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(48, 8, 'Rose Blush', 'rose-blush', 'Romance in Bloom Bouquet adalah ekspresi cinta dan pengabdian. Buket ini memadukan mawar merah dan putih, baby\'s breath, dan daun eucalyptus untuk nuansa romantis.', 130000.00, '[\"Red Rose\",\"White Rose\",\"Baby\'s Breath (Gypsophila)\",\"Eucalyptus Leaves\"]', 'uploads/products/florya/roseblush.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(49, 8, 'Pure Serenity', 'pure-serenity', 'Romance in Bloom Bouquet memadukan mawar merah dan putih, baby\'s breath, dan daun eucalyptus, ideal untuk momen yang damai dan romantis.', 87000.00, '[\"Red Rose\",\"White Rose\",\"Baby\'s Breath (Gypsophila)\",\"Eucalyptus Leaves\"]', 'uploads/products/florya/pureserenity.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(50, 8, 'Pink Whisper', 'pink-whisper', 'Elegance in Bloom Bouquet menampilkan perpaduan lembut antara mawar merah muda, lily putih, baby\'s breath, dan dedaunan eucalyptus untuk kesan elegan.', 135000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/florya/pinkwhisper.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(51, 8, 'Lavender Grace', 'lavender-grace', 'Elegance in Bloom Bouquet memadukan mawar merah muda, lily putih, baby\'s breath, dan daun eucalyptus untuk buket yang anggun dan menawan.', 95000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/florya/lavendergrace.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(52, 8, 'Sunny Bloom', 'sunny-bloom', 'Elegance in Bloom Bouquet menghadirkan buket yang mewah dan cerah dengan perpaduan mawar merah muda, lily putih, baby\'s breath, dan dedaunan eucalyptus.', 1200000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/florya/sunnybloom.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(53, 8, 'Pearl Whisper', 'pearl-whisper', 'Elegance in Bloom Bouquet adalah rangkaian lembut yang memadukan mawar merah muda, lily putih, baby\'s breath, dan dedaunan eucalyptus untuk momen istimewa.', 145000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/florya/pearlwhisper.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(54, 12, 'Rosy Whisper', 'rosy-whisper', 'Elegance in Bloom Bouquet adalah rangkaian bunga yang anggun dan memancarkan keindahan abadi. Buket ini memadukan mawar merah muda lembut, lily putih, baby\'s breath, dan dedaunan eucalyptus, sempurna untuk menyampaikan rasa hormat dan kekaguman pada setiap momen spesial.', 245000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/lovenique/rosywhisper.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(55, 12, 'Ethereal Luxe', 'ethereal-luxe', 'Romance in Bloom Bouquet adalah ekspresi cinta dan gairah yang mendalam. Buket ini menampilkan mawar merah dan putih, baby\'s breath (gypsophila), dan daun eucalyptus, menciptakan kesan romantis yang menawan untuk setiap momen spesial.', 400000.00, '[\"Red Rose\",\"White Rose\",\"Baby\'s Breath (Gypsophila)\",\"Eucalyptus Leaves\"]', 'uploads/products/lovenique/etherealluxe.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(56, 12, 'Velvet Romance', 'velvet-romance', 'Elegance in Bloom Bouquet memadukan mawar merah muda, lily putih, baby\'s breath, dan dedaunan eucalyptus untuk menciptakan buket yang anggun dan elegan, sempurna untuk momen istimewa.', 590000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/lovenique/velvetromance.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(57, 12, 'Rose I Moc', 'rose-i-moc', 'Elegance in Bloom Bouquet adalah rangkaian lembut yang memadukan mawar merah muda, lily putih, baby\'s breath, dan dedaunan eucalyptus, cocok untuk momen penuh kasih.', 60000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/lovenique/roseimoc.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(58, 12, 'Ruby Elegance', 'ruby-elegance', 'Elegance in Bloom Bouquet menghadirkan buket yang anggun dengan mawar merah muda, lily putih, baby\'s breath, dan dedaunan eucalyptus, ideal untuk mengekspresikan pesona dan keindahan.', 300000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/lovenique/rubyelegance.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(59, 12, 'Blushing Grace', 'blushing-grace', 'Elegance in Bloom Bouquet adalah rangkaian bunga yang anggun dan menawan, memadukan mawar merah muda, lily putih, baby\'s breath, dan daun eucalyptus, sempurna untuk momen penuh keanggunan.', 175000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/lovenique/blushinggrace.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(60, 12, 'Sweetheart Bloom', 'sweetheart-bloom', 'Elegance in Bloom Bouquet menghadirkan buket lembut yang memadukan mawar merah muda, lily putih, baby\'s breath, dan dedaunan eucalyptus, sempurna untuk mengekspresikan kelembutan dan pesona.', 105000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/lovenique/sweetheartbloom.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47'),
(61, 12, 'Crimson Desire', 'crimson-desire', 'Elegance in Bloom Bouquet adalah buket yang memadukan mawar merah muda, lily putih, baby\'s breath, dan dedaunan eucalyptus, menciptakan kesan elegan dan memikat untuk setiap momen spesial.', 350000.00, '[\"Pink Rose\",\"White Lily\",\"Baby\'s Breath\",\"Eucalyptus Leaves\",\"Greenery Filler\"]', 'uploads/products/lovenique/crimsondesire.png', '2025-10-11 21:50:56', '2025-10-12 04:08:47');

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
('c5Wf5PRKWi5hvxMj8VxP8w523Lr98PcATaKWzsAb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkJDWFM0MnBaMG1wUzg3V2lKUVdOMmg1NlNKYlFaRG1WUHVqRHdtMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1761301236);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `florist_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `florist_id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 5, 'Pelayanannya cepat dan bouquet-nya super cantik! Bunga segar dan tahan lama 🌷', '2025-10-11 22:22:52', '2025-10-11 22:22:52'),
(2, 3, 6, 4, 'Desain bunga sangat elegan, tapi pengiriman agak telat sedikit. Overall puas banget 💐', '2025-10-11 22:22:52', '2025-10-11 22:22:52'),
(3, 3, 5, 5, 'Pesanan untuk acara lamaran, hasilnya luar biasa indah! Terima kasih tim Bloomify 💞', '2025-10-11 22:22:52', '2025-10-11 22:22:52'),
(4, 1, 5, 5, 'Bunga ulang tahun yang saya pesan sangat memukau! Kualitasnya top dan pengirimannya tepat waktu 🎉', '2025-10-12 18:42:51', '2025-10-12 18:42:51'),
(5, 2, 6, 4, 'Sangat membantu untuk acara pernikahan saya. Bunga-bunganya segar dan cantik, hanya saja ada sedikit kesalahan di alamat pengiriman. Tapi tetap puas! 👰🤵', '2025-10-12 18:42:51', '2025-10-12 18:42:51'),
(6, 3, 1, 5, 'Layanan pelanggan yang luar biasa! Mereka membantu saya memilih bunga yang sempurna untuk hari jadi kami. Terima kasih banyak! 💐❤️', '2025-10-12 18:42:51', '2025-10-12 18:42:51'),
(7, 7, 1, 3, 'Bunga yang saya terima cukup bagus, tapi ada beberapa kelopak yang sedikit layu. Mungkin karena pengiriman yang lama. Namun, secara keseluruhan saya puas dengan layanan mereka. 🌸', '2025-10-12 18:42:51', '2025-10-12 18:42:51'),
(8, 8, 5, 5, 'Pengalaman belanja yang menyenangkan! Situs web mereka mudah digunakan dan proses pemesanan sangat lancar. Bunga yang saya pesan tiba dalam kondisi sempurna. Terima kasih! 🌷😊', '2025-10-12 18:42:51', '2025-10-12 18:42:51'),
(9, 12, 6, 4, 'Bunga yang saya pesan untuk acara kantor sangat memukau! Semua orang memuji keindahannya. Hanya saja, pengiriman sedikit terlambat. Tapi tetap puas dengan kualitasnya. 🌹🏢', '2025-10-12 18:42:51', '2025-10-12 18:42:51'),
(11, 4, 6, 5, 'Keren banget sumpah', '2025-10-17 09:32:05', '2025-10-17 09:32:05'),
(12, 4, 6, 5, 'Ayudya Cantik Uyy', '2025-10-20 10:56:27', '2025-10-20 10:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `florists_id` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','florist','admin') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `florists_id`, `full_name`, `phone_number`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ryan kana nyola', '081234567890', 'cobapertama@gmail.com', '$2y$12$k0OYR6hmZsO9S2IW4yiAeOBguk9Vz6nvfrphrkLJKSwGKjIhlXvHe', 'user', NULL, '2025-10-08 00:43:35', '2025-10-08 00:43:35'),
(5, NULL, 'Ryan Kana Nyola', '082253834484', 'user1@gmail.com', '$2y$12$.TWF0toZPjM045.eJzzUKueRYIjSa22i4AZJEv7IATl76ElF2os1y', 'user', NULL, '2025-10-08 08:24:36', '2025-10-08 08:24:36'),
(6, NULL, 'Ayudya Canssssss', '085640583621', 'ayudya@gmail.com', '$2y$12$ssTkcWYGQ5cue6izMqtlKur45hV7N.Aa5CfmB6eHvOoQzkpHroTO.', 'user', NULL, '2025-10-10 21:49:54', '2025-10-10 21:49:54'),
(8, 1, 'Kaninara Florist Owner', '081234567801', 'kaninaraflorist-florist@bloomify.com', '$2y$12$pPeuTuvvn9ivmfpyI/ATUODajd7IXrY.URr/uDnFKZzCOcVbFnoeS', 'florist', NULL, '2025-10-15 02:32:47', '2025-10-15 02:32:47'),
(9, 2, 'Ren Florist Co. Owner', '081234567802', 'renfloristco.-florist@bloomify.com', '$2y$12$vpaKW9IrzboTiLKQTfUZgOqgBQncSlX1tf9UpKshOX6PBId3DeNlS', 'florist', NULL, '2025-10-15 02:32:48', '2025-10-15 02:32:48'),
(10, 3, 'Kaning Bouquet and Gift Florist Owner', '081234567803', 'kaningbouquetandgiftflorist-florist@bloomify.com', '$2y$12$DGuHaJTaMDvT.Wd.CZODIOrqiwCelpZ/taWgn/6VekKot8LUJpDw6', 'florist', NULL, '2025-10-15 02:32:48', '2025-10-15 02:32:48'),
(11, 4, 'Beverly Florist Jogja Owner', '081234567804', 'beverlyfloristjogja-florist@bloomify.com', '$2y$12$JcOdW.pb6tiYBW9X8hiS8eKZYkFa8dEnLM7oIXDiEWsvL7UBtBi6.', 'florist', NULL, '2025-10-15 02:32:48', '2025-10-15 02:32:48'),
(12, 5, 'Halia Florist Owner', '081234567805', 'haliaflorist-florist@bloomify.com', '$2y$12$E1f0KiIT18U6etakKAkydOwxCgu52LKbgdbHcGNZc/yjBG8Wgs5n2', 'florist', NULL, '2025-10-15 02:32:48', '2025-10-15 02:32:48'),
(13, 6, 'Lupy Florist Owner', '081234567806', 'lupyflorist-florist@bloomify.com', '$2y$12$5oCAzUybfeZL2FvWGpSa6.Xcc6p7Icze.OPvWozlWsClfUe7Pkjja', 'florist', NULL, '2025-10-15 02:32:49', '2025-10-15 02:32:49'),
(14, 7, 'Blumefleur Florist Jakarta Owner', '081234567807', 'blumefleurfloristjakarta-florist@bloomify.com', '$2y$12$XXblS9CbndS6iMsBjm.2re1m0QzY7LYZAREqiVeBNVO1i6ys6gE7m', 'florist', NULL, '2025-10-15 02:32:49', '2025-10-23 13:40:07'),
(15, 8, 'SERA Florist Bandung Owner', '081234567808', 'serafloristbandung-florist@bloomify.com', '$2y$12$oGaoXMfOYkF2Q29THUIOLe0VYEB/8DtkZ5A1H7mhmMPQhhn8m6aVC', 'florist', NULL, '2025-10-15 02:32:49', '2025-10-23 13:40:07'),
(16, 9, 'Outerbloom Florist Jakarta Owner', '081234567809', 'outerbloomfloristjakarta-florist@bloomify.com', '$2y$12$/gNFpn8kwZ36qx3JyuLwtO0y1RxkRXFOJH1RQfRDO33jmzWV4d8KS', 'florist', NULL, '2025-10-15 02:32:50', '2025-10-23 13:40:08'),
(17, 10, 'Tiara Florist Owner', '081234567810', 'tiaraflorist-florist@bloomify.com', '$2y$12$8EF1z2oS0X/vLPcGo79Kj.BAISJI8XweZcjsgBpxuK24E8U1LZ8T6', 'florist', NULL, '2025-10-15 02:32:50', '2025-10-23 13:40:08'),
(18, 11, 'Park Florist Owner', '081234567811', 'parkflorist-florist@bloomify.com', '$2y$12$fq/jpd5Oa87F8TOc0weZUuVE16pKkUhZ2wVlY7br.JiWo2FsJywvK', 'florist', NULL, '2025-10-15 02:32:50', '2025-10-23 13:40:08'),
(19, 12, 'Kayoon Flower Market Owner', '081234567812', 'kayoonflowermarket-florist@bloomify.com', '$2y$12$BjEhMtCBZgAVs6Qf9xrR/.Q0mKkHD/rqJzcz9/Xxgihx.yVrID55.', 'florist', NULL, '2025-10-15 02:32:50', '2025-10-23 13:40:08'),
(20, NULL, 'ayud cantik bgt bgt bgt 100%', '081', 'admin12@gmail.com', '$2y$12$4vssmgzNvA6f/wtCQnH5H.SgYkEJgGDCJ/cV.hIUwgBOOUpRSymDi', 'user', NULL, '2025-10-15 03:56:44', '2025-10-15 03:56:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `florists`
--
ALTER TABLE `florists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `florists_user_id_foreign` (`user_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_slug_unique` (`slug`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_florist_id_foreign` (`florist_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_florists_id_foreign` (`florists_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_florist_id_foreign` (`florist_id`),
  ADD KEY `testimonials_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_florists_id_foreign` (`florists_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `florists`
--
ALTER TABLE `florists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `florists`
--
ALTER TABLE `florists`
  ADD CONSTRAINT `florists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_florist_id_foreign` FOREIGN KEY (`florist_id`) REFERENCES `florists` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_florists_id_foreign` FOREIGN KEY (`florists_id`) REFERENCES `florists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_florist_id_foreign` FOREIGN KEY (`florist_id`) REFERENCES `florists` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `testimonials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_florists_id_foreign` FOREIGN KEY (`florists_id`) REFERENCES `florists` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
