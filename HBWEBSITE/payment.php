<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7f7f7;
    }
    .payment-box {
      max-width: 500px;
      margin: 60px auto;
      padding: 30px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

  <div class="payment-box">
    <h3 class="mb-4 text-center">Complete Your Booking</h3>

    <form action="process_payment.php" method="post">
      <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="full_name" name="full_name" required>
      </div>

      <div class="mb-3">
        <label for="card_number" class="form-label">Card Number</label>
        <input type="text" class="form-control" id="card_number" name="card_number" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" required>
      </div>

      <div class="mb-3">
        <label for="expiry_date" class="form-label">Expiry Date</label>
        <input type="month" class="form-control" id="expiry_date" name="expiry_date" required>
      </div>

      <div class="mb-4">
        <label for="cvv" class="form-label">CVV</label>
        <input type="text" class="form-control" id="cvv" name="cvv" maxlength="4" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Pay Now</button>
    </form>
  </div>

</body>
</html>
