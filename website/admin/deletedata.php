<!-- when admin click delete data link, page with filter options-->
<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
}
?>
<?php include('head.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Data Information</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .admintitle {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admintitle h1 {
            font-size: 2rem;
            text-shadow: 0.1em 0.1em 0.15em #f9829b;
            margin: 0;
        }

        .admintitle a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s ease;
            padding: 10px;
        }

        .admintitle a:hover {
            color: #f9829b;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: separate;
            border-spacing: 0 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #3f51b5;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #e8eaf6;
        }

        img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }

        a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #f9829b;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="admintitle">
        <a href="dashboard.php">Back To Dashboard</a>
        <h1>Search Data Information</h1>
        <a href="logout.php">Log Out</a>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th>No.</th>
                <th>Items Image</th>
                <th>Sender Name</th>
                <th>Receiver Name</th>
                <th>Sender Email</th>
                <th>Action</th>
            </tr>
            <?php
            include('../dbconnection.php');
            $qryd = "SELECT * FROM `courier`";
            $run = mysqli_query($dbcon, $qryd);
            if (mysqli_num_rows($run) < 1) {
                echo "<tr><td colspan='6'>No record found..</td></tr>";
            } else {
                $count = 0;
                while ($data = mysqli_fetch_assoc($run)) {
                    $count++;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic"></td>
                        <td><?php echo $data['sname']; ?></td>
                        <td><?php echo $data['rname']; ?></td>
                        <td><?php echo $data['semail']; ?></td>
                        <td><a href="datadeleted.php?bb=<?php echo $data['billno']; ?>">Delete</a></td>
                    </tr>
                <?php }
            } ?>
        </table>
    </div>
</body>

</html>
