-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-05-2020 a las 03:36:37
-- Versión del servidor: 5.7.26
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `genus_asistente_pqr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia`
--

DROP TABLE IF EXISTS `historia`;
CREATE TABLE IF NOT EXISTS `historia` (
  `historia_id` int(11) NOT NULL AUTO_INCREMENT,
  `historia_cedula` bigint(20) DEFAULT '0',
  `historia_nombre_1` varchar(50) DEFAULT '',
  `historia_apellido_1` varchar(50) DEFAULT '',
  `historia_direccion` varchar(100) DEFAULT '',
  `historia_telefono` varchar(80) DEFAULT '',
  `historia_nombre_2` varchar(50) DEFAULT '',
  `historia_apellido_2` varchar(50) DEFAULT '',
  `historia_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `historia_clasificacion_pqr` varchar(100) NOT NULL,
  `historia_entidad` varchar(100) NOT NULL,
  `historia_cargo` varchar(50) NOT NULL,
  `historia_email` varchar(100) NOT NULL,
  `historia_tipo_usuario` varchar(50) NOT NULL,
  `historia_clase_pqr` varchar(50) NOT NULL,
  `historia_canal` varchar(50) NOT NULL,
  `historia_radicado_gestion` date DEFAULT NULL,
  `historia_num_radicado_gestion` bigint(20) NOT NULL,
  `historia_radicado_planeacion` date DEFAULT NULL,
  `historia_num_radicado_planeacion` bigint(20) NOT NULL,
  `historia_area` varchar(50) NOT NULL,
  `historia_funcionario` varchar(100) NOT NULL,
  `historia_medio_respuesta` varchar(50) NOT NULL,
  `historia_fecha_respuesta` date DEFAULT NULL,
  `historia_num_oficio_respuesta` bigint(20) NOT NULL,
  `historia_respuesta` longtext NOT NULL,
  PRIMARY KEY (`historia_id`),
  KEY `historia_id` (`historia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

DROP TABLE IF EXISTS `medico`;
CREATE TABLE IF NOT EXISTS `medico` (
  `medico_id` int(11) NOT NULL AUTO_INCREMENT,
  `medico_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medico_password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `medico_token` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `medico_token_caducidad` datetime DEFAULT NULL,
  `medico_nivel` int(11) NOT NULL DEFAULT '1',
  `medico_estado` int(11) NOT NULL DEFAULT '1',
  `medico_nombres` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `medico_apellidos` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`medico_id`),
  KEY `medico_id` (`medico_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32711996 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`medico_id`, `medico_usuario`, `medico_password`, `medico_token`, `medico_token_caducidad`, `medico_nivel`, `medico_estado`, `medico_nombres`, `medico_apellidos`) VALUES
(1, 'haorozco', '89a08d3a80b810fb355e0d33439ee4f63d2c6491', '', NULL, 1, 1, 'Hugo Andres', 'Orozco Rios'),
(2, 'slospina', '89a08d3a80b810fb355e0d33439ee4f63d2c6491', '', NULL, 2, 1, 'Sandra Lucia', 'Ospina'),
(3, 'aruiz', '89a08d3a80b810fb355e0d33439ee4f63d2c6491', '', NULL, 2, 1, 'Adriana', 'Ruiz'),
(4, 'csanchez', '89a08d3a80b810fb355e0d33439ee4f63d2c6491', '', NULL, 2, 1, 'Claudia', 'Sanchez'),
(5, 'mptorres', '89a08d3a80b810fb355e0d33439ee4f63d2c6491', '', NULL, 2, 1, 'Martha Patricia', 'Torres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_historia`
--

DROP TABLE IF EXISTS `medico_historia`;
CREATE TABLE IF NOT EXISTS `medico_historia` (
  `medico_id` int(11) NOT NULL,
  `historia_id` int(11) NOT NULL,
  PRIMARY KEY (`medico_id`,`historia_id`),
  KEY `medico_id` (`medico_id`),
  KEY `historia_id` (`historia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `medico_historia`
--
ALTER TABLE `medico_historia`
  ADD CONSTRAINT `medico_historia_ibfk_1` FOREIGN KEY (`historia_id`) REFERENCES `historia` (`historia_id`),
  ADD CONSTRAINT `medico_historia_ibfk_2` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`medico_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
