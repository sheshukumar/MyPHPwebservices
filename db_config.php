
<?php
$db_host = "localhost"; //hostname
$db_user = "root"; // username
$db_password =""; // password
$db_name = "service"; //database name
$conn = mysql_connect($db_host, $db_user, $db_password );
mysql_select_db($db_name, $conn);

?>
