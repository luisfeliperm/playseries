-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 30/07/2018 às 18:33
-- Versão do servidor: 5.7.22-0ubuntu18.04.1
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
(1, 'luisfelipepoint@gmail.com', '22082000', 2),
(4, 'luisfelipepoint2@gmail.com', '220820002', 1);

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
  `src_3` varchar(700) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `eps`
--

INSERT INTO `eps` (`id`, `identificador`, `temporada`, `ep`, `poster`, `src_1`, `nome_2`, `src_2`, `nome_3`, `src_3`) VALUES
(4, 'rick-and-morty', 2, 2, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', 'YouTube', 'https://www.youtube.com/embed/w46bWxS9IjY', '', ''),
(2, 'rick-and-morty', 1, 1, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', 'YouTube', 'https://www.youtube.com/embed/w46bWxS9IjY', '', ''),
(9, 'rick-and-morty', 3, 5, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', 'YouTube', 'https://www.youtube.com/embed/w46bWxS9IjY', '', ''),
(3, 'rick-and-morty', 2, 1, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', 'YouTube', 'https://www.youtube.com/embed/w46bWxS9IjY', '', ''),
(5, 'rick-and-morty', 3, 1, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', 'YouTube', 'https://www.youtube.com/embed/w46bWxS9IjY', '', ''),
(10, 'naruto-filme-o-confronto-ninja-no-pais-da-neve', 1, 1, 'http://4.bp.blogspot.com/-mXRXSmZALlw/UyLgCQqitII/AAAAAAAAgeE/8wROrUD0MgM/s1600/Naruto+Movie+02.jpg', '', 'Ok [dub]', '//ok.ru/videoembed/92579629814', '', ''),
(6, 'rick-and-morty', 3, 2, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', 'YouTube', 'https://www.youtube.com/embed/w46bWxS9IjY', '', ''),
(7, 'rick-and-morty', 3, 3, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', 'https://sv1.cometa.top/RedeCanais/RCServer11/ondemand/RCKANDMRTYT01EP01.mp4', 'YouTube', 'https://www.youtube.com/embed/w46bWxS9IjY', '', ''),
(8, 'rick-and-morty', 3, 4, 'https://s.aficionados.com.br/imagens/ep1-pilot.jpg', '', 'YouTube', 'https://www.youtube.com/embed/w46bWxS9IjY', '', '');

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
  `viwer` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `series`
--

INSERT INTO `series` (`id`, `identificador`, `nome`, `info`, `sinopse`, `miniatura`, `background`, `tags`, `cat1`, `cat2`, `cat3`, `cat4`, `viwer`) VALUES
(1, 'stranger-things', 'Stranger Things', 'data=2016 tempo=55min qualy=720p', 'Long Island, 1983. Um garoto de 12 anos desaparece misteriosamente. A família e a polícia procuram respostas, mas acabam se deparando com um experimento secreto do governo. Enquanto isso, os amigos do menino iniciam suas próprias investigações, o que os levam a um extraordinário mistério envolvendo forças sobrenaturais e uma garotinha muito, muito estranha.', 'http://s1.1zoom.me/big0/317/Winona_Ryder_Men_Stranger_Things_Millie_Bobby_524805_682x1024.jpg', 'https://conteudo.imguol.com.br/c/entretenimento/2e/2016/07/26/cena-da-serie-stranger-things-2016-1469567164429_1920x960.jpg', 'stranger things,st,eleven,coisas estranhas', 'terror', 'suspense', 'drama', '', 10),
(2, 'the-walking-dead', 'The Walking Dead', 'data=2010 tempo=44min qualy=720p', 'Um apocalipse provoca uma infestação de zumbis na cidade de Cynthiana, em Kentucky, nos Estados Unidos, e o oficial de polícia Rick Grimes (Andrew Lincoln) descobre que os mortos&#45;vivos estão se propagando progressivamente. Ele decide unir&#45;se aos homens e mulheres sobreviventes para que tenham mais força para combater o fenômeno que os atinge. O grupo percorre diferentes lugares em busca de soluções para o problema.', 'http://i.imgur.com/bkA6I9H.jpg', 'https://discourse-cdn-sjc1.com/gearbox/uploads/default/863/c19c8b7927e630f7.jpg', 'twd,the walking dead,zumbi,apocalipse,mortos vivos', '0', '0', '0', '0', 0),
(3, 'rick-and-morty', 'Rick and Morty', 'data=2010 tempo=44min qualy=720p', 'Uma série animada que acompanha as aventuras e os descobrimentos de um super cientista e seu neto não muito brilhante.', 'https://images-na.ssl-images-amazon.com/images/I/61rFf3FHRcL.jpg', 'http://br.web.img1.acsta.net/cx_980_340/seriesposter/11561/poster_large.jpg', 'ram,Rick and Morty,desenho,ficção ciêntifica,viajem no tempo,', 'ficcao', 'comedia', 'desenho', 'aventura', 117),
(4, 'game-of-thrones', 'Game of Thrones', 'data=2011 tempo=52min qualy=720p', 'Há muito tempo, em um tempo esquecido, uma força destruiu o equilíbrio das estações. Em uma terra onde os verões podem durar vários anos e o inverno toda uma vida, as reivindicações e as forças sobrenaturais correm as portas do Reino dos Sete Reinos. A irmandade da Patrulha da Noite busca proteger o reino de cada criatura que pode vir de lá da Muralha, mas já não tem os recursos necessários para garantir a segurança de todos. Depois de um verão de dez anos, um inverno rigoroso promete chegar com um futuro mais sombrio. Enquanto isso, conspirações e rivalidades correm no jogo político pela disputa do Trono de Ferro, o símbolo do poder absoluto.', 'https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Game_of_Thrones_Season_7.png/220px-Game_of_Thrones_Season_7.png', 'http://br.web.img1.acsta.net/cx_980_340/seriesposter/7157/poster_large.jpg', 'game of thrones, GOT', 'drama', 'aventura', '', '', 0),
(5, 'prison-break', 'Prison Break', 'data=2005 tempo=42min qualy=720p', 'Após a prisão de Lincoln Burrows (Dominic Purcell), condenado por um crime que não cometeu, o engenheiro Michael Scofield (Wentworth Miller) bola um plano para tirar o irmão da cadeia. Enviado para Fox River ao lado de Lincoln, Michael começa a executar a sua estratégia, mas logo percebe que está no meio de uma perigosa conspiração. Para garantir a liberdade da sua família, ele precisará enganar a Dra. Sara Tancredi (Sarah Wayne Callies) e se associar a criminosos condenados, como Fernando Sucre (Amaury Nolasco), Theodore \'T-Bag\' Bagwell (Robert Knepper) e John Abruzzi (Peter Stormare).', 'https://i.pinimg.com/736x/a2/be/00/a2be0034b1942c5fb4f00d37f99f90fcwentworth-miller-prison-break.jpg', 'https://canecasdosnerds.com.br/blog/wp-content/uploads/2016/11/prison-break.jpg', 'PB, prison break,fox river,melhor serie,wentworth miller,em busca da verdade,prisao,cadeia', '', '', '', '', 0),
(16, 'xxxxx', 'xxx', 'data=2018 tempo=40min qualy=720p', 'xxx', 'http://playseries.com:8080/admin/?pag=serie', 'http://playseries.com:8080/admin/?pag=serie', '', '', '', '', '', 3),
(12, 'testes', 'ftess', 'data=2018 tempo=40min qualy=720p', 'sdfsd', 'http://playseries.com:8080/admin/?edit=prison-break', 'http://playseries.com:8080/admin/?edit=prison-break', 'fds', '', '', '', '', 1),
(13, 'naruto-filme-o-confronto-ninja-no-pais-da-neve', 'Naruto Filme: O Confronto Ninja no Pais da Neve', 'data=2018 tempo=40min qualy=720p', 'Naruto é um ninja que tem por missão proteger Yukie Fujikaze, estrela de cinema que parte para filmar num lugar conhecido como Terra da Neve. Diante do plano sórdido dos ninjas da neve, Yukie deverá tomar difícil decisão, confrontando seu passado.', 'http://4.bp.blogspot.com/-mXRXSmZALlw/UyLgCQqitII/AAAAAAAAgeE/8wROrUD0MgM/s1600/Naruto+Movie+02.jpg', 'https://http2.mlstatic.com/dvd-naruto-o-filme-confronto-ninja-no-pais-da-neve-lacrado-D_NQ_NP_479511-MLB20576698561_022016-F.jpg', 'naruto,filme,o confronto no pais da neve,dublado,', 'anime', 'aventura', 'acao', '', 37),
(14, 'testes2', 'teste 2', 'data=2018 tempo=40min qualy=720p', 'fdsfds', 'http://playseries.com:8080/admin/?edit=prison-break', 'http://playseries.com:8080/admin/?edit=prison-break', '', '', '', '', '', 2),
(10, 'prison-break1', 'Prison Break1', 'data=2005 tempo=42min qualy=720p', '1Após a prisão de Lincoln Burrows (Dominic Purcell), condenado por um crime que não cometeu, o engenheiro Michael Scofield (Wentworth Miller) bola um plano para tirar o irmão da cadeia. Enviado para Fox River ao lado de Lincoln, Michael começa a executar a sua estratégia, mas logo percebe que está no meio de uma perigosa conspiração. Para garantir a liberdade da sua família, ele precisará enganar a Dra. Sara Tancredi (Sarah Wayne Callies) e se associar a criminosos condenados, como Fernando Sucre (Amaury Nolasco), Theodore &#92;&#39;T&#45;Bag&#92;&#39; Bagwell (Robert Knepper) e John Abruzzi (Peter Stormare).', 'https://canecasdosnerds.com.br/blog/wp-content/uploads/2016/11/prison-break.jpg', 'https://canecasdosnerds.com.br/blog/wp-content/uploads/2016/11/prison-break.jpg', 'PB, prison break,fox river,melhor serie,wentworth miller,em busca da verdade,prisao,cadeia', '0', '0', '0', '0', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `eps`
--
ALTER TABLE `eps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de tabela `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de tabela `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
