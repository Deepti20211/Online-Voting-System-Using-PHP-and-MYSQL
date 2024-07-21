<?php
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = mysqli_prepare($conn, "INSERT INTO voterregistration (name, dob, email, mobile, gender, photo, idtype, cnic, issue, expire, pass, cpass, status, votes) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0)");

if ($stmt === false) {
    die('Error preparing statement: ' . mysqli_error($conn));
}


$name = $_POST['name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$gender = $_POST['gender'];
$image = $_FILES['photo']['name'];
$idtype = $_POST['idtype'];
$cnic = $_POST['cnic'];
$issue = $_POST['issue'];
$expire = $_POST['expire'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];

mysqli_stmt_bind_param($stmt, "ssssssssssss", $name, $dob, $email, $mobile, $gender, $image, $idtype, $cnic, $issue, $expire, $pass, $cpass);

if ($pass == $cpass) {
    $upload_path = "../VoterImg/$image";
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
      
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        
        
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Form Submitted Successfully"); window.location = "../Voter login Form/login.html";</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_stmt_error($stmt) . '"); window.location = "index.html";</script>';
        }
    } else {
        echo '<script>alert("Error uploading file"); window.location = "index.html";</script>';
    }
} else {
    echo '<script>alert("Password and Confirm Password do not match"); window.location = "index.html";</script>';
}


mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
