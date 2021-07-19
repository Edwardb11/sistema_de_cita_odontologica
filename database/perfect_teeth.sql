-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-07-2021 a las 23:20:24
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
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `id_consultas` int(11) NOT NULL,
  `estado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_paciente`, `id_doctor`, `fecha_nacimiento`, `fecha_cita`, `hora_cita`, `id_consultas`, `estado`) VALUES
(1, 2, 1, '2001-07-06', '2021-07-12', '03:00:00', 2, 'I'),
(2, 1, 2, '2021-07-02', '2021-07-02', '12:30:00', 1, 'A'),
(3, 2, 1, '2001-07-05', '2021-07-02', '22:12:00', 1, 'A'),
(4, 2, 1, '2021-07-06', '2021-07-16', '20:02:00', 1, 'I'),
(5, 2, 1, '2001-07-11', '2021-07-18', '12:34:00', 3, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consultas` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `nombreD` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `correo_eletronico` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `id_especialidad` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `doctor`
--

INSERT INTO `doctor` (`id_doctor`, `nombreD`, `apellido`, `sexo`, `fecha_nacimiento`, `telefono`, `correo_eletronico`, `clave`, `id_especialidad`) VALUES
(1, 'Francisco', 'Rosario', 'Masculino', '2001-07-05', '8097983519', 'franciscoRosario@hotmail.com', '1234', 2),
(2, 'Stewar', 'Diaz', 'Masculino', '2000-07-16', '8099891736', 'Stewar@company.com', '1234', 3),
(3, 'Alernis', 'Hernandez', 'Femenino', '2000-07-13', '8097686677', 'arlenis@company.com', '1234', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nombre`, `apellido`, `telefono`, `correo_electronico`, `clave`) VALUES
(1, 'Edward', 'Brito Diaz', '8498779910', 'edwardbrito11@hotmail.com', '12'),
(2, 'Yessica', 'Villavizar', '891892281', 'yessicavillavizar@hotmail.com', '12'),
(7, ' Villavizar', '', '', '', ''),
(8, ' Villavizar', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_diagnostico`
--

CREATE TABLE `paciente_diagnostico` (
  `id_diagnostico` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `medicina` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paciente_diagnostico`
--

INSERT INTO `paciente_diagnostico` (`id_diagnostico`, `id_cita`, `descripcion`, `medicina`) VALUES
(1, 2, 'aa', 'aa'),
(2, 2, 'a', 'a'),
(3, 2, 'a', 'a'),
(4, 2, 'Hola', 'Hola'),
(5, 3, 'hahahahahah', 'hahahahah'),
(6, 2, 'aahha', 'hahaha'),
(7, 2, 'a', 'a'),
(8, 2, 'a', 'a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `consultas-pacientes` (`id_consultas`),
  ADD KEY `doctor-cita` (`id_doctor`),
  ADD KEY `paciente-cita` (`id_paciente`);

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
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `paciente_diagnostico`
--
ALTER TABLE `paciente_diagnostico`
  ADD PRIMARY KEY (`id_diagnostico`),
  ADD KEY `id_cita_fk` (`id_cita`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id_doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `paciente_diagnostico`
--
ALTER TABLE `paciente_diagnostico`
  MODIFY `id_diagnostico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `consultas-pacientes` FOREIGN KEY (`id_consultas`) REFERENCES `consultas` (`id_consultas`),
  ADD CONSTRAINT `doctor-cita` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`);

--
-- Filtros para la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `id_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`);

--
-- Filtros para la tabla `paciente_diagnostico`
--
ALTER TABLE `paciente_diagnostico`
  ADD CONSTRAINT `id_cita_fk` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id_cita`),
  ADD CONSTRAINT `id_doctor_fk` FOREIGN KEY (`id_cita`) REFERENCES `doctor` (`id_doctor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
