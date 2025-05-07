<?php
$conn = new mysqli("localhost", "root", "", "hbwebsite");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMsg = "";
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['reservation_code'];

    // Check if the reservation exists
    $check = $conn->prepare("SELECT * FROM rezarvations WHERE reservation_code = ?");
    $check->bind_param("s", $code);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Delete reservation
        $delete = $conn->prepare("DELETE FROM rezarvations WHERE reservation_code = ?");
        $delete->bind_param("s", $code);
        $delete->execute();
        $successMsg = "Reservation cancelled successfully.";
    } else {
        $errorMsg = "Reservation code not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cancel Reservation</title>
  <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">
  <?php require('inc/header.php'); ?>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow border-0">
          <div class="card-body">
            <h3 class="mb-4 text-center h-font fw-bold">Cancel Reservation</h3>

            <?php if ($successMsg): ?>
              <div class="alert alert-success"><?php echo $successMsg; ?></div>
            <?php elseif ($errorMsg): ?>
              <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
            <?php endif; ?>

            <form method="POST" action="cancel.php">
              <div class="mb-3">
                <label class="form-label">Reservation Code</label>
                <input type="text" class="form-control shadow-none" name="reservation_code" required>
              </div>
              <button type="submit" class="btn btn-danger w-100">Cancel Reservation</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>
</body>
</html>
