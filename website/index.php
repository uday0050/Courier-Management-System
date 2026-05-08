<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "dbconnection.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $qry = "SELECT * FROM `login` WHERE `email`='$email' AND `password`='$password'";
    $run = mysqli_query($dbcon, $qry);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
?>
        <script>
            alert("Opps! plz Enter Your Username and Password again..");
            window.open('index.php', '_self');
        </script> <?php
                } else {
                    $data = mysqli_fetch_assoc($run);
                    $id = $data['u_id'];    //fetch id value of user
                    $email = $data['email'];
                    $_SESSION['uid'] = $id;   //now we can use it until session destroy
                    $_SESSION['emm'] = $email;
                    ?>
        <script>
            alert("Welcome to our courier service website");
            window.open('home/home.php', '_self');
            // changes made here
        </script> <?php

                }
            }
?>

<!DOCTYPE html>
<html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <style>
                
                body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #63c5ff, #8bc34a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            }

            .container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 50px;
            width: 500px;
            max-width: 90%;
            text-align: center;
            }

            .header {
            margin-bottom: 30px;
            }

            .header h1 {
            color: #6200ea;
            font-size: 38px;
            margin-bottom: 10px;
            font-weight: bold;
            }

            .header p {
            color: #333;
            margin: 0;
            font-size: 18px;
            }

            .admin-login {
            margin-top: 20px;
            }

            .admin-login a {
            color: #333;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
            }

            .admin-login a:hover {
            color: #6200ea;
            }

            h2 {
            color: #6200ea;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            }

            p {
            color: #333;
            font-size: 16px;
            margin-bottom: 20px;
            }

            .form-group {
            margin-bottom: 30px;
            }

            .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            }

            .btn-primary {
            background-color: #ff6f00;
            border: none;
            color: #fff;
            padding: 15px 40px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            width: 48%;
            }

            .btn-primary:hover {
            background-color: ##ffa000;
            }

            .btn-danger {
            background-color: #f44336;
            border: none;
            color: #fff;
            padding: 15px 40px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            width: 48%;
            }

            .btn-danger:hover {
            background-color: #c82333;
            }

            .link {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
            }

            .link:hover {
            color: #0056b3;
            }

                

    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>SpeedyParcel Courier Service</h1>
            <p>Swiftly Connecting Your World, One Parcel at a Time.</p>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Sign In">
                <button onclick="window.location.href='resetpswd.php'" class="btn btn-danger">Reset Password</button>
            </div>
            <p>Don't have an account? <a href="register.php" class="link">Register here</a>.</p>
        </form>
        <div class="admin-login">
            <a href="admin/adminlogin.php">Admin Login</a>
        </div>
    </div>
</body>

</html>
