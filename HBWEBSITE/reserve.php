<?php
$conn = new mysqli("localhost", "root", "", "hbwebsite");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $reservation_code = uniqid("RES");

    $stmt = $conn->prepare("INSERT INTO rezarvations (full_name, email, room_id, check_in, check_out, reservation_code) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $full_name, $email, $room_id, $check_in, $check_out, $reservation_code);

    if ($stmt->execute()) {
        header("Location: payment.php?reservation_code=$reservation_code");
        exit();
    } else {
        $errorMsg = "An error occurred: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Make a Reservation</title>
  <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">
  <?php require('inc/header.php'); ?>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow border-0">
          <div class="card-body">
            <h3 class="mb-4 text-center h-font fw-bold">Reservation Form</h3>

            <?php if (!empty($errorMsg)): ?>
              <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
            <?php endif; ?>

            <form method="POST" action="reserve.php">
              <input type="hidden" name="room_id" value="<?php echo $_GET['room_id'] ?? 1; ?>">

              <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control shadow-none" name="full_name" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control shadow-none" name="email" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Check-in Date</label>
                <input type="date" class="form-control shadow-none" name="check_in" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Check-out Date</label>
                <input type="date" class="form-control shadow-none" name="check_out" required>
              </div>

              <button type="submit" class="btn btn-success w-100">Confirm Reservation & Proceed to Payment</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>
</body>
</html>
