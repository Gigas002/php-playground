<?php
require_once '../../scripts/app_config.php';
require_once '../../scripts/database_connection.php';
try {
    if (!isset($_REQUEST['image_id'])) {
        handle_error("не указано изображение для загрузки.");
    }
    $image_id = $_REQUEST['image_id'];
    $select_query = sprintf("SELECT * FROM images WHERE image_id = %d", $image_id);
    $result = mysql_query($select_query);
    if (mysql_num_rows($result) == 0) {
        handle_error("запрошенное изображение найти невозможно.", "Не найдено изображение с ID" . $image_id . ".");
    }
    $image = mysql_fetch_array($result);
    header('Content-type: ' . $image['mime_type']);
    header('Content-length: ' . $image['file_size']);
    echo $image['image_data'];
} catch (Exception $exc) {
    handle_error("при загрузке вашего изображения произошел сбой.", "Ошибка при загрузке изображения: " . $exc->getMessage());
}
?>