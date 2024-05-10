<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_bookings'])) {
  $frm_data = filteration($_POST);

  $query = "SELECT bo.*, bd.* FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
    AND (bo.booking_status = ? AND bo.refund = ?) ORDER BY bo.booking_id ASC";

  $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%", "cancelled", 0], 'sssss');
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
          <b>Check in:</b> $checkin
          <br>
          <b>Check out:</b> $checkout
          <br>
          <b>Date:</b> $date
          <br>
        </td>
        <td>
          <b>Paid:</b> " . number_format($data['trans_amt'], 0, '.', ',') . "₫
        </td>
        <td>
          <button type='button' onclick='refund_booking($data[booking_id])' class='btn btn-success btn-sm fw-bold shadow-none mt-2'>
            <i class='bi bi-cash-stack'></i> Refund
          </button>
        </td>
      </tr>
    ";
    $i++;
  }
  echo $table_data;
}

if (isset($_POST['refund_booking'])) {
  $frm_data = filteration($_POST);

  $query = "UPDATE `booking_order` SET `refund`=? WHERE `booking_id` = ?";
  $value = [1, $frm_data['booking_id']];
  $res = update($query, $value, 'ii');

  echo $res;
}
