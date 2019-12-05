# Table: 'if_categories' structure
DROP TABLE IF EXISTS `if_categories`;
CREATE TABLE `if_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(60) default NULL,
  `url_name` varchar(200) default NULL,
  `description` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_categories' data
INSERT INTO `if_categories` (`id`, `name`, `url_name`, `description`) VALUES(1, 'Uncategorized', 'uncategorized', 'Uncategorized');

# Table: 'if_comments' structure
DROP TABLE IF EXISTS `if_comments`;
CREATE TABLE `if_comments` (
  `id` int(11) NOT NULL auto_increment,
  `post_id` int(11) default '0',
  `user_id` int(11) default NULL,
  `author` varchar(50) default NULL,
  `author_email` varchar(100) default NULL,
  `author_website` varchar(200) default NULL,
  `author_ip` varchar(100) NOT NULL,
  `content` text,
  `date` datetime default CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_languages' structure
DROP TABLE IF EXISTS `if_languages`;
CREATE TABLE `if_languages` (
  `id` int(11) NOT NULL auto_increment,
  `language` varchar(100) default NULL,
  `abbreviation` varchar(3) default NULL,
  `author` varchar(100) default NULL,
  `author_website` varchar(255) NOT NULL,
  `is_default` enum('0','1') default NULL,
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_languages' data
INSERT INTO `if_languages` (`id`, `language`, `abbreviation`, `author`, `author_website`, `is_default`) VALUES(1, 'english', 'en', 'Tomaz Muraus', 'http://www.open-blog.info', '1');
INSERT INTO `if_languages` (`id`, `language`, `abbreviation`, `author`, `author_website`, `is_default`) VALUES(2, 'slovene', 'sl', 'Tomaz Muraus', 'http://www.open-blog.info', '0');

# Table: 'if_links' structure
DROP TABLE IF EXISTS `if_links`;
CREATE TABLE `if_links` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `target` enum('blank','self','parent') default 'blank',
  `description` varchar(100) default NULL,
  `visible` enum('yes','no') default 'yes',
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_links' data
INSERT INTO `if_links` (`id`, `name`, `url`, `target`, `description`, `visible`) VALUES(1, 'Open Blog', 'http://www.open-blog.info', 'blank', 'Open Blog Website', 'yes');
INSERT INTO `if_links` (`id`, `name`, `url`, `target`, `description`, `visible`) VALUES(2, 'CodeIgniter', 'http://www.codeigniter.com', 'blank', 'Codeigniter PHP Framework', 'yes');

# Table: 'if_navigation' structure
DROP TABLE IF EXISTS `if_navigation`;
CREATE TABLE `if_navigation` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) default NULL,
  `description` varchar(100) default NULL,
  `url` varchar(255) default NULL,
  `external` enum('0','1') NOT NULL default '0',
  `position` int(11) default '0',
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_navigation' data
INSERT INTO `if_navigation` (`id`, `title`, `description`, `url`, `external`, `position`) VALUES(1, 'Home', 'Index', 'index.php', '0', 1);
INSERT INTO `if_navigation` (`id`, `title`, `description`, `url`, `external`, `position`) VALUES(2, 'Archive', 'Archive', 'blog/archive/', '0', 2);

# Table: 'if_pages' structure
DROP TABLE IF EXISTS `if_pages`;
CREATE TABLE `if_pages` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `url_title` varchar(200) default NULL,
  `author` int(11) default '0',
  `date` date default NULL,
  `content` text,
  `status` enum('active','inactive') default 'active',
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_posts' structure
DROP TABLE IF EXISTS `if_posts`;
CREATE TABLE `if_posts` (
  `id` int(11) NOT NULL auto_increment,
  `author` int(11) NOT NULL default '0',
  `date_posted` datetime NOT NULL default CURRENT_TIMESTAMP,
  `title` varchar(200) character set utf8 NOT NULL,
  `url_title` varchar(200) character set utf8 NOT NULL,
  `excerpt` text character set utf8 NOT NULL,
  `content` longtext character set utf8 NOT NULL,
  `allow_comments` enum('0','1') character set utf8 NOT NULL default '1',
  `sticky` enum('0','1') NOT NULL default '0',
  `status` enum('draft','published') character set utf8 NOT NULL default 'published',
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_posts' data
INSERT INTO `if_posts` (`id`, `author`, `date_posted`, `title`, `url_title`, `excerpt`,`content`, `allow_comments`, `status`) VALUES(1, 1, '2009-01-01', 'Welcome to Open Blog', 'welcome-to-open-blog', 'Congratulations', '<p>Congratulations!</p>\n<p>If you can see this post, this means Open Blog was successfully installed.</p>\n<p>If you need help, don\"t hesitate and visit the Open Blog <a href="http://www.open-blog.info" target="_blank">home page</a>.</p>\n<p>Sincerely,<br />The Open Blog team</p>\n<p><em>Since this is just an example post, feel free to delete it.</em></p>', '1', 'published');

# Table: 'if_posts_to_categories' data
DROP TABLE IF EXISTS `if_posts_to_categories`;
CREATE TABLE `if_posts_to_categories` (
  `id` int(11) NOT NULL auto_increment,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_posts_to_categories' data
INSERT INTO `if_posts_to_categories` (`post_id`, `category_id`) VALUES(1, 1);

# Table: 'if_settings' structure
DROP TABLE IF EXISTS `if_settings`;
CREATE TABLE `if_settings` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`name`)
) DEFAULT CHARSET=utf8;

# Table: 'if_sidebar' structure
DROP TABLE IF EXISTS `if_sidebar`;
CREATE TABLE `if_sidebar` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `status` enum('enabled','disabled') NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_sidebar' data
INSERT INTO `if_sidebar` VALUES(1, 'Search', 'search', 'enabled', 1);
INSERT INTO `if_sidebar` VALUES(2, 'Archive', 'archive', 'enabled', 2);
INSERT INTO `if_sidebar` VALUES(3, 'Categories', 'categories', 'enabled', 3);
INSERT INTO `if_sidebar` VALUES(4, 'Tag_cloud', 'tag_cloud', 'enabled', 4);
INSERT INTO `if_sidebar` VALUES(5, 'Feeds', 'feeds', 'enabled', 5);
INSERT INTO `if_sidebar` VALUES(6, 'Links', 'links', 'enabled', 6);
INSERT INTO `if_sidebar` VALUES(7, 'Other', 'other', 'enabled', 7);

# Table: 'if_tags' data
DROP TABLE IF EXISTS `if_tags`;
CREATE TABLE `if_tags` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_tags' data
INSERT INTO `if_tags` (`id`, `name`) VALUES(1, 'codeigniter');
INSERT INTO `if_tags` (`id`, `name`) VALUES(2, 'blog');

# Table: 'if_tags_to_posts' data
DROP TABLE IF EXISTS `if_tags_to_posts`;
CREATE TABLE `if_tags_to_posts` (
  `id` int(11) NOT NULL auto_increment,
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_tags_to_posts' data
INSERT INTO `if_tags_to_posts` (`id`, `tag_id`, `post_id`) VALUES(1, 1, 1);
INSERT INTO `if_tags_to_posts` (`id`, `tag_id`, `post_id`) VALUES(2, 2, 1);

# Table: 'if_templates' structure
DROP TABLE IF EXISTS `if_templates`;
CREATE TABLE `if_templates` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `author` varchar(100) default NULL,
  `path` varchar(100) default NULL,
  `image` varchar(100) default NULL,
  `is_default` enum('0','1') default '1',
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

# Table: 'if_templates' data
INSERT INTO `if_templates` (`id`, `name`, `author`, `path`, `image`, `is_default`) VALUES(1, 'Colorvoid', 'Arcsin', 'colorvoid', 'colorvoid.jpg', '1');
INSERT INTO `if_templates` (`id`, `name`, `author`, `path`, `image`, `is_default`) VALUES(2, 'Beautiful Day', 'Arcsin', 'beautiful_day', 'beautiful_day.jpg', '0');
INSERT INTO `if_templates` (`id`, `name`, `author`, `path`, `image`, `is_default`) VALUES(3, 'Natural Essence', 'Arcsin', 'natural_essence', 'natural_essence.jpg', '0');
INSERT INTO `if_templates` (`id`, `name`, `author`, `path`, `image`, `is_default`) VALUES(4, 'Contaminated', 'Arcsin', 'contaminated', 'contaminated.jpg', '0');
INSERT INTO `if_templates` (`id`, `name`, `author`, `path`, `image`, `is_default`) VALUES(5, 'Emplode', 'Arcsin', 'emplode', 'emplode.jpg', '0');
INSERT INTO `if_templates` (`id`, `name`, `author`, `path`, `image`, `is_default`) VALUES(6, 'Vector Lover', 'styleshout', 'vector_lover', 'vector_lover.jpg', '0');

# Table: 'if_users' structure
DROP TABLE IF EXISTS `if_users`;
CREATE TABLE `if_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL,
  `password` varchar(64) default NULL,
  `wordpress_password` varchar(64) default NULL,
  `secret_key` varchar(64) default NULL,
  `email` varchar(100) default NULL,
  `website` varchar(100) default NULL,
  `msn_messenger` varchar(200) default NULL,
  `jabber` varchar(100) default NULL,
  `display_name` varchar(50) default NULL,
  `about_me` text default NULL,
  `registered` datetime default CURRENT_TIMESTAMP,
  `last_login` datetime default CURRENT_TIMESTAMP,
  `level` enum('user','administrator') default 'user',
  `status` enum('0','1') default '1',
  PRIMARY KEY  (`id`)
)  DEFAULT CHARSET=utf8;