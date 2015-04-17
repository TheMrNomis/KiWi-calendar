var button = document.getElementById("hamburgerButton");
var menu = document.getElementById("hamburgerMenu");

var open = false;

button.addEventListener('click', function(){
  menu.style.left = (open)? '-382px' : '0px';
  open = !open;
}, false);
