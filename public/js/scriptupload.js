// JavaScript Document
function _(el){
	return document.getElementById(el);
}
	
function uploadFile(a1, a2, a3, a4, a5, a6, a7, a8, a9, a10) {
	var file = _(a4).files[0];
	// console.log(URL.createObjectURL(file));
	// document.body.style.backgroundImage = 'url("'+URL.createObjectURL(file)+'")';
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);
	formdata.append("a3", a3); //Carpeta destino
	formdata.append("a7", a7); //tamaño
	formdata.append("a8", a8); //tipos
	formdata.append("a9", a9); //ancho
	formdata.append("a10", a10); //alto
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress",progressHandler , false);
	//ajax.addEventListener("load", function() {completeHandler("p2");}, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.myParam = a5;
	ajax.myParam2 = a6;
	ajax.myParam3 = a1;
	ajax.myParam4 = a2;
	ajax.myParam5 = a3;
	ajax.open("POST", "../components/upload4.php");
	ajax.send(formdata);
}
function progressHandler(event){
	//_("loaded_n_total").innerHTML = "Subidos "+event.loaded+" bytes de "+event.total;
	nombrestatus=event.target.myParam;
	nombrebarra=event.target.myParam2;
	var percent = (event.loaded / event.total) * 100;
	_(nombrebarra).value = Math.round(percent);
	_(nombrestatus).innerHTML = Math.round(percent)+"% Loading... please wait";
}
function completeHandler(event){
	//_("status").innerHTML = event.target.responseText;
	nombrestatus=event.target.myParam;
	nombrebarra=event.target.myParam2;
	nombrecampoimagen=event.target.myParam3;
	nombrecampoimagenPic=event.target.myParam4;
	nombrecarpeta=event.target.myParam5;
	// console.log(nombrecampoimagen);
	// console.log(nombrecampoimagenPic);
	if (event.target.responseText.substring(0,5)=="ERROR")
	{
		_(nombrestatus).innerHTML = event.target.responseText;
		_(nombrebarra).value = 0;
	}
	else
	{
		_(nombrestatus).innerHTML = "Upload completed";
		_(nombrebarra).value = 100;
		var fotoField = document.getElementById(nombrecampoimagen).value;
		if(fotoField == '')
		{
			let fotoNameArray = [event.target.responseText];
			document.getElementById(nombrecampoimagen).value = JSON.stringify(fotoNameArray);
			document.getElementById(nombrecampoimagenPic).src = nombrecarpeta+event.target.responseText;
		}
		else
		{
			let fotoNameArray = JSON.parse(fotoField);
			fotoNameArray.push(event.target.responseText);
			document.getElementById(nombrecampoimagen).value = JSON.stringify(fotoNameArray);
			let fotos = document.createElement('img');
			fotos.src = nombrecarpeta+event.target.responseText;
			fotos.style.height = '150px';
			console.log(event.target);
			document.getElementById(nombrecampoimagenPic).closest('.post_foto_prev').appendChild(fotos);
		}
	}
	
}
function errorHandler(event){
	nombrestatus=event.target.myParam;
	_(nombrestatus).innerHTML = "ERROR: Upload error";
}
function abortHandler(event){
	nombrestatus=event.target.myParam;
	_(nombrestatus).innerHTML = "ERROR: Upload interrupted";
}