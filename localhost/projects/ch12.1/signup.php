<?php
require_once '../scripts/view.php';
$inline_javascript = <<<EOD
    $(document).ready(function() {
      $("#signup_form").validate({
        rules: {
          password: {
            minlength: 6
          },
          confirm_password: {
            minlength: 6,
            equalTo: "#password"
          }
        },
        messages: {
          password: {
            minlength: "Пароль должен содержать не менее 6 букв"
          },
          confirm_password: {
            minlength: "Пароль должен содержать не менее 6 букв",
            equalTo: "Пароли не соответствуют."
          }
        }
      });
    });
EOD;
page_start("Регистрация", $inline_javascript);
?>
  <div id="content">
    <h1>Регистрация в базе данных</h1>
    <p>Введите запрашиваемые данные в форме:</p>
    <form id="signup_form" action="create_user.php" 
          method="POST" enctype="multipart/form-data">
      <fieldset>
        <label for="first_name">Имя:</label>
        <input type="text" name="first_name" size="20" class="required" /><br />
        <label for="last_name">Фамилия:</label>
        <input type="text" name="last_name" size="20" class="required" /><br />
        <label for="username">Логин:</label>
        <input type="text" name="username" size="20" class="required" /><br />
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" 
               size="20" class="required password" />
        <div class="password-meter">
          <div class="password-meter-message"> </div>
          <div class="password-meter-bg">
            <div class="password-meter-bar"></div>
          </div>
        </div>
        <br />
        <label for="confirm_password">Подтвердите пароль:</label>
        <input type="password" id="confirm_password" name="confirm_password" 
               size="20" class="required" /><br />
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <label for="user_pic">Загрузка изображения:</label>
        <input type="file" name="user_pic" size="30" /><br />
        <label for="info">Дополнительная информация:</label>
        <textarea name="info" cols="40" rows="10"></textarea>
      </fieldset>
      <br />
      <fieldset class="center">
        <input type="submit" value="Зарегистрироваться" />
        <input type="reset" value="Очистить и начать заново" />
      </fieldset>
    </form>
  </div>
  <div id="footer"></div>
 </body>
</html>
