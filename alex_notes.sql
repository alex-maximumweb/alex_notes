-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 06 2012 г., 14:45
-- Версия сервера: 5.5.27
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `alex_notes`
--

-- --------------------------------------------------------

--
-- Структура таблицы `notes_notes`
--

CREATE TABLE IF NOT EXISTS `notes_notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_name` varchar(150) NOT NULL,
  `note_type` int(11) NOT NULL,
  `note_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note_contents` text NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `notes_notes`
--

INSERT INTO `notes_notes` (`note_id`, `note_name`, `note_type`, `note_datetime`, `note_contents`) VALUES
(1, 'Заметка 1', 1, '2012-09-02 12:14:52', '1. Сделать то\r\n2. Сделать это\r\n3. Сделать что-то еще');

-- --------------------------------------------------------

--
-- Структура таблицы `notes_notetypes`
--

CREATE TABLE IF NOT EXISTS `notes_notetypes` (
  `notetype_id` int(11) NOT NULL AUTO_INCREMENT,
  `notetype_userid` int(11) NOT NULL,
  `notetype_name` varchar(150) NOT NULL,
  PRIMARY KEY (`notetype_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `notes_notetypes`
--

INSERT INTO `notes_notetypes` (`notetype_id`, `notetype_userid`, `notetype_name`) VALUES
(1, 1, 'Личные'),
(2, 1, 'Рабочие');

-- --------------------------------------------------------

--
-- Структура таблицы `notes_users`
--

CREATE TABLE IF NOT EXISTS `notes_users` (
  `user_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `notes_users`
--

INSERT INTO `notes_users` (`user_id`, `user_name`, `user_password`, `user_regdate`) VALUES
(1, 'aexb', '9dc1f916650950e01f75951f6de9bab5', '2012-09-02 12:12:35');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
