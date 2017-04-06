# ------------------------------------------------------
# Server version 3.23.41
create database webhostpanel;
use webhostpanel;
#
# Table structure for table mail_alias
#

CREATE TABLE `mail_alias` (
  `goto` text NOT NULL,
  `domain` varchar(255) NOT NULL default '',
  `created` date NOT NULL default '0000-00-00',
  `modified` date NOT NULL default '0000-00-00',
  `active` tinyint(4) NOT NULL default '1',
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `address` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='Postfix Admin - Virtual Aliases';


#
# Dumping data for table mail_alias
#


#
# Table structure for table mail_domain
#

CREATE TABLE `mail_domain` (
  `domain` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `aliases` int(10) NOT NULL default '-1',
  `mailboxes` int(10) NOT NULL default '-1',
  `maxquota` int(10) NOT NULL default '-1',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `active` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`domain`),
  KEY `domain` (`domain`)
) TYPE=MyISAM COMMENT='Postfix Admin - Virtual Domains';


#
# Dumping data for table mail_domain
#


#
# Table structure for table mail_mailbox
#

CREATE TABLE `mail_mailbox` (
  `username` varchar(255) NOT NULL default '',
  `password` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `maildir` varchar(255) NOT NULL default '',
  `quota` int(10) NOT NULL default '-1',
  `domain` varchar(255) NOT NULL default '',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `active` tinyint(4) NOT NULL default '1',
  `smtpuser` varchar(255) default NULL,
  `id` smallint(5) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`,`username`)
) TYPE=MyISAM COMMENT='Postfix Admin - Virtual Mailboxes';


#
# Dumping data for table mail_mailbox
#


#
# Table structure for table manageusers
#

CREATE TABLE `manageusers` (
  `domainid` int(6) unsigned NOT NULL default '0',
  `username` varchar(30) NOT NULL default '0',
  `password` varchar(30) NOT NULL default '0',
  `type` enum('F','A') NOT NULL default 'F',
  `name` varchar(30) NOT NULL default '',
  `usershell` varchar(255) NOT NULL default ''
) TYPE=MyISAM;


#
# Dumping data for table manageusers
#


#
# Table structure for table monthly_traffic
#

CREATE TABLE `monthly_traffic` (
  `domainname` varchar(255) NOT NULL default '',
  `yr` varchar(4) NOT NULL default '0',
  `mnt` varchar(4) NOT NULL default '',
  `traffic` bigint(20) default '0'
) TYPE=MyISAM;


#
# Dumping data for table monthly_traffic
#

#
# Table structure for table tbladmincontact
#

CREATE TABLE `tbladmincontact` (
  `companyname` varchar(60) default NULL,
  `contactname` varchar(60) NOT NULL default 'Bankoi',
  `phone` varchar(15) default NULL,
  `fax` varchar(15) default NULL,
  `email` varchar(60) default NULL,
  `address` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(50) default NULL,
  `zipcode` varchar(15) default NULL,
  `country` char(2) default NULL,
  `adminid` int(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (`adminid`)
) TYPE=MyISAM;


#
# Dumping data for table tbladmincontact
#

#
# Table structure for table tblclientcontact
#

CREATE TABLE `tblclientcontact` (
  `companyname` varchar(60) default NULL,
  `contactname` varchar(60) NOT NULL default '0',
  `phone` varchar(15) default NULL,
  `email` varchar(60) default NULL,
  `address` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(50) default NULL,
  `zipcode` varchar(15) default NULL,
  `country` char(2) default NULL,
  `resellerid` int(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (`resellerid`)
) TYPE=MyISAM;


#
# Dumping data for table tblclientcontact
#

#
# Table structure for table tblclientrights
#

CREATE TABLE `tblclientrights` (
  `resellerid` int(6) unsigned NOT NULL default '0',
  `popmailaccount` int(5) NOT NULL default '-1',
  `sqldatabase` int(5) NOT NULL default '-1',
  `pwdprotectdir` enum('Y','N') default 'Y',
  `frontpageext` enum('Y','N') default 'Y',
  `webstart` enum('Y','N') default 'Y',
  `emailalias` int(5) NOT NULL default '-1',
  `domains` int(5) NOT NULL default '-1',
  `diskspace` int(10) NOT NULL default '-1',
  `traffic` mediumint(9) NOT NULL default '-1',
  PRIMARY KEY  (`resellerid`)
) TYPE=MyISAM;


#
# Dumping data for table tblclientrights
#

#
# Table structure for table tblcountry
#

CREATE TABLE `tblcountry` (
  `code` varchar(4) default '0',
  `countryname` varchar(50) default NULL
) TYPE=MyISAM;


#
# Dumping data for table tblcountry
#

INSERT INTO `tblcountry` VALUES ('AF','Afghanistan');
INSERT INTO `tblcountry` VALUES ('AL','Albania');
INSERT INTO `tblcountry` VALUES ('DZ','Algeria');
INSERT INTO `tblcountry` VALUES ('AS','American Samoa');
INSERT INTO `tblcountry` VALUES ('AD','Andorra');
INSERT INTO `tblcountry` VALUES ('AO','Angola');
INSERT INTO `tblcountry` VALUES ('AI','Anguilla');
INSERT INTO `tblcountry` VALUES ('AQ','Antarctica');
INSERT INTO `tblcountry` VALUES ('AG','Antigua and Barbuda');
INSERT INTO `tblcountry` VALUES ('AR','Argentina');
INSERT INTO `tblcountry` VALUES ('AM','Armenia');
INSERT INTO `tblcountry` VALUES ('AW','Aruba');
INSERT INTO `tblcountry` VALUES ('AU','Australia');
INSERT INTO `tblcountry` VALUES ('AT','Austria');
INSERT INTO `tblcountry` VALUES ('AZ','Azerbaidjan');
INSERT INTO `tblcountry` VALUES ('BS','Bahamas');
INSERT INTO `tblcountry` VALUES ('BH','Bahrain');
INSERT INTO `tblcountry` VALUES ('BD','Banglades');
INSERT INTO `tblcountry` VALUES ('BB','Barbados');
INSERT INTO `tblcountry` VALUES ('BY','Belarus');
INSERT INTO `tblcountry` VALUES ('BE','Belgium');
INSERT INTO `tblcountry` VALUES ('BZ','Belize');
INSERT INTO `tblcountry` VALUES ('BJ','Benin');
INSERT INTO `tblcountry` VALUES ('BM','Bermuda');
INSERT INTO `tblcountry` VALUES ('BO','Bolivia');
INSERT INTO `tblcountry` VALUES ('BA','Bosnia-Herzegovina');
INSERT INTO `tblcountry` VALUES ('BW','Botswana');
INSERT INTO `tblcountry` VALUES ('BV','Bouvet Island');
INSERT INTO `tblcountry` VALUES ('BR','Brazil');
INSERT INTO `tblcountry` VALUES ('IO','British Indian O. Terr.');
INSERT INTO `tblcountry` VALUES ('BN','Brunei Darussalam');
INSERT INTO `tblcountry` VALUES ('BG','Bulgaria');
INSERT INTO `tblcountry` VALUES ('BF','Burkina Faso');
INSERT INTO `tblcountry` VALUES ('BI','Burundi');
INSERT INTO `tblcountry` VALUES ('BP','Buthan');
INSERT INTO `tblcountry` VALUES ('KH','Cambodia');
INSERT INTO `tblcountry` VALUES ('CM','Cameroon');
INSERT INTO `tblcountry` VALUES ('CA','Canada');
INSERT INTO `tblcountry` VALUES ('CV','Cape Verde');
INSERT INTO `tblcountry` VALUES ('KY','Cayman Islands');
INSERT INTO `tblcountry` VALUES ('CF','Central African Rep.');
INSERT INTO `tblcountry` VALUES ('TD','Chad');
INSERT INTO `tblcountry` VALUES ('CL','Chile');
INSERT INTO `tblcountry` VALUES ('CN','China');
INSERT INTO `tblcountry` VALUES ('CX','Christmas Island');
INSERT INTO `tblcountry` VALUES ('CC','Cocos (Keeling) Isl.');
INSERT INTO `tblcountry` VALUES ('CO','Colombia');
INSERT INTO `tblcountry` VALUES ('KM','Comoros');
INSERT INTO `tblcountry` VALUES ('CG','Congo');
INSERT INTO `tblcountry` VALUES ('CK','Cook Islands');
INSERT INTO `tblcountry` VALUES ('CR','Costa Rica');
INSERT INTO `tblcountry` VALUES ('HR','Croatia');
INSERT INTO `tblcountry` VALUES ('CU','Cuba');
INSERT INTO `tblcountry` VALUES ('CY','Cyprus');
INSERT INTO `tblcountry` VALUES ('CZ','Czech Republic');
INSERT INTO `tblcountry` VALUES ('CS','Czechoslovakia');
INSERT INTO `tblcountry` VALUES ('DK','Denmark');
INSERT INTO `tblcountry` VALUES ('DJ','Djibouti');
INSERT INTO `tblcountry` VALUES ('DM','Dominica');
INSERT INTO `tblcountry` VALUES ('DO','Dominican Republic');
INSERT INTO `tblcountry` VALUES ('TP','East Timor');
INSERT INTO `tblcountry` VALUES ('EC','Ecuador');
INSERT INTO `tblcountry` VALUES ('EG','Egypt');
INSERT INTO `tblcountry` VALUES ('SV','El Salvador');
INSERT INTO `tblcountry` VALUES ('GQ','Equatorial Guinea');
INSERT INTO `tblcountry` VALUES ('EE','Estonia');
INSERT INTO `tblcountry` VALUES ('ET','Ethiopia');
INSERT INTO `tblcountry` VALUES ('FK','Falkland Isl.(Malvinas)');
INSERT INTO `tblcountry` VALUES ('FO','Faroe Islands');
INSERT INTO `tblcountry` VALUES ('FJ','Fiji');
INSERT INTO `tblcountry` VALUES ('FI','Finland');
INSERT INTO `tblcountry` VALUES ('FR','France');
INSERT INTO `tblcountry` VALUES ('FX','France (European Ter.)');
INSERT INTO `tblcountry` VALUES ('TF','French Southern Terr.');
INSERT INTO `tblcountry` VALUES ('GA','Gabon');
INSERT INTO `tblcountry` VALUES ('GM','Gambia');
INSERT INTO `tblcountry` VALUES ('GE','Georgia');
INSERT INTO `tblcountry` VALUES ('DE','Germany');
INSERT INTO `tblcountry` VALUES ('GH','Ghana');
INSERT INTO `tblcountry` VALUES ('GI','Gibraltar');
INSERT INTO `tblcountry` VALUES ('GR','Greece');
INSERT INTO `tblcountry` VALUES ('GL','Greenland');
INSERT INTO `tblcountry` VALUES ('GD','Grenada');
INSERT INTO `tblcountry` VALUES ('GP','Guadeloupe (Fr.)');
INSERT INTO `tblcountry` VALUES ('GU','Guam (US)');
INSERT INTO `tblcountry` VALUES ('GT','Guatemala');
INSERT INTO `tblcountry` VALUES ('GN','Guinea');
INSERT INTO `tblcountry` VALUES ('GW','Guinea Bissau');
INSERT INTO `tblcountry` VALUES ('GY','Guyana');
INSERT INTO `tblcountry` VALUES ('GF','Guyana (Fr.)');
INSERT INTO `tblcountry` VALUES ('HT','Haiti');
INSERT INTO `tblcountry` VALUES ('HM','Heard & McDonald Isl.');
INSERT INTO `tblcountry` VALUES ('HN','Honduras');
INSERT INTO `tblcountry` VALUES ('HU','Hong Kong');
INSERT INTO `tblcountry` VALUES ('HU','Hungary');
INSERT INTO `tblcountry` VALUES ('IS','Iceland');
INSERT INTO `tblcountry` VALUES ('IN','India');
INSERT INTO `tblcountry` VALUES ('ID','Indonesia');
INSERT INTO `tblcountry` VALUES ('IR','Iran');
INSERT INTO `tblcountry` VALUES ('IQ','Iraq');
INSERT INTO `tblcountry` VALUES ('IE','Ireland');
INSERT INTO `tblcountry` VALUES ('IL','Israel');
INSERT INTO `tblcountry` VALUES ('IT','Italy');
INSERT INTO `tblcountry` VALUES ('CI','Ivory Coast');
INSERT INTO `tblcountry` VALUES ('JM','Jamaica');
INSERT INTO `tblcountry` VALUES ('JP','Japan');
INSERT INTO `tblcountry` VALUES ('JO','Jordan');
INSERT INTO `tblcountry` VALUES ('KZ','Kazakhstan');
INSERT INTO `tblcountry` VALUES ('KE','Kenya');
INSERT INTO `tblcountry` VALUES ('KG','Kyrgyzstan');
INSERT INTO `tblcountry` VALUES ('KI','Kiribati');
INSERT INTO `tblcountry` VALUES ('KP','Korea (North)');
INSERT INTO `tblcountry` VALUES ('KR','Korea (South)');
INSERT INTO `tblcountry` VALUES ('KW','Kuwait');
INSERT INTO `tblcountry` VALUES ('LA','Laos');
INSERT INTO `tblcountry` VALUES ('LV','Latvia');
INSERT INTO `tblcountry` VALUES ('LB','Lebanon');
INSERT INTO `tblcountry` VALUES ('LS','Lesotho');
INSERT INTO `tblcountry` VALUES ('LR','Liberia');
INSERT INTO `tblcountry` VALUES ('LY','Libya');
INSERT INTO `tblcountry` VALUES ('LI','Liechtenstein');
INSERT INTO `tblcountry` VALUES ('LT','Lithuania');
INSERT INTO `tblcountry` VALUES ('LU','Luxembourg');
INSERT INTO `tblcountry` VALUES ('MO','Macau');
INSERT INTO `tblcountry` VALUES ('MG','Madagascar');
INSERT INTO `tblcountry` VALUES ('MW','Malawi');
INSERT INTO `tblcountry` VALUES ('MY','Malaysia');
INSERT INTO `tblcountry` VALUES ('MV','Maldives');
INSERT INTO `tblcountry` VALUES ('ML','Mali');
INSERT INTO `tblcountry` VALUES ('MT','Malta');
INSERT INTO `tblcountry` VALUES ('MH','Marshall Islands');
INSERT INTO `tblcountry` VALUES ('MQ','Martinique (Fr.)');
INSERT INTO `tblcountry` VALUES ('MR','Mauritania');
INSERT INTO `tblcountry` VALUES ('MU','Mauritius');
INSERT INTO `tblcountry` VALUES ('MX','Mexico');
INSERT INTO `tblcountry` VALUES ('FM','Micronesia');
INSERT INTO `tblcountry` VALUES ('MD','Moldavia');
INSERT INTO `tblcountry` VALUES ('MC','Monaco');
INSERT INTO `tblcountry` VALUES ('MN','Mongolia');
INSERT INTO `tblcountry` VALUES ('MS','Montserrat');
INSERT INTO `tblcountry` VALUES ('MC','Morocco');
INSERT INTO `tblcountry` VALUES ('MZ','Mozambique');
INSERT INTO `tblcountry` VALUES ('MM','Myanmar');
INSERT INTO `tblcountry` VALUES ('NA','Namibia');
INSERT INTO `tblcountry` VALUES ('NR','Nauru');
INSERT INTO `tblcountry` VALUES ('NP','Nepal');
INSERT INTO `tblcountry` VALUES ('AN','Netherland Antilles');
INSERT INTO `tblcountry` VALUES ('NL','Netherlands');
INSERT INTO `tblcountry` VALUES ('NT','Neutral Zone');
INSERT INTO `tblcountry` VALUES ('NC','New Caledonia (Fr.)');
INSERT INTO `tblcountry` VALUES ('NZ','New Zealand');
INSERT INTO `tblcountry` VALUES ('NI','Nicaragua');
INSERT INTO `tblcountry` VALUES ('NE','Niger');
INSERT INTO `tblcountry` VALUES ('NG','Nigeria');
INSERT INTO `tblcountry` VALUES ('NU','Niue');
INSERT INTO `tblcountry` VALUES ('NF','Norfolk Island');
INSERT INTO `tblcountry` VALUES ('MP','Northern Mariana Isl.');
INSERT INTO `tblcountry` VALUES ('NO','Norway');
INSERT INTO `tblcountry` VALUES ('OM','Oman');
INSERT INTO `tblcountry` VALUES ('PK','Pakistan');
INSERT INTO `tblcountry` VALUES ('PW','Palau');
INSERT INTO `tblcountry` VALUES ('PA','Panama');
INSERT INTO `tblcountry` VALUES ('PG','Papua New');
INSERT INTO `tblcountry` VALUES ('PY','Paraguay');
INSERT INTO `tblcountry` VALUES ('PE','Peru');
INSERT INTO `tblcountry` VALUES ('PH','Philippines');
INSERT INTO `tblcountry` VALUES ('PN','Pitcairn');
INSERT INTO `tblcountry` VALUES ('PL','Poland');
INSERT INTO `tblcountry` VALUES ('PF','Polynesia (Fr.)');
INSERT INTO `tblcountry` VALUES ('PT','Portugal');
INSERT INTO `tblcountry` VALUES ('PR','Puerto Rico (US)');
INSERT INTO `tblcountry` VALUES ('QA','Qatar');
INSERT INTO `tblcountry` VALUES ('RE','Reunion (Fr.)');
INSERT INTO `tblcountry` VALUES ('RO','Romania');
INSERT INTO `tblcountry` VALUES ('RU','Russian Federation');
INSERT INTO `tblcountry` VALUES ('RW','Rwanda');
INSERT INTO `tblcountry` VALUES ('LC','Saint Lucia');
INSERT INTO `tblcountry` VALUES ('WS','Samoa');
INSERT INTO `tblcountry` VALUES ('SM','San Marino');
INSERT INTO `tblcountry` VALUES ('SA','Saudi Arabia');
INSERT INTO `tblcountry` VALUES ('SN','Senegal');
INSERT INTO `tblcountry` VALUES ('SC','Seychelles');
INSERT INTO `tblcountry` VALUES ('SL','Sierra Leone');
INSERT INTO `tblcountry` VALUES ('SG','Singapore');
INSERT INTO `tblcountry` VALUES ('SK','Slovak Republic');
INSERT INTO `tblcountry` VALUES ('SI','Slovenia');
INSERT INTO `tblcountry` VALUES ('SB','Solomon Islands');
INSERT INTO `tblcountry` VALUES ('SO','Somalia');
INSERT INTO `tblcountry` VALUES ('ZA','South Africa');
INSERT INTO `tblcountry` VALUES ('SU','Soviet Union');
INSERT INTO `tblcountry` VALUES ('ES','Spain');
INSERT INTO `tblcountry` VALUES ('LK','Sri Lanka');
INSERT INTO `tblcountry` VALUES ('SH','St. Helena');
INSERT INTO `tblcountry` VALUES ('PM','St. Pierre & Miquelon');
INSERT INTO `tblcountry` VALUES ('ST','St. Tome and Principe');
INSERT INTO `tblcountry` VALUES ('KN','St.Kitts Nevis Anguilla');
INSERT INTO `tblcountry` VALUES ('VC','St.Vincent & Grenadines');
INSERT INTO `tblcountry` VALUES ('SD','Sudan');
INSERT INTO `tblcountry` VALUES ('SR','Suriname');
INSERT INTO `tblcountry` VALUES ('SJ','Svalbard & Jan Mayen Is');
INSERT INTO `tblcountry` VALUES ('SZ','Swaziland');
INSERT INTO `tblcountry` VALUES ('SE','Sweden');
INSERT INTO `tblcountry` VALUES ('CH','Switzerland');
INSERT INTO `tblcountry` VALUES ('SY','Syria');
INSERT INTO `tblcountry` VALUES ('TJ','Tadjikistan');
INSERT INTO `tblcountry` VALUES ('TW','Taiwan');
INSERT INTO `tblcountry` VALUES ('TZ','Tanzania');
INSERT INTO `tblcountry` VALUES ('TH','Thailand');
INSERT INTO `tblcountry` VALUES ('TG','Togo');
INSERT INTO `tblcountry` VALUES ('TK','Tokelau');
INSERT INTO `tblcountry` VALUES ('TO','Tonga');
INSERT INTO `tblcountry` VALUES ('TT','Trinidad & Tobago');
INSERT INTO `tblcountry` VALUES ('TN','Tunisia');
INSERT INTO `tblcountry` VALUES ('TR','Turkey');
INSERT INTO `tblcountry` VALUES ('TM','Turkmenistan');
INSERT INTO `tblcountry` VALUES ('TC','Turks & Caicos Islands');
INSERT INTO `tblcountry` VALUES ('TV','Tuvalu');
INSERT INTO `tblcountry` VALUES ('UM','US Minor outlying Isl.');
INSERT INTO `tblcountry` VALUES ('UG','Uganda');
INSERT INTO `tblcountry` VALUES ('UA','Ukraine');
INSERT INTO `tblcountry` VALUES ('AE','United Arab Emirates');
INSERT INTO `tblcountry` VALUES ('GB','United Kingdom');
INSERT INTO `tblcountry` VALUES ('US','United States');
INSERT INTO `tblcountry` VALUES ('UY','Uruguay');
INSERT INTO `tblcountry` VALUES ('UZ','Uzbekistan');
INSERT INTO `tblcountry` VALUES ('VU','Vanuatu');
INSERT INTO `tblcountry` VALUES ('VA','Vatican City State');
INSERT INTO `tblcountry` VALUES ('VE','Venezuela');
INSERT INTO `tblcountry` VALUES ('VN','Vietnam');
INSERT INTO `tblcountry` VALUES ('VG','Virgin Islands (British)');
INSERT INTO `tblcountry` VALUES ('VI','Virgin Islands (US)');
INSERT INTO `tblcountry` VALUES ('WF','Wallis & Futuna Islands');
INSERT INTO `tblcountry` VALUES ('EH','Western Sahara');
INSERT INTO `tblcountry` VALUES ('YE','Yemen');
INSERT INTO `tblcountry` VALUES ('YU','Yugoslavia');
INSERT INTO `tblcountry` VALUES ('ZR','Zaire');
INSERT INTO `tblcountry` VALUES ('ZM','Zambia');

#
# Table structure for table tblcron
#

CREATE TABLE `tblcron` (
  `domainid` int(6) unsigned default '0',
  `cronminute` varchar(50) default '0',
  `cronday` varchar(50) default '0',
  `cronmonth` varchar(50) default '0',
  `cronweek` varchar(50) default '0',
  `croncommand` varchar(255) default '0',
  `cronhour` varchar(255) default NULL,
  `id` tinyint(3) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


#
# Dumping data for table tblcron
#


#
# Table structure for table tbldatabase
#

CREATE TABLE `tbldatabase` (
  `domainid` int(6) default '0',
  `databasename` varchar(30) default NULL,
  `dbusername` varchar(30) NOT NULL default '',
  `dbpassword` varchar(30) NOT NULL default '',
  `dbtype` varchar(20) default NULL
) TYPE=MyISAM;


#
# Dumping data for table tbldatabase
#


#
# Table structure for table tbldirpass
#

CREATE TABLE `tbldirpass` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `domainname` varchar(60) NOT NULL default '',
  `dirname` varchar(30) default NULL,
  `username` varchar(25) NOT NULL default '',
  `passwd` varchar(40) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


#
# Dumping data for table tbldirpass
#


#
# Table structure for table tbldnsdomain
#

CREATE TABLE `tbldnsdomain` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `domainid` int(6) NOT NULL default '0',
  `host` varchar(255) NOT NULL default '',
  `recordtype` varchar(200) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


#
# Dumping data for table tbldnsdomain
#


#
# Table structure for table tbldnsslave
#

CREATE TABLE `tbldnsslave` (
  `domainid` int(6) unsigned NOT NULL default '0',
  `host` varchar(255) NOT NULL default '',
  `masterip` varchar(255) NOT NULL default ''
) TYPE=MyISAM;


#
# Dumping data for table tbldnsslave
#


#
# Table structure for table tbldnsstatus
#

CREATE TABLE `tbldnsstatus` (
  `Id` int(10) unsigned NOT NULL auto_increment,
  `domainid` int(6) unsigned NOT NULL default '0',
  `status` char(7) NOT NULL default '',
  PRIMARY KEY  (`Id`)
) TYPE=MyISAM;


#
# Dumping data for table tbldnsstatus
#


#
# Table structure for table tbldnstemplate
#

CREATE TABLE `tbldnstemplate` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `host` varchar(255) NOT NULL default '',
  `recordtype` varchar(255) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  `resellerid` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


#
# Dumping data for table tbldnstemplate
#

#
# Table structure for table tbldomain
#

CREATE TABLE `tbldomain` (
  `domainid` int(6) NOT NULL auto_increment,
  `domainname` varchar(255) NOT NULL default '',
  `resellerid` int(6) unsigned default NULL,
  `domainlimits` int(5) NOT NULL default '0',
  `ipaddress` varchar(15) default NULL,
  `hosting` enum('Y','N') NOT NULL default 'N',
  PRIMARY KEY  (`domainid`)
) TYPE=MyISAM;


#
# Dumping data for table tbldomain
#


#
# Table structure for table tbldomaincontact
#

CREATE TABLE `tbldomaincontact` (
  `companyname` varchar(60) default NULL,
  `contactname` varchar(60) NOT NULL default '0',
  `phone` varchar(15) default NULL,
  `email` varchar(60) default NULL,
  `address` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(50) default NULL,
  `zipcode` varchar(15) default NULL,
  `country` char(2) default NULL,
  `domainid` int(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (`domainid`)
) TYPE=MyISAM;


#
# Dumping data for table tbldomaincontact
#


#
# Table structure for table tbldomainfp
#

CREATE TABLE `tbldomainfp` (
  `domainid` int(5) unsigned NOT NULL default '0',
  `fpsupport` tinyint(1) unsigned default '0',
  `fpsupportssl` tinyint(1) unsigned default '0',
  `fpauth` tinyint(1) unsigned default '0',
  `fplogin` varchar(255) default '0',
  `fppassword` varchar(255) default '0',
  PRIMARY KEY  (`domainid`)
) TYPE=MyISAM;


#
# Dumping data for table tbldomainfp
#


#
# Table structure for table tbldomainpref
#

CREATE TABLE `tbldomainpref` (
  `domainid` int(6) unsigned default '0',
  `pwdprotect` enum('Y','N') default 'N',
  `cgisupport` enum('Y','N') default 'N',
  `frontpageext` enum('Y','N') default 'N',
  `traffic` enum('Y','N') default 'N',
  `webstart` enum('Y','N') default 'N'
) TYPE=MyISAM;


#
# Dumping data for table tbldomainpref
#


#
# Table structure for table tbldomainrights
#

CREATE TABLE `tbldomainrights` (
  `domainid` int(6) unsigned NOT NULL default '0',
  `popmailaccount` int(5) default '0',
  `sqldatabase` int(5) default NULL,
  `pwdprotectdir` enum('Y','N') default 'N',
  `cgisupport` enum('Y','N') default 'N',
  `frontpageext` enum('Y','N') default 'N',
  `diskspace` int(11) NOT NULL default '0',
  `webstart` enum('Y','N') default 'N',
  `emailalias` int(5) NOT NULL default '0',
  `traffic` mediumint(9) NOT NULL default '0',
  `subdomains` tinyint(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (`domainid`)
) TYPE=MyISAM;


#
# Dumping data for table tbldomainrights
#


#
# Table structure for table tblfirsttime
#

CREATE TABLE `tblfirsttime` (
  `status` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`status`)
) TYPE=MyISAM;


#
# Dumping data for table tblfirsttime
#

INSERT INTO `tblfirsttime` VALUES (0);

#
# Table structure for table tblftpinfo
#

CREATE TABLE `tblftpinfo` (
  `domainid` int(6) NOT NULL default '0',
  `ftpusername` varchar(30) default NULL,
  `ftppassword` varchar(30) default NULL,
  `type` char(1) default NULL,
  `shellname` varchar(255) default NULL,
  `status` tinyint(4) default '1'
) TYPE=MyISAM;


#
# Dumping data for table tblftpinfo
#


#
# Table structure for table tblloginmaster
#

CREATE TABLE `tblloginmaster` (
  `username` varchar(60) NOT NULL default '',
  `password` varchar(30) NOT NULL default '',
  `usertype` char(1) NOT NULL default '',
  `status` char(1) NOT NULL default '1',
  `id` int(6) NOT NULL auto_increment,
  `regdate` date default '2004-03-08',
  `typeid` int(6) unsigned NOT NULL default '0',
  `skinname` varchar(150) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


#
# Dumping data for table tblloginmaster
#

INSERT INTO `tblloginmaster` VALUES ('admin','ddR51x67','a','1',1,'2004-03-08',0,'default');

#
# Table structure for table tbllogrotate
#

CREATE TABLE `tbllogrotate` (
  `domainid` int(6) unsigned NOT NULL auto_increment,
  `condition` varchar(255) default 'size',
  `files_no` tinyint(4) default '3',
  `condition_val` varchar(255) default '50000',
  `status` tinyint(4) default '1',
  `compressed` tinyint(4) default '0',
  PRIMARY KEY  (`domainid`)
) TYPE=MyISAM;


#
# Dumping data for table tbllogrotate
#


#
# Table structure for table tblmailaddress
#

CREATE TABLE `tblmailaddress` (
  `id` int(11) NOT NULL auto_increment,
  `domainname` varchar(255) default NULL,
  `domainid` int(11) default NULL,
  `mailname` varchar(255) default NULL,
  `mailpass` varchar(255) default NULL,
  `isalias` tinyint(4) default NULL,
  `redirectadd` varchar(255) default NULL,
  `actiontype` tinyint(4) default NULL,
  `processed` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


#
# Dumping data for table tblmailaddress
#


#
# Table structure for table tblmaildomain
#

CREATE TABLE `tblmaildomain` (
  `domainid` int(11) NOT NULL default '0',
  `domainname` varchar(255) default NULL,
  `actiontype` tinyint(4) default NULL
) TYPE=MyISAM;


#
# Dumping data for table tblmaildomain
#


#
# Table structure for table tblreseller
#

CREATE TABLE `tblreseller` (
  `resellerid` int(6) NOT NULL auto_increment,
  `resellerlimit` int(5) default '0',
  `logo` varchar(30) default NULL,
  `supportlink` varchar(30) default NULL,
  `resellername` varchar(60) default NULL,
  PRIMARY KEY  (`resellerid`)
) TYPE=MyISAM;


#
# Dumping data for table tblreseller
#


#
# Table structure for table tblresellerip
#

CREATE TABLE `tblresellerip` (
  `resellerid` varchar(10) default '0',
  `ipaddress` int(6) unsigned default '0'
) TYPE=MyISAM;


#
# Dumping data for table tblresellerip
#


#
# Table structure for table tblserverip
#

CREATE TABLE `tblserverip` (
  `Id` int(6) unsigned NOT NULL auto_increment,
  `ipaddress` varchar(15) NOT NULL default '',
  `subnet` varchar(15) NOT NULL default '',
  `interface` varchar(15) NOT NULL default 'eth0',
  `iptype` varchar(20) NOT NULL default '',
  `isavailable` enum('Y','N') NOT NULL default 'Y',
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`Id`)
) TYPE=MyISAM;


#
# Dumping data for table tblserverip
#


#
# Table structure for table tblsubdomain
#

CREATE TABLE `tblsubdomain` (
  `domainid` int(6) default NULL,
  `subdomain` varchar(255) default NULL,
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `id` tinyint(6) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


#
# Dumping data for table tblsubdomain
#
use mysql
grant all privileges on webhostpanel.* to webhostpanel@'localhost' identified by 'ddR51x67';
update user set Select_priv='Y',Insert_priv='Y',Update_priv='Y',Delete_priv='Y',Create_priv='Y',Drop_priv='Y',Reload_priv='Y',Shutdown_priv='y',Process_priv='Y',File_priv='Y',Grant_priv='Y',References_priv='Y',Index_priv='Y',Alter_priv='Y' where user='webhostpanel';
flush privileges;
