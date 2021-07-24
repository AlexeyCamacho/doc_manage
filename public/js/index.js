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
        var error_element = document.getElementById(field);
        error_element.classList.add('is-invalid');

        var error_element = 'error-' + field;
        var error_element = document.getElementById(error_element);
        error_element.innerText = '';

        errors_views = '';

        for (var i = errors[property].length-1; i >= 0 ; i--) {
            errors_views += errors[property][i] + '<br>';
        }

        error_element.innerHTML = errors_views;
    }
}

function rm_class(in_class, rm_class) {
    var list_class = document.getElementsByClassName(in_class);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].classList.remove(rm_class);
    }
}

function clear_class(class_) {
    var list_class = document.getElementsByClassName(class_);

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
    Input.value = recipient;
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
    myData = new FormData(form);

    var xhr = new XMLHttpRequest();

    //xhr.responseType =  "json";

    xhr.open('POST', url);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.send(myData);

    xhr.onreadystatechange = function() { // (3)
        if (xhr.readyState != 4) return;


        if (xhr.status != 200) {
            document.body.innerHTML = xhr.responseText;
        } else {
            if (redir == null) { location.reload(); }
            else { window.location.replace('https://do.ssau.ru/doc_manage/' + redir); }
        }
    }
}

function session_ajax(action, key, val = null, ajax = true, array = false) {
    var form = document.getElementById('ajax-form');
    myData = new FormData(form);

    myData.append('key', key);
    myData.append('val', val);
    if (array) { myData.append('array', true); }

    var xhr = new XMLHttpRequest();
    //xhr.responseType =  "json";

    xhr.open('POST', 'session/' + action, ajax);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.send(myData);

    xhr.onreadystatechange = function() { // (3)
        if (xhr.readyState != 4) return;

        if (xhr.status != 200) {
            console.log(xhr.responseText);
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

