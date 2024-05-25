<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

require("../inc/sendgrid/sendgrid-php.php");

date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_POST['check_availability'])) {
    $frm_data = filteration($_POST);
    $status = "";
    $result = "";

    $today_date = new DateTime(date("Y-m-d"));
    $checkin_date = new DateTime($frm_data['check_in']);
    $checkout_date = new DateTime($frm_data['check_out']);

    // Kiểm tra ngày nhận phòng và trả phòng
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

    // Nếu có lỗi về ngày, trả về kết quả ngay lập tức
    if ($status != '') {
        echo $result;
        exit;
    } else {
        session_start();

        // Truy vấn để kiểm tra phòng có sẵn hay không
        $tb_query = "SELECT COUNT(*) AS total_bookings FROM Booking_order
                  WHERE (booking_status = ? OR booking_status = ? OR booking_status = ?) 
                  AND room_id = ? AND check_out > ? AND check_in < ?";
        $values = ['booked', 'deposit', 'full payment', $_SESSION['room']['id'], $frm_data['check_in'], $frm_data['check_out']];
        $tb_result = select($tb_query, $values, 'sssiss');
        $tb_fetch = mysqli_fetch_assoc($tb_result);

        $rq_query = "SELECT quantity FROM rooms WHERE id = ?";
        $rq_result = select($rq_query, [$_SESSION['room']['id']], 'i');
        $rq_fetch = mysqli_fetch_assoc($rq_result);

        // Kiểm tra nếu không còn phòng trống
        if (($rq_fetch['quantity'] - $tb_fetch['total_bookings']) == 0) {
            $status = 'unavailable';
            $result = json_encode(['status' => $status]);
            echo $result;
            exit;
        }

        // Tính toán số ngày và thanh toán
        $count_days = $checkin_date->diff($checkout_date)->days;

        $prepayment = false;
        if ($frm_data['payment_option'] == 'prepay') {
            $payment = ($_SESSION['room']['price'] * $count_days) / 2;
            $prepayment = true;
        } else {
            $payment = $_SESSION['room']['price'] * $count_days;
        }
        $_SESSION['room']['payment'] = $payment;
        $_SESSION['room']['available'] = true;
        $_SESSION['room']['prepayment'] = $prepayment;

        $result = json_encode(["status" => 'available', "days" => $count_days, "payment" => $payment]);
        echo $result;
    }
}
