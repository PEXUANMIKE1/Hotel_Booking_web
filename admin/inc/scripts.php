<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
  function alert(type, msg, position = 'body') {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
      <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;
    if (position == 'body') {
      document.body.append(element);
      element.classList.add('custom-alert');
    } else {
      document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 2000);
  }

  function remAlert() {
    document.getElementsByClassName('alert')[0].remove();

    document.body.append(element);
  }

  document.addEventListener("DOMContentLoaded", function() {
    var roomDropdown = document.getElementById('roomlinks');
    var bookingDropdown = document.getElementById('bookinglinks');

    var roomButton = document.querySelector('#dashboard-menu #roomlinks button');
    var bookingButton = document.querySelector('#dashboard-menu #bookinglinks button');

    roomButton.addEventListener('click', function() {
      if (roomDropdown.classList.contains('show')) {
        roomDropdown.classList.remove('show');
      } else {
        roomDropdown.classList.add('show');
        bookingDropdown.classList.remove('show'); // Đóng dropdown bookings khi mở dropdown rooms
      }
    });

    bookingButton.addEventListener('click', function() {
      if (bookingDropdown.classList.contains('show')) {
        bookingDropdown.classList.remove('show');
      } else {
        bookingDropdown.classList.add('show');
        roomDropdown.classList.remove('show'); // Đóng dropdown rooms khi mở dropdown bookings
      }
    });
  });

  function setActive() {
    let navbar = document.getElementById('dashboard-menu');
    let a_tags = navbar.getElementsByTagName('a');

    for (i = 0; i < a_tags.length; i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if (document.location.href.indexOf(file_name) >= 0) {
        a_tags[i].classList.add('bg-info');
        a_tags[i].classList.add('text-white'); // Thêm class 'text-white' để chuyển màu chữ thành trắng
      }
    }
  }
  setActive();
</script>