
function get_bookings(search = '') {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/checked_in.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    let data = JSON.parse(this.responseText);
    document.getElementById('table-data').innerHTML = data.table_data;
  }
  xhr.send('get_bookings&search=' + search);
}

function check_out(id) {
  let data = new FormData();
  data.append('booking_id', id);
  data.append('check_out', '');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/checked_in.php", true);

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Checked Out Success!');
      get_bookings();
    }
    else {
      alert('error', 'Server Down!');
    }
  }
  xhr.send(data);
}
window.onload = function () {
  get_bookings();
}