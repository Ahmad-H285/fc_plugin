<?php

require_once('../../EZ.php');
require_once '../Updater.php';

$updater = new Updater('plugin-check');
$updater->name = "Plugin Check";
$updater->toVerify = array('plugin-check.php', 'wp-plugin-check.php');

$updater->handle();
