<?php
include 'dbh.inc.php';

/* Attempt MySQL server connection*/
$link = mysqli_connect("localhost", "root", "", "cudb");
$sql ="";
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


// Escape user inputs for security
$email = mysqli_real_escape_string($link, $_REQUEST['email']);

//$email = "john.doe@example.com";

// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
   $sql = "INSERT INTO subscibers (email) VALUES ('$email')";
} else {
    echo("$email is not a valid email address");
}




if(mysqli_query($link, $sql)){
	header('../index.php');
   // echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 

// Close connection
mysqli_close($link);

