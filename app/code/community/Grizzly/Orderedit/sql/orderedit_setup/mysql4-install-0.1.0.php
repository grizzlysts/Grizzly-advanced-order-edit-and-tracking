<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('orderedit')};
 CREATE TABLE {$this->getTable('orderedit')} (
  `orderedit_id` int(11) unsigned NOT NULL auto_increment,
  `order_id` int(11) NOT NULL default '0',
  `comment_id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL default '',
  `statuslogord` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_id` varchar(255) NOT NULL default '0',
  `user_email` varchar(255) NULL,
  `userfirstname` varchar(255) NULL,
  `userlastname` varchar(255) NULL,
  `usernameadmin` varchar(255) NULL,
  `userageadd` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_time` datetime NULL,
  `user_ip` varchar(255) NOT NULL default '',
  `update_time` datetime NULL,
  PRIMARY KEY (`orderedit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 