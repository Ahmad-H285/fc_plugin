<?php require 'header.php'; ?>
<div>
  <ul class="breadcrumb">
    <li>
      <a href="#">Home</a>
    </li>
    <li>
      <a href="#">Automated Checks</a>
    </li>
  </ul>
</div>

<?php
insertAlerts(12);
openBox("Automated Checks", "refresh", 12);
?>
<p>
  In the <strong>Automated Checks</strong> mode, Plugin Check runs a series of automated quality checks (selectively copied and adapted from the excellent Theme Check plugin) on the plugin you select or upload.  You can check some files or a folder on your server for undefined functions and methods. Or you can upload an app or a plugin.
</p>
<hr>
<h4>Screenshot of <strong>Automated Checks</strong> from the <a href="#" class="goPro">Pro</a> Version</h4>
<?php
showScreenshot(5);
?>
<div class="clearfix"></div>
<?php
closeBox();
require 'promo.php';
require 'footer.php';
