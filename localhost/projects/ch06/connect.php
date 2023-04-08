<?php
require_once '../scripts/app_config.php';
mysql_connect(DATABASE_HOST, DATABASE_USERNAME, "foo")
or handle_error("возникла проблема, связанная с подключением к базе данных, " . "содержащей нужную информацию.", mysql_error());
echo "<p>You are connected to the MySQL!</p>";
mysql_select_db(DATABASE_NAME)
 or die("<p>Error while looking for " . DATABASE_NAME . " database: " . mysql_error() . "</p>");
 echo"<p>You are connected to MySQL using " . DATABASE_NAME . " database.</p>";
$result = mysql_query("SHOW TABLES;");
if (!$result)
{
 die("<p>Error while showing the tables: " . mysql_error() . "</p>");
}
echo "<p>Tables in your database:</p>";
echo "<ul>";
while ($row = mysql_fetch_row($result)) {
 echo "<li>Table: {$row[0]}</li>";
}
echo "</ul>";
?>