<?php
error_reporting(E_ALL);

require_once '../PluginCheck.php';

if (empty($plugincheck)) {
  $plugincheck = new PluginCheck();
  $GLOBALS['plugincheck'] = $plugincheck;
}

$plugincheck->css = array();

$plugincheck->js = array('plugin-check');

require_once 'header-functions.php';

if (menuShown()) {
  $tablesRequired = array('administrator', 'options_meta');
  require_once 'lock.php';
}

include_once('../debug.php');

renderHeader($plugincheck);
?>
<div class="ch-container">
  <div class="row">
    <?php
    $width = 12;
    if (menuShown()) {
      $menu = array();
      $menu[] = array(
          'url' => 'compile-plugin.php',
          'text' => 'Plugin Check',
          'icon' => 'flag',
          'toggle' => 'popover',
          'trigger' => 'hover',
          'content' => "Launch the Plugin Check now, where you can select an installed plugin and check it.",
          'placement' => "right",
          'title' => "Plugin Check"
      );
      $menu[] = array(
          'url' => 'compile-app.php',
          'text' => 'App Check',
          'class' => 'red',
          'icon' => 'play',
          'toggle' => 'popover',
          'trigger' => 'hover',
          'content' => "Launch the App Check now, where you can specify or update plugins or apps and validate them.",
          'placement' => "right",
          'title' => "App Check"
      );
      $menu[] = array(
          'url' => 'compile-automated.php',
          'text' => 'Automated Checks',
          'class' => 'red',
          'icon' => 'refresh',
          'spin' => true,
          'toggle' => 'popover',
          'trigger' => 'hover',
          'content' => "Select or upload a plugin and run automated checks on them.",
          'placement' => "right",
          'title' => "App Check"
      );

      renderMenu($menu);
      if (!EZ::isTopMenu()) {
        $width = 10;
      }
    }
    ?>
    <div id="content" class="col-lg-<?php echo $width; ?> col-sm-<?php echo $width; ?>">
    <?php
    if (!menuShown()) {
      renderLogo($plugincheck);
    }
    ?>
    <!-- content starts -->
