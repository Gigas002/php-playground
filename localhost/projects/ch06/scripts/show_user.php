<?php
require 'C:/OpenServer/domains/localhost/projects/scripts/database_connection.php';
$user_id = $_REQUEST['user_id'];
// Создание инструкции SELECT
$select_query = "SELECT * FROM users WHERE user_id = " . $user_id;
// Запуск запроса
$result = mysql_query($select_query);
if ($result)
{
    $row = mysql_fetch_array($result);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $bio = preg_replace("/[\r\n]+/", "</p><p>", $row['bio']);
    $email = $row['email'];
    $facebook_url = $row['facebook_url'];
    $twitter_handle = $row['twitter_handle'];
// Превращение $twitter_handle в URL
    $twitter_url = "http://www.twitter.com/" .
        substr($twitter_handle, $position + 1);
// Для последующего добавления
    $user_image = "../images/missing_user.png";
} else
{
    die("Can/'t find user with ID {$user_id}");
}
?>
<html>
<head>
    <link href="../css/phpMM.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><h1>PHP & MySQL: The Missing Manual</h1></div>
<div id="example">Profile</div>
<div id="content">
    <div class="user_profile">
        <h1><?php echo "{$first_name} {$last_name}"; ?></h1>
        <p><img src="<?php echo $user_image; ?>" class="user_pic" />
            <?php echo $bio; ?></p>
        <p class="contact_info">Be in touch with <?php echo $first_name; ?>:</p>
        <ul>
            <li>...
                <a href="<?php echo $email; ?>">on e-mail</a></li>
            <li>... also using
                <a href="<?php echo $facebook_url; ?>">his page on Facebook</a></li>
            <li>... also
                <a href="<?php echo $twitter_url; ?>">tracking his messages on Twitter</a></li>
        </ul>
    </div>
</div>
<div id="footer"></div>
</body>
</html>
