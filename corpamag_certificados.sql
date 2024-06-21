-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2024 a las 21:10:52
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
-- Base de datos: `corpamag_certificados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos`
--

CREATE TABLE `codigos` (
  `id` int(11) NOT NULL,
  `denominacion_id` int(11) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `codigos`
--

INSERT INTO `codigos` (`id`, `denominacion_id`, `codigo`, `estado`) VALUES
(1, 1, 'Seleccione código empleo', 1),
(2, 2, 'Seleccione código empleo', 1),
(3, 2, '015', 1),
(4, 2, 'Sin código', 1),
(5, 3, 'Seleccione código empleo', 1),
(6, 3, '040', 1),
(7, 3, 'Sin código', 1),
(8, 4, 'Seleccione código empleo', 1),
(9, 4, '0037', 1),
(10, 4, 'Sin código', 1),
(11, 5, 'Seleccione código empleo', 1),
(12, 5, '0137', 1),
(13, 5, 'Sin código', 1),
(14, 6, 'Seleccione código empleo', 1),
(15, 6, '1020', 1),
(16, 6, 'Sin código', 1),
(17, 7, 'Seleccione código empleo', 1),
(18, 7, '2028', 1),
(19, 7, 'Sin código', 1),
(20, 8, 'Seleccione código empleo', 1),
(21, 8, '2044', 1),
(22, 8, 'Sin código', 1),
(23, 9, 'Seleccione código empleo', 1),
(24, 9, '3100', 1),
(25, 9, 'Sin código', 1),
(26, 10, 'Seleccione código empleo', 0),
(27, 10, '3124', 0),
(28, 10, 'Sin código', 0),
(29, 11, 'Seleccione código empleo', 0),
(30, 11, '4210', 0),
(31, 11, 'Sin código', 0),
(32, 12, 'Seleccione código empleo', 0),
(33, 12, '4044', 0),
(34, 12, 'Sin código', 0),
(35, 13, 'Seleccione código empleo', 0),
(36, 13, '4103', 0),
(37, 13, 'Sin código', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denominaciones`
--

CREATE TABLE `denominaciones` (
  `nombre` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `denominaciones`
--

INSERT INTO `denominaciones` (`nombre`, `id`, `estado`) VALUES
('Seleccione denominación empleo', 1, 1),
('Director general', 2, 1),
('Subdirector general', 3, 1),
('Secretario general', 4, 1),
('Jefe de oficina', 5, 1),
('Asesor', 6, 1),
('Profesional especializado', 7, 1),
('Profesional universitario', 8, 1),
('Técnico', 9, 1),
('Técnico administrativo', 10, 1),
('Secretario ejecutivo', 11, 1),
('Auxiliar administrativo', 12, 1),
('Conductor mecánico', 13, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`id`, `nombre`, `estado`) VALUES
(1, 'Oficina jurídica', 1),
(2, 'Oficina de planeación', 1),
(3, 'Oficina de control interno', 1),
(4, 'Oficina de contratación', 1),
(5, 'Oficina de comunicaciones', 1),
(6, 'Subdirección de Gestión Ambiental:', 1),
(7, 'Subdirección de Educación Ambiental y Participació', 1),
(8, 'Laboratorio Ambiental', 1),
(9, 'Subdirección Técnica', 1),
(10, 'Secretaría General', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id` int(11) NOT NULL,
  `codigo_id` int(11) DEFAULT NULL,
  `grado` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id`, `codigo_id`, `grado`, `estado`) VALUES
(1, 1, 'Seleccione grado empleo', 1),
(2, 2, 'Seleccione grado empleo', 1),
(3, 2, 'Sin grado', 1),
(4, 3, 'Seleccione grado empleo', 1),
(5, 3, '24', 1),
(6, 3, 'Sin grado', 1),
(7, 4, 'Seleccione grado empleo', 1),
(8, 4, 'Sin grado ', 1),
(9, 5, 'Seleccione grado empleo', 1),
(10, 6, 'Seleccione grado empleo', 1),
(11, 6, '17', 1),
(12, 6, 'Sin grado', 1),
(13, 7, 'Seleccione grado empleo', 1),
(14, 7, 'Sin grado', 1),
(15, 8, 'Seleccione grado empleo', 1),
(16, 8, 'Sin grado', 1),
(17, 9, 'Seleccione grado empleo', 1),
(18, 9, '17', 1),
(19, 9, 'Sin grado', 1),
(20, 10, 'Seleccione grado empleo', 1),
(21, 10, 'Sin grado', 1),
(22, 11, 'Seleccione grado empleo', 1),
(23, 11, 'Sin grado', 1),
(24, 12, 'Seleccione grado empleo', 1),
(25, 12, '15', 1),
(26, 12, '10', 1),
(27, 12, 'Sin grado', 1),
(28, 13, 'Seleccione grado empleo', 1),
(29, 13, 'Sin grado', 1),
(30, 14, 'Seleccione grado empleo', 1),
(31, 14, 'Sin grado', 1),
(32, 15, 'Seleccione grado empleo', 1),
(33, 15, '7', 1),
(34, 15, 'Sin grado', 1),
(35, 16, 'Seleccione grado empleo', 1),
(36, 16, 'Sin grado', 1),
(37, 17, 'Seleccione grado empleo', 1),
(38, 17, 'Sin grado', 1),
(39, 18, 'Seleccione grado empleo', 1),
(40, 18, '19', 1),
(41, 18, '18', 1),
(42, 18, '17', 1),
(43, 18, '16', 1),
(44, 18, '15', 1),
(45, 18, '14', 1),
(46, 18, '13', 1),
(47, 18, '12', 1),
(48, 18, 'Sin grado', 1),
(49, 19, 'Seleccione grado empleo', 1),
(50, 19, 'Sin grado', 1),
(51, 20, 'Seleccione grado empleo', 1),
(52, 20, 'Sin grado', 1),
(53, 21, 'Seleccione grado empleo', 1),
(54, 21, '11', 1),
(55, 21, '10', 1),
(56, 21, '9', 1),
(57, 21, '8', 1),
(58, 21, '7', 1),
(59, 21, '6', 1),
(60, 21, '5', 1),
(61, 21, '4', 1),
(62, 21, 'Sin grado', 1),
(63, 22, 'Seleccione grado empleo', 1),
(64, 22, 'Sin grado', 1),
(65, 23, 'Seleccione grado empleo', 1),
(66, 23, 'Sin grado', 1),
(67, 24, 'Seleccione grado empleo', 1),
(68, 24, '18', 1),
(69, 24, '17', 1),
(70, 24, '16', 1),
(71, 24, '15', 1),
(72, 24, '14', 1),
(73, 24, '13', 1),
(74, 24, '12', 1),
(75, 24, '11', 1),
(76, 24, '10', 1),
(77, 24, 'Sin grado', 1),
(78, 25, 'Seleccione grado empleo', 1),
(79, 25, '', 1),
(80, 26, 'Seleccione grado empleo', 1),
(81, 26, 'Sin grado', 1),
(82, 27, 'Seleccione grado empleo', 1),
(83, 27, '14', 1),
(84, 27, 'Sin grado', 1),
(85, 28, 'Seleccione grado empleo', 1),
(86, 28, 'Sin grado', 1),
(87, 29, 'Seleccione grado empleo', 1),
(88, 29, 'Sin grado', 1),
(89, 30, 'Seleccione grado empleo', 1),
(90, 30, '24', 1),
(91, 30, '22', 1),
(92, 30, '21', 1),
(93, 30, 'Sin grado', 1),
(94, 31, 'Seleccione grado empleo', 1),
(95, 31, 'Sin grado', 1),
(96, 32, 'Seleccione grado empleo', 1),
(97, 32, 'Sin grado', 1),
(98, 33, 'Seleccione grado empleo', 1),
(99, 33, '24', 1),
(100, 33, '21', 1),
(101, 33, 'Sin grado', 1),
(102, 34, 'Seleccione grado empleo', 1),
(103, 34, 'Sin grado', 1),
(104, 35, 'Seleccione grado empleo', 1),
(105, 35, 'Sin grado', 1),
(106, 36, 'Seleccione grado empleo', 1),
(107, 36, '21', 1),
(108, 36, '20', 1),
(109, 36, '19', 1),
(110, 36, 'Sin grado', 1),
(111, 37, 'Seleccione grado empleo', 1),
(112, 37, 'Sin grado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombramiento`
--

CREATE TABLE `nombramiento` (
  `id` int(11) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nombramiento`
--

INSERT INTO `nombramiento` (`id`, `tipo`, `estado`) VALUES
(1, 'Libre nombramiento', 1),
(2, 'Carrera administrativa', 1),
(3, 'Nombramiento provisional', 1),
(4, 'Libre nombramiento en gerencia publica', 1),
(5, 'Periodo fijo', 1),
(6, 'Libre nombramiento y Remoción', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `genero` varchar(15) NOT NULL,
  `primer_nombre` varchar(20) NOT NULL,
  `segundo_nombre` varchar(20) DEFAULT NULL,
  `primer_apellido` varchar(20) NOT NULL,
  `segundo_apellido` varchar(20) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `dia_vinculacion` int(2) NOT NULL,
  `mes_vinculacion` varchar(15) NOT NULL,
  `año_vinculacion` int(4) NOT NULL,
  `cargo` varchar(60) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `grado` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `salario` int(12) NOT NULL,
  `coordinacion` tinyint(1) NOT NULL,
  `primas_tecnicas` tinyint(1) NOT NULL,
  `PTS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`genero`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `cedula`, `dia_vinculacion`, `mes_vinculacion`, `año_vinculacion`, `cargo`, `codigo`, `grado`, `estado`, `salario`, `coordinacion`, `primas_tecnicas`, `PTS`) VALUES
('femenino', 'Julieth', 'Andrea', 'Prieto', 'Rodriguez', '1010169128', 11, 'marzo ', 2013, 'Profesional Especializado', '2028', '16', 1, 6587097, 0, 0, 0),
('femenino', 'Lina', 'Paola', 'Herrera', 'Mora', '1016034049', 8, 'octubre', 2018, 'Profesional Universitario ', '2044', '10', 1, 4310846, 0, 0, 0),
('femenino', 'Diana', 'Marcela', 'Bonilla', 'Avendaño', '1032373618', 3, 'octubre', 2022, 'Profesional Universitario', '2044', '10', 1, 4310846, 0, 0, 0),
('masculino', 'Juan', 'David', 'Posada', 'Rodriguez', '1037603892', 2, 'diciembre ', 2022, 'Profesional Especializado', '2028', '12', 1, 4766134, 0, 0, 0),
('femenino', 'Juliana', '', 'Contretas', 'Velencia', '1050962891', 19, 'abril', 2023, 'Tecnico ', '3100', '12', 1, 2724337, 0, 0, 0),
('femenino', 'Shirley', 'Carolina', 'Davila', 'Ramos', '1052980757', 11, 'agosto ', 2023, 'Tecnico ', '3100', '12', 1, 2724337, 0, 0, 0),
('femenino', 'Elis', 'Tatiana', 'Nieves', 'Avila', '1065576854', 10, 'octubre', 2022, 'Tecnico Administrativo ', '3100', '17', 1, 3806786, 0, 0, 0),
('masculino', 'Julian', 'Armando', 'Pernett', 'Ceballos', '1065617415', 1, 'agosto ', 2023, 'Profesional Especializado', '2028', '16', 1, 6587097, 0, 0, 0),
('masculino', 'Esneider', 'Alfredo', 'Pallares', 'Miranda', '1065663005', 8, 'octubre', 2018, 'Profesional Especializado', '2028', '13', 1, 5163904, 1, 0, 0),
('femenino', 'Joelis', 'Andrea', 'Acuña', 'Bon', '1065899673', 1, 'agosto ', 2023, 'Profesional Especializado', '2028', '13', 1, 5163904, 0, 0, 0),
('femenino', 'Carime', 'DelCarmen', 'Arroyo', 'Sarmiento', '1066744066', 21, 'enero', 2022, 'Tecnico ', '3100', '18', 1, 4183337, 0, 0, 0),
('femenino', 'Andreina', 'deJesus', 'Villa', 'DelaCruz', '1079932555', 16, 'diciembre ', 2022, 'Tecnico Administrativo ', '3124', '14', 1, 3011402, 0, 0, 0),
('femenino', 'Cindy', 'Tatiana', 'Caballero', 'Cantillo', '1081787788', 4, 'diciembre ', 2020, 'Secretario Ejecutivo ', '4210', '21', 1, 2685993, 0, 0, 0),
('masculino', 'Jorge', 'Andres', 'Torregroza', 'Sanchez', '1082842201', 8, 'octubre', 2018, 'Profesional Especializado', '2028', '18', 1, 7461595, 0, 0, 0),
('femenino', 'Maria', 'Cecilia', 'Serrano', 'Fuentes', '1082851669', 8, 'octubre', 2018, 'Profesional Especializado', '2028', '13', 1, 5163904, 0, 0, 0),
('femenino', 'Karen', 'Giselle', 'Bozon', 'Espinosa', '1082852922', 4, 'junio', 2019, 'Profesional Especializado', '2028', '14', 1, 5526100, 0, 0, 0),
('femenino', 'Stepany', 'Vanessa', 'Zuñiga', 'Padilla', '1082861226', 1, 'octubre', 2018, 'Profesional Especializado', '2028', '18', 1, 7461595, 0, 0, 0),
('femenino', 'Andrea', 'Carolina', 'Rodriguez', 'Loaiza', '1082862300', 8, 'julio', 2020, 'Profesional Especializado', '2028', '12', 1, 4766134, 0, 0, 0),
('masculino', 'Elder', 'Orlando', 'Delima', 'Rosado', '1082869300', 10, 'febrero', 2015, 'Profesional Universitario ', '2044', '5', 1, 3505614, 1, 0, 0),
('femenino', 'Esly', 'Catalina', 'Deltoro', 'Marin', '1082873049', 1, 'abril', 2013, 'Profesional Universitario ', '2044', '05', 1, 3505614, 0, 0, 0),
('masculino', 'Juan', 'Pablo', 'Abello', 'Orjuela', '1082874114', 21, 'noviembre ', 2022, 'Tecnico ', '3100', '12', 1, 2724337, 0, 0, 0),
('femenino', 'Angelica', 'Patricia', 'Garrido', 'Galindo', '1082880081', 5, 'septiembre', 2022, 'Profesional Especializado', '2028', '12', 1, 4766134, 0, 0, 0),
('masculino', 'Jorge', 'Luis', 'Pabon', 'Pertuz', '1082880562', 24, 'julio', 2017, 'Profesional Especializado', '2028', '14', 1, 5526100, 0, 0, 0),
('femenino', 'Kerby', 'Alejandra', 'Jordi', 'Gutierrez', '1082889211', 8, 'octubre', 2018, 'Profesional Especializado', '2028', '14', 1, 5526100, 0, 0, 0),
('femenino', 'Hilka', 'Sayuris', 'Camargo', 'Escorcia', '1082889215', 10, 'febrero', 2015, 'Profesional Especializado', '2028', '12', 1, 4766134, 0, 0, 0),
('femenino', 'Natalia', 'Margarita', 'Pardo', 'Fernandez', '1082898041', 5, 'septiembre', 2022, 'Tecnico', '3100', '13', 1, 2905284, 0, 0, 0),
('femenino', 'Melissa', 'Paola', 'Camargo', 'Yacomelo', '1082906100', 15, 'noviembre ', 2022, 'Profesional Especializado', '2028', '13', 1, 5163904, 1, 0, 0),
('femenino', 'Clarybeth', 'Sofia', 'Hernandez', 'Somerson', '1082907798', 17, 'enero', 2019, 'Profesional Especializado', '2028', '13', 1, 5163904, 0, 0, 0),
('femenino', 'Sibil', 'Isabel', 'Rudas', 'Gonzalez', '1082915144', 16, 'marzo ', 2023, 'Profesional Universitario ', '2044', '10', 1, 4310846, 0, 0, 0),
('femenino', 'Alejandra', 'Patricia', 'Carrascal', 'Franco', '1082927301', 19, 'diciembre ', 2022, 'Profesional Universitario ', '2044', '05', 1, 3505614, 0, 0, 0),
('femenino', 'Dayana', 'Patricia', 'Valero', 'Ospino', '1082934288', 1, 'septiembre', 2023, 'Profesional Universitario ', '2044', '08', 1, 3996570, 0, 0, 0),
('masculino', 'Freddy', 'Rafael', 'Benavides', 'Ramos', '1082986989', 21, 'noviembre ', 2022, 'Profesional Universitario ', '2044', '10', 1, 4310846, 0, 0, 0),
('femenino', 'Maria', 'Lizeth', 'Estrada', 'Ospino', '1085101040', 1, 'noviembre ', 2018, 'Profesional Especializado', '2028', '12', 1, 4766134, 0, 0, 0),
('femenino', 'Jatna', 'Alejandra', 'Vanegas', 'Chinchilla', '1096792397', 16, 'octubre', 2018, 'Profesional Universitario ', '2044', '10', 1, 4310846, 0, 0, 0),
('femenino', 'Fanyyanys', 'Lina', 'Delahoz', 'Vera', '1102809557', 21, 'julio', 2020, 'Auxiliar Administrativo ', '4044', '21', 1, 2685993, 0, 0, 0),
('femenino', 'Katty', 'Paola', 'Amaya', 'Brieva', '1102851114', 5, 'septiembre', 2022, 'Profesional Especializado', '2028', '16', 1, 6587097, 0, 0, 0),
('femenino', 'Angelica', 'Maria', 'Rodriguez', 'Orduz', '1120739330', 10, 'marzo ', 2023, 'Subdirector ', '0040', '17', 1, 9430880, 0, 1, 0),
('masculino', 'Nelson', '', 'Martinez', 'Gutierrez', '11221471', 24, 'noviembre ', 2003, 'Profesional Especializado', '2028', '16', 1, 6587097, 0, 0, 0),
('femenino', 'Zuly', 'Esther', 'Muñoz', 'DelaHoz', '1128126073', 14, 'agosto ', 2017, 'Secretario Ejecutivo ', '4210', '24', 1, 3432781, 0, 0, 0),
('femenino', 'Juliana', '', 'DiazGranados', 'Vives', '1136886616', 9, 'septiembre', 2022, 'Asesor ', '1020', '07', 1, 7858372, 0, 0, 0),
('masculino', 'Paul', 'David', 'Montenegro', 'Badillo', '1143258311', 1, 'agosto ', 2023, 'Tecnico', '3100', '12', 1, 2724337, 0, 0, 0),
('masculino', 'Mario', 'Andres', 'Garnica', 'Sarmiento', '1152683549', 20, 'febrero', 2024, 'Tecnico ', '3100', '12', 1, 2724337, 0, 0, 0),
('masculino', 'Hernan', '', 'Parodi', 'Arias', '12533016', 27, 'diciembre ', 1993, 'Profesional Especializado', '2028', '17', 1, 6928453, 0, 0, 0),
('masculino', 'David', 'Antonio', 'Morales', 'Grau', '12539024', 1, 'septiembre', 1994, 'Profesional Especializado', '2028', '15', 1, 6109678, 0, 0, 0),
('masculino', 'William', 'Manuel', 'Montes', 'Marquez', '12542715', 10, 'febrero', 2015, 'Tecnico', '3100', '14', 1, 3011402, 0, 0, 0),
('masculino', 'Jorge', 'Eliecer', 'Morales', 'Ponson', '12543973', 5, 'noviembre ', 1992, 'Profesional Especializado', '2028', '13', 1, 5163904, 0, 0, 0),
('masculino', 'Jairo', 'Daniel', 'Cuetto', 'Moreno', '12545932', 11, 'marzo ', 1994, 'Tecnico Administrativo ', '3100', '18', 1, 4183337, 0, 0, 0),
('masculino', 'Richard', '', 'Garcia', 'Maestre', '12549421', 19, 'enero', 1993, 'Tecnico Operativo ', '3100', '18', 1, 4183337, 0, 0, 0),
('masculino', 'Alfredo', 'Rafael', 'Martinez', 'Gutierrez', '12556160', 17, 'noviembre ', 1992, 'Director general ', '0015', '24', 1, 16079145, 0, 1, 0),
('masculino', 'Eliecer', 'Manuel', 'Henriquez', 'Cataño', '12561793', 18, 'septiembre', 2020, 'Conductor Mecanico ', '4103', '19', 1, 2499848, 0, 0, 0),
('masculino', 'Neyer', 'Manuel', 'Valencia', 'Saltaren', '17953222', 1, 'febrero', 2008, 'Tecnico', '3100', '12', 1, 2724337, 0, 0, 0),
('femenino', 'Eliana', 'Patricia', 'Toro', 'Alvarez', '26670823', 24, 'diciembre ', 2022, 'Asesor ', '1020', '07', 1, 6588038, 0, 0, 0),
('femenino', 'Sugey', 'Tatiana', 'Pantoja', 'Simanca', '26670916', 14, 'noviembre ', 2017, 'Profesional Especializado', '2028', '14', 1, 5526100, 1, 0, 0),
('femenino', 'Lina', 'Margarita', 'Escobar', 'Winston', '26671630', 29, 'octubre', 2007, 'Profesional Especializado', '2028', '17', 1, 6928453, 1, 0, 0),
('femenino', 'Aracellis', 'Ana', 'Pertuz', 'Cantillo', '26883791', 4, 'marzo ', 2024, 'Auxiliar Administrativo ', '4044', '24', 1, 3432781, 0, 0, 0),
('femenino', 'Yainis', 'Maolis', 'Barahona', 'Castillo', '26946398', 18, 'septiembre', 2018, 'Profesional Especializado', '2028', '12', 1, 4766134, 1, 0, 0),
('femenino', 'Yesenia', 'Patricia', 'Frutos', 'Anaya', '32785078', 1, 'marzo ', 2011, 'Tecnico ', '3100', '16', 1, 3556004, 0, 0, 0),
('femenino', 'Diana', 'Karina', 'Martinez', 'Vergara', '32892431', 1, 'agosto ', 2018, 'Asesor ', '1020', '07', 1, 6588038, 0, 1, 1),
('femenino', 'Shindy', 'delCarmen', 'Fernandez', 'Ramirez', '33309979', 1, 'abril', 2007, 'Profesional Especializado', '2028', '12', 1, 4766134, 1, 0, 0),
('femenino', 'Luz', 'Hicela', 'Mosquera', 'Mosquera', '35602652', 5, 'enero', 2024, 'Jefe de oficina ', '0137', '15', 1, 8819983, 0, 1, 1),
('femenino', 'Maria', 'Inmaculada', 'Danies', 'Silva', '36551277', 9, 'diciembre ', 1996, 'Profesional Especializado', '2028', '17', 1, 6928453, 1, 0, 0),
('femenino', 'Maria', 'Victoria', 'Corzo', '', '36553665', 30, 'abril', 1998, 'Tecnico ', '3100', '17', 1, 3806786, 0, 0, 0),
('femenino', 'Maria', 'delCarmen', 'Cotes', 'Roa', '36563870', 3, 'enero', 2023, 'Secretario Ejecutivo ', '4210', '21', 1, 2685993, 0, 0, 0),
('femenino', 'Liliana', 'Margarita', 'Hidalgo', 'Garcia', '36564699', 5, 'noviembre ', 1992, 'Jefe de oficina ', '137', '15', 1, 8819983, 0, 1, 1),
('femenino', 'Sara', 'Victoria', 'DiazGranados', 'Cuenca', '36665480', 3, 'enero', 2023, 'Profesional Universitario ', '2044', '11', 1, 4492340, 0, 0, 0),
('femenino', 'Evangelina', '', 'Duran', 'Nuñez', '36666861', 10, 'marzo ', 2023, 'Profesional Universitario ', '2044', '05', 1, 3505614, 0, 0, 0),
('femenino', 'Angelina', 'delCarmen', 'Garcia', 'Aycardi', '36696832', 7, 'octubre', 2014, 'Jefe de oficina ', '0137', '10', 1, 7501641, 0, 1, 1),
('femenino', 'Cecilia', 'Mercedes', 'Vives', 'Campo', '36719298', 22, 'junio', 2015, 'Profesional Universitario ', '2044', '10', 1, 4310846, 0, 0, 0),
('femenino', 'Monica', 'Alejandra', 'Toro', 'Alvarez', '36719502', 1, 'octubre', 2014, 'Profesional Especializado', '2028', '12', 1, 4766134, 1, 0, 0),
('femenino', 'Carol', 'Patricia', 'Marquez', 'Tapias', '36719818', 23, 'enero', 2014, 'Jefe de oficina ', '0137', '15', 1, 8819983, 0, 1, 1),
('femenino', 'Semiramis', 'delCarmen', 'Sosa', 'Tapias', '36720447', 1, 'septiembre', 2009, 'Subdirector ', '0040', '17', 1, 9430880, 0, 1, 1),
('femenino', 'Katia', 'Karina', 'Osorio', 'Hernandez', '36723506', 19, 'octubre', 2009, 'Profesional Especializado', '2028', '13', 1, 5163904, 0, 0, 0),
('femenino', 'Jenifer', '', 'Abello', 'Orjuela', '36724195', 11, 'abril', 2007, 'Tecnico Administrativo ', '3100', '18', 1, 4183337, 0, 0, 0),
('masculino', 'Wiber', 'Miguel', 'Fuentes', 'Valdes', '3800250', 8, 'octubre', 2018, 'Profesional Especializado', '2028', '14', 1, 5526100, 0, 0, 0),
('femenino', 'Natalia', '', 'Carretero', 'Chedraui', '39024573', 23, 'enero', 2014, 'Profesional Especializado', '2028', '19', 1, 8026091, 0, 0, 0),
('femenino', 'Lilibeth', '', 'Tovar', 'Jimeno', '39048621', 4, 'octubre', 2018, 'Profesional Especializado', '2028', '18', 1, 7461595, 1, 0, 0),
('femenino', 'Eilyn', 'Carolina', 'Freile', 'Lopesierra', '39048718', 20, 'marzo ', 2007, 'Profesional Especializado', '2028', '13', 1, 5163904, 1, 0, 0),
('femenino', 'Ruth', 'Mery', 'Maldonado', 'Figueroa', '39532408', 1, 'diciembre ', 1995, 'Profesional Especializado', '2028', '12', 1, 4766134, 1, 0, 0),
('femenino', 'Ana', 'Cecilia', 'Vega', 'Gonzalez', '41740739', 8, 'marzo ', 1993, 'Profesional Especializado', '2028', '17', 1, 6928453, 0, 0, 0),
('femenino', 'Marlen', 'Cecilia', 'Medina', 'Teheran', '45581507', 14, 'enero', 2019, 'Profesional Especializado', '2028', '16', 1, 6587097, 0, 0, 0),
('masculino', 'Henry', 'Henry', 'Gomez', 'Jimenez', '5152833', 20, 'enero', 1993, 'Profesional Especializado', '2028', '12', 1, 4766134, 0, 0, 0),
('femenino', 'Zully', 'Vitalina', 'Ojeda', 'Bautista', '51954508', 1, 'septiembre', 2023, 'Profesional Especializado', '2028', '13', 1, 5163904, 0, 0, 0),
('femenino', 'Ayfa', 'Patricia', 'Pulido', 'Rondon', '51971284', 31, 'agosto ', 2022, 'Secretario Ejecutivo ', '4210', '22', 1, 2850336, 0, 0, 0),
('femenino', 'Maricruz', 'delCarmen', 'Ferrer', 'Fernandez', '52008531', 11, 'marzo ', 2013, 'Profesional Universitario ', '2044', '11', 1, 4492340, 1, 0, 0),
('femenino', 'Viviana', 'Andrea', 'Martinez', 'Quintero', '52805896', 2, 'abril', 2019, 'Secretario Ejecutivo ', '4210', '24', 1, 3432781, 0, 0, 0),
('femenino', 'Nancy', 'Carolina', 'Sanchez', 'Calle', '53006267', 24, 'enero', 2014, 'Profesional Especializado', '2028', '16', 1, 6587097, 1, 0, 0),
('femenino', 'Sandra', 'Milena', 'Guerra', 'Palmera', '55225032', 5, 'septiembre', 2022, 'Tecnico ', '3100', '14', 1, 3011402, 0, 0, 0),
('femenino', 'Ana', 'Mercedes', 'Mendinueta', 'Miranda', '57270651', 6, 'octubre', 2016, 'Profesional Universitario ', '2044', '05', 1, 3505614, 1, 0, 0),
('femenino', 'Lauryn', 'Liliana', 'Tapias', 'Villa', '57293818', 1, 'septiembre', 2020, 'Profesional Especializado', '2028', '12', 1, 4766134, 0, 0, 0),
('femenino', 'Claudia', 'Juliana', 'Ramirez', 'Alcazar', '57299522', 4, 'octubre', 2018, 'Tecnico', '3100', '16', 1, 3556004, 0, 0, 0),
('femenino', 'Zuleima', 'Esther', 'Colon', 'Martinez', '57405237', 2, 'agosto ', 2017, 'Tecnico ', '3100', '13', 1, 2905284, 0, 0, 0),
('femenino', 'Dolys', '', 'Rocha', 'Lucero', '57407471', 21, 'octubre', 1999, 'Profesional Universitario ', '2044', '09', 1, 4168604, 0, 0, 0),
('femenino', 'Neyla', 'Esther', 'Martinez', 'Orozco', '57428676', 4, 'noviembre ', 1992, 'Profesional Especializado', '2028', '14', 1, 5526100, 0, 0, 0),
('femenino', 'Omalys', 'Beatriz', 'King', 'Fernandez', '57435291', 5, 'noviembre ', 1992, 'Profesional Universitario', '2044', '9', 1, 4168604, 0, 0, 0),
('femenino', 'Rebeca', 'Alicia', 'Perez', 'Ramirez', '57438806', 9, 'abril', 2013, 'Tecnico ', '3100', '18', 1, 4183337, 0, 0, 0),
('femenino', 'Edilma', 'Beatriz', 'Tejeda', 'Guerra', '57440945', 9, 'enero', 2019, 'Profesional Especializado', '2028', '12', 1, 4766134, 0, 0, 0),
('femenino', 'Yolima', 'MariaAuxiliadora', 'Murillo', 'Pereira', '57441267', 18, 'agosto ', 2009, 'Profesional Especializado', '2028', '16', 1, 6587097, 0, 0, 0),
('femenino', 'Sindry', 'Katherine', 'Ortega', 'Cardenas', '57460516', 17, 'agosto ', 2017, 'Tecnico ', '3100', '13', 1, 2905284, 0, 0, 0),
('femenino', 'Paola', 'Yulied', 'Valencia', 'Acuña', '57464404', 28, 'septiembre', 2018, 'Profesional Universitario ', '2044', '09', 1, 4168604, 0, 0, 0),
('femenino', 'Genexy', 'Magaly', 'Troncoso', 'Castro', '68291795', 2, 'abril', 2007, 'Profesional Especializado', '2028', '18', 1, 7461595, 0, 0, 0),
('masculino', 'Carlos', 'Augusto', 'Santodomingo', 'Vega', '7143016', 19, 'abril', 2011, 'Profesional Especializado', '2028', '16', 1, 6587097, 1, 0, 0),
('masculino', 'Jorge', 'Alfonso', 'Hani', 'Cusse', '72180034', 20, 'diciembre ', 2014, 'Jefe de oficina ', '0137', '15', 1, 8819983, 0, 1, 1),
('masculino', 'Gustavo', '', 'Pertuz', 'Valdes', '72202972', 7, 'julio', 2003, 'Profesional Especializado', '2028', '17', 1, 6928453, 1, 0, 0),
('masculino', 'Carlos', 'Jose', 'Noguera', 'Mario', '72311695', 5, 'septiembre', 2022, 'Profesional Especializado', '2028', '13', 1, 5163904, 0, 0, 0),
('masculino', 'Richard', 'Antony', 'Tache', 'Yejas', '7601538', 21, 'noviembre ', 2005, 'Profesional Universitario ', '2044', '7', 1, 3807272, 1, 0, 0),
('masculino', 'Luis', 'Enrique', 'Sepulveda', 'Diaz', '7602847', 28, 'septiembre', 2018, 'Profesional Especializado', '2028', '15', 1, 6109678, 1, 0, 0),
('masculino', 'Eder', 'Enrique', 'Villalobos', 'Palma', '7633800', 23, 'enero', 2012, 'Tecnico', '3100', '15', 1, 3147287, 0, 0, 0),
('masculino', 'Alfe', 'Luis', 'Colpas', 'Aguilar', '77031932', 1, 'octubre', 2018, 'Profesional Universitario ', '2044', '9', 1, 4168604, 0, 0, 0),
('masculino', 'Esneider', 'Enrique', 'Correa', 'Perez', '77104514', 8, 'octubre', 2018, 'Profesional Universitario', '2044', '09', 1, 4168604, 0, 0, 0),
('masculino', 'Franklin', 'Adolfo', 'Moscote', 'Pereira', '84079330', 9, 'noviembre ', 2018, 'Profesional Universitario ', '2044', '8', 1, 3996570, 0, 0, 0),
('masculino', 'Paul', 'Gillermo', 'Laguna', 'Panetta', '84450538', 22, 'febrero', 2013, 'Secretario General ', '0037', '17', 1, 9430880, 0, 1, 1),
('masculino', 'Albeis', 'James', 'Fuentes', 'Pimienta', '84451162', 21, 'diciembre ', 2023, 'Jefe de la oficina jurdica ', '0137', '15', 1, 8819983, 0, 0, 0),
('masculino', 'Josue', 'Ignacio', 'Campo', 'Mendoza', '84459020', 24, 'junio', 2015, 'Profesional Especializado', '2028', '16', 1, 6587097, 0, 0, 0),
('masculino', 'Eduar', '', 'Larios', 'Medina', '85040550', 18, 'noviembre ', 2022, 'Tecnico ', '3100', '12', 1, 2049846, 0, 0, 0),
('masculino', 'Juan', 'Carlos', 'Aaron', 'Ordoñez', '85448870', 19, 'marzo ', 2002, 'Profesional Universitario ', '2044', '10', 1, 4310846, 1, 0, 0),
('masculino', 'Jose', 'Luis', 'Ortega', 'Palomino', '85460714', 2, 'febrero', 2015, 'Conductor Mecanico ', '4103', '20', 1, 2577517, 0, 0, 0),
('masculino', 'Adalberto', 'Rafael', 'Santodomingo', 'Rodriguez', '85462654', 2, 'noviembre ', 2023, 'Profesional Especializado', '2028', '12', 1, 4766134, 0, 0, 0),
('masculino', 'Demin', 'Jose', 'Pinto', 'Brito', '85469828', 7, 'octubre', 2014, 'Profesional Especializado', '2028', '14', 1, 5526100, 0, 0, 0),
('masculino', 'Francisco', 'Jairo', 'Sanchez', 'DelaHoz', '85472720', 24, 'julio', 2015, 'Profesional Especializado', '2028', '14', 1, 5526100, 0, 0, 0),
('masculino', 'Pedro', 'Jose', 'Barandica', 'Rodriguez', '85476162', 16, 'octubre', 2008, 'Conductor Mecanico ', '4103', '21', 1, 2685993, 0, 0, 0),
('masculino', 'Aurelio', '', 'Cruz', 'Pino', '8723262', 11, 'diciembre ', 2008, 'Profesional Universitario ', '2044', '6', 1, 3627684, 0, 0, 0),
('masculino', 'Juan', 'Pablo', 'Sanchez', 'Pardo', '88210875', 6, 'noviembre ', 2018, 'Profesional Especializado', '2028', '17', 1, 6928453, 1, 0, 0),
('masculino', 'Adalberto', '', 'Diaz', 'Julio', '9158759', 14, 'febrero', 2011, 'Tecnico ', '3100', '17', 1, 3806786, 0, 0, 0),
('masculino', 'Onil', 'Gregorio', 'Mendoza', 'Florez', '9272435', 4, 'octubre', 2018, 'Conductor Mecanico ', '4103', '20', 1, 2577517, 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `codigos`
--
ALTER TABLE `codigos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `denominacion_id` (`denominacion_id`) USING BTREE;

--
-- Indices de la tabla `denominaciones`
--
ALTER TABLE `denominaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_id` (`codigo_id`);

--
-- Indices de la tabla `nombramiento`
--
ALTER TABLE `nombramiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `codigos`
--
ALTER TABLE `codigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `denominaciones`
--
ALTER TABLE `denominaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT de la tabla `nombramiento`
--
ALTER TABLE `nombramiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `codigos`
--
ALTER TABLE `codigos`
  ADD CONSTRAINT `codigos_ibfk_1` FOREIGN KEY (`denominacion_id`) REFERENCES `denominaciones` (`id`);

--
-- Filtros para la tabla `grados`
--
ALTER TABLE `grados`
  ADD CONSTRAINT `grados_ibfk_1` FOREIGN KEY (`codigo_id`) REFERENCES `codigos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
