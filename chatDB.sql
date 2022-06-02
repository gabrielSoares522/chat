SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `chat`;
CREATE DATABASE `chat`;
USE `chat`;


DROP TABLE IF EXISTS `contatos`;
CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_conversa` int(11) NOT NULL,
  `nm_contato` varchar(255) COLLATE utf8_bin NOT NULL,
  `dt_visualizacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `conversa`;
CREATE TABLE `conversa` (
  `id` int(11) NOT NULL,
  `dt_criacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `mensagem`;
CREATE TABLE `mensagem` (
  `id` int(11) NOT NULL,
  `id_conversa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `dt_envio` datetime NOT NULL,
  `ds_mensagem` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nm_login` varchar(255) COLLATE utf8_bin NOT NULL,
  `nm_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `nm_senha` varchar(32) COLLATE utf8_bin NOT NULL,
  `nm_foto` varchar(200) COLLATE utf8_bin NOT NULL,
  `fotoPerfil` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contato_usuario` (`id_usuario`),
  ADD KEY `fk_contato_conversa` (`id_conversa`);

ALTER TABLE `conversa`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mensagem_conversa` (`id_conversa`),
  ADD KEY `fk_mensagem_usuario` (`id_usuario`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `conversa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `mensagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `contatos`
  ADD CONSTRAINT `fk_contato_conversa` FOREIGN KEY (`id_conversa`) REFERENCES `conversa` (`id`),
  ADD CONSTRAINT `fk_contato_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

ALTER TABLE `mensagem`
  ADD CONSTRAINT `fk_mensagem_conversa` FOREIGN KEY (`id_conversa`) REFERENCES `conversa` (`id`),
  ADD CONSTRAINT `fk_mensagem_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;