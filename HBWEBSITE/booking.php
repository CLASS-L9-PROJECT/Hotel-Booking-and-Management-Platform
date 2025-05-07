<?php
$room_id = $_GET['room_id'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f8f9fa;
    }
    .booking-card {
      max-width: 500px;
      margin: auto;
      margin-top: 60px;
      padding: 30px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .booking-card h2 {
      font-weight: bold;
      margin-bottom: 25px;
    }
    .form-label {
      font-weight: 500;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="booking-card">
      <h2 class="text-center">Select Booking Dates</h2>

      <form action="payment.php" method="get">
        <input type="hidden" name="room_id" value="<?= htmlspecialchars($room_id) ?>">

        <div class="mb-3">
          <label for="checkin" class="form-label">Check-in Date</label>
          <input type="date" class="form-control shadow-sm" name="checkin" required>
        </div>

        <div class="mb-3">
          <label for="checkout" class="form-label">Check-out Date</label>
          <input type="date" class="form-control shadow-sm" name="checkout" required>
        </div>

        <button type="submit" class="btn btn-success w-100 shadow-sm">
          Continue to Payment
        </button>
      </form>
    </div>
  </div>

</body>
</html>
