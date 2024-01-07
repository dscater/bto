-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-01-2024 a las 21:41:49
-- Versión del servidor: 8.0.30
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bto_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividads`
--

CREATE TABLE `actividads` (
  `id` bigint UNSIGNED NOT NULL,
  `proyecto_id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa_adjudicado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto` decimal(24,2) DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actividads`
--

INSERT INTO `actividads` (`id`, `proyecto_id`, `nombre`, `archivo`, `empresa_adjudicado`, `monto`, `estado`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(3, 1, 'TAREA 1', '31677528038.pdf', 'EMPRESA MODIFICADOS', 250.00, 'COMPLETO', '2021-03-23', '2021-03-23 21:26:16', '2023-02-27 20:00:38'),
(5, 1, 'TAREA 2', '51677528033.pdf', 'SS', NULL, 'COMPLETO', '2021-03-23', '2021-03-23 22:30:37', '2023-02-27 20:00:33'),
(6, 1, 'TAREA 3', NULL, 'PRUEBA EMPRESA', NULL, 'COMPLETO', '2021-03-23', '2021-03-23 22:31:15', '2023-02-27 20:02:45'),
(11, 3, 'TAREA 1', NULL, NULL, NULL, 'COMPLETO', '2021-03-26', '2021-03-26 21:26:37', '2021-03-26 21:26:47'),
(12, 4, 'REUNIÓN', '121677528195.pdf', 'PRUEBA FORM CON ARCHIVO  Y MONTO', 300.00, 'COMPLETO', '2021-04-01', '2021-04-01 21:13:37', '2023-02-27 20:03:15'),
(13, 4, 'ELABORACIÓN', NULL, NULL, NULL, 'PENDIENTE', '2021-04-01', '2021-04-01 21:13:50', '2021-04-01 21:13:50'),
(14, 2, 'TAREA 5', NULL, NULL, NULL, 'PENDIENTE', '2023-02-27', '2023-02-27 17:11:20', '2023-02-27 17:27:37'),
(15, 2, 'TAREA 4', NULL, NULL, NULL, 'PENDIENTE', '2023-02-27', '2023-02-27 17:11:26', '2023-02-27 17:27:34'),
(16, 2, 'TAREA 3', NULL, NULL, NULL, 'PENDIENTE', '2023-02-27', '2023-02-27 17:27:28', '2023-02-27 17:27:28'),
(20, 2, 'DFSDFASD', NULL, NULL, NULL, 'PENDIENTE', '2023-02-27', '2023-02-27 17:31:51', '2023-02-27 17:32:03'),
(22, 1, 'ASDASDAS', '221677528017.pdf', 'KA', 34.00, 'PENDIENTE', '2023-02-27', '2023-02-27 18:34:16', '2023-02-27 20:02:36'),
(25, 5, 'TAREA 1', NULL, NULL, NULL, 'PENDIENTE', '2024-01-07', '2024-01-07 20:59:27', '2024-01-07 20:59:27'),
(27, 5, 'TAREA 2', '271704661222.pdf', '', NULL, 'COMPLETO', '2024-01-07', '2024-01-07 20:59:35', '2024-01-07 21:00:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` bigint UNSIGNED NOT NULL,
  `empleado_id` bigint UNSIGNED NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `fecha` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `empleado_id`, `hora_inicio`, `hora_fin`, `fecha`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, '10:58:55', '18:55:53', '2023-03-25', '2023-03-25', '2021-03-25 14:59:39', '2021-03-25 22:55:55'),
(2, 4, '10:46:48', '17:23:53', '2023-03-26', '2023-03-26', '2021-03-26 14:46:52', '2021-03-26 21:23:56'),
(3, 1, '10:47:01', '17:23:35', '2023-03-26', '2023-03-26', '2021-03-26 14:47:05', '2021-03-26 21:23:44'),
(4, 5, '17:23:24', '22:23:24', '2023-03-26', '2023-03-26', '2021-03-26 21:23:26', '2021-03-26 21:23:26'),
(5, 6, '20:28:01', '22:23:24', '2023-03-29', '2023-03-29', '2021-03-30 00:28:13', '2021-03-30 00:28:13'),
(6, 7, '13:34:43', '16:38:33', '2024-01-07', '2024-01-07', '2024-01-07 20:34:48', '2024-01-07 20:38:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` int NOT NULL,
  `ci_exp` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `ci`, `ci_exp`, `email`, `fono`, `cel`, `dir`, `foto`, `empresa`, `fecha_registro`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'EDUARDO', 'PEREZ MARTINEZ', 12345678, 'LP', 'eduardo@gmail.com', '2314568', '78945612', 'ZONA LOS OLIVOS CALLE 3 #342', 'EDUARDO1616427540.jpg', 'EMPRESA AC', '2021-03-22', 1, '2021-03-22 15:32:37', '2021-03-22 15:39:00'),
(2, 'JUAN', 'BAUTISTA', 4561235, 'LP', 'juan@gmail.com', '2314568', '68423156', 'ZONA LOS OLIVOS CALLE 3 #342', 'user_default.png', 'SYNCTS', '2021-03-23', 1, '2021-03-23 14:18:45', '2021-03-23 14:18:45'),
(3, 'LUIS', 'MARCA', 4561356, 'LP', 'luis@gmail.com', '2314568', '78945612', 'ZONA LOS OLIVOS CALLE 3 #342', 'user_default.png', 'ACT S.A.', '2021-03-25', 1, '2021-03-25 20:53:48', '2021-03-25 20:53:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`id`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `dir`, `email`, `fono`, `cel`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'JUAN', 'PEREZ', '', '12345678', 'LP', 'ZONA LOS OLIVOS CALLE 3 #342', 'juan@gmail.com', '78945612', '78945612', 2, '2021-03-18 19:49:49', '2021-03-18 19:49:49'),
(2, 'ELVIS', 'MACHACHA', 'CONDORI', '123456', 'CB', 'ZONA LOS OLIVOS CALLE 3 #342', 'elvis@gmail.com', '2314568', '78945612', 7, '2021-03-25 20:45:26', '2021-03-25 20:45:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'DEPARTAMENTO 1', '', '2021-03-19 13:39:54', '2021-03-19 13:39:54'),
(2, 'DEPARTAMENTO 2', 'DESC', '2021-03-19 13:39:59', '2021-03-19 13:40:09'),
(3, 'DEPARTAMENTO 4', 'DESCRIPCION', '2021-03-25 20:52:22', '2021-03-25 20:52:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `designacions`
--

CREATE TABLE `designacions` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `designacions`
--

INSERT INTO `designacions` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'DESIGNACION 1', '', '2021-03-19 13:42:20', '2021-03-19 13:42:20'),
(2, 'DESIGNACION 2', 'DESC', '2021-03-19 13:42:26', '2021-03-19 13:42:36'),
(3, 'DESIGNACION 4', '', '2021-03-25 20:52:29', '2021-03-25 20:52:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_empleado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa_id` bigint UNSIGNED NOT NULL,
  `departamento_id` bigint UNSIGNED NOT NULL,
  `designacion_id` bigint UNSIGNED NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `codigo_empleado`, `fecha_ingreso`, `fono`, `cel`, `dir`, `email`, `empresa_id`, `departamento_id`, `designacion_id`, `estado`, `fecha_registro`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'JORGE', 'MARTINEZ', 'PACHECHO', '12345678', 'LP', 'E001', '2020-02-19', '78945612', '78945612', 'ZONA LOS OLIVOS CALLE 3 #342', 'jorge@gmail.com', 1, 1, 1, 'ACTIVO', '2021-03-19', 3, '2021-03-19 14:22:54', '2021-03-19 14:27:14'),
(2, 'FELIX', 'MAMANI', 'CHOQUE', '4165789', 'LP', 'E002', '2021-01-02', '2314568', '68423156', 'ZONA LOS OLIVOS CALLE 3 #342', 'felix@gmail.com', 2, 2, 2, 'ACTIVO', '2021-03-23', 4, '2021-03-23 14:12:23', '2021-03-23 14:17:51'),
(3, 'MARIO', 'CACERES', 'MARTINEZ', '4561236', 'LP', 'E003', '2021-02-03', '2314568', '78945612', 'ZONA LOS OLIVOS CALLE 3 #342', 'mario@gmail.com', 1, 1, 1, 'ACTIVO', '2021-03-23', 5, '2021-03-23 14:13:01', '2021-03-23 14:14:19'),
(4, 'MARIA', 'MAMANI', '', '456789', 'LP', 'E004', '2021-01-02', '2314568', '78945612', 'ZONA LOS OLIVOS CALLE 3 #342', 'maria@gmail.com', 2, 1, 2, 'ACTIVO', '2021-03-23', 6, '2021-03-23 14:16:31', '2021-03-23 14:16:31'),
(5, 'ANDRES', 'MARQUEZ', '', '456123', 'LP', 'E005', '2021-03-02', '2314568', '78945612', 'ZONA LOS OLIVOS CALLE 3 #342', 'andres@gmail.com', 3, 3, 3, 'ACTIVO', '2021-03-25', 8, '2021-03-25 22:46:00', '2021-03-25 22:46:00'),
(6, 'BRAYAN', 'PACO', 'PERAL', '1020309', 'LP', '20008', '2021-03-01', '2885245', '79855414', 'ZONA CENTRAL', 'brayan@gmail.com', 1, 1, 1, 'ACTIVO', '2021-03-29', 9, '2021-03-29 23:53:44', '2021-03-29 23:53:44'),
(7, 'JAVIER', 'MARTINEZ', 'MARTINEZ', '6666', 'LP', 'E008', '2024-01-07', '222222', '777777', 'LOS OLIVOS', 'javier@gmail.com', 1, 1, 1, 'ACTIVO', '2024-01-07', 10, '2024-01-07 18:19:51', '2024-01-07 18:19:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'EMPRESA 1', '', '2021-03-19 13:35:25', '2021-03-19 13:35:25'),
(2, 'EMPRESA 2', 'DESC', '2021-03-19 13:36:49', '2021-03-19 13:37:04'),
(3, 'EMPRESA 3', '', '2021-03-25 20:52:11', '2021-03-25 20:52:11'),
(4, 'EMPRESA 4', 'EMPRESA 4', '2021-03-29 23:55:44', '2021-03-29 23:55:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examens`
--

CREATE TABLE `examens` (
  `id` bigint UNSIGNED NOT NULL,
  `empresa_id` bigint UNSIGNED NOT NULL,
  `departamento_id` bigint UNSIGNED NOT NULL,
  `designacion_id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examens`
--

INSERT INTO `examens` (`id`, `empresa_id`, `departamento_id`, `designacion_id`, `nombre`, `fecha_registro`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'EXAMEN 1', '2021-03-24', 1, '2021-03-24 19:27:11', '2021-03-24 19:29:23'),
(2, 2, 2, 2, 'EXAMEN 2', '2021-03-25', 1, '2021-03-25 20:50:49', '2021-03-25 20:50:49'),
(3, 1, 1, 1, 'EXAMEN 3', '2021-03-26', 1, '2021-03-26 19:56:12', '2021-03-26 19:56:12'),
(4, 3, 3, 3, 'EXAMEN 4', '2021-03-26', 1, '2021-03-26 21:25:23', '2021-03-26 21:25:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_empleados`
--

CREATE TABLE `examen_empleados` (
  `id` bigint UNSIGNED NOT NULL,
  `examen_id` bigint UNSIGNED NOT NULL,
  `empleado_id` bigint UNSIGNED NOT NULL,
  `resultado` double(8,2) NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examen_empleados`
--

INSERT INTO `examen_empleados` (`id`, `examen_id`, `empleado_id`, `resultado`, `fecha`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 25.00, '2021-03-26', '2021-03-26 20:31:48', '2021-03-26 20:31:48'),
(2, 2, 4, 0.00, '2021-03-26', '2021-03-26 20:32:36', '2021-03-26 20:32:36'),
(3, 4, 5, 100.00, '2021-03-26', '2021-03-26 21:28:50', '2021-03-26 21:28:50'),
(4, 3, 1, 0.00, '2021-04-01', '2021-04-01 21:22:04', '2021-04-01 21:22:04'),
(5, 1, 7, 5.00, '2024-01-07', '2024-01-07 21:13:51', '2024-01-07 21:13:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` bigint UNSIGNED NOT NULL,
  `empleado_id` bigint UNSIGNED NOT NULL,
  `hi_lu` time DEFAULT NULL,
  `hf_lu` time DEFAULT NULL,
  `hi_mar` time DEFAULT NULL,
  `hf_mar` time DEFAULT NULL,
  `hi_mier` time DEFAULT NULL,
  `hf_mier` time DEFAULT NULL,
  `hi_jue` time DEFAULT NULL,
  `hf_jue` time DEFAULT NULL,
  `hi_vier` time DEFAULT NULL,
  `hf_vier` time DEFAULT NULL,
  `hi_sa` time DEFAULT NULL,
  `hf_sa` time DEFAULT NULL,
  `hi_do` time DEFAULT NULL,
  `hf_do` time DEFAULT NULL,
  `horas_trabajo` int DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `empleado_id`, `hi_lu`, `hf_lu`, `hi_mar`, `hf_mar`, `hi_mier`, `hf_mier`, `hi_jue`, `hf_jue`, `hi_vier`, `hf_vier`, `hi_sa`, `hf_sa`, `hi_do`, `hf_do`, `horas_trabajo`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, '08:00:00', '18:00:00', NULL, NULL, NULL, NULL, '11:00:00', '16:30:00', '11:00:00', '16:30:00', NULL, NULL, NULL, NULL, 8, '2021-03-20', '2021-03-20 14:10:27', '2021-03-26 14:43:09'),
(2, 4, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '10:50:00', '17:00:00', NULL, NULL, NULL, NULL, 0, '2021-03-25', '2021-03-25 15:00:58', '2021-03-26 14:46:39'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-25', '2021-03-25 15:02:11', '2021-03-25 15:02:11'),
(5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-25', '2021-03-25 15:03:28', '2021-03-25 15:03:28'),
(6, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17:25:00', '22:30:00', NULL, NULL, NULL, NULL, 5, '2021-03-26', '2021-03-26 21:22:16', '2021-03-26 21:23:23'),
(7, 6, '08:00:00', '18:00:00', '08:00:00', '18:00:00', NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '18:00:00', NULL, NULL, NULL, NULL, 0, '2021-03-29', '2021-03-29 23:53:56', '2021-03-29 23:54:58'),
(8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14:00:00', '16:30:00', 8, '2024-01-07', '2024-01-07 20:29:25', '2024-01-07 20:42:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(35, '2014_10_12_000000_create_users_table', 1),
(36, '2021_03_18_111227_create_razon_socials_table', 1),
(37, '2021_03_18_111241_create_datos_usuarios_table', 1),
(38, '2021_03_18_111911_create_empresas_table', 1),
(39, '2021_03_18_111922_create_departamentos_table', 1),
(40, '2021_03_18_111932_create_designacions_table', 1),
(41, '2021_03_18_111933_create_empleados_table', 1),
(42, '2021_03_18_112413_create_horarios_table', 1),
(43, '2021_03_18_112536_create_sueldos_table', 1),
(44, '2021_03_18_112656_create_clientes_table', 1),
(45, '2021_03_18_112809_create_proyectos_table', 1),
(46, '2021_03_18_113027_create_proyecto_equipos_table', 1),
(47, '2021_03_18_113124_create_actividads_table', 1),
(48, '2021_03_18_113217_create_examens_table', 1),
(49, '2021_03_18_113449_create_preguntas_table', 1),
(50, '2021_03_18_113613_create_asistencias_table', 1),
(51, '2021_03_18_113725_create_vacacions_table', 1),
(52, '2021_03_26_153403_create_examen_empleados_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` bigint UNSIGNED NOT NULL,
  `examen_id` bigint UNSIGNED NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `a` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `c` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `d` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `respuesta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `examen_id`, `descripcion`, `a`, `b`, `c`, `d`, `respuesta`, `valor`, `created_at`, `updated_at`) VALUES
(3, 1, 'PREGUNTA 1', 'OPCION1CC', 'OPCION2', 'OPCION3', 'OPCION4', 'A', 5, '2021-03-24 20:48:36', '2021-03-24 20:56:35'),
(5, 1, 'PREGUNTA2', 'OPCION1', 'OPCION2', 'OPCION3', 'OPCION4', 'B', 20, '2021-03-24 20:49:05', '2021-03-24 20:49:05'),
(7, 2, 'PREGUNTA1', 'OPCION1', 'OPCION2', 'OPCION3', 'OPCION4', 'D', 30, '2021-03-25 20:50:49', '2021-03-25 20:50:49'),
(8, 3, 'PREGUNTA 1', 'OPCION 1', 'OPCION 2', 'OPCION 3', 'OPCION 4', 'A', 20, '2021-03-26 19:56:12', '2021-03-26 19:56:12'),
(9, 3, 'PREGUNTA 2', 'OPCION 1', 'OPCION 2', 'OPCION 3', 'OPCION 4', 'B', 20, '2021-03-26 19:56:12', '2021-03-26 19:56:12'),
(10, 3, 'PREGUNTA 3', 'OPCION 1', 'OPCION 2', 'OPCION 3', 'OPCION 4', 'C', 60, '2021-03-26 19:56:12', '2021-03-26 19:56:12'),
(11, 4, 'PREGUNTA 1', 'OPCION 1', 'OPCION 2', 'OPCION 3', 'OPCION 4', 'A', 50, '2021-03-26 21:25:23', '2021-03-26 21:25:23'),
(12, 4, 'PREGUNTA 2', 'OPCION 1', 'OPCION 2', 'OPCION 3', 'OPCION 4', 'D', 50, '2021-03-26 21:25:23', '2021-03-26 21:25:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_id` bigint UNSIGNED NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `tarifa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioridad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lider_proyecto` bigint UNSIGNED NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `cliente_id`, `fecha_ini`, `fecha_fin`, `tarifa`, `prioridad`, `lider_proyecto`, `descripcion`, `archivo`, `fecha_registro`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'PROYECTO 1', 2, '2021-03-24', '2021-04-05', '250', 'ALTO', 1, '<p>Descripcion del proyecto 1 modificado\r\nModificacion de la descripcion del proyecto 1</p>', 'PROYECTO 11616515750.pdf', '2021-03-23', 1, '2021-03-23 14:37:22', '2021-03-23 22:01:23'),
(2, 'PROYECTO 2', 1, '2021-03-25', '2021-03-31', '450', 'MEDIO', 2, '<p>descripcion del proyecto 2</p>', 'PROYECTO 21616689344.pdf', '2021-03-25', 1, '2021-03-25 16:22:24', '2021-03-25 16:22:24'),
(3, 'PROYECTO 3', 3, '2021-03-26', '2021-04-08', '10000', 'ALTO', 5, '<p>descripcion del proyecto 3</p>', 'PROYECTO 31616793982.pdf', '2021-03-26', 1, '2021-03-26 21:26:22', '2021-03-26 21:26:22'),
(4, 'PROYECTO 4', 3, '2021-04-01', '2021-04-30', '10000', 'MEDIO', 6, '<p>Proyecto nuevo</p>', 'PROYECTO 41617309943.pdf', '2021-04-01', 1, '2021-04-01 20:45:43', '2021-04-01 20:45:43'),
(5, 'PROYECTO #1 (2024)', 2, '2024-01-05', '2024-01-31', '2400', 'MEDIO', 2, '<p>Descripcion de nuevo proyecto</p>', 'PROYECTO #1 (2024)1704660964.pdf', '2024-01-07', 1, '2024-01-07 20:56:04', '2024-01-07 20:56:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_equipos`
--

CREATE TABLE `proyecto_equipos` (
  `id` bigint UNSIGNED NOT NULL,
  `proyecto_id` bigint UNSIGNED NOT NULL,
  `empleado_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proyecto_equipos`
--

INSERT INTO `proyecto_equipos` (`id`, `proyecto_id`, `empleado_id`, `created_at`, `updated_at`) VALUES
(2, 1, 3, '2021-03-23 14:37:22', '2021-03-23 14:37:22'),
(3, 1, 4, '2021-03-23 14:37:22', '2021-03-23 14:37:22'),
(4, 1, 2, '2021-03-23 16:06:41', '2021-03-23 16:06:41'),
(5, 2, 3, '2021-03-25 16:22:24', '2021-03-25 16:22:24'),
(6, 2, 4, '2021-03-25 16:22:25', '2021-03-25 16:22:25'),
(7, 2, 1, '2021-03-25 16:44:58', '2021-03-25 16:44:58'),
(8, 3, 4, '2021-03-26 21:26:22', '2021-03-26 21:26:22'),
(9, 3, 3, '2021-03-26 21:26:22', '2021-03-26 21:26:22'),
(10, 4, 2, '2021-04-01 20:45:43', '2021-04-01 20:45:43'),
(11, 4, 3, '2021-04-01 20:45:43', '2021-04-01 20:45:43'),
(12, 4, 5, '2021-04-01 20:45:43', '2021-04-01 20:45:43'),
(13, 5, 3, '2024-01-07 20:56:04', '2024-01-07 20:56:04'),
(14, 5, 5, '2024-01-07 20:56:04', '2024-01-07 20:56:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razon_socials`
--

CREATE TABLE `razon_socials` (
  `id` bigint UNSIGNED NOT NULL,
  `codigo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_aut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `casilla` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `actividad_economica` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `razon_socials`
--

INSERT INTO `razon_socials` (`id`, `codigo`, `nombre`, `alias`, `ciudad`, `dir`, `nro_aut`, `fono`, `cel`, `casilla`, `correo`, `logo`, `actividad_economica`, `created_at`, `updated_at`) VALUES
(1, 'E0001', 'BOLIVIAN TECHNOLOGY OUTSOURCING', 'BTO', 'LA PAZ', 'ZONA CENTRAL', '10000055566', '21134568', '78945612', '', '', 'logo.png', 'ACTIVIDAD ECONOMICA', '2021-03-18 15:42:26', '2021-03-18 15:42:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sueldos`
--

CREATE TABLE `sueldos` (
  `id` bigint UNSIGNED NOT NULL,
  `empleado_id` bigint UNSIGNED NOT NULL,
  `sueldo` decimal(24,2) NOT NULL,
  `moneda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_pago` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sueldos`
--

INSERT INTO `sueldos` (`id`, `empleado_id`, `sueldo`, `moneda`, `tipo_pago`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(2, 1, 1500.00, 'BOLIVIANOS', 'DÍA', '2021-03-22', '2021-03-22 14:38:55', '2021-03-22 14:38:55'),
(3, 2, 8000.00, 'BOLIVIANOS', 'DÍA', '2021-03-25', '2021-03-25 20:52:59', '2021-03-25 20:52:59'),
(4, 5, 1000.00, 'DÓLARES', 'DÍA', '2021-03-26', '2021-03-26 21:27:57', '2021-03-26 21:27:57'),
(5, 4, 1000.00, 'BOLIVIANOS', 'HORA', '2021-03-26', '2021-03-26 21:28:08', '2021-03-26 21:28:08'),
(6, 6, 50.00, 'BOLIVIANOS', 'HORA', '2021-03-29', '2021-03-29 23:57:22', '2021-03-29 23:57:22'),
(7, 3, 5000.00, 'BOLIVIANOS', 'HORA', '2024-01-07', '2024-01-07 21:31:40', '2024-01-07 21:31:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('ADMINISTRADOR','AUXILIAR','EMPLEADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `tipo`, `foto`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '$2y$10$pFRYaJ1BfoIttDlRd2k1.eJ3tHWsIqMB4XpMpA3hNouRT7EcMltvG', 'ADMINISTRADOR', 'user_default.png', 1, '2021-03-18 15:42:26', '2021-03-18 20:04:46'),
(2, 'juan@gmail.com', '$2y$10$OJ9esjiUJLbiY0sCrJWKTO76hHicBxKdHUWpynlBS4UkXueF3/Ula', 'ADMINISTRADOR', 'JUAN1616096989.jpg', 1, '2021-03-18 19:49:49', '2021-03-22 14:08:18'),
(3, 'jorge@gmail.com', '$2y$10$vpAloLfqYrJAuOAK9WRHD.3fEAjDnefFR.9gV5pUEv1b.DgxudSg.', 'EMPLEADO', 'JORGE1616163774.jpg', 1, '2021-03-19 14:22:54', '2021-03-19 14:27:28'),
(4, 'felix@gmail.com', '$2y$10$6qaWy.oFR8r41DxqKF7DoOAzpsQDKyudgFKTjrKE41vStNoaYYmpS', 'EMPLEADO', 'FELIX1616508743.jpg', 1, '2021-03-23 14:12:23', '2021-03-23 14:12:23'),
(5, 'mario@gmail.com', '$2y$10$Rxt/pyhh1eYFCdh37abES.QKUYwuS6MvhWFeZAVY1TGGky8X5DgC6', 'EMPLEADO', 'MARIO1616508781.jpg', 1, '2021-03-23 14:13:01', '2021-03-23 14:13:01'),
(6, 'maria@gmail.com', '$2y$10$o7QorBafs8oTPzSTFld3aOT/qMz7kWw.uZ9U6CoG0/wqSKAfH0ZGG', 'EMPLEADO', 'MARIA1616508991.jpg', 1, '2021-03-23 14:16:31', '2021-03-23 14:16:31'),
(7, 'elvis@gmail.com', '$2y$10$vT4tmF3jLyhc3O.w.h4j8OdKRqlkptvTwt3O6P86tvd/unF0zf2FO', 'AUXILIAR', 'ELVIS1616705126.png', 1, '2021-03-25 20:45:26', '2021-03-25 20:57:18'),
(8, 'andres@gmail.com', '$2y$10$gXAdURRL1IPT00BmSokIiuMH01mh4U8nLSeIadXGrVAUcp1yuzMqK', 'EMPLEADO', 'ANDRES1616712360.png', 1, '2021-03-25 22:46:00', '2021-03-25 22:46:00'),
(9, 'brayan@gmail.com', '$2y$10$ILO1DI1Fa20IJ526rTrdq.W6IKkqKRB3GM09iaD7h5NBR32dRGLT2', 'EMPLEADO', 'BRAYAN1617062024.jpg', 1, '2021-03-29 23:53:44', '2021-03-29 23:53:44'),
(10, 'javier@gmail.com', '$2y$10$PSfbhsIidUMzKDEUW2O7qeJGhHxc4pPqRq53k9R.oKqhdJXCbgQyy', 'EMPLEADO', 'JAVIER1704651591.png', 1, '2024-01-07 18:19:51', '2024-01-07 18:19:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacacions`
--

CREATE TABLE `vacacions` (
  `id` bigint UNSIGNED NOT NULL,
  `empleado_id` bigint UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vacacions`
--

INSERT INTO `vacacions` (`id`, `empleado_id`, `fecha`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(4, 1, '2021-03-25', '2021-03-24', '2021-03-24 22:40:15', '2021-03-24 22:40:15'),
(5, 5, '2021-04-02', '2021-03-26', '2021-03-26 21:25:36', '2021-03-26 21:25:36'),
(6, 5, '2021-04-03', '2021-03-26', '2021-03-26 21:25:38', '2021-03-26 21:25:38'),
(7, 6, '2021-04-12', '2021-03-29', '2021-03-30 00:33:13', '2021-03-30 00:33:13'),
(8, 1, '2021-05-28', '2021-04-01', '2021-04-01 21:20:48', '2021-04-01 21:20:48'),
(9, 1, '2021-05-29', '2021-04-01', '2021-04-01 21:20:56', '2021-04-01 21:20:56');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividads`
--
ALTER TABLE `actividads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actividads_proyecto_id_foreign` (`proyecto_id`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistencias_empleado_id_foreign` (`empleado_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datos_usuarios_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `designacions`
--
ALTER TABLE `designacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleados_empresa_id_foreign` (`empresa_id`),
  ADD KEY `empleados_departamento_id_foreign` (`departamento_id`),
  ADD KEY `empleados_designacion_id_foreign` (`designacion_id`),
  ADD KEY `empleados_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examens`
--
ALTER TABLE `examens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examens_empresa_id_foreign` (`empresa_id`),
  ADD KEY `examens_departamento_id_foreign` (`departamento_id`),
  ADD KEY `examens_designacion_id_foreign` (`designacion_id`);

--
-- Indices de la tabla `examen_empleados`
--
ALTER TABLE `examen_empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examen_empleados_examen_id_foreign` (`examen_id`),
  ADD KEY `examen_empleados_empleado_id_foreign` (`empleado_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_empleado_id_foreign` (`empleado_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyectos_cliente_id_foreign` (`cliente_id`),
  ADD KEY `proyectos_lider_proyecto_foreign` (`lider_proyecto`);

--
-- Indices de la tabla `proyecto_equipos`
--
ALTER TABLE `proyecto_equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyecto_equipos_proyecto_id_foreign` (`proyecto_id`),
  ADD KEY `proyecto_equipos_empleado_id_foreign` (`empleado_id`);

--
-- Indices de la tabla `razon_socials`
--
ALTER TABLE `razon_socials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sueldos`
--
ALTER TABLE `sueldos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sueldos_empleado_id_foreign` (`empleado_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacacions`
--
ALTER TABLE `vacacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacacions_empleado_id_foreign` (`empleado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividads`
--
ALTER TABLE `actividads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `designacions`
--
ALTER TABLE `designacions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `examens`
--
ALTER TABLE `examens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `examen_empleados`
--
ALTER TABLE `examen_empleados`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proyecto_equipos`
--
ALTER TABLE `proyecto_equipos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `razon_socials`
--
ALTER TABLE `razon_socials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sueldos`
--
ALTER TABLE `sueldos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vacacions`
--
ALTER TABLE `vacacions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividads`
--
ALTER TABLE `actividads`
  ADD CONSTRAINT `actividads_proyecto_id_foreign` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`);

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD CONSTRAINT `datos_usuarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `empleados_designacion_id_foreign` FOREIGN KEY (`designacion_id`) REFERENCES `designacions` (`id`),
  ADD CONSTRAINT `empleados_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `empleados_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `examens`
--
ALTER TABLE `examens`
  ADD CONSTRAINT `examens_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `examens_designacion_id_foreign` FOREIGN KEY (`designacion_id`) REFERENCES `designacions` (`id`),
  ADD CONSTRAINT `examens_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `examen_empleados`
--
ALTER TABLE `examen_empleados`
  ADD CONSTRAINT `examen_empleados_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`),
  ADD CONSTRAINT `examen_empleados_examen_id_foreign` FOREIGN KEY (`examen_id`) REFERENCES `examens` (`id`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `proyectos_lider_proyecto_foreign` FOREIGN KEY (`lider_proyecto`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `proyecto_equipos`
--
ALTER TABLE `proyecto_equipos`
  ADD CONSTRAINT `proyecto_equipos_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`),
  ADD CONSTRAINT `proyecto_equipos_proyecto_id_foreign` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`);

--
-- Filtros para la tabla `sueldos`
--
ALTER TABLE `sueldos`
  ADD CONSTRAINT `sueldos_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `vacacions`
--
ALTER TABLE `vacacions`
  ADD CONSTRAINT `vacacions_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
