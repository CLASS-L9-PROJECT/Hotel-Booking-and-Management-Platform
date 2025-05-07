<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>C9 Hotel - ROOMS</title>
  <?php require('inc/links.php') ?>
</head>

<style>
.availability-form {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin: 20px 0;
    padding: 10px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.availability-form label {
    font-weight: bold;
    margin-right: 5px;
}

.availability-form input[type="date"] {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.availability-form button {
    padding: 8px 15px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.availability-form button:hover {
    background-color: #2980b9;
}
</style>




<body class="bg-light">

<?php
include 'inc/db_connection.php';

if (isset($_GET['check_in']) && isset($_GET['check_out'])) {
    $checkIn = $_GET['check_in'];
    $checkOut = $_GET['check_out'];

    $checkIn = mysqli_real_escape_string($conn, $checkIn);
    $checkOut = mysqli_real_escape_string($conn, $checkOut);

    // 1. Müsait odaları çek
    $query = "
        SELECT * FROM rooms 
        WHERE id NOT IN (
            SELECT room_id FROM reservations
            WHERE 
                ('$checkIn' < check_out) AND 
                ('$checkOut' > check_in)
        )
    ";
    $result = mysqli_query($conn, $query);

    echo "<h2>Müsait Odalar</h2>";
    if (mysqli_num_rows($result) > 0) {
        while ($room = mysqli_fetch_assoc($result)) {
            echo "<div class='room-card'>";
            echo "<h3>" . htmlspecialchars($room['room_name']) . "</h3>";
            echo "<p>" . htmlspecialchars($room['description']) . "</p>";

            // 2. Bu odaya ait tüm dolu tarihleri çek
            $roomId = $room['id'];
            $reservationQuery = "
                SELECT check_in, check_out FROM reservations 
                WHERE room_id = $roomId
            ";
            $resResult = mysqli_query($conn, $reservationQuery);

            if (mysqli_num_rows($resResult) > 0) {
                echo "<p><strong>Dolu Tarihler:</strong></p>";
                echo "<ul>";
                while ($res = mysqli_fetch_assoc($resResult)) {
                    echo "<li>" . $res['check_in'] . " → " . $res['check_out'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Bu oda daha önce hiç rezerve edilmemiş.</p>";
            }

            echo "<a class='book-btn' href='book.php?room_id=" . $room['id'] . "'>Hemen Rezerve Et</a>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>Bu tarihler için müsait oda bulunamadı.</p>";
    }
}
?>



  <?php require('inc/header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
    <div class="h-line bg-dark"></div>
  </div>

  <div class="container">
    <div class="row">

      <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
          <div class="container-fluid flex-lg-column   align-items-stretch">
            <h4 class="mt-2">FILTERS</h4>
            <button
              class="navbar-toggler shadow-none"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#filterDropdown"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILTY</h5>
                <label class="form-label">check-in</label>
                <input type="date" class="form-control shadow-none mb-3" />
                <label class="form-label">check-out</label>
                <input type="date" class="form-control shadow-none" />
              </div>
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                <div class="mb-2">
                  <input type="checkbox" id="f1" class="form-check-input shadow-none me-1" />
                  <label class="form-check-label" for="f1">Facility one</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f3" class="form-check-input shadow-none me-1" />
                  <label class="form-check-label" for="f2">Facility two</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f3" class="form-check-input shadow-none me-1" />
                  <label class="form-check-label" for="f3">Facility three</label>
                </div>
              </div>
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                <div class="d-flex">
                  <div class="me-3">
                    <label class="form-label">Adults</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                  <div>
                    <label class="form-label">Children</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>

      <div class="col-lg-9 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 mb-0">
              <img src="images/rooms/1.jpg" class="img-fluid rounded">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px=0">
              <h5 class="mb-3">Simple Room Name</h5>
              <div class="features mb-3">
                <h6 class="mb-1">Features</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  2 Rooms
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  1 Bathroom
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  1 Balcony
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  3 Sofa
                </span>
              </div>
              <div class="facilities mb-3">
                <h6 class="mb-1">Facilities</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Wifi
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Television
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  AC
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Room heater
                </span>
              </div>
              <div class="guests">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  5 Adults
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  4 Children
                </span>
              </div>
            </div>
            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
              <h6 class="mb-4">200$ per night</h6>
              <a href="reserve.php?room_id=1" class="btn btn-success w-100 mt-4">Book Now</a>







              <a href="booking.php?room_id=1" 
   class="btn btn-sm w-100 btn-outline-dark shadow-none mb-2 mt-1">
   More details
</a>
<a href="cancel.php" class="btn btn-outline-danger btn-sm w-100">Cancel Reservation</a>


            </div>
          </div>
        </div>
        <div class="card mb-4 border-0 shadow">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 mb-0">
              <img src="images/rooms/1.jpg" class="img-fluid rounded">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px=0">
              <h5 class="mb-3">Simple Room Name</h5>
              <div class="features mb-3">
                <h6 class="mb-1">Features</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  2 Rooms
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  1 Bathroom
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  1 Balcony
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  3 Sofa
                </span>
              </div>
              <div class="facilities mb-3">
                <h6 class="mb-1">Facilities</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Wifi
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Television
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  AC
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Room heater
                </span>
              </div>
              <div class="guests">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  5 Adults
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  4 Children
                </span>
              </div>
            </div>
            <div class="col-md-2 text-center">
              <h6 class="mb-4">200$ per night</h6>
              <a href="reserve.php?room_id=1" class="btn btn-success w-100 mt-4">Book Now</a>



              <a href="booking.php?room_id=1" 
   class="btn btn-sm w-100 btn-outline-dark shadow-none mb-2 mt-1">
   More details
</a>
<a href="cancel.php" class="btn btn-outline-danger btn-sm w-100">Cancel Reservation</a>



            </div>
          </div>
        </div>
        <div class="card mb-4 border-0 shadow">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 mb-0">
              <img src="images/rooms/1.jpg" class="img-fluid rounded">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px=0">
              <h5 class="mb-3">Simple Room Name</h5>
              <div class="features mb-3">
                <h6 class="mb-1">Features</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  2 Rooms
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  1 Bathroom
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  1 Balcony
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  3 Sofa
                </span>
              </div>
              <div class="facilities mb-3">
                <h6 class="mb-1">Facilities</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Wifi
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Television
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  AC
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Room heater
                </span>
              </div>
              <div class="guests">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  5 Adults
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  4 Children
                </span>
              </div>
            </div>
            <div class="col-md-2 text-center">
              <h6 class="mb-4">200$ per night</h6>
              <a href="reserve.php?room_id=1" class="btn btn-success w-100 mt-4">Book Now</a>



              <a href="booking.php?room_id=1" 
   class="btn btn-sm w-100 btn-outline-dark shadow-none mb-2 mt-1">
   More details
</a>
<a href="cancel.php" class="btn btn-outline-danger btn-sm w-100">Cancel Reservation</a>



            </div>
          </div>
        </div>
      </div>

    </div>
  </div>




  <?php require('inc/footer.php'); ?>


</body>

</html>