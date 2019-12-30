/*--------------------------RegExp-------------------------------------*/

/*-------------------------Fin de RegExp-------------------------------*/

/*-----------------------Declaracion de Variables Globales-------------*/
var ids= new Array();
/*------------------Fin de Declaracion de variables globales-----------*/

/*-------------------------Funciones-----------------------------------*/
function mostrarCarr(){
	var x=document.getElementById("list_ped");
	if(x.style.display == 'none'){
		x.style.display='inline';
	}else{
		x.style.display='none';
	}
}
function buscador(){
	var datos=new Array();
	datos[0]=document.getElementById("name_restaurant").value;
	datos[1]=document.getElementById("sel_comida").value;
	if(document.getElementById("ordPrec").checked){
		datos[2]="true";
	}else{
		datos[2]="false";
	}
	if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("busquedaRes").innerHTML = this.responseText;
        }
    };
	xmlhttp.open("GET","buscar.php?q="+datos,true);
	xmlhttp.send(null);
}
function crearCarrito(contenido){
	var carrito=document.getElementById("carro");
	var posibleSeleccion=document.getElementById("busquedaRes");
	var seleccion=posibleSeleccion.getElementsByClassName("agregados");
	var descrip=seleccion[contenido];
	var clntr=descrip.cloneNode(true);
	var z=clntr.getElementsByTagName("td");
	z[2].innerHTML="x1";
	clntr.removeChild(clntr.childNodes[4]);
	var bot=document.createElement("button");
	bot.className="botones";
	var texto=document.createTextNode("Quitar");
	bot.appendChild(texto);
	var cell=document.createElement("td");
	cell.className="campo";
	cell.appendChild(bot);
	clntr.appendChild(cell);
	carrito.appendChild(clntr);
	var pos=carrito.childNodes.length;
	var posCarrito=pos-2;
	clntr.id=posCarrito.toString();
	var posID=ids.length;
	ids[posID]=clntr.id;
	bot.addEventListener("click", function(){quitarCarro(clntr.id);});
	var precioStr=z[3].textContent;
	precioStr=precioStr.substring(1);
	precio=parseInt(precioStr);
	var precioTotalStr=document.getElementById("precTot").innerHTML;
	precioTotalStr=precioTotalStr.substring(1);
	precioTotal=parseInt(precioTotalStr);
	precioTotal=precioTotal + precio;
	document.getElementById("precTot").innerHTML="$"+precioTotal.toString();
	var listo=document.getElementById("bot_listo");
	listo.disabled=false;
	listo.style.cursor="pointer";
}
function quitarCarro(contenido){
	var carrito=document.getElementById("carro");
	var hijo=document.getElementById(contenido);
	carrito.removeChild(hijo);
	var precioStr=hijo.childNodes[3].textContent;
	precioStr=precioStr.substring(1);
	precio=parseInt(precioStr);
	var precioTotalStr=document.getElementById("precTot").innerHTML;
	precioTotalStr=precioTotalStr.substring(1);
	precioTotal=parseInt(precioTotalStr);
	precioTotal=precioTotal - precio;
	document.getElementById("precTot").innerHTML="$"+precioTotal.toString();
	var i=0;
	while(i<ids.length){
		if(ids[i]==contenido)
			ids.splice(i, 1);
		i++;
	}
	if(estaVacio(carrito)){
		var listo=document.getElementById("bot_listo");
		listo.disabled=true;
		listo.style.cursor="not-allowed";
	}
}
function enviarCarrito(){
	var carrito=document.getElementById("carro");
	var j=0;
	var trs=new Array();
	while (j<ids.length) {
		trs[j]=document.getElementById(ids[j]);
		j++;
	}
	var tds=new Array();
	j=0;
	while (j<trs.length) {
		tds[j]=trs[j].innerHTML;
		j++;
	}
	if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var pedido=new Array();
    var i=0;
    while(i<tds.length){
    	pedido[i]=tds[i];
    	i++;
    }
    if(confirm("Desea continuar con este pedido?")){
    	xmlhttp.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
        		window.open("pago.php", "_self");
        	}
    	};
    	xmlhttp.open("GET","crearPedido.php?q="+pedido,true);
		xmlhttp.send(null);
    }
}
/*------------------Fin de Funciones------------------------------------*/
function estaVacio(contenido){
	if (contenido.childNodes.length==1){
		return true;
	}else {
		return false;
	}
}
/*-----------------Funciones Auxiliares---------------------------------*/

/*----------------Fin de Funciones Auxiliares---------------------------*/
