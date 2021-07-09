function display_block(display_class, hidden_class) {
    var list_class = document.getElementsByClassName(display_class);
    for (key in list_class) {
        key.classList.remove('invisible');
    }
}