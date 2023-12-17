CREATE TABLE members (
  `id` bigint(18) NOT NULL,
  `access_token` varchar(30) NOT NULL,
  `refresh_token` varchar(30) NOT NULL,
  `ip` varchar(39) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

REPLASE INTO `members` VALUES (1166277194453090318,'access_token','refresh_token','ip')
