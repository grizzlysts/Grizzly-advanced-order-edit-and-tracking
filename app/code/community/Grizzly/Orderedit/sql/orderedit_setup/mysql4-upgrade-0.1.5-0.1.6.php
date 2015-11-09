<?php

$installer = $this;

$installer->startSetup();

$installer->run("ALTER TABLE `orderedit` ADD `userageadd` VARCHAR( 255 ) NULL AFTER `usernameadmin`");

$installer->endSetup(); 