-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2016 a las 21:54:03
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fantasy_league_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `belong`
--

CREATE TABLE `belong` (
  `id` int(5) NOT NULL,
  `team_id` int(5) NOT NULL,
  `league_id` int(5) NOT NULL,
  `player_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `belong`
--

INSERT INTO `belong` (`id`, `team_id`, `league_id`, `player_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 3),
(4, 1, 1, 4),
(5, 1, 1, 5),
(6, 3, 1, 1),
(7, 3, 1, 2),
(8, 3, 1, 3),
(9, 3, 1, 4),
(10, 3, 1, 5),
(11, 2, 2, 1),
(12, 2, 2, 2),
(13, 2, 2, 3),
(14, 2, 2, 4),
(15, 2, 2, 5),
(16, 4, 2, 6),
(17, 4, 2, 7),
(18, 4, 2, 8),
(19, 4, 2, 9),
(20, 4, 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bid`
--

CREATE TABLE `bid` (
  `id` int(11) NOT NULL,
  `league_id` int(5) NOT NULL,
  `team_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `player_id` int(5) NOT NULL,
  `bid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bid`
--

INSERT INTO `bid` (`id`, `league_id`, `team_id`, `user_id`, `player_id`, `bid`) VALUES
(5, 1, 1, 1, 14, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `user`, `comment`, `approved`, `created`, `updated`) VALUES
(1, 'Paula', 'This is the best fantasy manager ever!', 1, '2016-01-13 13:19:01', '2016-01-13 13:19:01'),
(2, 'Asier', 'Yeah I really love the look of it too, one of the best web apps I''ve seen!', 1, '2016-01-13 13:21:15', '2016-01-13 13:21:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compete`
--

CREATE TABLE `compete` (
  `league_id` int(5) NOT NULL,
  `league_name` longtext NOT NULL,
  `team_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compete`
--

INSERT INTO `compete` (`league_id`, `league_name`, `team_id`) VALUES
(1, 'League 1', 1),
(1, 'League 1', 3),
(2, 'League 2', 2),
(2, 'League 2', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eleven`
--

CREATE TABLE `eleven` (
  `team_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `goalkeeper` int(3) NOT NULL,
  `defender1` int(3) NOT NULL,
  `defender2` int(3) NOT NULL,
  `defender3` int(3) NOT NULL,
  `defender4` int(3) NOT NULL,
  `midfielder1` int(3) NOT NULL,
  `midfielder2` int(3) NOT NULL,
  `midfielder3` int(3) NOT NULL,
  `midfielder4` int(3) NOT NULL,
  `striker1` int(3) NOT NULL,
  `striker2` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eleven`
--

INSERT INTO `eleven` (`team_id`, `user_id`, `goalkeeper`, `defender1`, `defender2`, `defender3`, `defender4`, `midfielder1`, `midfielder2`, `midfielder3`, `midfielder4`, `striker1`, `striker2`) VALUES
(1, 1, 5, 2, 5, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `league`
--

CREATE TABLE `league` (
  `league_id` int(5) NOT NULL,
  `league_name` longtext NOT NULL,
  `league_password` longtext NOT NULL,
  `league_capacity` int(11) NOT NULL,
  `league_admin_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `league`
--

INSERT INTO `league` (`league_id`, `league_name`, `league_password`, `league_capacity`, `league_admin_id`) VALUES
(1, 'League 1', 'league1', 20, 2),
(2, 'League 2', 'league2', 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `market`
--

CREATE TABLE `market` (
  `id` int(5) NOT NULL,
  `league_id` int(5) NOT NULL,
  `id_player1` int(11) NOT NULL,
  `id_player2` int(11) NOT NULL,
  `id_player3` int(11) NOT NULL,
  `id_player4` int(11) NOT NULL,
  `id_player5` int(11) NOT NULL,
  `id_player6` int(11) NOT NULL,
  `id_player7` int(11) NOT NULL,
  `id_player8` int(11) NOT NULL,
  `id_player9` int(11) NOT NULL,
  `id_player10` int(11) NOT NULL,
  `id_player11` int(11) NOT NULL,
  `id_player12` int(11) NOT NULL,
  `id_player13` int(11) NOT NULL,
  `id_player14` int(11) NOT NULL,
  `id_player15` int(11) NOT NULL,
  `id_player16` int(11) NOT NULL,
  `id_player17` int(11) NOT NULL,
  `id_player18` int(11) NOT NULL,
  `id_player19` int(11) NOT NULL,
  `id_player20` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `market`
--

INSERT INTO `market` (`id`, `league_id`, `id_player1`, `id_player2`, `id_player3`, `id_player4`, `id_player5`, `id_player6`, `id_player7`, `id_player8`, `id_player9`, `id_player10`, `id_player11`, `id_player12`, `id_player13`, `id_player14`, `id_player15`, `id_player16`, `id_player17`, `id_player18`, `id_player19`, `id_player20`) VALUES
(1, 1, 4, 11, 14, 9, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 1, 10, 17, 13, 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `lastname` longtext NOT NULL,
  `birth` date NOT NULL,
  `nationality` longtext NOT NULL,
  `club` longtext NOT NULL,
  `position` longtext NOT NULL,
  `points` int(4) NOT NULL,
  `value` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `player`
--

INSERT INTO `player` (`id`, `name`, `lastname`, `birth`, `nationality`, `club`, `position`, `points`, `value`) VALUES
(1, 'Keylor', 'Navas', '1986-12-15', 'Costa Rica', 'Real Madrid', 'Goalkeeper', 80, 3000),
(2, 'Mikel', 'Balenziaga', '1988-02-29', 'Spain', 'Athletic Club', 'Defender', 25, 1000),
(3, 'Aymeric', 'Laporte', '1994-05-27', 'France', 'Athletic Club', 'Defender', 50, 5000),
(4, 'Beñat', 'Etxebarria', '1987-02-19', 'Spain', 'Athletic Club', 'Midfielder', 34, 2500),
(5, 'Ander', 'Iturraspe', '1989-03-08', 'Spain', 'Athletic Club', 'Midfielder', 23, 3243),
(6, 'Iñaki', 'Williams', '1994-06-15', 'Spain', 'Athletic Club', 'Striker', 56, 3000),
(7, 'Aritz', 'Aduriz', '1981-02-11', 'Spain', 'Athletic Club', 'Striker', 60, 5000),
(8, 'Cristiano', 'Ronaldo', '2015-12-29', 'Portugal', 'Real Madrid', 'Striker', 200, 15000),
(9, 'Gareth', 'Bale', '2016-01-10', 'Wales', 'Real Madrid', 'Striker', 109, 5000),
(10, 'James', 'Rodríguez', '2016-01-05', 'Colombia', 'Real Madrid', 'Midfielder', 35, 2000),
(11, 'Toni', 'Kroos', '2016-01-05', 'Germany', 'Real Madrid', 'Midfielder', 54, 3000),
(12, 'Luka', 'Modric', '2016-01-05', 'Croatia', 'Real Madrid', 'Midfielder', 43, 3000),
(13, 'Isco', 'Alarcón', '2016-01-05', 'Spain', 'Real Madrid', 'Midfielder', 65, 5000),
(14, 'Karim', 'Benzema', '2016-01-05', 'France', 'Real Madrid', 'Striker', 80, 5000),
(15, 'Sergio', 'Ramos', '2016-01-05', 'Spain', 'Real Madrid', 'Defender', 25, 2000),
(16, 'Raphäel', 'Varane', '2016-01-12', 'France', 'Real Madrid', 'Defender', 15, 2000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team`
--

CREATE TABLE `team` (
  `team_id` int(5) NOT NULL,
  `team_name` longtext NOT NULL,
  `league_id` int(5) NOT NULL,
  `league_name` varchar(255) NOT NULL,
  `user_id` int(5) NOT NULL,
  `points` int(4) NOT NULL,
  `money` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `league_id`, `league_name`, `user_id`, `points`, `money`) VALUES
(1, 'Juan 1', 1, 'League 1', 1, 100, 20000000),
(2, 'Juan 2', 2, 'League 2', 1, 25, 20000000),
(3, 'Javi 1', 1, 'League 1', 2, 150, 20000000),
(4, 'Javi 2', 2, 'League 2', 2, 75, 20000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `username` longtext NOT NULL,
  `email` longtext NOT NULL,
  `name` longtext NOT NULL,
  `password` longtext NOT NULL,
  `privileges` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `name`, `password`, `privileges`) VALUES
(1, 'Juan', 'juangara@opendeusto.es', 'Juan', 'b49a5780a99ea81284fc0746a78f84a30e4d5c73', 0),
(2, 'Javi', 'javier.urbistondo@opendeusto.es', 'Javier', '9e179d6b17c660dea1ef2200340757532921389d', 0),
(3, 'Paula', 'paulaue@opendeusto.es', 'Paula', '62e52d2ac616f25dfddd0968a947fa7e84e5c086', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `belong`
--
ALTER TABLE `belong`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compete`
--
ALTER TABLE `compete`
  ADD PRIMARY KEY (`league_id`,`team_id`);

--
-- Indices de la tabla `eleven`
--
ALTER TABLE `eleven`
  ADD PRIMARY KEY (`team_id`,`user_id`);

--
-- Indices de la tabla `league`
--
ALTER TABLE `league`
  ADD PRIMARY KEY (`league_id`);

--
-- Indices de la tabla `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `league_id` (`league_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `belong`
--
ALTER TABLE `belong`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT de la tabla `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `league`
--
ALTER TABLE `league`
  MODIFY `league_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `market`
--
ALTER TABLE `market`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `league` (`league_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_ibfk_2` FOREIGN KEY (`league_id`) REFERENCES `league` (`league_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
