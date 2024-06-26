<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
require('inc/VnPay/config.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

session_start();
unset($_SESSION['room']);

function regenrate_session($uid)
{
  $user_q = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$uid], 'i');
  $user_fetch = mysqli_fetch_assoc($user_q);
  $_SESSION['login'] = true;
  $_SESSION['uId'] = $user_fetch['id'];
  $_SESSION['uName'] = $user_fetch['name'];
  $_SESSION['uPic'] = $user_fetch['profile'];
  $_SESSION['uPhone'] = $user_fetch['phonenum'];
}

$vnp_SecureHash = $_GET['vnp_SecureHash']; //lấy ra chữ ký từ vnpay
$inputData = array();
foreach ($_GET as $key => $value) {
  if (substr($key, 0, 4) == "vnp_") {
    $inputData[$key] = $value;
  }
}

unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
  if ($i == 1) {
    $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
  } else {
    $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
    $i = 1;
  }
}
$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret); //mã hóa chữ ký response

$slct_query = "SELECT `booking_id`, `user_id`,`room_id` FROM `booking_order`
                  WHERE `order_id` = '$_GET[vnp_TxnRef]'";
$slct_res = mysqli_query($con, $slct_query);

if (mysqli_num_rows($slct_res) == 0) {
  redirect('index.php');
}

$slct_fetch = mysqli_fetch_assoc($slct_res);

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
  regenrate_session($slct_fetch['user_id']);
}

if ($secureHash == $vnp_SecureHash) //so sánh 2 chữ ký giao dịch
{
  $total = $_GET['vnp_Amount'] / 100;
  if ($_GET['vnp_ResponseCode'] == '00') {

    //get room number available
    $query1 = "SELECT * FROM `room_numbers`
                WHERE `type_id`='$slct_fetch[room_id]' AND (`room_status`='Available' OR `room_status`='Booked' OR `room_status`='Checked In')
                ORDER BY `room_status` ASC LIMIT 1";
    $res =  mysqli_query($con, $query1);
    $dataRoom = mysqli_fetch_assoc($res);

    //update room_status when booked 
    if ($dataRoom['room_status'] == 'Available') {
      $query3 = "UPDATE `room_numbers` 
              SET `room_status`='Booked'
              WHERE `id`=$dataRoom[id]";
      //update($query3, [$dataRoom['id']], 'i');
      mysqli_query($con, $query3);
    }
    if ($_GET['vnp_OrderInfo'] == 'Coc 50% tien phong') {
      //update transaction booking
      $upd_query = "UPDATE `booking_order` 
                  SET `booking_status`='deposit',
                  `trans_id`='$_GET[vnp_TransactionNo]',`trans_amt`='$total',
                  `trans_status`='$_GET[vnp_ResponseCode]',`trans_resp_msg`='$_GET[vnp_OrderInfo] thanh cong' 
                  WHERE `booking_id`='$slct_fetch[booking_id]'";
      //update room_no and prepay
      $query2 = "UPDATE `booking_details` 
                SET `room_no`='$dataRoom[room_no]',
                    `prepay`='$total'
                WHERE `booking_id`='$slct_fetch[booking_id]'";
      mysqli_query($con, $query2);
    } 
    else 
    {
      //update transaction booking
      $upd_query = "UPDATE `booking_order` 
                  SET `booking_status`='booked',
                      `trans_id`='$_GET[vnp_TransactionNo]',`trans_amt`='$total',
                      `trans_status`='$_GET[vnp_ResponseCode]',`trans_resp_msg`='$_GET[vnp_OrderInfo] thanh cong' 
                  WHERE `booking_id`='$slct_fetch[booking_id]'";
      //update room_no
      $query2 = "UPDATE `booking_details` SET `room_no`='$dataRoom[room_no]'
                WHERE `booking_id`='$slct_fetch[booking_id]'";
      mysqli_query($con, $query2);
    }
    mysqli_query($con, $upd_query);
  } else {
    $upd_query = "UPDATE `booking_order` 
        SET `booking_status`='payment failed',
        `trans_id`='$_GET[vnp_TransactionNo]',`trans_amt`='$total',
        `trans_status`='$_GET[vnp_ResponseCode]',`trans_resp_msg`='$_GET[vnp_OrderInfo] khong thanh cong'
        WHERE `booking_id`='$slct_fetch[booking_id]'";

    mysqli_query($con, $upd_query);
  }
  redirect('pay_status.php?order=' . $_GET['vnp_TxnRef']);
  echo $msg_pay;
} else {
  redirect('index.php');
}
