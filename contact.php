<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyHotel - Contact</title>
  <?php require('inc/link.php'); ?>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">CONTACT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
    Cơ sở vật chất của chúng tôi cung cấp sự tiện nghi hiện đại và không gian tự nhiên,
    <br> mang lại cho khách hàng trải nghiệm hoàn hảo với thiên nhiên.
    </p>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4">
          <iframe class="w-100 rounded mb-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119318.6948304854!2d107.06722728965441!3d20.84344559660025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a5796518cee87%3A0x55c6b0bcc85478db!2zVuG7i25oIEjhuqEgTG9uZw!5e0!3m2!1svi!2s!4v1712848384512!5m2!1svi!2s" 
          height="320px"loading="lazy"></iframe>
          <h5>Address</h5>
          <a href="https://maps.app.goo.gl/CMGbcWbhFRTpr6yb9" target="_blank" class="d-inline-block text-decoration-none text-dark">
          <i class="bi bi-geo-alt-fill"></i> Thành phố Hạ Long, Quảng Ninh, Việt Nam
          </a>
          <h5 class="mt-4">Call us</h5>
          <a href="tel: +84999888777" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i>
            +84999888777
          </a>
          <br>
          <a href="tel: +84333444555" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i>
            +84333444555
          </a>
          <h5 class="mt-4">Email</h5>
          <a href="mailto: pexuanmike@gmail.com" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-envelope-fill"></i>  pexuanmike@gmail.com
          </a>
          <h5 class="mt-4">Follow us</h5>
          <a href="#" class="d-inline-block mb-3 text-dark fs-5 me-2">
              <i class="bi bi-twitter-x me-1"></i>
          </a>
          <a href="#" class="d-inline-block mb-3 text-dark fs-5 me-2">
            <i class="bi bi-facebook me-1"></i>
          </a>
          <a href="#" class="d-inline-block mb-3 text-dark fs-5">
            <i class="bi bi-instagram me-1"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 px-4">
        <div class="bg-white rounded shadow p-4">
          <form>
            <h5>Send a message</h5>
            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Name</label>
                <input type="text" class="form-control shadow-none">
            </div>
            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Email</label>
                <input type="email" class="form-control shadow-none">
            </div>
            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Subject</label>
                <input type="text" class="form-control shadow-none">
            </div>
            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Message</label>
                <textarea class="form-control shadow-none" rows="5" style="resize:none;"></textarea>
            </div>
            <button type="submit" class="btn text-white custom-bg mt-3">SEND</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <?php require('inc/footer.php'); ?>

</body>
</html>