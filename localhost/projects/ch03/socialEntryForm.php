<html>
<head>
    <link href="../css/phpMM.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><h1>PHP & MySQL: The Missing Manual</h1></div>
<div id="example">Пример 3.1</div>
<div id="content">
    <h1>Вступайте в наш виртуальный клуб</h1>
    <p>Пожалуйста, введите ниже свои данные для связи в Интернете:</p>
<form action="scripts/showRequestInfo.php" method="POST">
    <fieldset>
        <label for="first_name">Имя:</label>
        <input type="text" name="first_name" size="20" /><br />
        <label for="last_name">Фамилия:</label>
        <input type="text" name="last_name" size="20" /><br />
        <label for="email">Адрес электронной почты:</label>
        <input type="text" name="email" size="50" /><br />
        <label for="facebook_url">URL-адрес в Facebook:</label>
        <input type="text" name="facebook_url" size="50" /><br />
        <label for="twitter_handle">Идентификатор в Twitter:</label>
        <input type="text" name="twitter_handle" size="20" /><br />
    </fieldset>
    <br />
    <fieldset class="center">
        <input type="submit" value="Вступить в клуб" />
        <input type="reset" value="Очистить и начать все сначала" />
    </fieldset>
</form>
</div>
<div id="footer"></div>
</body>
</html>