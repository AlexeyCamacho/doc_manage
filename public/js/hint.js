/*var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="modal"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { 
  return new bootstrap.Tooltip(tooltipTriggerEl)
})*/


function reload_hint(){
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { 
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
}