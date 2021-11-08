-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 08 2021 г., 15:00
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `gallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FKemail` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `email`, `date`, `text`) VALUES
(1, 'lesha@gmail.com', '2021-07-16', 'Круто! Классные рисунки :)\r\nИ сайт очень красиво оформлен!\r\nБлагодарность художнику и дизайнеру!'),
(2, 'gregory@mail.ru', '2021-07-13', 'Спасибо большое за такие рисунки!\r\n\r\nЯ только учусь рисовать — они станут для меня восхитительным примером!)'),
(3, 'hh@mail.ru', '2021-07-18', 'Рисунок "Девушка и цветы" очень красивый!)'),
(4, 'krasniy@mail.ru', '2021-07-18', 'Прикольно)'),
(5, 'lesha@gmail.com', '2021-07-18', 'Ура!!!!');

-- --------------------------------------------------------

--
-- Структура таблицы `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `location` varchar(255) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `picture`
--

INSERT INTO `picture` (`location`, `about`, `genre`) VALUES
('images/harakiri.png', 'Харакири (по фильму)', 'Карандаш'),
('images/img1.png', 'Отражение', 'Краски'),
('images/img2.png', 'Девушка и цветы', 'Карандаш'),
('images/img3.png', 'Осенний пейзаж', 'Масло'),
('images/img4.png', 'Вид на острове', 'Масло'),
('images/img5.png', 'Аллея', 'Карандаш'),
('images/img6.png', 'В ожидании', 'Карандаш'),
('images/img7.png', 'Восточный Элефант', 'Карандаш'),
('images/img8.png', 'Мечеть из Фэнтези', 'Карандаш'),
('images/img9.png', 'Аниме — клянусь своей жизнью', 'Карандаш');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(255) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`email`, `nickname`, `password`, `date`, `birthday`) VALUES
('admin@gmail.com', 'admin', '123', '2021-10-25', '2013-08-01'),
('gg@gmail.com', 'GgG :)', '121212', '2021-10-25', '1998-11-24'),
('gregory@mail.ru', 'Розин Грегорий', '123456qwerty', '2021-07-15', NULL),
('hh@mail.ru', 'BLOHA', '123456', '2021-07-16', '1969-01-13'),
('krasniy@mail.ru', 'RedHeart', '1q2w3e4r', '2021-07-18', '1997-11-30'),
('lesha@gmail.com', 'Спичкин Лёха', '1q2w3e', '2021-07-15', NULL);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FKemail` FOREIGN KEY (`email`) REFERENCES `user` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
