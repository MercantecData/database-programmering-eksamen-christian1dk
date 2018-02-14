-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 14. 02 2018 kl. 11:23:52
-- Serverversion: 5.7.14
-- PHP-version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databaseexam`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `adminusers`
--

CREATE TABLE `adminusers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `adminusers`
--

INSERT INTO `adminusers` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$zHjrqpSzTp/ndRsrSoPAWuWNU6OHHNg37dAK0v8/lkxzQ9IxRywLa');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `imageURL` varchar(255) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `images`
--

INSERT INTO `images` (`id`, `imageURL`, `owner`) VALUES
(1, 'https://imgix.ranker.com/user_node_img/50047/1000931305/original/x-wing-photo-u1?w=650&q=50&fm=jpg&fit=crop&crop=faces', 1),
(2, 'https://imgix.ranker.com/user_node_img/50047/1000931279/original/millennium-falcon-photo-u1?w=650&q=50&fm=jpg&fit=crop&crop=faces', 1),
(3, 'https://imgix.ranker.com/user_node_img/50047/1000931306/original/vader-and-39-s-tie-fighter-photo-u1?w=650&q=50&fm=jpg&fit=crop&crop=faces', 1),
(4, 'https://imgix.ranker.com/user_node_img/50047/1000931297/original/star-destroyer-photo-u1?w=650&q=50&fm=jpg&fit=crop&crop=faces', 1),
(5, 'https://imgix.ranker.com/user_node_img/50047/1000931296/original/slave-i-photo-u1?w=650&q=60&fm=jpg&fit=crop&crop=faces', 1),
(6, 'http://static.tvtropes.org/pmwiki/pub/images/friendship_is_magic_newpageimage_1684.png', 2),
(7, 'https://vignette.wikia.nocookie.net/mugen/images/1/13/Fluttershy_artwork.png/revision/latest?cb=20130311003323', 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(1, 'kyloren', '$2y$10$EupjaIwmJx4JkMpBN2HWCOD0yeUiQA.30lzstKHZJAwGKOBoIwfSe', 'Ben Solo'),
(2, 'fShy34', '$2y$10$0fnJIAZpok15XTFeGV9ApePFMJTjAsTJxBXjMyI/qv6Z4yg1pH/Cm', 'Fluttershy');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `adminusers`
--
ALTER TABLE `adminusers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign key` (`owner`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `adminusers`
--
ALTER TABLE `adminusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tilføj AUTO_INCREMENT i tabel `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `foreign key` FOREIGN KEY (`owner`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
