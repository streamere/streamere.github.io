INSERT IGNORE INTO settings (var,value) VALUES ('genres','');
INSERT IGNORE INTO settings (var,value) VALUES ('use_cache','1');
INSERT IGNORE INTO settings (var,value) VALUES ('registration','1');
INSERT IGNORE INTO settings (var,value) VALUES ('md5updated','');
INSERT IGNORE INTO settings (var,value) VALUES ('start_youtube','0');
INSERT IGNORE INTO settings (var,value) VALUES ('gwebmaster','');
INSERT IGNORE INTO settings (var,value) VALUES ('ads_refresh','0');
INSERT IGNORE INTO settings (var,value) VALUES ('purchase_code','');
INSERT IGNORE INTO settings (var,value) VALUES ('custom_video_error','UzatNVbmL6k');
INSERT IGNORE INTO settings (var,value) VALUES ('audio_ads','');
INSERT IGNORE INTO settings (var,value) VALUES ('meta_keywords','');
INSERT IGNORE INTO settings (var,value) VALUES ('limit_activity_page','50');
INSERT IGNORE INTO settings (var,value) VALUES ('limit_activity_profile','50');
INSERT IGNORE INTO settings (var,value) VALUES ('export_playlist','1');
INSERT IGNORE INTO settings (var,value) VALUES ('auto_country','1');
INSERT IGNORE INTO settings (var,value) VALUES ('biography_lang','en');
INSERT IGNORE INTO settings (var,value) VALUES ('theme_mobile','default');
INSERT IGNORE INTO settings (var,value) VALUES ('smtp_host','ssl://smtp.gmail.com');
INSERT IGNORE INTO settings (var,value) VALUES ('smtp_port','465');
INSERT IGNORE INTO settings (var,value) VALUES ('smtp_user','');
INSERT IGNORE INTO settings (var,value) VALUES ('smtp_pass','');
INSERT IGNORE INTO settings (var,value) VALUES ('hide_ads_registered','0');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_type','disqus');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_profile','1');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_songinfo','1');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_artist','1');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_albums','1');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_register_user','0');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_fb_id','');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_fb_app_id','');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_disqus_id','');
INSERT IGNORE INTO settings (var,value) VALUES ('col_xs','12');
INSERT IGNORE INTO settings (var,value) VALUES ('col_sm','12');
INSERT IGNORE INTO settings (var,value) VALUES ('col_md','4');
INSERT IGNORE INTO settings (var,value) VALUES ('col_lg','3');
INSERT IGNORE INTO settings (var,value) VALUES ('comment_facebook_colors','dark');
INSERT IGNORE INTO settings (var,value) VALUES ('download_service','http://youtube.andthemusic.net/?url=%youtube_url%');
INSERT IGNORE INTO settings (var,value) VALUES ('top_tracks_link','TopTracks');
INSERT IGNORE INTO settings (var,value) VALUES ('clean_cache','0');
INSERT IGNORE INTO settings (var,value) VALUES ('activity_module','1');
INSERT IGNORE INTO settings (var,value) VALUES ('brand_link','Activity');
INSERT IGNORE INTO settings (var,value) VALUES ('youtube_controls','0');
INSERT IGNORE INTO settings (var,value) VALUES ('youtube_api_key','');
INSERT IGNORE INTO settings (var,value) VALUES ('youtube_quality','small');
INSERT IGNORE INTO settings (var,value) VALUES ('twitter_username','');
INSERT IGNORE INTO settings (var,value) VALUES ('facebook_fanpage','');
INSERT IGNORE INTO settings (var,value) VALUES ('popup_guest','1');
INSERT IGNORE INTO settings (var,value) VALUES ('skin_color','');
INSERT IGNORE INTO settings (var,value) VALUES ('module_user_online','1');
INSERT IGNORE INTO settings (var,value) VALUES ('local_lyrics','0');
INSERT IGNORE INTO settings (var,value) VALUES ('custom_genres','');
INSERT IGNORE INTO settings (var,value) VALUES ('footer_script','');
INSERT IGNORE INTO settings (var,value) VALUES ('page_ajax_script','');
INSERT IGNORE INTO settings (var,value) VALUES ('loginfb','0');
INSERT IGNORE INTO settings (var,value) VALUES ('fb_appId','');
INSERT IGNORE INTO settings (var,value) VALUES ('fb_secret','');
ALTER TABLE users ADD COLUMN recovery varchar(50) NOT NULL;
ALTER TABLE users ADD COLUMN avatar LONGTEXT NOT NULL;
ALTER TABLE users ADD COLUMN bio text NOT NULL;
ALTER TABLE users ADD COLUMN nickname varchar(100) NOT NULL;
ALTER TABLE users ADD COLUMN activity_global varchar(1) DEFAULT '1' NOT NULL;
ALTER TABLE users ADD COLUMN idfacebook VARCHAR( 100 ) NOT NULL ;
ALTER TABLE users ADD COLUMN public_chat VARCHAR( 1 ) default '1' NOT NULL ;
UPDATE users set nickname = CONCAT('guest',substring(SHA1(id),1,8)) WHERE nickname IS NULL OR nickname = '';
UPDATE users set nickname = REPLACE(nickname,'.','_') WHERE  nickname like '%.%';
UPDATE users set avatar = 'http://andthemusic.net/yme/assets/images/default_avatar.jpg' WHERE avatar IS NULL OR avatar = '';
CREATE TABLE IF NOT EXISTS `playlist` (
  `idplaylist` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `json` longtext NOT NULL,
  `public` varchar(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`idplaylist`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
INSERT IGNORE INTO settings (var,value) VALUES ('items_search','30');
INSERT IGNORE INTO settings (var,value) VALUES ('items_top','50');
CREATE TABLE IF NOT EXISTS `pages` (
  `idpage` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`idpage`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `activity` (
  `idactivity` bigint(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `action` int(11) NOT NULL COMMENT '1 => Play, 2 => Playlist',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `artist` varchar(100) NOT NULL,
  `track` varchar(100) NOT NULL,
  `idplaylist` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  PRIMARY KEY (`idactivity`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `follows` (  
  `iduser` int(11) NOT NULL,
  `iduserf` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  
  UNIQUE KEY `iduser` (`iduser`,`iduserf`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS  `ci_sessions` (
  session_id varchar(40) DEFAULT '0' NOT NULL,
  ip_address varchar(45) DEFAULT '0' NOT NULL,
  user_agent varchar(120) NOT NULL,
  last_activity int(10) unsigned DEFAULT 0 NOT NULL,
  user_data text NOT NULL,
  PRIMARY KEY (session_id),
  KEY `last_activity_idx` (`last_activity`)
);
CREATE TABLE IF NOT EXISTS `top_page_artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(150) NOT NULL,
  `cover` varchar(250) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `artist` (`artist`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `lyrics` (
  `idlyrics` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `track` varchar(100) NOT NULL,
  `lyric` longtext NOT NULL,
  PRIMARY KEY (`idlyrics`),
  UNIQUE KEY `artist_2` (`artist`,`track`),
  KEY `artist` (`artist`(50),`track`(50))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `online` (
  `iduser` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(150) NOT NULL,
  `type` enum('user','guest','robot','other') NOT NULL,
  UNIQUE KEY `iduser` (`iduser`,`ip`),
  KEY `iduser_2` (`iduser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `chat` (
  `iduser` int(11) NOT NULL,
  `idfriend` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `seen` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `extra_menus` (
  `title` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `keyname` varchar(20) NOT NULL,
  `route` varchar(100) NOT NULL,
  UNIQUE KEY `route` (`route`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `iduserf` int(11) NOT NULL,
  `type` varchar(1) NOT NULL DEFAULT 'f',
  `date` datetime NOT NULL,
  `seen` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iduser` (`iduser`,`iduserf`,`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
INSERT IGNORE INTO extra_menus (title,icon,route,keyname) VALUES ('Facebook Login','fa fa-facebook','dashboard/facebook_setting','facebook');
ALTER TABLE activity ADD COLUMN picture varchar(250) DEFAULT '' NOT NULL;
ALTER TABLE chat ADD  COLUMN date2 DATETIME NOT NULL ;
DROP INDEX dater_i ON activity;
CREATE INDEX dater_i ON activity ( `date`);
DROP INDEX id ON users;
CREATE INDEX id_i ON users ( `id`);
DROP INDEX iduser_i ON activity;
CREATE INDEX iduser_i ON activity ( `iduser`);
DROP INDEX activity_global_i ON users;
CREATE INDEX activity_global_i ON users ( `activity_global`);
delete from activity where picture ='' and action ='1';  
