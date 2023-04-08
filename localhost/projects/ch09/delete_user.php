<?php
require_once '../scripts/app_config.php';
require_once '../scripts/database_connection.php';
// Получение идентификатора удаляемого пользователя
$user_id = $_REQUEST['user_id'];
// Создание инструкции DELETE
$delete_query = sprintf("DELETE FROM users WHERE user_id = %d", $user_id);
// Удаление пользователя из базы данных
mysql_query($delete_query);
// Перенаправление на show_users для повторного показа пользователей
// (без удаленного пользователя)
$msg = "Указанный пользователь был удален.";
header("Location: show_users.php?success_message={$msg}");
exit();
?>