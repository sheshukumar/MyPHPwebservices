<?php
/* include database file  */
include_once("db_config.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
// Get post data`

$data = json_decode(file_get_contents("php://input"));
$firstName = mysql_real_escape_string($data->firstname);
$lastName = mysql_real_escape_string($data->lastname);
$email = mysql_real_escape_string($data->email);
$password = mysql_real_escape_string($data->password); 
$status = 0; // Here we set by default status In-active.


// Save data into database
$query = "INSERT INTO users (firstname,lastname,email,password,status) VALUES ('$firstName','$lastName','$email','$password','$status')";
$insert = mysql_query($query);

if($insert){
$data = array("message" => "Successfully user added!");
} else {
$data = array("message" => "Error!");
}
} else {
$data = array("message" => "Request method is wrong!");
}


mysql_close($conn);
/* JSON Response */
header('Content-type: application/json');
echo json_encode($data);

?>