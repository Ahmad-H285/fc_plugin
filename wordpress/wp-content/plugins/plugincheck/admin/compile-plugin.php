<?php require 'header.php'; ?>
<div>
  <ul class="breadcrumb">
    <li>
      <a href="#">Home</a>
    </li>
    <li>
      <a href="#">Plugin Check</a>
    </li>
  </ul>
</div>

<?php
insertAlerts(12);
openBox("Plugin Check", "flag", 12);
$pwd = realpath("../..");
$modes = array();

$plugins = array();
if (function_exists('get_plugins')) {
  $allPlugins = get_plugins() + get_plugins('/../mu-plugins/');
  foreach ($allPlugins as $slug => $p) {
    $pruned = dirname($slug);
    if (!empty($pruned) && $pruned != '.') {
      $plugins[] = $pruned;
    }
  }
}
else if (!empty(EZ::$options['wp_plugin_dir'])) {
  $folder = EZ::$options['wp_plugin_dir'];
  $dirs = glob("$folder/*", GLOB_ONLYDIR);
  if (!empty($dirs)) {
    foreach ($dirs as $folder) {
      $plugins[$folder] = basename($folder);
    }
  }
}

$modes['plugin'] = array('name' => 'Select a Plugin',
    'help' => 'Select one of these plugins on your WordPress installation. The Pseudo Compiler will go through the files and report any undefined functions or methods.',
    'type' => 'select',
    'trClass' => 'info',
    'options' => $plugins,
    'fake' => true,
    'value' => '');

if (empty($plugins)) {
  $modes['plugin']['help'] .= "<p class=\"red\">Looks like the plugin folder is not set. Please go to <strong>Configuration &rarr; Advanced Options</strong> to set it. (Only availabe in the Pro version.)</p>";
  $modes['plugin']['type'] = 'button';
  $modes['plugin']['value'] = 'Go to Configuration &rarr; Advanced Options';
  $modes['plugin']['class'] = 'sm';
}

require_once 'OptionTable.php';
require_once('options-compile.php');
$modes = $modes + $compileOptions;
$optionTable = new OptionTable($modes);
$optionTable->render(6);
?>
<div class="col-md-6">
  <p>
    In order to check a plugin for undefined functions and methods, select it by clicking on the <em class="red">Empty</em> value in the first (hihglighted) row. The checker will launch automatically. The following options can be specified before selecting the plugin.
  </p>
  <ul>
    <li><b>Show Defined Functions</b>: By default, Plugin Check shows only undefined functions and methods. Check this option to view defined ones as well.</li>
    <li><b>Suppress Duplicates</b> By default, Plugin Check lists and checks all instances of functions used or not found. You can suppress duplications using this option, which may make the output of large projects more readable.</li>
    <li><b>Execution Time</b> <span class='red'>Pro Feature</span>: If you have large plugins or applications to validate, you may run out of time. If that happens, you may increase the execution time limit here. The number is in seconds. Typical value is 30s.</li>
    <li><b>Memory Limit</b> <span class='red'>Pro Feature</span>: If you have large plugins or applications to validate, you may run out of memory. If that happens, you may increase the memory limit here. The number is in MB. Typical value is 128. You may give up to 2048, depending on your system.</li>
    <li><b>Show Source</b> <span class='red'>Pro Feature</span>: The plugin is validated by generating a source string out of the plugin files and <code>eval</code>ing it. Check this option if you would like to see the source that is generated.</li>
    <li><b>Show Detected Tokens</b> <span class='red'>Pro Feature</span>: The plugin is validated by generating a source string out of the plugin files and <code>eval</code>ing it. Check this option if you would like to see the source that is generated.</li>
  </ul>
</div>
<div class="clearfix"></div>
<p class="center-text">
  <a class="btn btn-success center-text relaunch" href="#" data-toggle='tooltip' title='Clear any previous output and relaunch the Plugin Check'><i class="glyphicon glyphicon-refresh icon-white"></i>&nbsp; Restart <strong>Plugin Check</strong></a>
</p>
<?php
closeBox();
?>
<script>
  $(document).ready(function () {
    $(".xedit").editable({success: function (response, newValue) {
        if (!newValue)
          return;
        showSuccess("&emsp;<img src='img/loading.gif' alt='loading' />&emsp;Loading... Please wait!");
        hideWarning();
        hideError();
        $.ajax({
          url: 'ajax/compile.php',
          type: 'GET',
          data: {action: $(this).attr('id'),
            value: newValue},
          success: function (response) {
            hideSuccess();
            if (response.success)
              showSuccess(response.success);
            if (response.warning)
              showWarning(response.warning);
            if (response.error)
              showError(response.error);
          },
          error: function (a) {
            hideSuccess();
            showError(a.responseText);
          },
          complete: function (a) {
            if (typeof a !== "object")
              flashWarning(a);
          }
        });
      }
    });
    $("#plugin-value").click(function (e) {
      if ($(this).hasClass('btn-sm')) {
        e.preventDefault();
        window.location.href = 'advanced.php';
      }
    });
    $(".relaunch").click(function (e) {
      e.preventDefault();
      top.location.reload(true);
    });
  });
</script>
<?php
require 'promo.php';
require 'footer.php';
