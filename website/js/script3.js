/*----------------------------------------------RegExp-----------------------------------------------------*/
var RE_NUM=/'^[0-9]+$'/;
var RE_TELEFONO=/^\d{2}\s\d{3,4}\s\d{7,8}/;
/*--------------------------------------------FIN de RegExp------------------------------------------------*/

/*-------------------------------------------Variables Globales--------------------------------------------*/
var errorEnDir=true;
var errorEnNum=true;
var errorEnTel=true;
var errorEnPago=true;
/*---------------------------------------FIN de Variables Globales-----------------------------------------*/

/*------------------------------------------Funciones------------------------------------------------------*/
function addDir(contenido){
	var x=document.getElementById("anadirDireccion");
	if(contenido.value=="addDirec"){
		x.style.display = 'block';
	}
	else{
		x.style.display = 'none';
	}
}
function addTel(contenido){
	var x=document.getElementById("anadirTelefono");
	if(contenido.value=="addTelef"){
		x.style.display = 'block';
	}
	else{
		x.style.display = 'none';
	}
}
function addFormaPago(contenido){
	var x=document.getElementById("efect");
	if(contenido.value=="efectivo"){
		x.style.display="block";
	}
	else{
		x.style.display="none";
	}
}
function validarDir(){
	var contenido=document.getElementById("nuevaDir");
	var numero=document.getElementById("nuevoNum");
	if(!esDir(contenido.value) || contenido.value=="" || numero.value==""){
		contenido.style.border = "3px solid red";
		numero.style.border = "3px solid red";
		errorEnDir=true;
		errorEnNum=true;
	}
	else{
		contenido.style.border="2px solid grey";
		numero.style.border="2px solid grey";
		errorEnDir=false;
		errorEnNum=false;
	}
}
function validarTel(contenido){
	if(!esTel(contenido.value) || contenido.value==""){
		contenido.style.border = "3px solid red";
		errorEnTel=true;
	}
	else{
		contenido.style.border="2px solid grey";
		errorEnTel=false;
	}
}
function validarPago(contenido){
	if((!esNum(contenido.value) || contenido.value=="" || !pagoCorr(contenido.value)) && contenido.style.display!='none'){
		contenido.style.border = "3px solid red";
		errorEnPago=true;
	}
	else{
		contenido.style.border="2px solid grey";
		errorEnPago=false;
	}
}
function validarFormulario(){
	var formulario=document.getElementById("formConfirm");
	var telefono=document.getElementById("telefono");
	var dir=document.getElementById("direccion");
	var pago=document.getElementById("formaPago");
	var et="";
	var e5="Seleccione Dirección";
	var e6="Seleccione Teléfono";
	var e1="Direccion Incorrecta";
	var e2="Teléfono Incorrecto";
	var e3="Cantidad Insuficiente";
	var e4="Seleccione forma de Pago";
	if(dir.value=="0")
		et=et+e5+"\n";
	if(dir.value=="addDirec"){
		if(errorEnDir || errorEnNum)
			et=et+e1+"\n";
	}
	if(telefono.value=="0")
		et=et+e6+"\n";
	if(telefono.value=="addTelef"){
		if(errorEnTel)
			et=et+e2+"\n";
	}
	if(pago.value=="0"){
		et=et+e4+"\n";
	}
	if(pago.value=="efectivo"){
		if(errorEnPago)
			et=et+e3+"\n";
	}
	if(et!=""){
		alert("Pedido no realizado, tiene los siguientes errores:\n"+et);
	}
	if(et==""){
		formulario.submit();
	}
}
function calcularTotal(contenido){
	var subtotal=document.getElementById("subtot");
	var precioSub=subtotal.textContent.substring(1);
	var porcentaje=1-parseFloat(contenido.value)/100;
	var precioTotal=porcentaje*precioSub;
	var thTotal=document.getElementById("pagoTot");
	thTotal.innerHTML="$" + precioTotal.toString();
}
/*-----------------------------------------------FIN de Funciones-----------------------------------------------*/

/*-------------------------------------------Funciones Adicionales----------------------------------------------*/
function esDir(contenido){ 
	return isNaN(contenido);
}
function pagoCorr(contenido){
	var precioTstr=document.getElementById("pagoTot");
	var precioT=precioTstr.textContent.substring(1);
	if (contenido<parseFloat(precioT))
		return false;
	else
		return true;
}
function esNum(contenido){ 
	return !isNaN(contenido);
}
function esTel(contenido){ 
	return !isNaN(contenido);
}
/*-----------------------------------------FIN de Funciones Adicionales-----------------------------------------*/