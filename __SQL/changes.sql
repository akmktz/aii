ALTER TABLE `blog_categories`
	CHANGE COLUMN `published` `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Опубликовано' AFTER `text`,
	CHANGE COLUMN `publish_date` `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата публикации' AFTER `status`
	CHANGE COLUMN `status` `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Опубликовано' AFTER `date`;
