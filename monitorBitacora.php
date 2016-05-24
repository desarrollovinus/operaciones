<?php
/**
 * Se incluye la clase Bitacora
 */
include_once 'clases/Bitacora.php';
/**
 * Se incluyen las funciones
 */
include_once 'funciones.php';
/**
 * Se inicia la sesion
 */
session_start();

if(isset($_SESSION["tipo"])) {
	if($_SESSION["tipo"] != "3") {
		header("location: index.php");
	}
}
else {
	header("location: index.php");
}

//conexion a la base de datos
$link = Conectarse();

$inicio = "";
$fin = "";
$anotacion = "";
$query = "SELECT * FROM tbl_bitacora where";

if(isset($_POST["anotacion"])) {
	$anotacion = $_POST["anotacion"];
}

$query .= " anotacion like '%$anotacion%'";

if(isset($_POST["inicio"])) {
	if($_POST["inicio"] != "") {	
		$inicio = $_POST["inicio"];
		$fin = date("Y-m-d", time());
		if(isset($_POST["fin"])) {
			if($_POST["fin"] != "") {
				$fin = $_POST["fin"];
			}
		}
		//se arma la consulta
		$query .= " and fechahora between '$inicio 00:00:00' and '$fin 00:00:00'";
	}
}

$query .= " order by consecutivo desc limit 0, 100";

$result = mysql_query($query, $link);

$registrosBitacora = array();

while($row = mysql_fetch_assoc($result)) {
	array_push($registrosBitacora, new Bitacora($row));
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Consulta Bitacora</title>
		<link href="css/estilos.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<script src="js/jquery-1.7.min.js"></script>
	</head>
	<body>
		<div align="center">
			<div id="botonera" style="height:70px !important;">				
				<div align="center">
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
						<table>
							<tr>
								<th><label for="inicio">Fecha inicial: </label></th>
								<td><input type="text" id="inicio" name="inicio" class="sen-class1" value="<?php echo $inicio; ?>"></td>
								<th><label for="fin">Fecha final: </label></th>
								<td><input type="text" id="fin" name="fin" class="sen-class1" value="<?php echo $fin; ?>"></td>
								<td rowspan="2">
									<input style="font-size:12px;color:#ffffff;font-family:verdana;background-color:#006699; height:100% !important" type="submit" id="filtrar" name="filtrar" value="Filtrar" class="button">
									<input style="font-size:12px;color:#ffffff;font-family:verdana;background-color:#006699; height:100%" type="button" id="salir" name="salir" value="Salir" class="button"  onclick="location.href='salir.php'" >
								</td>
							</tr>
							<tr>
								<th><label for="anotacion">Anotaci&oacute;n: </label></th>
								<td colspan="3"><input style="width:100% !important;" type="text" id="anotacion" name="anotacion" class="sen-class1" value="<?php echo $anotacion; ?>"></td>
							</tr>
						</table>
						<br><br>
						<br><br>
					</form>
					
					<table BORDER=1 CELLSPACING=1 CELLPADDING=1 width="1060px">
						<tr align="center">
							<td>&nbsp;<b>CONSECUTIVO</b>&nbsp;</td>
							<td>&nbsp;<b>MOTIVO</b>&nbsp;</td>
							<td width="120px">&nbsp;<b>FECHA Y HORA</b>&nbsp;</td>
							<td>&nbsp;<b>ASUNTO</b>&nbsp;</td>
							<td>&nbsp;<b>ANOTACION</b>&nbsp;</td>
						</tr>
						<?php
							if(count($registrosBitacora) > 0) {
								foreach ($registrosBitacora as $registro) :
									echo "<tr>";
										echo "<td>&nbsp;".$registro->getConsecutivo()."&nbsp;</td>";
										echo "<td>&nbsp;".$registro->getMotivo()."&nbsp;</td>";
										echo "<td>&nbsp;".$registro->getFechaHora()."&nbsp;</td>";
										echo "<td>&nbsp;".$registro->getAsunto()."&nbsp;</td>";
										echo "<td>&nbsp;".$registro->getAnotacion()."&nbsp;</td>";
									echo "</tr>";
								endforeach;
							}
						?>
					</table>
					<br><br><br><br>
				</div>
		    </div>
		</div>
		<script type="text/javascript">
			var cal = Calendar.setup({
				onSelect: function(cal) { cal.hide() }
			});
			cal.manageFields("inicio", "inicio", "%Y-%m-%d");
			cal.manageFields("fin", "fin", "%Y-%m-%d");
		</script>
	</body>
</html>