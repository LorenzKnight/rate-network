<?php
//$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

if (!isset($_FILES["file1"])) { // no se ha seleccionado fichero
    echo "ERROR: Select a file before pressing the upload button";
    exit();
}

$fileName = uniqid().'.'.getExtension($_FILES["file1"]["name"]); // Nombre de fichero
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // Fichero en la carpeta TMP
$fileType = $_FILES["file1"]["type"]; // Tipo de fichero



if (file_exists($_POST["a3"].$fileName)) { // Fichero repetido
    echo "ERROR: A file with that name already exists";
    exit();
}

//Comprobación Extensión 
$ext = pathinfo($fileName);
$extensionfichero = $ext['extension'];
if ($_POST["a8"]!="0")
{
	$pos=strpos($_POST["a8"], $extensionfichero);
	if ($pos === false) {
		echo "ERROR: File extension not allowed.";
		exit();
	}
}

//Comprobación Espacios vacios 
if (strpos($fileName, " "))
{
		echo "ERROR: The file name must not have spaces.";
		exit();
}

//Comprobación tamaño fichero
if ($_POST["a7"]!="0")
{
	$fileSize = $_FILES["file1"]["size"]; // File size in bytes
	if ($fileSize>$_POST["a7"])
	{
		echo "ERROR: File size is too large";
		exit();
	}
}

//Comprobación Ancho Fichero ****
if ($_POST["a9"]!="0")
{
	$data = getimagesize($fileTmpLoc);
	$width = $data[0];
	$height = $data[1];
	if ($width>$_POST["a9"])
	{
		echo "ERROR: File width is too large";
		exit();
	}
}

//Comprobación Alto Fichero ****
if ($_POST["a10"]!="0")
{
	$data = getimagesize($fileTmpLoc);
	$width = $data[0];
	$height = $data[1];
	if ($height>$_POST["a10"])
	{
		echo "ERROR: File height is too large";
		exit();
	}
}

//Copiamos ya el fichero al server
if(move_uploaded_file($fileTmpLoc, '../tmp_images/'.$fileName)){
    echo $fileName;

} else {
    echo "ERROR: Load failed. Check the permissions of the destination folder.";
}

//Get extencion of the uploaded file//
function getExtension($file, $tolower=true)
{
    $file = basename($file);
    $pos = strrpos($file, '.');

    if ($file == '' || $pos === false) {
        return '';
    }

    $extension = substr($file, $pos+1);
    if ($tolower) {
        $extension = strtolower($extension);
    }

    return $extension;
}
?>