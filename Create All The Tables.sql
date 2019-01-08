

CREATE TABLE `scouts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `schedule` (
  `match_number` int(10) unsigned NOT NULL,
  `time` varchar(45) DEFAULT NULL,
  `red_1` int(10) unsigned NOT NULL,
  `red_2` int(10) unsigned NOT NULL,
  `red_3` int(10) unsigned NOT NULL,
  `blue_1` int(10) unsigned NOT NULL,
  `blue_2` int(10) unsigned NOT NULL,
  `blue_3` int(10) unsigned NOT NULL,
  PRIMARY KEY (`match_number`),
  UNIQUE KEY `match_number_UNIQUE` (`match_number`),
  KEY `fred_idx` (`red_1`),
  KEY `jeffrey_idx` (`red_2`),
  KEY `susan_idx` (`red_3`),
  KEY `robert_idx` (`blue_1`),
  KEY `kyle_idx` (`blue_2`),
  KEY `sam_idx` (`blue_3`),
  CONSTRAINT `fred` FOREIGN KEY (`red_1`) REFERENCES `teams` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `jeffrey` FOREIGN KEY (`red_2`) REFERENCES `teams` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `kyle` FOREIGN KEY (`blue_2`) REFERENCES `teams` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `robert` FOREIGN KEY (`blue_1`) REFERENCES `teams` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sam` FOREIGN KEY (`blue_3`) REFERENCES `teams` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `susan` FOREIGN KEY (`red_3`) REFERENCES `teams` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` int(10) unsigned NOT NULL,
  `type` int(10) unsigned DEFAULT '1',
  `match_number` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `mike_idx` (`team`),
  CONSTRAINT `mike` FOREIGN KEY (`team`) REFERENCES `teams` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `match_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_number` int(10) unsigned NOT NULL,
  `team_number` int(10) unsigned NOT NULL,
  `scout_id` int(11) NOT NULL,
  `no_show` tinyint(4) DEFAULT NULL,
  `mech_fail` tinyint(4) DEFAULT NULL,
  `lost_comms` tinyint(4) DEFAULT NULL,
  `fouls` int(11) DEFAULT NULL,
  `tech_fouls` int(11) DEFAULT NULL,
  `drive_rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unque` (`match_number`,`team_number`),
  KEY `billybobket]y_idx` (`team_number`),
  KEY `fdcvf_idx` (`match_number`),
  KEY `scoutLink_idx` (`scout_id`),
  CONSTRAINT `billybobket]y` FOREIGN KEY (`team_number`) REFERENCES `teams` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fdcvf` FOREIGN KEY (`match_number`) REFERENCES `schedule` (`match_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `scoutLink` FOREIGN KEY (`scout_id`) REFERENCES `scouts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='		';

