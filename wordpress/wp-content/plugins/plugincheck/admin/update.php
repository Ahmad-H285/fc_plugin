<?php
require 'header.php';
require_once 'Updater.php';
$updater = new Updater('plugin-check');
$updater->name = "Plugin Check";
$updater->price = "5.95";
$updater->render();
require 'footer.php';
