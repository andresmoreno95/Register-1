<?php
 
$hash_1 = $_POST["h1"];
$hash_2 = $_POST["h2"];
(float) $dinero = $_POST["dinero"];
 
$arregloDatos = array();
 
$arregloDatos["hash_1"] = $hash_1;
$arregloDatos["hash_2"] = $hash_2;
$arregloDatos["dinero"] = $dinero;
 
//Se codifica la informacion a tipo JSON
 
$JSONData = json_encode($arregloDatos);
 
//Creacion del archivo TXT
$fp = fopen($_SERVER["DOCUMENT_ROOT"] . "/txt/INFORMACION.txt","wb");
fwrite($fp,$JSONData);
fclose($fp);
 
//URL a dirigir
$url = "exito.php";
//redirección
header("Location: " .$url);
 
?>
