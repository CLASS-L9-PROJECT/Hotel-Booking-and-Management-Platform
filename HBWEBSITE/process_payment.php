<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Confirmation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .confirmation-box {
      max-width: 600px;
      margin: 80px auto;
      padding: 30px;
      background-color: #d1e7dd;
      border-left: 5px solid #0f5132;
      border-radius: 8px;
    }
    .confirmation-box h2 {
      color: #0f5132;
    }
    .confirmation-box p {
      font-size: 18px;
      color: #0f5132;
    }
  </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST['full_name']);
  $card = htmlspecialchars($_POST['card_number']);
  $last_digits = substr($card, -4);
  ?>

<div class="confirmation-box text-center">
  <h2 class="mb-3">✅ Payment Successful!</h2>
  <p><strong>Name:</strong> <?= $name ?></p>
  <p><strong>Card Number:</strong> **** **** **** <?= $last_digits ?></p>
  <p class="mt-4">Thank you for booking with us. Your transaction has been completed.</p>

  <a href="index.php" class="btn btn-primary mt-4">Return to Homepage</a>
</div>


<?php } else { ?>
  <div class="container mt-5">
    <div class="alert alert-danger">Invalid access. Please go through the booking form.</div>
  </div>
<?php } ?>

</body>
</html>
