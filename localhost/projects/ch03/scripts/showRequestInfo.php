<html>
<head>
    <link href="../../css/phpMM.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><h1>PHP & MySQL: The Missing Manual</h1></div>
<div id="example">Пример 3.2</div>
<div id="content">
    <p> Это все, что записано в массиве $_REQUEST:</p>
    <?php
    foreach($_REQUEST as $key => $value) {
        echo "<p>Для " . $key . ", имеется значение '" . $value . "'.</p>";
    }
    ?>
</div>
<div id="footer"></div>
</body>
</html>