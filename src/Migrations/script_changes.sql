CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uploadId` int(11) DEFAULT NULL,
  `personId` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `people_phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personId` int(11) DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `shiporders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uploadId` int(11) DEFAULT NULL,
  `orderId` int(11) DEFAULT NULL,
  `personId` int(11) DEFAULT NULL,
  `shipTo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipAddress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipCity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipCountry` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `shiporders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shiporderId` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` tinyint(1) DEFAULT NULL COMMENT '1 - people / 2 - orders',
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;