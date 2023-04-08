<?php
require 'C:/OpenServer/domains/localhost/projects/scripts/database_connection.php';
$query_text = $_REQUEST['query'];
$result = mysql_query($query_text);
if (!$result)
{
    die("<p>Error while compiling SQL-command" . $query_text . ": " .
        mysql_error() . "</p>");
}
$return_rows = true;
if (preg_match("/^\s*(CREATE|INSERT|UPDATE|DELETE|DROP)/i",
    $query_text))
{
    $return_rows = false;
}
if ($return_rows)
{
// имеются строки для показа в качестве результата запроса
    echo "<p>Results of your query:</p>";
    echo "<ul>";
    while ($row = mysql_fetch_row($result))
    {
        echo "<li>{$row[0]}</li>";
    }
    echo "</ul>";
}
else
{
// Строки отсутствуют. Вывод простого отчета о том,
// работал запрос или нет.
    echo "<p>The following query has been done successfully:</p>";
    echo "<p>{$query_text}</p>";
}
?>