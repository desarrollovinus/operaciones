<?php
// error_reporting(-1);
$fecha_inicial=$_GET['f_ini'];
$fecha_final=$_GET['f_fin'];

session_start();

include 'PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';

include("funciones.php");
$link=Conectarse();

function configuracion($hoja, $cabecera = null){
	//Definicion de las configuraciones por defecto en todo el libro
	$hoja->getDefaultStyle()->getFont()->setName('Arial'); //Tipo de letra
	$hoja->getDefaultStyle()->getFont()->setSize(8); //Tamanio
	$hoja->getDefaultStyle()->getAlignment()->setWrapText(true);//Ajuste de texto
	$hoja->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);// Alineacion centrada

	//Se establece la configuracion de la pagina
	$hoja->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //Orientacion horizontal
	$hoja->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //Tamano oficio
	$hoja->getPageSetup()->setScale(100);

	//Se indica el rango de filas que se van a repetir en el momento de imprimir. (Encabezado del reporte)
	$hoja->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(3);

	//Logo ANI
	$objDrawing2 = new PHPExcel_Worksheet_Drawing();
	$objDrawing2->setName('Logo ANI');
	$objDrawing2->setDescription('Logo de uso exclusivo de ANI');
	$objDrawing2->setPath('./images/logo_ani.jpg');
	$objDrawing2->setCoordinates($cabecera["logo_vinus"]);
	$objDrawing2->setWidth(85);
	$objDrawing2->setOffsetX(70);
	$objDrawing2->setOffsetY(4);
	$objDrawing2->setWorksheet($hoja);

	//Logo Vinus
	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('Logo Vinus');
	$objDrawing->setDescription('Logo de uso exclusivo de Vinus');
	$objDrawing->setPath('./images/logo_vinus.jpg');
	$objDrawing->setCoordinates($cabecera["logo_ani"]);
	$objDrawing->setHeight(65);
	$objDrawing->setOffsetX(22);
	$objDrawing->setOffsetY(2);
	$objDrawing->getShadow()->setDirection(160);
	$objDrawing->setWorksheet($hoja);

	// Celdas a combinar
	$hoja->mergeCells($cabecera["celda_logo_ani"]);
	$hoja->mergeCells($cabecera["celda_proyecto"]);
	$hoja->mergeCells($cabecera["celda_titulo"]);
	$hoja->mergeCells($cabecera["celda_descripcion"]);
	$hoja->mergeCells($cabecera["celda_logo_vinus"]);
	$hoja->mergeCells($cabecera["celda_codigo_titulo"]);
	$hoja->mergeCells($cabecera["celda_version_titulo"]);
	$hoja->mergeCells($cabecera["celda_creado_titulo"]);
	$hoja->mergeCells($cabecera["celda_version"]);
	$hoja->mergeCells($cabecera["celda_codigo"]);
	$hoja->mergeCells($cabecera["celda_creado"]);

	// Definicion de la altura de las celdas
	$hoja->getRowDimension(1)->setRowHeight(20);
	$hoja->getRowDimension(2)->setRowHeight(20);
	$hoja->getRowDimension(3)->setRowHeight(20);
	$hoja->getRowDimension(4)->setRowHeight(5);

	// Encabezados
	$hoja->setCellValue($cabecera["codigo_titulo"], "Código");
	$hoja->setCellValue($cabecera["version_titulo"], "Versión");
	$hoja->setCellValue($cabecera["creado_titulo"], "Creado");
	$hoja->setCellValue($cabecera["codigo"], "F000");
	$hoja->setCellValue($cabecera["version"], "V1.00");
	$hoja->setCellValue($cabecera["fecha"], "05/06/2016");
	$hoja->setCellValue($cabecera["proyecto"], "CONCESIÓN VÍAS DEL NUS - VINUS");
	$hoja->setCellValue($cabecera["titulo_informe"], "INFORME GERENCIAL");
	$hoja->setCellValue($cabecera["descripcion_celda"], $cabecera["descripcion"]);







	// Pié de página
	// $hoja->getHeaderFooterimplicadossetOddFooter('&L&B' .$accidentalidad->getProperties()->getTitle() . '&RPágina &P de &N');
}



// Create new PHPExcel object
// echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

//Se establece la configuracion general
$objPHPExcel->getProperties()
	->setCreator("John Arley Cano Salinas - Concesión Vías del NUS S.A.S.")
	->setLastModifiedBy("John Arley Cano Salinas")
	->setTitle("Sistema de Gestión de Operaciones - Generado el ".formatear_fecha(date("Y-m-d")).' - '.date('h:i A'))
	->setSubject("Informe gerencial mensual")
	->setDescription("Formato Informe gerencial mensual")
	->setKeywords("informe mensual gerencial operaciones vinus")		
    ->setCategory("Reporte");

/*******************************************************
 *********************** Estilos ***********************
 *******************************************************/
$centrado = array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER ) ); // Alineación centrada
$bordes = array( 'borders' => array( 'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array( 'argb' => '000000' ) ), ), );
$borde_negrita_externo = array( 'borders' => array( 'outline' => array( 'style' => PHPExcel_Style_Border::BORDER_THICK, 'color' => array('argb' => '000000'), ), ), );
$tamanio8 = array ( 'font' => array( 'size' => 8 ) );
$negrita = array( 'font' => array( 'bold' => true ) );

/*******************************************************************************
**************************** Hoja de accidentalidad ****************************
********************************************************************************/
$accidentalidad = $objPHPExcel->getActiveSheet();
$accidentalidad->setTitle("Accidentalidad"); // Título de la hoja

// Consulta de accidentes
$sql_accidentes="Select * from tbl_accidente where fec_con between '{$fecha_inicial}' and '{$fecha_final}' order by fec_con";
$accidentes = mysql_query($sql_accidentes,$link);

// Arreglo para definir las celdas límite y textos para la cabecera
$cabecera = array(
	"celda_logo_ani" => "A1:D3",
	"celda_logo_vinus" => "AK1:AN3",
	"celda_proyecto" => "E1:AJ1",
	"celda_titulo" => "E2:AJ2",
	"celda_codigo_titulo" => "AO1:AQ1",
	"celda_version_titulo" => "AO2:AQ2",
	"celda_creado_titulo" => "AO3:AQ3",
	"celda_descripcion" => "E3:AJ3",
	"celda_codigo" => "AR1:AS1",
	"celda_version" => "AR2:AS2",
	"celda_creado" => "AR3:AS3",
	"logo_vinus" => "A1",
	"logo_ani" => "AK1",
	"codigo_titulo" => "AO1",
	"version_titulo" => "AO2",
	"creado_titulo" => "AO3",
	"codigo" => "AR1",
	"version" => "AR2",
	"fecha" => "AR3",
	"proyecto" => "E1",
	"titulo_informe" => "E2",
	"descripcion_celda" => "E3",
	"descripcion" => "REGISTRO DE ATENCION DE ACCIDENTES - ".strtoupper(formatear_fecha($fecha_inicial))." AL ".strtoupper(formatear_fecha($fecha_final))
);

// Se declaran las configuraciones de la hoja activa
configuracion($accidentalidad, $cabecera);

// Arreglo con encabezados
$titulos = array(
	"",
	"CONSECUTIVO",
	"PARTE",
	"FECHA",
	"HORA",
	"CÓDIGO VÍA",
	"CÓDIGO TRAMO",
	"CALZADA",
	"ABSCISA",
	"VEHÍCULOS INVOLUCRADOS",
	"CONOCIMIENTO",
	"ATENCIÓN",
	"FINALIZACIÓN",
	"CHOQUE CONTRA VEHÍCULO",
	"CHOQUE CONTRA OBJETO FIJO",
	"ATROPELLO",
	"VOLCAMIENTO",
	"CAÍDA DE OCUPANTE",
	"CHOQUE CONTRA SEMOVIENTE",
	"OTROS",
	"HERIDOS",
	"VÍCTIMAS FATALES",
	"EXCESO DE VELOCIDAD",
	"IMPRUDENCIA DE PEATÓN",
	"IMPRUDENCIA DE CONDUCTOR",
	"FALTA DE PRECAUCIÓN",
	"EMBRIAGUEZ",
	"FALLAS MECÁNICAS",
	"NO MANTENER DISTANCIA",
	"SEMOVIENTE EN LA VÍA",
	"ADELANTAR",
	"OTROS",
	"MOTOCICLETA (CONDUCTOR)",
	"MOTOCICLETA (PARRILLERO)",
	"VEHÍCULO (CONDUCTOR)",
	"VEHÍCULO (PASAJEROS)",
	"PEATÓN",
	"CICLISTA",
	"MOTOCICLETA (CONDUCTOR)",
	"MOTOCICLETA (PARRILLERO)",
	"VEHÍCULO (CONDUCTOR)",
	"VEHÍCULO (PASAJEROS)",
	"PEATÓN",
	"CICLISTA",
	"TIEMPO DE REACCIÓN",
	"TIEMPO DE ASISTENCIA",
);
	
// Declaración de fila y columna inicial
$columna = "A";
$fila = 4;
$fila++;

// Celdas a combinar
$accidentalidad->mergeCells("B{$fila}:I{$fila}");
$accidentalidad->mergeCells("J{$fila}:L{$fila}");
$accidentalidad->mergeCells("M{$fila}:S{$fila}");
$accidentalidad->mergeCells("T{$fila}:U{$fila}");
$accidentalidad->mergeCells("V{$fila}:AE{$fila}");
$accidentalidad->mergeCells("AF{$fila}:AK{$fila}");
$accidentalidad->mergeCells("AL{$fila}:AQ{$fila}");
$accidentalidad->mergeCells("AR{$fila}:AS{$fila}");

// Definicion de la altura de las filas
$accidentalidad->getRowDimension($fila)->setRowHeight(30);

// Encabezados
$accidentalidad->setCellValue("B{$fila}", "DATOS DEL ACCIDENTE");
$accidentalidad->setCellValue("J{$fila}", "HORAS");
$accidentalidad->setCellValue("M{$fila}", "TIPO DE ACCIDENTE");
$accidentalidad->setCellValue("V{$fila}", "HIPÓTESIS");
$accidentalidad->setCellValue("AF{$fila}", "HERIDOS");
$accidentalidad->setCellValue("AL{$fila}", "VÍCTIMAS FATALES");
$accidentalidad->setCellValue("AR{$fila}", "TIEMPOS DE RESPUESTA");

// Fila de títulos
$fila_titulos = $fila + 1;

// Recorrido de columnas
for ($i=1; $i <= 45 ; $i++) {
	// Tamaño de columnas
	$accidentalidad->getColumnDimension($columna)->setWidth(3.5);

	// Si hay valor en el arreglo para la columna
	if (isset($titulos[$i])) {
		// Encabezado
		$accidentalidad->setCellValue("{$columna}{$fila_titulos}", $titulos["$i"]);
	} // if

	// Aumento de columnas
	$columna++;
} // for

// Definición de altura de las filas
$accidentalidad->getRowDimension($fila_titulos)->setRowHeight(140);

// Estilos
$accidentalidad->getStyle("A1:AS3")->applyFromArray($bordes);
$accidentalidad->getStyle("A1:{$columna}{$fila_titulos}")->applyFromArray($centrado);


// AUmento de fila
$fila = $fila_titulos + 1;

// Columna y consecutivo
$columna = "A";
$consecutivo = 1;

// Declaración de contadores
$ch_contra_veh = 0;
$ch_contra_obj = 0;
$atropello = 0;
$volcamiento = 0;
$caida_del_ocu = 0;
$ch_contra_sem = 0;
$otros_acc = 0;
$exc_vel = 0;
$imp_peat = 0;
$imp_con = 0;
$falta_pre = 0;
$embri = 0;
$fallas = 0;
$no_dis = 0;
$sem_via = 0;
$ade_proh = 0;
$hip_otros = 0;

// Recorrido de accidentes
while($accidente = mysql_fetch_array($accidentes)) {
	// Datos del accidente
	$accidentalidad->setCellValue("A{$fila}", $consecutivo);
	$accidentalidad->setCellValue("B{$fila}", $accidente["id_parte"]);
	$accidentalidad->setCellValue("C{$fila}", date("d-m-Y", strtotime($accidente["fec_pro"])));
	$accidentalidad->setCellValue("D{$fila}", date("h:i", strtotime($accidente["fec_pro"])));
	$accidentalidad->setCellValue("E{$fila}", $accidente["via"]);
	$accidentalidad->setCellValue("F{$fila}", $accidente["tramo"]);
	$accidentalidad->setCellValue("G{$fila}", $accidente["calzada"]);
	$accidentalidad->setCellValue("H{$fila}", $accidente["abcisa"]);
	$accidentalidad->setCellValue("I{$fila}", numero_involucrados($accidente["id_parte"]));

	// Horas
	$accidentalidad->setCellValue("J{$fila}", date("h:i", strtotime($accidente["fec_con"])));
	$accidentalidad->setCellValue("K{$fila}", date("h:i", strtotime($accidente["fechahora_ini"])));
	$accidentalidad->setCellValue("L{$fila}", date("h:i", strtotime($accidente["fechahora_fin"])));

	// Tipo de accidente
	if($accidente["ch_contra_veh"] == "X"){$ch_contra_veh++;}
	if($accidente["ch_contra_obj"] == "X"){$ch_contra_obj++;}
	if($accidente["atropello"] == "X"){$atropello++;}
	if($accidente["volcamiento"] == "X"){$volcamiento++;}
	if($accidente["caida_del_ocu"] == "X"){$caida_del_ocu++;}
	if($accidente["ch_contra_sem"] == "X"){$ch_contra_sem++;}
	if(strlen($accidente["hip_otros"]) > 1){$otros_acc++;}
	
	$accidentalidad->setCellValue("M{$fila}", $accidente["ch_contra_veh"]);
	$accidentalidad->setCellValue("N{$fila}", $accidente["ch_contra_obj"]);
	$accidentalidad->setCellValue("O{$fila}", $accidente["atropello"]);
	$accidentalidad->setCellValue("P{$fila}", $accidente["volcamiento"]);
	$accidentalidad->setCellValue("Q{$fila}", $accidente["caida_del_ocu"]);
	$accidentalidad->setCellValue("R{$fila}", $accidente["ch_contra_sem"]);
	if(strlen($accidente["otros_acc"]) > 1 ) { $accidentalidad->setCellValue("S{$fila}", "X");}

	// Heridos y víctimas fatales
	$accidentalidad->setCellValue("T{$fila}", numero_heridos($accidente["id_parte"]));
	$accidentalidad->setCellValue("U{$fila}", numero_victimas($accidente["id_parte"]));
	
	// Hipótesis
	if($accidente["exc_vel"] == "X"){$exc_vel++;}
	if($accidente["imp_peat"] == "X"){$imp_peat++;}
	if($accidente["imp_con"] == "X"){$imp_con++;}
	if($accidente["falta_pre"] == "X"){$falta_pre++;}
	if($accidente["embri"] == "X"){$embri++;}
	if($accidente["fallas"] == "X"){$fallas++;}
	if($accidente["no_dis"] == "X"){$no_dis++;}
	if($accidente["sem_via"] == "X"){$sem_via++;}
	if($accidente["ade_proh"] == "X"){$ade_proh++;}
	if(strlen($accidente["hip_otros"]) > 1 ) { $hip_otros++;}


	$accidentalidad->setCellValue("V{$fila}", $accidente["exc_vel"]);
	$accidentalidad->setCellValue("W{$fila}", $accidente["imp_peat"]);
	$accidentalidad->setCellValue("X{$fila}", $accidente["imp_con"]);
	$accidentalidad->setCellValue("Y{$fila}", $accidente["falta_pre"]);
	$accidentalidad->setCellValue("Z{$fila}", $accidente["embri"]);
	$accidentalidad->setCellValue("AA{$fila}", $accidente["fallas"]);
	$accidentalidad->setCellValue("AB{$fila}", $accidente["no_dis"]);
	$accidentalidad->setCellValue("AC{$fila}", $accidente["sem_via"]);
	$accidentalidad->setCellValue("AD{$fila}", $accidente["ade_proh"]);
	if(strlen($accidente["hip_otros"]) > 1 ) { $accidentalidad->setCellValue("AE{$fila}", "X");}

	// Heridos
	$accidentalidad->setCellValue("AF{$fila}", numero_heridos_moto($accidente["id_parte"]));
	$accidentalidad->setCellValue("AG{$fila}", numero_heridos_parrillero_moto($accidente["id_parte"]));
	$accidentalidad->setCellValue("AH{$fila}", numero_heridos_conductor($accidente["id_parte"]));
	$accidentalidad->setCellValue("AI{$fila}", numero_heridos_pasajero($accidente["id_parte"]));
	$accidentalidad->setCellValue("AJ{$fila}", numero_heridos_peaton($accidente["id_parte"]));
	$accidentalidad->setCellValue("AK{$fila}", numero_heridos_ciclista($accidente["id_parte"]));

	// Víctimas fatales
	$accidentalidad->setCellValue("AL{$fila}", numero_victimas_moto($accidente["id_parte"]));
	$accidentalidad->setCellValue("AM{$fila}", numero_victimas_parrillero_moto($accidente["id_parte"]));
	$accidentalidad->setCellValue("AN{$fila}", numero_victimas_conductor($accidente["id_parte"]));
	$accidentalidad->setCellValue("AO{$fila}", numero_victimas_pasajero($accidente["id_parte"]));
	$accidentalidad->setCellValue("AP{$fila}", numero_victimas_peaton($accidente["id_parte"]));
	$accidentalidad->setCellValue("AQ{$fila}", numero_victimas_ciclista($accidente["id_parte"]));

	// Tiempos de respuesta
	$accidentalidad->setCellValue("AR{$fila}", "=MINUTE(K{$fila}-J{$fila})");
	$accidentalidad->setCellValue("AS{$fila}", "=MINUTE(L{$fila}-K{$fila})");





	// Aumento de fila y consecutivo
	$consecutivo++;
	$fila++;
} // while

$fila_suma_inicial = $fila_titulos+1;
$fila_suma_final = $fila-1;

// Celdas a combinar
$accidentalidad->mergeCells("A{$fila}:L{$fila}");

// Totales
$accidentalidad->setCellValue("A{$fila}", "TOTALES");

// Tipo de accidente
$accidentalidad->setCellValue("M{$fila}", $ch_contra_veh);
$accidentalidad->setCellValue("N{$fila}", $ch_contra_obj);
$accidentalidad->setCellValue("O{$fila}", $atropello);
$accidentalidad->setCellValue("P{$fila}", $volcamiento);
$accidentalidad->setCellValue("Q{$fila}", $caida_del_ocu);
$accidentalidad->setCellValue("R{$fila}", $ch_contra_sem);
$accidentalidad->setCellValue("S{$fila}", $otros_acc);

// Heridos y víctimas fatales
$accidentalidad->setCellValue("T{$fila}", "=SUM(T{$fila_suma_inicial}:T{$fila_suma_final})");
$accidentalidad->setCellValue("U{$fila}", "=SUM(U{$fila_suma_inicial}:U{$fila_suma_final})");

// Hipótesis
$accidentalidad->setCellValue("V{$fila}", $exc_vel);
$accidentalidad->setCellValue("W{$fila}", $imp_peat);
$accidentalidad->setCellValue("X{$fila}", $imp_con);
$accidentalidad->setCellValue("Y{$fila}", $falta_pre);
$accidentalidad->setCellValue("Z{$fila}", $embri);
$accidentalidad->setCellValue("AA{$fila}", $fallas);
$accidentalidad->setCellValue("AB{$fila}", $no_dis);
$accidentalidad->setCellValue("AC{$fila}", $sem_via);
$accidentalidad->setCellValue("AD{$fila}", $ade_proh);
$accidentalidad->setCellValue("AE{$fila}", $hip_otros);

// Columna
$columna = "AF";

// Recorrido para ahorrar columnas
for ($i=1; $i <= 12; $i++) { 
	// Heridos y víctimas fatales motocicletaqs, vehículos, peatones y ciclistas
	$accidentalidad->setCellValue("{$columna}{$fila}", "=SUM({$columna}{$fila_suma_inicial}:{$columna}{$fila_suma_final})");
	
	// Aumento de columna
	$columna++;
} // for


// Totales
// $accidentalidad->setCellValue("A15", "=COUNTIFS(M{$fila_titulos}:M{$fila};'X')");


// Estilos
$accidentalidad->getStyle("A5:AS{$fila}")->applyFromArray($bordes);
$accidentalidad->getStyle("A{$fila}:AS{$fila}")->applyFromArray($negrita);

// Tamaños de ciertas columnas
$accidentalidad->getColumnDimension("B")->setWidth(7);
$accidentalidad->getColumnDimension("C")->setWidth(13);
$accidentalidad->getColumnDimension("D")->setWidth(7);
$accidentalidad->getColumnDimension("E")->setWidth(7);
$accidentalidad->getColumnDimension("H")->setWidth(7);
$accidentalidad->getColumnDimension("J")->setWidth(7);
$accidentalidad->getColumnDimension("K")->setWidth(7);
$accidentalidad->getColumnDimension("L")->setWidth(7);
$accidentalidad->getColumnDimension("AR")->setWidth(8);
$accidentalidad->getColumnDimension("AS")->setWidth(8);

// Estilos
$accidentalidad->getStyle("A6:AS6")->getAlignment()->setTextRotation(90); // Rotar el texto
$accidentalidad->getStyle("A6:AS6")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM); // Alineación

/*******************************************************************************
****************************** Hoja de implicados ******************************
********************************************************************************/
$implicados = $objPHPExcel->createSheet(); //Nueva hoja
$implicados->setTitle("Implicados");//Titulo de la hoja

// Hoja activa
$objPHPExcel->setActiveSheetIndex(1);

// Consulta de implicados
$sql_involucrados="Select * from tbl_accidente, tbl_involucrados where tbl_accidente.fec_con between '{$fecha_inicial}' and '{$fecha_final}' and tbl_involucrados.id_parte=tbl_accidente.id_parte order by tbl_accidente.fec_con";
$involucrados = mysql_query($sql_involucrados,$link);

// Arreglo para definir las celdas límite y textos para la cabecera
$cabecera = array(
	"celda_logo_ani" => "A1:C3",
	"celda_logo_vinus" => "O1:Q3",
	"celda_proyecto" => "D1:N1",
	"celda_titulo" => "D2:N2",
	"celda_descripcion" => "D3:N3",
	"celda_codigo_titulo" => "R1:T1",
	"celda_version_titulo" => "R2:T2",
	"celda_creado_titulo" => "R3:T3",
	"celda_codigo" => "U1:W1",
	"celda_version" => "U2:W2",
	"celda_creado" => "U3:W3",
	"logo_vinus" => "A1",
	"logo_ani" => "O1",
	"codigo_titulo" => "R1",
	"version_titulo" => "R2",
	"creado_titulo" => "R3",
	"codigo" => "U1",
	"version" => "U2",
	"fecha" => "U3",
	"proyecto" => "D1",
	"titulo_informe" => "D2",
	"descripcion_celda" => "D3",
	"descripcion" => "REGISTRO DE VEHÍCULOS IMPLICADOS EN ACCIDENTES - ".strtoupper(formatear_fecha($fecha_inicial))." AL ".strtoupper(formatear_fecha($fecha_final))
);

// Se declaran las configuraciones de la hoja activa
configuracion($implicados, $cabecera);

// Arreglo con encabezados
$titulos = array(
	"",
	"CONSECUTIVO",
	"PARTE",
	"FECHA",
	"HORA",
	"VÍA",
	"TRAMO",
	"CALZADA",
	"ABSCISA",
	"TIPO",
	"PLACA",
	"MARCA",
	"CILINDRAJE",
	"HERIDOS",
	"VÍCTIMAS MORTALES",
	"INSPECTOR",
	"AMBULANCIA",
	"GRÚA",
	"DIRECTOR DE OPERACIONES",
	"AGENTES DE TRÁNSITO",
	"POLICÍA DE TRÁNSITO",
	"FISCALÍA",
	"SEÑALIZACIÓN",
	"BOMBEROS",
);

// Declaración de fila y columna inicial
$columna = "A";
$fila = 4;
$fila++;

// Celdas a combinar
$implicados->mergeCells("A{$fila}:L{$fila}");
$implicados->mergeCells("M{$fila}:W{$fila}");

// Definicion de la altura de las filas
$implicados->getRowDimension($fila)->setRowHeight(30);

// Encabezados
$implicados->setCellValue("A{$fila}", "DATOS DEL INCIDENTE");
$implicados->setCellValue("M{$fila}", "ATENCIÓN");

// Fila de títulos
$fila_titulos = $fila + 1;

// Tamaño de columnas
$implicados->getColumnDimension("A")->setWidth(5);
$implicados->getColumnDimension("B")->setWidth(9);
$implicados->getColumnDimension("C")->setWidth(15);
$implicados->getColumnDimension("D")->setWidth(9);
$implicados->getColumnDimension("E")->setWidth(9);
$implicados->getColumnDimension("F")->setWidth(9);
$implicados->getColumnDimension("G")->setWidth(9);
$implicados->getColumnDimension("H")->setWidth(9);
$implicados->getColumnDimension("I")->setWidth(15);
$implicados->getColumnDimension("J")->setWidth(15);
$implicados->getColumnDimension("K")->setWidth(15);
$implicados->getColumnDimension("L")->setWidth(9);
$implicados->getColumnDimension("M")->setWidth(5);
$implicados->getColumnDimension("N")->setWidth(5);
$implicados->getColumnDimension("O")->setWidth(5);
$implicados->getColumnDimension("P")->setWidth(5);
$implicados->getColumnDimension("Q")->setWidth(5);
$implicados->getColumnDimension("R")->setWidth(5);
$implicados->getColumnDimension("S")->setWidth(5);
$implicados->getColumnDimension("T")->setWidth(5);
$implicados->getColumnDimension("U")->setWidth(5);
$implicados->getColumnDimension("V")->setWidth(5);
$implicados->getColumnDimension("W")->setWidth(5);

// Recorrido de columnas
for ($i=1; $i <= 23 ; $i++) {
	// Si hay valor en el arreglo para la columna
	if (isset($titulos[$i])) {
		// Encabezado
		$implicados->setCellValue("{$columna}{$fila_titulos}", $titulos["$i"]);
	} // if

	// Aumento de columnas
	$columna++;
} // for

// Definición de altura de las filas
$implicados->getRowDimension($fila_titulos)->setRowHeight(140);

// Estilos
$implicados->getStyle("A1:W3")->applyFromArray($bordes);
$implicados->getStyle("A1:{$columna}{$fila_titulos}")->applyFromArray($centrado);

// AUmento de fila
$fila = $fila_titulos + 1;

// Columna y consecutivo
$columna = "A";
$consecutivo = 1;

// Declaración de contadores
$insp_vial = 0;
$ambulancia = 0;
$grua_con = 0;
$director_ope = 0;
$agentes_trans = 0;
$policia_trans = 0;
$fiscalia = 0;
$senalizacion = 0;
$bomberos = 0;

// Recorrido de incidentes
while($involucrado = mysql_fetch_array($involucrados)) {
	// Datos del accidente
	$implicados->setCellValue("A{$fila}", $consecutivo);
	$implicados->setCellValue("B{$fila}", $involucrado["id_parte"]);
	$implicados->setCellValue("C{$fila}", date("d-m-Y", strtotime($involucrado["fec_pro"])));
	$implicados->setCellValue("D{$fila}", date("h:i", strtotime($involucrado["fec_pro"])));
	$implicados->setCellValue("E{$fila}", $involucrado["via"]);
	$implicados->setCellValue("F{$fila}", $involucrado["tramo"]);
	$implicados->setCellValue("G{$fila}", $involucrado["calzada"]);
	$implicados->setCellValue("H{$fila}", $involucrado["abcisa"]);
	$implicados->setCellValue("I{$fila}", $involucrado["tipo_veh"]);
	$implicados->setCellValue("J{$fila}", $involucrado["placa_veh"]);
	$implicados->setCellValue("K{$fila}", $involucrado["marca_veh"]);
	$implicados->setCellValue("L{$fila}", $involucrado["cilindraje"]);

	// Heridos y víctimas mortales
	$implicados->setCellValue("M{$fila}", numero_heridos($involucrado["id_parte"]));
	$implicados->setCellValue("N{$fila}", numero_victimas($involucrado["id_parte"]));
	
	// Servicios
	if($involucrado["insp_vial"] == "X"){$insp_vial++;}
	if($involucrado["ambulancia"] == "X"){$ambulancia++;}
	if($involucrado["grua_con"] == "X"){$grua_con++;}
	if($involucrado["director_ope"] == "X"){$director_ope++;}
	if($involucrado["agentes_trans"] == "X"){$agentes_trans++;}
	if($involucrado["policia_trans"] == "X"){$policia_trans++;}
	if($involucrado["fiscalia"] == "X"){$fiscalia++;}
	if($involucrado["senalizacion"] == "X"){$senalizacion++;}
	if($involucrado["bomberos"] == "X"){$bomberos++;}

	$implicados->setCellValue("O{$fila}", $involucrado["insp_vial"]);
	$implicados->setCellValue("P{$fila}", $involucrado["ambulancia"]);
	$implicados->setCellValue("Q{$fila}", $involucrado["grua_con"]);
	$implicados->setCellValue("R{$fila}", $involucrado["director_ope"]);
	$implicados->setCellValue("S{$fila}", $involucrado["agentes_trans"]);
	$implicados->setCellValue("T{$fila}", $involucrado["policia_trans"]);
	$implicados->setCellValue("U{$fila}", $involucrado["fiscalia"]);
	$implicados->setCellValue("V{$fila}", $involucrado["senalizacion"]);
	$implicados->setCellValue("E{$fila}", $involucrado["bomberos"]);

	// Aumento de fila y consecutivo
	$consecutivo++;
	$fila++;
} // while

$fila_suma_inicial = $fila_titulos+1;
$fila_suma_final = $fila-1;

// Celdas a combinar
$implicados->mergeCells("A{$fila}:L{$fila}");

// Totales
$implicados->setCellValue("M{$fila}", "=SUM(M{$fila_suma_inicial}:M{$fila_suma_final})");
$implicados->setCellValue("N{$fila}", "=SUM(N{$fila_suma_inicial}:N{$fila_suma_final})");
$implicados->setCellValue("O{$fila}", $insp_vial);
$implicados->setCellValue("P{$fila}", $ambulancia);
$implicados->setCellValue("Q{$fila}", $grua_con);
$implicados->setCellValue("R{$fila}", $director_ope);
$implicados->setCellValue("S{$fila}", $agentes_trans);
$implicados->setCellValue("T{$fila}", $policia_trans);
$implicados->setCellValue("U{$fila}", $fiscalia);
$implicados->setCellValue("V{$fila}", $senalizacion);
$implicados->setCellValue("W{$fila}", $bomberos);

// Estilos
$implicados->getStyle("A5:W{$fila}")->applyFromArray($bordes);
$implicados->getStyle("A{$fila}:W{$fila}")->applyFromArray($negrita);

// Tamaños de ciertas columnas
// $implicados->getColumnDimension("B")->setWidth(7);

// Estilos
$implicados->getStyle("A6:W6")->getAlignment()->setTextRotation(90); // Rotar el texto
$implicados->getStyle("A6:W6")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM); // Alineación







/********************************************************************************
*********************************** Implicados ***********************************
*********************************************************************************/
// $implicados = $objPHPExcel->createSheet(); //Nueva hoja
// $implicados->setTitle("Implicados");//Titulo de la hoja

// Se declaran las configuraciones de la hoja activa
// configuracion($implicados);






// /**********************************************************************************
// ********************************** Grúa planchón **********************************
// ***********************************************************************************/
// $hoja = $objPHPExcel->createSheet(); //Nueva hoja
// $hoja->setTitle("Grúa planchón");//Titulo de la hoja

// // Se declaran las configuraciones de la hoja activa
// configuracion($objPHPExcel);











/*********************************************************************************
*********************************** Grúa pluma ***********************************
**********************************************************************************/
$pluma = $objPHPExcel->createSheet(); //Nueva hoja
$pluma->setTitle("Grúa pluma");//Titulo de la hoja

// Se declaran las configuraciones de la hoja activa
// configuracion($pluma);









/*********************************************************************************
********************************** Señalización **********************************
**********************************************************************************/
$planchon = $objPHPExcel->createSheet(); //Nueva hoja
$planchon->setTitle("Señalización");//Titulo de la hoja

// Se declaran las configuraciones de la hoja activa
// configuracion($planchon);















// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Cache-Control: max-age=0');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename='Informe gerencial.xlsx'");

//Se genera el excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>