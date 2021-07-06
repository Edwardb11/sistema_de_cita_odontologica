-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-07-2021 a las 21:05:18
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `perfect_teeth`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  `id_doctor` int(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `id_consultas` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consultas` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consultas`, `tipo`) VALUES
(1, 'Revisión general'),
(2, 'Limpieza bucal'),
(3, 'Empastes'),
(4, 'Endodoncia'),
(5, 'Ortodoncia'),
(6, 'Prótesis'),
(7, 'Implantes'),
(8, 'Cirugías bucales'),
(9, 'Cosmética dental ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `id_doctor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `correo_eletronico` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `id_especialidad` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `doctor`
--

INSERT INTO `doctor` (`id_doctor`, `nombre`, `apellido`, `sexo`, `fecha_nacimiento`, `telefono`, `correo_eletronico`, `clave`, `id_especialidad`) VALUES
(9, 'Francisco', 'Rosario', 'Masculino', '2001-07-05', '8097983519', 'franciscoRosario@hotmail.com', '1234', 2),
(10, 'Stewar', 'Diaz', 'Masculino', '2000-07-16', '8099891736', 'Stewar@company.com', '1234', 3),
(11, 'Alernis', 'Hernandez', 'Femenino', '2000-07-13', '8097686677', 'arlenis@company.com', '1234', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_especialidad`, `tipo`) VALUES
(1, 'Odontólogo general'),
(2, 'Odontopediatra'),
(3, 'Ortodoncista'),
(4, 'Patólogo oral'),
(5, 'Endodoncista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo_eletronico` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_usuario`, `usuario`, `apellido`, `telefono`, `correo_eletronico`, `clave`) VALUES
(1, 'Edward', 'Brito Diaz', '8498779910', 'edwardbrito11@hotmail.com', '12'),
(2, 'Yessica', 'Villavizar', '891892281', 'yessicavillavizar@hotmail.com', '12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `paciente-cita` (`id_usuario`),
  ADD KEY `doctor-cita` (`id_doctor`),
  ADD KEY `consultas-pacientes` (`id_consultas`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consultas`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id_doctor`),
  ADD KEY `id_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id_doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `consultas-pacientes` FOREIGN KEY (`id_consultas`) REFERENCES `consultas` (`id_consultas`),
  ADD CONSTRAINT `doctor-cita` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`),
  ADD CONSTRAINT `paciente-cita` FOREIGN KEY (`id_usuario`) REFERENCES `login` (`id_usuario`);

--
-- Filtros para la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `id_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
