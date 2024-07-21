<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gvotes']) && isset($_POST['gid'])) {
    $votes = $_POST['gvotes'];
    $total_votes = $votes + 1;
    $gid = $_POST['gid'];
    $uid = $_SESSION['voterdata']['id'];

    // Fetch the `cnic` from `voterregistration` using the `id`
    $fetch_cnic_query = "SELECT cnic FROM voterregistration WHERE id = '$uid'";
    $result_cnic = mysqli_query($conn, $fetch_cnic_query);

    if ($result_cnic && mysqli_num_rows($result_cnic) > 0) {
        $row = mysqli_fetch_assoc($result_cnic);
        $cnic = $row['cnic'];

        // Insert into voted_voters with valid `cnic`
        $insert_query = "INSERT INTO voted_voters (voter_id, candidate_id, vote_time) VALUES ('$cnic', '$gid', NOW())";
        $result_insert = mysqli_query($conn, $insert_query);

        if ($result_insert) {
            // Update votes for the selected candidate
            $update_votes_query = "UPDATE addcandidate SET votes = '$total_votes' WHERE id = '$gid'";
            $result_votes_update = mysqli_query($conn, $update_votes_query);

            // Update voter status to indicate they have voted
            $update_status_query = "UPDATE voterregistration SET status = 1 WHERE id = '$uid'";
            $result_status_update = mysqli_query($conn, $update_status_query);

            if ($result_votes_update && $result_status_update) {
                // Update session data if needed
                $_SESSION['voterdata']['status'] = 1;

                // Flush the output buffer
                ob_start();
                ob_end_flush();

                echo '
                <script>
                    alert("Voting Successful");
                    window.location.href = "../dashboard.php";
                </script>
                ';
            } else {
                echo "Error updating votes or status: " . mysqli_error($conn);
            }
        } else {
            echo "Error inserting into voted_voters: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid voter ID or missing CNIC";
    }
} else {
    echo "Invalid request method";
}

mysqli_close($conn);
?>
