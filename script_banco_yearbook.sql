-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.20 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para daw_yearbook
CREATE DATABASE IF NOT EXISTS `daw_yearbook` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `daw_yearbook`;


-- Copiando estrutura para tabela daw_yearbook.cidades
CREATE TABLE IF NOT EXISTS `cidades` (
  `idCidade` int(11) NOT NULL AUTO_INCREMENT,
  `idEstado` int(11) NOT NULL,
  `nomeCidade` varchar(70) NOT NULL,
  PRIMARY KEY (`idCidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela daw_yearbook.contatos
CREATE TABLE IF NOT EXISTS `contatos` (
  `nomeUsuario` varchar(10) NOT NULL,
  `nomeContato` varchar(50) NOT NULL,
  `emailContato` varchar(50) NOT NULL,
  `telContato` varchar(10) NOT NULL,
  PRIMARY KEY (`nomeUsuario`,`nomeContato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela daw_yearbook.estados
CREATE TABLE IF NOT EXISTS `estados` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `sigaEstado` char(2) NOT NULL,
  `nomeEstado` varchar(50) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela daw_yearbook.participantes
CREATE TABLE IF NOT EXISTS `participantes` (
  `login` varchar(20) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nomeCompleto` varchar(50) NOT NULL,
  `arquivoFoto` varchar(100) NOT NULL,
  `cidade` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela daw_yearbook.users
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela daw_yearbook.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `nomeUsuario` varchar(10) NOT NULL,
  `nomeCompleto` varchar(50) NOT NULL,
  `passwordUsuario` varchar(40) NOT NULL,
  PRIMARY KEY (`nomeUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
