var categories = document.getElementsByClassName("categorie-checkbox");

var form = document.getElementById("form-categories");

for(var i = 0; i < categories.length; ++i)
{
    categories[i].addEventListener('change', function(event) {
        'use strict';
        var cat_id = event.target.id.replace('cat_','');

        var events = document.getElementsByClassName('event_in_cat_'+cat_id);

        for(var i = 0; i < events.length; ++i)
        {
            var evt = events[i];
            evt.className = evt.className.replace(' bad_cat','');
            if(event.target.checked == false)
                evt.className += ' bad_cat';
        }
    }, false);
}

document.getElementById('change').style.display = 'none';
