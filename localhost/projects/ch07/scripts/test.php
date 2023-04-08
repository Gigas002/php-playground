<?php
echo "Root catalog of the docs: {$_SERVER['DOCUMENT_ROOT']}";
$image_sample_path = "C:/OpenServer/domains/localhost/projects/" . "uploads/profile_pics/1484038222-delete.png "; 
$web_image_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $image_sample_path); 
echo "<br /><br />Converted path: {$web_image_path}"; 
?>