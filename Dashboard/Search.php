<?php
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM addcandidate WHERE cname LIKE '%$query%' OR cparty LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2>Search Results</h2>
        <form >
            <div class="mb-3">
                <label for="query" class="form-label">Search</label>
                <input type="text" class="form-control" id="query" name="query" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <?php if (isset($result)) { ?>
            <h3>Results for "<?php echo htmlspecialchars($query); ?>"</h3>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <li><?php echo $row['cname'] . ' - ' . $row['cparty']; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</body>
</html>
