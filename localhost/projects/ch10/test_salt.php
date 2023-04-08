<?php
$input = "secret_string";
$salt = "salt";
$first_output = crypt($input, $salt);
$second_output = crypt($input, $salt);
echo "Первый вывод: {$first_output}\n\n";
echo "Второй вывод: {$second_output}\n\n";
?>