<?php
session_start();

// Admin panelin inc i�indeki ayarlar� y�kle
require __DIR__ . '/../admin/inc/db_config.php';
require __DIR__ . '/../admin/inc/essentials.php';

// �leti�im detaylar�n� �ek (footer vs. i�in)
$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$contact_r = mysqli_fetch_assoc(
  select($contact_q, [1], 'i')
);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo SITE_URL; ?>index.php">C9 Hotel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>rooms.php">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>facilities.php">Facilities</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>contact.php">Contact us</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>about.php">About</a></li>
      </ul>
      <div class="d-flex">
  <?php if (!empty($_SESSION['userLogin'])): ?>
    <a href="<?php echo SITE_URL; ?>logout.php" class="btn btn-outline-dark me-2">Logout</a>
  <?php else: ?>
    <button class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    <button class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
    <a href="<?php echo SITE_URL; ?>cancel.php" class="btn btn-outline-danger">Cancel</a>
  <?php endif; ?>
</div>

    </div>
  </div>
</nav>



<!-- LOGIN MODAL -->
<div id="loginModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo SITE_URL; ?>login.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">User Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label for="loginEmail">Email</label>
          <input name="email" id="loginEmail" type="email" class="form-control" required>
          <label for="loginPassword" class="mt-3">Password</label>
          <input name="password" id="loginPassword" type="password" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button name="login" type="submit" class="btn btn-dark">LOGIN</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- REGISTER MODAL -->
<div id="registerModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo SITE_URL; ?>register.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">User Register</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="regName">Name</label>
              <input name="name" id="regName" type="text" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="regEmail">Email</label>
              <input name="email" id="regEmail" type="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="regPhone">Phone Number</label>
              <input name="phonenum" id="regPhone" type="text" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="regPicture">Picture</label>
              <input name="profile" id="regPicture" type="file" accept=".jpg,.png,.webp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label for="regAddress">Address</label>
              <textarea name="address" id="regAddress" class="form-control" rows="1" required></textarea>
            </div>
            <div class="col-md-6">
              <label for="regPincode">Pincode</label>
              <input name="pincode" id="regPincode" type="number" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="regDob">Date of Birth</label>
              <input name="dob" id="regDob" type="date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="regPassword">Password</label>
              <input name="password" id="regPassword" type="password" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="regConfirm">Confirm Password</label>
              <input name="confirm_password" id="regConfirm" type="password" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button name="register" type="submit" class="btn btn-dark">REGISTER</button>
        </div>
      </form>
    </div>
  </div>
</div>
