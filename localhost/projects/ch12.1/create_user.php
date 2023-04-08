<?php
require_once '../scripts/app_config.php';
require_once '../scripts/database_connection.php';
$upload_dir = HOST_WWW_ROOT . "uploads/profile_pics/";
$image_fieldname = "user_pic";
// Potential PHP upload errors
$php_errors = array(1 => 'Maximum file size in php.ini exceeded',
                    2 => 'Maximum file size in HTML form exceeded',
                    3 => 'Only part of the file was uploaded',
                    4 => 'No file was selected to upload.');
$first_name = trim($_REQUEST['first_name']);
$last_name = trim($_REQUEST['last_name']);
$username = trim($_REQUEST['username']);
$password = trim($_REQUEST['password']);
$info = trim($_REQUEST['info']);
// Make sure we didn't have an error uploading the image
($_FILES[$image_fieldname]['error'] == 0)
  or handle_error("the server couldn't upload the image you selected.",
                  $php_errors[$_FILES[$image_fieldname]['error']]);
// Is this file the result of a valid upload?
@is_uploaded_file($_FILES[$image_fieldname]['tmp_name'])
  or handle_error("you were trying to do something naughty. Shame on you!",
                  "Uploaded request: file named " .
                  "'{$_FILES[$image_fieldname]['tmp_name']}'");
// Is this actually an image?
@getimagesize($_FILES[$image_fieldname]['tmp_name'])
  or handle_error("you selected a file for your picture " .
                  "that isn't an image.",
                  "{$_FILES[$image_fieldname]['tmp_name']} " .
                  "isn't a valid image file.");
// Name the file uniquely
$now = time();
while (file_exists($upload_filename = $upload_dir . $now .
                                     '-' .
                                     $_FILES[$image_fieldname]['name'])) {
    $now++;
}
// Finally, move the file to its permanent location
@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename)
  or handle_error("we had a problem saving your image to " .
                  "its permanent location.",
                  "permissions or related error moving " .
                  "file to {$upload_filename}");
$insert_sql = sprintf("INSERT INTO users " .
                             "(first_name, last_name, username, " .
                              "password, " .
                              "info, " .
                              "user_pic_path) " .
                      "VALUES ('%s', '%s', '%s', '%s', '%s', 
                               '%s');",
                      mysql_real_escape_string($first_name),
                      mysql_real_escape_string($last_name),
                      mysql_real_escape_string($username),
                      mysql_real_escape_string($password),
                      mysql_real_escape_string($info),
                      mysql_real_escape_string($upload_filename));
// Insert the user into the database
mysql_query($insert_sql)
  /*or handle_error("Скорее всего, имя пользователя уже занято.", "Скорее всего, имя пользователя уже занято.");*/
  or die(mysql_error());
// Redirect the user to the page that displays user information
header("Location: show_user.php?user_id=" . mysql_insert_id());
exit();
?>