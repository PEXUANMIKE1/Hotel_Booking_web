<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyHotel - About</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <?php require('inc/links.php'); ?>
  <style>
    .box{
      border-top-color: var(--teal) !important;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
    Cơ sở vật chất của chúng tôi cung cấp sự tiện nghi hiện đại và không gian tự nhiên,
    <br> mang lại cho khách hàng trải nghiệm hoàn hảo với thiên nhiên.
    </p>
  </div>
  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
        <h3 class="mb-3">Lorem ipsum dolor sit</h3>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
          Necessitatibus laboriosam ipsam fugit quae, 
          maiores natus eum unde architecto accusantium impedit at 
          sit distinctio illo animi error accusamus quasi nesciunt deserunt!
        </p>
      </div>
      <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
        <img src="Images/about/about.jpg" class="w-100">
      </div>
    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="Images/about/hotel.svg" width="70px">
          <h4 class="mt-3">100+ ROOMS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="Images/about/customers.svg" width="70px">
          <h4 class="mt-3">200+ CUSTOMERS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="Images/about/rating.svg" width="70px">
          <h4 class="mt-3">150+ REVIEWS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="Images/about/staff.svg" width="70px">
          <h4 class="mt-3">200+ STAFFS</h4>
        </div>
      </div>
    </div>
  </div>

  <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>

  <div class="container px-4">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper mb-5">
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="Images/about/ronaldo.jpg" class="w-100" height="550px">
          <h5 class="mt-2">Cristiano Ronaldo</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="Images/about/micaljackson.jpg" class="w-100" height="550px">
          <h5 class="mt-2">Michael Jackson</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="Images/about/Messi.jpg" class="w-100" height="550px">
          <h5 class="mt-2">Lionel Messi</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="Images/about/IMG_17352.jpg" class="w-100" height="550px">
          <h5 class="mt-2">Jame Lake</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="Images/about/ronaldo.jpg" class="w-100" height="550px">
          <h5 class="mt-2">Cristiano Ronaldo</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="Images/about/micaljackson.jpg" class="w-100" height="550px">
          <h5 class="mt-2">Michael Jackson</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="Images/about/Messi.jpg" class="w-100" height="550px">
          <h5 class="mt-2">Lionel Messi</h5>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView:4,
      spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320:{
          slidesPerView: 1,
        },
        640:{
          slidesPerView: 1,
        },
        768:{
          slidesPerView: 2,
        },
        1024:{
          slidesPerView: 3,
        },
      }
    });
  </script>
</body>
</html>