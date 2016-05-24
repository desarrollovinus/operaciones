<?php
session_start();
if($_SESSION){
	$log=$_SESSION["log"];
	if ($log==0){
		session_destroy();
		header("location: index.php");
	}

	include 'funciones.php';
	$link=Conectarse();
	$consulta="SELECT * FROM tbl_parte where id_parte='$id_parte'";
	$resul= mysql_query($consulta,$link);
	$row = mysql_fetch_array($resul);
	if($row["usuario"] != $_SESSION["ced"]){
		header("location: index.php");
	}

	if($_GET){
		if($_GET["parte"] and $_GET["photo"]){
			$carpeta="./files";
			$parte=$_GET["parte"];
			$foto=$_GET["photo"];
			$archivo="$carpeta/$parte/$foto";
			if(file_exists($archivo)){
				@unlink($archivo);
				$directorio=$carpeta."/".$parte."/";
				if(count(scandir($directorio)) == 2){
					@rmdir($directorio);
				}
			}
		}
		header("location: fotos_mod.php");
	}
}
else{
	header("location: index.php");
}
?>