<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ContactUs</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0; /* Light gray background */
            font-family: 'Poppins', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .mail-form {
            background-color: #fff;
            border-radius: 10px; /* Slightly reduced border radius */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Reduced box shadow */
            padding: 30px; /* Reduced padding */
        }

        .mail-form h2 {
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .mail-form p {
            color: #666;
            margin-bottom: 20px; /* Reduced margin bottom */
        }

        .form-control {
            border-radius: 8px; /* Reduced border radius */
            border: 1px solid #ddd;
            padding: 12px 15px; /* Reduced padding */
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .textarea {
            height: 120px; /* Reduced textarea height */
        }

        .button {
            width: 100%;
            border-radius: 8px; /* Reduced border radius */
            background-color: #007bff;
            color: #fff;
            padding: 12px 15px; /* Reduced padding */
            border: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mail-form">
                <h2 class="text-center">Drop a Message</h2>
                <p class="text-center">We are waiting for your response..</p>
                <form action="contactUs.php" method="POST">
                    <div class="form-group">
                        <input class="form-control" name="email" type="email" placeholder="Email Id">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="subject" type="text" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control textarea" name="message" placeholder="Compose your message.."></textarea>
                    </div>
                    <div class="form-group">
                        <input class="button" type="submit" name="send" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
