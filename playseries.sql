-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 22/07/2018 às 01:20
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
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `admin`
--

INSERT INTO `admin` (`id`, `email`, `user`, `pass`, `nivel`) VALUES
(1, 'luisfelipepoint@gmail.com', 'luisfeliperm', '22082000', 1);

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
  `src_principal` varchar(700) NOT NULL,
  `second_nome` varchar(60) NOT NULL,
  `src_second` varchar(700) NOT NULL,
  `terceiro_nome` varchar(60) NOT NULL,
  `src_terceiro` varchar(700) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `eps`
--

INSERT INTO `eps` (`id`, `identificador`, `temporada`, `ep`, `poster`, `src_principal`, `second_nome`, `src_second`, `terceiro_nome`, `src_terceiro`) VALUES
(4, 'rick-and-morty', 2, 2, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', '', '', '', ''),
(2, 'rick-and-morty', 1, 1, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', '', '', '', ''),
(3, 'rick-and-morty', 2, 1, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', '', '', '', ''),
(5, 'rick-and-morty', 3, 1, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', '', '', '', ''),
(6, 'rick-and-morty', 3, 2, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', '', '', '', ''),
(7, 'rick-and-morty', 3, 3, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://www.blogger.com/video-play.mp4?contentId=c99ced59867672ab', 'VidONs', 'https://openload.co/embed/Rl63D8L4UeQ', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `info` varchar(400) NOT NULL,
  `sinopse` varchar(700) NOT NULL,
  `miniatura` varchar(1000) NOT NULL,
  `background` varchar(1000) NOT NULL,
  `tags` varchar(300) NOT NULL,
  `cat1` varchar(40) NOT NULL,
  `cat2` varchar(40) NOT NULL,
  `cat3` varchar(40) NOT NULL,
  `cat4` varchar(40) NOT NULL,
  `viwer` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `series`
--

INSERT INTO `series` (`id`, `nome`, `titulo`, `info`, `sinopse`, `miniatura`, `background`, `tags`, `cat1`, `cat2`, `cat3`, `cat4`, `viwer`) VALUES
(1, 'stranger-things', 'Stranger Things', 'data=2016 tempo=55min qualy=720p', 'Long Island, 1983. Um garoto de 12 anos desaparece misteriosamente. A família e a polícia procuram respostas, mas acabam se deparando com um experimento secreto do governo. Enquanto isso, os amigos do menino iniciam suas próprias investigações, o que os levam a um extraordinário mistério envolvendo forças sobrenaturais e uma garotinha muito, muito estranha.', 'http://s1.1zoom.me/big0/317/Winona_Ryder_Men_Stranger_Things_Millie_Bobby_524805_682x1024.jpg', 'https://conteudo.imguol.com.br/c/entretenimento/2e/2016/07/26/cena-da-serie-stranger-things-2016-1469567164429_1920x960.jpg', 'stranger things,st,eleven,coisas estranhas', 'terror', 'suspense', 'drama', '', 353),
(2, 'the-walking-dead', 'The Walking Dead', 'data=2010 tempo=44min qualy=720p', 'Um apocalipse provoca uma infestação de zumbis na cidade de Cynthiana, em Kentucky, nos Estados Unidos, e o oficial de polícia Rick Grimes (Andrew Lincoln) descobre que os mortos-vivos estão se propagando progressivamente. Ele decide unir-se aos homens e mulheres sobreviventes para que tenham mais força para combater o fenômeno que os atinge. O grupo percorre diferentes lugares em busca de soluções para o problema.', 'http://i.imgur.com/bkA6I9H.jpg', 'https://discourse-cdn-sjc1.com/gearbox/uploads/default/863/c19c8b7927e630f7.jpg', 'twd,the walking dead,zumbi,apocalipse,mortos vivos', 'drama', 'terror', '', '', 364),
(3, 'rick-and-morty', 'Rick and Morty', 'data=2010 tempo=44min qualy=720p', 'Uma série animada que acompanha as aventuras e os descobrimentos de um super cientista e seu neto não muito brilhante.', 'https://images-na.ssl-images-amazon.com/images/I/61rFf3FHRcL.jpg', 'http://br.web.img1.acsta.net/cx_980_340/seriesposter/11561/poster_large.jpg', 'ram,Rick and Morty,desenho,ficção ciêntifica,viajem no tempo,', 'ficcao', 'comedia', 'desenho', 'aventura', 1791),
(4, 'game-of-thrones', 'Game of Thrones', 'data=2011 tempo=52min qualy=720p', 'Há muito tempo, em um tempo esquecido, uma força destruiu o equilíbrio das estações. Em uma terra onde os verões podem durar vários anos e o inverno toda uma vida, as reivindicações e as forças sobrenaturais correm as portas do Reino dos Sete Reinos. A irmandade da Patrulha da Noite busca proteger o reino de cada criatura que pode vir de lá da Muralha, mas já não tem os recursos necessários para garantir a segurança de todos. Depois de um verão de dez anos, um inverno rigoroso promete chegar com um futuro mais sombrio. Enquanto isso, conspirações e rivalidades correm no jogo político pela disputa do Trono de Ferro, o símbolo do poder absoluto.', 'https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Game_of_Thrones_Season_7.png/220px-Game_of_Thrones_Season_7.png', 'http://br.web.img1.acsta.net/cx_980_340/seriesposter/7157/poster_large.jpg', 'game of thrones, GOT', 'drama', 'aventura', '', '', 387),
(5, 'prison-break', 'Prison Break', 'data=2005 tempo=42min qualy=720p', 'Após a prisão de Lincoln Burrows (Dominic Purcell), condenado por um crime que não cometeu, o engenheiro Michael Scofield (Wentworth Miller) bola um plano para tirar o irmão da cadeia. Enviado para Fox River ao lado de Lincoln, Michael começa a executar a sua estratégia, mas logo percebe que está no meio de uma perigosa conspiração. Para garantir a liberdade da sua família, ele precisará enganar a Dra. Sara Tancredi (Sarah Wayne Callies) e se associar a criminosos condenados, como Fernando Sucre (Amaury Nolasco), Theodore \'T-Bag\' Bagwell (Robert Knepper) e John Abruzzi (Peter Stormare).', 'https://i.pinimg.com/736x/a2/be/00/a2be0034b1942c5fb4f00d37f99f90fc--wentworth-miller-prison-break.jpg', 'https://canecasdosnerds.com.br/blog/wp-content/uploads/2016/11/prison-break.jpg', 'PB, prison break,fox river,melhor serie,wentworth miller,em busca da verdade,prisao,cadeia', 'suspense', 'acao', 'drama', '', 362);

-- --------------------------------------------------------

--
-- Estrutura para tabela `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `pes` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `views`
--

INSERT INTO `views` (`id`, `pes`, `total`) VALUES
(1, '57', '57');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `eps`
--
ALTER TABLE `eps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
