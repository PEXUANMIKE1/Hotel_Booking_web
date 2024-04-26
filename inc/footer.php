<!-- Footer -->
<div class="container-fluid bg-white mt-5">
  <div class="row">
    <div class="col-lg-3 p-4">
      <h3 class="h-font fw-bold fs-3">SkyHotel</h3>
      <p>
        Khách sạn chúng tôi là điểm đến lý tưởng cho những ai tìm kiếm sự thoải mái và sang trọng. 
        Với dịch vụ chăm sóc khách hàng tận tâm, phòng nghỉ rộng rãi và tiện nghi đầy đủ, 
        các tiện ích như spa, phòng gym, nhà hàng và bể bơi sẽ khiến bạn cảm thấy tuyệt vời
        chúng tôi cam kết mang lại trải nghiệm lưu trú đáng nhớ nhất cho quý khách.
      </p>
    </div>
    <div class="col-lg-3 p-4">
      <h5 class="mb-3">Links</h5>
      <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
      <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
      <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
      <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
      <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
    </div>
    <div class="col-lg-3 p-4">
      <h5 class="mb-3">Follow us</h5>
      <a href="<?php echo $contact_r['tw']?>" class="d-inline-block mb-2 text-dark text-decoration-none">
        <i class="bi bi-twitter-x me-1"></i>Twitter</a><br>
      <a href="<?php echo $contact_r['fb']?>" class="d-inline-block mb-2 text-dark text-decoration-none">
        <i class="bi bi-facebook me-1"></i>Facebook</a><br>
      <a href="<?php echo $contact_r['insta']?>" class="d-inline-block mb-4 text-dark text-decoration-none">
        <i class="bi bi-instagram me-1"></i>Instagram</a><br>
      
      <div class="row">
      <h5 class="mb-3">Payment Partner</h5>
        <div class="col-md-3 mb-3">
          <img src="Images/Pay/mastercard.png" class="img-fluid" width="40px">
        </div>
        <div class="col-md-3 mb-3">
          <img src="Images/Pay/visa.png" class="img-fluid" width="40px">
        </div>
        <div class="col-md-3 mb-3">
          <img src="Images/Pay/momo.png" class="img-fluid" width="40px">
        </div>
        <div class="col-md-3 mb-3">
          <img src="Images/Pay/vnpay.png" class="img-fluid" width="40px">
        </div>
      </div>
    </div>
    <div class="col-lg-3 p-4">
      <h5 class="mb-3">Certified by</h5>
      <img src="Images/about/logo-dhcn.jpg" width="90px"><br>
    </div>
  </div>
</div>
<h6 class="text-center bg-dark text-white p-3 m-0">Developed by VuPhiTruong K15 HAUI</h6>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  function setActive()
  {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for(i=0;i<a_tags.length; i++){
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if(document.location.href.indexOf(file_name)>=0){
        a_tags[i].classList.add('active');
      }
    }
  }
  setActive()
</script>