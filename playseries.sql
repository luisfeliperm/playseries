-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 31/07/2018 às 01:38
-- Versão do servidor: 5.7.23-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.8-1+ubuntu18.04.1+deb.sury.org+1

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
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `admin`
--

INSERT INTO `admin` (`id`, `email`, `pass`, `nivel`) VALUES
(1, 'luisfelipepoint@gmail.com', 'admin123', 2),
(5, 'joaovitorrodrigues988@gmail.com', 'admvitor', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `eps`
--

CREATE TABLE `eps` (
  `id` int(11) NOT NULL,
  `identificador` varchar(100) NOT NULL,
  `temporada` int(5) NOT NULL,
  `ep` int(5) NOT NULL,
  `poster` varchar(500) NOT NULL,
  `src_1` varchar(700) NOT NULL,
  `nome_2` varchar(60) NOT NULL,
  `src_2` varchar(700) NOT NULL,
  `nome_3` varchar(60) NOT NULL,
  `src_3` varchar(700) NOT NULL,
  `data` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `identificador` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `info` varchar(400) NOT NULL,
  `sinopse` varchar(700) NOT NULL,
  `miniatura` varchar(1000) NOT NULL,
  `background` varchar(1000) NOT NULL,
  `tags` varchar(160) NOT NULL,
  `cat1` varchar(40) NOT NULL,
  `cat2` varchar(40) NOT NULL,
  `cat3` varchar(40) NOT NULL,
  `cat4` varchar(40) NOT NULL,
  `viwer` int(11) NOT NULL DEFAULT '0',
  `data` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `series`
--

INSERT INTO `series` (`id`, `identificador`, `nome`, `info`, `sinopse`, `miniatura`, `background`, `tags`, `cat1`, `cat2`, `cat3`, `cat4`, `viwer`, `data`) VALUES
(2, 'prison-break', 'Prison Break', 'data=2005 tempo=42min qualy=720p', 'Após a prisão de Lincoln Burrows (Dominic Purcell), condenado por um crime que não cometeu, o engenheiro Michael Scofield (Wentworth Miller) bola um plano para tirar o irmão da cadeia. Enviado para Fox River ao lado de Lincoln, Michael começa a executar a sua estratégia, mas logo percebe que está no meio de uma perigosa conspiração. Para garantir a liberdade da sua família, ele precisará enganar a Dra. Sara Tancredi (Sarah Wayne Callies) e se associar a criminosos condenados, como Fernando Sucre (Amaury Nolasco), Theodore \'T-Bag\' Bagwell (Robert Knepper) e John Abruzzi (Peter Stormare).', 'https://i.imgur.com/v3WyFbA.jpg', 'https://canecasdosnerds.com.br/blog/wp-content/uploads/2016/11/prison-break.jpg', 'PB, prison break,fox river,melhor serie,wentworth miller,em busca da verdade,prisao,cadeia', 'drama', 'suspense', 'acao', '', 4, '31-07-2018 00:04:41'),
(3, 'stranger-things', 'Stranger Things', 'data=2016 tempo=55min qualy=720p', 'Long Island, 1983. Um garoto de 12 anos desaparece misteriosamente. A família e a polícia procuram respostas, mas acabam se deparando com um experimento secreto do governo. Enquanto isso, os amigos do menino iniciam suas próprias investigações, o que os levam a um extraordinário mistério envolvendo forças sobrenaturais e uma garotinha muito, muito estranha.', 'https://i.imgur.com/vg7d6t1.jpg', 'https://conteudo.imguol.com.br/c/entretenimento/2e/2016/07/26/cena-da-serie-stranger-things-2016-1469567164429_1920x960.jpg', 'stranger things,st,eleven,coisas estranhas', 'drama', 'suspense', '', '', 1, '30-07-2018 23:58:59'),
(4, 'the-walking-dead', 'The Walking Dead', 'data=2010 tempo=44min qualy=720p', 'Um apocalipse provoca uma infestação de zumbis na cidade de Cynthiana, em Kentucky, nos Estados Unidos, e o oficial de polícia Rick Grimes (Andrew Lincoln) descobre que os mortos-vivos estão se propagando progressivamente. Ele decide unir-se aos homens e mulheres sobreviventes para que tenham mais força para combater o fenômeno que os atinge. O grupo percorre diferentes lugares em busca de soluções para o problema.', 'http://i.imgur.com/bkA6I9H.jpg', 'https://discourse-cdn-sjc1.com/gearbox/uploads/default/863/c19c8b7927e630f7.jpg', 'twd,the walking dead,zumbi,apocalipse,mortos vivos', 'terror', 'suspense', 'drama', '', 1, '30-07-2018 23:58:59'),
(5, 'game-of-thrones', 'Game of Thrones', 'data=2011 tempo=52min qualy=720p', 'Há muito tempo, em um tempo esquecido, uma força destruiu o equilíbrio das estações. Em uma terra onde os verões podem durar vários anos e o inverno toda uma vida, as reivindicações e as forças sobrenaturais correm as portas do Reino dos Sete Reinos. A irmandade da Patrulha da Noite busca proteger o reino de cada criatura que pode vir de lá da Muralha, mas já não tem os recursos necessários para garantir a segurança de todos. Depois de um verão de dez anos, um inverno rigoroso promete chegar com um futuro mais sombrio. Enquanto isso, conspirações e rivalidades correm no jogo político pela disputa do Trono de Ferro, o símbolo do poder absoluto.', 'https://i.imgur.com/z0uvObC.png', 'http://br.web.img1.acsta.net/cx_980_340/seriesposter/7157/poster_large.jpg', 'game of thrones,GOT', 'drama', '', '', '', 2, '30-07-2018 23:58:59'),
(6, 'rick-and-morty', 'Rick And Morty', 'data=2014 tempo=22min qualy=720p', 'Uma série animada que acompanha as aventuras e os descobrimentos de um super cientista e seu neto não muito brilhante.', 'https://i.imgur.com/EULZfNe.jpg', 'http://br.web.img1.acsta.net/cx_980_340/seriesposter/11561/poster_large.jpg', 'rick and morty,RAM,viagem no tempo,desenho', 'ficcao', 'desenho', 'aventura', 'comedia', 103, '31-07-2018 01:33:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `views`
--

INSERT INTO `views` (`id`, `total`) VALUES
(1, '11');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `eps`
--
ALTER TABLE `eps`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `eps`
--
ALTER TABLE `eps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
