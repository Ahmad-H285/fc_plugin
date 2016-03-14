<?php require 'header.php'; ?>
<div>
  <ul class="breadcrumb">
    <li>
      <a href="#">Home</a>
    </li>
    <li>
      <a href="#">Advanced Options</a>
    </li>
  </ul>
</div>

<?php
openBox("Advanced Tools", "cog", 12);
?>
<h3>Advanced Features and Options</h3>
<p>This page is a collection of advanced features and options that you can use to tweak your Plugin Check just the way you like it.</p>
<p> The following advanced options are available in this advanced section of the <a href="#" class="goPro">Pro</a> version of this program. </p>

<ul>
  <li><b>Enable Breadcrumbs</b>:On Plugin Check admin page, you can have breadcrumbs so that you can see where you are. This feature is of questionable value on an admin page, and is disabled by default.</li>
  <li><b>Menu Placement</b>:By default, Plugin Check automatically places the navigation menu on the left side of the screen in standalone mode, and at the top of the screen in WordPress plugin mode. Using this option, you can force the placement either to Top or Left, or leave at as the default Auto mode.</li>
  <li><b>Select Theme</b>:If you are not crazy about the default color scheme of Plugin Check, you can change it here. After changing the theme, the page will update automatically. If it does not, please click on the Switch Theme button.</li>
</ul>
<hr>
<h4>Screenshot of Advanced Options from the <a href="#" class="goPro">Pro</a> Version</h4>
<?php
showScreenshot(6);
?>
<div class="clearfix"></div>
<?php
closeBox();
require 'promo.php';
require 'footer.php';
