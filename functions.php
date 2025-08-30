<?php

use VelixTech\Theme;

defined('ABSPATH') || exit;

// Load Composer autoloader
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

// Boot theme
if (!function_exists('velixtech')) {
    function velixtech()
    {
        return Theme::init();
    }
    velixtech();
}
