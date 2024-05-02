<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require("../inc/sendgrid/sendgrid-php.php");
function sendMail($uemail, $name, $token)
{
  $email = new \SendGrid\Mail\Mail();
  $email->setFrom("truongphisky@gmail.com", "SkyHotel");
  $email->setSubject("Account Verification Link");

  $email->addTo($uemail, $name);

  $email->addContent(
    "text/html",
    "Click the link to confirm your email:<br>
    <a href='".SITE_URL."email_confirm.php?email_confirmation&email=$uemail&token=$token"."'>
      CLICK ME
    </a>
    "
  );

  $sendgrid = new \SendGrid(SENDGRID_API_KEY);
  if ($sendgrid->send($email)) {
    return 1;
  } else {
    return 0;
  }
}

if (isset($_POST['register'])) {
  $data = filteration($_POST);

  //ktra xác nhận password

  if ($data['pass'] != $data['cpass']) {
    echo 'pass_mismatch';
    exit;
  }

  // check user exists or not
  $u_exist = select(
    "SELECT * FROM `user_cred` 
               WHERE `email`=? OR `phonenum`=? LIMIT 1",
    [$data['email'], $data['phonenum']],
    'ss'
  );
  if (mysqli_num_rows($u_exist) != 0) {
    $u_exist_fetch = mysqli_fetch_assoc($u_exist);
    echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
    exit;
  }

  //upload user image to server
  $img = uploadUserImage($_FILES['profile']);
  if ($img == 'inv_img') {
    echo 'inv_img';
    exit;
  } else if ($img == 'upd_failed') {
    echo 'upd_failed';
    exit;
  }

  //send confirmation link to user's email

  $token = bin2hex(random_bytes(16)); //tạo mã token random 16 ký tự

  if (!sendMail($data['email'], $data['name'], $token)) {
    echo 'mail_failed';
    exit;
  }

  $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT); //Mã hóa mật khẩu bằng hàm bằm-hash

  $query = "INSERT INTO `user_cred`
    (`name`, `email`, `address`, `phonenum`, `cccd`, `dob`, `profile`, `password`, `token`) 
    VALUES (?,?,?,?,?,?,?,?,?)";

  $value = [
    $data['name'], $data['email'], $data['address'], $data['phonenum'],
    $data['cccd'], $data['dob'], $img, $enc_pass, $token
  ];

  if (insert($query, $value, 'sssssssss')) {
    echo 1;
  } else {
    echo 'ins_failed';
  }
}
