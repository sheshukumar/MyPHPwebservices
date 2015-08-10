<?php
/* include database file  */
include_once("db_config.php");

if($_SERVER['REQUEST_METHOD'] == "PUT"){

/*$id = isset($_SERVER['HTTP_ID']) ? mysql_real_escape_string($_SERVER['HTTP_ID']) : "";
$firstName = isset($_SERVER['HTTP_FIRSTNAME']) ? mysql_real_escape_string($_SERVER['HTTP_FIRSTNAME']) : "";
$lastName = isset($_SERVER['HTTP_LASTNAME']) ? mysql_real_escape_string($_SERVER['HTTP_LASTNAME']) : "";
$email = isset($_SERVER['HTTP_EMAIL']) ? mysql_real_escape_string($_SERVER['HTTP_EMAIL']) : "";*/

$data = json_decode(file_get_contents("php://input"));
$id = mysql_real_escape_string($data->id); 
$firstName = mysql_real_escape_string($data->firstname);
$lastName = mysql_real_escape_string($data->lastname);
$email = mysql_real_escape_string($data->email);

if(!empty($id)){
// Update data into database
$query = "UPDATE users SET firstname = '$firstName',lastname = '$lastName', email = '$email' WHERE id = '$id'";
$update = mysql_query($query);

if($update){
$data = array("message" => "Successfully user updated!");
} else {
$data = array("message" => "Error!");
}
} else {
$data = array("message" => "Wrong user id Let's try once again!");
}
} else {
$data = array("message" => "Request method is wrong!");
}

mysql_close($conn);
/* JSON Response */
header('Content-type: application/json');
echo json_encode($data);

?>