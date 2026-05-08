<!-- <?php
// include('dbconnection.php');

// if(isset($_POST['submit'])){

//     $sname = $_POST['sname'];
//     $remail = $_POST['remail'];
//     $sphone = $_POST['sphone'];
//     $rname = $_POST['rname'];
//     $rphone = $_POST['rphone'];
//     $saddress = $_POST['saddress'];
//     $raddress = $_POST['raddress'];
//     $wgt = $_POST['wgt'];
//     $billno = $_POST['billno'];
//     $date = $_POST['date'];
//     $time = $_POST['time'];

//     $sql = "INSERT INTO courier (sname, remail, sphone, rname, rphone, saddress, raddress, wgt, billno, date, time) 
//             VALUES ('$sname', '$remail', '$sphone', '$rname', '$rphone', '$saddress', '$raddress', '$wgt', '$billno', '$date', '$time')";
//     if(mysqli_query($dbcon, $sql)){
//         echo '<script>alert("Data added successfully!");</script>';
//     } else {
//         echo '<script>alert("Error: ' . mysqli_error($dbcon) . '");</script>';
//     }
// }
// ?> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #f6d365, #fda085);
            font-family: 'Poppins', sans-serif; /* Poppins font */
            color: #000; /* Text color */
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #000; /* Header color */
            text-align: center;
        }

        p {
            color: #000; /* Paragraph color */
            text-align: center;
        }

        label {
            color: #000; /* Label color */
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="password"],
        .btn {
            border-radius: 25px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        input[type="password"]:focus,
        .btn:focus {
            box-shadow: 0 0 10px #fff;
        }

        .btn-danger {
            background-color: #ff6347;
            border-color: #ff6347;
        }

        .btn-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        a {
            color: #ff6347; /* Link color */
        }

        a:hover {
            color: #e63946; /* Darker red on hover */
        }

        hr {
            border-color: #000; /* Horizontal line color */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Register</h2>
                <p>Please fill this form to create an account.</p>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Num.</label>
                        <input type="number" name="ph" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-danger" value="Register">
                    </div>
                    <p>Already have an account? <a href="index.php">Login here</a>.</p>
                </form>
            </div>
        </div>
        <hr>
        <p>Notice: If the email Id is registered before, it will not respond.</p>
        <p>In this case, reset your password or register with a different email Id....</p>
    </div>
</body>

</html>
