function filter_jornal(id_form) {
    form = document.getElementById(id_form);
    myData = new FormData(form);
    _token = document.getElementsByName('_token')[0];
    myData.append('_token', _token.value);
    var result = ajax_(myData, '/doc_manage/journal/select');
    document.getElementById("table").innerHTML = result;
    document.querySelectorAll('.table thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
}
