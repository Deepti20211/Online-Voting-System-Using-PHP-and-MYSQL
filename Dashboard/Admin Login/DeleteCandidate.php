<?php
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = ""; // Initialize the message variable

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM addcandidate WHERE id=$id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $message = "Candidate deleted successfully.";
        } else {
            $message = "Error deleting candidate: " . mysqli_error($conn);
        }
    } else {
        $message = "No candidate ID provided.";
    }
} else {
    $message = "Invalid request method.";
}

mysqli_close($conn);

// Redirect only if headers have not been sent
if (!headers_sent()) {
    header('Location: admindashboard.php?message=' . urlencode($message));
    exit; // Make sure to exit after the redirection
} else {
    echo $message;
}
?>
