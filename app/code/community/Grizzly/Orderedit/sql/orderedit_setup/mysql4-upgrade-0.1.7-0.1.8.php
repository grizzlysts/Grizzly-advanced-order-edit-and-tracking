<?php

$installer = $this;

$installer->startSetup();

$installer->run("ALTER TABLE `orderedit` CHANGE `userageadd` `userageadd` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ;");

$installer->endSetup(); 