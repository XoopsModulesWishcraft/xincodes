CREATE TABLE `xincodes` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `email` varchar(255),
  `created_uid` int(15) DEFAULT '0',
  `claimed_uid` int(15) DEFAULT '0',
  `active` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `Search` (`id`,`code`,`created_uid`,`claimed_uid`,`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
