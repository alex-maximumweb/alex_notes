-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 03 2012 г., 01:43
-- Версия сервера: 5.5.28
-- Версия PHP: 5.2.17

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
  `note_update_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note_creation_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `note_contents` text NOT NULL,
  `note_coord_x` int(11) NOT NULL,
  `note_coord_y` int(11) NOT NULL,
  `note_coord_z` int(11) NOT NULL,
  `note_width` int(11) NOT NULL,
  `note_height` int(11) NOT NULL,
  `note_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`note_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `notes_notes`
--

INSERT INTO `notes_notes` (`note_id`, `note_name`, `note_type`, `note_update_datetime`, `note_creation_datetime`, `note_contents`, `note_coord_x`, `note_coord_y`, `note_coord_z`, `note_width`, `note_height`, `note_order`) VALUES
(41, 'note1', 1, '2012-10-02 21:42:07', '2012-10-02 21:39:51', '', 223, 125, 0, 456, 294, 0);

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
