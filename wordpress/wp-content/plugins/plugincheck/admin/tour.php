<?php
if (EZ::isInWP()) {
  ?>
  <style scoped>
    .tour-step-background {
      background: transparent;
      border: 2px solid blue;
    }
    .tour-backdrop {
      opacity:0.2;
    }
  </style>
  <?php
}
?>
<div class="col-lg-8 col-sm-12">
  <h4>Quick Start</h4>
  <p>Plugin Check is a developer tool that helps you locate undefined functions and methods. PHP is not a compiled language. It looks for functions during runtime. So if you have a segment of code not covered by your normal testing, and you have an undefined function in there, you will never know of the undefined function until it hits production when the particular conditions activating that particular code segment are met.</p>
  <p>
    In addition to detecting undefined functions and methods, this app lets you run a series of automated checks to ensure code quality, and increase the likelihood of your plugin getting accepted at sites such as CodeCanyon. You have multiple modes of scanning plugins and apps for possible errors.
  </p>
  <ol>
    <li>In the <strong>Plugin Check</strong> tab, you can select a plugin to check, after setting the desired options.</li>
    <li>The <strong>App Check</strong> tab is designed for PHP applications and plugins that are already on your server or on your local computer. (<a href="http://buy.thulasidas.com/plugin-check" title="Get Plugin Check Pro for $5.95" class="goPro">Pro version</a>).
      <ul>
        <li>You can type in the list of files on your server to scan, separated by commas.</li>
        <li>Or you can tyype in a folder location on your server.</li>
        <li>If the app or plugin is on your local machine, you can upload a zipped PHP application.</li>
      </ul>
    </li>
    <li>
      The <strong>Automated Checks</strong> tab lets you run a series of automated checks.  (<a href="http://buy.thulasidas.com/plugin-check" title="Get Plugin Check Pro for $5.95" class="goPro">Pro version</a>)
      <ul>
        <li>You can select a WordPress plugin installed on your blog to run the checks.</li>
        <li>Upload a plugin to your server and have the automated checks run on it.</li>
      </ul>

    </li>
  </ol>
  <p>
    Note that the files and folders need to be on the server that is running this application, and the paths should be relative to the parent location of this application (<code><?php echo realpath("../.."); ?></code>). You can also list absolute path names. When you upload a zipped package, it will end up on your server on a temporary random location (and is therefore harmless).
  </p>

  <h4>Context-Aware Help</h4>
  <p>Most of the admin pages of this application have a blue help button near the right hand side top corner. Clicking on it will give instructions and help specific to the task you are working on. All configuration options have a help button associated with it, which gives you a popover help bubble when you hover over it. If you need further assistance, please see the <a href='#' id='showSupportChannels'>support channels</a> available.</p>
</div>

<?php require 'support.php'; ?>

<hr />
<p class="center-text">
  <a class="btn btn-primary center-text restart" href="#" data-toggle='tooltip' title='Start or restart the tour any time' id='restart'><i class="glyphicon glyphicon-globe icon-white"></i>&nbsp; Start Tour</a>
  <a class="btn btn-primary center-text showFeatures" href="#" data-toggle='tooltip' title='Show the features of this plugin and its Pro version'><i class="glyphicon glyphicon-thumbs-up icon-white"></i>&nbsp; Show Features</a>
  <a class="btn btn-info center-text" href="compile-plugin.php" data-toggle='tooltip' title='Hide this Quick Start and launch the Plugin Checker'><i class="glyphicon glyphicon-flag icon-white"></i>&nbsp; Plugin Check</a>
  <a class="btn btn-success center-text" href="compile-app.php" data-toggle='tooltip' title='Hide this Quick Start and launch the App Checker'><i class="glyphicon glyphicon-flag icon-white"></i>&nbsp; App Check</a>
  <a class="btn btn-warning center-text" href="compile-automated.php" data-toggle='tooltip' title='Hide this Quick Start and launch the App Checker'><i class="fa fa-spin fa-refresh"></i>&nbsp; Automated Checks</a>
</p>

<script>
  $(document).ready(function () {
    if (!$('.tour').length && typeof (tour) === 'undefined') {
      var tour = new Tour({backdrop: true,
        onShow: function (t) {
          var current = t._current;
          var toShow = t._steps[current].element;
          var dad = $(toShow).parent('ul');
          var gdad = dad.parent();
          dad.slideDown();
          if (dad.hasClass('accordion')) {
            gdad.siblings('.accordion').find('ul').slideUp();
          }
          else if (dad.hasClass('dropdown-menu')) {
            gdad.siblings('.dropdown').find('ul').hide();
          }
        }
      });
      tour.addStep({
        element: "#index",
        placement: "right",
        title: "Dashboard",
        content: "Welcome to Plugin Check! When you login to your Plugin Check Admin interface, you will find yourself in the Dashboard. Depending on the version of our app, you may see informational messages, quick start etc on this page."
      });
      tour.addStep({
        element: "#account",
        placement: "left",
        title: "Quick Access to Your Account",
        content: "Click here if you would like to logout or modify your profile (your password and email Id)."
      });
      tour.addStep({
        element: "#update",
        placement: "left",
        title: "Updates and Upgrades",
        content: "If you would like to check for regular updates, or install a purchased  Pro upgrade, visit the update page by clicking this button."
      });
      tour.addStep({
        element: "#standAloneMode",
        placement: "left",
        title: "Standalone Mode",
        content: "Open Plugin Check Admin in a new window independent of WordPress admin interface. The standalone mode still uses WP authentication, and cannot be accessed unless logged in."
      });
      tour.addStep({
        element: "#tour",
        placement: "right",
        title: "Tour",
        content: "This page is the starting point of your tour. You can always come here to relaunch the tour, if you wish."
      });
      tour.addStep({
        element: "#goPro",
        placement: "right",
        title: "Upgrade Your App to Pro",
        content: "To unlock the full potential of this app, you may want to purchase the Pro version. You will get an link to download it instantly. It costs only $15.95 and adds tons of features. These Pro features are highlighted by a red icon on this menu bar."
      });
      tour.addStep({// The first on ul unroll is ignored. Bug in BootstrapTour?
        element: "#profile",
        placement: "right",
        title: "Manage Your Account",
        content: "Set your account parameters or log off."
      });
      tour.addStep({
        element: "#profile",
        placement: "right",
        title: "Manage Your Profile",
        content: "Click here if you would like to modify your profile (your password and email Id)."
      });
      tour.addStep({
        element: "#compile-plugin",
        placement: "right",
        title: "Launch the Plugin Check",
        content: "Click here to launch Plugin Check and validate a plugin already on your blog by selecting it. Set the compilation options before selecting the plugin."
      });
      tour.addStep({
        element: "#compile-app",
        placement: "right",
        title: "Launch the App Check",
        content: "Click here to launch App Check and validate plugins or applications by uploading or selecting. Set the compilation options before selecting or uploading the plugin or application."
      });
      tour.addStep({
        element: "#compile-automated",
        placement: "right",
        title: "Automated Checks",
        content: "Select a plugin and launch a series of quality checks. It can spot common problems and validate the readme.txt file. Set the compilation options before selecting the plugin."
      });
      tour.addStep({// The first on ul unroll is ignored. Bug in BootstrapTour?
        element: "#options",
        placement: "right",
        title: "Configuration",
        content: "In this section, you can configure your Ads EZ installation."
      });
      tour.addStep({
        element: "#options",
        placement: "right",
        title: "Configuration Options",
        content: "On this page, you will set up your Ads EZ server by providing the configuration options."
      });
      tour.addStep({
        element: "#advanced",
        placement: "right",
        title: "Advanced Tools and Options",
        content: "<p class='red'>This is a Pro feature.</p><p>On this page, you will find advanced options like suppressing duplicates, displaying detected tokens etc.</p>"
      });
      tour.addStep({
        element: "#reinstall",
        placement: "right",
        title: "Rinstall the App",
        content: "<p>If you get error messages related to the database, you can reinstall the application from this page.</p>"
      });
      tour.addStep({
        orphan: true,
        placement: "right",
        title: "Done",
        content: "<p>You now know the Plugin Check interface. Congratulations!</p>"
      });
    }
    $(".restart").click(function (e) {
      e.preventDefault();
      tour.restart();
    });
    $(".restart").click(function (e) {
      e.preventDefault();
      tour.restart();
    });
    $(".showFeatures").click(function (e) {
      e.preventDefault();
      $("#features").toggle();
      if ($("#features").is(":visible")) {
        $(this).html('<i class="glyphicon glyphicon-thumbs-up icon-white"></i>&nbsp; Hide Features');
      }
      else {
        $(this).html('<i class="glyphicon glyphicon-thumbs-up icon-white"></i>&nbsp; Show Features');
      }
    });
  });
</script>
