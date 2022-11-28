-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2022 a las 02:16:48
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospitalito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cirugia`
--

CREATE TABLE `cirugia` (
  `id_cirugia` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_sala` tinyint(4) DEFAULT NULL,
  `id_doctor` smallint(6) DEFAULT NULL,
  `fechaini` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cirugia`
--

INSERT INTO `cirugia` (`id_cirugia`, `id_paciente`, `id_sala`, `id_doctor`, `fechaini`) VALUES
(1, 1, 1, 4, '2022-11-01 04:00:00'),
(2, 2, 7, 2, '2022-10-31 05:30:00'),
(3, 3, 3, 9, '2022-10-31 07:00:00'),
(4, 4, 4, 5, '2022-11-02 17:00:00'),
(5, 5, 5, 8, '2022-11-03 15:00:00'),
(6, 6, 6, 1, '2022-11-03 20:00:00'),
(7, 5, 8, 7, '2022-10-31 12:00:00'),
(8, 5, 7, 2, '2022-12-12 15:00:00'),
(9, 9, 10, 3, '2022-12-12 20:00:00'),
(10, 10, 3, 9, '2022-12-13 17:00:00');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cirugia_expandida`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `cirugia_expandida` (
`Paciente` varchar(92)
,`Doctor` varchar(92)
,`Sala` varchar(50)
,`Fecha de Inicio` datetime
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id_cuenta` tinyint(4) NOT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `contra` varbinary(32) DEFAULT NULL,
  `privilegios` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id_cuenta`, `usuario`, `contra`, `privilegios`) VALUES
(1, 'admin', 0xc5626d0980e8a8cb3b0178009051fced62c2c5305f18b707d770a6c4618f0a61, NULL),
(2, 'DrLuis', 0xfd20bfc6339b7b1232710e7baccd0a90, NULL),
(3, 'DrEmmanuel', 0xd81f1074c97d78d2cb5587103c966cde, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `id_doctor` smallint(6) NOT NULL,
  `id_especialidad` tinyint(4) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `apep` varchar(30) NOT NULL,
  `apem` varchar(30) DEFAULT NULL,
  `sexo` char(1) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `fechana` date NOT NULL,
  `celular` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `doctor`
--

INSERT INTO `doctor` (`id_doctor`, `id_especialidad`, `nombre`, `apep`, `apem`, `sexo`, `domicilio`, `fechana`, `celular`) VALUES
(1, 3, 'Abel', 'Ponce', 'Gonzalez', 'M', 'De los suspiros 7', '1999-12-12', 3321231245),
(2, 7, 'Alicia', 'De la torre', 'Guerrero', 'F', 'Av.Norte Mza.35', '2000-05-20', 3365738290),
(3, 6, 'Alma', 'Neri', 'Delgado', 'F', 'Oaxaca Nte 46', '1980-10-26', 3385345629),
(4, 9, 'Apolonio', 'Ahumada', 'Gonzalez', 'M', 'Periferico Paseo de la republica 1049', '1990-01-29', 3363897621),
(5, 2, 'Blanca', 'Aguilar', 'Montes', 'F', 'Seccion platanal 3432', '1988-08-07', 3350183421),
(6, 1, 'Alberto', 'Ramirez', 'Martinez', 'M', 'San pedritos 2211', '1969-01-04', 3319562857),
(7, 8, 'Gustavo', 'Ines', 'Aray', 'M', 'Villa del carbon 1232', '1960-04-14', 3313634401),
(8, 11, 'Diana', 'Terrazas', 'Lopez', 'F', 'Av Universidad 707', '1986-08-19', 3393921234),
(9, 12, 'Aldo', 'Lopez', 'Perez', 'M', 'Av Olinca 3431', '1973-10-06', 3343128588),
(10, 4, 'Mario', 'Luevanos', 'Castelao', 'M', 'Av Taxquena 1355', '1990-05-15', 3321772344);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` tinyint(4) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_especialidad`, `nombre`) VALUES
(1, 'Anestesiologia'),
(2, 'Ginecologia'),
(3, 'Otorrinolaringologia'),
(4, 'Cardiologia'),
(5, 'Neurocirugia'),
(6, 'Gastroenterologia'),
(7, 'Urologia'),
(8, 'Pediatria'),
(9, 'Cirujano general'),
(10, 'Medicina laboral'),
(11, 'Oftalmologia'),
(12, 'Dermatologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `id_medicamento` smallint(6) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`id_medicamento`, `nombre`) VALUES
(1, 'Simvastatina'),
(2, 'Aspirina'),
(3, 'Omeprazol'),
(4, 'Lexotiroxina sodica'),
(5, 'Ramipril'),
(6, 'Amlodipina'),
(7, 'Paracetamol'),
(8, 'Atorvastatina'),
(9, 'Salbutamol'),
(10, 'Lansoprazol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `fechana` date NOT NULL,
  `celular` bigint(20) DEFAULT NULL,
  `domicilio` varchar(50) DEFAULT NULL,
  `sexo` char(1) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apep` varchar(30) NOT NULL,
  `apem` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `fechana`, `celular`, `domicilio`, `sexo`, `nombre`, `apep`, `apem`) VALUES
(1, '2004-09-25', 3337238551, 'Tauro 3974', 'M', 'Daniel', 'Jimenez', 'Sanchez'),
(2, '1975-09-12', 3344212213, 'Alberto balderas 107', 'M', 'Erik', 'Nazario', 'Hernandez'),
(3, '1999-01-23', 3312818823, 'Carlos Avila 4672', 'M', 'Santiago', 'Rojas', 'Torres'),
(4, '1984-04-09', 4320893357, 'Largo Emiliano Sandoval', 'M', 'Francisco', 'Lopez', 'Juarez'),
(5, '2009-03-23', 2145627693, 'Av Christopher 293', 'M', 'Enrique', 'Jimenez', 'Castillo'),
(6, '2000-01-03', 5555811966, 'San Mateo 75', 'F', 'Leticia', 'Martinez', 'Gomez'),
(7, '1940-05-12', 1496567053, 'Av Balestero 7', 'F', 'Aitana', 'Herrera', 'Garcia'),
(8, '2003-12-25', 3398002124, 'Justo Sierra 2499', 'F', 'Mariana', 'Hernandez', 'Fernandez'),
(9, '1977-10-12', 6432169877, 'Alfonso Reyes 2020', 'F', 'Elizabeth', 'Alvarez', 'Salazar'),
(10, '2004-02-12', 3321239909, 'Emiliano Zapata 914', 'F', 'Isabella', 'Juarez', 'Castillo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` bigint(20) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_medicamento` smallint(6) DEFAULT NULL,
  `dosis` float(5,2) DEFAULT NULL,
  `fechaini` date NOT NULL,
  `fechafin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `id_paciente`, `id_medicamento`, `dosis`, `fechaini`, `fechafin`) VALUES
(1, 3, 8, 120.00, '2022-04-12', '2022-04-15'),
(2, 6, 5, 80.00, '2020-02-20', '2020-04-23'),
(3, 2, 2, 50.00, '2021-04-01', '2021-04-04'),
(4, 9, 10, 2.50, '2022-09-30', '2022-10-30'),
(5, 4, 1, 5.00, '2019-12-01', '2021-01-01'),
(6, 5, 2, 20.00, '2022-02-02', '2022-09-20'),
(7, 1, 4, 12.50, '2022-06-12', '2022-12-12'),
(8, 7, 8, 15.00, '2022-02-10', '2022-10-21'),
(9, 8, 7, 160.00, '2020-02-10', '2020-02-12'),
(10, 10, 4, 2.50, '2019-02-10', '2022-12-25');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `receta_paciente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `receta_paciente` (
`Medicamento` varchar(60)
,`Dosis` float(5,2)
,`Paciente` varchar(92)
,`Fecha de Inicio` date
,`Fecha de Fin` date
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `id_sala` tinyint(4) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id_sala`, `NOMBRE`) VALUES
(1, 'Cirugia general y digestiva'),
(2, 'Cirugia ortopedica y traumatologia'),
(3, 'Sala de dermatologia'),
(4, 'Sala de ginecologia y obstetricia'),
(5, 'Sala de oftalmologia'),
(6, 'Sala de otorrinolaringologia'),
(7, 'Sala de urologia'),
(8, 'Sala de Pediatria'),
(9, 'Sala de pre anestesia'),
(10, 'Sala de gastroenterologia');

-- --------------------------------------------------------

--
-- Estructura para la vista `cirugia_expandida`
--
DROP TABLE IF EXISTS `cirugia_expandida`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cirugia_expandida`  AS SELECT concat(`paciente`.`nombre`,' ',`paciente`.`apep`,' ',`paciente`.`apem`) AS `Paciente`, concat(`doctor`.`nombre`,' ',`doctor`.`apep`,' ',`doctor`.`apem`) AS `Doctor`, `sala`.`NOMBRE` AS `Sala`, `cirugia`.`fechaini` AS `Fecha de Inicio` FROM (`cirugia` join ((`paciente` join `sala`) join `doctor`) on(`cirugia`.`id_paciente` = `paciente`.`id_paciente` and `cirugia`.`id_sala` = `sala`.`id_sala` and `cirugia`.`id_doctor` = `doctor`.`id_doctor`)) ORDER BY `cirugia`.`fechaini` ASC  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `receta_paciente`
--
DROP TABLE IF EXISTS `receta_paciente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `receta_paciente`  AS SELECT `medicamento`.`nombre` AS `Medicamento`, `receta`.`dosis` AS `Dosis`, concat(`paciente`.`nombre`,' ',`paciente`.`apep`,' ',`paciente`.`apem`) AS `Paciente`, `receta`.`fechaini` AS `Fecha de Inicio`, `receta`.`fechafin` AS `Fecha de Fin` FROM (`receta` join (`medicamento` join `paciente`) on(`receta`.`id_paciente` = `paciente`.`id_paciente` and `receta`.`id_medicamento` = `medicamento`.`id_medicamento`)) ORDER BY `medicamento`.`nombre` ASC  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cirugia`
--
ALTER TABLE `cirugia`
  ADD PRIMARY KEY (`id_cirugia`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_sala` (`id_sala`),
  ADD KEY `id_doctor` (`id_doctor`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id_cuenta`);

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
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`id_medicamento`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medicamento` (`id_medicamento`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id_sala`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id_cuenta` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cirugia`
--
ALTER TABLE `cirugia`
  ADD CONSTRAINT `cirugia_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cirugia_ibfk_2` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id_sala`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cirugia_ibfk_3` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`);

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `receta_ibfk_2` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamento` (`id_medicamento`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
