/*var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="modal"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { 
  return new bootstrap.Tooltip(tooltipTriggerEl)
})*/


function reload_hint(){
    myData = new FormData();
    _token = document.getElementsByName('_token')[0];
    myData.append('_token', _token.value);
    myData.append('setting', 'show_hints');
    var result = ajax_(myData, '/doc_manage/home/settings/get');
    if (result != 0) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-hint="true"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { 
          return new bootstrap.Tooltip(tooltipTriggerEl);
        })
    }
}