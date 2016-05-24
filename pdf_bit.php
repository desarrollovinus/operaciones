<?php
date_default_timezone_set("America/Bogota");

require_once('class.ezpdf.php');

$con1=$_POST[pri_con];
$con2=$_POST[seg_con];

$pdf =& new Cezpdf('LETTER');
$pdf->selectFont('../fonts/arial.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);


$pdf->ezText("<b>Reporte de Bitacora</b> ", 20);

$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);

$host = 'databases';
$user = 'operaciones';
$password = 'mymastersql';

$pdf->ezText("$txttit", 10);

$database = 'operaciones';
$link = mysql_connect($host,$user,$password);
mysql_select_db($database);


$consulta='select consecutivo, fechahora, asunto, anotacion from tbl_bitacora where consecutivo>="'.$con1.'"&& consecutivo<="'.$con2.'"';
$resultado_consulta=mysql_query($consulta) or die(mysql_error());
$ixxx= 0;
while($resultados = mysql_fetch_assoc($resultado_consulta)) {
    $ixx = $ixx+1;
    $data[] = array_merge($resultados);
}
$titulos= array('consecutivo'=>'<b></b>',
	         'fechahora'=>'<b>FECHA</b>',
                'asunto'=>'<b>ASUNTO</b>',
                'anotacion'=>'<b>ANOTACION</b>',
                );
$opciones = array('shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center', 'textCol'=>array(0,0,0),'width'=>500, 'setColor'=>array(0.8,0.8,0.8),
		   'fontSize'=>8, 'cols'=>array('fechahora'=>array('width'=>60),'asunto'=>array('width'=>80 )));

$pdf->ezTable($data, $titulos, '', $opciones);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Firma Entrega:___________________", 10);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Firma Recibe:___________________", 10);

$pdf->ezStream();// generar el documento
?>
