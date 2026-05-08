<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* Global Styles */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: #f0f0f0; /* Light gray background */
    }

    /* Header Styles */
    header {
      background-color: #007bff; /* Blue background */
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    header h1 {
      font-size: 36px;
      margin: 0;
    }

    /* Main Content Styles */
    main {
      padding: 50px;
      text-align: center;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      margin-top: 30px;
    }

    .image-section {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 300px;
      transition: all 0.3s ease;
    }

    .image-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h2 {
      font-size: 28px;
      margin-bottom: 30px;
      color: #333;
    }

    h5 {
      font-size: 18px;
      margin-bottom: 20px;
      color: #666;
      font-weight: bold;
    }

    /* Responsive Styles */
    @media screen and (max-width: 768px) {
      main {
        padding: 30px;
      }

      .image-section {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <?php include('header.php'); ?>
  <main>
    <header>
      <h1>Welcome to SpeedyParcel Courier Management Service</h1>
      <h3>The services we offer</h3>
    </header>
    <div class="container">
      <div class="image-section" style="background-color: #ffc107;"> <!-- Yellow background -->
        <h5>Fast & Reliable Delivery</h5>
      </div>
      <div class="image-section" style="background-color: #28a745;"> <!-- Green background -->
        <h5>Track Your Package Anytime</h5>
      </div>
      <div class="image-section" style="background-color: #dc3545;"> <!-- Red background -->
        <h5>Safe & Secure Delivery</h5>
      </div>
    </div>
  </main>
</body>

</html>
