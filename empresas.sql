-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 28-Set-2021 às 17:28
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `empresas`
--
CREATE DATABASE IF NOT EXISTS `empresas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `empresas`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dispositivo`
--

DROP TABLE IF EXISTS `dispositivo`;
CREATE TABLE IF NOT EXISTS `dispositivo`(
  `iddispositivo` int(11) NOT NULL AUTO_INCREMENT,
  `so` varchar(50) DEFAULT NULL,
  `datacriacao` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `fkusuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddispositivo`),
  KEY `fkusuario` (`fkusuario`)
);
--
-- Extraindo dados da tabela `dispositivo`
--

INSERT INTO `dispositivo` (`iddispositivo`, `so`, `datacriacao`, `token`, `fkusuario`) VALUES
(6, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '2021-09-28 14:22:35', '7635b4b8d148224e20168715902e24aa74c2cf091ca580954d7931da61c65469', 2),
(7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '2021-09-28 14:22:35', 'a0fed4bd3362279a8d884428af5af8fb6683033523df2d5a43f2e10c81506786', 2),
(8, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', '2021-09-28 14:25:37', 'bf54d11ec1d934f5e326ab6eb501359f6c464b38054698e14cfe87123799a02d', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas_parceiras`
--

DROP TABLE IF EXISTS `empresas_parceiras`;
CREATE TABLE IF NOT EXISTS `empresas_parceiras` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(50) NOT NULL,
  `cnpj_empresa` varchar(17) NOT NULL,
  `cidade_empresa` varchar(50) NOT NULL,
  `endereco_emprego` varchar(40) NOT NULL,
  `estado_empresa` varchar(2) NOT NULL,
  PRIMARY KEY (`id_empresa`)
);

--
-- Extraindo dados da tabela `empresas_parceiras`
--

INSERT INTO `empresas_parceiras` (`id_empresa`, `nome_empresa`, `cnpj_empresa`, `cidade_empresa`, `endereco_emprego`, `estado_empresa`) VALUES
(15, 'FASD', 'FASD', 'FA', 'Rua Jos', 'RQ'),
(14, 'fad', 'fads', 'fasd', 'fads\'', 'fa'),
(16, 'FASD', 'FASD', 'FA', 'Rua Jos', 'RQ'),
(17, 'Gui', '012412', 'Ipero', 'rREfds', 'KF');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_ong`
--

DROP TABLE IF EXISTS `info_ong`;
CREATE TABLE IF NOT EXISTS `info_ong` (
  `id_ong` int(11) NOT NULL,
  `nome_dono` int(50) NOT NULL,
  `objetivo_ong` varchar(100) NOT NULL,
  PRIMARY KEY (`id_ong`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logo`
--

DROP TABLE IF EXISTS `logo`;
CREATE TABLE IF NOT EXISTS `logo` (
  `id_logo` int(11) NOT NULL,
  `logo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_logo`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ongs_parceiras`
--

DROP TABLE IF EXISTS `ongs_parceiras`;
CREATE TABLE IF NOT EXISTS `ongs_parceiras` (
  `id_ong` int(11) NOT NULL,
  `nome_ong` varchar(50) NOT NULL,
  `cidade_ong` varchar(50) NOT NULL,
  `endereco_ong` varchar(40) NOT NULL,
  `estado_ong` varchar(2) NOT NULL,
  PRIMARY KEY (`id_ong`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
);

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `senha`) VALUES
(2, 'Guilherme', 'guilherme@email.com', '$2y$10$JoCa9W.nFJf.rCcrvAWXFOSObQOwRXX4Vyx9tYMh3PqgCifSdKsIi');
