ALTER TABLE `blog_categories`
	CHANGE COLUMN `published` `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Опубликовано' AFTER `text`,
	CHANGE COLUMN `publish_date` `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата публикации' AFTER `status`,
	CHANGE COLUMN `status` `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Опубликовано' AFTER `date`,
	CHANGE COLUMN `date` `date` DATE NULL DEFAULT NULL COMMENT 'Дата публикации' AFTER `text`;

ALTER TABLE `blog_posts`
	CHANGE COLUMN `published` `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Опубликовано' AFTER `text`,
	CHANGE COLUMN `publish_date` `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата публикации' AFTER `status`,
	CHANGE COLUMN `date` `date` DATE NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата публикации' AFTER `tags`,
	CHANGE COLUMN `date` `date` DATE NULL DEFAULT NULL COMMENT 'Дата публикации' AFTER `tags`;
