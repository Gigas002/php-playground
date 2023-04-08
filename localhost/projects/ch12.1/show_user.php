<?php
require_once '../scripts/app_config.php';
require_once '../scripts/authorize.php';
require_once '../scripts/database_connection.php';
require_once '../scripts/view.php';
session_start(); 
// Авторизация любого зарегистрировавшегося пользователя
authorize_user();
// Get the user ID of the user to show
$user_id = $_REQUEST['user_id'];
if (!isset($user_id)) {
 $user_id = $_SESSION['user_id'];
} 
// Build the SELECT statement
$select_query = "SELECT * FROM users WHERE user_id = " . $user_id;
// Run the query
$result = mysql_query($select_query);
if ($result) {
  $row = mysql_fetch_array($result);
  $first_name     = $row['first_name'];
  $last_name      = $row['last_name'];
  $info            = preg_replace("/[\r\n]+/", "</p><p>", $row['info']);
  $user_image     = get_web_path($row['user_pic_path']);
} else {
  handle_error("There was a problem finding your " .
               "information in our system.",
               "Error locating user with ID {$user_id}");

}
  page_start("Профиль");
?>
  <div id="content">
    <div class="user_profile">
      <h1><?php echo "{$first_name} {$last_name}"; ?></h1>
      <p><img src="<?php echo $user_image; ?>" class="user_pic" />
        <?php echo $info; ?></p>
      <p class="contact_info">Профиль пользователя <?php echo $first_name; ?>.</p>
    </div>
  </div>
  <div id="footer"></div>
 </body>
</html>
