<?php
// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
        $dbLink = new mysqli('localhost', 'root', '', 'service');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Gather all required data
        $id = isset($_POST['userid']) ? mysql_real_escape_string($_POST['userid']) : "";
        if(empty($id)){
        //echo "Wrong user id Let's try once again!";
        $data = array("message" => "Error! No ID was passed..");

        }

        else{
        $name = $dbLink->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
        

        
        // Create the SQL query
        $query = "INSERT INTO file(name, mime, size, data, created,user_id)VALUES ('{$name}', '{$mime}', {$size}, '{$data}', NOW(),'{$id}')";
 
        // Execute the query
        $result = $dbLink->query($query);
 
        // Check if it was successfull
            if($result) {
                //echo 'Success! Your file was successfully added!';
                $data = array("message" => "Success! Your file was successfully added!");
            }
            else {
               // echo 'Error! Failed to insert the file';
                $data = array("message" => "Error! Failed to insert the file");

            }
        }  
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';
}
 
/* JSON Response */
header('Content-type: application/json');
echo json_encode($data);
?>
 
 