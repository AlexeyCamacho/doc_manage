//Изменение настройки пользователя
function changeSetting(setting, user_id){
	myData = new FormData();
	_token = document.getElementsByName('_token')[0];
	myData.append('setting', setting);
	myData.append('_token', _token.value);
	myData.append('user_id', user_id);

  	var xhr = new XMLHttpRequest();
    xhr.responseType =  "json";
    xhr.open('POST', 'settings/change');
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.send(myData);

    xhr.onreadystatechange = function() { // (3)
        if (xhr.readyState != 4) return;
    }
}