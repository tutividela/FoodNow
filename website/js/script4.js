function showPass(){
	var x=document.getElementById("passform");
	if(x.style.display=='none'){
x.style.display='inline';
	}else{
x.style.display='none';
	}
}
function showEmail(){
	var x=document.getElementById("emailform");
	if(x.style.display=='none'){
x.style.display='inline';
	}else{
x.style.display='none';
	}
}
function validarpass(){
	var x=document.getElementsByClassName('passdata')[0];
	var y=document.getElementsByClassName('passdata')[1];
	if(x.value=='' || y.value==''){document.getElementById('passsubmit').disabled=true;}
	if(x.value==y.value){
document.getElementById('passsubmit').disabled=false;
	}else{
document.getElementById('passsubmit').disabled=true;
	}
}
function validaremail(){
	var x=document.getElementsByClassName('emaildata')[0];
	var y=document.getElementsByClassName('emaildata')[1];
	if(x.value=='' || y.value==''){document.getElementById('emailsubmit').disabled=true;}
	if(x.value==y.value){
document.getElementById('emailsubmit').disabled=false;
	}else{
document.getElementById('emailsubmit').disabled=true;
	}
}
function eliminarRegis(tag){
	var fila=tag.parentNode.parentNode;
	var datos=new Array();
	datos[0]=fila.childNodes[1].innerHTML;
	datos[1]=fila.childNodes[3].innerHTML;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById().innerHTML=this.responseText;
            
fila.innerHTML=this.responseText;
            
        }
    };
    
    xmlhttp.open("GET","eliminardomicilio.php?t=" + datos,true);
    xmlhttp.send(null);
 
 
}
function eliminartel(tag){
	var fila=tag.parentNode.parentNode;
	var tel=fila.childNodes[1].innerHTML;
	
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            fila.innerHTML=this.responseText;
}
    };
   xmlhttp.open("GET","eliminartel.php?t=" + tel,true);
   xmlhttp.send(null);
}