<?php


if (isset($_POST['login-submit'])) {
	
	require 'dbh.inc.php';

	$email = $_POST['mail'];
	$password = $_POST['pwd'];

	if (empty($email) || empty($password)) {
		
		header("Location:../admin/login.php?error=emptyfields");
		exit();
	}
	else{

		$sql = "SELECT * FROM admin WHERE adminemail = ?;";

		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../admin/login.php?error=sqlerror");
			exit();
		}
		else{

			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);

			$result = mysqli_stmt_get_result($stmt); // store result into $result
			if ($row = mysqli_fetch_assoc($result)) {
				
				$pwdCheck = password_verify($password,  $row['adminpwd']);
				if ($pwdCheck == false) {
					header("Location: ../admin/login.php?error=wrongpassword");
					exit();
				}
				elseif ($pwdCheck == true) {
					session_start();
					$_SESSION['id'] = $row['id'];
					$_SESSION['admemail'] = $row['adminemail'];

					header("Location: ../admin/admin.php?login=sucess");

				}
				else{
					header("Location: ../admin/login.php?error=wrongPassword");
					exit();
				}
			}
			else{
				header("Location: ../admin/login.php?error=nouser");
				exit();
			}


		}
	}



}
else{
	header("Location:../admin/login.php");
	exit();


}