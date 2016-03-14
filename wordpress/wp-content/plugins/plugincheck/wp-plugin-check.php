<?php

require_once 'PluginCheck.php';

if (class_exists("PluginCheck")) {
  $plugincheck = new PluginCheck();

  $plugincheck->init();

}

if (!function_exists('get_plugins')) {
  require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
