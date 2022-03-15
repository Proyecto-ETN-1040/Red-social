-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-03-2022 a las 13:00:04
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `redsocial_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

DROP TABLE IF EXISTS `archivos`;
CREATE TABLE IF NOT EXISTS `archivos` (
  `arc_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `men_id` int(11) NOT NULL,
  `arc_codigo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `arc_archivo` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `arc_tipo` int(1) NOT NULL COMMENT '1-pdf,2-word',
  `arc_estado` int(1) NOT NULL COMMENT '0-inactivo, 1-activo',
  PRIMARY KEY (`arc_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`arc_id`, `usu_id`, `men_id`, `arc_codigo`, `arc_archivo`, `arc_tipo`, `arc_estado`) VALUES
(1, 4, 35, '1564606367.jpg', '164642.jpg', 0, 0),
(2, 7, 36, '1564606410.jpg', '490350.jpg', 0, 0),
(3, 4, 37, '1564608132.png', '1_Juan_José_Flores_cropped.png', 0, 0),
(4, 4, 38, '1564608224.jpg', '490350.jpg', 0, 0),
(5, 4, 39, '1564608308.jpg', 'Dr.-Gustavo-Hernandez-1024x767.jpg', 0, 0),
(6, 7, 40, '1564608353.png', 'customers-icon-3.png', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `pub_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `com_fecha` date NOT NULL,
  `com_hora` time NOT NULL,
  `com_comentario` text COLLATE utf8_unicode_ci NOT NULL,
  `com_estado` int(1) NOT NULL COMMENT '0-inactivo, 1-activo',
  PRIMARY KEY (`com_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`com_id`, `pub_id`, `usu_id`, `com_fecha`, `com_hora`, `com_comentario`, `com_estado`) VALUES
(1, 1, 4, '2019-08-28', '02:06:02', 'buen contenido 654', 1),
(2, 1, 4, '2019-08-28', '02:06:16', 'genial!!', 1),
(3, 1, 4, '2019-08-28', '02:07:19', 'bien..', 1),
(4, 1, 4, '2019-08-28', '02:07:45', '............65', 1),
(5, 1, 4, '2019-08-28', '02:08:55', 'mmmmmm', 1),
(6, 1, 4, '2019-08-28', '02:16:27', '666661', 1),
(7, 2, 4, '2019-08-28', '02:17:01', '1111x', 1),
(8, 2, 4, '2019-08-28', '02:17:41', '222223', 1),
(9, 16, 4, '2019-11-07', '11:01:48', 'ffff', 1),
(10, 2, 4, '2019-12-31', '19:29:49', 'eee', 1),
(11, 2, 4, '2019-12-31', '19:52:02', 'comentario nuevo', 1),
(12, 2, 4, '2019-12-31', '20:14:39', 'commm', 1),
(13, 2, 4, '2019-12-31', '20:14:40', 'commm', 1),
(14, 2, 4, '2019-12-31', '20:14:52', 'oooooo', 1),
(15, 2, 4, '2019-12-31', '20:15:11', 'ffff', 1),
(16, 4, 4, '2019-12-31', '20:15:58', 'xxxxxx', 1),
(17, 1, 4, '2020-01-07', '11:08:32', 'ttttttt', 1),
(18, 1, 4, '2020-01-07', '11:08:35', 'ttttttt', 1),
(19, 5, 4, '2020-01-07', '11:09:02', 'yyyyyy', 1),
(20, 6, 4, '2020-01-07', '11:09:23', 'uuuuuu', 1),
(21, 1, 4, '2020-01-09', '11:04:11', 'hhhhhh', 1),
(22, 1, 4, '2020-01-16', '10:09:24', 'jjjjj', 1),
(23, 11, 4, '2020-02-04', '12:05:59', 'holaaa', 1),
(24, 1, 4, '2020-02-06', '15:01:29', 'ggggggg', 1),
(26, 1, 4, '2020-02-06', '15:02:27', 'jjjjj', 1),
(27, 17, 4, '2020-02-07', '10:03:07', 'nnnnn', 1),
(28, 11, 4, '2020-02-07', '11:31:34', 'jjjjjj', 1),
(29, 11, 4, '2020-02-07', '11:31:36', 'jjjjjj', 1),
(30, 17, 4, '2020-03-18', '18:15:40', 'xxxxx', 1),
(31, 17, 4, '2020-03-18', '18:16:12', 'oooo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `pub_id` int(11) NOT NULL,
  `img_imagen` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `img_desc` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`img_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`img_id`, `pub_id`, `img_imagen`, `img_desc`) VALUES
(1, 1, 'Desert.jpg', ''),
(2, 1, 'Chrysanthemum.jpg', ''),
(3, 1, 'Hydrangeas.jpg', ''),
(4, 16, 'ic_publicacion.jpg', NULL),
(5, 32, '51igJOApjhL._AC_.jpg', NULL),
(6, 33, '51or46y2-vL._AC_SY355_.jpg', NULL),
(7, 34, 'digitalocean.jpg', NULL),
(8, 35, '51igJOApjhL._AC_.jpg', NULL),
(9, 36, '51igJOApjhL._AC_.jpg', NULL),
(10, 38, '51igJOApjhL._AC_.jpg', NULL),
(11, 39, 'digitalocean.jpg', NULL),
(12, 40, '164705396596475447904.jpg', NULL),
(13, 41, '164705396596475447904.jpg', NULL),
(14, 42, 'FB_IMG_1644022108601.jpg', NULL),
(15, 45, 'telecom.jpg', NULL),
(16, 46, 'redes.jpg', NULL),
(17, 47, 'vlcsnap-2022-02-07-22h06m48s300.png', NULL),
(18, 48, 'Screenshot_2021-07-28-23-47-00.png', NULL),
(19, 48, 'Screenshot_2021-07-28-23-47-42.png', NULL),
(20, 50, 'telecom.jpg', NULL),
(21, 50, 'redes.jpg', NULL),
(22, 51, 'Redes_Windows.webp', NULL),
(23, 53, 'comunicado.jpg', NULL),
(24, 54, 'comunicado2.png', NULL),
(25, 55, 'comun3.png', NULL),
(26, 57, 'comun4.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `lik_id` int(11) NOT NULL AUTO_INCREMENT,
  `pub_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`lik_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`lik_id`, `pub_id`, `usu_id`) VALUES
(1, 16, 4),
(10, 1, 4),
(11, 2, 4),
(12, 2, 4),
(13, 4, 4),
(14, 5, 4),
(15, 7, 4),
(16, 11, 4),
(17, 17, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `mat_id` int(11) NOT NULL AUTO_INCREMENT,
  `mat_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mat_detalle` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `mat_estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`mat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`mat_id`, `mat_desc`, `mat_detalle`, `mat_estado`) VALUES
(1, 'ETN-1011', 'SISTEMAS DE TELECOMUNICACIONES', 1),
(2, 'ETN-1024', 'SEMINARIOS DE TELECOMUNICACIONES', 1),
(3, 'ETN-1038', 'TECNOLOGIA DE TELECOMUNICACIONES', 1),
(14, 'ETN-601', 'SISTEMAS DIGITALES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `men_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `env_id` int(11) NOT NULL COMMENT 'usu_id envio',
  `men_fecha` datetime NOT NULL,
  `men_mensaje` text COLLATE utf8_unicode_ci NOT NULL,
  `men_tipo` int(1) NOT NULL COMMENT '1-texto,2-archivo adjunto',
  `men_estado` int(1) NOT NULL COMMENT '0-enviado,1-visto',
  PRIMARY KEY (`men_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`men_id`, `usu_id`, `env_id`, `men_fecha`, `men_mensaje`, `men_tipo`, `men_estado`) VALUES
(72, 4, 5, '2020-06-12 11:26:16', 'ghjkl', 1, 0),
(73, 5, 4, '2020-06-12 11:26:32', 'erty', 1, 0),
(74, 5, 4, '2020-08-20 12:53:05', 'hola', 1, 0),
(75, 4, 5, '2020-08-20 12:53:15', 'que tal', 1, 0),
(76, 4, 5, '2020-08-20 13:05:33', 'que haciendo??', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `not_tipo` int(1) DEFAULT NULL,
  `not_estado` int(1) NOT NULL COMMENT '0-no leida,1-leida',
  PRIMARY KEY (`not_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`not_id`, `usu_id`, `pub_id`, `not_tipo`, `not_estado`) VALUES
(1, 6, 1, 0, 0),
(2, 6, 2, 0, 0),
(3, 4, 11, NULL, 1),
(4, 5, 11, NULL, 0),
(5, 7, 11, NULL, 0),
(6, 5, 0, NULL, 0),
(7, 6, 0, NULL, 0),
(8, 7, 0, NULL, 0),
(9, 5, 0, NULL, 0),
(10, 6, 0, NULL, 0),
(11, 7, 0, NULL, 0),
(12, 5, 12, NULL, 0),
(13, 6, 12, NULL, 0),
(14, 7, 12, NULL, 0),
(15, 5, 13, NULL, 0),
(16, 6, 13, NULL, 0),
(17, 7, 13, NULL, 0),
(18, 5, 14, NULL, 0),
(19, 6, 14, NULL, 0),
(20, 7, 14, NULL, 0),
(21, 5, 15, NULL, 0),
(22, 6, 15, NULL, 0),
(23, 7, 15, NULL, 0),
(24, 5, 16, NULL, 0),
(25, 6, 16, NULL, 0),
(26, 7, 16, NULL, 0),
(27, 4, 17, NULL, 1),
(28, 5, 17, NULL, 0),
(29, 7, 17, NULL, 0),
(30, 5, 18, NULL, 0),
(31, 6, 18, NULL, 0),
(32, 7, 18, NULL, 0),
(33, 5, 19, NULL, 0),
(34, 6, 19, NULL, 0),
(35, 7, 19, NULL, 0),
(36, 5, 20, NULL, 0),
(37, 6, 20, NULL, 0),
(38, 7, 20, NULL, 0),
(39, 5, 21, NULL, 0),
(40, 6, 21, NULL, 0),
(41, 7, 21, NULL, 0),
(42, 5, 22, NULL, 0),
(43, 6, 22, NULL, 0),
(44, 7, 22, NULL, 0),
(45, 5, 23, NULL, 0),
(46, 6, 23, NULL, 0),
(47, 7, 23, NULL, 0),
(48, 4, 0, NULL, 0),
(49, 5, 0, NULL, 0),
(50, 6, 0, NULL, 0),
(51, 7, 0, NULL, 0),
(52, 5, 0, NULL, 0),
(53, 6, 0, NULL, 0),
(54, 7, 0, NULL, 0),
(55, 5, 24, NULL, 1),
(56, 6, 24, NULL, 0),
(57, 7, 24, NULL, 0),
(58, 4, 0, NULL, 0),
(59, 6, 0, NULL, 0),
(60, 7, 0, NULL, 0),
(61, 4, 25, NULL, 0),
(62, 6, 25, NULL, 0),
(63, 7, 25, NULL, 0),
(64, 4, 26, NULL, 0),
(65, 6, 26, NULL, 0),
(66, 7, 26, NULL, 0),
(67, 4, 0, NULL, 0),
(68, 6, 0, NULL, 0),
(69, 7, 0, NULL, 0),
(70, 4, 27, NULL, 1),
(71, 6, 27, NULL, 0),
(72, 7, 27, NULL, 0),
(73, 5, 28, NULL, 1),
(74, 6, 28, NULL, 0),
(75, 7, 28, NULL, 0),
(76, 4, 0, NULL, 0),
(77, 6, 0, NULL, 0),
(78, 7, 0, NULL, 0),
(79, 4, 0, NULL, 0),
(80, 6, 0, NULL, 0),
(81, 7, 0, NULL, 0),
(82, 4, 29, NULL, 0),
(83, 6, 29, NULL, 0),
(84, 7, 29, NULL, 0),
(85, 4, 30, NULL, 0),
(86, 6, 30, NULL, 0),
(87, 7, 30, NULL, 0),
(88, 4, 31, NULL, 0),
(89, 6, 31, NULL, 0),
(90, 7, 31, NULL, 0),
(91, 4, 32, NULL, 0),
(92, 6, 32, NULL, 0),
(93, 7, 32, NULL, 0),
(94, 4, 33, NULL, 0),
(95, 6, 33, NULL, 0),
(96, 7, 33, NULL, 0),
(97, 4, 34, NULL, 0),
(98, 6, 34, NULL, 0),
(99, 7, 34, NULL, 0),
(100, 4, 37, NULL, 0),
(101, 6, 37, NULL, 0),
(102, 7, 37, NULL, 0),
(103, 4, 38, NULL, 0),
(104, 6, 38, NULL, 0),
(105, 7, 38, NULL, 0),
(106, 4, 39, NULL, 0),
(107, 6, 39, NULL, 0),
(108, 7, 39, NULL, 1),
(109, 4, 40, NULL, 0),
(110, 5, 40, NULL, 0),
(111, 6, 40, NULL, 0),
(112, 4, 41, NULL, 0),
(113, 5, 41, NULL, 0),
(114, 6, 41, NULL, 0),
(115, 4, 42, NULL, 0),
(116, 5, 42, NULL, 0),
(117, 6, 42, NULL, 0),
(118, 4, 43, NULL, 0),
(119, 5, 43, NULL, 0),
(120, 6, 43, NULL, 0),
(121, 4, 44, NULL, 0),
(122, 5, 44, NULL, 0),
(123, 6, 44, NULL, 0),
(124, 7, 44, NULL, 0),
(125, 5, 45, NULL, 0),
(126, 9, 45, NULL, 0),
(127, 10, 45, NULL, 0),
(128, 12, 45, NULL, 0),
(129, 13, 45, NULL, 0),
(130, 5, 46, NULL, 0),
(131, 9, 46, NULL, 0),
(132, 10, 46, NULL, 0),
(133, 11, 46, NULL, 0),
(134, 12, 46, NULL, 0),
(135, 9, 47, NULL, 0),
(136, 10, 47, NULL, 0),
(137, 11, 47, NULL, 0),
(138, 12, 47, NULL, 0),
(139, 13, 47, NULL, 0),
(140, 9, 48, NULL, 0),
(141, 10, 48, NULL, 0),
(142, 11, 48, NULL, 0),
(143, 12, 48, NULL, 0),
(144, 13, 48, NULL, 0),
(145, 9, 49, NULL, 0),
(146, 10, 49, NULL, 0),
(147, 11, 49, NULL, 0),
(148, 12, 49, NULL, 0),
(149, 13, 49, NULL, 0),
(150, 9, 50, NULL, 0),
(151, 10, 50, NULL, 0),
(152, 11, 50, NULL, 0),
(153, 12, 50, NULL, 0),
(154, 13, 50, NULL, 0),
(155, 5, 51, NULL, 0),
(156, 9, 51, NULL, 0),
(157, 10, 51, NULL, 0),
(158, 12, 51, NULL, 0),
(159, 13, 51, NULL, 0),
(160, 5, 52, NULL, 0),
(161, 9, 52, NULL, 0),
(162, 10, 52, NULL, 0),
(163, 12, 52, NULL, 0),
(164, 13, 52, NULL, 0),
(165, 5, 53, NULL, 0),
(166, 9, 53, NULL, 0),
(167, 10, 53, NULL, 0),
(168, 11, 53, NULL, 0),
(169, 13, 53, NULL, 0),
(170, 14, 53, NULL, 0),
(171, 5, 54, NULL, 0),
(172, 9, 54, NULL, 0),
(173, 10, 54, NULL, 0),
(174, 11, 54, NULL, 0),
(175, 13, 54, NULL, 0),
(176, 14, 54, NULL, 0),
(177, 5, 55, NULL, 0),
(178, 9, 55, NULL, 0),
(179, 10, 55, NULL, 0),
(180, 11, 55, NULL, 0),
(181, 13, 55, NULL, 0),
(182, 14, 55, NULL, 0),
(183, 5, 56, NULL, 0),
(184, 9, 56, NULL, 0),
(185, 10, 56, NULL, 0),
(186, 11, 56, NULL, 0),
(187, 13, 56, NULL, 0),
(188, 14, 56, NULL, 0),
(189, 5, 57, NULL, 0),
(190, 9, 57, NULL, 0),
(191, 10, 57, NULL, 0),
(192, 11, 57, NULL, 0),
(193, 13, 57, NULL, 0),
(194, 14, 57, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
CREATE TABLE IF NOT EXISTS `publicacion` (
  `pub_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `pub_fecha` date NOT NULL,
  `pub_hora` time NOT NULL,
  `pub_titulo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub_desc` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub_imagen` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub_tipo` int(1) DEFAULT NULL COMMENT '1-comunicado,2-noticia,3-evento',
  `pub_estado` int(1) NOT NULL COMMENT '0-inactivo,1-activo',
  PRIMARY KEY (`pub_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`pub_id`, `usu_id`, `pub_fecha`, `pub_hora`, `pub_titulo`, `pub_desc`, `pub_imagen`, `pub_tipo`, `pub_estado`) VALUES
(24, 4, '2020-06-07', '16:25:04', NULL, 'EXAMEN 10-20-23', NULL, 1, 1),
(28, 4, '2020-06-12', '11:29:14', NULL, 'uyiuyi', NULL, 14, 1),
(35, 0, '2022-03-11', '21:17:58', NULL, '', NULL, -1, 1),
(36, 0, '2022-03-11', '21:18:04', NULL, '', NULL, -1, 1),
(42, 7, '2022-03-11', '23:07:25', NULL, 'Imagen prueba', NULL, -1, 1),
(43, 7, '2022-03-12', '15:01:25', NULL, 'Hola', NULL, -1, 1),
(44, 8, '2022-03-12', '16:06:33', NULL, 'soy don martin', NULL, -1, 1),
(47, 5, '2022-03-13', '00:30:58', NULL, '', NULL, -1, 1),
(48, 5, '2022-03-13', '00:35:49', NULL, '', NULL, -1, 1),
(50, 5, '2022-03-13', '00:40:44', NULL, '', NULL, -1, 1),
(51, 11, '2022-03-14', '13:08:05', NULL, 'PUBLICACION MATERIA ETN-1024', NULL, 2, 1),
(52, 11, '2022-03-14', '13:09:15', NULL, 'Segunda Publicación de prueba ETN-1024 sin imagen. ', NULL, 2, 1),
(57, 12, '2022-03-15', '07:44:33', NULL, 'Comunicado de Prueba', NULL, -1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion_c`
--

DROP TABLE IF EXISTS `publicacion_c`;
CREATE TABLE IF NOT EXISTS `publicacion_c` (
  `puc` int(11) NOT NULL AUTO_INCREMENT,
  `pub_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `puc_fecha` date NOT NULL,
  `puc_hora` time NOT NULL,
  PRIMARY KEY (`puc`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `publicacion_c`
--

INSERT INTO `publicacion_c` (`puc`, `pub_id`, `usu_id`, `puc_fecha`, `puc_hora`) VALUES
(16, 1, 4, '2019-08-28', '02:07:01'),
(17, 16, 6, '2019-11-07', '11:01:55'),
(18, 17, 6, '2019-12-06', '11:05:51'),
(19, 1, 4, '2019-12-24', '16:34:34'),
(20, 1, 4, '2019-12-24', '12:36:48'),
(21, 1, 4, '2019-12-24', '13:38:04'),
(22, 1, 4, '2019-12-24', '13:38:04'),
(23, 2, 4, '2019-12-24', '13:38:18'),
(24, 2, 4, '2019-12-24', '13:38:15'),
(25, 4, 4, '2019-12-24', '13:38:29'),
(26, 8, 4, '2019-12-24', '16:45:02'),
(27, 9, 4, '2020-01-07', '01:00:29'),
(28, 1, 4, '2020-01-07', '10:45:24'),
(29, 1, 4, '2020-01-07', '10:45:24'),
(30, 2, 4, '2020-01-07', '10:45:29'),
(31, 5, 4, '2020-01-07', '10:48:29'),
(32, 1, 4, '2020-01-09', '11:04:20'),
(33, 1, 4, '2020-01-16', '10:09:34'),
(34, 15, 4, '2020-02-04', '12:08:10'),
(35, 11, 4, '2020-02-07', '10:04:48'),
(36, 17, 4, '2020-02-07', '10:39:07'),
(37, 10, 4, '2020-02-07', '10:56:31'),
(38, 17, 4, '2020-02-07', '11:32:09'),
(39, 18, 4, '2020-03-19', '00:08:24'),
(40, 19, 4, '2020-03-19', '00:13:29'),
(41, 20, 4, '2020-03-19', '00:13:56'),
(42, 21, 4, '2020-03-19', '00:24:04'),
(43, 22, 4, '2020-03-19', '00:27:46'),
(44, 23, 4, '2020-03-19', '00:28:18'),
(45, 0, 1, '2020-06-07', '12:25:34'),
(46, 0, 4, '2020-06-07', '12:33:21'),
(47, 24, 4, '2020-06-07', '16:25:05'),
(48, 0, 5, '2020-06-12', '10:56:11'),
(49, 25, 5, '2020-06-12', '11:27:26'),
(50, 26, 5, '2020-06-12', '11:27:39'),
(51, 0, 5, '2020-06-12', '11:27:51'),
(52, 27, 5, '2020-06-12', '11:28:09'),
(53, 28, 4, '2020-06-12', '11:29:14'),
(54, 0, 5, '2020-09-03', '05:13:33'),
(55, 0, 5, '2020-09-03', '05:13:48'),
(56, 29, 5, '2022-03-08', '20:53:45'),
(57, 30, 5, '2022-03-08', '21:02:51'),
(58, 31, 5, '2022-03-08', '21:06:13'),
(59, 32, 5, '2022-03-08', '21:10:04'),
(60, 33, 5, '2022-03-08', '21:18:14'),
(61, 34, 5, '2022-03-08', '21:32:55'),
(62, 37, 5, '2022-03-11', '21:30:35'),
(63, 38, 5, '2022-03-11', '21:31:05'),
(64, 39, 5, '2022-03-11', '21:31:41'),
(65, 40, 7, '2022-03-11', '23:00:18'),
(66, 41, 7, '2022-03-11', '23:00:23'),
(67, 42, 7, '2022-03-11', '23:07:25'),
(68, 43, 7, '2022-03-12', '15:01:25'),
(69, 44, 8, '2022-03-12', '16:06:33'),
(70, 45, 11, '2022-03-12', '19:35:37'),
(71, 46, 13, '2022-03-12', '19:36:49'),
(72, 47, 5, '2022-03-13', '00:30:58'),
(73, 48, 5, '2022-03-13', '00:35:49'),
(74, 49, 5, '2022-03-13', '00:40:12'),
(75, 50, 5, '2022-03-13', '00:40:44'),
(76, 51, 11, '2022-03-14', '13:08:05'),
(77, 52, 11, '2022-03-14', '13:09:15'),
(78, 53, 12, '2022-03-15', '07:37:35'),
(79, 54, 12, '2022-03-15', '07:39:16'),
(80, 55, 12, '2022-03-15', '07:40:31'),
(81, 56, 12, '2022-03-15', '07:44:06'),
(82, 57, 12, '2022-03-15', '07:44:33'),
(83, 50, 14, '2022-03-15', '08:51:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

DROP TABLE IF EXISTS `registro`;
CREATE TABLE IF NOT EXISTS `registro` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `mat_id` int(11) NOT NULL,
  `reg_estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`reg_id`, `usu_id`, `mat_id`, `reg_estado`) VALUES
(7, 4, 1, 1),
(8, 6, 1, 1),
(5, 4, 3, 1),
(6, 7, 1, 1),
(9, 6, 3, 1),
(10, 6, 4, 1),
(20, 0, 8, 1),
(21, 0, 9, 1),
(18, 0, 10, 1),
(26, 0, 2, 1),
(23, 0, 13, 1),
(25, 0, 12, 1),
(27, 0, 3, 1),
(28, 0, 1, 1),
(44, 14, 1, 1),
(32, 4, 14, 1),
(33, 9, 3, 1),
(34, 9, 14, 1),
(35, 11, 1, 1),
(36, 11, 2, 1),
(37, 11, 3, 1),
(38, 10, 2, 1),
(39, 10, 3, 1),
(40, 10, 14, 1),
(45, 14, 2, 1),
(42, 5, 1, 1),
(43, 5, 2, 1),
(46, 14, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

DROP TABLE IF EXISTS `seguimiento`;
CREATE TABLE IF NOT EXISTS `seguimiento` (
  `seg_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `use_id` int(11) NOT NULL COMMENT 'usu_id al que se sigue',
  `seg_estado` int(1) NOT NULL COMMENT '0-inactivo,1-activo',
  PRIMARY KEY (`seg_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`seg_id`, `usu_id`, `use_id`, `seg_estado`) VALUES
(1, 5, 4, 1),
(2, 7, 4, 1),
(3, 4, 7, 1),
(6, 4, 4, 1),
(7, 4, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

DROP TABLE IF EXISTS `sesion`;
CREATE TABLE IF NOT EXISTS `sesion` (
  `ses_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `ses_fecha` date NOT NULL,
  `ses_hora` time NOT NULL,
  `ses_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ses_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nombre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_apellido` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_foto` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_imagen` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_tipo` int(1) DEFAULT NULL COMMENT '1-estudiantes,2-docentes,3-auxiliares,4-administrativos',
  `usu_nivel` int(1) NOT NULL,
  `usu_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_usuario` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_clave` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_estado` int(1) DEFAULT NULL COMMENT '0-inactivo,1-activo',
  `usu_conectado` tinyint(4) DEFAULT NULL COMMENT '0 = no conectado, 1 = conectado',
  PRIMARY KEY (`usu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_nombre`, `usu_apellido`, `usu_foto`, `usu_imagen`, `usu_tipo`, `usu_nivel`, `usu_email`, `usu_usuario`, `usu_clave`, `usu_estado`, `usu_conectado`) VALUES
(5, 'Erik', 'Quispe', 'images.png', '', 1, 1, 'erik@gmail.com', '1669041', '5d5ecf27fe95b6287418cf0c7a6f1883373c127b', 1, 0),
(9, 'Abigail', 'Mamani', 'images.png', '', 1, 1, 'abi@gmail.com', '1668931', '1fb9b1ff540ea77e694053a2c48366f906f45342', 1, 0),
(10, 'Estudiante', '1', 'images.png', '', 1, 2, 'est1@gmail.com', 'estudiante1', '1ba9ea6cbd002b64c3b4af6dab81a9dcf78f0715', 1, 1),
(11, 'Docente', '1', '', '', 2, 2, 'doc@gmail.com', 'docente1', '382febb0b3e9435aa42454dca29ec440ad34d09f', 1, 1),
(12, 'Administrativo', '1', '', '', 4, 2, 'adm@gmail.com', 'administrativo1', '4515606318b4f5e38ca321ddadce8c3c6364095e', 1, 0),
(13, 'Auxiliar', '1', '', '', 3, 2, 'aux1@gmail.com', 'auxiliar1', '1d00cad6b720674c04279b28d0aa906056765f26', 1, 1),
(14, 'Usuario', 'De Prueba', '', '', 3, 1, 'user@gmail.com', 'usuarioprueba', '3c55950f0400029902b056c1492f4cc040898c79', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
