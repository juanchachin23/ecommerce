-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost: 3306
-- Tiempo de generación: 30-07-2023 a las 00:49:03
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
-- Base de datos: `drurban`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `cat_tipo` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `cat_nombre` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `cat_tipo`, `cat_nombre`) VALUES
(1, 'Ropa', 'Abrigo'),
(2, 'Ropa', 'Calzado'),
(3, 'Ropa', 'Camisa'),
(4, 'Juguete', 'Peluche'),
(5, 'Consumo', 'Estupefacientes'),
(6, 'Ropa', 'Pantalón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id_metodo` int(11) NOT NULL,
  `met_tipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `pag_fecha` date DEFAULT NULL,
  `pag_codigo` varchar(9) NOT NULL DEFAULT 'Error' COMMENT 'Corresponde al pedido',
  `pag_metodo` varchar(25) DEFAULT NULL,
  `pag_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `pedi_fecha` date DEFAULT NULL,
  `pedi_descripcion` text DEFAULT NULL,
  `pedi_monto` double DEFAULT NULL,
  `pedi_codigo` varchar(9) NOT NULL DEFAULT 'Error',
  `pedi_cliente` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `produc_nombre` varchar(50) NOT NULL,
  `produc_precio` double(15,2) NOT NULL,
  `produc_descripcion` tinytext NOT NULL,
  `produc_cantidad` int(11) NOT NULL,
  `produc_urlimg` text NOT NULL,
  `produc_id_categoria` int(11) NOT NULL,
  `produc_proveedor` varchar(50) NOT NULL,
  `produc_activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `produc_nombre`, `produc_precio`, `produc_descripcion`, `produc_cantidad`, `produc_urlimg`, `produc_id_categoria`, `produc_proveedor`, `produc_activo`) VALUES
(3, 'Camisa Roja', 35.00, 'Camisa casual de color rojo de mangas cortas.', 41, '', 3, '2', 1),
(4, 'grogu', 22.00, 'peluche', 3, '', 4, '6', 1),
(5, 'Maria', 9999.99, 'aa.com', 0, 'yatusabe', 5, '7', 0),
(6, 'camisa azul', 100.00, 'aa.com', 25, 'camisa manga corta', 3, '5', 1),
(7, 'Zapato', 24.99, '¡Perfecto para ocasiones especiales y casuales!', 40, '', 2, '4', 1),
(8, 'Oppenheimer XL', 21000.99, 'Pa los fans', 10, '', 3, '7', 1),
(9, 'Abrigo Negro S', 120.00, 'Abrigo de color negro para el invierno.', 49, '', 1, '1', 1);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `actu_estadoProducto` BEFORE UPDATE ON `producto` FOR EACH ROW IF NEW.produc_cantidad < 1 THEN
		SET NEW.produc_activo = 0;
    ELSE
    	SET NEW.produc_activo = 1;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `prov_nombreempresa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `prov_nombreempresa`) VALUES
(1, 'Adidas'),
(3, 'Converse'),
(6, 'Hasbro'),
(2, 'Nike'),
(5, 'Puma'),
(8, 'Sneakers'),
(4, 'Vans'),
(7, 'Yonson');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usu_nombre` varchar(50) NOT NULL,
  `usu_correo` varchar(50) DEFAULT NULL,
  `usu_direccion` tinytext DEFAULT NULL,
  `usu_password` varchar(255) NOT NULL DEFAULT 'error',
  `palabra_secreta` varchar(255) NOT NULL,
  `usu_admin` int(11) NOT NULL DEFAULT 1 COMMENT '0=admin 1=cliente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usu_nombre`, `usu_correo`, `usu_direccion`, `usu_password`, `palabra_secreta`, `usu_admin`) VALUES
(15, 'yulai12', 'yulai12@gmail.com', 'la casa mia ', '$2y$10$PR47lAZ0qUA.sH0BcW8S3uzIVzOOmwsO4.YwCzjGYfQfW.KR2J5xK', '', 1),
(16, '4dm1n', 'admindrurban@gmail.com', 'sin direccion', '$2y$10$CfZJCAq2rILHbBZcBef1u.L7x5BYysYoazgAOSMOiA/1WfYDWQO8u', '', 0),
(17, 'fabialvajr05', 'fabialvajr@gmail.com', 'Av, Delicias. Edif, Karina.', '$2y$10$MyHQmopsgHfyNdhWsOJNZOBTwVRQgDTJHK.BJjkLNraIl.aWiMW62', '', 1),
(18, 'worded05', 'worded05@gmail.com', 'xs', '$2y$10$5bm10Ydeuz0xyVGd3hIgyO.JM8oCguqvQX3ieFawORyOrOE3Lv3G2', '$2y$10$I7JYQg2pKRhKJw1s91YftuS.GRkoSF7DC5Pn78PZwdYDmBw2oMRVC', 1),
(19, 'derek50', 'derek50@gmail.com', 'sin direccion', '$2y$10$qOzUMRjAO24oQPndj5xi1OQXlkIYOvFEfkbdpjAzWJ46gFF8LcEGK', '$2y$10$7q6kGNPMSwSXrDxCMOc4wuAnzpranOnzjaYfTzwUbW0pTRaz2cXz6', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `cat_nombre` (`cat_nombre`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`met_tipo`),
  ADD UNIQUE KEY `id_metodo` (`id_metodo`),
  ADD KEY `met_tipo` (`met_tipo`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `pag_metodo` (`pag_metodo`),
  ADD KEY `pag_cliente` (`pag_cliente`),
  ADD KEY `pag_codigo` (`pag_codigo`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `pedi_cliente` (`pedi_cliente`),
  ADD KEY `pedi_codigo` (`pedi_codigo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `produc_id_categoria` (`produc_id_categoria`) USING BTREE,
  ADD KEY `produc_proveedor` (`produc_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `prov_nombreempresa` (`prov_nombreempresa`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `usu_nombre` (`usu_nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_metodo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`pag_metodo`) REFERENCES `metodo_pago` (`met_tipo`),
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`pag_cliente`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`pedi_cliente`) REFERENCES `usuario` (`usu_nombre`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`produc_id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
