-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2020 at 09:44 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_conversa` int(11) NOT NULL,
  `nm_contato` varchar(255) COLLATE utf8_bin NOT NULL,
  `dt_visualizacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `conversa`
--

CREATE TABLE `conversa` (
  `id` int(11) NOT NULL,
  `dt_criacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mensagem`
--

CREATE TABLE `mensagem` (
  `id` int(11) NOT NULL,
  `id_conversa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `dt_envio` datetime NOT NULL,
  `ds_mensagem` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nm_login` varchar(255) COLLATE utf8_bin NOT NULL,
  `nm_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `nm_senha` varchar(32) COLLATE utf8_bin NOT NULL,
  `nm_foto` varchar(200) COLLATE utf8_bin NOT NULL,
  `fotoPerfil` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contato_usuario` (`id_usuario`),
  ADD KEY `fk_contato_conversa` (`id_conversa`);

--
-- Indexes for table `conversa`
--
ALTER TABLE `conversa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mensagem_conversa` (`id_conversa`),
  ADD KEY `fk_mensagem_usuario` (`id_usuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `conversa`
--
ALTER TABLE `conversa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contatos`
--
ALTER TABLE `contatos`
  ADD CONSTRAINT `fk_contato_conversa` FOREIGN KEY (`id_conversa`) REFERENCES `conversa` (`id`),
  ADD CONSTRAINT `fk_contato_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `fk_mensagem_conversa` FOREIGN KEY (`id_conversa`) REFERENCES `conversa` (`id`),
  ADD CONSTRAINT `fk_mensagem_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
