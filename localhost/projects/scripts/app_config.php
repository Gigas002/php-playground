<?php

// Set up debug mode
define("DEBUG_MODE", true);
define("SITE_ROOT", "/projects/"); // Корневой каталог сайта
//define("HOST_WWW_ROOT", "C:/OpenServer/domains/localhost/projects/"); // Location of web files on host
define("HOST_WWW_ROOT", "C:/Users/User/Desktop/All Projects Backups/PHP Projects/localhost/projects/");
// Константы подключения к базе данных
define("DATABASE_HOST", "localhost:3306");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "Qwe123456");
//define("DATABASE_NAME", "test1");
define("DATABASE_NAME", "test_db");

function debug_print($message) {
  if (DEBUG_MODE) {
    echo $message;
  }
}

function handle_error($user_error_message, $system_error_message) {
  session_start();
  $_SESSION['error_message'] = $user_error_message;
  $_SESSION['system_error_message'] = $system_error_message;
  header("Location: " . SITE_ROOT . "scripts/show_error.php"); 
  exit();
}

function get_web_path($file_system_path) {
  return str_replace($_SERVER['DOCUMENT_ROOT'], '', $file_system_path);
}
?>
