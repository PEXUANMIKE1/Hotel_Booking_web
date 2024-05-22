<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_bookings'])) {
  $frm_data = filteration($_POST);

  $query = "SELECT bo.*, bd.* FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE ((bo.booking_status ='full payment' AND bo.arrival = 1) 
            OR(bo.booking_status ='deposit' AND bo.arrival = 1) )
    AND (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?) 
    ORDER BY bo.booking_id DESC";

  $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%"], 'sss');

  $total_rows = mysqli_num_rows($res);
  if ($total_rows == 0) {
    $output = json_encode(["table_data" => "<b>No Data Found!</b>"]);
    echo $output;
    exit;
  }

  $i = 1;
  $table_data = "";

  while ($data = mysqli_fetch_assoc($res)) {
    $date = date("d-m-Y", strtotime($data['datetime']));
    $checkin = date("d-m-Y", strtotime($data['check_in']));
    $checkout = date("d-m-Y", strtotime($data['check_out']));


    $bg = 'bg-info';
    $prepay = '';
    if ($data['booking_status'] == 'deposit') {
      $paid = number_format($data['prepay'], 0, '.', ',');
      $prepay = '(50% prepayment)';
      $bg = 'bg-warning text-dark';
    } else {
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
        </td>
        <td>
          <span class='badge $bg mt-3'>$data[booking_status]</span>
        </td>
        <td>
          <button type='button' onclick='check_out($data[booking_id])' class='btn custom-bg text-white btn-sm fw-bold shadow-none mt-2'>
          <i class='bi bi-check-circle'></i> Check Out
          </button>
        </td>
      </tr>
    ";
    $i++;
  }
  $output = json_encode(["table_data" => $table_data]);
  echo $output;
}


if (isset($_POST['check_out'])) {
  $frm_data = filteration($_POST);

  //get booking detail 
  $query0 = "SELECT * FROM `booking_details`
            WHERE `booking_id` = ?";
  $res0 = select($query0, [$frm_data['booking_id']], 'i');
  $data = mysqli_fetch_assoc($res0);

  //update status room number
  $query1 = "UPDATE `room_numbers`
            SET `room_status`='Available'
            WHERE `room_no`=?";
  update($query1, [$data['room_no']], 'i');

  //update status booking
  $today_date = new DateTime();
  $formatted_date = $today_date->format('Y-m-d H:i:s');
  $query = "UPDATE `booking_order`
            SET `booking_status` = ?,`check_out`=?
            WHERE `booking_id` = ?";
  $value = ['checked out', $formatted_date, $frm_data['booking_id']];
  $res = update($query, $value, 'ssi');

  echo $res;
}
