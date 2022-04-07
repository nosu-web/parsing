-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 24 2022 г., 07:47
-- Версия сервера: 5.7.35-38
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cc08668_osnews`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  `img` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `website_id` (`website_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `websites`
--

CREATE TABLE IF NOT EXISTS `websites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL,
  `url` char(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `websites`
--

INSERT INTO `websites` (`id`, `name`, `url`) VALUES
(1, '15-Й РЕГИОН', 'https://region15.ru/novosti/'),
(2, 'ГТРК «Алания»', 'https://alaniatv.ru/novosti/'),
(3, 'Официальный сайт газеты Владикавказ', 'https://vladgazeta.online/novostnaya-lenta/'),
(4, 'Официальный портал РСО-Алания', 'http://alania.gov.ru/'),
(5, 'ОСЕТИЯ-ИРЫСТОН', 'https://iryston.tv/category/news/'),
(6, 'Gradus.Pro', 'https://gradus.pro/category/srochno/'),
(7, 'Sputnik - Северная Осетия', 'https://sputnik-ossetia.ru/North_Ossetia/'),
(8, 'Ossetia News', 'https://ossetia.news/news/'),
(9, 'Abon News', 'https://abon-news.ru/'),
(10, 'Крылья TV', 'http://krilyatv.ru/category/news/'),
(11, 'МВД по РСО-Алания', 'https://15.мвд.рф/news'),
(12, 'МЧС по РСО-Алания', 'https://15.mchs.gov.ru/deyatelnost/press-centr/novosti'),
(13, 'ТАСС - Северная Осетия', 'https://tass.ru/tag/severnaya-osetiya'),
(14, 'Lenta.ru - Северная Осетия', 'https://lenta.ru/tags/geo/severnaya-osetiya/'),
(15, 'E-osetia.ru', 'https://www.e-osetia.ru/news'),
(16, 'СОГУ', 'https://nosu.ru');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
