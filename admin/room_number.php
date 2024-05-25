<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Room Number</title>
  <?php require('inc/links.php'); ?>
</head>

<body class="bg-cl">
  <?php require('inc/header.php'); ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">ROOM NUMBER</h3>

        <!-- features section-->
        <div class="card border-0 mb-4 bg-cl">
          <div class="card-body">
            <!-- btn search -->
            <div class="text-end mb-4">
              <button type="button" onclick="get_all_rooms()" class="btn btn-success shadow-none btn-sm text-light">
                All Room
              </button>
              <button type="button" onclick="get_rooms('Master Room')" class="btn btn-success shadow-none btn-sm text-light">
                Master Room
              </button>
              <button type="button" onclick="get_rooms('Double Room')" class="btn btn-success shadow-none btn-sm text-light">
                Double Room
              </button>
              <button type="button" onclick="get_rooms('Couple Room')" class="btn btn-success shadow-none btn-sm text-light">
                Couple Room
              </button>
              <button type="button" onclick="get_rooms('Simple Room')" class="btn btn-success shadow-none btn-sm text-light">
                Simple Room
              </button>
              <button type="button" onclick="get_rooms('Luxury Room')" class="btn btn-success shadow-none btn-sm text-light">
                Luxury Room
              </button>
              <button type="button" onclick="get_rooms('Supper Simple Room')" class="btn btn-success shadow-none btn-sm text-light">
                Supper Simple Room
              </button>
            </div>
            <!-- room card -->
            <div class="row" id="room_card">             
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php require('inc/scripts.php'); ?>
  <script src="scripts/room_number.js"> </script>
</body>

</html>