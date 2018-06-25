<?php
define("PATH", __DIR__);
spl_autoload_register(function ($class_name) {
    include_once PATH . '/classes/' . $class_name . '.php';
});
$ini_array = parse_ini_file("config.ini", true);
?>