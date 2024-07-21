<?php
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

$check = mysqli_query($conn, "SELECT * FROM adminlogin WHERE name='$username' AND password='$password'");

if (!$check) {
    die('Query failed: ' . mysqli_error($conn));
}

if (mysqli_num_rows($check) > 0) {
    echo '
        <script>
            location = "AdminDashboard.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Invalid username or password.");
            location = "../Adminlogin.php";
        </script>
    ';
}
?>
