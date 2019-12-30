function eliminarregis(contenido){
	var row=contenido.parentNode.parentNode;
	var arr=new Array();
	arr[0]=row.childNodes[1].innerHTML;
	arr[1]=row.childNodes[3].innerHTML;
	arr[2]=row.childNodes[5].innerHTML;
	arr[3]=row.childNodes[7].innerHTML;
	arr[4]=document.getElementById('idped').innerHTML;
	//var table=row.parentNode;
	eliminarfila(row);
	//var aux=table.removeChild(row);
	if(window.XMLHttpRequest){
xmlhttp= new XMLHttpRequest();
	}else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
//var aux=this.responseText;
row.innerHTML=this.responseText;
//eliminarfila(row);
		}
	};
	//row.innerHTML='<td>Comida Eliminada<td>';
	xmlhttp.open("GET","borrarcomida.php?t="+arr,true);
	xmlhttp.send(null);
}

function buscar(){
	var arr=new Array();
	var nomRes=document.getElementById('ResSel').value;
	var nomCom=document.getElementById('ComSel').value;
	arr[0]=nomRes;
	arr[1]=nomCom;
	if(window.XMLHttpRequest){
xmlhttp= new XMLHttpRequest();
	}else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
document.getElementById('rtasComidas').innerHTML=this.responseText;
		}
	};
	xmlhttp.open("GET","buscarComidas.php?t="+arr,true);
	xmlhttp.send(null);
}

function agregar_a_PedActual(tag){
	var row=tag.parentNode.parentNode;
	var arr=new Array();
	arr[0]=row.childNodes[1].innerHTML;
	arr[1]=row.childNodes[3].innerHTML;
	arr[2]=row.childNodes[5].innerHTML;
	arr[3]='1';
	var idped=document.getElementById('idped').innerHTML;
	arr[4]=idped;
	var cuerpo=document.getElementById('ComActuales');
	var node=document.createElement("TR");

	if(window.XMLHttpRequest){
xmlhttp= new XMLHttpRequest();
	}else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
var dato=document.createElement("TD");
var textnode=document.createTextNode(arr[0]);
dato.appendChild(textnode);
node.appendChild(dato);
dato=document.createElement("TD");
textnode=document.createTextNode(arr[1]);
dato.appendChild(textnode);
node.appendChild(dato);
dato=document.createElement("TD");
textnode=document.createTextNode(arr[2]);
dato.appendChild(textnode);
node.appendChild(dato);
dato=document.createElement("TD");
textnode=document.createTextNode(arr[3]);
dato.appendChild(textnode);
node.appendChild(dato);
//cuerpo.appendChild(node);
dato=document.createElement("TD");
var button=document.createElement("BUTTON");
button.className = "e_n_button";
button.innerHTML="Quitar";
button.addEventListener("click", function(){eliminarregis(this);});

dato.appendChild(button);
node.appendChild(dato);

dato=document.createElement("TD");
textnode=document.createTextNode(this.responseText);
dato.appendChild(textnode);
node.appendChild(dato);

cuerpo.appendChild(node);
		}
	};
	xmlhttp.open("GET","insertarcomida.php?t="+arr,true);
	xmlhttp.send(null);
}

/*-----------------------------------------------------FUNCIONES AUXILIARES------------------------------------------------------------*/
function eliminarfila(row){
var i;
while(row.hasChildNodes()){
row.removeChild(row.lastChild);
}
}
/*-----------------------------------------------------FIN DE FUNCIONES AUXILIARES-----------------------------------------------------*/