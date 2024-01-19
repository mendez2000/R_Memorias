-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2024 a las 00:49:00
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `activos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabecera`
--

CREATE TABLE `cabecera` (
  `id` int(11) NOT NULL,
  `detGrab` text NOT NULL,
  `id_jefe` int(11) NOT NULL,
  `depto` text NOT NULL,
  `fecha` date NOT NULL,
  `dia` text NOT NULL,
  `id_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacidad`
--

CREATE TABLE `capacidad` (
  `id` int(11) NOT NULL,
  `nom_cap` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capacidad`
--

INSERT INTO `capacidad` (`id`, `nom_cap`) VALUES
(18, '256 GB'),
(19, '128 GB'),
(20, '64 GB'),
(21, '32 GB'),
(22, '16 GB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depto`
--

CREATE TABLE `depto` (
  `id` int(11) NOT NULL,
  `nom_depto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `depto`
--

INSERT INTO `depto` (`id`, `nom_depto`) VALUES
(5, 'TSI'),
(6, 'Operaciones'),
(7, 'Produccion'),
(9, 'Audio'),
(10, 'Mercadeo'),
(11, 'IT'),
(12, 'Logistica'),
(13, 'Master Ingesta'),
(15, 'TN5 Estelar'),
(16, 'Hoy Mismo'),
(17, '	Mercadeo'),
(18, 'Medios Digitales'),
(19, '	TN5 Matutino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `id` int(11) NOT NULL,
  `id_det` int(11) NOT NULL,
  `detEqui` text NOT NULL,
  `marca` text NOT NULL,
  `serie` text NOT NULL,
  `cant` int(11) NOT NULL,
  `obs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `id_depto` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nom`, `id_depto`, `id_rol`) VALUES
(29, 'Wilson Mendez', 11, 10),
(31, 'Edwin Ilovares', 11, 8),
(32, 'Wesly Lopez', 11, 9),
(33, 'Kelvin Sagastume', 11, 8),
(34, 'Jorge Ortiz', 11, 8),
(35, 'Osman Madrid', 6, 9),
(36, 'Alexis Velasquez', 6, 9),
(37, 'Joel Sorto', 13, 9),
(38, 'Luis Amador', 11, 10),
(43, 'Eddi Quintero', 16, 12),
(44, 'Cesar Reyes', 18, 13),
(45, 'Carlos Sanchez', 11, 10),
(46, 'Gabriela Lovo', 5, 8),
(47, 'Mario Landa', 15, 12),
(48, 'Pamela Medina', 5, 8),
(51, 'Carlos Nazar', 7, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `id` int(11) NOT NULL,
  `Fpres` date NOT NULL,
  `Hpres` time NOT NULL,
  `detalle` varchar(1000) NOT NULL,
  `id_emp` int(11) NOT NULL,
  `id_itb` int(11) NOT NULL,
  `nota` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`id`, `Fpres`, `Hpres`, `detalle`, `id_emp`, `id_itb`, `nota`) VALUES
(33, '2023-11-05', '13:48:00', 'Laptop \r\nMouse \r\nMaletin', 48, 31, 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nom_estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nom_estado`) VALUES
(9, 'Nueva'),
(10, 'Prestamo'),
(11, 'Vieja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itbadmin`
--

CREATE TABLE `itbadmin` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `itbadmin`
--

INSERT INTO `itbadmin` (`id`, `user`, `pass`) VALUES
(2, 'mendez', '04ac4744506f837d1eb9b976527595b42c377a216efddf63902eb1650a60f3d4fc6ce6cbf74faff969bdf6732f9893415a9a1242fa87b5c1f0abbcbe93ad4d6b'),
(3, 'eilovares', 'd6ddbdd75327e8b14b1ff494d657019c39515ce9fb33494b9896f9bd01e42691cc51d4a973fc805c7c405fca6dd8339755ffef732fbe570a9bec8b04a60a8af9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nom_marca` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nom_marca`) VALUES
(8, 'DELL'),
(9, 'HP'),
(10, 'Optiplex'),
(11, 'Compaq'),
(12, 'Sony'),
(13, 'Kingston'),
(20, 'Apple'),
(21, 'Asus'),
(22, 'Acer'),
(23, 'Huawei'),
(24, 'Samsung'),
(25, 'Gateway'),
(26, 'LG'),
(27, 'MSI'),
(28, 'Toshiba'),
(29, 'Alienware'),
(30, 'Lenovo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memorias`
--

CREATE TABLE `memorias` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `serie` varchar(20) NOT NULL,
  `id_cap` int(11) NOT NULL,
  `id_empleados` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_itb` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `obs` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `memorias`
--

INSERT INTO `memorias` (`id`, `id_marca`, `modelo`, `serie`, `id_cap`, `id_empleados`, `id_estado`, `id_itb`, `fecha`, `obs`) VALUES
(155, 13, 'GDKSSD', 'JJAXDADAD', 20, 48, 9, 33, '2023-11-05', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id` int(11) NOT NULL,
  `Fpres` date NOT NULL,
  `Hpres` time NOT NULL,
  `detalle` varchar(1000) NOT NULL,
  `id_empleados` int(11) NOT NULL,
  `id_itb` int(11) NOT NULL,
  `Fdev` date DEFAULT NULL,
  `Hdev` time DEFAULT NULL,
  `Entr` int(11) DEFAULT NULL,
  `itbrec` int(11) DEFAULT NULL,
  `nota` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id`, `Fpres`, `Hpres`, `detalle`, `id_empleados`, `id_itb`, `Fdev`, `Hdev`, `Entr`, `itbrec`, `nota`) VALUES
(26, '2023-11-13', '12:00:00', 'Laptop Acer Inv. 01 315 1322 Irig Inv. 02 900 1141 Estabilizador MINISO Lector de memorias Adaptador de red Cable de red Celular Cargador para celular Cargador para laptop Mouse', 43, 34, '2023-11-14', '21:02:00', 43, 34, 'Equipo Viaja a Colombia, el equipo no salió cancelaron el equipo'),
(27, '2023-11-14', '10:48:00', '- Laptop Dell Inspiron Num Inv. 02 405 1168 \r\n- Mouse \r\n- Cargador de laptop', 44, 45, '2023-11-14', '21:01:00', 44, 38, 'Equipo utilizado para evento de cooperativa Elga, Recibe Jose Kuan, Encargado Cesar Reyes'),
(28, '2023-11-24', '20:59:00', '-Laptop Acer Inv 01-315-1322 \r\n-Cargador de laptop -Celular Huawei Inv 89942603073965 \r\n-Cargador de celular y cable tipo c \r\n-Estabilizador MINISO \r\n-Irig Inv 02-900-1142 \r\n-Lector de memorias microSD USB \r\n-cable de red \r\n-mochila DELL \r\n-Audifonos', 46, 34, '2024-01-16', '17:44:00', 47, 34, 'Equipo préstamo que viajara a Emiratos Árabes Unidos, Dubái'),
(29, '2023-11-24', '20:59:00', 'Disco Duro Portátil 2.5\" \r\nCable de datos 3.0', 51, 29, '2023-11-25', '15:26:00', 51, 45, 'Lo lleva para transmisión desde Comayagua'),
(30, '2024-01-11', '17:30:00', '-Teléfono Celular marca Huawei con serie numero 89942603073965 \r\n-Cargado -Cable de datos tipo C \r\n-IRIG Pre2 INV.02-900-1142 \r\n-Estuche Negro', 47, 29, '2024-01-16', '10:44:00', 47, 34, 'Sale fuera del pais el equipo se entrega probado.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nom`) VALUES
(7, 'Administrador'),
(8, 'Cordinador'),
(9, 'Jeje'),
(10, 'Tecnico'),
(11, 'Colaborador'),
(12, 'Periodista'),
(13, 'Editor'),
(14, 'Animador'),
(15, 'Productor'),
(16, 'Director'),
(18, 'Rotulador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `id_empl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `pass`, `id_empl`) VALUES
(108, 'mendez', 'b0f6d1cff64a88c0dfc4e55172bf97b8ebe1d77c4e1282203da69114a0385d9269033698afa7eb16ac7fd61fb16f5e38081f0b8ab1f11aace13364b6f702f039', 29),
(109, 'lamador', 'e3056ac88a87de2378d89a10c58a213f24d15ac5a6c0cd380994382ab862757b1bd2be1d87c34ac5d17dee085695927fa97c5373fb0a3d7046ab04e4df80c0b9', 38),
(110, 'jortiz', '0b99adf65af8bd9b2b6dd348d8bca7bd96d48c8e48ce3cf3db394eedaf007db6897634299ddeab8364a4e2e0befb83a97ec362ea2ef217560c60ad10c56bf1ce', 34),
(111, 'eilovares', 'd37b342d14ab6eafe55bcdc4dff55946e03a6c92f598ecc260f3b0c89bdeeec3d9239f7eaecbb9cda610beee2386e1d58f68b365fca632ebdb64a5cbaf1742db', 31),
(112, 'ksagastume', '5c4bcb4189da6030cfe6942272d0710995a669506b6508f592ed800e7c7f410fd7c5406cdd070c76b00eef2d81f160624eb6010335386dc39f5f9a2e2889d68d', 33),
(113, 'wlopez', 'dd11064967fc0f6fc315047d3199fe40419594fc5b3d2a05ed026cd6bea6933751355cfc0f4f11984d6601ab90fa18ca25ff3a567d1d33b2c59df8d9647a2ff2', 32);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cabecera`
--
ALTER TABLE `cabecera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jefe` (`id_jefe`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Indices de la tabla `capacidad`
--
ALTER TABLE `capacidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `depto`
--
ALTER TABLE `depto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CabeceraID` (`id_det`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_depto` (`id_depto`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_emp` (`id_emp`),
  ADD KEY `id_itb` (`id_itb`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `itbadmin`
--
ALTER TABLE `itbadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `memorias`
--
ALTER TABLE `memorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_cap` (`id_cap`),
  ADD KEY `id_itb` (`id_itb`),
  ADD KEY `id_empleados` (`id_empleados`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleados` (`id_empleados`),
  ADD KEY `id_itb` (`id_itb`),
  ADD KEY `itbrec` (`itbrec`),
  ADD KEY `Entr` (`Entr`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empl` (`id_empl`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cabecera`
--
ALTER TABLE `cabecera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `capacidad`
--
ALTER TABLE `capacidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `depto`
--
ALTER TABLE `depto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `itbadmin`
--
ALTER TABLE `itbadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `memorias`
--
ALTER TABLE `memorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cabecera`
--
ALTER TABLE `cabecera`
  ADD CONSTRAINT `cabecera_ibfk_1` FOREIGN KEY (`id_jefe`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cabecera_ibfk_2` FOREIGN KEY (`id_emp`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `detalles_ibfk_1` FOREIGN KEY (`id_det`) REFERENCES `cabecera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_depto`) REFERENCES `depto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_2` FOREIGN KEY (`id_emp`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entregas_ibfk_3` FOREIGN KEY (`id_itb`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `memorias`
--
ALTER TABLE `memorias`
  ADD CONSTRAINT `memorias_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memorias_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memorias_ibfk_4` FOREIGN KEY (`id_cap`) REFERENCES `capacidad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memorias_ibfk_6` FOREIGN KEY (`id_empleados`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memorias_ibfk_7` FOREIGN KEY (`id_itb`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`id_empleados`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`id_itb`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`Entr`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_4` FOREIGN KEY (`itbrec`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_empl`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
