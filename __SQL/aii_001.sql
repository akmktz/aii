-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.17-0ubuntu0.16.04.1 - (Ubuntu)
-- Операционная система:         Linux
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных aii
DROP DATABASE IF EXISTS `aii`;
CREATE DATABASE IF NOT EXISTS `aii` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `aii`;

-- Дамп структуры для таблица aii.blog_categories
DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Наименование',
  `alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Алиас',
  `text` text COLLATE utf8_unicode_ci COMMENT 'Описание',
  `date` date DEFAULT NULL COMMENT 'Дата публикации',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Опубликовано',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`alias`),
  KEY `key` (`alias`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы aii.blog_categories: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` (`id`, `name`, `alias`, `text`, `date`, `status`) VALUES
	(1, 'Политика', 'politics', 'Все о политике', '2017-02-22', 1),
	(2, 'edew', 'edew', '', '2017-03-19', 0),
	(3, 'aaa', 'aaa', '', '2017-03-21', 0);
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;

-- Дамп структуры для таблица aii.blog_posts
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `category` int(10) NOT NULL COMMENT 'Категория',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Наименование',
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Алиас',
  `text` text COLLATE utf8_unicode_ci COMMENT 'Текст',
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Теги',
  `date` date DEFAULT NULL COMMENT 'Дата публикации',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Публикация',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`alias`),
  KEY `key` (`alias`,`status`,`category`),
  KEY `FK_blog_posts_blog_categories` (`category`),
  FULLTEXT KEY `tags` (`tags`),
  CONSTRAINT `FK_blog_posts_blog_categories` FOREIGN KEY (`category`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы aii.blog_posts: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` (`id`, `category`, `name`, `alias`, `text`, `tags`, `date`, `status`) VALUES
	(1, 1, 'Путин-хуйло', 'putin-dickhead', 'Київ, Ялта і Донбас, знають: Путін - підарас! \r\nЗнає навіть наш район, те що Путін є гандон! \r\nКожне місто і село, знають: Путін - це хуйло! \r\nЗнає Польща й США, те що Путіну пізда. \r\nНавіть знає Пакистан, те що Путін уєбан. ', NULL, '2017-02-23', 1);
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
