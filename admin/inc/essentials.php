<?php
//frontend purpose data
define('SITE_URL', 'http://127.0.0.1:90/BookingHotel/');
define('ABOUT_IMG_PATH', SITE_URL . 'Images/about/');
define('CAROUSEL_IMG_PATH', SITE_URL . 'Images/carousel/');
define('FACILITIES_IMG_PATH', SITE_URL . 'Images/facilities/');
define('ROOMS_IMG_PATH', SITE_URL . 'Images/rooms/');
define('USERS_IMG_PATH', SITE_URL . 'Images/users/');

//backend upload purpose data
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/BookingHotel/Images/');
define('ABOUT_FOLDER', 'about/');
define('CAROUSEL_FOLDER', 'carousel/');
define('FACILITIES_FOLDER', 'facilities/');
define('ROOMS_FOLDER', 'rooms/');
define('USERS_FOLDER', 'users/');

$config = parse_ini_file('C:/xampp/htdocs/file.ini');

// Lấy giá trị của key 'api_key'
$SENDGRID_API_KEY = $config['api_key'];

define('SENDGRID_API_KEY',$SENDGRID_API_KEY);
define('SENDGRID_EMAIL',"truongphisky@gmail.com");
define('SENDGRID_NAME',"SkyHotel");


// trạng thái đặt phòng paid is full, deposit ,Pending 
function adminLogin()
{
  //session_name('admin_session');
  session_start();
  if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    echo "<script>
            window.location.href='index.php';
          </script>";
    exit;
  }
}
function redirect($url)
{
  echo "<script>
      window.location.href='$url';
    </script>";
  exit;
}
function alert($type, $msg)
{
  $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
  echo <<<alert
          <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
alert;
}
function uploadImage($image, $folder)
{
  $valid_mime = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
  $img_mime = $image['type'];

  if (!in_array($img_mime, $valid_mime)) {
    return 'inv_img'; //k đúng định dạng ảnh hoặc mime
  } else if (($image['size'] / (1024 * 1024)) > 2) {
    return 'inv_size'; //size lớn hơn 2mb
  } else {
    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";
    $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
    if (move_uploaded_file($image['tmp_name'], $img_path)) {
      return $rname;
    } else {
      return 'upd_failed';
    }
  }
}
function deleteImage($image, $folder)
{

  if (unlink(UPLOAD_IMAGE_PATH . $folder . $image)) {
    return true;
  } else {
    return false;
  }
}
function uploadSVGImage($image, $folder)
{
  $valid_mime = ['image/svg+xml'];
  $img_mime = $image['type'];

  if (!in_array($img_mime, $valid_mime)) {
    return 'inv_img'; //k đúng định dạng ảnh hoặc mime
  } else if (($image['size'] / (1024 * 1024)) > 1) {
    return 'inv_size'; //size lớn hơn 2mb
  } else {
    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";
    $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
    if (move_uploaded_file($image['tmp_name'], $img_path)) {
      return $rname;
    } else {
      return 'upd_failed';
    }
  }
}

function uploadUserImage($image)
{
  $valid_mime = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
  $img_mime = $image['type'];

  if (!in_array($img_mime, $valid_mime)) {
    return 'inv_img'; //k đúng định dạng ảnh hoặc mime
  } else {
    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $rname = 'IMG_' . random_int(11111, 99999) . ".jpeg";
    $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $rname;

    if ($ext == 'png' || $ext == 'PNG') {
      $img = imagecreatefrompng($image['tmp_name']);
    } else if ($ext == 'webp' || $ext == 'WEBP') {
      $img = imagecreatefromwebp($image['tmp_name']);
    } else {
      $img = imagecreatefromjpeg($image['tmp_name']);
    }

    if (imagejpeg($img, $img_path, 75)) {
      return $rname;
    } else {
      return 'upd_failed';
    }
  }
}
