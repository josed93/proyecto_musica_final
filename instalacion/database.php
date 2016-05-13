<?php
$connection->query("CREATE TABLE IF NOT EXISTS `AUTOR` (
  `COD_AUTOR` int(6) NOT NULL AUTO_INCREMENT,
  `NOMBRE_A` varchar(50) DEFAULT NULL,
  `FECHA_NAC` date DEFAULT NULL,
  PRIMARY KEY (`COD_AUTOR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;
");

  //$connection->query();

  $connection->query("INSERT INTO `AUTOR` (`COD_AUTOR`, `NOMBRE_A`, `FECHA_NAC`) VALUES
(1, 'David Bowie', '1947-01-08'),
(2, 'Adele', '1988-05-05'),
(3, 'Manuel Carrasco', '1981-01-15'),
(4, 'Malu', '1982-03-15'),
(5, 'Alejandro Sanz', '1968-12-18'),
(6, 'ACDC', '2016-03-09'),
(7, 'Breaking Benjamin', '2016-03-23'),
(8, 'DeadMau5', '2016-03-21'),
(9, 'Skrillex', '2016-03-06'),
(10, 'Linking Park', '2016-04-03');");

    $connection->query("CREATE TABLE IF NOT EXISTS `CANCION` (
  `COD_CANCION` int(6) NOT NULL AUTO_INCREMENT,
  `TITULO_C` varchar(50) DEFAULT NULL,
  `DURACION` varchar(20) DEFAULT NULL,
  `COD_DISCO` int(6) DEFAULT NULL,
  PRIMARY KEY (`COD_CANCION`),
  KEY `FK_COD_DISCO2` (`COD_DISCO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;");

    $connection->query("INSERT INTO `CANCION` (`COD_CANCION`, `TITULO_C`, `DURACION`, `COD_DISCO`) VALUES
(1, 'Blackstar', '9:57', 1),
(2, 'Tis a Pity She Was a Whore', '4:52', 1),
(3, 'Lazarus', '6:22', 1),
(4, 'Sue (Or in a Season of Crime) ', '4:40', 1),
(5, 'Girl Loves Me', '4:51', 1),
(6, 'Dollar Days', '4:44', 1),
(7, 'I Can''t Give Everything Away', '5:47', 1),
(8, 'Hello', '4:55', 2),
(9, 'Send My Love (To Your New Lover)', '3:43', 2),
(10, 'I Miss You', '5:48', 2),
(11, 'When We Were Young', '4:50', 2),
(12, 'Remedy', '4:05', 2),
(13, 'Water Under The Bridge', '4:00', 2),
(14, 'River Lea', '3:45', 2),
(15, 'Love In The Dark', '4:46', 2),
(16, 'Million Years Ago', '3:47', 2),
(17, 'All I Ask', '4:31', 2),
(18, 'Sweetest Devotion', '4:11', 2),
(19, 'Can’t Let Go', '3:18', 2),
(20, 'Lay Me Down', '4:30', 2),
(21, 'Why Do You Love Me', '3:59', 2),
(23, 'Tambores de guerra', '4:10', 3),
(24, 'Bailar el viento', '4:37', 3),
(25, 'Ya no', '3:46', 3),
(26, 'Siendo uno mismo', '5:16', 3),
(27, 'Uno X uno', '3:49', 3),
(28, 'Pequeña sonrisa sonora', '4:04', 3),
(29, 'Yo quiero vivir', '4:03', 3),
(30, 'Amor planetario', '4:10', 3),
(31, 'La voz de dentro', '4:07', 3),
(32, 'No tengo prisa', '3:18', 3),
(33, 'Y ahora lo sé', '3:48', 3),
(34, 'Pájaro sin vuelo', '5:01', 3),
(35, 'Libre', '4:08', 3),
(36, 'Quiero', '3:40', 4),
(37, 'SÃ­gueme el Juego', '3:34', 4),
(38, 'Cenizas', '4:05', 4),
(39, 'Nos Sobra la Ropa', '3:29', 4),
(40, 'Parte de Mi', '3:49', 4),
(41, 'Encadenada a Ti', '3:16', 4),
(42, 'Me Despido', '3:44', 4),
(43, 'Caos', '3:22', 4),
(44, 'De Vez en Cuando', '3:45', 4),
(45, 'Imperfectos', '3:22', 4),
(46, 'Rozando el Cielo', '3:23', 4),
(47, 'Mi Mundo en el Aire', '4:06', 4),
(48, 'A Mi No Me Importa', '3:10', 5),
(49, 'Capitan Tapon', '4:42', 5),
(50, 'Pero Tu', '4:42', 5),
(51, 'La Guarida Del Calor', '3:48', 5),
(52, 'Tu La Necesitas', '4:11', 5),
(53, 'Un Zombie A La Intemperie', '5:01', 5),
(54, 'Todo Huele A Ti', '4:20', 5),
(55, 'No Madura El Coco', '5:01', 5),
(56, 'La Vida Que Respira', '4:48', 5),
(57, 'Suena La Pelota (feat. Juan Luis Guerra)', '4:04', 5),
(58, 'A Que No Me Dejas', '5:11', 5),
(59, 'El Silencio De Los Cuervos', '4:34', 5),
(60, 'El Club De La Verdad', '5:20', 5),
(62, 'black', '9', 21),
(63, 'Diary of jane', '4.58', 22),
(64, 'bangaran', '3.47', 23),
(65, 'Pigs', '8.12', 24),
(66, 'In the end', '4.24', 25);");

    $connection->query("CREATE TABLE IF NOT EXISTS `CESTA` (
  `COD_USU` int(6) DEFAULT NULL,
  `COD_DISCO` int(6) DEFAULT NULL,
  `CANTIDAD` int(8) DEFAULT NULL,
  `PRECIO_UNITARIO` double(9,2) DEFAULT NULL,
  KEY `FK_COD_USU1` (`COD_USU`),
  KEY `FK_COD_DISCO4` (`COD_DISCO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $connection->query("INSERT INTO `CESTA` (`COD_USU`, `COD_DISCO`, `CANTIDAD`, `PRECIO_UNITARIO`) VALUES
(14, 3, 1, 0.00);");


    $connection->query("CREATE TABLE IF NOT EXISTS `DISCO` (
  `COD_DISCO` int(6) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(50) DEFAULT NULL,
  `GENERO` varchar(30) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `CARATULA` varchar(200) DEFAULT NULL,
  `CANTIDAD` int(10) DEFAULT NULL,
  `PRECIO` double(9,2) DEFAULT NULL,
  `COD_DISCOGRA` int(6) DEFAULT NULL,
  `COD_AUTOR` int(6) DEFAULT NULL,
  PRIMARY KEY (`COD_DISCO`),
  KEY `FK_COD_DISCOGRA` (`COD_DISCOGRA`),
  KEY `FK_COD_AUTOR` (`COD_AUTOR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;");

    $connection->query("INSERT INTO `DISCO` (`COD_DISCO`, `TITULO`, `GENERO`, `FECHA`, `CARATULA`, `CANTIDAD`, `PRECIO`, `COD_DISCOGRA`, `COD_AUTOR`) VALUES
(1, 'Blackstar', 'Rock', '2016-01-08', 'blackstar.jpg', 30, 14.99, 1, 1),
(2, '25', 'Pop', '2015-10-20', 'adele25.jpg', 40, 14.99, 2, 2),
(3, 'Bailar el viento', 'Pop', '2015-10-30', 'manuel.jpg', 50, 7.99, 2, 3),
(4, 'Caos', 'Pop', '2015-10-25', 'malu.jpg', 40, 9.99, 3, 4),
(5, 'Sirope', 'Pop', '2015-05-04', 'alejandro.jpg', 30, 14.99, 3, 5),
(21, 'Black', 'Rock', '2016-03-17', 'acdc.jpg', 20, 20.00, 5, 6),
(22, 'Dear Agony', 'Rock', '2016-03-19', 'breakin.jpg', 42, 17.99, 3, 7),
(23, 'Skrillex2', 'Electronica', '2016-03-06', 'skrillex.jpg', 45, 7.99, 2, 9),
(24, 'Dead', 'Electronica', '2016-03-11', 'dead.jpg', 10, 19.99, 1, 8),
(25, 'Minutes to Midnight', 'Rock', '2016-03-16', 'limk.jpg', 65, 5.00, 3, 10);
    ");

    $connection->query("CREATE TABLE IF NOT EXISTS `DISCOGRAFICA` (
  `COD_DISCOGRA` int(6) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `FUNDACION` int(4) DEFAULT NULL,
  `PAGINA_WEB` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`COD_DISCOGRA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;");

    $connection->query("INSERT INTO `DISCOGRAFICA` (`COD_DISCOGRA`, `NOMBRE`, `FUNDACION`, `PAGINA_WEB`) VALUES
(1, 'EMI Records', 1972, 'http://www.virginemirecords.com/'),
(2, 'Sony Music Entertainment', 1887, 'http://www.sonymusic.com'),
(3, 'Universal Music Group', 1995, 'http://www.universalmusic.com/'),
(4, 'Warner Bros. Records', 1958, 'http://www.warnerbrosrecords.com/'),
(5, 'Warner Music Group', 1929, 'http://www.wmg.com');");

    $connection->query("CREATE TABLE IF NOT EXISTS `LINEA_PEDIDO` (
  `COD_LINEA` int(6) NOT NULL AUTO_INCREMENT,
  `COD_PEDIDO` int(6) DEFAULT NULL,
  `COD_DISCO` int(6) DEFAULT NULL,
  `CANTIDAD` int(6) DEFAULT NULL,
  PRIMARY KEY (`COD_LINEA`),
  KEY `FK_COD_PED` (`COD_PEDIDO`),
  KEY `FK_COD_DISCO` (`COD_DISCO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;");

    $connection->query("INSERT INTO `LINEA_PEDIDO` (`COD_LINEA`, `COD_PEDIDO`, `COD_DISCO`, `CANTIDAD`) VALUES
(1, 1, 2, 2),
(2, 1, 4, 2),
(3, 2, 4, 1),
(4, 3, 5, 1),
(5, 4, 3, 1),
(6, 5, 3, 3),
(7, 6, 25, 3),
(8, 7, 25, 3),
(9, 8, 21, 4);");

    $connection->query("CREATE TABLE IF NOT EXISTS `PEDIDO` (
  `COD_PEDIDO` int(6) NOT NULL AUTO_INCREMENT,
  `COD_USU` int(6) DEFAULT NULL,
  `FECHA_PED` date DEFAULT NULL,
  `IMPORTE` double(9,2) DEFAULT NULL,
  PRIMARY KEY (`COD_PEDIDO`),
  KEY `FK_COD_USU` (`COD_USU`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;");

    $connection->query("INSERT INTO `PEDIDO` (`COD_PEDIDO`, `COD_USU`, `FECHA_PED`, `IMPORTE`) VALUES
(1, 8, '2016-03-01', 49.96),
(2, 13, '2016-03-01', 9.99),
(3, 11, '2016-03-01', 14.99),
(4, 8, '2016-03-01', 7.99),
(5, 8, '2016-03-01', 23.97),
(6, 8, '2016-03-01', 15.00),
(7, 8, '2016-03-01', 15.00),
(8, 8, '2016-03-01', 80.00);
");

    $connection->query("CREATE TABLE IF NOT EXISTS `USUARIO` (
  `COD_USU` int(6) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(64) DEFAULT NULL,
  `ROL` varchar(30) DEFAULT NULL,
  `ESTADO` varchar(20) DEFAULT NULL,
  `DNI` varchar(9) DEFAULT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `APELLIDOS` varchar(100) DEFAULT NULL,
  `FECHA_NAC` date DEFAULT NULL,
  `DIRECCION` varchar(200) DEFAULT NULL,
  `TLF` int(9) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PROVINCIA` varchar(30) DEFAULT NULL,
  `LOCALIDAD` varchar(30) DEFAULT NULL,
  `PAIS` varchar(30) DEFAULT NULL,
  `STYLE` int(11) DEFAULT NULL,
  PRIMARY KEY (`COD_USU`),
  UNIQUE KEY `USERNAME` (`USERNAME`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;");

    $connection->query("INSERT INTO `USUARIO` (`COD_USU`, `USERNAME`, `PASSWORD`, `ROL`, `ESTADO`, `DNI`, `NOMBRE`, `APELLIDOS`, `FECHA_NAC`, `DIRECCION`, `TLF`, `EMAIL`, `PROVINCIA`, `LOCALIDAD`, `PAIS`, `STYLE`) VALUES
(1, 'josed', '1c2c02d3a8a758f49ed17585ad5c5f54', 'admin', 'activo', '53930055T', 'Jose Daniel', 'de las Heras Diaz', '1993-03-08', 'Corral del Conde NÂº6', 655599239, 'jose_d.93@hotmail.com', 'Sevilla', 'Gerena', 'EspaÃ±a', 0),
(8, 'carol', 'a9a0198010a6073db96434f6cc5f22a8', 'user', 'activo', '20503311F', 'Carolyne', 'Fernandez', '1996-03-11', 'Granada', 659845213, 'carolyne.nicolle@hotmail.com', 'Sevilla', 'Sevilla', 'Peru', 3),
(11, 'japon', '7cb51895c351c3b0e2afbbda27e873a2', 'user', 'activo', '77824418P', 'Juan Antonio', 'Japon de la Torre', '1991-02-03', 'C/ Clara de JesÃºs Montero NÂº28 2ÂºC 3', 634692434, 'juan.antonio.japon@gmail.com', 'Sevilla', 'Sevilla', 'EspaÃ±a', 0),
(13, 'malive', '5461c109c196f55f304d319a8931cf0f', 'user', 'activo', '58425836M', 'David', 'Romero Ballesta', '2016-01-13', 'Manzanares', 965524524, 'malive@gmail.com', 'Sevilla', 'San Juan', 'Spain', 0),
(14, 'merino', 'e1d7f219c95107d105070afe198b3098', 'user', 'activo', '626266226', 'antonio', 'merino', '2016-01-02', 'bar pepe', 2147483647, 'merino@gmail.com', 'sevilla', 'camas', 'spain', 0),
(17, 'lebri', '8245157fc391870003c5e3de33706e60', 'admin', 'activo', NULL, 'lebri', 'lebri', NULL, NULL, NULL, 'lebri@hotmail.com', NULL, NULL, NULL, 0);");


    $connection->query("ALTER TABLE `CANCION`
  ADD CONSTRAINT `FK_COD_DISCO2` FOREIGN KEY (`COD_DISCO`) REFERENCES `DISCO` (`COD_DISCO`) ON DELETE CASCADE;");

    $connection->query("ALTER TABLE `CESTA`
  ADD CONSTRAINT `FK_COD_DISCO4` FOREIGN KEY (`COD_DISCO`) REFERENCES `DISCO` (`COD_DISCO`),
  ADD CONSTRAINT `FK_COD_USU1` FOREIGN KEY (`COD_USU`) REFERENCES `USUARIO` (`COD_USU`);");

    $connection->query("ALTER TABLE `DISCO`
  ADD CONSTRAINT `FK_COD_AUTOR` FOREIGN KEY (`COD_AUTOR`) REFERENCES `AUTOR` (`COD_AUTOR`),
  ADD CONSTRAINT `FK_COD_DISCOGRA` FOREIGN KEY (`COD_DISCOGRA`) REFERENCES `DISCOGRAFICA` (`COD_DISCOGRA`);");

    $connection->query("ALTER TABLE `LINEA_PEDIDO`
  ADD CONSTRAINT `FK_COD_DISCO` FOREIGN KEY (`COD_DISCO`) REFERENCES `DISCO` (`COD_DISCO`),
  ADD CONSTRAINT `FK_COD_PED` FOREIGN KEY (`COD_PEDIDO`) REFERENCES `PEDIDO` (`COD_PEDIDO`);");

    $connection->query("ALTER TABLE `PEDIDO`
  ADD CONSTRAINT `FK_COD_USU` FOREIGN KEY (`COD_USU`) REFERENCES `USUARIO` (`COD_USU`);");


 ?>
