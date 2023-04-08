<?php
require_once '../scripts/app_config.php';
require_once '../scripts/database_connection.php';
$upload_dir = HOST_WWW_ROOT . "uploads/profile_pics/";
$image_fieldname = "user_pic";
$php_errors = array(1 => 'Превышен макс. размер файла, указанный в php.ini', 2 => 'Превышен макс. размер файла, указанный в форме HTML', 3 => 'Была отправлена только часть файла', 4 => 'Файл для отправки не был выбран.'); // Потенциальные PHP-ошибки отправки файлов
$first_name = trim($_REQUEST['first_name']);
$last_name = trim($_REQUEST['last_name']);
$email = trim($_REQUEST['email']);
$bio = trim($_REQUEST['bio']);
$facebook_url = str_replace("facebook.org", "facebook.com", trim($_REQUEST['facebook_url']));
$position = strpos($facebook_url, "facebook.com");
if ($position === false)
{
    $facebook_url = "http://www.facebook.com/" . $facebook_url;
}
$twitter_handle = trim($_REQUEST['twitter_handle']);
$twitter_url = "http://www.twitter.com/";
$position = strpos($twitter_handle, "@");
if ($position === false)
{
    $twitter_url = $twitter_url . $twitter_handle;
} else
{
    $twitter_url = $twitter_url . substr($twitter_handle, $position + 1);
}

($_FILES[$image_fieldname]['error'] == 0) // Проверка отсутствия ошибки при отправке изображения
	or handle_error("сервер не может получить выбранное вами изображение.", $php_errors[$_FILES[$image_fieldname]['error']]);
@is_uploaded_file($_FILES[$image_fieldname]['tmp_name']) // Является ли этот файл результатом нормальной отправки?
	or handle_error("вы попытались совершить безнравственный поступок. Позор!", "Запрос на отправку: файл назывался " . "'{$_FILES[$image_fieldname]['tmp_name']}'"); 
@getimagesize($_FILES[$image_fieldname]['tmp_name']) // Действительно ли это изображение?
	or handle_error("вы выбрали файл для своего фото, " . "который не является изображением.", "{$_FILES[$image_fieldname]['tmp_name']} " . "не является файлом изображения.");
$now = time(); // Присваивание файлу уникального имени
while (file_exists($upload_filename = $upload_dir . $now . '-' . $_FILES[$image_fieldname]['name'])) 
{ 
	$now++; 
}
@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename) // И наконец, перемещение файла на его постоянное место
	or handle_error("возникла проблема сохранения вашего изображения " . "в его постоянном месте.", "ошибка, связанная с правами доступа при перемещении " . "файла в {$upload_filename}");
$insert_sql = "INSERT INTO users (first_name, last_name, email, bio," . "facebook_url, twitter_handle, " . "user_pic_path) " . "VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$bio}', " . "'{$facebook_url}', '{$twitter_handle}', '{$upload_filename}');"; 
mysql_query($insert_sql)
	or die(mysql_error());
header("Location: show_user.php?user_id=" . mysql_insert_id());
exit();
?>