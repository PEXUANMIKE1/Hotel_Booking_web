<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_POST['check_availability'])) {
  $frm_data = filteration($_POST);
  $status = "";
  $result = "";


  $today_date = new DateTime(date("Y-m-d"));
  $checkin_date = new DateTime($frm_data['check_in']);
  $checkout_date = new DateTime($frm_data['check_out']);

  if ($checkin_date == $checkout_date) {
    $status = 'check_in_out_equal';
    $result = json_encode(["status" => $status]);
  } else if ($checkin_date > $checkout_date) {
    $status = 'check_out_earlier';
    $result = json_encode(["status" => $status]);
  } else if ($checkin_date < $today_date) {
    $status = 'check_in_earlier';
    $result = json_encode(["status" => $status]);
  }

  //kiểm tra tình trạng phòng nếu trạng thái trống return error
  if ($status != '') {
    echo $result;
  } else {
    $res1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['room_id']], 'i');
    $roomdata = mysqli_fetch_assoc($res1);

    $count_days = date_diff($checkin_date, $checkout_date)->days;
    if ($frm_data['payment_option'] == 'prepay') {
      $payment = ($roomdata['price'] * $count_days)/2;
    } else {
      $payment = $roomdata['price'] * $count_days;
    }
    if($roomdata['status'] == 0 || $roomdata['quantity'] == 0){
      $status = "unavailable";
    }

    $result = json_encode(["status" => $status, "days" => $count_days, "payment" => $payment]);
    echo $result;
  }
}

if (isset($_POST['add_room'])) {
  $features = filteration(json_decode($_POST['features']));
  $facilities = filteration(json_decode($_POST['facilities']));
  $frm_data = filteration($_POST);
  $flag = 0;

  $q1 = "INSERT INTO `rooms`( `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`)VALUES (?,?,?,?,?,?,?)";
  $values = [$frm_data['name'], $frm_data['area'], $frm_data['price'], $frm_data['quantity'], $frm_data['adult'], $frm_data['children'], $frm_data['desc']];

  if (insert($q1, $values, 'siiiiis')) {
    $flag = 1;
  }

  $room_id = mysqli_insert_id($con);
  $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";

  if ($stmt = mysqli_prepare($con, $q2)) {
    foreach ($facilities as $f) {
      mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
      mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
  } else {
    $flag = 0;
    die('query cannot be prepared - insert');
  }

  $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";

  if ($stmt = mysqli_prepare($con, $q3)) {
    foreach ($features as $f) {
      mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
      mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
  } else {
    $flag = 0;
    die('query cannot be prepared - insert');
  }

  if ($flag) {
    echo 1;
  } else {
    echo 0;
  }
}
