<?php
  require_once 'app_config.php';

  if (isset($_SESSION['error_message'])) {
    $error_message = preg_replace("/\\\\/", '', 
                                  $_SESSION['error_message']);
  } else {
    $error_message = "Что-то пошло не так, " .
                     "и вот вы здесь.";
  }

  if (isset($_SESSION['system_error_message'])) {
    $system_error_message = preg_replace("/\\\\/", '',
                            $_SESSION['system_error_message']);  
  } else {
    $system_error_message = "Нет сообщений о системных ошибках.";
  }
?>

<html>
 <head>
  <link href="../css/phpMM.css" rel="stylesheet" type="text/css" />
 </head>

 <body>
  <div id="header"><h1>Test_header3</h1></div>
  <div id="example">Ошибка!</div>
  <div id="content">
    <h1>Ошибка!</h1>
    <p><img src="../images/error.jpg" class="error" />
      <?php echo $error_message; ?>
      <span></p>
    <p>Текст оправданий или что-то такое</p>
    <p>Для того, чтобы вернуться на прошлую страницу, следует <a href="javascript:history.go(-1);">нажать сюда.
	</a></p>
    <?php
      debug_print("<hr />");
      debug_print("<p>Системная ошибка: <b>{$system_error_message}</b></p>");
    ?>
  </div>
  <div id="footer"></div> 
 </body>
</html>
