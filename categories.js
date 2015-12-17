var categories = document.getElementsByClassName("categorie-checkbox");

var form = document.getElementById("form-categories");

for(categorie in categories)
{
    categorie.addEventListener('change', function() {
        //TODO
        'use strict';
        alert('OK');
        form.submit();
    }, false);
}
