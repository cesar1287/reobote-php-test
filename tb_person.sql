-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Ago-2017 às 01:54
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_reobote`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_person`
--

CREATE TABLE `tb_person` (
  `id_person` int(11) NOT NULL,
  `person_name` varchar(70) CHARACTER SET utf8 NOT NULL,
  `person_email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `person_birth` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_person`
--

INSERT INTO `tb_person` (`id_person`, `person_name`, `person_email`, `person_birth`) VALUES
(1, 'teste', 'teste@teste.com', '1994-12-12'),
(2, 'CÃ©sar', 'rasec1287@gmail.com', '1994-12-12'),
(3, 'CÃ©sar', 'rasec1287@gmail.com', '1994-12-12'),
(4, 'teste1', 'teste1@teste.com', '1222-12-12'),
(5, 'Tais rodrigues dos santos', 'rotais126@outlook.com', '1111-11-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_person`
--
ALTER TABLE `tb_person`
  ADD PRIMARY KEY (`id_person`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_person`
--
ALTER TABLE `tb_person`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
