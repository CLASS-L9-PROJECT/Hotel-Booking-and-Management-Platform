<?php
  require('inc/header.php');
  // id parametresi yoksa odalar sayfas�na d�n
  if (!isset($_GET['id'])) {
    redirect('rooms.php');
  }

  // G�venli formatla
  $frm = filteration(['id'=>$_GET['id']]);
  $rid = (int)$frm['id'];

  // Oday� �ek
  $roomRes = select(
    "SELECT * FROM `rooms` WHERE `id`=? AND `status`=1",
    [$rid],
    'i'
  );
  if (!$roomRes || mysqli_num_rows($roomRes)===0) {
    redirect('rooms.php');
  }
  $room = mysqli_fetch_assoc($roomRes);

  // Oda resimlerini al
  $imgsRes = select(
    "SELECT `image` FROM `room_images` WHERE `room_id`=?",
    [$rid],
    'i'
  );

  // �zellikler
  $featRes = select(
    "SELECT f.name 
     FROM features f 
     JOIN room_features rf ON f.id=rf.features_id 
     WHERE rf.room_id=?",
    [$rid],'i'
  );

  // Tesisler
  $facRes = select(
    "SELECT c.name 
     FROM facilities c 
     JOIN room_facilities rc ON c.id=rc.facilities_id 
     WHERE rc.room_id=?",
    [$rid],'i'
  );
?>
<div class="container mt-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= SITE_URL ?>index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= SITE_URL ?>rooms.php">Rooms</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($room['name']) ?></li>
    </ol>
  </nav>

  <div class="row">
    <!-- Resim Galerisi -->
    <div class="col-lg-8 mb-4">
      <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php 
            $first = true;
            while($img = mysqli_fetch_assoc($imgsRes)):
              $src = ROOMS_IMG_PATH.$img['image'];
          ?>
            <div class="carousel-item <?= $first?'active':'' ?>">
              <img src="<?= $src ?>" class="d-block w-100 rounded">
            </div>
          <?php 
            $first = false;
            endwhile;
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>

    <!-- Sa� Panel -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm p-3">
        <h4><?= htmlspecialchars($room['name']) ?></h4>
        <h5 class="text-primary"><?= htmlspecialchars($room['price']) ?>$ per night</h5>

        <!-- Rating sabit 4 y�ld�z olarak g�steriliyor -->
        <div class="mb-3">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>

        <!-- �zellikler -->
        <h6>Features</h6>
        <?php while($f = mysqli_fetch_assoc($featRes)): ?>
          <span class="badge bg-light text-dark me-1"><?= $f['name'] ?></span>
        <?php endwhile; ?>

        <!-- Tesisler -->
        <h6 class="mt-3">Facilities</h6>
        <?php while($c = mysqli_fetch_assoc($facRes)): ?>
          <span class="badge bg-light text-dark me-1"><?= $c['name'] ?></span>
        <?php endwhile; ?>

        <!-- Misafir say�s� -->
        <h6 class="mt-3">Guests</h6>
        <span class="badge bg-light text-dark me-1"><?= $room['adult'] ?> Adults</span>
        <span class="badge bg-light text-dark"><?= $room['children'] ?> Children</span>

        <!-- Alan -->
        <h6 class="mt-3">Area</h6>
        <span class="badge bg-light text-dark"><?= $room['area'] ?> sq. ft.</span>

        <a <?php echo "href='payment.php?room_id=" . $room['id'] . "'"; ?> class="btn btn-success w-100 mt-4">Book Now</a>


      </div>
    </div>
  </div>

  <!-- A��klama -->
  <div class="row mt-5">
    <div class="col">
      <h5>Description</h5>
      <p><?= nl2br(htmlspecialchars($room['description'])) ?></p>
    </div>
  </div>
</div>

<?php require('inc/footer.php'); ?>
