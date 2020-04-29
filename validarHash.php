<?php 
 
// Nombre Archivo
$txtNombre = $_FILES['fichero_usuario']['name'];
 
// Nombre temporal
$txtNombreTemporal = $_FILES['fichero_usuario']['tmp_name'];
 
// Estension del archivo
$txtTmp = explode(".", $txtNombre);
$txtExtension = strtolower(end($txtTmp));
 
// cambia el nombre a uno seguro con encriptacion MD5
$txtNombreNuevo = md5(time() . $txtNombre) . '.' . $txtExtension;
 
// Rutas nuevas para guardar temporalmente
$rutaTemporal = './tmp/';
$rutaDestino = $rutaTemporal . $txtNombreNuevo;
 
// Guardamos el archivo temporal para poder leerlo
if(move_uploaded_file($txtNombreTemporal, $rutaDestino)) {
    $mensaje = NULL;
    $mensaje1 = NULL;
 
    // Abrir y leer el archivo 
    $txtAbrir= fopen($rutaDestino, 'r');
    $txtLeer = fgets($txtAbrir);
    fclose($txtAbrir);
 
    // Convertir a JSON el string
    $arrayTxt = json_decode($txtLeer);
 
    // SACAMOS AMBOS HASH
    $hash_1 = $arrayTxt->hash_1;
    $hash_2 = $arrayTxt->hash_2;
    $dinero = (int)$arrayTxt->dinero;
    //VALIDAR QUE LO INGRESADO EN DINERO SOLO SEAN NUMEROS
 
    if($dinero === 0){
        $mensaje1 = "El monto ingresado no corresponde a un valor númerico"."<br />";
    }else{
        $mensaje1 = "El monto ingresado esta correcto";
    }
    // VALIDAMOS EL TAMAÑO DE LOS HASH
    if (strlen ($hash_1) == 40 && strlen ($hash_2) == 40) {
        $mensaje = "Sus dos llaves HASH son correctas "."<br />";
    } else {
        if (strlen ($hash_1) != 40) {
            $mensaje = 'Hash 2 valido-------- Hash1 no tiene la longitud adecuada - tiene '.strlen ($hash_1).' caracteres';
        } else if (strlen ($hash_2) != 40) {
            $mensaje = 'Hash 1 valido-------- Hash2 no tiene la longitud adecuada -tiene '.strlen ($hash_2).' caracteres';
        } 
    }
 
} else {
  $mensaje = 'Error mientras se cargaba el archivo';
}
 
unlink($rutaDestino);
echo $mensaje,$mensaje1;
 
 
?>
