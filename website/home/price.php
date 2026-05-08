<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing</title>
    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; /* Light background color */
            color: #333; /* Dark text color */
        }

        /* Table Styles */
        table {
            width: 50%;
            margin: 30px auto;
            border-collapse: collapse;
            border: 5px solid black; /* Green border */
            border-spacing: 5px;
        }

        th {
            background-color: black; /* Green background color */
            color: #fff; /* White text color */
            font-size: 24px;
            font-weight: bold;
            padding: 10px;
            text-align: center;
        }

        td {
            padding: 10px;
            text-align: left;
        }

        /* Payment Methods Styles */
        .payment-methods {
            margin: 20px auto;
            text-align: center;
        }

        .payment-methods ol {
            list-style: none;
            padding: 0;
        }

        .payment-methods ol li {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <table>
        <tr>
            <th>Weight in Kg</th>
            <th>Price</th>
        </tr>
        <tr>
            <td>0-1</td>
            <td>120</td>
        </tr>
        <tr>
            <td>1-2</td>
            <td>200</td>
        </tr>
        <tr>
            <td>2-4</td>
            <td>250</td>
        </tr>
        <tr>
            <td>4-5</td>
            <td>300</td>
        </tr>
        <tr>
            <td>5-7</td>
            <td>400</td>
        </tr>
        <tr>
            <td>7-above</td>
            <td>500</td>
        </tr>
    </table>
    <h3 align="center">As per your courier's weight, pay the amount through:</h3>
    <div class="payment-methods">
        <ol>
            <li>UPI: abcd@sbi.com</li>
            <li>GPay: 123456</li>
            <li>PhonePay: 123456</li>
        </ol>
    </div>
</body>
</html>
