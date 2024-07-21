
<?php 
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

$query = "SELECT * FROM addcandidate";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .nav-item a {
            font-family: sans-serif;
            color: mediumblue;
        }
        .nav-item a:hover {
            background: red;
            color: white;
            border-radius: 7px;
        }
    </style>
</head>
<body>
    <ul class="nav justify-content-center bg-dark" style="padding: 20px;">
        <li class="nav-item">
            <h1 style="font-family: sans;color: lawngreen;">Online Voting System</h1>
        </li>
    </ul>
    <nav class="navbar navbar-expand-lg bg-light" style="position: static;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> 
                <img src="Image/Admin.png" width="20%"> 
                <b style="color: darkcyan;">Admin Panel</b>
            </a>
            <button class="navbar-toggler navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#Header">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#AddCandidate">Add Candidate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Voted_Voters.php">Voted Voters List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#Total">Total Candidate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="Header">
        <img src="Image/background4.jpg" width="100%" height="600px">
    </div>
    <br><br>

    <div class="container-fluid" id="AddCandidate" style="box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.9);padding: 40px;">
        <div class="row">
            <div class="col-sm-8">
                <h2 style="text-align: center;">
                    <span style="background: mediumblue;color: whitesmoke;padding: 10px;border-radius: 10px;">
                        Add Candidate for Election
                    </span>
                </h2><br><hr><br>
                <div class="row">
                    <div class="col-sm-6">
                        <form action="AddCanddiate.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Candidate Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cname">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Party Name</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="cparty">
                            </div>
                    </div>
                    <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Select Symbol</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="symbol">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Select Photo</label>
                                <input type="file" class="form-control" id="exampleInputPassword1" name="photo">
                            </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-sm-4">
                <img src="Image/header.jfif" width="100%">
            </div>
        </div>
    </div>
    <br><br>

    <div class="container" id="Total">
        <div class="row">
            <div class="col-sm-10">
                <h2 style="text-align: center;">
                    <span style="background: mediumblue;color: whitesmoke;padding: 10px;border-radius: 10px;">
                        Total List of Candidates
                    </span>
                </h2><br><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Candidate Name</th>
                            <th scope="col">Party</th>
                            <th scope="col">Party Symbol</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Votes</th>
                            <th scope="col" >Action</th>
                        </tr>
                    </thead>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row['cname'] ?></td>
                            <td><?php echo $row['cparty'] ?></td>
                            <td><img src="Image/<?php echo $row['symbol'] ?>" width="50%"></td>
                            <td><img src="Image/<?php echo $row['photo'] ?>" width="50%"></td>
                            <td><?php echo $row['votes'] ?></td>
                            <td>
                                <a href="deletecandidate.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

