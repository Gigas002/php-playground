<?php
require_once 'app_config.php';
mysql_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD)
	or handle_error("возникла проблема, связанная с подключением к базе данных, " . "содержащей нужную информацию.", mysql_error());
mysql_select_db(DATABASE_NAME)
	or handle_error("возникла проблема с конфигурацией нашей базы данных.", mysql_error());
?>