const set = document.querySelector('#set');
const pit = document.querySelector('#pit');
const level = document.querySelector('#level');
const device = document.querySelector('#device');
const sbFiltersForm = document.querySelector('#sbFiltersForm');
const sbTbody = document.querySelector('#sbTbody');

function loadScores(setValue, pitValue, levelValue, deviceValue) {
  // AJAX Request
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "api/read-scores.php", true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      sbTbody.innerHTML = this.responseText;
    }
  };
  xhttp.send(`setValue=${setValue}&pitValue=${pitValue}&levelValue=${levelValue}&deviceValue=${deviceValue}`);
}

sbFiltersForm.addEventListener('submit', e => {
  e.preventDefault();
  loadScores(set.value, pit.value, level.value, device.value); // Invoking loadScores()
});

loadScores(set.value, pit.value, level.value, device.value); // Invoking loadScores() after page load
