-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Окт 03 2016 г., 09:27
-- Версия сервера: 5.5.42-log
-- Версия PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kinozal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cms_cache`
--

CREATE TABLE `cms_cache` (
  `id` int(11) NOT NULL,
  `target` varchar(10) NOT NULL,
  `target_id` varchar(255) NOT NULL,
  `cachedate` datetime NOT NULL,
  `cachefile` varchar(80) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6930 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cms_cache`
--

INSERT INTO `cms_cache` (`id`, `target`, `target_id`, `cachedate`, `cachefile`) VALUES
(6101, 'controller', '4', '2016-10-01 17:27:22', '4a4f65c258faa022544ba7624c444e85.html'),
(6929, 'controller', '1', '2016-10-03 10:12:40', '14fc2c61398c3508084ed61e615e695e.html'),
(6928, 'controller', '1', '2016-10-03 10:12:39', '14fc2c61398c3508084ed61e615e695e.html'),
(6927, 'controller', '1', '2016-10-03 10:12:37', '14fc2c61398c3508084ed61e615e695e.html'),
(6926, 'controller', '1', '2016-10-03 10:12:35', '14fc2c61398c3508084ed61e615e695e.html');

-- --------------------------------------------------------

--
-- Структура таблицы `cms_category`
--

CREATE TABLE `cms_category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `order_by` int(11) NOT NULL,
  `show_tag` int(11) NOT NULL DEFAULT '0',
  `url` varchar(155) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `tamp` varchar(99) NOT NULL DEFAULT 'cats_content.php'
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cms_category`
--

INSERT INTO `cms_category` (`id`, `parent_id`, `name`, `order_by`, `show_tag`, `url`, `published`, `tamp`) VALUES
(9, 0, 'Портфолио', 2, 1, 'portfolio', 1, 'cats_content.php'),
(8, 0, 'Услуги', 1, 1, 'uslugi', 1, 'cats_content.php');

-- --------------------------------------------------------

--
-- Структура таблицы `cms_controller`
--

CREATE TABLE `cms_controller` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `path` varchar(155) NOT NULL,
  `url` varchar(255) NOT NULL,
  `table_mysql` varchar(99) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cms_controller`
--

INSERT INTO `cms_controller` (`id`, `name`, `path`, `url`, `table_mysql`, `published`) VALUES
(1, 'Кинозалы', 'kino', '/kino', 'cms_kino', 1),
(4, 'Админка', 'adm', '/adm', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cms_kino`
--

CREATE TABLE `cms_kino` (
  `id` int(11) NOT NULL,
  `name` varchar(155) CHARACTER SET utf8 NOT NULL,
  `kinozal` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ryad` int(11) NOT NULL,
  `pubdate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `cms_kino`
--

INSERT INTO `cms_kino` (`id`, `name`, `kinozal`, `ryad`, `pubdate`) VALUES
(9, 'Кинопалац', '---\ncount_mest:\n  - 11\n  - 6\n  - 8\n  - 9\n  - 10\n  - 10\n  - 6\n  - 6\n  - 8\n  - 8\n  - 10\n  - 10\nsector:\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\nprice:\n  - 10\n  - 20\n  - 30\n  - 40\n  - 50\n  - 60\n  - 70\n  - 80\n  - 90\n  - 100\n  - ', 12, '2016-10-02 21:59:25'),
(10, 'Линия кино', '---\ncount_mest:\n  - 12\n  - 11\n  - 10\n  - 9\n  - 8\nsector:\n  - A\n  - A\n  - ''Y''\n  - C\n  - D\nprice:\n  - 200\n  - 300\n  - 250\n  - 130\n  - 250\n', 5, '2016-10-02 22:00:39'),
(11, 'Кинозал №3', '---\ncount_mest:\n  - 6\n  - 8\n  - 5\n  - 5\n  - 4\n  - 10\nsector:\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\nprice:\n  - 111\n  - 100\n  - 9999\n  - 2500\n  - 200\n  - 990\n', 6, '2016-10-02 22:01:33'),
(12, 'Kino', '---\ncount_mest:\n  - 7\n  - 9\n  - 7\n  - 7\n  - 7\n  - 10\n  - 7\n  - 9\n  - 7\n  - 8\n  - 7\n  - 8\n  - 6\n  - 6\n  - 7\n  - 10\n  - 8\n  - 8\n  - 9\n  - 9\nsector:\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n  - A\n ', 20, '2016-10-02 22:22:57');

-- --------------------------------------------------------

--
-- Структура таблицы `cms_kino_order`
--

CREATE TABLE `cms_kino_order` (
  `id` int(11) NOT NULL,
  `kino_id` int(11) NOT NULL,
  `ryad` int(11) NOT NULL,
  `mesto` int(11) NOT NULL,
  `datepub` datetime NOT NULL,
  `name` varchar(155) CHARACTER SET utf8 NOT NULL,
  `ins_pub` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL,
  `ip_client` varchar(155) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `cms_kino_order`
--

INSERT INTO `cms_kino_order` (`id`, `kino_id`, `ryad`, `mesto`, `datepub`, `name`, `ins_pub`, `price`, `ip_client`) VALUES
(98, 11, 3, 2, '2016-10-02 22:01:57', 'Макс', 3, 2500, '127.0.0.1'),
(100, 11, 2, 3, '2016-10-02 22:02:22', 'Нуыы', 3, 9999, '127.0.0.1'),
(102, 11, 2, 4, '2016-10-02 22:06:55', 'Ьвыы', 3, 9999, '127.0.0.1'),
(104, 10, 4, 4, '2016-10-02 22:10:27', 'adds', 3, 250, '127.0.0.1'),
(106, 10, 4, 6, '2016-10-02 22:11:47', 'gaff', 3, 250, '127.0.0.1'),
(108, 10, 4, 3, '2016-10-02 22:12:50', 'pdfsdf', 3, 250, '127.0.0.1'),
(113, 10, 2, 9, '2016-10-02 22:16:23', 'sdfsdf', 3, 250, '127.0.0.1'),
(115, 10, 3, 5, '2016-10-02 22:18:30', 'suds', 3, 130, '127.0.0.1'),
(117, 10, 2, 4, '2016-10-02 22:19:24', 'pdfsdf', 3, 250, '127.0.0.1'),
(118, 10, 2, 2, '2016-10-02 22:19:35', 'sdfsdf', 3, 250, '127.0.0.1'),
(119, 10, 1, 6, '2016-10-02 22:20:45', 'sdfds', 3, 300, '127.0.0.1'),
(120, 10, 3, 3, '2016-10-03 08:51:01', 'Hey', 3, 130, '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `cms_module`
--

CREATE TABLE `cms_module` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `admin_name` varchar(155) NOT NULL,
  `config` text NOT NULL,
  `position` varchar(99) NOT NULL,
  `tamplates_file` varchar(155) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cms_module`
--

INSERT INTO `cms_module` (`id`, `name`, `admin_name`, `config`, `position`, `tamplates_file`, `user_id`) VALUES
(1, 'Конфигурация страниц', 'wid_config_page', '', 'config', 'wid_config_page.php', 1),
(2, 'Название', 'wid_name_site', '', 'config', '', 1),
(3, 'Авторизация/меню пользователя', 'wid_auth', '', 'auth', 'wid_auth.php', 1),
(4, 'Категории контента', 'wid_category', '', 'content_cats', 'wid_category.php', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cms_page`
--

CREATE TABLE `cms_page` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `seo_page` text NOT NULL,
  `page` varchar(255) NOT NULL,
  `descript` text NOT NULL,
  `do` varchar(99) NOT NULL,
  `pubdate` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cms_page`
--

INSERT INTO `cms_page` (`id`, `name`, `seo_page`, `page`, `descript`, `do`, `pubdate`) VALUES
(1, 'Главная', 'Кинозал|Ключ|Описание', '/', '', 'index', '2015-08-04 20:34:28'),
(4, 'Пользователи сайта', 'Пользователи сайта||', '/users', '', '', '0000-00-00 00:00:00'),
(5, 'Вход на сайт', 'Вход на сайт||', '/users/login.html', '', '', '0000-00-00 00:00:00'),
(6, 'Регистрация', 'Регистрация сайта||', '/users/register.html', '', '', '0000-00-00 00:00:00'),
(7, 'Забыли пароль?', 'Забыли пароль? Не проблема мы всё решим!||', '/users/send-pass.html', '', '', '0000-00-00 00:00:00'),
(8, 'Каталог статей', 'Каталог статей||', '/content', '<p>Описание страницы</p>', 'view', '2015-01-17 00:32:00'),
(9, 'Добавить статью', 'Добавить статью||', '/content/add', '', '', '0000-00-00 00:00:00'),
(10, 'Админка сайта', 'Админка сайта||', '/adm', '', '', '0000-00-00 00:00:00'),
(46, 'Донецк.org', 'Донецк.org||', '/content/donetsk_org.html', '', 'read', '2015-08-04 20:53:10'),
(47, '24к.com', '24к.com||', '/content/24k_com.html', '', 'read', '2015-08-05 00:18:52'),
(48, '6an.ru', '6an.ru||', '/content/6an_ru.html', '', 'read', '2015-08-05 00:19:32'),
(20, 'Услуги', 'Услуги||', '/content/uslugi', '', 'cats', '2015-01-20 20:02:19'),
(45, 'Разработка сайтов на известных CMS', 'Разработка сайтов на известных CMS||', '/content/razrabotka-saytov-na-izvestnyih-cms.html', '', 'read', '2015-02-03 22:04:51'),
(44, 'Разработка сайтов на Framework', 'Разработка сайтов на Framework||', '/content/razrabotka-saytov-na-framework.html', '', 'read', '2015-02-03 00:36:09'),
(43, 'Разработка собственных CMS', 'Разработка собственных CMS||', '/content/razrabotka-sobstvennyih-cms.html', '', 'read', '2015-02-02 22:52:37'),
(42, 'Разработка одностраничных сайтов', 'Разработка одностраничных сайтов||', '/content/razrabotka-odnostranichnyih-saytov.html', '', 'read', '2015-01-31 01:29:57'),
(39, 'Контакты', 'Контакты||', '/content/kontaktyi.html', '', 'read', '2015-01-26 22:22:07'),
(40, 'Портфолио', 'Портфолио||', '/content/portfolio', '', 'cats', '2015-08-04 20:51:07'),
(41, 'Разработка сайтов', 'Разработка сайтов||', '/content/razrabotka-saytov.html', '', 'read', '2015-01-29 19:19:48');

-- --------------------------------------------------------

--
-- Структура таблицы `cms_users`
--

CREATE TABLE `cms_users` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(99) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(155) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `user_id_md5` varchar(155) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cms_cache`
--
ALTER TABLE `cms_cache`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cms_category`
--
ALTER TABLE `cms_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cms_controller`
--
ALTER TABLE `cms_controller`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cms_kino`
--
ALTER TABLE `cms_kino`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cms_kino_order`
--
ALTER TABLE `cms_kino_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cms_module`
--
ALTER TABLE `cms_module`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cms_users`
--
ALTER TABLE `cms_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cms_cache`
--
ALTER TABLE `cms_cache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6930;
--
-- AUTO_INCREMENT для таблицы `cms_category`
--
ALTER TABLE `cms_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `cms_controller`
--
ALTER TABLE `cms_controller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `cms_kino`
--
ALTER TABLE `cms_kino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `cms_kino_order`
--
ALTER TABLE `cms_kino_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT для таблицы `cms_module`
--
ALTER TABLE `cms_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT для таблицы `cms_users`
--
ALTER TABLE `cms_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
