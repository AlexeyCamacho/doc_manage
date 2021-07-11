function display_block(display_class, hidden_class) {
    var list_class = document.getElementsByClassName(display_class);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        if (list_class[i].nodeName == "FORM") {
            list_class[i].reset();
        }
        list_class[i].classList.remove('d-none');
    }

    var list_class = document.getElementsByClassName(hidden_class);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].classList.add('d-none');
    }

}

function ajax(form, url) {
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
            print_errors(xhr.response['errors']);
            hide_spinner();
        } else {
            location.reload();
        }
    }
}

function print_errors(errors) {
    for (var property in errors) {

        var error_element = document.getElementById(property);
        error_element.classList.add('is-invalid');

        var error_element = 'error-' + property
        var error_element = document.getElementById(error_element);
        error_element.innerText = '';

        errors_views = '';

        for (var i = errors[property].length-1; i >= 0 ; i--) {
            errors_views += errors[property][i] + '<br>';
        }

        error_element.innerHTML = errors_views;
    }
}

function rm_class(class_) {
    var list_class = document.getElementsByClassName(class_);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].classList.remove(class_);
    }
}

function clear_class(class_) {
    var list_class = document.getElementsByClassName(class_);

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].innerText = '';
    }
}

function show_spinner() {
    var list_class = document.getElementsByClassName('spinner-border');

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].style.display = '';
    }
}

function hide_spinner() {
    var list_class = document.getElementsByClassName('spinner-border');

    for (var i = list_class.length-1; i >= 0 ; i--) {
        list_class[i].style.display = 'none';
    }
}