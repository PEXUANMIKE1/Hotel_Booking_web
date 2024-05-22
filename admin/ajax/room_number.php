<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_rooms'])) {
  $frm_data = filteration($_POST);

  $query = "SELECT * FROM `room_numbers` rn
  INNER JOIN `rooms` r ON r.id = rn.type_id
  WHERE r.name LIKE ?
  ORDER BY rn.id ASC";

  $res = select($query, ["%$frm_data[btn]%"], 's');

  $card_data = "";

  while ($data = mysqli_fetch_assoc($res)) {
    if ($data['room_status'] == 'Available') {
      $status_btn = 'btn-info text-white';
    } else if ($data['room_status'] == 'Checked In') {
      $status_btn = 'btn-secondary';
    } else if ($data['room_status'] == 'Dirty') {
      $status_btn = 'btn-warning';
    } else if ($data['room_status'] == 'Booked') {
      $status_btn = 'btn-success';
    } else {
      $status_btn = 'btn-Danger';
    }

    $card_data .= "
      <div class='card col-md-2 shadow-sm mb-4 mx-3'>
        <div class='card-header'>
          <b>$data[name]</b>
        </div>
        <div class='card-body'>
          <h2 class='card-title'>$data[room_no]</h2>
          <input type='button' class='btn $status_btn' value='$data[room_status]'>
        </div>
      </div>
    ";
  }
  echo $card_data;
}

if (isset($_POST['get_all_rooms'])) {
  $frm_data = filteration($_POST);

  $query = "SELECT * FROM `room_numbers` rn
  INNER JOIN `rooms` r ON r.id = rn.type_id
  ORDER BY rn.id ASC";

  $res = selectN($query);

  $card_data = "";

  while ($data = mysqli_fetch_assoc($res)) {
    if ($data['room_status'] == 'Available') {
      $status_btn = 'btn-info text-white';
    } else if ($data['room_status'] == 'Checked In') {
      $status_btn = 'btn-secondary';
    } else if ($data['room_status'] == 'Dirty') {
      $status_btn = 'btn-warning';
    } else if ($data['room_status'] == 'Booked') {
      $status_btn = 'btn-success';
    } else {
      $status_btn = 'btn-Danger';
    }

    $card_data .= "
      <div class='card col-md-2 shadow-sm mb-4 mx-3'>
        <div class='card-header'>
          <b>$data[name]</b>
        </div>
        <div class='card-body'>
          <h2 class='card-title'>$data[room_no]</h2>
          <input type='button' class='btn $status_btn' value='$data[room_status]'>
        </div>
      </div>
    ";
  }
  echo $card_data;
}
