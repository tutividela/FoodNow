/*--------------------------RegExp-------------------------------------*/
var RE_EMAIL=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
/*-------------------------Fin de RegExp-------------------------------*/

/*-----------------------Declaracion de Variables Globales-------------*/
var errorEnMail=true;
var errorEnUsuario=true;
var errorEnPass=true;
var errorEnUsuarioLogin=true;
var errorEnPassLogin=true;
/*------------------Fin de Declaracion de variables globales-----------*/

/*-------------------------Funciones-----------------------------------*/
function activarLogin(){
	var x=document.getElementById("formLogin");
	var y=document.getElementById("formRegis");
	if(x.style.display == 'none'){
		x.style.display = 'inline';
		y.style.display = 'none';
	}
	else{
		x.style.display='none';
	}
}
function activarRegis(){
	var x=document.getElementById("formLogin");
	var y=document.getElementById("formRegis");
	if(y.style.display == 'none'){
		y.style.display = 'inline';
		x.style.display = 'none';
	}
	else{
		y.style.display='none';
	}
}
function validarEmail(contenido){
	if(!esMail(contenido.value) || contenido.value==""){
		contenido.style.border = "3px solid red";
		errorEnMail=true;
	}
	else{
		contenido.style.border="2px solid grey";
		errorEnMail=false;
	}
}
function validarUsuario(contenido){ 
	if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
	xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("pruebaAJAX").innerHTML = this.responseText;
            if(document.getElementById("pruebaAJAX").innerHTML =="true" || contenido.value=="" || contenido.value.length>20){
				contenido.style.border = "3px solid red";
				errorEnUsuario=true;
            }
			else{
				contenido.style.border="3px solid grey";
				errorEnUsuario=false;
			}
        }
    };
	xmlhttp.open("GET","esUser.php?q="+contenido.value,true);
	xmlhttp.send(null);
}
function validarPass(){
	var contenido=document.getElementById("pass");
	var confirma=document.getElementById("passConfirma");
	if(!coincidePass(contenido.value,confirma) || contenido.value=="" || contenido.value.length>15){
		contenido.style.border = "3px solid red";
		confirma.style.border = "3px solid red";
		errorEnPass=true;
	}
	else{
		contenido.style.border="2px solid grey";
		confirma.style.border="2px solid grey";
		errorEnPass=false;
	}
}
function validarUsuarioLogin(contenido){
	if(contenido.value==""){
		contenido.style.border = "3px solid red";
		errorEnUsuarioLogin=true;
	}
	else{
		contenido.style.border="2px solid grey";
		errorEnUsuarioLogin=false;
	}
}
function validarPassLogin(contenido){
	if(contenido.value==""){
		contenido.style.border = "3px solid red";
		errorEnPassLogin=true;
	}
	else{
		contenido.style.border="2px solid grey";
		errorEnPassLogin=false;
	}
}
function validarRegistro(){
	var e1="Nombre de Usuario incorrecto";
	var e2="Email incorrecto";
	var e3="Contraseñas no coinciden";
	var et="";
	var formulario=document.getElementById("formularioRegis");
	if(errorEnUsuario){
		et=et+e1+"\n";
	}
	if(errorEnMail){
		et=et+e2+"\n";
	}
	if(errorEnPass){
		et=et+e3+"\n";
	}
	if(et!=""){
		alert("Los datos no se subieron, tiene los siguientes errores:\n"+et);
	}
	if(et==""){
		formulario.submit();
	}
}
function validarLogin(){
	var e1="Nombre de Usuario incorrecto";
	var e3="Contraseña incorrecta";
	var et="";
	var formulario=document.getElementById("formularioLogin");
	if(errorEnUsuarioLogin){
		et=et+e1+"\n";
	}
	if(errorEnPassLogin){
		et=et+e3+"\n";
	}
	if(et!=""){
		alert("Sesión no iniciada, tiene los siguientes errores:\n"+et);
	}
	if(et==""){
		formulario.submit();
	}
}
function addList(){
	var x=document.getElementById("seslist");
	if(x.style.display == 'none'){
		x.style.display = 'inline';
	}
	else{
		x.style.display='none';
	}
}

function showPassChange(){
	var x=document.getElementById("pchange");
	if(x.style.display=='none'){
		x.style.display='inline';
	}else{
		x.style.display='none';
	}
	if(x=='null'){
x.style.display='inline';
	}
}
function show_EmailChange(){
	var x=document.getElementById("EmailChange");
	if(x.style.display =='none'){
x.style.display='block';
	}else{
x.style.display='none';
	}
}
function validarcambioPass(){
	var x=document.getElementById("PassChange");
	var y=x.getElementsByClassName("chg_data")[0].value;
	var z=x.getElementsByClassName("chg_data")[1].value;
	alert(y);
	if(y!=z){
document.getElementsByClassName("chg_data").style.background-color='#ffb3b3'; 
	}else{
document.getElementsByClassName("chg_data").style.background-color='#a3c2c2'; 
	}
}





/*------------------Fin de Funciones------------------------------------*/

/*-----------------Funciones Auxiliares---------------------------------*/
function esMail(contenido){
	var patron=RE_EMAIL;
	return patron.test(contenido);
}
function coincidePass(contenido,confirma){ 
	if(confirma.value==contenido)
		return true;
	else
		return false;
}
/*----------------Fin de Funciones Auxiliares---------------------------*/
