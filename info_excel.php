<?php
session_start();
switch ($_POST["excel"]){
    case "Generar Otros en Excel":
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_SESSION["tablaexcelotros"];

break;

case "Generar Gruas en Excel":
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_SESSION["tablaexcelgruas"];
break;

case "Generar Accidentalidad en Excel":
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_SESSION["tablaexcelacc"];
break;

case "Generar Emergencias en Excel":
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_SESSION["tablaexcelemer"];
break;

case "Generar Ambulancia en Excel":
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_SESSION["tablaexcelamb"];
break;

case "Generar Cierres en Excel":
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_SESSION["tablaexcelcie"];
break;

case "Generar Involucrados en Excel":
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_SESSION["tablaexcelinv"];
break;

case "Generar Incidentes en Excel":
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_SESSION["tablaexcelinc"];
break;

}
?>

