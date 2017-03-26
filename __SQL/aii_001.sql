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

-- Дамп структуры для таблица aii.blog_categories
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Категории';

-- Дамп данных таблицы aii.blog_categories: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` (`id`, `name`, `alias`, `text`, `date`, `status`) VALUES
	(1, 'Политика', 'politics', 'Все о политике', '2017-02-22', 1),
	(4, 'Юмор', 'yumor', 'Юмор', '2017-03-22', 1);
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;

-- Дамп структуры для таблица aii.blog_comments
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `post_id` int(10) NOT NULL COMMENT 'Пост',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Имя',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'E-Mail',
  `text` text COLLATE utf8_unicode_ci COMMENT 'Текст',
  `date` date DEFAULT NULL COMMENT 'Дата',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Опубликовано',
  PRIMARY KEY (`id`),
  KEY `FK_blog_comments_blog_posts` (`post_id`),
  KEY `key` (`status`),
  CONSTRAINT `FK_blog_comments_blog_posts` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Комментарии к постам';

-- Дамп данных таблицы aii.blog_comments: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_comments` DISABLE KEYS */;
INSERT INTO `blog_comments` (`id`, `post_id`, `name`, `email`, `text`, `date`, `status`) VALUES
	(1, 1, 'Andrew', 'andr@mail.mk', 'Путин-хуйло!!', '2017-03-26', 1),
	(2, 2, 'Andrew', 'andr@mail.mk', 'Хуевый анекдот', '2017-03-26', 1);
/*!40000 ALTER TABLE `blog_comments` ENABLE KEYS */;

-- Дамп структуры для таблица aii.blog_posts
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `category` int(10) NOT NULL COMMENT 'Категория',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Наименование',
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Алиас',
  `text` text COLLATE utf8_unicode_ci COMMENT 'Текст',
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Теги',
  `date` date DEFAULT NULL COMMENT 'Дата публикации',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Опубликовано',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`alias`),
  KEY `FK_blog_posts_blog_categories` (`category`),
  KEY `key` (`alias`,`status`),
  FULLTEXT KEY `tags` (`tags`),
  CONSTRAINT `FK_blog_posts_blog_categories` FOREIGN KEY (`category`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Посты';

-- Дамп данных таблицы aii.blog_posts: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` (`id`, `category`, `name`, `alias`, `text`, `tags`, `date`, `status`) VALUES
	(1, 1, 'Путин-хуйло', 'putin-dickhead', 'Київ, Ялта і Донбас, знають: Путін - підарас! \r\nЗнає навіть наш район, те що Путін є гандон! \r\nКожне місто і село, знають: Путін - це хуйло! \r\nЗнає Польща й США, те що Путіну пізда. \r\nНавіть знає Пакистан, те що Путін уєбан. ', NULL, '2017-02-23', 1),
	(2, 4, 'Анекдот', 'anecdot', 'Кого-то выебали в рот, вот такой, бля анекдот', NULL, '2017-03-22', 1),
	(3, 1, 'yytu', 'yytu', 'ytuytuty', 'djfvhjk fjweb  wejfde', '2017-03-23', 1),
	(4, 4, 'eqrfer', 'eqrfer', 'veqvervewr', 'veqeeve', '2017-03-23', 1);
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
