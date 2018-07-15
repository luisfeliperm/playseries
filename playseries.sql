-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 14/07/2018 às 22:17
-- Versão do servidor: 5.7.22-0ubuntu18.04.1
-- Versão do PHP: 7.2.7-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `playseries`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `info` varchar(400) NOT NULL,
  `sinopse` varchar(500) NOT NULL,
  `miniatura` varchar(1000) NOT NULL,
  `background` varchar(1000) NOT NULL,
  `tags` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `series`
--

INSERT INTO `series` (`id`, `titulo`, `info`, `sinopse`, `miniatura`, `background`, `tags`) VALUES
(1, 'Stranger Things', 'data=2016 tempo=55min cat=Drama,_Fantasia,_Suspense qualy=720p', 'Long Island, 1983. Um garoto de 12 anos desaparece misteriosamente. A família e a polícia procuram respostas, mas acabam se deparando com um experimento secreto do governo. Enquanto isso, os amigos do menino iniciam suas próprias investigações, o que os levam a um extraordinário mistério envolvendo forças sobrenaturais e uma garotinha muito, muito estranha.', 'http://s1.1zoom.me/big0/317/Winona_Ryder_Men_Stranger_Things_Millie_Bobby_524805_682x1024.jpg', 'https://conteudo.imguol.com.br/c/entretenimento/2e/2016/07/26/cena-da-serie-stranger-things-2016-1469567164429_1920x960.jpg', 'stranger things,st'),
(2, 'The Walking Dead', 'data=2010 tempo=44min cat=Drama,_Terror qualy=720p', 'Um apocalipse provoca uma infestação de zumbis na cidade de Cynthiana, em Kentucky, nos Estados Unidos, e o oficial de polícia Rick Grimes (Andrew Lincoln) descobre que os mortos-vivos estão se propagando progressivamente. Ele decide unir-se aos homens e mulheres sobreviventes para que tenham mais força para combater o fenômeno que os atinge. O grupo percorre diferentes lugares em busca de soluções para o problema.', 'http://i.imgur.com/bkA6I9H.jpg', 'https://discourse-cdn-sjc1.com/gearbox/uploads/default/863/c19c8b7927e630f7.jpg', 'twd,the walking dead,zumbi');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
