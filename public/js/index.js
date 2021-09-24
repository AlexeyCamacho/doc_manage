function display_block(display_class, hidden_class) {
    var list_class = document.getElementsByClassName(display_class);

    for (var i = list_class.length-1; i >= 0 ; i--) {

        if (list_class[i].nodeName == "FORM") {
            list_class[i].reset();
        }

        if(list_class[i].classList.contains('d-none')) { list_class[i].classList.remove('d-none'); }
        list_class[i].style.display = '';

    }

    var list_class = document.getElementsByClassName(hidden_class);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].style.display = 'none';
    }
}

function reset_form_by_id(form_id) {
    var form = document.getElementById(form_id);
    if (form.nodeName == "FORM") {
        form.reset();
    }
}

function reset_form_by_class(form_class) {
    var form = document.getElementsByClassName(form_class);
    for (var i = form.length-1; i >= 0 ; i--) {
        if (form[i].nodeName == "FORM") {
            form[i].reset();
        }
    }
    
}

function toggle_elem_by_id(id) {
    var elem = document.getElementById(id);
    if (elem.style.display == 'none' || elem.style.display == 'none!important') {
        if(elem.classList.contains('d-none')) { elem.classList.remove('d-none'); }
        elem.style.display = '';
    } else {
        elem.style.display = 'none';
    }
}

function show_elem_by_id(id) {
    var elem = document.getElementById(id);
    if(elem.classList.contains('d-none')) { elem.classList.remove('d-none'); }
    elem.style.display = '';
}

function show_elem_by_class(class_) {
    var list_class = document.getElementsByClassName(class_);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        if(list_class[i].classList.contains('d-none')) { list_class[i].classList.remove('d-none'); }
        list_class[i].style.display = '';
    }
}

function hide_elem_by_id(id) {
    var elem = document.getElementById(id);
    elem.style.display = 'none';
}

function hide_elem_by_class(class_) {
    var list_class = document.getElementsByClassName(class_);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].style.display = 'none';
    }
}

function focus_input_in_form(input_class, form_id) {
    var form = document.getElementById(form_id);
    var input = form.getElementsByClassName(input_class)[0];
    input.focus();
}

function ajax(form, url, action, redir = null) {
    var form = document.getElementById(form);
    myData = new FormData(form);

    var xhr = new XMLHttpRequest();

    xhr.responseType =  "json";

    xhr.open('POST', url);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.send(myData);

    xhr.onreadystatechange = function() { // (3)
        if (xhr.readyState != 4) return;


        if (xhr.status != 200) {
            print_errors(xhr.response['errors'], action);
            display_block('none', 'spinner-border');
        } else {
            if (redir == null) { location.reload(); }
            else { window.location.replace('https://do.ssau.ru/doc_manage/' + redir); }
        }
    }
}

function print_errors(errors, action) {
    for (var property in errors) {
        field = action + property;
        errors_views = '';

        for (var i = errors[property].length-1; i >= 0 ; i--) {
            errors_views += errors[property][i] + '<br>';
        }
        print_error(field, errors_views);
    }
}

function print_error(field, error){
    error_element = document.getElementById(field);
    error_element.classList.add('is-invalid');
    error_element = 'error-' + field;
    error_element = document.getElementById(error_element);
    if(error_element) {
        error_element.innerHTML = error;
    } 
}

function rm_class(in_class, rm_class, element = document) {
    var list_class = element.getElementsByClassName(in_class);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].classList.remove(rm_class);
    }
}

function clear_class(class_, element = document) {
    var list_class = element.getElementsByClassName(class_);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].innerText = '';
    }
}

function ajax_(data, url) {

    var xhr = new XMLHttpRequest();
    //xhr.responseType =  "json";
    xhr.open('POST', url, false);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.send(data);

    xhr.onreadystatechange = function() { // (3)
        if (xhr.readyState != 4) return;  
    }
    return xhr.response;
}

function block_unblock_user(id, token) {
    myData = new FormData;
    myData.append('id', id);
    myData.append('_token', token);
    var resp = ajax_(myData, 'users/blocked');
    if(resp == 200) { location.reload(); }
}

function set_value_modal(modal, button, atrib, id_input) {
    var recipient = button.getAttribute(atrib);
    var Input = modal.querySelector('#' + id_input);
    if(recipient) {
        Input.value = recipient;
    } else {
        Input.value = null;
    }
}

function set_value_input_modal(val, id_input) {
    var Input = document.querySelector('#' + id_input);
    if(val) {
        Input.value = val;
    } else {
        Input.value = null;
    }
}

function set_placeholder(button, atrib, id_input) {
    var recipient = button.getAttribute(atrib);
    var div = document.querySelector('#' + id_input);
    div.placeholder = recipient;
}

function set_value_div(button, atrib, id_input) {
    var recipient = button.getAttribute(atrib);
    var div = document.querySelector('#' + id_input);
    div.textContent = recipient;
}

function ajax_debug(form, url, action, redir = null) {
    var form = document.getElementById(form);
    form.method = 'POST';
    form.action = url;
    form.submit();
}

function session_ajax(action, key, val = null, ajax = true, array = false) {
    var form = document.getElementById('ajax-form');
    myData = new FormData(form);

    myData.append('key', key);
    myData.append('val', val);
    if (array) { myData.append('array', true); }

    var xhr = new XMLHttpRequest();
    //xhr.responseType =  "json";

    xhr.open('POST', '/doc_manage/session/' + action, ajax);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.send(myData);

    xhr.onreadystatechange = function() { // (3)
        if (xhr.readyState != 4) return;

        if (xhr.status != 200) {
            //console.log(xhr.responseText);
        } 
        //console.log(xhr.responseText);

    }
}

function session_set(key, val, ajax = true) {
    session_ajax("set", key, val, ajax);
}

function session_delete(key, val, ajax = true) {
    session_ajax("delete", key, val, ajax);
}

function session_set_array(key, val, ajax = true) {
    session_ajax("set", key, val, ajax, true);
}

function session_delete_array(key, val, ajax = true) {
    session_ajax("delete", key, val, ajax, true);
}

function session_reset(key, ajax = false) {
    session_ajax("reset", key, null, ajax);
}

function api_get(url, data) {
    var form = document.getElementById('ajax-form');
    myData = new FormData(form);
    myData.append('data', data);
    var xhr = new XMLHttpRequest();
    //xhr.responseType =  "json";
    xhr.open('POST', '/doc_manage' + url, false);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.send(myData);

    xhr.onreadystatechange = function() { // (3)
        if (xhr.readyState != 4) return;  
    }
    return xhr.response;
}

function checking_visibility(target) {
// Все позиции элемента
var targetPosition = {
    top: window.pageYOffset + target.getBoundingClientRect().top,
    left: window.pageXOffset + target.getBoundingClientRect().left,
    right: window.pageXOffset + target.getBoundingClientRect().right,
    bottom: window.pageYOffset + target.getBoundingClientRect().bottom
},
// Получаем позиции окна
windowPosition = {
    top: window.pageYOffset,
    left: window.pageXOffset,
    right: window.pageXOffset + document.documentElement.clientWidth,
    bottom: window.pageYOffset + document.documentElement.clientHeight
};

if (targetPosition.bottom > windowPosition.top && // Если позиция нижней части элемента больше позиции верхней чайти окна, то элемент виден сверху
targetPosition.top < windowPosition.bottom && // Если позиция верхней части элемента меньше позиции нижней чайти окна, то элемент виден снизу
targetPosition.right > windowPosition.left && // Если позиция правой стороны элемента больше позиции левой части окна, то элемент виден слева
targetPosition.left < windowPosition.right) { // Если позиция левой стороны элемента меньше позиции правой чайти окна, то элемент виден справа
// Если элемент полностью видно, то запускаем следующий код
    return true;
} else {
// Если элемент не видно, то запускаем этот код
    return false;
};
};

function checking_element_bottom(target) {

var targetPosition = {
    top: window.pageYOffset + target.getBoundingClientRect().top,
    left: window.pageXOffset + target.getBoundingClientRect().left,
    right: window.pageXOffset + target.getBoundingClientRect().right,
    bottom: window.pageYOffset + target.getBoundingClientRect().bottom
},

windowPosition = {
    top: window.pageYOffset,
    left: window.pageXOffset,
    right: window.pageXOffset + document.documentElement.clientWidth,
    bottom: window.pageYOffset + document.documentElement.clientHeight
};

if (targetPosition.bottom > windowPosition.top && 
targetPosition.top > windowPosition.bottom && 
targetPosition.top > windowPosition.top && 
targetPosition.bottom > windowPosition.bottom) { 

    return true;
} else {

    return false;
};
};
