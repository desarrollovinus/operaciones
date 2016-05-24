<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
$id_parte=$_SESSION["id_parte"];
$tipo_us=$_SESSION["tipo"];

include 'funciones.php';
$link=Conectarse();
$consulta="SELECT * FROM tbl_parte where id_parte='$id_parte'";
$resul= mysql_query($consulta,$link);
$row = mysql_fetch_array($resul);
$puede_borrar = true;
if($row["usuario"] == $_SESSION["ced"]){
	$puede_borrar=true;
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<title>Fotos</title>
		<script type="text/javascript" language="javascript">
			function elimina_foto(parte,foto){
				if(confirm("Está seguro de eliminar la foto '"+ foto +"' del parte '"+ parte +"'?")){
					location.href="elimina_foto.php?parte=" + parte + "&photo=" + foto;
				}
			}
		</script>
	</head>
	<body>
	<div id="con_img">
	<div id="contenedor-logo1">
		<div class="logo1"></div>
		<div class="botonera_superior">
			<input type="button" id="reg" name="reg" value="Regresar al menu" class="bot" <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?>>
			<br><br><br>
			<div class="datos" ><b><h3>Número del Parte: <?php echo $id_parte ?></h3></b></div>
		</div>
	</div>
	<div class="fotos">
		<?php
			$dir = "files/$id_parte";
			if((is_dir($dir))==''){
				echo '<b><h3>No existen fotos relacionadas al parte '.$id_parte.'</h3></b>';
			}else{
				$directorio=opendir($dir);
				echo "<table  bgcolor='#C8D7DC'>";
				$cont = 0;
				while ($archivo = readdir($directorio)) {
					if($archivo!= "." && $archivo != ".." && $archivo!="Thumbs.db"){
						if ($cont%4 == 0){
							echo "<tr>";
						}
						echo "<td><img src='$dir/$archivo' width='190px'>";
						if($puede_borrar){
							echo '<img src="images/delete.gif" align="top" border="1px" title="Eliminar foto" onclick="elimina_foto('.$id_parte.',\''.$archivo.'\')">';
						}
						echo "</td>";
						if($cont%4 == 3){
							echo "</tr>";
						}
						$cont++;
					}
				}
				echo "</table>";
				closedir($directorio);
				if(!$puede_borrar){
					echo "<p><strong>Usted no cuenta con permisos para eliminar estas fotos.</strong></p>";
				}
			}
		?>
	</div>
	</div>
	</body>
</html>
