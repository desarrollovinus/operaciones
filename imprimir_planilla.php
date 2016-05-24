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
    $pdf->ezText("<b>Informe del parte $id_parte</b>", 20);

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

    //Consulta que trae el accidente respectivo
    $sql = "SELECT * FROM tbl_accidente where id_parte='$id_parte'";
    $rs = mysql_query($sql,$link);

    $titulos= array(
        'via'=> utf8_decode('<b>VÍA</b>'),
        'tramo'=> utf8_decode('<b>TRAMO</b>'),
        'calzada'=> utf8_decode('<b>CALZADA</b>'),
        'abcisa'=> utf8_decode('<b>ABSCISA</b>')
        );
    
    $opciones = array(
        'shadeCol' => array(0.9,0.9,0.9),
        'xOrientation' =>'center', 
        'textCol' => array(0,0,0),
        'width' => 500, 
        'setColor' => array(0.8,0.8,0.8),
        'fontSize' => 10, 
        'cols' => array()
        );

    while($temp = mysql_fetch_array($rs)){
        $abscisa = trim($temp["abcisa"]);
        $ms = substr($abscisa, -3);
        $kms = substr($abscisa, 0, strlen($abscisa) - 3);
        if($kms == ""){
            $kms = "0";
            }
        $temp[3] = "K".$kms."+".$ms;
        $temp["abcisa"] = "K".$kms."+".$ms;
        $data[] = array_merge($temp);
    }

    //Pinta la tabla
    $pdf->ezTable($data, $titulos, '', $opciones);
    $pdf->ezText("\n", 10);
    
    //Consulta que me trae los datos del incidente
    $sql = "SELECT * FROM tbl_accidente where id_parte='$id_parte'";
    $rs = mysql_query($sql,$link);
    $accidente = mysql_fetch_assoc($rs);
    
    //Punto de referencia y nombre del tramo
    $pdf->ezText("<b>Punto de referencia:</b>     ".$accidente["punto_referencia"], 10);
    $pdf->ezText("<b>Nombre del tramo:</b>        ".$accidente["nombre_tramo"], 10);

    //Datos del accidente
    $pdf->ezText("\n", 10);
    $pdf->ezText("DATOS DEL ACCIDENTE", 15);
    $pdf->ezText("\n", 5);

    
    $pdf->ezText(utf8_decode("<b>Fecha y hora en la que se produjo:</b>                                        ").$accidente["fec_pro"], 10);
    $pdf->ezText(utf8_decode("<b>Fecha y hora en la que se tuvo conocimiento del accidente:</b> ").$accidente["fec_con"], 10);
    $pdf->ezText(utf8_decode("<b>Fecha y hora de atención:</b>                                                      ").$accidente["fechahora_ini"], 10);
    $pdf->ezText(utf8_decode("<b>Fecha y hora en la que se terminó de prestar el servicio:</b>      ").$accidente["fechahora_fin"], 10);
    
    //Eventos del accidente
    $pdf->ezText("\n", 10);
    $pdf->ezText("EVENTOS", 15);
    $pdf->ezText("\n", 5);
    
    $pdf->ezText(utf8_decode("<b>Carriles obstruidos:</b> ").$accidente["carriles_obs"], 10);
    $pdf->ezText(utf8_decode("<b>¿Hubo fuego?:</b> ").$accidente["fuego"], 10);
    $pdf->ezText(utf8_decode("<b>¿Hubo daños en la obra?:</b> ").$accidente["danos_obra"], 10);
    
    //Tipo de accidente
    $pdf->ezText("\n", 10);
    $pdf->ezText("TIPO DE ACCIDENTE", 15);
    $pdf->ezText("\n", 5);
    
    //Define cuál es el accidente, buscando el campo marcado con X en la base de datos
    if($accidente["ch_contra_veh"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Choque contra vehículo</b>"), 10);
    }
    if($accidente["ch_contra_obj"]=='X'){
            $pdf->ezText(utf8_decode("<b>-Choque contra objeto fijo</b>"), 10);
    }
    if($accidente["atropello"]=='X'){
            $pdf->ezText(utf8_decode("<b>-Atropello</b>"), 10);
    }
    if($accidente["volcamiento"]=='X'){
            $pdf->ezText(utf8_decode("<b>-Volcamiento</b>"), 10);
    }
    if($accidente["caida_del_ocu"]=='X'){
            $pdf->ezText(utf8_decode("<b>-Caída del ocupante</b>"), 10);
    }
    if($accidente["ch_contra_sem"]=='X'){
            $pdf->ezText("<b>-Choque con semoviente</b>", 10);
    }
    if($accidente["ch_contra_metro"]=='X'){
            $pdf->ezText(utf8_decode("<b>-Choque con metro o tren</b>"), 10);
    }
    if($accidente["otros_acc"] != '') {
            $pdf->ezText(utf8_decode("<b>-".$accidente["otros_acc"]."</b> "), 10);
    }

    //Involucrados en el accidente
    $pdf->ezText("\n", 10);
    $pdf->ezText("INVOLUCRADOS", 15);
    $pdf->ezText("\n", 5);

    $titulos= array(
        'nombre'=> utf8_decode('<b>NOMBRE</b>'),
        'cedula'=> utf8_decode('<b>CÉDULA</b>'),
        'telefono'=> utf8_decode('<b>TELÉFONO</b>'),
        'celular'=> utf8_decode('<b>CELULAR</b>'),
        'placa_veh'=> utf8_decode('<b>PLACA</b>'),
        'color_veh'=> utf8_decode('<b>COLOR</b>'),
        'marca_veh'=> utf8_decode('<b>MARCA</b>'),
        'servicio_veh'=> utf8_decode('<b>SERVICIO</b>'),
        'tipo_veh'=> utf8_decode('<b>TIPO</b>'),
        'cilindraje'=> utf8_decode('<b>CILINDRAJE</b>')
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
    $sql = "SELECT * FROM tbl_involucrados where id_parte='$id_parte'";
    $rs = mysql_query($sql,$link);
    while($involucrados = mysql_fetch_array($rs)){
        $data[] = array_merge($involucrados);
    }

    $pdf->ezTable($data, $titulos, '', $opciones);

    //Víctimas
    $pdf->ezText("\n", 10);
    $pdf->ezText(utf8_decode("VÍCTIMAS"), 15);
    $pdf->ezText("\n", 5);

    $titulos= array(
        'nombre_vic'=> utf8_decode('<b>NOMBRE</b>'),
        'cedula'=> utf8_decode('<b>CÉDULA</b>'),
        'estado_vic'=> utf8_decode('<b>ESTADO</b>'),
        'relacion_vic'=> utf8_decode('<b>TIPO DE VÍCTIMA</b>')
    );

    $opciones = array(
        'shadeCol' => array(0.9,0.9,0.9),
        'xOrientation' =>'center',
        'textCol' => array(0,0,0),
        'width' => 500,
        'setColor' => array(0.8,0.8,0.8),
        'fontSize' => 8,
        'cols' => array()
    );

    $data = array();
    $sql = "SELECT * FROM tbl_victimas where id_parte='$id_parte'";
    $rs = mysql_query($sql,$link);
    while($victimas = mysql_fetch_array($rs)){
        $victimas[4] = utf8_decode($victimas[4]);
        $victimas["nombre_vic"] = utf8_decode($victimas["nombre_vic"]);
        $data[] = array_merge($victimas);
    }

    $pdf->ezTable($data, $titulos, '', $opciones);

    //Servicio presente
    $pdf->ezText("\n", 10);
    $pdf->ezText(utf8_decode("SERVICIO PRESENTE PARA LA ATENCIÓN"), 15);
    $pdf->ezText("\n", 5);

    if($accidente["ambulancia"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Ambulancia</b>"), 10);
    }
    if($accidente["bomberos"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Bomberos</b>"), 10);
    }
    if($accidente["insp_vial"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Inspector vial</b>"), 10);
    }
    if($accidente["grua_con"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Grúa de la concesión</b>"), 10);
    }
    if($accidente["defensa_civil"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Defensa Civil</b>"), 10);
    }
    if($accidente["policia_trans"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Policía de tránsito</b>"), 10);
    }
    if($accidente["agentes_trans"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Agentes de tránsito</b>"), 10);
    }
    if($accidente["fiscalia"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Fiscalía</b>"), 10);
    }
    if($accidente["mantenimiento"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Personal de mantenimiento</b>"), 10);
    }
    if($accidente["senalizacion"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Señalización</b>"), 10);
    }
    if($accidente["director_ope"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Director de operaciones</b>"), 10);
    }
    if($accidente["residente_ope"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Residente de operaciones</b>"), 10);
    }
    if($accidente["policia_nal"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Policía Nacional</b>"), 10);
    }
    if($accidente["policia_carreteras"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Policía de carreteras</b>"), 10);
    }
    if($accidente["otros_serv"]!=''){
        $pdf->ezText(utf8_decode("<b>-".$accidente["otros_serv"]."</b>"), 10);
    }

    //Condiciones de la vía
    $pdf->ezText("\n", 10);
    $pdf->ezText(utf8_decode("CONDICIONES DE LA VÍA EN EL MOMENTO DEL ACCIDENTE"), 15);
    $pdf->ezText("\n", 5);

    $titulos= array(
        'iluminacion'=>utf8_decode('<b>ILUMINACIÓN</b>'),
        'rodadura'=>utf8_decode('<b>RODADURA</b>'),
        'roda_lim'=>utf8_decode('<b>LIMPIEZA DE LA RODADURA</b>'),
        'trafico'=>utf8_decode('<b>TRÁFICO</b>'),
        'danos_auto'=>utf8_decode('<b>DAÑOS A LA VÍA</b>')
    );

    $opciones = array(
        'shadeCol' => array(0.9,0.9,0.9),
        'xOrientation' =>'center',
        'textCol' => array(0,0,0),
        'width' => 500,
        'setColor' => array(0.8,0.8,0.8),
        'fontSize' => 10
    );

    $data = array(
        0 => array(
            0 => $accidente["iluminacion"],
            "iluminacion" => $accidente["iluminacion"],
            1 => $accidente["rodadura"],
            "rodadura" => $accidente["rodadura"],
            2 => $accidente["roda_lim"],
            "roda_lim" => $accidente["roda_lim"],
            3 => $accidente["trafico"],
            "trafico" => $accidente["trafico"],
            4 => $accidente["danos_auto"],
            "danos_auto" => utf8_decode($accidente["danos_auto"]) 
            )
    );

    $pdf->ezTable($data, $titulos, '', $opciones);
    
    //Hipótesis
    $pdf->ezText("\n", 10);
    $pdf->ezText(utf8_decode("HIPÓTESIS"), 15);
    $pdf->ezText("\n", 5);

    if($accidente["embri"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Estado de embriaguez</b>"), 10);
    }
    if($accidente["exc_vel"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Exceso de velocidad</b>"), 10);
    }
    if($accidente["fallas"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Fallas mecánicas</b>"), 10);
    }
    if($accidente["falta_pre"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Falta de precaución</b>"), 10);
    }
    if($accidente["no_dis"]=='X'){
        $pdf->ezText(utf8_decode("<b>-No se conservó la distancia</b>"), 10);
    }
    if($accidente["obs_via"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Obstáculos en la vía</b>"), 10);
    }
    if($accidente["sup_hum"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Supeficie húmeda</b>"), 10);
    }
    if($accidente["ade_proh"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Adelantamiento en sitio prohibido</b>"), 10);
    }
    if($accidente["imp_con"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Imprudencia del conductor</b>"), 10);
    }
    if($accidente["mal_est"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Vehículo mal estacionado</b>"), 10);
    }
    if($accidente["obras_via"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Obras en la vía</b>"), 10);
    }
    if($accidente["imp_peat"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Imprudencia del peatón</b>"), 10);
    }
    if($accidente["contravia"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Vehículo en contravía</b>"), 10);
    }
    if($accidente["sem_via"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Semoviente en la vía</b>"), 10);
    }
    if($accidente["huecos_via"]=='X'){
        $pdf->ezText(utf8_decode("<b>-Huecos en la vía</b>"), 10);
    }
    if($accidente["hip_otros"]!=''){
        $pdf->ezText(utf8_decode("<b>-".$accidente["hip_otros"]."</b>"), 10);
    }

    //Descripción de los hechos
    $pdf->ezText("\n", 10);
    $pdf->ezText(utf8_decode("DESCRIPCIÓN DE LOS HECHOS"), 15);
    $pdf->ezText("\n", 5);
    $pdf->ezText(utf8_decode($accidente["descripcion"]) , 10);

    //Añadir una nueva página para el registro fotográfico
    $pdf->ezNewPage();

    $pdf->ezText(utf8_decode("REGISTRO FOTOGRÁFICO"), 15);
    $pdf->ezText("\n", 5);
    
    $dir = "files/$id_parte";
    if((is_dir($dir))==''){
        $pdf->ezText(utf8_decode("No hay registro fotográfico del accidente."), 10);
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
    
    // generar el documento
    $pdf->ezStream();
?>