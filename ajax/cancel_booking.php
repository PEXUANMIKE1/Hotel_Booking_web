<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
  redirect('index.php');
}

if (isset($_POST['cancel_booking'])) {
  $frm_data = filteration($_POST);

  //get booking detail 
  $query0 = "SELECT * FROM `booking_details`
            WHERE `booking_id` = ?";
  $res0 = select($query0, [$frm_data['id']], 'i');
  $data = mysqli_fetch_assoc($res0);
  
  //lấy ra số phòng và trạng thái booking của phòng muốn cập nhật
  //nếu phòng vẫn đang có người đặt trước thì không đổi trạng thái phòng sang available khi cancel nữa 
  $query = "SELECT bo.booking_id FROM `booking_order` bo
  INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
  WHERE ((bo.booking_status ='deposit' AND bo.arrival = 0)
  OR(bo.booking_status = 'booked'))   
  AND bd.room_no = ? AND bo.booking_id != ?";

  $res1 = select($query, [$data['room_no'],$frm_data['id']], 'si');

  if (mysqli_num_rows($res1) == 0) 
  { //nếu không tìm thấy đơn đặt phòng nào ở phòng này nữa thì chuyển sang available. Nếu còn thì vẫn để là Booked
    $query1 = "UPDATE `room_numbers`
                SET `room_status`='Available'
                WHERE `room_no`=?";
    update($query1, [$data['room_no']], 's');
  }

  //update status room number
  $query1 = "UPDATE `room_numbers`
            SET `room_status`='Available'
            WHERE `room_no`=?";
  update($query1, [$data['room_no']], 's');

  //update status booking
  $query = "UPDATE `booking_order` 
            SET `booking_status` = ?, `refund`=?
            WHERE`booking_id`=? AND `user_id`=?";

  $values = ['cancelled', 0, $frm_data['id'], $_SESSION['uId']];
  $result = update($query, $values, 'siii');


  echo $result;
}
