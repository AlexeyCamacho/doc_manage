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
        if (close_child_tabs) {
            close_all_collapse(id); 
        }
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

function hide_collapse_by_card (card) {
    var collapse = card.getElementsByClassName('collapse')[0];
    if(collapse.classList.contains('show')) {
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
    hide_elem_by_class('accordion-add-category');
    reset_form_by_class('add-category');
    show_elem_by_id('add-category' + id_category);
    focus_input_in_form('create-name', 'form-add-category' + id_category);
}  

function disabled_children_categories(select_id, category) {
    var childrenCategories = api_get('/categories/get_children' ,category);
    childrenCategories = JSON.parse(childrenCategories);
    childrenCategories.push(parseInt(category));
    var select = document.getElementById(select_id);
    for (var i = 0; i < select.children.length; i++) {
        if(childrenCategories.indexOf(parseInt(select.children[i].value)) != -1){
            select.children[i].disabled = true;
        }
    }

}

function enabled_add_children_categories(select_id) {
    var select = document.getElementById(select_id);
    for (var i = 0; i < select.children.length; i++) {
        select.children[i].disabled = false;
    }
}

function disabled_category(select_id, category) {
    var select = document.getElementById(select_id);
    for (var i = 0; i < select.children.length; i++) {
        if(select.children[i].value == category){
            select.children[i].disabled = true;
            break;
        }
    }

}

function hide_category(id_category) {
    api_get('/categories/hide' ,id_category);
}

function view_category(id_category) {
    api_get('/categories/show' ,id_category);
}

function close_all_collapse(id) {
    var collapse = document.getElementById("collapse" + id);
    var childrenCollapseList = collapse.getElementsByClassName("collapse");
    for (var i = 0; i < childrenCollapseList.length; i++) {
        if(childrenCollapseList[i].classList.contains('show')) {
            var bsCollapse = new bootstrap.Collapse(childrenCollapseList[i], { 
                toggle: true
            }) 
        } 
    }
}

function select_documents(id_category) {
    console.log(id_category);
    myData = new FormData();
    _token = document.getElementsByName('_token')[0];
    myData.append('_token', _token.value);
    myData.append('id_category', id_category);
    var result = ajax_(myData, '/doc_manage/documents/select');
    document.getElementById("documents").innerHTML = result;
}

function choice_cart(id_category) {
    rm_class('bg-choose', 'bg-choose');
    var card_header = document.getElementById('heading' + id_category);
    card_header.classList.add('bg-choose');
    session_set('select_category', id_category);
}
