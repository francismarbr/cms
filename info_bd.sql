-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 19, 2020 at 07:42 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemag`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner_slider`
--

DROP TABLE IF EXISTS `banner_slider`;
CREATE TABLE IF NOT EXISTS `banner_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `mostrar` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `galeria`
--

DROP TABLE IF EXISTS `galeria`;
CREATE TABLE IF NOT EXISTS `galeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `imagem_capa` varchar(120) DEFAULT NULL,
  `descricao` text,
  `alt_imagem_capa` varchar(100) DEFAULT NULL,
  `slug` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `imagens_galeria`
--

DROP TABLE IF EXISTS `imagens_galeria`;
CREATE TABLE IF NOT EXISTS `imagens_galeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_galeria` int(11) NOT NULL,
  `id_midia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `imagens_portfolio`
--

DROP TABLE IF EXISTS `imagens_portfolio`;
CREATE TABLE IF NOT EXISTS `imagens_portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_portfolio` int(11) NOT NULL,
  `id_midia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `imagens_produto`
--

DROP TABLE IF EXISTS `imagens_produto`;
CREATE TABLE IF NOT EXISTS `imagens_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `id_midia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `midia`
--

DROP TABLE IF EXISTS `midia`;
CREATE TABLE IF NOT EXISTS `midia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(80) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pagina`
--

DROP TABLE IF EXISTS `pagina`;
CREATE TABLE IF NOT EXISTS `pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `data` date DEFAULT NULL,
  `imagem` varchar(155) DEFAULT NULL,
  `conteudo` text NOT NULL,
  `autor` varchar(30) DEFAULT NULL,
  `tags` varchar(50) DEFAULT NULL,
  `palavra_chave` varchar(100) DEFAULT NULL,
  `alt_imagem_capa` varchar(80) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `views` int(11) DEFAULT NULL,
  `tipo` varchar(10) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `perfil_acesso`
--

DROP TABLE IF EXISTS `perfil_acesso`;
CREATE TABLE IF NOT EXISTS `perfil_acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(100) NOT NULL,
  `permissoes` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perfil_acesso`
--

INSERT INTO `perfil_acesso` (`id`, `nome`, `permissoes`) VALUES
(1, 'ADMINISTRADOR', '1,2,3,4,5,8,9,10,11,12,13,14,15,16,17');

-- --------------------------------------------------------

--
-- Table structure for table `permissao`
--

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE IF NOT EXISTS `permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissao`
--

INSERT INTO `permissao` (`id`, `nome`) VALUES
(1, 'gerenciar_permissoes'),
(2, 'gerenciar_perfil_acesso'),
(3, 'gerenciar_usuarios'),
(4, 'visualizar_clientes'),
(5, 'alterar_clientes'),
(8, 'consultar_pagina'),
(9, 'gerenciar_pagina'),
(10, 'gerenciar_categorias'),
(11, 'gerenciar_midias'),
(12, 'gerenciar_produto'),
(13, 'gerenciar_galeria'),
(14, 'gerenciar_portfolio'),
(15, 'gerenciar_banner'),
(16, 'gerenciar_profissional'),
(17, 'gerenciar_servico');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `imagem_capa` varchar(100) DEFAULT NULL,
  `descricao` text,
  `alt_imagem_capa` varchar(100) DEFAULT NULL,
  `slug` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `imagem_capa` varchar(150) DEFAULT NULL,
  `descricao` text,
  `preco` varchar(10) DEFAULT NULL,
  `alt_imagem_capa` varchar(40) DEFAULT NULL,
  `slug` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profissional`
--

DROP TABLE IF EXISTS `profissional`;
CREATE TABLE IF NOT EXISTS `profissional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `imagem_capa` varchar(100) DEFAULT NULL,
  `descricao` text,
  `alt_imagem_capa` varchar(100) DEFAULT NULL,
  `slug` varchar(120) NOT NULL,
  `cargo` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `servico`
--

DROP TABLE IF EXISTS `servico`;
CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `imagem_capa` varchar(100) DEFAULT NULL,
  `descricao` text,
  `alt_imagem_capa` varchar(80) DEFAULT NULL,
  `slug` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `email` varchar(80) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `perfil_acesso_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `login`, `senha`, `perfil_acesso_id`) VALUES
(1, 'Admin', 'admin@admin.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
