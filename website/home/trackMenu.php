
<?php
session_start();

include('header.php');
include('../dbconnection.php');
$email = '';

if(isset($_SESSION['emm'])) {
  $email = $_SESSION['emm']; 
}


// Query to fetch data from the database
$qryy = "SELECT * FROM `courier` WHERE `semail`='$email'";
$run = mysqli_query($dbcon, $qryy);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Management</title>
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

        /* Table Styles */
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: #333;
            color: #fff;
            font-size: 18px;
            padding: 15px;
            text-align: center;
        }

        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        /* Table Row Styles */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Link Styles */
        a {
            color: #007bff;
            text-decoration: none;
            margin: 0 5px;
            transition: color 0.3s ease;
        }

        /* Link Hover Styles */
        a:hover {
            color: #333;
        }

        /* Image Styles */
        img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            table {
                width: 100%;
            }

            th, td {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th>No.</th>
                <th>Item's Image</th>
                <th>Sender Name</th>
                <th>Receiver Name</th>
                <th>Receiver Email</th>
                <th>Action</th>
            </tr>
            <?php
            if (mysqli_num_rows($run) < 1) {
                echo "<tr><td colspan='6'>No record found..</td></tr>";
            } else {
                $count = 0;
                while ($data = mysqli_fetch_assoc($run)) {
                    $count++;
                    ?>
                    <tr align="center">
                        <td><?php echo $count; ?></td>
                        <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic"></td>
                        <td><?php echo $data['sname']; ?></td>
                        <td><?php echo $data['rname']; ?></td>
                        <td><?php echo $data['remail']; ?></td>
                        <td>
                            <a href="updationtable.php?sid=<?php echo $data['c_id']; ?>">Edit</a> ||
                            <a href="deletecourier.php?bb=<?php echo $data['billno']; ?>">Delete</a> ||
                            <a href="status.php?sidd=<?php echo $data['c_id']; ?>">Check Status</a>
                        </td>
                    </tr>
                <?php }
            }
            ?>
        </table>
    </div>
</body>
</html>
<?php // Closing PHP tag added ?>