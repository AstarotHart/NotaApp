-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2017 a las 07:34:55
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `notaapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `id_sede` varchar(50) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `primer_apellido` varchar(45) DEFAULT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `desplazado` varchar(45) DEFAULT 'No',
  `repitente` varchar(45) DEFAULT 'No',
  `nombre_acudiente` varchar(45) DEFAULT NULL,
  `apellidos_acudiente` varchar(45) DEFAULT NULL,
  `telefono_acudiente` double DEFAULT NULL,
  `fecha_matricula` date DEFAULT NULL,
  `id_grupo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `id_sede`, `nombres`, `primer_apellido`, `segundo_apellido`, `desplazado`, `repitente`, `nombre_acudiente`, `apellidos_acudiente`, `telefono_acudiente`, `fecha_matricula`, `id_grupo`) VALUES
(159753, 'IE', 'Pepito', 'Perez', 'Pinto', 'No', 'No', 'Osama', 'pereza', 1234546, '2009-01-16', '2017IEIE11-1'),
(784545, 'IE', 'Carolina', 'Medina', 'Torres', 'No', 'No', 'Cristina', 'Torres', 456432, '1998-01-19', '2017IEIE11-1'),
(984561, 'JJR', 'Alberto', 'Alvarez', 'Ramirez', 'Si', 'No', 'Pepita', 'ramirez', 5456879, '2007-06-18', '2017JJRJJR10-2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anio_lectivo`
--

CREATE TABLE `anio_lectivo` (
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `id_sede` varchar(50) DEFAULT NULL,
  `descripcion_anio_lectivo` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anio_lectivo`
--

INSERT INTO `anio_lectivo` (`id_anio_lectivo`, `id_sede`, `descripcion_anio_lectivo`, `fecha_inicio`, `fecha_fin`) VALUES
('2017IE', 'IE', 'AÃ±o Lectivo 2017', '2017-01-09', '2017-12-15'),
('2017JJR', 'JJR', 'AÃ±o lectivo 2017', '2017-01-09', '2017-12-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` varchar(50) NOT NULL,
  `id_sede` varchar(50) DEFAULT NULL,
  `nombre_area` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `id_sede`, `nombre_area`) VALUES
('2017IEIEMyG', 'IE', 'MatemÃ¡ticas y GeometrÃ­a'),
('2017IEJJRMyG', 'JJR', 'MatemÃ¡ticas y GeometrÃ­a'),
('2017IEMSH', 'MS', 'Humanidades');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id_asignatura` varchar(50) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_area` varchar(50) DEFAULT NULL,
  `nombre_asignatura` varchar(45) DEFAULT NULL,
  `intensidad_horaria` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asignatura`, `id_docente`, `id_area`, `nombre_asignatura`, `intensidad_horaria`) VALUES
('2017IEIEMyG-M', 123456, '2017IEIEMyG', 'MatemÃ¡ticas', 0),
('2017IEJJRMyG-G', 8454897, '2017IEJJRMyG', 'GeometrÃ­a', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_alumno` int(11) NOT NULL,
  `id_asignatura` varchar(50) DEFAULT NULL,
  `id_periodo` varchar(50) DEFAULT NULL,
  `inasistencia` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_alumno`, `id_asignatura`, `id_periodo`, `inasistencia`) VALUES
(984561, '2017IEIEMyG-M', '2017IEP1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `id_tipo_usuario` int(11) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `prim_apellido` varchar(45) DEFAULT NULL,
  `seg_apellido` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `id_sede` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id_docente`, `id_tipo_usuario`, `nombres`, `prim_apellido`, `seg_apellido`, `email`, `pass`, `id_sede`) VALUES
(123456, 3, 'Pablo', 'Picasso', 'Perez', 'picasso@mail.com', '$2y$10$BHUe0qi.DV7.7Za1hT69iuNZPRV1CCniNdmHN74Ef8JuUyUpcfp8C', 'IE'),
(258456, 3, 'Francisco', 'Goya', 'Hernandez', 'goya@mail.com', '$2y$10$fufcIhzQ8ief9QPrYuYoVu5cJ4DhbYVH.VcsSsCl0rOosxTbv7xKu', 'IE'),
(654321, 2, 'Administrador', 'Admin', 'Admin2', 'admin@admin.com', '$2y$10$sSYgkIxAGpIiE.PfYRb1EuVFgJCr/envp28P4iDmwB2N4/2Rp7uOW', 'IE'),
(8454897, 3, 'Vincent', 'Vangoh', 'Perez', 'vangoh@mail.com', '$2y$10$ImBTvp4xECZQUDsjgpO1dO2wvtt6QgXVChYNwqo0/ECCFq0Ur4.RK', 'JJR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` varchar(50) NOT NULL,
  `id_sede` varchar(50) DEFAULT NULL,
  `descripcion_grado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `id_sede`, `descripcion_grado`) VALUES
('2017IEIE11', 'IE', '11'),
('2017JJRJJR10', 'JJR', '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` varchar(50) NOT NULL,
  `id_grado` varchar(50) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `descripcion_grupo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `id_grado`, `id_docente`, `descripcion_grupo`) VALUES
('2017IEIE11-1', '2017IEIE11', 123456, '1'),
('2017JJRJJR10-2', '2017JJRJJR10', 8454897, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros`
--

CREATE TABLE `logros` (
  `id_periodo` varchar(50) DEFAULT NULL,
  `id_grupo` varchar(50) DEFAULT NULL,
  `id_asignatura` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id_alumno` int(11) NOT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `id_periodo` varchar(50) DEFAULT NULL,
  `id_grupo` varchar(50) DEFAULT NULL,
  `nota` decimal(4,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id_alumno`, `id_anio_lectivo`, `id_periodo`, `id_grupo`, `nota`) VALUES
(159753, '2017IE', '2017IEP1', '2017IEIE11-1', '3.5'),
(784545, '2017IE', '2017IEP1', '2017IEIE11-1', '4.5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_definitiva`
--

CREATE TABLE `nota_definitiva` (
  `id_alumno` int(11) NOT NULL,
  `id_area` varchar(50) DEFAULT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `nota_definitiva` decimal(20,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` varchar(50) NOT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `desc_periodo` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `id_anio_lectivo`, `desc_periodo`, `fecha_inicio`, `fecha_fin`) VALUES
('2017IEP1', '2017IE', 'Primer Periodo AÃ±o 2017IE', '2017-01-09', '2017-03-16'),
('2017IEP2', '2017IE', 'Segundo Periodo AÃ±o 2017IE', '2017-03-16', NULL),
('2017IEP3', '2017IE', 'Tercer Periodo AÃ±o 2017IE', '2017-06-16', '2017-09-16'),
('2017IEP4', '2017IE', 'Cuarto Periodo AÃ±o 2017IE', '2017-09-16', '2017-12-16'),
('2017JJRP1', '2017JJR', 'Primer Periodo AÃ±o 2017JJR', '2017-01-09', '2017-03-18'),
('2017JJRP2', '2017JJR', 'Segundo Periodo AÃ±o 2017JJR', '2017-03-18', NULL),
('2017JJRP3', '2017JJR', 'Tercer Periodo AÃ±o 2017JJR', '2017-06-18', '2017-09-18'),
('2017JJRP4', '2017JJR', 'Cuarto Periodo AÃ±o 2017JJR', '2017-09-18', '2017-12-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion`
--

CREATE TABLE `recuperacion` (
  `id_recuperacion` varchar(50) NOT NULL,
  `id_asignatura` varchar(50) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `nota` decimal(20,0) DEFAULT NULL,
  `acta` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` varchar(50) NOT NULL,
  `descripcion_sede` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `descripcion_sede`) VALUES
('IE', 'Instituto Estrada'),
('JJR', 'Juan Jose Rondon'),
('MS', 'Mariscal Sucre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `des_tipo_usuario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `des_tipo_usuario`) VALUES
(1, 'Root'),
(2, 'Administrador'),
(3, 'Docente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_grupo_alumno_idx` (`id_grupo`),
  ADD KEY `id_sede_alumno_idx` (`id_sede`);

--
-- Indices de la tabla `anio_lectivo`
--
ALTER TABLE `anio_lectivo`
  ADD UNIQUE KEY `id_Anio_Lectivo_UNIQUE` (`id_anio_lectivo`),
  ADD KEY `id_sede_aniolectivo_idx` (`id_sede`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`),
  ADD UNIQUE KEY `id_area_UNIQUE` (`id_area`),
  ADD KEY `id_sede_area_idx` (`id_sede`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD KEY `id_docente_idx` (`id_docente`),
  ADD KEY `id_area_asignatura_idx` (`id_area`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_asignatura_asistencia_idx` (`id_asignatura`),
  ADD KEY `id_periodo_idx` (`id_periodo`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `id_tipo_usuario_idx` (`id_tipo_usuario`),
  ADD KEY `id_sede_docente_idx` (`id_sede`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`),
  ADD KEY `id_sede_grado_idx` (`id_sede`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_grado_grupo_idx` (`id_grado`),
  ADD KEY `id_docente_grupo_idx` (`id_docente`);

--
-- Indices de la tabla `logros`
--
ALTER TABLE `logros`
  ADD KEY `id_periodo_logros_idx` (`id_periodo`),
  ADD KEY `id_grupo_logros_idx` (`id_grupo`),
  ADD KEY `id_asignatura_logros_idx` (`id_asignatura`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_periodo_nota_idx` (`id_periodo`),
  ADD KEY `id_grupo_nota_idx` (`id_grupo`),
  ADD KEY `id_anio_lectivo_nota_idx` (`id_anio_lectivo`);

--
-- Indices de la tabla `nota_definitiva`
--
ALTER TABLE `nota_definitiva`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_area_notadef_idx` (`id_area`),
  ADD KEY `id_anio_lectivo_notadef_idx` (`id_anio_lectivo`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`),
  ADD KEY `id_anio_lectivo_periodo_idx` (`id_anio_lectivo`);

--
-- Indices de la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD PRIMARY KEY (`id_recuperacion`),
  ADD KEY `id_alumno_recu_idx` (`id_alumno`),
  ADD KEY `id_anio_lectivo_recu_idx` (`id_anio_lectivo`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `id_grupo_alumno` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_sede_alumno` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `anio_lectivo`
--
ALTER TABLE `anio_lectivo`
  ADD CONSTRAINT `id_sede_aniolectivo` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `id_sede_area` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `id_area_asig` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_docente_asig` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `id_alumno_asis` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_asignatura_asis` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_periodo` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `id_sede_docente` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grado`
--
ALTER TABLE `grado`
  ADD CONSTRAINT `id_sede_grado` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `id_docente_grupo` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_grado_grupo` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logros`
--
ALTER TABLE `logros`
  ADD CONSTRAINT `id_asignatura_logros` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_grupo_logros` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_periodo_logros` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `id_alumno_nota` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_anio_lectivo_nota` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_grupo_nota` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_periodo_nota` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota_definitiva`
--
ALTER TABLE `nota_definitiva`
  ADD CONSTRAINT `id_alumno_notadef` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_anio_lectivo_notadef` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_area_notadef` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD CONSTRAINT `id_anio_lectivo_periodo` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD CONSTRAINT `id_alumno_recu` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_anio_lectivo_recu` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_asignatura_recu` FOREIGN KEY (`id_recuperacion`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
