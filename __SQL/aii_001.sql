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
CREATE DATABASE IF NOT EXISTS `aii` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `aii`;

-- Дамп структуры для таблица aii.blog_categories
DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Наименование',
  `alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Алиас',
  `text` text COLLATE utf8_unicode_ci COMMENT 'Описание',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Опубликовано',
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата публикации',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`alias`),
  KEY `key` (`alias`,`published`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы aii.blog_categories: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` (`id`, `name`, `alias`, `text`, `published`, `publish_date`) VALUES
	(1, 'Политика', 'politics', 'Все о политике', 1, '2017-02-23 21:35:33');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;

-- Дамп структуры для таблица aii.blog_posts
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Наименование',
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Алиас',
  `text` text COLLATE utf8_unicode_ci COMMENT 'Текст',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Публикация',
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата публикации',
  `category` int(10) NOT NULL COMMENT 'Категория',
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Теги',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`alias`),
  KEY `key` (`alias`,`published`,`category`),
  KEY `FK_blog_posts_blog_categories` (`category`),
  FULLTEXT KEY `tags` (`tags`),
  CONSTRAINT `FK_blog_posts_blog_categories` FOREIGN KEY (`category`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы aii.blog_posts: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` (`id`, `name`, `alias`, `text`, `published`, `publish_date`, `category`, `tags`) VALUES
	(1, 'Путин-хуйло', 'putin-dickhead', 'Київ, Ялта і Донбас, знають: Путін - підарас! \r\nЗнає навіть наш район, те що Путін є гандон! \r\nКожне місто і село, знають: Путін - це хуйло! \r\nЗнає Польща й США, те що Путіну пізда. \r\nНавіть знає Пакистан, те що Путін уєбан. ', 1, '2017-02-23 21:38:08', 1, NULL);
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
