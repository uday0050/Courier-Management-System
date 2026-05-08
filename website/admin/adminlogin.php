
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #2c3e50, #3498db);
            margin: 0;
            padding: 0;
            display: flex; /* creating a flexbox */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        /* Container Styles */
        .container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            color: #333;
        }

        /* Heading Styles */
        h1 {
            text-align: center;
            color: #333;
            font-size: 36px;
            margin-bottom: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h6 {
            text-align: center;
            color: #666;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 30px;
        }

        /* Form Styles */
        form {
            text-align: center;
        }

        table {
            margin: auto;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            color: #333;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            color: #fff;
            background-color: #3498db;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Back Link Styles */
        a {
            float: right;
            margin-right: 20px;
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Admin Login</h1>
        <h6>Welcome to the Admin Page</h6>
        <form action="adminlogin.php" method="POST">
            <table>
                <tr>
                    <td>Email ID:</td>
                    <td><input type="email" name="uname" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pass" required></td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td colspan="1" align="center"><input type="submit" name="login" value="Login"></td>
                </tr>
            </table>
        </form>
        <div style="clear:both;"></div>
        <a href="../index.php">Back To Home</a>
    </div>
</body>

</html>


<?php
include('../dbconnection.php');
session_start();
if (isset($_POST['login'])) {
    $ademail = $_POST['uname'];
    $password = $_POST['pass'];
    $qry = "SELECT * FROM `adlogin` WHERE `email`='$ademail' AND `password`='$password'";
    $run = mysqli_query($dbcon, $qry);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
        ?>
        <script>
            alert("Only admin can login..");
            window.open('adminlogin.php', '_self');
        </script>
        <?php
    } else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['a_id'];
        $_SESSION['uid'] = $id;
        header('location: dashboard.php');
    }
}
?>

