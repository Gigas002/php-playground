<?php
require_once '../../scripts/database_connection.php';
$user_id = $_REQUEST['user_id'];
$select_query = "SELECT * FROM users WHERE user_id = " . $user_id; // Создание инструкции SELECT
$result = mysql_query($select_query); // Запуск запроса
if ($result)
{
    $row = mysql_fetch_array($result);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $bio = preg_replace("/[\r\n]+/", "</p><p>", $row['bio']);
    $email = $row['email'];
    $facebook_url = $row['facebook_url'];
    $twitter_handle = $row['twitter_handle'];
	$user_image = get_web_path($row['user_pic_path']);  
    $twitter_url = "http://www.twitter.com/" . substr($twitter_handle, $position + 1); // Превращение $twitter_handle в URL
} else
{
	handle_error("возникла проблема с поиском вашей " . "информации на нашей системе.", "Ошибка обнаружения пользователя с ID {$user_id}"); 
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
