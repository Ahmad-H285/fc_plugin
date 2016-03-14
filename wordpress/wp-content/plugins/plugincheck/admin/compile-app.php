<?php require 'header.php'; ?>
<div>
  <ul class="breadcrumb">
    <li>
      <a href="#">Home</a>
    </li>
    <li>
      <a href="#">App Check</a>
    </li>
  </ul>
</div>

<?php
insertAlerts(12);
openBox("App Checker", "play", 12);
?>
<p>
  In the <strong>App Check</strong> mode, you can check some files or a folder on your server for undefined functions and methods. Or you can upload an app or a plugin.
</p>
<hr>
<h4>Screenshot of <strong>App Check</strong> from the <a href="#" class="goPro">Pro</a> Version</h4>
<?php
showScreenshot(4);
?>
<div class="clearfix"></div>
<?php
closeBox();
require 'promo.php';
require 'footer.php';
