-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-02-2018 a las 15:32:06
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foodnow`
--
CREATE DATABASE IF NOT EXISTS `foodnow` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `foodnow`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `contrasenia` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `usuario`, `contrasenia`, `email`) VALUES
(1, 'usertest', 'usertest', ''),
(2, 'test2', 'test2', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comida`
--

DROP TABLE IF EXISTS `comida`;
CREATE TABLE IF NOT EXISTS `comida` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `idTipoComida` int(10) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idTipoComida` (`idTipoComida`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comida`
--

INSERT INTO `comida` (`id`, `nombre`, `idTipoComida`, `precio`, `descripcion`) VALUES
(3, 'Milanesa con puré', 13, 150, 'Milanesa de ternera con puré'),
(4, 'Milanesa con papas fritas', 13, 150, 'Milanesa de ternera con papas fritas'),
(5, 'Milanesa con ensalada', 13, 140, 'Milanesa de ternera con ensalada'),
(6, 'Milanesa con papas al horno', 13, 150, 'Milanesa de ternera con papas al horno'),
(7, 'Suprema con puré', 13, 140, 'Milanesa de pollo con puré'),
(8, 'Suprema con papas fritas', 13, 140, 'Milanesa de pollo con papas fritas'),
(9, 'Suprema con ensalada', 13, 130, 'Milanesa de pollo con ensalada'),
(10, 'Suprema con papas al horno', 13, 140, 'Milanesa de pollo con papas al horno'),
(11, 'Canelones', 15, 100, 'Canelones de atún, huevo duro y champiñones'),
(12, 'Espaguetis con salsa', 15, 110, 'Espaguetis con salsa filetto'),
(13, 'Macarrones', 15, 90, 'Macarrones con tomate y chorizo'),
(14, 'Ensalada de bacalao', 9, 90, 'Ensalada de berenjenas y bacalao'),
(15, 'Ensalada con queso', 9, 90, 'Ensalada de tomate y queso de cabra'),
(16, 'Pollo asado', 18, 120, 'Pollo asado con puré'),
(17, 'Pollo grillé', 18, 130, 'Pollo grillé'),
(18, 'Solomillo', 21, 220, 'Solomillo a la pimienta verde'),
(19, 'Carne al horno', 21, 200, 'Carne al horno con papas rústicas'),
(20, 'Peceto al horno', 21, 170, 'Peceto al horno con papas'),
(21, 'Lomito Simple', 12, 150, 'Lomito con queso y jamón'),
(22, 'Lomito Completo', 12, 180, 'Lomito con panceta, queso, jamón y huevo'),
(23, 'Hamburguesa simple', 10, 140, 'Hamburguesa con queso'),
(24, 'Hamburguesa Completa', 10, 170, 'Hamburguesa con panceta, jamón, queso y huevo frito'),
(25, 'Helado al agua', 11, 70, 'Helado al gua de sabores frutales'),
(26, 'Helado de crema', 11, 80, 'Helado cremoso'),
(27, 'Cocochoas de Bacalao', 16, 200, 'Cocochoas de bacalao en salsa verde'),
(28, 'Salmón al horno', 16, 220, 'Salmón al horno con espárragos a la parrilla'),
(29, 'Carpaccio de Salmón', 16, 200, 'Carpaccio de salmón con papas rústicas'),
(30, 'Salmón en salsa teriyaki', 16, 220, 'Salmón con salsa de jenjibre y zanahorias'),
(31, 'Pizza muzzarella', 17, 150, 'Pizza de queso muzzarella'),
(32, 'Pizza calabresa', 17, 170, 'Pizza con longaniza y queso'),
(33, 'Pizza napolitana', 17, 170, 'Pizza con jamón, queso y tomate'),
(34, 'Fugazzeta', 17, 160, 'Pizza con cebolla y queso'),
(35, 'Parrillada para 2 personas', 14, 450, 'Chorizo, morcilla, asado de tira, vacio'),
(36, 'Bondiola', 14, 250, 'Bondiola de cerdo con papas fritas'),
(37, 'Ribs', 14, 320, 'Ribs de cerdo con papas fritas'),
(38, 'Bife de chorizo con guarnición', 14, 280, 'Bife de chorizo con papas fritas'),
(39, 'Flan', 20, 40, ''),
(40, 'Budín de pan', 20, 45, ''),
(41, 'Duraznos en almíbar', 20, 45, ''),
(42, 'Queso y dulce', 20, 45, 'Queso con dulce de batata'),
(43, 'Licuado de ananá', 22, 85, ''),
(44, 'Licuado de banana', 22, 85, ''),
(45, 'Licuado de durazno', 22, 85, ''),
(46, 'Licuado de Kiwi', 22, 85, ''),
(47, 'Tostadas', 22, 35, 'Tostadas con queso crema'),
(48, 'Sándwich milanesa césar', 19, 130, 'Sándwich con lechuga, panceta y crocante'),
(49, 'Sándwich de Chorizo', 19, 130, 'Sándwich de chorizo a la plancha'),
(50, 'Sándwich mediterráneo', 19, 130, 'Milanesa berenjena, tomate, pepino y rúcula'),
(51, 'Empanada de carne', 8, 20, ''),
(52, 'Empanada de atún', 8, 20, ''),
(53, 'Empanada capresse', 8, 20, ''),
(54, 'Empanada de verdura', 8, 20, ''),
(55, 'Empanada de pollo', 8, 20, ''),
(56, 'Tarta de choclo', 2, 50, ''),
(57, 'Tarta de atún', 2, 50, ''),
(58, 'Tarta de pollo', 2, 50, ''),
(59, 'Tarta de jamón y queso', 2, 50, ''),
(60, 'Shawarma de carne', 1, 90, ''),
(61, 'Shawarma al plato', 1, 120, ''),
(62, 'Sushi salad salmón', 3, 220, 'ensalada de salmón, palta, queso sobre arroz gohan'),
(63, 'Roll calafate', 3, 120, 'arroz, queso y palta'),
(64, 'Hot Firenze', 3, 120, 'arroz rebozado envuelto en salmón'),
(65, 'Murg biryani', 4, 280, 'arroz, pollo y especias'),
(66, 'Veg biryani', 4, 280, 'verduras, cebolla y queso'),
(67, 'Aloo mattar', 4, 280, 'Curry de arvejas y papas con crema y queso'),
(68, 'Burrito de carne de res', 5, 70, ''),
(69, 'Fajita de carne de res', 5, 70, ''),
(70, 'Taco de carne de res', 5, 160, ''),
(71, 'Coca Cola', 23, 50, ''),
(72, 'Coca Cola Light', 23, 50, ''),
(73, 'Coca Cola Zero', 23, 50, ''),
(74, 'Agua Saborizada', 23, 50, ''),
(75, 'Agua sin gas', 23, 40, ''),
(76, 'Agua con gas', 23, 45, ''),
(77, 'Sprite', 23, 50, ''),
(78, 'Fanta', 23, 50, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comidaxpedidos`
--

DROP TABLE IF EXISTS `comidaxpedidos`;
CREATE TABLE IF NOT EXISTS `comidaxpedidos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idComida` int(10) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idRestaurant` int(10) NOT NULL,
  `cantidad` int(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idComida` (`idComida`),
  KEY `idPedido` (`idPedido`),
  KEY `idRestaurant` (`idRestaurant`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comidaxrestaurant`
--

DROP TABLE IF EXISTS `comidaxrestaurant`;
CREATE TABLE IF NOT EXISTS `comidaxrestaurant` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idRestaurant` int(10) NOT NULL,
  `idComida` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idRestaurant` (`idRestaurant`),
  KEY `idComida` (`idComida`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comidaxrestaurant`
--

INSERT INTO `comidaxrestaurant` (`id`, `idRestaurant`, `idComida`) VALUES
(1, 1, 20),
(2, 1, 27),
(3, 1, 28),
(4, 1, 29),
(5, 1, 30),
(6, 1, 37),
(7, 1, 38),
(8, 1, 65),
(9, 1, 43),
(10, 1, 44),
(11, 2, 3),
(12, 2, 4),
(13, 2, 5),
(14, 2, 9),
(15, 2, 11),
(16, 2, 12),
(17, 2, 13),
(18, 2, 18),
(19, 2, 21),
(20, 2, 22),
(21, 2, 25),
(22, 2, 26),
(23, 2, 41),
(37, 3, 17),
(38, 3, 18),
(39, 3, 19),
(40, 3, 20),
(41, 3, 25),
(42, 3, 26),
(43, 3, 28),
(44, 3, 29),
(45, 3, 35),
(46, 3, 38),
(47, 3, 43),
(48, 3, 44),
(49, 3, 66),
(50, 4, 17),
(51, 4, 18),
(52, 4, 19),
(53, 4, 20),
(54, 4, 25),
(55, 4, 26),
(56, 4, 55),
(57, 4, 56),
(58, 4, 61),
(59, 4, 62),
(60, 4, 69),
(61, 4, 70),
(62, 4, 66),
(63, 5, 27),
(64, 5, 28),
(65, 5, 29),
(66, 5, 20),
(67, 5, 43),
(68, 5, 44),
(69, 5, 45),
(70, 5, 46),
(71, 5, 51),
(72, 5, 52),
(73, 5, 53),
(74, 5, 54),
(75, 5, 55),
(76, 6, 3),
(77, 6, 5),
(78, 6, 7),
(79, 6, 9),
(80, 6, 12),
(81, 6, 13),
(82, 6, 15),
(83, 6, 18),
(84, 6, 25),
(85, 6, 26),
(86, 6, 31),
(87, 6, 32),
(88, 6, 33),
(89, 7, 11),
(90, 7, 12),
(91, 7, 13),
(92, 7, 16),
(93, 7, 17),
(94, 7, 23),
(95, 7, 24),
(96, 7, 34),
(97, 7, 25),
(98, 7, 26),
(99, 7, 39),
(100, 7, 40),
(101, 7, 42),
(102, 8, 31),
(103, 8, 32),
(104, 8, 33),
(105, 8, 34),
(106, 9, 18),
(107, 9, 19),
(108, 9, 56),
(109, 9, 51),
(110, 9, 57),
(111, 9, 58),
(112, 9, 68),
(113, 9, 69),
(114, 9, 70),
(115, 10, 68),
(116, 10, 69),
(117, 10, 70),
(118, 10, 56),
(119, 10, 57),
(120, 10, 58),
(121, 10, 59),
(122, 11, 31),
(123, 11, 32),
(124, 11, 33),
(125, 11, 34),
(126, 12, 21),
(127, 12, 22),
(128, 12, 23),
(129, 12, 24),
(130, 12, 39),
(131, 12, 40),
(132, 12, 41),
(133, 12, 42),
(134, 13, 3),
(135, 13, 4),
(136, 13, 5),
(137, 13, 6),
(138, 13, 7),
(139, 13, 8),
(140, 13, 9),
(141, 13, 48),
(142, 14, 25),
(143, 14, 26),
(144, 15, 68),
(145, 15, 69),
(146, 15, 70),
(147, 16, 63),
(148, 16, 64),
(149, 16, 53),
(150, 16, 54),
(151, 16, 55),
(152, 16, 56),
(153, 17, 21),
(154, 17, 22),
(155, 17, 23),
(156, 17, 24),
(157, 17, 48),
(158, 17, 49),
(159, 18, 21),
(160, 18, 22),
(161, 18, 23),
(162, 18, 24),
(163, 18, 25),
(164, 18, 26),
(165, 19, 31),
(166, 19, 32),
(167, 19, 33),
(168, 19, 34),
(169, 20, 3),
(170, 20, 4),
(171, 20, 7),
(172, 20, 8),
(173, 20, 11),
(174, 20, 12),
(175, 20, 14),
(176, 20, 17),
(177, 20, 18),
(178, 20, 22),
(179, 20, 24),
(180, 20, 28),
(181, 20, 30),
(182, 20, 37),
(183, 20, 47),
(184, 20, 60),
(185, 20, 70),
(186, 21, 3),
(187, 21, 4),
(188, 21, 7),
(189, 21, 8),
(190, 21, 11),
(191, 21, 12),
(192, 21, 14),
(193, 21, 17),
(194, 21, 18),
(195, 21, 22),
(196, 21, 24),
(197, 21, 28),
(198, 21, 30),
(199, 21, 37),
(200, 21, 47),
(201, 21, 60),
(202, 21, 70),
(203, 21, 31),
(204, 21, 32),
(205, 21, 33),
(206, 21, 34),
(207, 22, 21),
(208, 22, 22),
(209, 22, 23),
(210, 22, 24),
(211, 22, 48),
(212, 22, 49),
(213, 22, 50),
(214, 23, 17),
(215, 23, 18),
(216, 23, 22),
(217, 23, 24),
(218, 23, 28),
(219, 23, 30),
(220, 23, 37),
(221, 23, 47),
(222, 23, 60),
(223, 23, 70),
(224, 23, 31),
(225, 23, 32),
(226, 23, 33),
(227, 23, 34),
(228, 24, 25),
(229, 24, 26),
(230, 25, 23),
(231, 25, 24),
(232, 25, 48),
(233, 25, 49),
(234, 25, 50),
(235, 25, 17),
(236, 25, 18),
(237, 25, 22),
(238, 25, 24),
(239, 25, 28),
(240, 25, 30),
(241, 25, 37),
(242, 25, 47),
(243, 25, 60),
(244, 25, 70),
(245, 25, 31),
(246, 25, 32),
(247, 25, 33),
(248, 25, 34),
(249, 25, 69),
(250, 25, 68),
(251, 1, 71),
(252, 1, 73),
(253, 2, 72),
(254, 2, 74),
(255, 3, 75),
(256, 4, 76),
(257, 1, 77),
(258, 12, 78),
(259, 8, 71),
(260, 8, 75),
(261, 6, 71),
(262, 6, 77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

DROP TABLE IF EXISTS `domicilio`;
CREATE TABLE IF NOT EXISTS `domicilio` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idcliente` int(10) NOT NULL,
  `calle` varchar(35) NOT NULL,
  `numero` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`id`, `idcliente`, `calle`, `numero`) VALUES
(1, 1, 'domPrueba', '2248'),
(3, 1, 'Onas', '589');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidopendiente`
--

DROP TABLE IF EXISTS `pedidopendiente`;
CREATE TABLE IF NOT EXISTS `pedidopendiente` (
  `idCliente` int(10) NOT NULL,
  `restaurante` varchar(20) NOT NULL,
  `comida` varchar(50) NOT NULL,
  `cantidad` int(15) NOT NULL,
  `precio` float NOT NULL,
  KEY `idCliente` (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idCliente` int(10) NOT NULL,
  `telefono` bigint(25) NOT NULL,
  `calle` varchar(35) NOT NULL,
  `numeroCalle` varchar(15) NOT NULL,
  `formadepago` varchar(20) NOT NULL,
  `subtotal` float NOT NULL,
  `precioTotal` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

DROP TABLE IF EXISTS `promociones`;
CREATE TABLE IF NOT EXISTS `promociones` (
  `idcliente` int(10) NOT NULL,
  `promo` int(10) NOT NULL,
  KEY `idcliente` (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`idcliente`, `promo`) VALUES
(1, 100),
(1, 15),
(1, 10),
(1, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `restaurant`
--

INSERT INTO `restaurant` (`id`, `nombre`) VALUES
(1, 'Noma'),
(2, 'Osteria Francescana'),
(3, 'D.O.M'),
(4, 'Arzak'),
(5, 'Per Se'),
(6, 'Astrid y Gastón'),
(7, 'Manolo'),
(8, 'El Cuartito'),
(9, 'Siga la vaca'),
(10, 'Xalapa'),
(11, 'Guerrín'),
(12, 'El Sanjuanino'),
(13, 'El Cascote'),
(14, 'Freddo'),
(15, 'Don Pancho'),
(16, 'La Alpina'),
(17, 'Billy Lomito'),
(18, 'Totos Hamburguesas'),
(19, 'Las Cuartetas'),
(20, 'Defensa Bar'),
(21, 'La Continental'),
(22, 'La Estación'),
(23, 'Alameda'),
(24, 'Chocorísimo'),
(25, 'Dr Frio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

DROP TABLE IF EXISTS `telefono`;
CREATE TABLE IF NOT EXISTS `telefono` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idcliente` int(10) NOT NULL,
  `telefono` bigint(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `telefono`
--

INSERT INTO `telefono` (`id`, `idcliente`, `telefono`) VALUES
(1, 1, 3804496158),
(2, 2, 3804579862),
(3, 1, 3804412598);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocomida`
--

DROP TABLE IF EXISTS `tipocomida`;
CREATE TABLE IF NOT EXISTS `tipocomida` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipocomida`
--

INSERT INTO `tipocomida` (`id`, `tipo`) VALUES
(1, 'Comida Árabe'),
(2, 'Tartas'),
(3, 'Comida Japonesa'),
(4, 'Comida Hindú'),
(5, 'Comida Mexicana'),
(8, 'Empanadas'),
(9, 'Ensaladas'),
(10, 'Hamburguesas'),
(11, 'Helados'),
(12, 'Lomitos'),
(13, 'Milanesas'),
(14, 'Parrilla'),
(15, 'Pastas'),
(16, 'Pescados y Mariscos'),
(17, 'Pizzas'),
(18, 'Pollo'),
(19, 'Sándwiches'),
(20, 'Postres'),
(21, 'Carnes'),
(22, 'Desayunos'),
(23, 'Bebidas');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comida`
--
ALTER TABLE `comida`
  ADD CONSTRAINT `comida_ibfk_1` FOREIGN KEY (`idTipoComida`) REFERENCES `tipocomida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comidaxpedidos`
--
ALTER TABLE `comidaxpedidos`
  ADD CONSTRAINT `comidaxpedidos_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comidaxpedidos_ibfk_2` FOREIGN KEY (`idComida`) REFERENCES `comida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comidaxpedidos_ibfk_3` FOREIGN KEY (`idRestaurant`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comidaxrestaurant`
--
ALTER TABLE `comidaxrestaurant`
  ADD CONSTRAINT `comidaxrestaurant_ibfk_1` FOREIGN KEY (`idRestaurant`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comidaxrestaurant_ibfk_2` FOREIGN KEY (`idComida`) REFERENCES `comida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `domicilio_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidopendiente`
--
ALTER TABLE `pedidopendiente`
  ADD CONSTRAINT `pedidoPendiente_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `telefono_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
