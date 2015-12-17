var categories = document.getElementsByClassName("categorie-checkbox");

var form = document.getElementById("form-categories");

for(var i = 0; i < categories.length; ++i)
{
    categories[i].addEventListener('change', function() {
        'use strict';
        form.submit();
    }, false);
}

document.getElementById('change').style.display = 'none';
