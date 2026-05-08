<!-- Admin header style for Admin pages -->

<!DOCTYPE html>
<html>
<head>
    <title>SpeedyParcel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f5f9;
        }

        /* Admin Title Styles */
        .admintitle {
            position: relative;
            background-color: #343a40;
            color: #fff;
            height: 80px;
            line-height: 80px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .admintitle h1 {
            font-size: 2rem;
            text-shadow: 0.1em 0.1em 0.15em #f9829b;
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
    </style>
</head>
<body>
    <div class="admintitle">
        <h1>SpeedyParcel</h1>
        <div class="links">
            <a href="#">Aryaman</a>
        </div>
    </div>
</body>
</html>