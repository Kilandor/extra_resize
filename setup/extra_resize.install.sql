CREATE TABLE IF NOT EXISTS `cot_extra_resize` (
  `extra_id` int(11) NOT NULL AUTO_INCREMENT,
  `extra_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extra_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extra_thname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extra_x` int(11) NOT NULL,
  `extra_y` int(11) NOT NULL,
  `extra_jpg_quality` int(11) NOT NULL,
  `extra_colorbg` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `extra_crop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`extra_id`),
  UNIQUE KEY `extra_thname` (`extra_thname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
