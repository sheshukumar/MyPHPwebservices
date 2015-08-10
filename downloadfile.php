<?php
// Make sure an ID was passed
if(isset($_GET['id'])) {
// Get the ID
    $id = intval($_GET['id']);
 
    // Make sure the ID is in fact a valid ID
    if($id <= 0) {
        die('The ID is invalid!');
    }
    else {
        // Connect to the database
        $dbLink = new mysqli('localhost', 'root', '', 'service');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Fetch the file information
        $query = "SELECT name,mime,size,data FROM file WHERE id = {$id}";
        $result = $dbLink->query($query);
 
        if($result) {
            // Make sure the result is valid
            if($result->num_rows == 1) {
            // Get the row
                $row = mysqli_fetch_assoc($result);
 
                // Print headers
                header("Content-Type: ". $row['mime']);
                header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['name']);
 
                // Print data
                echo $row['data'];
            }
            else {
               // echo 'Error! No image exists with that ID';
                $data = array("message" => "Error! No file exists with that ID");
            }
 
            // Free the mysqli resources
            @mysqli_free_result($result);
        }
        else {
           // echo "Error! Query failed: <pre>{$dbLink->error}</pre>";
            $data = array("message" => "Error! Query failed:");

        }
        @mysqli_close($dbLink);
    }
}
else {
    //echo 'Error! No ID was passed.';
    $data = array("message" => "Error! No ID was passed.");
}
/* JSON Response */
header('Content-type: application/json');
echo json_encode($data);

?>