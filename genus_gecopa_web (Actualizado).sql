-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-03-2019 a las 16:07:30
-- Versión del servidor: 5.6.43-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

--
-- Base de datos: `perenlin_app_gecopa_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `cita_id` int(11) NOT NULL,
  `cita_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cita_informe` longtext NOT NULL,
  `cita_formula` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia`
--

CREATE TABLE `historia` (
  `historia_id` int(11) NOT NULL,
  `historia_cedula` bigint(20) NOT NULL DEFAULT '0',
  `historia_nombre_1` varchar(50) DEFAULT '',
  `historia_apellido_1` varchar(50) DEFAULT '',
  `historia_direccion` varchar(100) DEFAULT '',
  `historia_telefono` varchar(80) DEFAULT '',
  `historia_profesion` varchar(100) DEFAULT '',
  `historia_edad` varchar(50) DEFAULT '',
  `historia_hta_ap` varchar(100) DEFAULT '',
  `historia_hta_af` varchar(100) DEFAULT '',
  `historia_dm_ap` varchar(100) DEFAULT '',
  `historia_dm_af` varchar(100) DEFAULT '',
  `historia_asma_ap` varchar(100) DEFAULT '',
  `historia_asma_af` varchar(100) DEFAULT '',
  `historia_cancer_ap` varchar(100) DEFAULT '',
  `historia_cancer_af` varchar(100) DEFAULT '',
  `historia_quirurgicos_ap` longtext,
  `historia_quirurgicos_af` varchar(100) DEFAULT '',
  `historia_hospitalizaciones_ap` varchar(100) DEFAULT '',
  `historia_hospitalizaciones_af` varchar(100) DEFAULT '',
  `historia_alergias_ap` varchar(100) DEFAULT '',
  `historia_alergias_af` varchar(100) DEFAULT '',
  `historia_fumador_ap` varchar(100) DEFAULT '',
  `historia_fumador_af` varchar(100) DEFAULT '',
  `historia_licor_ap` varchar(100) DEFAULT '',
  `historia_licor_af` varchar(100) DEFAULT '',
  `historia_otros` longtext,
  `historia_descripcion` longtext,
  `historia_fgo_g` varchar(50) DEFAULT '',
  `historia_fgo_p` varchar(50) DEFAULT '',
  `historia_fgo_a` varchar(50) DEFAULT '',
  `historia_fgo_c` varchar(50) DEFAULT '',
  `historia_fgo_v` varchar(50) DEFAULT '',
  `historia_fum_dia` varchar(50) DEFAULT '',
  `historia_fum_mes` varchar(50) DEFAULT '',
  `historia_fum_ano` varchar(50) DEFAULT '',
  `historia_fup_dia` varchar(50) DEFAULT '',
  `historia_fup_mes` varchar(50) DEFAULT '',
  `historia_fup_ano` varchar(50) DEFAULT '',
  `historia_fuc_dia` varchar(50) DEFAULT '',
  `historia_fuc_mes` varchar(50) DEFAULT '',
  `historia_fuc_ano` varchar(50) DEFAULT '',
  `historia_planificacion` varchar(100) DEFAULT '',
  `historia_ef` longtext,
  `historia_pa` varchar(100) DEFAULT '',
  `historia_fc` varchar(100) DEFAULT '',
  `historia_peso` varchar(50) DEFAULT '',
  `historia_dx1` varchar(100) DEFAULT '',
  `historia_dx2` varchar(100) DEFAULT '',
  `historia_dx3` varchar(100) DEFAULT '',
  `historia_tratamiento` longtext,
  `historia_banos` longtext,
  `historia_bebidas` longtext,
  `historia_control` varchar(200) DEFAULT '',
  `historia_medico` varchar(200) DEFAULT '',
  `historia_fitoterapeuta` varchar(200) DEFAULT '',
  `historia_nombre_2` varchar(50) DEFAULT '',
  `historia_apellido_2` varchar(50) DEFAULT '',
  `historia_fr` varchar(50) DEFAULT '',
  `historia_t` varchar(50) DEFAULT '',
  `historia_motivoconsulta` longtext,
  `historia_rxs` longtext,
  `historia_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_cita`
--

CREATE TABLE `historia_cita` (
  `historia_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `medico_id` int(11) NOT NULL,
  `medico_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medico_password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `medico_token` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `medico_token_caducidad` datetime DEFAULT NULL,
  `medico_nivel` int(11) NOT NULL DEFAULT '1',
  `medico_estado` int(11) NOT NULL DEFAULT '1',
  `medico_nombres` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `medico_apellidos` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_historia`
--

CREATE TABLE `medico_historia` (
  `medico_id` int(11) NOT NULL,
  `historia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`cita_id`);

--
-- Indices de la tabla `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`historia_id`),
  ADD KEY `historia_id` (`historia_id`);

--
-- Indices de la tabla `historia_cita`
--
ALTER TABLE `historia_cita`
  ADD PRIMARY KEY (`historia_id`,`cita_id`),
  ADD KEY `historia_id` (`historia_id`),
  ADD KEY `cita_id` (`cita_id`),
  ADD KEY `cita_id_2` (`cita_id`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`medico_id`),
  ADD KEY `medico_id` (`medico_id`);

--
-- Indices de la tabla `medico_historia`
--
ALTER TABLE `medico_historia`
  ADD PRIMARY KEY (`medico_id`,`historia_id`),
  ADD KEY `medico_id` (`medico_id`),
  ADD KEY `historia_id` (`historia_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `cita_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60459;

--
-- AUTO_INCREMENT de la tabla `historia`
--
ALTER TABLE `historia`
  MODIFY `historia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43086;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `medico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32711991;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historia_cita`
--
ALTER TABLE `historia_cita`
  ADD CONSTRAINT `historia_cita_ibfk_1` FOREIGN KEY (`historia_id`) REFERENCES `historia` (`historia_id`),
  ADD CONSTRAINT `historia_cita_ibfk_2` FOREIGN KEY (`cita_id`) REFERENCES `cita` (`cita_id`);

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
