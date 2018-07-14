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