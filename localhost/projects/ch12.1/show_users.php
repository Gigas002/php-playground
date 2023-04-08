<?php
require_once '../scripts/app_config.php';
require_once '../scripts/authorize.php';
require_once '../scripts/database_connection.php';
require_once '../scripts/view.php';
// Получить доступ к этой странице могут только пользователи из группы Administrators
authorize_user(array("Administrators")); 
// Build the SELECT statement
$select_users =
  "SELECT user_id, first_name, last_name " .
  "  FROM users";
// Run the query
$result = mysql_query($select_users);
// Display the view to users
  $delete_user_script = <<<EOD
function delete_user(user_id) {
  if (confirm("Вы точно хотите удалить этого пользователя? " +
              "Восстановить его будет невозможно!")) {
    window.location = "delete_user.php?user_id=" + user_id;
  }
}
EOD;
  page_start("Пользователи", $delete_user_script,
             $_REQUEST['success_message'], $_REQUEST['error_message']);
?>
  <div id="content">
   <ul>
     <?php
       while ($user = mysql_fetch_array($result)) {
         $user_row = sprintf(
           "<li><a href='show_user.php?user_id=%d'>%s %s</a> " .
           "<a href='javascript:delete_user(%d);'><img " .
              "class='delete_user' src='../images/delete.png' " .
              "width='15' /></a></li>",
           $user['user_id'], $user['first_name'], $user['last_name'],
           $user['user_id']);
         echo $user_row;
       }
     ?>
   </ul>
  </div>
  <div id="footer"></div>
 </body>
</html>
