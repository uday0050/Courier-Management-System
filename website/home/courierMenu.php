<?php
include('dbconnection.php');

if(isset($_POST['submit'])) {
    $sname = $_POST['sname'];
    $remail = $_POST['remail'];
    $sphone = $_POST['sphone'];
    $saddress = $_POST['saddress'];
    $rname = $_POST['rname'];
    $rphone = $_POST['rphone'];
    $raddress = $_POST['raddress'];
    $wgt = $_POST['wgt'];
    $billno = $_POST['billno'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Handle file upload if needed
    $simg = ''; // Placeholder for file path

    // Insert data into the courier table
    $sql = "INSERT INTO courier (u_id, semail, remail, sname, rname, sphone, rphone, saddress, raddress, weight, billno, image, date) VALUES ('4', '$remail', '$remail', '$sname', '$rname', '$sphone', '$rphone', '$saddress', '$raddress', '$wgt', '$billno', '$simg', '$date')";

    if(mysqli_query($dbcon, $sql)) {
        echo '<script>alert("Order placed successfully!");</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($dbcon) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Form Styles */
        #form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto;
        }

        form table {
            width: 100%;
            border-collapse: collapse;
        }

        form th[colspan="4"] {
            background-color: #333;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            border: none;
            text-align: center;
            padding: 15px;
        }

        form td,
        form th {
            padding: 15px;
            text-align: left;
            font-family: 'Poppins', sans-serif;
        }

        form hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form input[type="time"],
        form input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            margin-bottom: 30px; /* Added margin-bottom for spacing */
        }

        form input[type="submit"]:hover {
            background-color: #555;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            form {
                padding: 20px;
            }

            form table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div id="form-container">
        <form action="courierMenu.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <th colspan="4">Fill The Details Of Sender & Receiver</th>
                </tr>
                <tr>
                    <td colspan="4"><hr></td>
                </tr>
                <tr>
                    <th colspan="2">SENDER</th>
                    <th colspan="2">RECEIVER</th>
                </tr>
                <tr>
                    <td colspan="4"><hr></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="sname" placeholder="Sender Full Name" required></td>
                    <td>Name:</td>
                    <td><input type="text" name="rname" placeholder="Receiver Full Name" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="remail" placeholder="Sender Email Id" required></td>
                    <td>Email:</td>
                    <td><input type="text" name="remail" placeholder="Receiver Email Id" required></td>
                </tr>
                <tr>
                    <td>PhoneNo.:</td>
                    <td><input type="number" name="sphone" placeholder="Sender number" required></td>
                    <td>PhoneNo.:</td>
                    <td><input type="number" name="rphone" placeholder="Receiver number" required></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input type="textfield" name="saddress" placeholder="Sender address" required></td>
                    <td>Address:</td>
                    <td><input type="textfield" name="raddress" placeholder="Receiver address" required></td>
                </tr>
                <tr>
                    <td colspan="4"><hr></td>
                </tr>
                <tr>
                    <td>Weight:</td>
                    <td><input type="number" name="wgt" placeholder="Weight in kg" required></td>
                    <td>Payment Id:</td>
                    <td><input type="number" name="billno" placeholder="Enter transaction num" required></td>
                </tr>
                <tr>
                    <td>Date:</td>
                    <?php echo date('Y-m-d'); ?>
                    <td><input type="date" name="date" placeholder="Enter date" required></td>
                    <td>Time:</td>
                    <td><input type="time" name="time" placeholder="Enter time" required></td>
                </tr>
                <tr>
                    <td>Items Image:</td>
                    <td colspan="3"><input type="file" name="simg"></td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><input type="submit" name="submit" value="Place Order"></td>
                </tr>
            </table>
        </form>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>