<?php
include("dbh.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
 <!-- 	<?php
  	$sql = "SELECT * FROM subscribers;";
  	$result =mysqli_query($conn, $sql);

  	$resultcheck =mysqli_num_rows($result);

  	if($resultcheck > 0){
  		while( $row = mysqli_fetch_assoc($result)) { 
  			echo $row['email'];
  		}
  	}
?> -->

  	<form action="subscribe.inc.php" id="form-subscribe"  method="POST">
				<input id="input" type="email" name="email" placeholder="Enter Your Email here....." >
				<button type="submit" name="submit" class="btn-subscribe"><strong>Subscribe</strong></button>
			</form> 
 </body>
  </html>
