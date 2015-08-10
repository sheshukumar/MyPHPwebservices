<?php
/* include database file */
include_once("db_config.php");

if($_SERVER['REQUEST_METHOD'] == "DELETE"){
// Get user id
$id = isset($_GET['id']) ? mysql_real_escape_string($_GET['id']) : "";

if(empty($id)){
$data = array("message" => "Wrong user id Let's try once again!");
} else {
// get user data
$sql = "DELETE FROM users WHERE id = '$id'";
$delete = mysql_query($sql);
if($delete){
$data = array("message" => "Successfully user deleted!");
} else {
$data = array("message" => "Error!");
}
}
} else {
$data = array("message" => "Request method is wrong!");
}

mysql_close($conn);
/* JSON Response */
header('Content-type: application/json');
echo json_encode($data);

?>