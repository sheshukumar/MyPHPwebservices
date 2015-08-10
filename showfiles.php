<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "service");


$id = isset($_GET['id']) ? mysql_real_escape_string($_GET['id']) : "";

if(empty($id)){
    
$data = array("message" => "Wrong user id Let's try once again!");

echo json_encode($data);

} else {

$result = $conn->query("SELECT id, name, mime,created FROM file WHERE user_id='$id'");

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"name":"'   . $rs["name"] . '",';
    $outp .= '"mime":"'   . $rs["mime"] . '",';
    $outp .= '"created":"'. $rs["created"] . '"}';
}
$outp .="]";

$conn->close();

print_r($outp);

}

?>