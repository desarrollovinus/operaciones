<?php
session_start();
include 'funciones.php';

$link=Conectarse();
$parte= $_POST['ver_p'];

     $consulta="SELECT * FROM tbl_parte where id_parte='$parte'";
            $resul= mysql_query($consulta,$link);
            $row = mysql_fetch_array($resul);
$_SESSION["id_parte"]=$row["id_parte"];
if($row["cierre_via"]=='0' && $row["ambulancia"]=='0' && $row["grua"]=='0'){
	 switch($row["motivo_parte"]) {
		case "Otros": header("location: otros_mod.php");
		break;
		case "Emergencia": header("location: emergencias_mod.php");
		break;
	}
}
$hay_fotos = true;
$dir = "files/".$row["id_parte"];
if((is_dir($dir))==''){
   $hay_fotos = false;
}


?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<title>Modificar Parte</title>
		</head>
	<body>
		<div id="selec_ver">
			<div class="log">
				<div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
				<form id="imp_bit" action="ver_parte.php" method="post">
					<div class="ver_parte">
						<div class="titulos">Seleccione la planilla deseada:</div>
						<div class="boton">
							<input type="button" id="<?php echo strtolower($row["motivo_parte"]) ?>"  value="<?php echo 
$row["motivo_parte"] ?>" name="<?php echo strtolower($row["motivo_parte"]) ?>" onclick="location.href='<?php echo strtolower($row["motivo_parte"]) ?>_mod.php'" class="bot"/>
							<?php
								if($row["motivo_parte"] == "Accidente"){
									echo '<input type="button" id="invo"  value="Involucrados" name="invo" onclick="location.href=\'selc_inv.php\'" class="bot"/>';
									echo '<input type="button" id="vic"  value="Victimas" name="vic" onclick="location.href=\'selc_vic.php\'" class="bot"/>';
								}
								
								if($row["cierre_via"]=='1'){
									echo '<input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href=\'cierre_mod.php\'" class="bot"/>';
								}

								if($row["ambulancia"]=='1'){
									echo '<input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href=\'selc_amb.php\'" class="bot"/>';
								}

								if($row["grua"]=='1'){
									echo '<input type="button" id="grua"  value="Grua" name="grua" onclick="location.href=\'selc_grua.php\'" class="bot"/>';
								}
								
								if($hay_fotos){
									echo '<input type="button" id="fotos"  value="Eliminar fotos" name="fotos" onclick="location.href=\'fotos_mod.php\'" class="bot"/>';
								}
							?>
						</div>
						<div class="boton">
							<input type="button" id="atras"  value="Regresar" name="atras" onclick="location.href='modif.php'" class="bot"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
