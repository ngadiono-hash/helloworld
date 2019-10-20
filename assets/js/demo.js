
function jawab() {
  alert("Hari ini, kami sangat bersemangat"); 
}






// ===================================================
changeAll();
function changeRed(value) {
  document.getElementById('valRed').innerHTML = value;
  changeAll();  
}
function changeGreen(value) {
  document.getElementById('valGreen').innerHTML = value;
  changeAll();
}
function changeBlue(value) {
  document.getElementById('valBlue').innerHTML = value;
  changeAll();
}
function changeAll() {
  var r = document.getElementById('valRed').innerHTML;
  var g = document.getElementById('valGreen').innerHTML;
  var b = document.getElementById('valBlue').innerHTML;
  document.getElementById('change').style.backgroundColor = "rgb(" + r + "," + g + "," + b + ")";
  document.getElementById('changetxt').innerHTML = "rgb(" + r + ", " + g + ", " + b + ")";
}