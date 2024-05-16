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

    $prepay='';
    if($data['booking_status']=='deposit'){
      $paid = number_format($data['prepay'], 0, '.', ',');
      $prepay ='(50% prepayment)';
    }else{
      $paid = number_format($data['total_pay'], 0, '.', ',');
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
          <button type='button' onclick='assign_room($data[booking_id])' class='btn text-white btn-sm fw-bold custom-bg shadow-none' data-bs-toggle='modal' data-bs-target='#assign-room'>
            <i class='bi bi-check2-square'></i> Assign Room
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

if (isset($_POST['assign_room'])) {
  $frm_data = filteration($_POST);


  // Truy vấn để lấy số lượng phòng hiện tại
  $query_check = "SELECT ro.* FROM `rooms` ro 
   INNER JOIN `booking_order` bo 
   ON ro.id = bo.room_id 
   WHERE bo.booking_id = ?";

  $res0 = select($query_check, [$frm_data['booking_id']], 'i');

  if (mysqli_num_rows($res0) > 0) {
    $row = mysqli_fetch_assoc($res0);
    if ($row['quantity'] > 0) {  //nếu số lượng phòng > 0 thì mới cho phép cấp phòng
      //update số lượng phòng
      $query1 = "UPDATE `rooms` ro 
                INNER JOIN `booking_order` bo 
                ON ro.id = bo.room_id 
                SET ro.quantity = ro.quantity - 1 
                WHERE bo.booking_id = ?";

      $res1 = update($query1, [$frm_data['booking_id']], 'i');

      //cấp phát số phòng
      $query = "UPDATE `booking_order` bo INNER JOIN `booking_details` bd
                ON bo.booking_id = bd.booking_id
                SET bo.arrival = ?, bd.room_no = ?
                WHERE bo.booking_id = ?";

      $res = update($query, [1, $frm_data['room_no'], $frm_data['booking_id']], 'isi');


      echo ($res == 2) ? 1 : 0;
    } else {
      echo 2; // In ra 2 nếu số lượng phòng bằng 0
    }
  } else {
    echo 3; //in ra 3 nếu không có dữ liệu
  }
}

if (isset($_POST['cancel_booking'])) {
  $frm_data = filteration($_POST);

  $query = "UPDATE `booking_order`
            SET `booking_status` = ?,`refund`=?
            WHERE `booking_id` = ?";
  $value = ['cancelled', 0, $frm_data['booking_id']];
  $res = update($query, $value, 'sii');

  echo $res;
}
