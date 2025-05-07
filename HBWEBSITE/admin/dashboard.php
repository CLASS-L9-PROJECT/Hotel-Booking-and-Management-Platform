<?php
require('../inc/essentials.php');   // ✅ adminLogin buradan gelir
require('../inc/db_config.php');    // ✅ veritabanı bağlantısı buradan gelir
adminLogin();                       // ❗ bu fonksiyon artık tanımlı

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

<?php
require('inc/db_config.php');

// TOPLAM REZERVASYON
$totalBookingsQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM rezarvations");
$totalBookings = mysqli_fetch_assoc($totalBookingsQuery)['total'];

// TOPLAM GELİR (örnek: her rezervasyon 200₺ varsayalım)
$totalRevenue = $totalBookings * 200;

// AKTİF REZERVASYON (bugünkü tarihten sonrası)
$activeBookingsQuery = mysqli_query($conn, "SELECT COUNT(*) AS active FROM rezarvations WHERE check_out > CURDATE()");
$activeBookings = mysqli_fetch_assoc($activeBookingsQuery)['active'];
$activeRevenue = $activeBookings * 200;

// İPTAL SAYISI (basit mantıkla hesaplıyoruz)
$cancelledBookings = $totalBookings - $activeBookings;
$cancelledRevenue = $cancelledBookings * 200;
?>

<?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
  <div class="row">
    <div class="col-lg-10 ms-auto p-4 overflow-hidden">

      <!-- DASHBOARD ANALYTICS -->
      <h3 class="mb-4">Booking Analytics</h3>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>Total Bookings</h6>
            <h4 class="text-primary">₹<?= $totalRevenue ?></h4>
            <span class="badge bg-info"><?= $totalBookings ?></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>Active Bookings</h6>
            <h4 class="text-success">₹<?= $activeRevenue ?></h4>
            <span class="badge bg-success"><?= $activeBookings ?></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>Cancelled Bookings</h6>
            <h4 class="text-danger">₹<?= $cancelledRevenue ?></h4>
            <span class="badge bg-danger"><?= $cancelledBookings ?></span>
          </div>
        </div>
      </div>

      <!-- USER/QUERY/REVIEW ANALYTICS (şimdilik sabit) -->
      <h3 class="my-4">User, Queries, Reviews Analytics</h3>
      <div class="row g-3">
        <div class="col-md-3">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>New Registration</h6>
            <span class="badge bg-success">1</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>Queries</h6>
            <span class="badge bg-primary">2</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>Reviews</h6>
            <span class="badge bg-secondary">6</span>
          </div>
        </div>
      </div>

      <!-- USERS SECTION (şimdilik sabit) -->
      <h3 class="my-4">Users</h3>
      <div class="row g-3">
        <div class="col-md-3">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>Total</h6>
            <span class="badge bg-dark">1</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>Active</h6>
            <span class="badge bg-success">1</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>Inactive</h6>
            <span class="badge bg-warning">0</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="bg-white p-4 rounded shadow-sm text-center">
            <h6>Unverified</h6>
            <span class="badge bg-danger">0</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php require('inc/scripts.php'); ?>
</body>
</html>
