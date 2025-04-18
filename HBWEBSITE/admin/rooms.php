<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Rooms</title>
  <?php require('inc/links.php') ?>
</head>

<body class="bg-light">
  <?php require('inc/header.php') ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">ROOMS</h3>

        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <div class="text-end mb-4">
              <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                <i class="bi bi-plus-square"></i> Add 
              </button>
            </div>

            <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
              <table class="table table-hover border">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Area</th>
                    <th scope="col">Guests</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="room-data"></tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Add Room Modal -->
  <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="featureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="add_room_form" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Room</h5>
          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Name</label>
                <input type="text" name="name" class="form-control shadow-none" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Area</label>
                <input type="number" min="1" name="area" class="form-control shadow-none" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Price</label>
                <input type="number" min="1" name="price" class="form-control shadow-none" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Quantity</label>
                <input type="number" min="1" name="quantity" class="form-control shadow-none" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Adult (Max.)</label>
                <input type="number" min="1" name="adult" class="form-control shadow-none" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Children (Max.)</label>
                <input type="number" min="1" name="children" class="form-control shadow-none" required>
              </div>

              <!-- FEATURES -->
              <div class="col-12 mb-3">
                <label class="form-label fw-bold">Features</label>
                <div class="row">
                  <?php
                    $res = selectAll('features');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo "
                        <div class='col-md-3 mb-1'>
                          <label class='form-check-label'>
                            <input type='checkbox' name='features[]' value='{$opt['id']}' class='form-check-input shadow-none'>
                            {$opt['name']}
                          </label>
                        </div>
                      ";
                    }
                  ?>
                </div>
              </div>

              <!-- FACILITIES -->
              <div class="col-12 mb-3">
                <label class="form-label fw-bold">Facilities</label>
                <div class="row">
                  <?php
                    $res = selectAll('facilities');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo "
                        <div class='col-md-3 mb-2'>
                          <label class='form-check-label'>
                            <input type='checkbox' name='facilities[]' value='{$opt['id']}' class='form-check-input shadow-none'>
                            {$opt['name']}
                          </label>
                        </div>
                      ";
                    }
                  ?>
                </div>
              </div>

              <!-- DESCRIPTION -->
              <div class="col-12 mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="desc" class="form-control shadow-none" rows="5"></textarea>
              </div>

            </div>
          </div>

          <div class="modal-footer">
            <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
            <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Manage room images modal -->

<div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Room Name</h1>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="border-bottom border-3 pb-3 mb-3">
            <form id="add_image_form">
               <label class="form-label fw-bold">Add Image</label>
               <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
               <button class="btn custom-bg text-white shadow-none">ADD</button>
               <input type="hidden" name="room_id">
            </form>
        </div>
        <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
              <table class="table table-hover border">
                <thead>
                  <tr class="bg-dark text-light sticky-top">
                    <th scope="col" width="60%">Image</th>
                    <th scope="col">Thumb</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody id="room-image-data"></tbody>
              </table>
            </div>
      </div>
    </div>
  </div>
</div>

  <?php require('inc/scripts.php'); ?>

  <script>
    let add_room_form = document.getElementById('add_room_form');

    add_room_form.addEventListener('submit', function(e){
      e.preventDefault();
      add_room();
    });

    function add_room() {
      let data = new FormData();
      data.append('add_room','');
      data.append('name', add_room_form.elements['name'].value);
      data.append('area', add_room_form.elements['area'].value);
      data.append('price', add_room_form.elements['price'].value);
      data.append('quantity', add_room_form.elements['quantity'].value);
      data.append('adult', add_room_form.elements['adult'].value);
      data.append('children', add_room_form.elements['children'].value);
      data.append('desc', add_room_form.elements['desc'].value);

      let features = [];
      document.querySelectorAll("input[name='features[]']:checked").forEach(el => {
        features.push(el.value);
      });

      let facilities = [];
      document.querySelectorAll("input[name='facilities[]']:checked").forEach(el => {
        facilities.push(el.value);
      });

      data.append('features', JSON.stringify(features));
      data.append('facilities', JSON.stringify(facilities));

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms.php", true);

      xhr.onload = function () {
        let myModal = document.getElementById("add-room");
        let modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        console.log('RESPONSE:', this.responseText); // ✅ See what backend actually sends

        if (this.responseText.trim() == '1') {
          alert('New room added!');
          add_room_form.reset();
          get_all_rooms();
        } else {
          alert('Error: ' + this.responseText); // 🔥 Show full response instead of just “Server Down”
        }
      }


      xhr.send(data); 
    }

    function get_all_rooms() {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms.php", true);
      xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

      xhr.onload = function () {
        document.getElementById('room-data').innerHTML = this.responseText;
      }

      xhr.send('get_all_rooms');
    }

    window.onload = function () {
      get_all_rooms();
    }

    let add_image_form = document.getElementById('add_image_form');

    add_image_form.addEventListener('submit', function(e){
      e.preventDefault();
      add_image();
    });

 function add_image() 
 {
      let data = new FormData();
      data.append("image", add_image_form.elements['image'].files[0]);
      data.append("room_id", add_image_form.elements['room_id'].value);
      data.append("add_image", "");

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/carousel_crud.php", true);

      xhr.onload = function () 
      {
        if (this.responseText == "inv_img") {
          alert("error", "Only JPG, WEBP or PNG images are allowed!");
        } else if (this.responseText == "inv_size") {
          alert("error", "Image should be less than 2MB!");
        } else if (this.responseText == "upd_failed") {
          alert("error", "Image upload failed. Server Down!");
        } else {
          alert("success", "New image added!");
          add_image_form.reset();
        }
      }
      xhr.send(data);
 }

 window.onload = function(){
     get_all_rooms();
 }

  </script>
  

</body>
</html>
