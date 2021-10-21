<?php
$devMode = true;


//Errors
if($devMode) {
    error_reporting(-1);
    ini_set("display_errors", 1);
}

//Load classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php';
});


//Database connections
if($devMode) {
    define("DBHOST", "localhost");
    define("DBUSER", "localhost");
    define("DBPASS", "password");
    define("DBDATABASE", "courses");
}
else {
    define("DBHOST", "");
    define("DBUSER", "");
    define("DBPASS", "");
    define("DBDATABASE", "");
}