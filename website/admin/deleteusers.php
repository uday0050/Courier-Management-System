<!-- when admin click delete user link, it displays all users with delete option -->
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
    <title>Showing All Users</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f5f9;
            margin: 0;
            padding: 0;
        }

        .page-title-container {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 2rem;
            text-shadow: 0.1em 0.1em 0.15em #f9829b;
            margin: 0;
        }

        .admintitle {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admintitle .links {
            display: flex;
            align-items: center;
        }

        .admintitle a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .admintitle a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        table {
            width: 80%;
            margin: 50px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: indigo;
            color: #fff;
            font-weight: bold;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        td:last-child {
            text-align: center;
            vertical-align: middle;
        }

        a.action-link {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: #343a40;
            font-weight: bold;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        a.action-link:hover {
            background-color: #f9829b;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="page-title-container">
        <h1 class="page-title">Showing All Users</h1>
    </div>
    <div class="admintitle">
        <div class="links">
            <a href="dashboard.php">Back To Dashboard</a>
        </div>
        <a href="logout.php">Log Out</a>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th>No.</th>
                <th>Users Name</th>
                <th>Email Id</th>
                <th>Action</th>
            
            </tr>
            <?php
            include('../dbconnection.php');
            $qry = "SELECT * FROM `users`";
            $run = mysqli_query($dbcon, $qry);
            if (mysqli_num_rows($run) < 1) {
                echo "<tr><td colspan='4'>There is no Data in Database</td></tr>";
            } else {
                $count = 0;
                while ($data = mysqli_fetch_assoc($run)) {
                    $count++;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><a href="usersdeleted.php?emm=<?php echo $data['email']; ?>" class="action-link">Delete User</a></td>
                    </tr>
                <?php }
            } ?>
        </table>
    </div>
</body>
</html>