-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Maio-2021 às 05:08
-- Versão do servidor: 10.1.40-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+04:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_lorem-ipsum`
--
CREATE DATABASE IF NOT EXISTS `sistema_lorem-ipsum` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sistema_lorem-ipsum`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

CREATE TABLE `equipe` (
  `id_equipe` int(11) NOT NULL COMMENT 'Id da equipe (inteiro)',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro (data)',
  `fk_id_projeto` int(11) NOT NULL COMMENT 'Id do projeto da tabela projeto',
  `fk_id_participante` int(11) NOT NULL COMMENT 'Id do participante da tabela participante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `participante`
--

CREATE TABLE `participante` (
  `id_participante` int(11) NOT NULL COMMENT 'Id do participante (inteiro)',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro (data)',
  `nome_participante` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Nome do participante (texto) ',
  `cargo` varchar(30) CHARACTER SET latin1 NOT NULL COMMENT 'Cargo do participante (texto)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `id_projeto` int(11) NOT NULL COMMENT 'Id do projeto',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro',
  `nome_projeto` varchar(60) CHARACTER SET latin1 NOT NULL COMMENT 'Nome do projeto',
  `data_inicio` date NOT NULL COMMENT 'Data de início',
  `data_termino` date NOT NULL COMMENT 'Data de término',
  `valor_projeto` double(20,2) NOT NULL COMMENT 'Valor do projeto',
  `risco` int(11) NOT NULL COMMENT 'Podendo ser: 0 - baixo, 1 - médio, 2 – alto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `Equipe contem participante` (`fk_id_participante`),
  ADD KEY `Equipe contem projeto` (`fk_id_projeto`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id_participante`);

--
-- Indexes for table `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`id_projeto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id da equipe (inteiro)';

--
-- AUTO_INCREMENT for table `participante`
--
ALTER TABLE `participante`
  MODIFY `id_participante` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do participante (inteiro)';

--
-- AUTO_INCREMENT for table `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do projeto';

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `Equipe contem participante` FOREIGN KEY (`fk_id_participante`) REFERENCES `participante` (`id_participante`),
  ADD CONSTRAINT `Equipe contem projeto` FOREIGN KEY (`fk_id_projeto`) REFERENCES `projeto` (`id_projeto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
