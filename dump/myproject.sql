-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 28 2018 г., 18:49
-- Версия сервера: 5.5.60-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `myproject`
--

-- --------------------------------------------------------

--
-- Структура таблицы `log_of_games`
--

CREATE TABLE IF NOT EXISTS `log_of_games` (
  `attacker_id` int(10) DEFAULT NULL,
  `enemy_id` int(10) DEFAULT NULL,
  `loss_of_attaker` int(10) DEFAULT NULL,
  `loss_of_enemy` int(10) DEFAULT NULL,
  `life_of_attaker` int(10) NOT NULL,
  `life_of_enemy` int(11) NOT NULL,
  `rating_of_attaker` int(11) NOT NULL,
  `rating_of_enemy` int(11) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `log_of_games`
--

INSERT INTO `log_of_games` (`attacker_id`, `enemy_id`, `loss_of_attaker`, `loss_of_enemy`, `life_of_attaker`, `life_of_enemy`, `rating_of_attaker`, `rating_of_enemy`, `id`) VALUES
(1, 2, 11, 16, 101, 101, 1, 0, 14),
(1, 2, 12, 22, 102, 102, 2, 1, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `user_id` int(10) DEFAULT NULL,
  `loss` int(10) DEFAULT NULL,
  `life` int(3) DEFAULT NULL,
  `rating` int(3) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`user_id`, `loss`, `life`, `rating`, `id`) VALUES
(1, 12, 102, 2, 1),
(2, 22, 102, 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_of_birth` date NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `role` varchar(17) DEFAULT NULL,
  `salt` varchar(8) DEFAULT NULL,
  `cookie` varchar(50) DEFAULT NULL,
  `image` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `date_of_birth`, `login`, `password`, `email`, `role`, `salt`, `cookie`, `image`) VALUES
(1, '2010-04-06', 'user1', 'e12eb7cc2f7d5e4c32192ecc5dbc281f', 'user1-0@mail.ru', 'admin', '+', '}', 'images/1.jpg'),
(2, '2007-06-23', 'login2', '705232cd74414da73bb16119376ff139', 'user2@mail.ru', 'editor', 'C', NULL, 'images/2.jpg'),
(3, '0000-00-00', 'user3', '393359608828eba2bdf76e34fb1b1046', 'user3@mail.ru', 'user', 'N', 'v', ''),
(4, '0000-00-00', 'user4', '763251f7d7913aeef246b3828ea9b96f', 'user4@mail.ru', 'user', 'E', '_', ''),
(5, '0000-00-00', 'user5', '39f56eabc4fc228b821dd83cd7fd7930', 'email5@gmail.com', 'user', 'e', NULL, ''),
(6, '0000-00-00', 'user6', '73cb3be5ea3e2866fb39d273dbba9d06', 'email6@gmail.com', 'user', 'r', NULL, ''),
(7, '0000-00-00', 'user7', 'f636b1f62466ca167f474ed4da72d400', 'email7@gmail.com', 'user', 'o', NULL, ''),
(8, '0000-00-00', 'user9', 'fba2379e6a442a767379fec513897dd2', 'user9@mail.ru', 'user', ']', NULL, ''),
(9, '0000-00-00', 'user10', 'e0608883494ffa1a522c0d50fb791ef5', 'user10@mail.ru', 'user', 'W', NULL, ''),
(10, '0000-00-00', 'user111', '2966c9357a3b1addc818478004e50c36', 'user111@mail.ru', 'user', 'J', NULL, ''),
(11, '0000-00-00', 'user112', '2f89b95b2e1e0c579c32bc9aee3c2900', 'user112@mail.ru', 'user', '`', NULL, ''),
(12, '0000-00-00', 'user12', '2cbca44843a864533ec05b321ae1f9d1', 'user12@mail.ru', 'admin', '0', NULL, ''),
(13, '0000-00-00', 'editor1', '960f32835aa27aacaceaea7106cb5a80', 'editor@mail.ru', 'admin', 'R', NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `user_activity`
--

CREATE TABLE IF NOT EXISTS `user_activity` (
  `user_id` int(10) DEFAULT NULL,
  `last_activity_time` int(100) DEFAULT NULL,
  `status_already_play_in_game` int(1) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `user_activity`
--

INSERT INTO `user_activity` (`user_id`, `last_activity_time`, `status_already_play_in_game`, `id`) VALUES
(1, 1524941234, 0, 10),
(2, 2147483647, 0, 11);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
