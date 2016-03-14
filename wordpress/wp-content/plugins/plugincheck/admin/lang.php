<?php

// TODO: Wrap most of these functions in a static class EzLang
// to avoid possible name collisions and general encapsulation

if (class_exists('AbstractInstaller') || class_exists('EZ')) {

  if (!function_exists('__')) {

    function __($s, $MO) {
      switchMO($MO);
      return gettext($s);
    }

    function _e($s, $MO) {
      switchMO($MO);
      echo gettext($s);
    }

  }

  if (class_exists('EZ')) {
    $GLOBALS['defaultMO'] = $defaultMO = EZ::$slug;
    $GLOBALS['currentMO'] = $currentMO = EZ::$slug;
  }
  else {
    $GLOBALS['defaultMO'] = $defaultMO = "";
    $GLOBALS['currentMO'] = $currentMO = "";
  }
  $GLOBALS['locale'] = $locale = 'en_US';

  function switchMO($MO) {
    global $currentMO, $defaultMO, $locale;
    if ($MO != $currentMO) {
      if ($MO == $defaultMO) {
        textdomain($locale);
        $currentMO = $defaultMO;
      }
      else {
        textdomain("{$locale}_$MO");
        $currentMO = $MO;
      }
    }
  }

  function getLangs() {
    $langs = glob("lang/*", GLOB_ONLYDIR);
    $locales = array('en_US');
    foreach ($langs as $l) {
      $k = substr($l, 5, 5);
      $locales[] = $k;
    }
    return $locales;
  }

  function setLang() {
    global $db, $locale;
    $optionsMeta = $db->getMetaData('option_meta');
    if (!empty($optionsMeta['locale'])) {
      $locale = $optionsMeta['locale'];
    }
    else {
      $locale = 'en_US';
    }
    putenv("LC_ALL=$locale");
    setlocale(LC_ALL, $locale);
    bindtextdomain($locale, "./lang");
    bindtextdomain($locale . "_easy-common", "./lang");
    textdomain($locale);
  }

}
