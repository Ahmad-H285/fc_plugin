<?php

if (!class_exists("PluginCheck")) {

  require_once 'EzPlugin.php';

  class PluginCheck extends EzPlugin {

    public function __construct() {
      $this->name = "Plugin Check";
      $this->adminLogo = $this->mainLogo = $this->key = "plugin-check";
      $this->slogan = "Validate Your Plugins";
      $this->class = __CLASS__;
      parent::__construct(__DIR__ . '/plugin-check.php');
    }

    static function install($dir = '', $mOptions = 'plugincheck') {
      parent::install(__DIR__, 'plugincheck');
    }

    static function uninstall($mOptions = 'plugincheck') {
      parent::uninstall('plugincheck');
    }

  }

} //End Class PluginCheck
