<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_bookings'])) {
  $frm_data = filteration($_POST);

  $query = "SELECT bo.*, bd.* FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
    AND ((bo.booking_status = ? AND bo.arrival = 0)
          OR(bo.booking_status = ? AND bo.arrival = 0))
    ORDER BY bo.booking_id ASC";

  $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%", "booked", "deposit"], 'sssss');
  $i = 1;
  $table_data = "";

  if (mysqli_num_rows($res) == 0) {
    echo "<b>No Data Found!</b>";
    exit;
  }

  while ($data = mysqli_fetch_assoc($res)) {
    $date = date("d-m-Y", strtotime($data['datetime']));
    $checkin = date("d-m-Y", strtotime($data['check_in']));
    $checkout = date("d-m-Y", strtotime($data['check_out']));

    $prepay = '';
    if ($data['booking_status'] == 'deposit') {
      $paid = number_format($data['prepay'], 0, '.', ',');
      $prepay = '(50% prepayment)';
    } else {
      $paid = number_format($data['total_pay'], 0, '.', ',');
    }


    if ($data['booking_status'] == 'booked') {
      $status_bg = 'bg-success';
    } else {
      $status_bg = 'bg-warning';
    }

    $table_data .= "
      <tr>
        <td>$i</td>
        <td>
          <span class='badge bg-primary'>
            Order ID: $data[order_id]
          </span>
          <br>
          <b>Name: </b> $data[user_name]
          <br>
          <b>Phone: </b> $data[phonenum]
        </td>
        <td>
          <b>Room:</b> $data[room_name]
          <br>
          <b>Price:</b> " . number_format($data['price'], 0, '.', ',') . "₫
          <br>
          <b>Room number:</b> $data[room_no]
        </td>
        <td>
          <b>Check in:</b> $checkin
          <br>
          <b>Check out:</b> $checkout
          <br>
          <b>Paid:</b> $paid ₫ $prepay
          <br>
          <b>Date:</b> $date
          <br>
        </td>
        <td>
          <p>
            <span class='badge $status_bg'>$data[booking_status]</span>
          </p>
        </td>
        <td>
          <button type='button' onclick='check_in($data[booking_id])' class='btn text-white btn-sm fw-bold custom-bg shadow-none'>
            <i class='bi bi-check2-square'></i> Check in
          </button>
          <br>
          <button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-outline-danger btn-sm fw-bold shadow-none mt-2'>
            <i class='bi bi-trash'></i> Cancel Booking
          </button>
        </td>
      </tr>
    ";
    $i++;
  }
  echo $table_data;
}

if (isset($_POST['check_in'])) {
  $frm_data = filteration($_POST);


  //get booking detail 
  $query0 = "SELECT bo.*, bd.* FROM `booking_order` bo
              INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
              WHERE bo.booking_id=?";
  $res0 = select($query0, [$frm_data['booking_id']], 'i');
  $data = mysqli_fetch_assoc($res0);

  //update status room number
  $query1 = "UPDATE `room_numbers`
            SET `room_status`='Checked In'
            WHERE `room_no`=?";
  update($query1, [$data['room_no']], 's');


  if ($data['booking_status'] == 'deposit') {
    $query = "UPDATE `booking_order`
            SET `arrival` = ?
            WHERE `booking_id` = ?";
    $value = [1, $frm_data['booking_id']];
    $res = update($query, $value, 'ii');
    echo $res;
  } else {
    $query = "UPDATE `booking_order`
    SET `arrival` = ?, `booking_status`= ?
    WHERE `booking_id` = ?";
    $value = [1, 'full payment', $frm_data['booking_id']];
    $res = update($query, $value, 'isi');
    echo $res;
  }
}

if (isset($_POST['cancel_booking'])) {
  $frm_data = filteration($_POST);

  //get booking detail 
  $query0 = "SELECT * FROM `booking_details`
            WHERE `booking_id` = ?";
  $res0 = select($query0, [$frm_data['booking_id']], 'i');
  $data = mysqli_fetch_assoc($res0);

  //lấy ra số phòng và trạng thái booking của phòng muốn cập nhật
  //nếu phòng vẫn đang có người đặt trước thì không đổi trạng thái phòng sang available khi cancel nữa 
  $query = "SELECT bo.booking_id FROM `booking_order` bo
  INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
  WHERE ((bo.booking_status ='deposit' AND bo.arrival = 0)
  OR(bo.booking_status = 'booked'))   
  AND bd.room_no = ? AND bo.booking_id != ?";

  $res1 = select($query, [$data['room_no'],$frm_data['booking_id']], 'si');

  if (mysqli_num_rows($res1) == 0) 
  { //nếu không tìm thấy đơn đặt phòng nào ở phòng này nữa thì chuyển sang available. Nếu còn thì vẫn để là Booked
    $query1 = "UPDATE `room_numbers`
                SET `room_status`='Available'
                WHERE `room_no`=?";
    update($query1, [$data['room_no']], 's');
  }

  //update status booking
  $query = "UPDATE `booking_order`
            SET `booking_status` = ?,`refund`=?
            WHERE `booking_id` = ?";
  $value = ['cancelled', 0, $frm_data['booking_id']];
  $res = update($query, $value, 'sii');

  echo $res;
}
