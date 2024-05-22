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
  <title>Admin Panel - New bookings</title>
  <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">
  <?php require('inc/header.php'); ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">New Bookings</h3>
        <!-- features section-->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="text-end mb-4">
              <input type="text" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search...">
            </div>

            <div class="text-end mb-4">
              <button type="button" class="btn custom-bg shadow-none btn-sm text-light" data-bs-toggle="modal" data-bs-target="#add-booking">
                <i class="bi bi-plus-square"></i> Add
              </button>
            </div>

            <div class="table-responsive">
              <table class="table table-hover border" style="min-width: 1200px;">
                <thead>
                  <tr class="bg-info text-light">
                    <th scope="col">#</th>
                    <th scope="col">User Details</th>
                    <th scope="col">Room Details</th>
                    <th scope="col">Bookings Details</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="table-data">
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Assign Room Number modal -->

  

  <!-- Add booking form -->
  <div class="modal fade" id="add-booking" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="add_booking_form" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Booking</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
              Note: Thông tin phải trùng với thông tin định danh của bạn (CCCD, Hộ chiếu, Bằng lái xe, thẻ sinh viên, ...)
              điều đó sẽ được yêu cầu khi check-in.
            </span>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Full Name</label>
                  <input name="name" type="text" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Phone number</label>
                  <input name="phonenum" type="number" class="form-control shadow-none" required>
                </div>
                <div class="col-md-12 p-0 mb-3">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">CCCD</label>
                  <input name="cccd" type="number" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Date of birth</label>
                  <input name="dob" type="date" class="form-control shadow-none" required>
                </div>
                <label class="form-label fw-bold mt-2">Payment</label>
                <div class='col-md-3 mb-1'>
                  <label>
                    <input type='radio' name='payment_option' onchange="check_availability()" value='prepay' class='form-check-input shadow-none' required> 50% Prepayment
                  </label>
                </div>
                <div class='col-md-3 mb-1'>
                  <label>
                    <input type='radio' name='payment_option' onchange="check_availability()" value='payfull' class='form-check-input shadow-none' required> Pay in Full
                  </label>
                </div>
                <div class="col-12 mb-3 mt-5">
                  <label class="form-label fw-bold">Room</label>
                  <div class="row">
                    <?php
                    $res = selectAll('rooms');
                    while ($opt = mysqli_fetch_assoc($res)) {
                      echo "
                          <div class='col-md-3 mb-1'>
                              <label>
                                  <input type='radio' name='room'  onchange='check_availability()' value='$opt[id]' class='form-check-input shadow-none' required>
                                  $opt[name]
                              </label>
                          </div>
                      ";
                    }
                    ?>
                  </div>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Check-in</label>
                  <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 p-0 mb-4">
                  <label class="form-label">Check-out</label>
                  <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>
                <div class="col-12">
                  <h6 class="mb-3 text-danger" id="pay_info">Nhập ngày check-in và check-out !</h6>
                </div>
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

  <?php require('inc/scripts.php'); ?>
  <script src="scripts/new_bookings.js"> </script>

  <script>
    let add_booking_form = document.getElementById('add_booking_form');
    let pay_info = document.getElementById('pay_info');

    function check_availability() {
      let checkin_val = add_booking_form.elements['checkin'].value;
      let checkout_val = add_booking_form.elements['checkout'].value;
      let room_id = add_booking_form.elements['room'].value;
      let payment_option = add_booking_form.elements['payment_option'].value;

      if (checkin_val != '' && checkout_val != '') {
        pay_info.classList.add('d-none');
        pay_info.classList.replace('text-dark', 'text-danger');

        let data = new FormData();

        data.append('check_availability', '');
        data.append('check_in', checkin_val);
        data.append('check_out', checkout_val);
        data.append('room_id', room_id);
        data.append('payment_option', payment_option);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/add_new_booking.php", true);

        xhr.onload = function() {
          let data = JSON.parse(this.responseText);

          if (data.status == 'check_in_out_equal') {
            pay_info.innerText = "Bạn không thể check-out cùng 1 ngày với check-in";
          } else if (data.status == 'check_out_earlier') {
            pay_info.innerText = "Ngày check-out không thể trước ngày check-in";
          } else if (data.status == 'check_in_earlier') {
            pay_info.innerText = "Ngày check-in phải là từ ngày hôm nay";
          } else if (data.status == 'unavailable') {
            pay_info.innerText = "Phòng này không có sẵn";
          } else {
            var pay = data.payment.toLocaleString('vi-VN', {
              style: 'currency',
              currency: 'VND'
            });
            pay_info.innerHTML = "Số ngày: " + data.days + "<br> Tổng tiền thanh toán: " + pay;
            pay_info.classList.replace('text-danger', 'text-dark');
          }
          pay_info.classList.remove('d-none');
        }

        xhr.send(data);
      }
    }
    

  </script>
</body>

</html>