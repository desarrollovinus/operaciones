<?php
session_start();
include 'funciones.php';

$tipo_us=$_SESSION["tipo"];
$link=Conectarse();
$placa= $_POST['buscar_placa'];

//Consulta que busca los involucrados con los datos de la placa ingresada en la búsqueda
// $consulta = mysql_query("SELECT * FROM  tbl_involucrados WHERE  placa_veh LIKE '%$placa%' ORDER BY  placa_veh", $link);
$consulta = mysql_query("
(
    SELECT
        inv.id_inv,
        inv.cedula,
        inv.id_parte,
        inv.nombre,
        inv.telefono,
        inv.celular,
        inv.placa_veh
    FROM
        tbl_involucrados AS inv
    WHERE
        inv.placa_veh LIKE '%$placa%'
    ORDER BY
        inv.placa_veh ASC
)
UNION
    (
        SELECT
            i.id_incidente,
            i.us_ced,
            i.id_parte,
            i.us_nombre,
            i.us_tel,
            '' AS cel,
            i.us_placa_veh
        FROM
            tbl_incidente AS i
        WHERE
            i.us_placa_veh LIKE '%$placa%'
    )", $link);
$result=  mysql_num_rows($consulta)

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Consutar placa</title>
    </head>
    <body
        <div id="selec_ver">
            <div class="log_placa">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <div class="ver_parte">
                    <?php
                    $tabla_placas = '<table border="1" cellspacing="1" cellpading=1 width="60%" align="center">';
                    $tabla_placas .= "<thead>";
                    $tabla_placas .= "<tr>";
                    $tabla_placas .= "<th width='10%'>Nro.</th>";
                    $tabla_placas .= "<th width='40%'>Placa</th>";
                    $tabla_placas .= "<th width='40%'>Número de parte</th>";
                    $tabla_placas .= "<th width='10%'>Ver</th>";
                    $tabla_placas .= "</tr>";
                    $tabla_placas .= "</thead>";
                    
                    $tabla_placas .= "<tbody>";
                    
                    for ($item=1; $item < $result+1; $item++){
                        $row = mysql_fetch_array($consulta);
                        $array_result[$item] = $row[0];
                        //echo $array_result[$item];
                        
                        $tabla_placas .= "<tr>";
                        $tabla_placas .= "<td align='right'>".$item."&nbsp;</td>";
                        $tabla_placas .= "<td>&nbsp;".$row[6]."</td>";
                        $tabla_placas .= "<td align='right'>".$row[2]."&nbsp;</td>";
                        $tabla_placas .= "<td align='center'><a href='ver_parte.php?ver_parte=".$row[2]."'><img src='images/buscar.png'></a></td>";
                        $tabla_placas .= "</tr>"; 
                    }
                    
                    if($result > 0){
                        echo "<br><b>Se encontraron ".number_format($result)." coincidencias con el registro ".$placa.":<br><br>".$tabla_placas;
                    }else{
                        echo "<br><b>No se encontraron coincidencias para la b&uacute;squeda de ".$placa.". Por favor busque nuevamente<br><br>".$tabla_placas;
                    }
                    ?>
                </div>
                <div>
                    <input type="button" id="atras"  value="Volver a buscar" name="atras" onclick="location.href='buscar_placa.php'" class="bot"/>
                    <input type="button" id="atras"  value="Regresar" name="atras" <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                </div>
            </div> 
        </div>
    </body>
</html>