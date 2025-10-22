-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2025 a las 21:27:44
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
(1, 'accion', 'accion', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(2, 'crimen', 'crimen', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(3, 'asaltos', 'asaltos', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(4, 'infidelidades', 'infidelidades', '2025-10-21 19:15:48', '2025-10-21 19:15:48');

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
(1, 'Cliente', 'alracona', 12312753, 'M', 12395113, 'Cll 9 oeste', 65495113, 'le irrita estar cerca del povo', 8, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(2, 'Fancisco Antonio', 'Grijalba', 23548965, 'M', 987654321, 'Cll 7 oeste', 65495113, 'migrana', 9, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(3, 'ARGEMIRO', 'ESCOBAR', 2354765, 'M', 987654321, 'Cll 7 oeste', 65495113, 'migrana', 10, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(4, 'Gaspar', 'Ijaji', 23547657, 'M', 987654321, 'Cll 7 oeste', 65495113, 'migrana', 11, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(5, 'Juan David', 'Grijalba Osorio', 357986644, 'M', 314756832, 'Cll 7 oeste', 65495113, 'migrana', 12, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(6, 'S sin', 'Nulla est ullam do d', 62, 'M', 51, 'Optio aliquid dolor', 3, 'Et tempora enim volu', 24, '2025-10-21 19:21:50', '2025-10-21 19:22:06');

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
(1, 1, 1, 15, '2025-10-21 19:15:46', '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(2, 1, 2, 20, '2025-10-21 19:15:47', '2025-10-21 19:15:47', '2025-10-21 19:15:47'),
(3, 2, 1, 0, NULL, NULL, NULL),
(4, 2, 3, 0, NULL, NULL, NULL),
(5, 3, 3, 0, NULL, NULL, NULL),
(6, 4, 2, 0, NULL, NULL, NULL),
(7, 5, 1, 0, NULL, NULL, NULL),
(8, 5, 2, 0, NULL, NULL, NULL),
(9, 5, 3, 0, NULL, NULL, NULL),
(10, 1, 3, 10, NULL, '2025-10-21 19:15:47', '2025-10-21 19:15:47'),
(11, 6, 2, 0, NULL, NULL, NULL),
(12, 6, 3, 0, NULL, NULL, NULL);

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
(1, 'A1', 'Curso de conducción para obtener licencia tipo A1.', 15, 1, '2025-10-21 19:15:46', '2025-10-21 19:20:36'),
(2, 'B2', 'Curso de conducción para obtener licencia tipo B2.', 20, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(3, 'C1', 'Licencia tipo B1. PARA CARRO PUBLICO', 30, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46');

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
(1, 'LUNES', '06:00:00', '19:00:00', 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(2, 'MARTES', '06:00:00', '18:00:00', 2, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(3, 'MIERCOLES', '06:00:00', '20:00:00', 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(4, 'JUEVES', '06:00:00', '14:00:00', 3, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(5, 'JUEVES', '06:00:00', '14:00:00', 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(6, 'VIERNES', '06:00:00', '20:00:00', 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(8, 'MARTES', '06:00:00', '12:00:00', 1, '2025-10-21 19:17:58', '2025-10-21 19:17:58');

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
(1, 1, 1, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(2, 2, 1, 2, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(3, 3, 2, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(4, 4, 3, 3, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(5, 5, 1, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(6, 6, 2, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(8, 8, 2, 1, NULL, NULL);

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
(1, '/images/uploads/1757514049_team-0.jpg', 1, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(2, '/images/uploads/1757597419_Austin.jpg', 2, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(3, '/images/uploads/1757598403_boom.jpg', 3, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(4, '/images/uploads/1757598817_scenes.png', 4, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(5, '/images/uploads/1757599019_op.jpg', 5, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(6, '/images/uploads/1757600444_op (1).png', 6, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(7, '/images/uploads/1757600616_BOOM.png', 7, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(8, '/images/uploads/1757600672_2background-new.png', 8, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(9, '/images/uploads/1757600745_new-1.jpg', 9, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(10, '/images/uploads/1757600815_team.png', 10, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(11, '/images/uploads/1757600891_40.JUAN.jpg', 11, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(12, '/images/uploads/1757600973_bomm.png', 12, 'App\\Models\\Post', '2025-10-21 19:15:48', '2025-10-21 19:15:48');

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
(3, 'App\\Models\\User', 25),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 23),
(5, 'App\\Models\\Cliente', 5),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 24),
(6, 'App\\Models\\User', 13);

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
(1, 'admin.home', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(2, 'admin.index', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(3, 'admin.config.index', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(4, 'admin.config.create', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(5, 'admin.config.store', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(6, 'admin.config.show', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(7, 'admin.config.edit', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(8, 'admin.config.destroy', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(9, 'admin.secretarias.index', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(10, 'admin.secretarias.create', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(11, 'admin.secretarias.store', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(12, 'admin.secretarias.show', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(13, 'admin.secretarias.edit', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(14, 'admin.secretarias.destroy', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(15, 'admin.clientes.index', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(16, 'admin.clientes.create', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(17, 'admin.clientes.store', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(18, 'admin.clientes.show', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(19, 'admin.clientes.edit', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(20, 'admin.clientes.destroy', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(21, 'admin.cursos.index', 'web', '2025-10-21 19:15:40', '2025-10-21 19:15:40'),
(22, 'admin.cursos.create', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(23, 'admin.cursos.store', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(24, 'admin.cursos.show', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(25, 'admin.cursos.edit', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(26, 'admin.cursos.destroy', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(27, 'admin.profesores.index', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(28, 'admin.profesores.create', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(29, 'admin.profesores.store', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(30, 'admin.profesores.show', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(31, 'admin.profesores.edit', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(32, 'admin.profesores.destroy', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(33, 'admin.profesores.pdf', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(34, 'admin.profesores.reportes', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(35, 'admin.horarios.index', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(36, 'admin.horarios.create', 'web', '2025-10-21 19:15:41', '2025-10-21 19:15:41'),
(37, 'admin.horarios.store', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(38, 'admin.horarios.show', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(39, 'admin.horarios.edit', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(40, 'admin.horarios.update', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(41, 'admin.horarios.destroy', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(42, 'admin.agendas.index', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(43, 'admin.agendas.create', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(44, 'admin.agendas.store', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(45, 'admin.agendas.show', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(46, 'admin.agendas.edit', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(47, 'admin.agendas.update', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(48, 'admin.agendas.destroy', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(49, 'admin.vehiculos.index', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(50, 'admin.vehiculos.create', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(51, 'admin.vehiculos.update', 'web', '2025-10-21 19:15:42', '2025-10-21 19:15:42'),
(52, 'admin.vehiculos.pico_y_placa.index', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(53, 'admin.vehiculos.pico_y_placa.create', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(54, 'admin.vehiculos.pico_y_placa.update', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(55, 'show_datos_cursos', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(56, 'admin.horarios.show_reserva_profesores', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(57, 'admin.show_reservas', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(58, 'admin.listUsers', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(59, 'admin.reservas.edit', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(60, 'admin.asistencias.index', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(61, 'admin.asistencias.inasistencias', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(62, 'admin.horarios', 'web', '2025-10-21 19:15:43', '2025-10-21 19:15:43'),
(63, 'permissions.index', 'web', '2025-10-21 19:15:44', '2025-10-21 19:15:44'),
(64, 'permissions.create', 'web', '2025-10-21 19:15:44', '2025-10-21 19:15:44'),
(65, 'permissions.edit', 'web', '2025-10-21 19:15:44', '2025-10-21 19:15:44'),
(66, 'permissions.delete', 'web', '2025-10-21 19:15:44', '2025-10-21 19:15:44'),
(67, 'roles.index', 'web', '2025-10-21 19:15:44', '2025-10-21 19:15:44'),
(68, 'roles.create', 'web', '2025-10-21 19:15:44', '2025-10-21 19:15:44'),
(69, 'roles.edit', 'web', '2025-10-21 19:15:44', '2025-10-21 19:15:44'),
(70, 'roles.destroy', 'web', '2025-10-21 19:15:44', '2025-10-21 19:15:44');

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
(1, 'Lunes', '07:00:00', '20:00:00', '7 y 8', '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(2, 'Martes', '07:00:00', '20:00:00', '9 y 0', '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(3, 'Miércoles', '07:00:00', '20:00:00', '1 y 2', '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(4, 'Jueves', '07:00:00', '20:00:00', '3 y 4', '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(5, 'Viernes', '07:00:00', '20:00:00', '5 y 6', '2025-10-21 19:15:46', '2025-10-21 19:15:46');

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
(12, 'youtube channel', 'youtube-channel', '', 'https://www.youtube.com/@josedanielgrijalbaosorio7431', '1', 1, 1, '2025-09-11 19:29:33', '2025-09-11 19:29:33');

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
(1, 'Profesor', 'Lewis', '4564564565', 4, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(2, 'TEACHER', 'Gallardo', '432324324', 5, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(3, 'Julio Profe', 'Valdes', '123123213', 6, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(4, 'Martin Profe', 'Valdes', '123123213', 7, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(5, 'Quasi', 'odi', '38', 23, '2025-10-21 19:19:33', '2025-10-21 19:20:18');

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
(1, 'superAdmin', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(2, 'admin', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(3, 'secretaria', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(4, 'profesor', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(5, 'cliente', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39'),
(6, 'espectador', 'web', '2025-10-21 19:15:39', '2025-10-21 19:15:39');

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
(41, 1),
(41, 2),
(41, 3),
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
(44, 5),
(45, 1),
(45, 2),
(45, 3),
(45, 5),
(46, 1),
(46, 2),
(46, 3),
(47, 1),
(47, 2),
(47, 3),
(48, 1),
(48, 2),
(48, 3),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
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
(57, 5),
(58, 1),
(58, 2),
(58, 3),
(59, 1),
(59, 2),
(59, 3),
(60, 1),
(60, 2),
(60, 3),
(60, 4),
(61, 1),
(61, 2),
(61, 3),
(62, 1),
(62, 2),
(62, 3),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1);

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
(1, 'Secretaria', 'Catrana', 1112036545, '3147078256', '22/10/2010', 'calle 5 o este', 3, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(2, 'Excepturi', 'Vel', 67, 'Eos eaque et perfere', '22/05/1983', 'Sint aliquip invent', 25, '2025-10-21 19:22:27', '2025-10-21 19:22:58');

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
('yhtNvz2df1C8fKzTcmbmMzuojzVY1F6Tl5GUHZ7e', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQzg5TWc5aUw1TE1ubzB1QUVXUEdLaWFmck1IQ2VOdW1nclZSa0VoUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zZWNyZXRhcmlhcyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkMkNnMW42RGhlV3Q3OTJyWmRQemg4ZW1GczZVbFltL1h3WlNqZXQ2Zk1OdnJaLnpZeFA1enkiO30=', 1761074607);

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
(1, 'est', 'est', 'yellow', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(2, 'quis', 'quis', 'pink', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(3, 'cum', 'cum', 'purple', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(4, 'ad', 'ad', 'pink', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(5, 'rerum', 'rerum', 'red', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(6, 'qui', 'qui', 'yellow', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(7, 'quo', 'quo', 'yellow', '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(8, 'mollitia', 'mollitia', 'yellow', '2025-10-21 19:15:48', '2025-10-21 19:15:48');

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
(1, 'Administrador', 'admin@email.com', '2025-10-21 19:15:45', '$2y$10$2Cg1n6DheWt792rZdPzh8emFs6UlYm/XwZSjet6fMNvrZ.zYxP5zy', NULL, NULL, NULL, 'nu9BYYZi9i', NULL, NULL, 1, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(2, 'Jose Daniel Grijalba Osorio', 'jose.jdgo97@gmail.com', '2025-10-21 19:15:45', '$2y$10$uzcODfpvBpE/nIbf8vveYeFUE9IBZ4MhEBQVescLcxzwKXD2l7MmO', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(3, 'Secretaria', 'secretaria@email.com', '2025-10-21 19:15:45', '$2y$10$E.wXqfkgIDE32lMOxfSZ9e24Z71N5XB/GCTUA8VgQdrnH4sKVi8LC', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:45', '2025-10-21 19:23:26'),
(4, 'Profesor', 'profesor@email.com', '2025-10-21 19:15:45', '$2y$10$60.o/6Qh6KhpavcTB/8HiuMdIKwifZOvZCZo7g8Fl8dptphiIj/ZO', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:45', '2025-10-21 19:19:23'),
(5, 'TEACHER', 'profesor1@email.com', '2025-10-21 19:15:45', '$2y$10$wYfdbRUs3xC6yGnIO/i.Q.y0IPM8UB43Fr8.BWaGIulqOE3tdkUN6', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(6, 'Julio Profe', 'profesor2@email.com', '2025-10-21 19:15:45', '$2y$10$wO2ITNUNIlpvrF50VPcqROqODpOXBGsnZN6hArlGcYC3L2pHChgNy', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(7, 'Martin Profe', 'profesor3@email.com', '2025-10-21 19:15:45', '$2y$10$33LB9Aakf7AASp.FTjPCH.99JOgpNRgnIN5nSAAq0jqDB84Yr4v.C', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:45', '2025-10-21 19:15:45'),
(8, 'Cliente', 'cliente@email.com', '2025-10-21 19:15:46', '$2y$10$ih2IOOd8AWE4B3O4cZ7puecb8JmCoCpWnjirEajscgvGvLqgR9MUi', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:46', '2025-10-21 19:21:39'),
(9, 'Fancisco Antonio Grijalba', 'francisco.grijalba@email.com', '2025-10-21 19:15:46', '$2y$10$BlKNXQlxCqpUHCFauxh06um5fcq8Uk9UefjsaoaPHSr6GJ0dLpeMC', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(10, 'ARGEMIRO ESCOBAR GUTIERRES', 'argemiro.escobar@email.com', '2025-10-21 19:15:46', '$2y$10$6GmZpEBXuvI6Yt3pJVwQku7JzyUt7B8IvGCojrqfq1Ielnkl29n0.', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(11, 'Gaspar', 'gaspar@email.com', '2025-10-21 19:15:46', '$2y$10$E6bC7Y74gan8zkL7H4NlL.Sl3CslETPM2PHpRBsrEhPqx7dwGW91.', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(12, 'Juan David Grijalba Osorio', 'juandavidgo1997@email.com', '2025-10-21 19:15:46', '$2y$10$lrmvMa8hCOfNwOAmK6WJteTXF0tPbDa/oChGSZox0dmpuhTdZA0zO', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(13, 'Espectador', 'espectador@email.com', '2025-10-21 19:15:46', '$2y$10$O2PqSRIN6S4N/hr8p6hq1ek63KtTR3IGcY2pNXzAggeM8pV0vWLsu', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(14, 'Itzel D\'Amore', 'glenda33@example.net', '2025-10-21 19:15:47', '$2y$10$wvPRCjZIzPLlIsHuM.rtE.T7xzloLsCHuHvf7aqCAAa3rZsyDx322', NULL, NULL, NULL, 'GQXNcSHVw5', NULL, NULL, 1, '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(15, 'Berniece West', 'collier.leda@example.net', '2025-10-21 19:15:47', '$2y$10$9pufYiXseqeJ1sbXOAAzR.KPC0EJ/MRbMSepLuxnlL2oJprgEIgTG', NULL, NULL, NULL, 'a1fgXCYSyM', NULL, NULL, 1, '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(16, 'Foster Kessler', 'voberbrunner@example.org', '2025-10-21 19:15:47', '$2y$10$GCQirnXG07fO4Jmd4nH03usMUiLfv2k98IdlTtkaGnNGITDFeK7Gm', NULL, NULL, NULL, 'dLiRxrROa2', NULL, NULL, 1, '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(17, 'Linwood Senger', 'strosin.brook@example.net', '2025-10-21 19:15:47', '$2y$10$XXLZtgt8NQxrXFZWyWlj5eEySZb1OMUcexDCljaQvXVcSpeYpwYEW', NULL, NULL, NULL, '7RNlrjAcNl', NULL, NULL, 1, '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(18, 'Davin Hauck', 'greenfelder.bernhard@example.org', '2025-10-21 19:15:47', '$2y$10$Y/pTE1NT9enS7NSn6Qzl.OtEffdI/N/N19h3HkNgOyx7twzS2jqES', NULL, NULL, NULL, 'CvoxYiqur7', NULL, NULL, 1, '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(19, 'Bridgette Kuvalis V', 'larissa.boehm@example.net', '2025-10-21 19:15:47', '$2y$10$p8uA24rwQ1Qi4mBdp0A/CeTL2dYM9YqyrypjvtB/oJ8597GPG8YIO', NULL, NULL, NULL, 'zt62T0VPhT', NULL, NULL, 1, '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(20, 'Mr. Devan Marks', 'egreenfelder@example.com', '2025-10-21 19:15:47', '$2y$10$lB86WjNmLoQ2ngKX/wpzfeMJnepAyjf2MAB7T6p6f7TaO1C6juafu', NULL, NULL, NULL, 'Tf3dIVS8vU', NULL, NULL, 1, '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(21, 'Prof. Kolby Kilback', 'shaylee18@example.com', '2025-10-21 19:15:47', '$2y$10$nD36AD8SpDr6RthYyFvfe.i.4I3e7wKF3E47v/YKRRWpfnG1csgvC', NULL, NULL, NULL, 'iAKwaORFyA', NULL, NULL, 1, '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(22, 'Prof. Deonte Mann Sr.', 'wilfrid.effertz@example.net', '2025-10-21 19:15:47', '$2y$10$TtUHKvfACGLox91TUBfNau3j78GNikoWrBFoAUrajhWrhZO3Qoo1u', NULL, NULL, NULL, '71t8eMVxqF', NULL, NULL, 1, '2025-10-21 19:15:48', '2025-10-21 19:15:48'),
(23, 'Quasi esse perferend', 'liso@mailinator.com', NULL, '$2y$10$v39PAU6ZI3N6G1JfyGAB8uqu4WQpSj9kUQsledAOB.feyfs/QvFNO', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:19:33', '2025-10-21 19:19:33'),
(24, 'Sunt praesentium sin', 'sinypy@mailinator.com', NULL, '$2y$10$7uP/QSigAeuIw9V4ACRwXu6KTifak2u4WUjjqIMgojC538fn7OhWC', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:21:50', '2025-10-21 19:21:50'),
(25, 'Excepturi', 'mepy@mailinator.com', NULL, '$2y$10$reG.qPmAPCuSIq9ePUSGE.6TApvOXiaMy4Fd27YnaVEO5u9duDBr.', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-10-21 19:22:27', '2025-10-21 19:23:04');

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
(1, 'ZOR-595', 'voluptas', 0, 2, 2, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(2, 'SEX-521', 'officia', 1, 3, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(3, 'QLO-966', 'fuga', 1, 3, 3, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(4, 'YLQ-816', 'commodi', 1, 1, 3, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(5, 'FOV-333', 'eveniet', 1, 2, 4, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(6, 'QUN-360', 'perspiciatis', 1, 4, 4, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(7, 'AZP-657', 'labore', 0, 1, 4, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(8, 'IJX-943', 'et', 1, 3, 3, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(9, 'NRH-019', 'ab', 0, 4, 2, '2025-10-21 19:15:46', '2025-10-21 19:15:46'),
(10, 'NSK-941', 'dolorem', 0, 3, 1, '2025-10-21 19:15:46', '2025-10-21 19:15:46');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cliente_curso`
--
ALTER TABLE `cliente_curso`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `horario_profesor_curso`
--
ALTER TABLE `horario_profesor_curso`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipos_vehiculos`
--
ALTER TABLE `tipos_vehiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
