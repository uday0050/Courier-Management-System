<?php session_start(); if(isset($_SESSION['uid'])){ echo ""; }else{ header('location: ../login.php'); } ?>
<?php
include('header.php');
include('../dbconnection.php');
$idd = $_GET['sidd'];
$qryy = "SELECT * FROM `courier` WHERE `c_id`='$idd'";
$run = mysqli_query($dbcon, $qryy);
$data = mysqli_fetch_assoc($run);
$stdate = $data['date'];
$tddate = date('Y-m-d');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Courier Tracking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .status {
            background-color: #FF9800;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 30px;
        }
        .button {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 10px;
            background-color: #2196F3;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #1976D2;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if($stdate == $tddate): ?>
            <h1>Courier Status</h1>
            <div class="status">
                Status: On The Way...
            </div>
            <a href="trackMenu.php" class="button">Go Back</a>
        <?php else: ?>
            <h1>Courier Status</h1>
            <div class="status">
                Status: Items Delivered<br>
                HAVE A NICE DAY
            </div>
            <a href="trackMenu.php" class="button">Go Back</a>
        <?php endif; ?>
    </div>
</body>
</html>