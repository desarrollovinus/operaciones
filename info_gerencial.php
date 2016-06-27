<?php
$f_ini=date("Y-m-d", strtotime($_POST['pri_fec']));
$f_fin=date("Y-m-d", strtotime($_POST['seg_fec']));
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
	    <title>Informe gerencial</title>
	    <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
	</head>
	<body>
        <form action='info_gerencial_excel.php?f_ini=<?php echo $f_ini; ?>&f_fin=<?php echo $f_fin; ?>' method="POST">
			<h1>INFORME GERENCIAL</h1>
			<div style="padding-bottom: 20px;">
                <input type="submit" name="excel" id="bot1" value="Generar informe en Excel" >
                <input type="button" name="regresar" id="bot1" value="Regresar" onclick="location.href='informes.php'" >
            </div>
		</form>
	</body>
</html>