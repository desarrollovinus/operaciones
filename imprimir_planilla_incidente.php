<?php
date_default_timezone_set('America/Bogota');
    //Inclusión de librerías
    include_once 'class.ezpdf.php';
    include_once 'funciones.php';

    $id_parte = $_GET["parte"];
    
    //Se abre una conexion con la base de datos
    $link = Conectarse();
    mysql_set_charset('latin1',$link);

    //Se da el formato a la hoja
    $pdf =& new Cezpdf('LETTER','portrait');
    $pdf->selectFont('../fonts/arial.afm');
    $pdf->ezSetCmMargins(1,1,1.5,1.5);
    $pdf->ezStartPageNumbers(580,20,10,'','Grupo Ejecutor Hatovial S.A.S - Pagina {PAGENUM} de {TOTALPAGENUM}',1);

    //Logo del informe
    $pdf->ezImage("images/logo_backup.jpg", 0, 150, 'none', 'left');
    //Título del informe
    $pdf->ezText("Informe del parte ".$id_parte, 20);

    //Consulta que trae el número del parte
    $sql = "SELECT * FROM tbl_parte where id_parte='$id_parte'";
    $rs = mysql_query($sql,$link);
    $parte = mysql_fetch_array($rs);
    
    //Consulta que trae el usuario del parte seleccionado
    $sql = "SELECT * FROM tbl_usuarios where id_usuario='".$parte['usuario']."'";
    $rs = mysql_query($sql,$link);
    $usuario = mysql_fetch_array($rs);
    
    //Consulta que trae y muestra otros datos del usuario y fecha de impresión del reporte
    $pdf->ezText("Inspector: <b>".$usuario["us_nombre"]." ".$usuario["us_apellido"]."</b>", 12);
    $pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
    $pdf->ezText("\n", 10);
    
    //Consulta que trae el incidente respectivo
    $sql = "SELECT * FROM tbl_incidente where id_parte='$id_parte'";
    $rs = mysql_query($sql,$link);

    $titulos= array(
        'via'=>utf8_decode('<b>VÍA</b>'),
        'tramo'=>utf8_decode('<b>TRAMO</b>'),
        'calzada'=>  utf8_decode('<b>CALZADA</b>'),
        'abscisa'=>  utf8_decode('<b>ABSCISA</b>')
        );

    $opciones = array(
        'shadeCol' => array(0.9,0.9,0.9),
        'xOrientation' =>'center', 
        'textCol' => array(0,0,0),
        'width' => 520, 
        'setColor' => array(0.8,0.8,0.8),
        'fontSize' => 10, 
        'cols' => array()
        );

    while($temp = mysql_fetch_array($rs)) {
            $abscisa = trim($temp["abcisa"]);
            $ms = substr($abscisa, -3);
            $kms = substr($abscisa, 0, strlen($abscisa) - 3);
            if($kms == "") {
                    $kms = "0";
            }
            $temp[3] = "K".$kms."+".$ms;
            $temp["abscisa"] = "K".$kms."+".$ms;
            $data[] = array_merge($temp);
    }
    
    //Pinta la tabla
    $pdf->ezTable($data, $titulos, '', $opciones);
    $pdf->ezText("\n", 10);
    
    //Consulta que me trae los datos del incidente
    $sql = "SELECT * FROM tbl_incidente where id_parte='$id_parte'";
    $rs = mysql_query($sql,$link);
    $incidente = mysql_fetch_assoc($rs);
    
    //Datos del incidente
    $pdf->ezText("DATOS DEL INCIDENTE", 15);
    $pdf->ezText("\n", 5);
    
    $pdf->ezText(utf8_decode("<b>Fecha y hora en la que se tuvo conocimiento del accidente:</b>          ").$incidente["h_ini_inc"], 10);
    $pdf->ezText(utf8_decode("<b>Fecha y hora de atención:</b>                                                               ").$incidente["h_fin_inc"], 10);
    
    //Tipo de incidente
    $pdf->ezText("\n", 10);
    $pdf->ezText("TIPO DE INCIDENTE", 15);
    $pdf->ezText("\n", 5);
    
    //Define cuál es el incidente, buscando el campo marcado con X en la base de datos
    if($incidente['acc_trabajo']=='X'){
        $pdf->ezText(utf8_decode('Accidente de trabajo'), 10);
    }
    if($incidente['per_muerta_via']=='X'){
        $pdf->ezText(utf8_decode('Persona muerta en la vía'), 10);
    }
    if($incidente['prim_aux']=='X'){
        $pdf->ezText(utf8_decode('Primeros auxilios'), 10);
    }
    if($incidente['veh_aban']=='X'){
        $pdf->ezText(utf8_decode('Vehículo abandonado'), 10);
    }
    if($incidente['veh_inmov']=='X'){
        $pdf->ezText(utf8_decode('Vehículo inmovilizado'), 10);
    }
    if($incidente['escom_via']=='X'){
        $pdf->ezText(utf8_decode('Escombros en la vía'), 10);
    }
    if($incidente['obs_via']=='X'){
        $pdf->ezText(utf8_decode('Obstáculos en la vía'), 10);
    }
    if($incidente['sem_muerto']=='X'){
        $pdf->ezText(utf8_decode('Semoviente muerto'), 10);
    }
    if($incidente['veh_varado']=='X'){
        $pdf->ezText(utf8_decode('Vehículo varado'), 10);
    }
    if($incidente['otros']<>''){
        if($incidente['otros']=='X'){
            $pdf->ezText(utf8_decode('Otro tipo de incidente'), 10); 
        }else{
            $pdf->ezText($incidente[utf8_decode('otros')], 10);            
            }
    }
    
    //Involucrados en el incidente
    $pdf->ezText("\n", 10);
    $pdf->ezText(utf8_decode("INFORMACIÓN DEL USUARIO"), 15);
    $pdf->ezText("\n", 5);
    
    $titulos= array(
        'us_nombre'=> utf8_decode('<b>NOMBRE</b>'),
        'us_ced'=> utf8_decode('<b>CÉDULA</b>'),
        'us_tel'=> utf8_decode('<b>TELÉFONO</b>'),
        'us_placa_veh'=> utf8_decode('<b>PLACA</b>'),
        'us_color_veh'=> utf8_decode('<b>COLOR</b>'),
        'us_marca_veh'=> utf8_decode('<b>MARCA</b>'),
        'us_serv_veh'=> utf8_decode('<b>SERVICIO</b>'),
        'us_tipo_veh'=> utf8_decode('<b>TIPO</b>')
        );
        
    $opciones = array(
        'shadeCol' => array(0.9,0.9,0.9),
        'xOrientation' =>'center',
        'textCol' => array(0,0,0),
        'width' => 500,
        'setColor' => array(0.8,0.8,0.8),
        'fontSize' => 7,
        );

    $data = array();
    $sql = "SELECT * FROM tbl_incidente where id_parte='$id_parte'";
    $rs = mysql_query($sql,$link);
    while($involucrados = mysql_fetch_array($rs)) {
        $data[] = array_merge($involucrados);
    }
    
    $pdf->ezTable($data, $titulos, '', $opciones);
    
    //Descripción de los hechos
    $pdf->ezText("\n", 10);
    $pdf->ezText(utf8_decode("DESCRIPCIÓN"), 15);
    $pdf->ezText("\n", 5);
    $pdf->ezText(utf8_decode($incidente['descrip']), 10);
    
    //Añadir una nueva página para el registro fotográfico
    $pdf->ezNewPage();
    
    $pdf->ezText(utf8_decode("REGISTRO FOTOGRÁFICO"), 15);
    $pdf->ezText("\n", 5);
    
    $dir = "files/$id_parte";
    if((is_dir($dir))==''){
        $pdf->ezText(utf8_decode("No hay registro fotográfico del incidente."), 10);        
        }else{
            $directorio=opendir($dir);            
            while ($archivo = readdir($directorio)){
                if($archivo!= "." && $archivo != ".." && $archivo!="Thumbs.db"){
                    $pdf->ezText("\n", 5);
                    $pdf->ezImage("$dir/$archivo", 0, 250, 'none', 'center');                    
                }
        }
        closedir($directorio);
        }
    
    //Limpia y deshabilta los búferes de salida (Evita que se generen errores al imprimir el PDF)
    ob_end_clean();
    
    //Generar el documento
    $pdf->ezStream();
?>
