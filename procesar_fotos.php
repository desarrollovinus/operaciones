<?php
//Inicio de sesion
session_start();

//Se carga el archivo de funciones
include 'funciones.php';

//Se establece la ruta de las fotos
$ruta = "files/";

//Se hace la consulta de todos los accidentescon la informacion que se pide
$consulta = mysql_query(
	"SELECT
	*
	FROM
	tbl_parte
	ORDER BY
	tbl_parte.id_parte ASC", Conectarse()
);

echo "Procesamiento de fotos iniciado a las 10:48 a.m.";
echo "Procesamiento de fotos finalizado a las 12:37 p.m.";


while ( $row = mysql_fetch_array($consulta)){
	// Se almacena el id de parte
	$id_parte = $row['id_parte'];

	// Se obtiene el directorio antiguo
	$directorio = $ruta.$id_parte."/";
	$carpeta = "files_2/$id_parte/"; //Nuevo

	//Si existe la carpeta
	if(file_exists($directorio)){
		//Si no existe la carpeta
		if(!is_dir($carpeta)){
		    //Se crea
		    @mkdir($carpeta, 0777);
		}//if

		echo "<br><b>Parte ".$id_parte."</b><br>";

		$procesadas = 1;

		//Se recorre la carpeta en búsqueda de imágenes
		foreach(glob($directorio."*") as $archivo){
			//Dividimos el archivo para obtener el nombre
			$temporal = explode("/",$archivo);

			//obtenemos el nombre del archivo
			$imagen = $temporal[count($temporal)-1];
			
			// 
			if(procesar_foto($archivo, $carpeta, $imagen)){
	            echo "Imagen correctamente procesada: ".$imagen."<br>";
	        }//if

	        $procesadas++;
		}//foreach glob
	}//if
}//while

echo 'se procesaron correctamente '.number_format($procesadas, 0, '', '.');

