<?php

$compileOptions = $options = array();

$compileOptions['show_defined'] = array('name' => __('Show Defined Functions', 'plugin-check'),
    'type' => 'checkbox',
    'value' => false,
    'help' => __('By default, Plugin Check shows only undefined functions and methods. Check this option to view defined ones as well.', 'plugin-check'));

$compileOptions['kill_dupes'] = array('name' => __('Suppress Duplicates', 'plugin-check'),
    'type' => 'checkbox',
    'value' => false,
    'help' => __('By default, PHP Pseudo Compiler lists and checks all instances of functions used or not found. You can suppress duplications using this option, which may make the output of large projects more readable.', 'plugin-check'));
