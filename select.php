<?php
/* include database file  */
include_once("db_config.php");

// Get user id
$id = isset($_GET['id']) ? mysql_real_escape_string($_GET['id']) : "";

if(empty($id)){
$data = array("message" => "Wrong user id Let's try once again!");
} else {
// get user data
$sql = "SELECT * FROM users where id='$id'";
$select = mysql_query($sql);
$result = array();
while($data = mysql_fetch_assoc($select)) {
$result = $data;
}

$data = array($result);
}

mysql_close($conn);
/* JSON Response */
header("Content-type: application/json");
echo json_encode($data);

?>