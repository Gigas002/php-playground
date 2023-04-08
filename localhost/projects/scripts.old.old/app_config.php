<?php
define("DEBUG_MODE", true); // Установка режима отладки
define("SITE_ROOT", "/projects/"); // Корневой каталог сайта
define("HOST_WWW_ROOT", "C:/OpenServer/domains/localhost/projects/"); // Location of web files on host
// Константы подключения к базе данных
define("DATABASE_HOST", "localhost:3306");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "Qwe123456");
define("DATABASE_NAME", "test");
function debug_print($message) 
{
    if (DEBUG_MODE) 
	{
        echo $message;
    }
}
function get_web_path($file_system_path) {
 return str_replace($_SERVER['DOCUMENT_ROOT'], '', $file_system_path);
}
function handle_error($user_error_message, $system_error_message) {
 session_start();
 $_SESSION['error_message'] = $user_error_message;
 $_SESSION['system_error_message'] = $system_error_message; 
 header("Location: " . SiTE_ROOT . "scripts/show_error.php");
 exit();
}
?>