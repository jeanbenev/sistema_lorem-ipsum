-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Maio-2021 às 05:13
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
USE `sistema_lorem-ipsum`;

--
-- Extraindo dados da tabela `participante`
--

INSERT INTO `participante` (`id_participante`, `data_cadastro`, `nome_participante`, `cargo`) VALUES
(1, '2021-05-03 03:10:55', 'Participante 1', 'Gerente de Projetos'),
(2, '2021-05-03 03:11:09', 'Participante 2', 'Gestor de Trafego'),
(3, '2021-05-03 03:11:20', 'Participante 3', 'Programador Web'),
(4, '2021-05-03 03:11:30', 'Participante 4', 'Programador Desktop'),
(5, '2021-05-03 03:11:40', 'Participante 5', 'Designer');

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`id_projeto`, `data_cadastro`, `nome_projeto`, `data_inicio`, `data_termino`, `valor_projeto`, `risco`) VALUES
(1, '2021-05-03 03:12:32', 'Projeto 1', '2021-05-01', '2021-05-29', 1000.00, 0),
(2, '2021-05-03 03:12:45', 'Projeto 2', '2021-05-01', '2021-05-31', 1000.00, 1),
(3, '2021-05-03 03:12:57', 'Projeto 3', '2021-05-01', '2021-05-31', 1000.00, 2);

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `data_cadastro`, `fk_id_projeto`, `fk_id_participante`) VALUES
(1, '2021-05-03 03:12:32', 1, 1),
(2, '2021-05-03 03:12:32', 1, 2),
(3, '2021-05-03 03:12:32', 1, 3),
(4, '2021-05-03 03:12:32', 1, 4),
(5, '2021-05-03 03:12:32', 1, 5),
(6, '2021-05-03 03:12:45', 2, 1),
(7, '2021-05-03 03:12:45', 2, 2),
(8, '2021-05-03 03:12:45', 2, 3),
(9, '2021-05-03 03:12:45', 2, 4),
(10, '2021-05-03 03:12:45', 2, 5),
(11, '2021-05-03 03:12:57', 3, 1),
(12, '2021-05-03 03:12:57', 3, 2),
(13, '2021-05-03 03:12:57', 3, 3),
(14, '2021-05-03 03:12:57', 3, 4),
(15, '2021-05-03 03:12:57', 3, 5);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
