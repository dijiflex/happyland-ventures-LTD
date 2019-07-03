<?php

if (isset($_POST['signup-submit'])) {
	require 'dbh.inc.php';

	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
	

	if (empty($email) || empty($password) ||empty($passwordRepeat)){

		header("Location:../admin/signup.php?error=emptyfields&mail=".$email);
		exit();
	} 
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location:../admin/signup.php?error=invalidemail&mail=".$email);
		exit();
	}

	elseif ($password !==$passwordRepeat) {
		header("Location:../admin/signup.php?error=passworddontmatch&mail=".$email);
		exit();
	}
	else{

		$sql = "SELECT 	adminemail from admin where adminemail = ?;";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location:../admin/signup.php?error=sqlerror");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);

			$resultCheck =  mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("Location:../admin/signup.php?error=useralredyexists=".$email);
				exit();
			}
			else{
				$sql = "INSERT INTO admin (adminemail, adminpwd) VALUES (?,?)";
				$stmt = mysqli_stmt_init($conn);

				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location:../admin/signup.php?error=sqlerror");
					exit();
				}
				else{
					$hashedpwd = password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "ss", $email, $hashedpwd );
					mysqli_stmt_execute($stmt);

					header("Location:../admin/signup.php?signup=success");
					exit();
					
				}
			}

		}
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

} else {

		header("Location:../admin/signup");
					exit();
					

}
