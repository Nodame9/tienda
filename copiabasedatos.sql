-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-11-2015 a las 05:17:22
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `deportes`
--
CREATE DATABASE `deportes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `deportes`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE IF NOT EXISTS `carrito` (
  `intContador` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `TransaccionEfectuada` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intContador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcar la base de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`intContador`, `idUsuario`, `idProducto`, `Cantidad`, `TransaccionEfectuada`) VALUES
(12, 3, 23, 1, 0),
(20, 4, 20, 1, 0),
(21, 4, 20, 1, 0),
(22, 5, 20, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Descripcion`) VALUES
(1, 'Hombres'),
(2, 'Niños'),
(3, 'Mujeres'),
(6, 'Niñas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `idCompra` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `fchCompra` datetime NOT NULL,
  `TipoPago` int(255) NOT NULL,
  `Total` double(255,0) NOT NULL,
  PRIMARY KEY (`idCompra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `compra`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `idEmpleado` int(50) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Rol` varchar(50) NOT NULL,
  `FechaR` date NOT NULL,
  PRIMARY KEY (`idEmpleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `Nombre`, `Rol`, `FechaR`) VALUES
(9, 'Esther', 'Jefe', '2015-10-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Disponibilidad` varchar(100) NOT NULL,
  `Precio` double(11,0) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Categoria` varchar(100) NOT NULL,
  `Imagen` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Volcar la base de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `Nombre`, `Disponibilidad`, `Precio`, `Stock`, `Categoria`, `Imagen`) VALUES
(32, 'Sudadera', 'Activo', 500, 123, '3', 'Sudadera2.jpg'),
(33, 'Bolsa', 'Activo', 500, 199, '6', 'Bolsa1.jpg'),
(34, 'Camiseta', 'Activo', 500, 120, '1', 'Camiseta1.jpg'),
(35, 'Chamarra', 'Activo', 430, 234, '2', 'Chamarra1.jpg'),
(36, 'Guantes', 'Activo', 329, 39, '1', 'Guantes.jpg'),
(37, 'Maleta', 'Activo', 699, 399, '1', 'Maleta1.jpg'),
(38, 'Maleta', 'Activo', 399, 199, '3', 'Maleta2.jpg'),
(39, 'Camiseta', 'Activo', 200, 29, '3', 'Ropa1.jpg'),
(40, 'Sudadera', 'Activo', 499, 49, '3', 'Sudadera1.jpg'),
(41, 'Tenis', 'Activo', 599, 288, '3', 'Tenis5.jpg'),
(42, 'Tenis', 'Activo', 200, 29, '2', 'Tenis13.jpg'),
(43, 'Vestido', 'Activo', 400, 19, '6', 'Vestido1.jpg'),
(44, 'Tenis', 'Activo', 399, 49, '2', 'Tenis14.jpg'),
(45, 'Tenis', 'Activo', 399, 28, '1', 'Tenis11.jpg'),
(46, 'Tenis', 'Activo', 399, 388, '6', 'Tenis16.jpg'),
(47, 'Tenis', 'Activo', 499, 234, '3', 'Tenis12.jpg'),
(48, 'Tenis', 'Activo', 650, 299, '3', 'Tenis2.jpg'),
(49, 'Tenis', 'Activo', 596, 19, '3', 'Tenis6.jpg'),
(50, 'Tenis', 'Activo', 500, 19, '3', 'Tenis10.jpg'),
(51, 'Tenis', 'Activo', 399, 29, '6', 'Tenis15.jpg'),
(52, 'Tenis', 'Activo', 299, 29, '2', 'Tenis18.jpg'),
(53, 'Tenis', 'Activo', 499, 12, '6', 'Tenis17.jpg'),
(54, 'Tenis', 'Activo', 650, 29, '3', 'Tenis1.jpg'),
(55, 'Conjunto', 'Activo', 1000, 19, '1', 'Sudadera3.jpg'),
(56, 'Short', 'Activo', 249, 55, '1', 'Short.jpg'),
(57, 'Conjunto', 'Activo', 399, 29, '2', 'Conjunto.jpg'),
(58, 'Malla', 'Activo', 399, 19, '6', 'Malla.jpg'),
(59, 'Tenis', 'Activo', 399, 19, '3', 'Tenis8.jpg'),
(60, 'Reloj', 'Activo', 500, 2, '1', 'reloj.jpg'),
(61, 'Mallas', 'Activo', 399, 29, '1', 'Mallas2.jpg'),
(62, 'Reloj', 'Activo', 599, 19, '1', 'Reloj3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `FechaAlta` date NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Nombre`, `Email`, `Direccion`, `FechaAlta`, `Password`) VALUES
(1, 'Juana', 'juana@gmail.com', '14 ote', '2012-11-15', ''),
(2, 'Juan', 'juan@hotmail.com', '13 Ote', '0000-00-00', '123'),
(3, 'nombre', 'email.@correo.com', 'Direccion', '0000-00-00', 'password'),
(4, 'Ivonne', 'yue_hada@gmail.com', 'Calle 12 ote', '2015-11-10', '1234'),
(5, 'Miguel', 'miguel@gmail.com', '15 ote', '2015-10-11', '123456'),
(6, 'Ivonne', 'yue@hotmail.com', '12 ote', '0000-00-00', '12');
