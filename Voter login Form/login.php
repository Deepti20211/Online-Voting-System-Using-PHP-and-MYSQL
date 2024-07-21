<?php
			session_start();
			$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

				$cnic = $_POST['cnic'];
				$mobile = $_POST['mobile'];	
				$pass = $_POST['pass'];
			
	

			$check = mysqli_query($conn, "SELECT * FROM voterregistration WHERE cnic='$cnic' AND mobile='$mobile' AND pass='$pass'  ");

			if (mysqli_num_rows($check)>0) {
				$voterdata = mysqli_fetch_array($check);
				$_SESSION['voterdata']=$voterdata;
				
				
				$safe_url = "../Dashboard/dashboard.php";
				
				header('Location: ' . htmlspecialchars($safe_url, ENT_QUOTES, 'UTF-8'));
				
			
			}
			else{
				echo "Some Error";
			}


?>