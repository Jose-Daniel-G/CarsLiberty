-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2025 a las 23:57:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cars_liberty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `color` varchar(255) NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `profesor_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `agendas`
--

INSERT INTO `agendas` (`id`, `title`, `start`, `end`, `color`, `cliente_id`, `profesor_id`, `curso_id`, `created_at`, `updated_at`) VALUES
(12, 'A1', '2025-10-13 06:00:00', '2025-10-13 09:00:00', '#e82216', 1, 1, 1, '2025-10-11 23:51:01', '2025-10-11 23:51:01'),
(13, 'A1', '2025-10-13 13:00:00', '2025-10-13 16:00:00', '#e82216', 2, 1, 1, '2025-10-12 02:01:49', '2025-10-12 02:01:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `agenda_id` bigint(20) UNSIGNED NOT NULL,
  `asistio` tinyint(1) NOT NULL DEFAULT 1,
  `penalidad` int(11) NOT NULL DEFAULT 0,
  `liquidado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_pago_multa` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `cliente_id`, `agenda_id`, `asistio`, `penalidad`, `liquidado`, `fecha_pago_multa`, `created_at`, `updated_at`) VALUES
(12, 1, 12, 0, 60000, 0, NULL, '2025-10-11 23:51:01', '2025-10-11 23:51:01'),
(13, 2, 13, 0, 60000, 0, NULL, '2025-10-12 02:01:49', '2025-10-12 02:01:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'accion', 'accion', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(2, 'crimen', 'crimen', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(3, 'asaltos', 'asaltos', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(4, 'infidelidades', 'infidelidades', '2025-09-26 08:19:41', '2025-09-26 08:19:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cc` int(11) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `celular` int(11) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `contacto_emergencia` int(11) DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `cc`, `genero`, `celular`, `direccion`, `contacto_emergencia`, `observaciones`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Cliente', 'alracona', 12312753, 'M', 12395113, 'Cll 9 oeste', 65495113, 'le irrita estar cerca del povo', 8, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(2, 'Fancisco Antonio', 'Grijalba', 23548965, 'M', 987654321, 'Cll 7 oeste', 65495113, 'migrana', 9, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(3, 'ARGEMIRO', 'ESCOBAR', 2354765, 'M', 987654321, 'Cll 7 oeste', 65495113, 'migrana', 10, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(4, 'Gaspar', 'Ijaji', 23547657, 'M', 987654321, 'Cll 7 oeste', 65495113, 'migrana', 11, '2025-09-26 08:19:40', '2025-09-26 08:19:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_curso`
--

CREATE TABLE `cliente_curso` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `horas_realizadas` int(11) NOT NULL DEFAULT 0,
  `fecha_realizacion` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente_curso`
--

INSERT INTO `cliente_curso` (`id`, `cliente_id`, `curso_id`, `horas_realizadas`, `fecha_realizacion`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 30, '2025-10-12 03:12:44', '2025-10-12 03:12:44', '2025-10-12 03:12:44'),
(2, 1, 2, 20, '2025-10-12 03:12:44', '2025-10-12 03:12:44', '2025-10-12 03:12:44'),
(3, 2, 1, 0, NULL, NULL, NULL),
(4, 2, 3, 0, NULL, NULL, NULL),
(5, 3, 3, 0, NULL, NULL, NULL),
(6, 4, 2, 0, NULL, NULL, NULL),
(8, 1, 1, 10, NULL, '2025-10-12 03:12:44', '2025-10-12 03:12:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_contact` varchar(255) NOT NULL,
  `logo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `horas_requeridas` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `horas_requeridas`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'A1', 'Curso de conducción para obtener licencia tipo A1.', 15, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(2, 'B2', 'Curso de conducción para obtener licencia tipo B2.', 20, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(3, 'C1', 'Licencia tipo B1. PARA CARRO PUBLICO', 30, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `historial_cursos`
--

CREATE TABLE `historial_cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_completado` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dia` varchar(255) NOT NULL,
  `hora_inicio` time NOT NULL,
  `tiempo` time NOT NULL,
  `profesor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `dia`, `hora_inicio`, `tiempo`, `profesor_id`, `created_at`, `updated_at`) VALUES
(1, 'LUNES', '06:00:00', '19:00:00', 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(2, 'MARTES', '06:00:00', '18:00:00', 2, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(3, 'MIERCOLES', '06:00:00', '20:00:00', 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(4, 'JUEVES', '06:00:00', '14:00:00', 3, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(5, 'JUEVES', '06:00:00', '14:00:00', 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(6, 'VIERNES', '06:00:00', '20:00:00', 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(7, 'SABADO', '06:00:00', '20:00:00', 3, '2025-09-26 08:19:40', '2025-09-26 08:19:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_profesor_curso`
--

CREATE TABLE `horario_profesor_curso` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `horario_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `profesor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horario_profesor_curso`
--

INSERT INTO `horario_profesor_curso` (`id`, `horario_id`, `curso_id`, `profesor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(2, 2, 1, 2, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(3, 3, 2, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(4, 4, 3, 3, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(5, 5, 1, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(6, 6, 1, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(7, 7, 1, 3, '2025-09-26 08:19:40', '2025-09-26 08:19:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `url`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, '/images/uploads/1757514049_team-0.jpg', 1, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(2, '/images/uploads/1757597419_Austin.jpg', 2, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(3, '/images/uploads/1757598403_boom.jpg', 3, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(4, '/images/uploads/1757598817_scenes.png', 4, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(5, '/images/uploads/1757599019_op.jpg', 5, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(6, '/images/uploads/1757600444_op (1).png', 6, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(7, '/images/uploads/1757600616_BOOM.png', 7, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(8, '/images/uploads/1757600672_2background-new.png', 8, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(9, '/images/uploads/1757600745_new-1.jpg', 9, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(10, '/images/uploads/1757600815_team.png', 10, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(11, '/images/uploads/1757600891_40.JUAN.jpg', 11, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(12, '/images/uploads/1757600973_bomm.png', 12, 'App\\Models\\Post', '2025-09-26 08:19:42', '2025-09-26 08:19:42'),
(13, 'storage/uploads/1760273179_5.jpg', 13, 'App\\Models\\Post', '2025-10-12 12:46:19', '2025-10-12 12:46:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_tipos_vehiculos_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2022_11_10_180127_create_categories_table', 1),
(8, '2022_11_10_180156_create_posts_table', 1),
(9, '2022_11_10_182031_create_tags_table', 1),
(10, '2022_11_10_182335_create_post_tag_table', 1),
(11, '2024_01_30_134942_create_picoyplaca_table', 1),
(12, '2024_01_30_134943_create_vehiculos_tables', 1),
(13, '2024_03_27_161045_create_sessions_table', 1),
(14, '2024_03_30_163135_create_images_table', 1),
(15, '2024_09_05_161844_create_permission_tables', 1),
(16, '2024_09_13_011407_create_secretarias_table', 1),
(17, '2024_09_13_215832_create_clientes_table', 1),
(18, '2024_09_14_045954_create_cursos_table', 1),
(19, '2024_09_14_051021_create_profesors_table', 1),
(20, '2024_09_14_051126_create_horarios_table', 1),
(21, '2024_09_19_215901_create_agendas_table', 1),
(22, '2024_09_23_220250_create_configs_table', 1),
(23, '2024_10_06_010548_create_cliente_curso_table', 1),
(24, '2024_10_07_214718_create_asistencias_table', 1),
(25, '2024_11_03_180502_create_historial_cursos_table', 1),
(26, '2025_03_28_145806_create_horario_profesor_curso_table', 1),
(27, '2025_09_19_100841_create_notifications_table', 1),
(28, '2025_09_19_145756_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11),
(6, 'App\\Models\\User', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('243d5aab-1210-486e-955b-8be33f19555d', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 14, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('2563847f-e00e-4f11-ad81-c6d1d94db8ee', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 15, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('2bc3c06d-8d65-4de7-8f34-285c4170023e', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 7, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('342ec2f7-d96c-460c-894d-a1dfbb06cd44', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 13, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('64cca7c4-5975-4b07-a8a8-a5184155c2f8', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 21, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('68a9d71a-ea68-4538-b468-ba1670be930f', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 19, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('6d226db6-eccd-42e8-8cbd-95782bdcfbd0', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 12, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('99189055-c818-4077-adf2-a0d5b9f4d0e5', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('99b92310-4cac-4747-9537-2907dea40232', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 18, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('9b7260f1-476f-4c76-aece-6a3aa824bce3', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 20, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('9e059925-0e64-454e-9ed3-dc918f013da9', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 6, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('a6454e53-900b-411f-aeae-3eaa9a3586a4', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 9, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('b3e08359-100e-406e-81f4-19271ffe65a3', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 10, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('c4047cb6-7996-4dbc-8d4a-4cdc28259fe9', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 17, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('cbda8500-c086-4897-a3d1-4e9795255ee4', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 1, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('cf056e6c-c143-41d6-b20d-20c89b0ddca0', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 11, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('d9605fb8-c6dd-44fa-adf1-b313108aa04f', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 16, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('f376737d-1c75-40b8-b2a1-90809168f981', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 8, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', '2025-10-12 12:46:58', '2025-10-12 12:46:22', '2025-10-12 12:46:58'),
('f8b91945-6531-40ca-8c44-fd6b30248c23', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22'),
('ffda83d5-f420-4d88-ab2e-428ecac984fe', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"post\":13,\"title\":\"el\",\"description\":\"nacio ayer\",\"time\":\"hace 1 segundo\"}', NULL, '2025-10-12 12:46:22', '2025-10-12 12:46:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin.home', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(2, 'admin.index', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(3, 'admin.config.index', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(4, 'admin.config.create', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(5, 'admin.config.store', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(6, 'admin.config.show', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(7, 'admin.config.edit', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(8, 'admin.config.destroy', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(9, 'admin.secretarias.index', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(10, 'admin.secretarias.create', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(11, 'admin.secretarias.store', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(12, 'admin.secretarias.show', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(13, 'admin.secretarias.edit', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(14, 'admin.secretarias.destroy', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(15, 'admin.clientes.index', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(16, 'admin.clientes.create', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(17, 'admin.clientes.store', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(18, 'admin.clientes.show', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(19, 'admin.clientes.edit', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(20, 'admin.clientes.destroy', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(21, 'admin.cursos.index', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(22, 'admin.cursos.create', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(23, 'admin.cursos.store', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(24, 'admin.cursos.show', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(25, 'admin.cursos.edit', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(26, 'admin.cursos.destroy', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(27, 'admin.profesores.index', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(28, 'admin.profesores.create', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(29, 'admin.profesores.store', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(30, 'admin.profesores.show', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(31, 'admin.profesores.edit', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(32, 'admin.profesores.destroy', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(33, 'admin.profesores.pdf', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(34, 'admin.profesores.reportes', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(35, 'admin.horarios.index', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(36, 'admin.horarios.create', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(37, 'admin.horarios.store', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(38, 'admin.horarios.show', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(39, 'admin.horarios.edit', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(40, 'admin.agendas.index', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(41, 'admin.agendas.create', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(42, 'admin.agendas.store', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(43, 'admin.agendas.show', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(44, 'admin.agendas.edit', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(45, 'admin.agendas.update', 'web', '2025-09-26 08:19:35', '2025-09-26 08:19:35'),
(46, 'admin.agendas.destroy', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(47, 'admin.vehiculos.index', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(48, 'admin.vehiculos.create', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(49, 'admin.vehiculos.update', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(50, 'admin.vehiculos.pico_y_placa.index', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(51, 'admin.vehiculos.pico_y_placa.create', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(52, 'admin.vehiculos.pico_y_placa.update', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(53, 'show_datos_cursos', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(54, 'admin.horarios.show_reserva_profesores', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(55, 'admin.show_reservas', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(56, 'admin.listUsers', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(57, 'admin.reservas.edit', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(58, 'admin.asistencias.index', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(59, 'admin.asistencias.inasistencias', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(60, 'admin.horarios', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(61, 'permissions.index', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(62, 'permissions.create', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(63, 'permissions.edit', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(64, 'permissions.delete', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(65, 'roles.index', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(66, 'roles.create', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(67, 'roles.edit', 'web', '2025-09-26 08:19:36', '2025-09-26 08:19:36'),
(68, 'roles.destroy', 'web', '2025-09-26 08:19:37', '2025-09-26 08:19:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `picoyplaca`
--

CREATE TABLE `picoyplaca` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dia` varchar(255) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fin` time NOT NULL,
  `placas_reservadas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `picoyplaca`
--

INSERT INTO `picoyplaca` (`id`, `dia`, `horario_inicio`, `horario_fin`, `placas_reservadas`, `created_at`, `updated_at`) VALUES
(1, 'Lunes', '07:00:00', '20:00:00', '7 y 8', '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(2, 'Martes', '07:00:00', '20:00:00', '9 y 0', '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(3, 'Miércoles', '07:00:00', '20:00:00', '1 y 2', '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(4, 'Jueves', '07:00:00', '20:00:00', '3 y 4', '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(5, 'Viernes', '07:00:00', '20:00:00', '5 y 6', '2025-09-26 08:19:40', '2025-09-26 08:19:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `extract` text DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `extract`, `body`, `status`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Cali Renace', 'cali-renace', 'videojuego desarrollado para la universidad AUNAR como proyecto de grado de ingenieria', 'videojuego desarrollado para la universidad AUNAR como proyecto de grado de ingenieria', '1', 1, 1, '2025-09-10 19:20:49', '2025-09-10 19:20:49'),
(2, 'austin', 'austin', '', '123', '1', 1, 2, '2025-09-11 18:30:19', '2025-09-11 18:30:19'),
(3, 'Boom', 'boom', '', 'videogame created at my 18 in the high school, in a group called club smart', '1', 1, 1, '2025-09-11 18:46:43', '2025-09-11 18:46:43'),
(4, 'Simulador Emprende', 'simulador-emprende', 'Second videogame as a grade project of unicatolica university', 'Video games have experienced tremendous popularity worldwide thanks to the advanced technology they have developed. Often, video games aren\'t just created for entertainment; they have also been able to generate different, fun ways to learn while also being entertaining. There are learning games that use puzzles to help you solve these problems, either by providing clues or suggestions.', '1', 1, 1, '2025-09-11 18:53:37', '2025-09-11 18:53:37'),
(5, 'Cali Renace Videojuego civico de Cali (2025 08 23)', 'cali-renace-videojuego-civico-de-cali-2025-08-23', '', 'Individual responsibility contributes positively to the city\'s reputation. Despite the challenges, every resident must begin to act differently, embracing Cali\'s diversity. The city has the potential to be better than it was in the 1970s, and by actively contributing, we can forge a diverse, united, and civilized Cali that will be remembered and fill us with pride.', '1', 1, 1, '2025-09-11 18:56:59', '2025-09-11 18:56:59'),
(6, 'Cali Renace Levels', 'cali-renace-levels', '', 'Scenes of video game', '1', 1, 1, '2025-09-11 19:20:44', '2025-09-11 19:20:44'),
(7, 'First creation', 'first-creation', '', 'Construct 2 is a game engine and development tool designed to create 2D games without needing to write traditional code. It uses a visual, drag-and-drop interface with event-based logic, which makes it very beginner-friendly.', '1', 1, 1, '2025-09-11 19:23:36', '2025-09-11 19:23:36'),
(8, 'Login', 'login', '', 'this is the logo of login of this app', '1', 1, 1, '2025-09-11 19:24:32', '2025-09-11 19:24:32'),
(9, 'Corsa Racer Template', 'corsa-racer-template', '', 'it\'s from a template what I\'ve use before', '1', 1, 1, '2025-09-11 19:25:45', '2025-09-11 19:25:45'),
(10, 'future teamwork', 'future-teamwork', '', 'I ask to God for this desire', '1', 1, 1, '2025-09-11 19:26:55', '2025-09-11 19:26:55'),
(11, 'Juan Great Developer', 'juan-great-developer', '', 'he had win the price of year\'s engineer', '1', 1, 1, '2025-09-11 19:28:11', '2025-09-11 19:28:11'),
(12, 'youtube channel', 'youtube-channel', '', 'https://www.youtube.com/@josedanielgrijalbaosorio7431', '1', 1, 1, '2025-09-11 19:29:33', '2025-09-11 19:29:33'),
(13, 'el', 'el', NULL, 'nacio ayer', '1', 1, 2, '2025-10-12 12:46:19', '2025-10-12 12:46:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesors`
--

CREATE TABLE `profesors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesors`
--

INSERT INTO `profesors` (`id`, `nombres`, `apellidos`, `telefono`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Profesor', 'Lewis', '4564564565', 4, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(2, 'TEACHER', 'Gallardo', '432324324', 5, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(3, 'Julio Profe', 'Valdes', '123123213', 6, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(4, 'Martin Profe', 'Valdes', '123123213', 7, '2025-09-26 08:19:39', '2025-09-26 08:19:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superAdmin', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(2, 'admin', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(3, 'secretaria', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(4, 'profesor', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(5, 'cliente', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34'),
(6, 'espectador', 'web', '2025-09-26 08:19:34', '2025-09-26 08:19:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(16, 3),
(17, 1),
(17, 2),
(17, 3),
(18, 1),
(18, 2),
(18, 3),
(19, 1),
(19, 2),
(19, 3),
(20, 1),
(20, 2),
(20, 3),
(21, 1),
(21, 2),
(21, 3),
(22, 1),
(22, 2),
(22, 3),
(23, 1),
(23, 2),
(23, 3),
(24, 1),
(24, 2),
(24, 3),
(25, 1),
(25, 2),
(25, 3),
(26, 1),
(26, 2),
(26, 3),
(27, 1),
(27, 2),
(27, 3),
(28, 1),
(28, 2),
(28, 3),
(29, 1),
(29, 2),
(29, 3),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(31, 2),
(31, 3),
(32, 1),
(32, 2),
(32, 3),
(33, 1),
(33, 2),
(33, 3),
(34, 1),
(34, 2),
(34, 3),
(35, 1),
(35, 2),
(35, 3),
(36, 1),
(36, 2),
(36, 3),
(37, 1),
(37, 2),
(37, 3),
(38, 1),
(38, 2),
(38, 3),
(39, 1),
(39, 2),
(39, 3),
(40, 1),
(40, 2),
(40, 3),
(40, 5),
(41, 1),
(41, 2),
(41, 3),
(41, 5),
(42, 1),
(42, 2),
(42, 3),
(42, 5),
(43, 1),
(43, 2),
(43, 3),
(43, 5),
(44, 1),
(44, 2),
(44, 3),
(45, 1),
(45, 2),
(45, 3),
(46, 1),
(46, 2),
(46, 3),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(53, 2),
(53, 3),
(53, 5),
(54, 1),
(54, 2),
(54, 3),
(55, 1),
(55, 2),
(55, 3),
(55, 5),
(56, 1),
(56, 2),
(56, 3),
(57, 1),
(57, 2),
(57, 3),
(58, 1),
(58, 2),
(58, 3),
(58, 4),
(59, 1),
(59, 2),
(59, 3),
(60, 1),
(60, 2),
(60, 3),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretarias`
--

CREATE TABLE `secretarias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `cc` int(11) NOT NULL,
  `celular` varchar(100) NOT NULL,
  `fecha_nacimiento` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `secretarias`
--

INSERT INTO `secretarias` (`id`, `nombres`, `apellidos`, `cc`, `celular`, `fecha_nacimiento`, `direccion`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Secretaria', 'Catrana', 1112036545, '3147078256', '22/10/2010', 'calle 5 o este', 3, '2025-09-26 08:19:39', '2025-09-26 08:19:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
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
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('RIx5K6LjGicstBqd8epPHAn9qpBhvu22Rznltg6P', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN0VsdTlNcmdBNkhlS1o5Q2RCQ3VNbmNrb25wM0ZxM2RwWk9pS0p3NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2VyL3Byb2ZpbGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJEl0dzJXNjVxdDRuSVoybEw5WnVZMWVWeXEvVGdXWEthZ2J0RUdYUS94SFUudzVqVHN5ZnRXIjt9', 1760301314),
('zeeT52EwDhLhuKhLjDLDn4wvFH79qwaLuopGFmsP', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaHM2YTByZm5IQk93aUI5YmxVaElWQjY5Mk5nZVYwQWszdWZabnpZdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZG1pbi9wcm9mZXNvci9hc2lzdGVuY2lhIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRtVUhlWEJoTlNETktzak92b0p5d0VlZFRtTmNhajVYcUNZbDc1NUd0S0ZSdGZqM05sMjZkMiI7fQ==', 1760300306);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `color`, `created_at`, `updated_at`) VALUES
(1, 'sit', 'sit', 'yellow', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(2, 'ut', 'ut', 'yellow', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(3, 'cum', 'cum', 'purple', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(4, 'odio', 'odio', 'purple', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(5, 'aut', 'aut', 'pink', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(6, 'quos', 'quos', 'red', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(7, 'adipisci', 'adipisci', 'red', '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(8, 'ducimus', 'ducimus', 'pink', '2025-09-26 08:19:41', '2025-09-26 08:19:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_vehiculos`
--

CREATE TABLE `tipos_vehiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_vehiculos`
--

INSERT INTO `tipos_vehiculos` (`id`, `tipo`) VALUES
(4, 'hatchback'),
(3, 'pickup'),
(1, 'sedan'),
(2, 'suv');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@email.com', '2025-09-26 08:19:38', '$2y$10$NDsYUJAnJ7YkcjRz1VkiKudD/fdljNPlaYd7yeCUe9NOP5N7FGa2W', NULL, NULL, NULL, 'HIUDdgAy8FQJB8U7rESpaKuZFCB5or85cH1upDxvhud9rvCG7HJseNyFI5pZ', NULL, NULL, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(2, 'Jose Daniel Grijalba Osorio', 'jose.jdgo97@gmail.com', '2025-09-26 08:19:39', '$2y$10$mUHeXBhNSDNKsjOvoJywEedTmNcaj5XqCYl755GtKFRtfj3Nl26d2', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(3, 'Secretaria', 'secretaria@email.com', '2025-09-26 08:19:39', '$2y$10$jsdB1SCNYMpx.i9kn1HNe.jdyIz30YjPH/4hbiNfNF9xbCJRLxm/m', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(4, 'Profesor', 'profesor@email.com', '2025-09-26 08:19:39', '$2y$10$Itw2W65qt4nIZ2lL9ZuY1eVyq/TgWXKagbtEGXQ/xHU.w5jTsyftW', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(5, 'TEACHER', 'profesor1@email.com', '2025-09-26 08:19:39', '$2y$10$Jgvues4OI8v7W2JVTIiqguuyHDi/6MHBCWAqXI0DSGXiJ5UZxLyNO', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(6, 'Julio Profe', 'profesor2@email.com', '2025-09-26 08:19:39', '$2y$10$I.mQ4iREGcb0zGqq4jkZzeUY7BKqJCWHdiHLxemJu9SE1EawvN6/K', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(7, 'Martin Profe', 'profesor3@email.com', '2025-09-26 08:19:39', '$2y$10$Xv/RB12MHz1rkdG2DZlPN.nA7M/G7VYsJbIw1IxLVFEhHJsFkdp0W', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:39', '2025-09-26 08:19:39'),
(8, 'Cliente', 'cliente@email.com', '2025-09-26 08:19:40', '$2y$10$cOokCcWA13pVX1nvUuvnEeKt2dRG/x3giyFEqG4rXxHUTzHCx7os.', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(9, 'Fancisco Antonio Grijalba', 'francisco.grijalba@email.com', '2025-09-26 08:19:40', '$2y$10$ddPMwmL6.MFp/r4wI2y5veD9g6bA.vuf8qbYmpV4AzS.adSf78PXq', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(10, 'ARGEMIRO ESCOBAR GUTIERRES', 'argemiro.escobar@email.com', '2025-09-26 08:19:40', '$2y$10$JeoOpqYpXJmHEQJ38QgQSuQi93EILer.KYlGXHb5E.3LSdcB57wHK', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(11, 'Gaspar', 'gaspar@email.com', '2025-09-26 08:19:40', '$2y$10$YcQ.Yo9VOXSDbyc8WZFDm./YExdIeg7UEfVkE4uIMaR8/BVWTJlFq', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(12, 'Espectador', 'espectador@email.com', '2025-09-26 08:19:40', '$2y$10$lpdCqk5j0WGDA3IFCdjDdOgQ5041./6HK9dp6aotD58TLVwKULiT.', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(13, 'Lysanne Orn', 'ardella14@example.org', '2025-09-26 08:19:40', '$2y$10$VXPmIBMHnjbHx2CDKElMCeXHXMqv0ZdNczvdf7tfS6n0MoR2.3zr2', NULL, NULL, NULL, 'tl3vrg06nM', NULL, NULL, 1, '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(14, 'Bill Lowe', 'vicky46@example.com', '2025-09-26 08:19:41', '$2y$10$4gEnFHr9m56gB5marVVoPOaKK3ewH/cVFPXDJMjU3QHhxwes9O556', NULL, NULL, NULL, 'qTUqpDt88m', NULL, NULL, 1, '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(15, 'Marcos Block', 'eugene.barton@example.com', '2025-09-26 08:19:41', '$2y$10$5KiP4DaLVm0JP3Tfl7DNOOWmbuoUs3tnYJmGnbWxhyLZoNXxqzu4O', NULL, NULL, NULL, 'xKDj49nCGN', NULL, NULL, 1, '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(16, 'Mr. Stone Pacocha', 'enrique23@example.net', '2025-09-26 08:19:41', '$2y$10$bzHO6OmaNeBhSUMcHMbzr.vExRQXocdvJixFgAXwsmZ8V7ZocZt9S', NULL, NULL, NULL, 'iObaWlzaNY', NULL, NULL, 1, '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(17, 'Dawn Pacocha', 'santina40@example.com', '2025-09-26 08:19:41', '$2y$10$..QCZi6lyiJeKtWouIODh.oqZt.A3eMDggYrtMsbhfATpYWNZxAk.', NULL, NULL, NULL, 'Pr3u8XYYAL', NULL, NULL, 1, '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(18, 'Miracle Botsford', 'geo.jacobi@example.net', '2025-09-26 08:19:41', '$2y$10$Ba5hMjWFGuhm901MRISIBunPkeSPYyoRmMqC3GOyCsBAE.z1vlbIS', NULL, NULL, NULL, 'mOTNJKWDb9', NULL, NULL, 1, '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(19, 'Miles Rodriguez', 'ideckow@example.net', '2025-09-26 08:19:41', '$2y$10$HmsM/QRc8ZmyE/oOTY9b2u7cYCZMKGIAHoAEebb9imOWYB60ycE66', NULL, NULL, NULL, 'wObhMtQMtC', NULL, NULL, 1, '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(20, 'Brian Conn', 'wehner.cordelia@example.org', '2025-09-26 08:19:41', '$2y$10$6Wdi7xOSnqZQRBYYYLX8Vui.Tkd2wjfAMb0tsik..OZPlSsofPvTq', NULL, NULL, NULL, 'W0LrSV0FOp', NULL, NULL, 1, '2025-09-26 08:19:41', '2025-09-26 08:19:41'),
(21, 'Omari Stark', 'goldner.lilly@example.org', '2025-09-26 08:19:41', '$2y$10$GdvPdhOKItN3QbEp6Y2dv.ce9o4G6RmwYdrbGmBN0Qsx.JlCdeHFC', NULL, NULL, NULL, 'VWbj0lDE1G', NULL, NULL, 1, '2025-09-26 08:19:41', '2025-09-26 08:19:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `placa` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1,
  `tipo_id` bigint(20) UNSIGNED NOT NULL,
  `profesor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `placa`, `modelo`, `disponible`, `tipo_id`, `profesor_id`, `created_at`, `updated_at`) VALUES
(1, 'NBO-325', 'quo', 1, 4, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(2, 'CYR-102', 'et', 1, 3, 4, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(3, 'MWG-746', 'quia', 0, 4, 2, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(4, 'WDA-297', 'aut', 1, 2, 2, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(5, 'ESV-982', 'minus', 0, 1, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(6, 'MGN-533', 'eligendi', 0, 4, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(7, 'YRY-956', 'architecto', 1, 4, 2, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(8, 'PBX-102', 'est', 1, 4, 1, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(9, 'XZX-787', 'et', 0, 2, 2, '2025-09-26 08:19:40', '2025-09-26 08:19:40'),
(10, 'RQH-298', 'ea', 1, 3, 4, '2025-09-26 08:19:40', '2025-09-26 08:19:40');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agendas_cliente_id_foreign` (`cliente_id`),
  ADD KEY `agendas_profesor_id_foreign` (`profesor_id`),
  ADD KEY `agendas_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistencias_cliente_id_foreign` (`cliente_id`),
  ADD KEY `asistencias_agenda_id_foreign` (`agenda_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_cc_unique` (`cc`),
  ADD KEY `clientes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `cliente_curso`
--
ALTER TABLE `cliente_curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_curso_cliente_id_foreign` (`cliente_id`),
  ADD KEY `cliente_curso_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `historial_cursos`
--
ALTER TABLE `historial_cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historial_cursos_cliente_id_foreign` (`cliente_id`),
  ADD KEY `historial_cursos_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_profesor_id_foreign` (`profesor_id`);

--
-- Indices de la tabla `horario_profesor_curso`
--
ALTER TABLE `horario_profesor_curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horario_profesor_curso_horario_id_foreign` (`horario_id`),
  ADD KEY `horario_profesor_curso_curso_id_foreign` (`curso_id`),
  ADD KEY `horario_profesor_curso_profesor_id_foreign` (`profesor_id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `picoyplaca`
--
ALTER TABLE `picoyplaca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indices de la tabla `profesors`
--
ALTER TABLE `profesors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesors_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `secretarias_cc_unique` (`cc`),
  ADD KEY `secretarias_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_vehiculos`
--
ALTER TABLE `tipos_vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipos_vehiculos_tipo_unique` (`tipo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehiculos_placa_unique` (`placa`),
  ADD KEY `vehiculos_tipo_id_foreign` (`tipo_id`),
  ADD KEY `vehiculos_profesor_id_foreign` (`profesor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente_curso`
--
ALTER TABLE `cliente_curso`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_cursos`
--
ALTER TABLE `historial_cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `horario_profesor_curso`
--
ALTER TABLE `horario_profesor_curso`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `picoyplaca`
--
ALTER TABLE `picoyplaca`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesors`
--
ALTER TABLE `profesors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipos_vehiculos`
--
ALTER TABLE `tipos_vehiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agendas`
--
ALTER TABLE `agendas`
  ADD CONSTRAINT `agendas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agendas_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agendas_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `profesors` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistencias_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cliente_curso`
--
ALTER TABLE `cliente_curso`
  ADD CONSTRAINT `cliente_curso_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cliente_curso_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historial_cursos`
--
ALTER TABLE `historial_cursos`
  ADD CONSTRAINT `historial_cursos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historial_cursos_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `profesors` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `horario_profesor_curso`
--
ALTER TABLE `horario_profesor_curso`
  ADD CONSTRAINT `horario_profesor_curso_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `horario_profesor_curso_horario_id_foreign` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `horario_profesor_curso_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `profesors` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `profesors`
--
ALTER TABLE `profesors`
  ADD CONSTRAINT `profesors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD CONSTRAINT `secretarias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehiculos_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipos_vehiculos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
