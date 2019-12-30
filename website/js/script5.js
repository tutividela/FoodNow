function eliminarpedido(tag){
var fila=tag.parentNode.parentNode;
var tabla=fila.parentNode.parentNode;
var idped=fila.childNodes[5].innerHTML;
if(window.XMLHttpRequest){
xmlhttp = new XMLHttpRequest();
	}else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
tabla.innerHTML=this.responseText;
		}
	};
xmlhttp.open("GET","eliminarpedido.php?t="+idped,true);
xmlhttp.send(null);
}

function eliminarpedido2(tag,contenido){
	var fila=tag.parentNode.parentNode;
var tabla=fila.parentNode.parentNode;
tabla.style.display='none';
var pedido=tabla.parentNode;
	//var idped=document.getElementById('idepd').innerHTML;
	if(window.XMLHttpRequest){
xmlhttp = new XMLHttpRequest();
	}else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
pedido.innerHTML=this.responseText;
		}
	};
xmlhttp.open("GET","eliminarpedido.php?t="+contenido,true);
xmlhttp.send(null);
	}