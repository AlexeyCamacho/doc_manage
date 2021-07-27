// Замена стрелочек при разворачивании / сворачивании
var collapses = document.getElementsByClassName('collapse-main');
for (var i = collapses.length-1; i >= 0 ; i--) {

    collapses[i].addEventListener('hide.bs.collapse', function (event) { 
        var card = event.target.parentElement;
        var icon = card.getElementsByClassName('bi-chevron-up')[0];
        if(icon) { 
            if (icon.classList.contains('bi-chevron-up')) { icon.classList.remove('bi-chevron-up'); }
            icon.classList.add('bi-chevron-down');
        }
        var id = card.getAttribute('data-id');
        session_delete_array('openCategories', id);

    });

    collapses[i].addEventListener('show.bs.collapse', function (event) { 
        var card = event.target.parentElement;
        var icon = card.getElementsByClassName('bi-chevron-down')[0];
        if(icon) { 
            if (icon.classList.contains('bi-chevron-down')) { icon.classList.remove('bi-chevron-down'); }
            icon.classList.add('bi-chevron-up');
            
        }
        var id = card.getAttribute('data-id');
        session_set_array('openCategories', id);
    });

}

function show_collapse_by_card (card) {
    var collapse = card.getElementsByClassName('collapse')[0];
    if(!collapse.classList.contains('show')) {
       var bsCollapse = new bootstrap.Collapse(collapse, { 
            toggle: true
        }) 
    }
}

function view_block_add_category(id_category) {
    if (id_category != 0) {
        var card = document.getElementById('accordoinCard' + id_category);
        show_collapse_by_card(card);
    }
    var blod_add = document.getElementById('add-category' + id_category);
    if(blod_add.classList.contains('d-none')) { blod_add.classList.remove('d-none'); }
}   

