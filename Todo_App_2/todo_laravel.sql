-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost:8889
-- Время создания: Апр 22 2015 г., 08:58
-- Версия сервера: 5.5.38
-- Версия PHP: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `todo_laravel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `done` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `user_id`, `name`, `done`) VALUES
(25, 1, 'bjgkjbfkjbgkjbg', 0),
(28, 1, 'werewrwerwer', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_04_17_111539_create_items_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Olga', 'zaya1991@list.ru', '$2y$10$cQ1xMGC/LLkhr9oSXintauzj774igVzxAwIP3I8jfzNfAYnFoR5KC', 'RzTCbBPX8ylCULzryUwgSAXbzuSoijhmG0EPgfV6hnQp3heLTzAIcYSB619Z', '2015-04-15 18:37:43', '2015-04-20 13:29:18'),
(2, 'stas', 'stas@stas.be', '$2y$10$TfsiiD7heW1AGZguihww/unweSwD5IB3xps85ApC7W0FAw.8OQOdG', 'c3RsxleXXLJ4AQgl3ESUUnwS3SxZjEGzOzlQ0UnjU3MRlHLtYqpaImSDgV2I', '2015-04-15 18:44:15', '2015-04-18 19:42:01'),
(3, 'blabla', 'blabla@list.ru', '$2y$10$WA1qWvao6r6IxK12o64v8uHMvTCa/lo1e7Tu4PClJUqrt0BlSYB9y', 'Ak4pQbVvhQjikmTCCGTNnhcsjmPtpKlP3gZRmfWa3X2KY2P1W9d38wfRlqy0', '2015-04-16 08:10:38', '2015-04-16 08:40:48'),
(4, 'blabla', 'bla@bla.be', '$2y$10$HUYo2eWOJQ7MHCgRGBdjyeyT4YRV8JeVfsxmn1uF5MYatmbRiyKai', '26JARu8EBGJ2rfPgEbenFta4l5g338egyAoXupdJzsJVmWYdJYNhaXzSE4eJ', '2015-04-18 20:08:48', '2015-04-18 20:12:28'),
(5, 'lena', 'lena@lena.ru', '$2y$10$acaVIl91dyQVwE28iA88tOXsPPuc.Sm.0XIIVvF4Id4nJ4LLi6a.O', 'EDUx42Joy6yDjhyUe1KufSCOoRvhXjkPIj5c2m8zfkA6KJ5pZWzSYcNXZjXl', '2015-04-19 18:46:02', '2015-04-19 18:46:59');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
