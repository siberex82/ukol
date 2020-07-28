-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 28 2020 г., 10:04
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ukol`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `injections`
--

CREATE TABLE `injections` (
  `id` int(11) NOT NULL,
  `patid` int(11) NOT NULL,
  `datepay` date NOT NULL,
  `nameinj` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unixtimeinj` int(11) NOT NULL,
  `smsnotification` date NOT NULL,
  `notificationon` int(1) NOT NULL,
  `dateinject` date NOT NULL,
  `manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `injections`
--

INSERT INTO `injections` (`id`, `patid`, `datepay`, `nameinj`, `unixtimeinj`, `smsnotification`, `notificationon`, `dateinject`, `manager`) VALUES
(5, 1, '2020-07-28', 'Бисептол', 1595883600, '2021-10-21', 1, '2020-07-28', 1),
(6, 2, '2020-07-28', 'Пиносол', 1595883600, '2021-03-25', 1, '2020-07-28', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `patientphones`
--

CREATE TABLE `patientphones` (
  `id` int(11) NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `patientphones`
--

INSERT INTO `patientphones` (`id`, `phone`, `patid`) VALUES
(1, '0635271211', 1),
(2, '0991162542', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `thirdname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `patients`
--

INSERT INTO `patients` (`id`, `thirdname`, `firstname`, `lastname`, `sex`, `created`, `manager`) VALUES
(1, 'Бердіков', 'Руслан', 'Иванович', 'Мужской', '2020-07-27 10:47:26', 0),
(2, 'Ивченко', 'Иван', 'Степанович', 'Мужской', '2020-07-27 13:03:05', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `userphones`
--

CREATE TABLE `userphones` (
  `id` int(11) NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(11) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 0,
  `city` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`login`, `pass`, `email`, `reg`, `last`, `id`, `role`, `city`) VALUES
('user1', '$2y$10$Z1WfgWrPpiiwi660qP8WNe0A.PLGdX42.whUCvJwawDBrdIeIWhW6', 'user1@email.com', '2020-07-16 22:06:30', '2020-07-16 22:06:30', 1, 0, NULL),
('user2', '$2y$10$Z1WfgWrPpiiwi660qP8WNe0A.PLGdX42.whUCvJwawDBrdIeIWhW6', 'user2@email.com', '2020-07-16 22:06:30', '2020-07-16 22:06:30', 2, 1, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `injections`
--
ALTER TABLE `injections`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `patientphones`
--
ALTER TABLE `patientphones`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `userphones`
--
ALTER TABLE `userphones`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `injections`
--
ALTER TABLE `injections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `patientphones`
--
ALTER TABLE `patientphones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `userphones`
--
ALTER TABLE `userphones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
