<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyHotel - Home</title>
  <?php require('inc/links.php') ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
 <style>
  .availability-form{
    margin-top : -50px;
    z-index: 2;
    position: relative;
  }
  @media screen and (max-width: 575px){
    .availability-form{
      margin-top : 25px;
      padding: 0 35px;
    }
  }
 </style> 
</head>
<body class="bg-light">
  <?php require('inc/header.php') ?>
<!-- Băng truyền ảnh -->
  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="Images/locations/1.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="Images/locations/2.png" class="w-100 d-block" />
        </div>
        <div class="swiper-slide">
          <img src="Images/locations/3.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="Images/locations/4.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="Images/locations/5.png" class="w-100 d-block"/>
        </div>
        <div class="swiper-slide">
          <img src="Images/locations/6.png" class="w-100 d-block"/>
        </div>
      </div>
    </div>
  </div>
<!-- check availability form -->
  <div class="container availability-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <form>
          <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font: weight 500px;">Check-in</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font: weight 500px;">Check-out</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font: weight 500px;">Adult</label>
              <select class="form-select shadow-none">
                <option selected>0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
              </select>
            </div>
            <div class="col-lg-2 mb-3">
              <label class="form-label" style="font: weight 500px;">Children</label>
              <select class="form-select shadow-none">
                <option selected>0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
            <div class="col-lg-1 mb-lg-3 mt-2">
              <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Our Rooms  -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
  <div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="Images/rooms/rom1.jpg" class="card-img-top">
        <div class="card-body">
          <h5>Simple Room</h5>
          <h6 class="mb-4">2.000.000₫/Đêm</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              2 Phòng đơn
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Phòng tắm
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Phòng khách
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Facilities</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Wifi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Tivi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Phòng xông hơi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Điều hòa
            </span>
          </div>
          <div class="guests mb-4">
            <h6 class="mb-1">Guests</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              5 Adults
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              4 Children
            </span>
          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-half text-warning"></i>
            </span>
          </div>
          <div class="d-flex justify-content-evenly mb-2">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="Images/rooms/rom1.jpg" class="card-img-top">
        <div class="card-body">
          <h5>Simple Room</h5>
          <h6 class="mb-4">2.000.000₫/Đêm</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              2 Phòng đơn
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Phòng tắm
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Phòng khách
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Facilities</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Wifi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Tivi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Phòng xông hơi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Điều hòa
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Guests</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              5 Adults
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              4 Children
            </span>
          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-half text-warning"></i>
            </span>
          </div>
          <div class="d-flex justify-content-evenly mb-2">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="Images/rooms/rom1.jpg" class="card-img-top">
        <div class="card-body">
          <h5>Simple Room</h5>
          <h6 class="mb-4">2.000.000₫/Đêm</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              2 Phòng đơn
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Phòng tắm
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Phòng khách
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Facilities</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Wifi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Tivi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Phòng xông hơi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Điều hòa
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Guests</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              5 Adults
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              4 Children
            </span>
          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-half text-warning"></i>
            </span>
          </div>
          <div class="d-flex justify-content-evenly mb-2">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 text-center mt-5">
      <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More >>></a>
    </div>
  </div>
  </div>
  <!-- Our Facilities  -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR SERVICES</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5" >
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="Images/features/IMG_43553.svg" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="Images/features/IMG_41622.svg" width="80px">
        <h5 class="mt-3">Tivi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="Images/features/IMG_47816.svg" width="80px">
        <h5 class="mt-3">Massage</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="Images/features/IMG_49949.svg" width="80px">
        <h5 class="mt-3">Điều hòa</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="Images/features/gym.jpg" width="80px">
        <h5 class="mt-3">Gym</h5>
      </div>
      <div class="col-lg-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More >>></a>
      </div>
    </div>
  </div>
  <!-- Testimonials -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REVIEWS</h2>
  <div class="container mt-5">
    <div class="swiper swiper-testimonials">
      <div class="swiper-wrapper mb-5">

        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center p-4 mb-3">
            <img src="Images/about/MTP.jpg" width="30px">
            <h6 class="m-0 ms-2">Sơn Tùng MTP</h6>
          </div>
          <p> 
          Trải nghiệm ở khách sạn này thực sự ấn tượng! 
          Dịch vụ tận tâm, phòng nghỉ sang trọng và không gian thoải mái làm cho kỳ nghỉ của tôi trở thành một trải nghiệm đáng nhớ. 
          Tôi rất hài lòng và sẽ quay lại vào lần sau.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-half text-warning"></i>
          </div>
        </div>

        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center p-4 mb-3">
            <img src="Images/about/Messi.jpg" width="30px">
            <h6 class="m-0 ms-2">Lionel Messi</h6>
          </div>
          <p> 
            Khách sạn này cung cấp dịch vụ chất lượng cao với không gian thoải mái,
             nhân viên thân thiện và tiện nghi đầy đủ.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-half text-warning"></i>
          </div>
        </div>

        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center p-4 mb-3">
            <img src="Images/about/ronaldo.jpg" width="30px">
            <h6 class="m-0 ms-2">Cristiano Ronaldo</h6>
          </div>
          <p> 
          Khách sạn này nổi bật với dịch vụ chăm sóc khách hàng xuất sắc.
          Các tiện ích như nhà hàng, bể bơi và spa tạo ra một trải nghiệm lưu trú đáng nhớ và thoải mái
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-half text-warning"></i>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
  <!-- Contact us -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">CONTACT US</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
      <iframe class="w-100 rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119318.6948304854!2d107.06722728965441!3d20.84344559660025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a5796518cee87%3A0x55c6b0bcc85478db!2zVuG7i25oIEjhuqEgTG9uZw!5e0!3m2!1svi!2s!4v1712848384512!5m2!1svi!2s" 
        height="320px"loading="lazy"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 rounded mb-4">
          <h5>Call us</h5>
          <a href="tel: +84999888777" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i>
            +84999888777
          </a>
          <br>
          <a href="tel: +84333444555" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i>
            +84333444555
          </a>
        </div>
        <div class="bg-white p-4 rounded mb-4">
          <h5>Follow us</h5>
          <a href="#" class="d-inline-block mb-3">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-twitter-x me-1"></i>
              Twitter
            </span>
          </a>
          <br>
          <a href="#" class="d-inline-block mb-3">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-facebook me-1"></i>
            FaceBook
          </span>
          </a>
          <br>
          <a href="#" class="d-inline-block mb-3">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-instagram me-1"></i>
            Instagram
          </span>
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <?php require('inc/footer.php') ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper(".swiper-container", {
    spaceBetween: 30,
    effect: "fade",
    loop: true,
    autoplay:{
      delay:3000,
      disableOnInteraction:false,
    },
    speed: 1500
  });
  var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
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