function edita_texto(elemento_id, texto){
	document.getElementById(elemento_id).innerHTML = texto;
}
function display_edit(elemento_id, display){
	var idd = document.getElementById(elemento_id);
	idd.style.display = display;
}
function limiteCaract(string = "", total){
	string.value = string.value.substring(0,total);
}
function is_url(str){
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	//Retorna true en caso de que la url sea valida o false en caso contrario
	return regexp.test(str);
}