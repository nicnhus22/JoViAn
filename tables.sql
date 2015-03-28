
--
-- Table structure for table `reg_users`
--

use kgcd353_4;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users (email,password,username) VALUES ("admin@admin.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","admin");

ALTER TABLE `users`
ADD COLUMN `priveledge` ENUM('admin', 'regular') NOT NULL DEFAULT 'regular' AFTER `username`;

UPDATE `users` SET `privelege`='admin' WHERE `id`='1';