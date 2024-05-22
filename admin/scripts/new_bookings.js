
function get_bookings(search = '') {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/new_bookings.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    document.getElementById('table-data').innerHTML = this.responseText;
  }
  xhr.send('get_bookings&search=' + search);
}


function check_in(id) {
  let data = new FormData();
    data.append('booking_id', id);
    data.append('check_in', '');
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/new_bookings.php", true);

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Checked In Success!');
      get_bookings();
    }
    else {
      alert('error', 'Server Down!');
    }
  }
  xhr.send(data);
}


function cancel_booking(id) {
  if (confirm("Bạn có chắc chắn muốn hủy đơn đặt phòng này chứ?")) {
    let data = new FormData();
    data.append('booking_id', id);
    data.append('cancel_booking', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/new_bookings.php", true);

    xhr.onload = function () {
      if (this.responseText == 1) {
        alert('success', 'Booking Canceled!');
        get_bookings();
      }
      else {
        alert('error', 'Booking cancel failed!');
      }
    }
    xhr.send(data);
  }
}

function search_user(username) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    document.getElementById('users-data').innerHTML = this.responseText;
  }

  xhr.send('search_user&name=' + username);
}

window.onload = function () {
  get_bookings();
}