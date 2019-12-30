function cambiardom(contenido){
	var x=document.getElementById('Dlist').value;
	if(x=='ND'){
document.getElementById('Dcambio').style.display='block';

	}else{
		if(x=='0'){
document.getElementById('Dcambio').style.display='none';
		}else{
			var arr=new Array();
			arr[0]=x;//iddom
			arr[1]=contenido;//idped
if(window.XMLHttpRequest){
xmlhttp= new XMLHttpRequest();
}else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
document.getElementById('domactual').innerHTML=this.responseText;
	}
};
xmlhttp.open("GET","cambiarPedidoDom.php?t="+arr,true);
xmlhttp.send(null);
		}
	}
}


function cambiarTel(contenido){
	var x=document.getElementById('Tlist').value;
	if(x=='NT'){
document.getElementById('Tcambio').style.display='block';
	}else{
		if(x=='0'){
document.getElementById('Tcambio').style.display='none';
		}else{
			var arr=new Array();
			arr[0]=x;
			//var idped=document;
			arr[1]=contenido;
if(window.XMLHttpRequest){
xmlhttp= new XMLHttpRequest();
}else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
document.getElementById('telactual').innerHTML=this.responseText;
	}
};
xmlhttp.open("GET","cambiarPedidoTel.php?t="+arr,true);
xmlhttp.send(null);			
		}
	}
}

function insertarDomNuevo(contenido){
	var newdom= new Array();
var calle=document.getElementById('newcalle').value;
var numero=document.getElementById('newnumero').value;
newdom[0]=calle;
newdom[1]=numero;
newdom[2]=contenido;
if(window.XMLHttpRequest){
xmlhttp= new XMLHttpRequest();
}else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
document.getElementById('domactual').innerHTML=this.responseText;
	}
};
xmlhttp.open("GET","insertarDomNuevo.php?t="+newdom,true);
xmlhttp.send(null);
}

function insertarTelNuevo(contenido){
	var newtel=new Array();
	var tel=document.getElementById('newtel').value;
	newtel[0]=tel;
	newtel[1]=contenido;
	if(window.XMLHttpRequest){
xmlhttp= new XMLHttpRequest();
}else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
document.getElementById('telactual').innerHTML=this.responseText;
	}
};
xmlhttp.open("GET","insertarTelNuevo.php?t="+newtel,true);
xmlhttp.send(null);
}
