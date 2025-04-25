-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2025 a las 16:42:48
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
-- Base de datos: `biblioteca_software`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nit_empresa` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nit_empresa`, `nombre`, `direccion`, `numero`) VALUES
('1212121212121', 'bliblioteca paz y amor', 'calle 45 ibague', '3244845451'),
('12321', 'bliblioteca salud', 'calle232', '324111111'),
('123456789', 'EducaLibros S.A.S.', 'Calle 123 #45-67, Bogotá', '3001234567'),
('456789123', 'LectoMundo', 'Avenida Siempre Viva, Cali', '3204567891'),
('987654321', 'BiblioTech Ltda.', 'Carrera 7 #89-12, Medellín', '3109876543'),
('987654322', 'biblioteca cafe.', 'calle 22 lerida ', '324444778'),
('98765455', 'Blibliteca municipal', 'calle 42 ibague', '324484322');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `ID_estado` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `ID_licencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`ID_estado`, `Nombre`, `ID_licencia`) VALUES
(1, 'Activa', 1),
(2, 'Activa', 2),
(3, 'Activa', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `ID_estudiante` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `codigo_barra` varchar(50) NOT NULL,
  `curso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`ID_estudiante`, `Nombre`, `codigo_barra`, `curso`) VALUES
(1, 'Juan Rodríguez', 'BAR123456', '10A'),
(2, 'Laura Martínez', 'BAR789012', '11B'),
(3, 'Sofía Torres', 'BAR345678', '9C'),
(4, 'juan garcia', 'BAR636310', '7c'),
(5, 'cesar Gutiérrez', 'BAR209111', '8c'),
(6, 'cesar Gutiérrez', 'BAR508162', '8c'),
(7, 'cesar Gutiérrez', 'BAR754081', '8c'),
(8, 'cesar Gutiérrez', 'BAR311105', '8c'),
(9, 'Bautista jhoan', 'BAR755055', '6c'),
(10, 'brando Esquivel', 'BAR762065', '7a'),
(11, 'brando Esquivel', 'BAR394801', '7a'),
(12, 'brando Esquivel', 'BAR294918', '7a'),
(13, 'brando Esquivel', 'BAR358669', '9c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `ID_ingreso` int(11) NOT NULL,
  `FECHA_HORA` datetime NOT NULL,
  `ID_estudiante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`ID_ingreso`, `FECHA_HORA`, `ID_estudiante`) VALUES
(1, '2025-04-23 08:30:00', 1),
(2, '2025-04-23 09:15:00', 2),
(3, '2025-04-23 10:00:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `ID_licencia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `ID_tipo` int(11) NOT NULL,
  `ID_empresa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`ID_licencia`, `nombre`, `precio`, `fecha_inicio`, `fecha_fin`, `ID_tipo`, `ID_empresa`) VALUES
(1, 'Licencia Básica', 100.00, '2025-01-01', '2025-06-30', 1, '123456789'),
(2, 'Licencia Estándar', 200.00, '2025-01-01', '2025-12-31', 2, '987654321'),
(3, 'Licencia Premium', 300.00, '2025-01-01', '2026-12-31', 3, '456789123'),
(393718948, 'Licencia Generada', 100.00, '2025-04-25', '2025-10-22', 1, '12321'),
(830013902, 'Licencia Generada', 300.00, '2025-04-25', '2027-04-25', 3, '98765455'),
(2147483647, 'Licencia Generada', 300.00, '2025-04-25', '2027-04-25', 3, '987654322');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Bibliotecario'),
(4, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_licencia`
--

CREATE TABLE `tipo_licencia` (
  `ID_Tipo` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `duracion_licencia` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_licencia`
--

INSERT INTO `tipo_licencia` (`ID_Tipo`, `tipo`, `duracion_licencia`, `precio`) VALUES
(1, 'Básica', 180, 100.00),
(2, 'Estándar', 365, 200.00),
(3, 'Premium', 730, 300.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Documento` varchar(20) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_empresa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Documento`, `contraseña`, `nombre`, `gmail`, `id_rol`, `id_empresa`) VALUES
('0987654321', '12345678', 'Carlos Pérez', 'carlos.perez@gmail.com', 2, '987654321'),
('1073155246', '1073155246', 'Fabian Martinez', 'fabian@gmail.com', 1, '123456789'),
('1122334455', '12345678', 'María López', 'maria.lopez@gmail.com', 3, '456789123'),
('123454321', '$2y$10$yWKtZ3u1NiNPMkUIBxnkpeFaDP6g08Zosf0t1LJdIXIxjF4C3pfty', 'jairo perez', 'jairo@gmail.com', 2, '1212121212121'),
('1234565432', '$2y$10$5JmllFOyrB.eQwbHq0mn0uhDCPIJ6p9GqU0yZXeNvxjca.O2Qgiua', 'esteban pelaes', 'pelaes@gmail.com', 2, '987654322'),
('12345654321', '$2y$10$yX3Z5kBStjrFaWkq0oN8hOqV.ult9yq7NOj3zRdy6ZmTSuWRv4otW', 'esteban  perez', 'esteban@gmail.com', 2, '987654322'),
('1234567810', '$2y$10$Iz2g2Qpr6CqoptgxUdEYPO6X26an5BC7KRFT3.wguPw4Bb1h0aaou', 'fabian marti', 'martinez@gmail.com', 2, '98765455'),
('12345678910', '$2y$10$BVNzuXmFEesrNhBDcLnP2e7IyaXXUG.NnercxboomvzqnIbZTxJxO', 'Carlos alberto ', 'carlos@gmail.com', 2, '123456789'),
('6677889900', '12345678', 'Pedro Ramírez', 'pedro.ramirez@gmail.com', 4, '123456789');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`nit_empresa`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`ID_estado`),
  ADD KEY `ID_licencia` (`ID_licencia`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`ID_estudiante`),
  ADD UNIQUE KEY `codigo_barra` (`codigo_barra`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`ID_ingreso`),
  ADD KEY `ID_estudiante` (`ID_estudiante`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`ID_licencia`),
  ADD KEY `ID_tipo` (`ID_tipo`),
  ADD KEY `ID_empresa` (`ID_empresa`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  ADD PRIMARY KEY (`ID_Tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Documento`),
  ADD UNIQUE KEY `gmail` (`gmail`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `ID_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `ID_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `ID_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `ID_licencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  MODIFY `ID_Tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_ibfk_1` FOREIGN KEY (`ID_licencia`) REFERENCES `licencia` (`ID_licencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`ID_estudiante`) REFERENCES `estudiantes` (`ID_estudiante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD CONSTRAINT `licencia_ibfk_1` FOREIGN KEY (`ID_tipo`) REFERENCES `tipo_licencia` (`ID_Tipo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `licencia_ibfk_2` FOREIGN KEY (`ID_empresa`) REFERENCES `empresa` (`nit_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`nit_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
