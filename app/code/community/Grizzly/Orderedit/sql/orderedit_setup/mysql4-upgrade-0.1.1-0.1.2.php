<?php

$installer = $this;

$installer->startSetup();

$installer->run("ALTER TABLE `orderedit` CHANGE `status` `status` VARCHAR( 255 ) NOT NULL DEFAULT '0'");

$installer->endSetup(); 