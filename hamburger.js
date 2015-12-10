var button = document.getElementById("hamburgerButton");
var menu = document.getElementById("hamburgerMenu");

var open = false;

button.addEventListener('click', function () {
    'use strict';
    menu.style.left = (open) ? '-382px' : '0px';
    open = !open;
}, false);

var buttonEsir = document.getElementById("ancherESIR");
var buttonRennes = document.getElementById("ancherRennes");

var tab0 = document.getElementById("tab0");
var tab1 = document.getElementById("tab1");

buttonEsir.addEventListener('click', function () {
    'use strict';
    tab1.style.display = 'none';
    tab0.style.display = 'block';
}, false);

buttonRennes.addEventListener('click', function () {
    'use strict';
    tab0.style.display = 'none';
    tab1.style.display = 'block';
}, false);

tab1.style.display = 'none';
