-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2024 a las 15:37:05
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
-- Base de datos: `db_libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Premiaciones` int(11) NOT NULL,
  `GeneroDestacado` varchar(150) NOT NULL,
  `FechaNacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id`, `Nombre`, `Premiaciones`, `GeneroDestacado`, `FechaNacimiento`) VALUES
(1, 'George Orwell', 6, 'Terror', '1965-05-12'),
(2, 'Richard Blair', 4, 'Comedia', '1998-09-11'),
(4, 'J. K. Rowling', 3, 'Fantasia', '1967-10-21'),
(8, 'Stephen King', 9, 'Aventuras', '1956-10-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(150) NOT NULL,
  `Autor` int(11) NOT NULL,
  `CantidadPaginas` int(11) NOT NULL,
  `Genero` varchar(150) NOT NULL,
  `Editorial` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `CantidadPaginas`, `Genero`, `Editorial`) VALUES
(1, 'Harry Potter y la piedra filosofal', 4, 450, 'Comedia', 'San Pedro S.A'),
(2, 'Harry Potter y las reliquias de la muerte', 4, 390, 'Comedia', 'San Pedro S.A'),
(3, 'Rebelion en la Granja', 1, 300, 'Terror', 'Madero Company'),
(4, 'El Señor de las Moscas', 2, 175, 'Romance', 'Aguas Tibias SS'),
(6, 'Los dias de Birmania', 1, 912, 'Ciencia Ficcion', 'Madero Company'),
(7, 'Harry Potter y el prisionero de Azkaban', 4, 323, 'Aventuras', 'San Pedro S.A'),
(8, 'Harry Potter y la cámara secreta', 4, 511, 'Ciencia Ficcion', 'San Pedro S.A'),
(9, 'Harry Potter y la Orden del Fénix', 4, 290, 'Aventuras', 'San Pedro S.A'),
(10, 'Harry Potter y el misterio del príncipe', 4, 444, 'Ciencia Ficcion', 'San Pedro S.A'),
(11, 'Homenaje a Cataluña', 1, 125, 'Terror', 'Roble Oscuro CO.'),
(12, '1984', 1, 328, 'Ciencia Ficcion', 'Aguas Tibias SS'),
(13, 'El Resplandor ', 8, 666, 'Terror', 'Madero Company'),
(14, 'It', 8, 190, 'Comedia', 'Aguas Tibias SS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `contrasena` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`) VALUES
(1, 'webadmin', '$2y$10$n1MveO0TItRCQBHbOg5hpurrdzQlzKpeZB9An//uq4BuUNZy4h3D6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Autor` (`Autor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`Autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
