<?php
//Se carga el archivo de funciones
include 'funciones.php';

//Se hace la consulta de todos los accidentes
$consulta = mysql_query("Select * from tbl_accidente order by id_parte", Conectarse());

//Se cuenta la cantidad de accidentes que no tienen fotos
if(mysql_num_rows($consulta) == 0){
    echo utf8_decode("No se han encontrado accidentes");
}else{
    echo "De los ".number_format(mysql_num_rows($consulta), 0, '', '.')." partes rgistrados como accidentes, los siguientes no tienen fotos:<br>";
}

//Se establece la ruta de las fotos
$ruta = "files/";

//Se declara el contador que va a controlar la cantidad de celdas
$cont = 0;

//Se declara el contador que va a controlar la cantidad de imagenes
$numero_archivos = 0;

//Se empiezan a recorrer los accidentes
while ( $row = mysql_fetch_array($consulta)){
    //Se aumenta el contador de celdas
    $cont++;

    //Se recorre cada carpeta en busca de imagenes
    foreach(glob($ruta.$row['id_parte']."/*") as $archivo){
        //se aumenta el contador de imagenes
        $numero_archivos++;
    }

    //Se pone un 1 a todos los accidentes que tienen fotos
    if($numero_archivos == 0){
        echo "Parte ".$row['id_parte']."<br>";
        //Consulta que hara el update
        // $insercion = "update tbl_accidente set fotos = 1 where id_parte = ".$row['id_parte'];
        //Ejecucion de la consulta
        // mysql_query($insercion, Conectarse());
    }

    //Se resetea el numero de imagenes
    $numero_archivos = 0;
}//Fin while












?>