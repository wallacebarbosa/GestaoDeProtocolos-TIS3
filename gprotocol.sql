-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 21-Nov-2019 às 12:39
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gprotocol`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anexo`
--

DROP TABLE IF EXISTS `anexo`;
CREATE TABLE IF NOT EXISTS `anexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocolo_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocolo_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encaminhamento`
--

DROP TABLE IF EXISTS `encaminhamento`;
CREATE TABLE IF NOT EXISTS `encaminhamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocolo_id` int(11) DEFAULT NULL,
  `remetente_id` int(11) DEFAULT NULL,
  `dest_tipo` enum('SETOR','USUARIO') DEFAULT 'SETOR',
  `destinatario_id` int(11) DEFAULT NULL,
  `tipo` enum('ENCAMINHAR','REJEITAR','ACEITAR','CRIAR') DEFAULT 'CRIAR',
  `data` datetime DEFAULT NULL,
  `justificativa` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `protocolo`
--

DROP TABLE IF EXISTS `protocolo`;
CREATE TABLE IF NOT EXISTS `protocolo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(64) NOT NULL,
  `dataCriacao` datetime DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `setor_id` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

DROP TABLE IF EXISTS `setor`;
CREATE TABLE IF NOT EXISTS `setor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `unidade_id` int(11) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`id`, `nome`, `unidade_id`, `endereco`) VALUES
(1, 'Rouparia', 1, 'Concordia, Rua Itamacaraci 535'),
(2, 'Rouparia', 2, 'Concordia, Rua Itamacaraci 535'),
(3, 'Rouparia', 3, 'Concordia, Rua Itamacaraci 535'),
(4, 'Vacinacao', 1, 'Concordia, Rua Itamacaraci 535'),
(5, 'Vacinacao', 2, 'Concordia, Rua Itamacaraci 535'),
(6, 'Vacinacao', 3, 'Concordia, Rua Itamacaraci 535'),
(7, 'Alta Gerencia', 1, 'Concordia, Rua Itamacaraci 535'),
(8, 'Alta Gerencia', 2, 'Concordia, Rua Itamacaraci 535'),
(9, 'Alta Gerencia', 3, 'Concordia, Rua Itamacaraci 535');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade`
--

DROP TABLE IF EXISTS `unidade`;
CREATE TABLE IF NOT EXISTS `unidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `unidade`
--

INSERT INTO `unidade` (`id`, `nome`) VALUES
(1, 'Unidade Concordia'),
(2, 'Unidade Santa Luzia'),
(3, 'Unidade BH');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `cargo` varchar(32) NOT NULL,
  `setor_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `senha`, `email`, `telefone`, `cargo`, `setor_id`) VALUES
(1, 'admin', '1234', 'admin@gprotocol.com', '(31) 9 9999-9999', 'Administrador', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;