<?php
//Inicio de sesion
session_start();

//Se incluye el archivo de funciones
include 'funciones.php';

//Se define el maximo ancho y alto que tendra la imagen final
$ancho_maximo = 640;
$alto_maximo = 480;


//Se reciben los datos necesarios 
$parte=$_POST["parte"];
$_SESSION["id_parte"] = $parte;
$carpeta = "./files/$parte";

//Si no existe la carpeta
if(!is_dir($carpeta)){
    //Se crea
    @mkdir($carpeta, 0777);
}

$tot = count($_FILES["archivos"]["name"]);

for ($i = 0; $i < $tot; $i++){
    $archivo1 = $_FILES["archivos"]['name'][$i];
    $repl="_";
    $serc=" ";
    $guardar = false;

    $archivo= str_replace ($serc,$repl,$archivo1);
    if ($archivo != "") {
        // guardamos el archivo a la carpeta files
        $directorio =  "".$carpeta."/";

        if(procesar_foto($_FILES['archivos']['tmp_name'][$i], $directorio, $_FILES["archivos"]['name'][$i])){
            $guardar = true;
        }
    }
}

if($guardar){
?>
    <script language="Javascript" type="text/javascript">
            alert ('Las fotos han subido con exito');
    </script>

    <?php
    //Script para marcar que ya hay fotos en la base de datos
    $insercion = "update tbl_accidente set fotos = 1 where id_parte = ".$parte;
    mysql_query($insercion, Conectarse());
    ?>
    <meta HTTP-EQUIV="REFRESH" content="0; url=fotos_mod.php">
<?php
}
?>
   