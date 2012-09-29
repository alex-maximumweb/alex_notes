-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 30 2012 г., 00:43
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
  `note_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note_contents` text NOT NULL,
  `note_coord_x` int(11) NOT NULL,
  `note_coord_y` int(11) NOT NULL,
  `note_coord_z` int(11) NOT NULL,
  `note_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`note_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `notes_notes`
--

INSERT INTO `notes_notes` (`note_id`, `note_name`, `note_type`, `note_datetime`, `note_contents`, `note_coord_x`, `note_coord_y`, `note_coord_z`, `note_order`) VALUES
(1, 'Заметка 1', 1, '2012-09-02 12:14:52', '1. Сделать то\r\n2. Сделать это\r\n3. Сделать что-то еще', 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
