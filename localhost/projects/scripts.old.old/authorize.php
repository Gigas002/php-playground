<?php
require_once 'database_connection.php';
require_once 'app_config.php';

session_start(); 

function authorize_user($groups = NULL) {
 // Если не создан cookie-файл, проверять группы не нужно
 if ((!isset($_SESSION['user_id'])) || (!strlen($_SESSION['user_id']) > 0)) { 
 header('Location: signin.php?' .
 'error_message= Для просмотра этой страницы нужно зарегистрироваться.');
 exit;
 }
 // Если группы не были переданы, достаточно этой авторизации
 if ((is_null($groups)) || (empty($groups))) {
 return;
 }
 // создание строки запроса
 $query_string =
 "SELECT ug.user_id" .
 " FROM user_groups ug, groups g" .
 " WHERE g.name = '%s'" .
 " AND g.id = ug.group_id" . 
 " AND ug.user_id = " . mysql_real_escape_string($_SESSION['user_id']);
 // Перебор всех групп и проверка принадлежности к каждой из них
 foreach ($groups as $group) {
 $query = sprintf($query_string, mysql_real_escape_string($group));
 $result = mysql_query($query);
 if (mysql_num_rows($result) == 1) {
 // Если получен результат, пользователю нужно разрешить доступ.
 // Возвращение управления, чтобы продолжилось выполнение сценария.
 return;
 }
 }
 // Если мы попали сюда, значит, соответствий не было ни в одной из групп.
 // Доступ пользователю не разрешен.
 handle_error("Вы не прошли авторизацию для просмотра данной страницы.");
 exit;
} 
/*
require_once 'database_connection.php';
if (!isset($_SERVER['PHP_AUTH_USER']) ||
    !isset($_SERVER['PHP_AUTH_PW'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="The Social Site"');
    exit("Здесь нужно указать верные имя пользователя и пароль." .
        "Проходите дальше. Здесь вам нечего смотреть.");
}
// Поиск предоставленных пользователем полномочий
$query = sprintf("SELECT user_id, username FROM users " .
    " WHERE username = '%s' AND " .
    " password = '%s';",
    mysql_real_escape_string(trim($_SERVER['PHP_AUTH_USER'])),
    mysql_real_escape_string(
        crypt(trim($_SERVER['PHP_AUTH_PW']),
            $_SERVER['PHP_AUTH_USER'])));
/*
// Поиск предоставленных пользователем полномочий
$query = sprintf("SELECT user_id, username FROM users " .
    " WHERE username = '%s' AND " .
    " password = '%s';",
    mysql_real_escape_string(trim($_SERVER['PHP_AUTH_USER'])),
    mysql_real_escape_string(trim($_SERVER['PHP_AUTH_PW'])));
*/
/*
$results = mysql_query($query);
if (mysql_num_rows($results) == 1) {
    $result = mysql_fetch_array($results);
    $current_user_id = $result['user_id'];
    $current_username = $result['username'];
} else {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="The Social Site"');
    exit("Здесь нужно указать верные имя пользователя и пароль." .
        "Проходите дальше. Здесь вам нечего смотреть.");
}
*/
?>