<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - Confirm Booking</title>
  <style>
    .carousel-item {
      transition: transform 1s ease, opacity .2s ease-out;
    }
  </style>
</head>

<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <?php

  /*
      Check room id from url is present or not
      Shutdown mode is active or not
      User is logged in or not
    */

  if (!isset($_GET['id']) || $settings_r['shutdown'] == true) {
    redirect('rooms.php');
  } else if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('rooms.php');
  }

  //filter and get room and user data

  $data = filteration($_GET);

  $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

  if (mysqli_num_rows($room_res) == 0) {
    redirect('rooms.php');
  }
  $room_data = mysqli_fetch_assoc($room_res);

  $_SESSION['room'] = [
    "id" => $room_data['id'],
    "name" => $room_data['name'],
    "price" => $room_data['price'],
    "payment" => null,
    "available" => false,
  ];

  $user_res = select("SELECT * FROM `user_cred`
           WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 'i');
  $user_data = mysqli_fetch_assoc($user_res)
  ?>

  <div class="container">
    <div class="row">
      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold">COMFIRM BOOKING</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>
        </div>
      </div>


      <div class="col-lg-7 col-md-12 px-4">
        <?php
        $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
        $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
                                    WHERE `room_id`='$room_data[id]'
                                    AND `thumb`= '1'");
        if (mysqli_num_rows($thumb_q) > 0) {
          $thumb_res = mysqli_fetch_assoc($thumb_q);
          $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
        }
        $price = number_format($room_data['price'], 0, '.', ',');
        echo <<<data
            <div class="card p-3 shadow-sm rounded">
              <img src="$room_thumb" class="img-fluid rounded mb-3">
              <h5>$room_data[name]</h5>
              <h6>$price ₫/Đêm</h6>
            </div>
          data;
        ?>
      </div>

      <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
          <div class="card-body">
            <form action="VnPay.php" method="POST" id="booking_form">
              <h6 class="mb-3">BOOKING DETAILS</h6>
              <div class="row">
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                  Note: Nếu bạn trả trước toàn bộ chi phí thì sẽ được ưu đãi hoàn trả toàn bộ tiền phòng nếu hủy booking trước ngày check-in.
                </span>
                <div class="col-md-6 fw-bold mb-3">
                  <label class="form-label">Full Name</label>
                  <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 fw-bold mb-3">
                  <label class="form-label">Phone Number</label>
                  <input name="phonenum" type="number" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 fw-bold mb-3">
                  <label class="form-label">CCCD</label>
                  <input type="number" value="<?php echo $user_data['cccd'] ?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-12 fw-bold mb-3">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $user_data['address'] ?></textarea>
                </div>
                <div class="col-md-6 fw-bold mb-3">
                  <label class="form-label">Check-in</label>
                  <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 fw-bold mb-4">
                  <label class="form-label">Check-out</label>
                  <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>
                <div class="col-12">
                  <label class="form-label fw-bold mt-2">Payment</label>
                  <div class='col-md-12 mb-3'>
                    <label>
                      <input type='radio' onchange="check_availability()" name='payment_option' value='prepay' class='form-check-input shadow-none' required> 50% Prepayment (Not refund)
                    </label>
                  </div>
                  <div class='col-md-12 mb-3'>
                    <label>
                      <input type='radio' onchange="check_availability()" name='payment_option' value='payfull' class='form-check-input shadow-none' required> Pay in Full
                    </label>
                  </div>
                  <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <h6 class="mb-3 text-danger" id="pay_info">Nhập ngày check-in và check-out !</h6>
                  <button name="pay_now" class="btn w-100 text-white custom-bg shadow-none mb-41 mt-3" disabled>Pay Now</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
  <?php require('inc/footer.php'); ?>

  <script>
    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');

    function check_availability() {
        let checkin_val = booking_form.elements['checkin'].value;
        let checkout_val = booking_form.elements['checkout'].value;
        let payment_option = booking_form.elements['payment_option'].value;

        booking_form.elements['pay_now'].setAttribute('disabled', true);

        if (checkin_val != '' && checkout_val != '' && payment_option != '') {
            pay_info.classList.add('d-none');
            info_loader.classList.remove('d-none');

            let data = new FormData();
            data.append('check_availability', '');
            data.append('check_in', checkin_val);
            data.append('check_out', checkout_val);
            data.append('payment_option', payment_option);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/confirm_booking.php", true);

            xhr.onload = function() {
                try {
                    let data = JSON.parse(this.responseText);

                    if (data.status == 'check_in_out_equal') {
                        pay_info.innerText = "Bạn không thể check-out cùng 1 ngày với check-in";
                        pay_info.classList.replace('text-info', 'text-danger');
                    } else if (data.status == 'check_out_earlier') {
                        pay_info.innerText = "Ngày check-out không thể trước ngày check-in";
                        pay_info.classList.replace('text-info', 'text-danger');
                    } else if (data.status == 'check_in_earlier') {
                        pay_info.innerText = "Ngày check-in phải là từ ngày hôm nay";
                        pay_info.classList.replace('text-info', 'text-danger');
                    } else if (data.status == 'unavailable') {
                        pay_info.innerText = "Phòng không có sẵn trong khoảng thời gian của bạn";
                        pay_info.classList.replace('text-info', 'text-danger');
                    } else if (data.status == 'available') {
                        let pay = data.payment.toLocaleString('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        });
                        pay_info.innerHTML = "Số ngày: " + data.days + "<br> Tổng tiền thanh toán: " + pay;
                        pay_info.classList.replace('text-danger', 'text-info');
                        booking_form.elements['pay_now'].removeAttribute('disabled');
                    } else {
                        pay_info.innerText = "Có lỗi xảy ra. Vui lòng thử lại.";
                        pay_info.classList.replace('text-info', 'text-danger');
                    }
                } catch (e) {
                    pay_info.innerText = "Lỗi khi phân tích phản hồi từ server: " + e.message;
                    pay_info.classList.replace('text-info', 'text-danger');
                }

                pay_info.classList.remove('d-none');
                info_loader.classList.add('d-none');
            };

            xhr.onerror = function() {
                pay_info.innerText = "Có lỗi xảy ra khi gửi yêu cầu. Vui lòng thử lại.";
                pay_info.classList.replace('text-info', 'text-danger');
                pay_info.classList.remove('d-none');
                info_loader.classList.add('d-none');
            };

            xhr.send(data);
        }
    }
</script>

</body>

</html>