function get_rooms(btn = '') {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_number.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    document.getElementById('room_card').innerHTML = this.responseText;
  }
  xhr.send('get_rooms&btn=' + btn);
}
function get_all_rooms() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_number.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    document.getElementById('room_card').innerHTML = this.responseText;
  }
  xhr.send('get_all_rooms');
}

window.onload = function () {
  get_all_rooms();
}