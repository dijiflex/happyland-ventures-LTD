
<?php
include 'dbh.inc.php';

/* Attempt MySQL server connection*/
$link = mysqli_connect("localhost", "root", "", "cudb");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


// Escape user inputs for security
$name = mysqli_real_escape_string($link, $_REQUEST['name']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$comment = mysqli_real_escape_string($link, $_REQUEST['comment']);


$sql = "INSERT INTO comments (name,email,coment) VALUES ('$name','$email','$comment')";

if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
   
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);