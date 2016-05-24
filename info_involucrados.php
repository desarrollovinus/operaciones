<?php
date_default_timezone_set('America/Bogota');
	session_start();
?>
<html>
    <head>
        <title>Informe de Involucrados</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>
        <form action="info_excel.php" method="POST">
            <h1>INFORME DE INVOLUCRADOS</h1>
            <div style="padding-bottom: 20px;">
                <input type="submit" name="excel" id="bot" value="Generar Involucrados en Excel" >
                <input type="button" name="regresar" id="bot" value="Regresar" onclick="location.href='informes.php'" >
            </div>
            <?php
                include("funciones.php");
                $link = Conectarse();
                $f_ini = $_POST['pri_fec'];
                $f_fin = $_POST['seg_fec'];


                $x = 1; //dias a sumar
                $fecha = date("Y-m-d", strtotime("$f_fin + ". $x ." days")); //se suman los $x dias

                $consulta = "Select * from tbl_accidente, tbl_involucrados where tbl_accidente.fec_con between '$f_ini' and '$fecha' and tbl_involucrados.id_parte=tbl_accidente.id_parte order by tbl_accidente.fec_con";
                $result = mysql_query($consulta,$link);

                $tablaexcelinv='
                <TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="1600px">
                    <TR align="center">
                        <TD width="5%">&nbsp;<b>CONSECUTIVO</b></TD>
                        <TD width="5%">&nbsp;<b>PARTE</b>&nbsp;</TD>
                        <TD width="10%"><b>FECHA</b></TD>
                        <TD width="150px">&nbsp;<b>HORA</b>&nbsp;</TD>
                        <TD width=" 5%">&nbsp;<b>V&Iacute;A</b>&nbsp;</TD>
                        <TD width="5%">&nbsp;<b>TRAMO</b>&nbsp;</TD>
                        <TD width="5%">&nbsp;<b>CALZADA</b>&nbsp;</TD>
                        <TD width="5%">&nbsp;<b>ABSCISA</b>&nbsp;</TD>
                        <TD width="157px" >&nbsp;<b>TIPO VEH&Iacute;CULO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>PLACA VEH&Iacute;CULO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>MARCA VEH&Iacute;CULO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>CILINDRAJE DEL VEH&Iacute;CULO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>HERIDOS DEL VEH&Iacute;CULO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>MUERTOS DEL VEH&Iacute;CULO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>INSPECTOR</b>&nbsp;</TD>
                        <TD>&nbsp;<b>AMBULANCIA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>GR&Uacute;A</b>&nbsp;</TD>
                        <TD>&nbsp;<b>DIRECTOR OPERACIONES</b>&nbsp;</TD>
                        <TD>&nbsp;<b>AGENTES TR&Aacute;NSITO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>POLIC&Iacute;A</b>&nbsp;</TD>
                        <TD>&nbsp;<b>FISCAL&Iacute;A</b>&nbsp;</TD>
                        <TD>&nbsp;<b>SE&Ntilde;ALIZACI&Oacute;N</b>&nbsp;</TD>
                        <TD>&nbsp;<b>BOMBEROS</b>&nbsp;</TD>
                    </TR>';

                    $cont = 0;
                    while($row = mysql_fetch_array($result)) {

                    $cont++;
                    /*----------------------------Consulta Numero de Involucrados----------------------------------------*/
                    $invol = "select * from tbl_involucrados where id_inv='".$row['id_inv']."' and ";
                    $res = mysql_query($invol,$link);
                    //$rowinv = mysql_fetch_array($res);

                    /*----------------------------Consulta Numero de Heridos-----------------------------------------------*/
                    $vic = "select count(estado_vic) from tbl_victimas where id_parte='$row[id_parte]' and estado_vic='herido' and placa_veh_vic = '$row[placa_veh]' and relacion_vic!='peaton'";
                    $res1 = mysql_query($vic,$link);
                    $rowvic = mysql_fetch_array($res1);


                    /*----------------------------Consulta Numero de victimas----------------------------------------------*/
                    $vic2 = "select count(estado_vic) from tbl_victimas where id_parte='$row[id_parte]' and estado_vic='muerto' and placa_veh_vic = '$row[placa_veh]' and relacion_vic!='peaton'";
                    $res2 = mysql_query($vic2,$link);
                    $rowvic2 = mysql_fetch_array($res2);

                    if(empty($row["via"])){ 
                            $row["via"]="&nbsp;"; 
                    }
                    if(empty($row["tramo"])){ 
                            $row["tramo"]="&nbsp;"; 
                    }
                    if(empty($row["calzada"])){ 
                            $row["calzada"]="&nbsp;"; 
                    }
                    if(empty($row["abcisa"])){ 
                            $row["abcisa"]="&nbsp;"; 
                    }
                    if(empty($row["tipo_veh"])){ 
                            $row["tipo_veh"]="&nbsp;"; 
                    }
                    if(empty($row["placa_veh"])){ 
                            $row["placa_veh"]="&nbsp;"; 
                    }
                    if(empty($row["marca_veh"])){ 
                            $row["marca_veh"]="&nbsp;"; 
                    }
                    if(empty($row["cilindraje"])){ 
                            $row["cilindraje"]="&nbsp;"; 
                    }
                    if(empty($rowvic["0"])){ 
                            $rowvic["0"]="0"; 
                    }
                    if(empty($rowvic2["0"])){ 
                            $rowvic2["0"]="0"; 
                    }
                    if(empty($row["insp_vial"])){ 
                            $row["insp_vial"]="&nbsp;"; 
                    }
                    if(empty($row["ambulancia"])){ 
                            $row["ambulancia"]="&nbsp;"; 
                    }
                    if(empty($row["grua_con"])){ 
                            $row["grua_con"]="&nbsp;"; 
                    }
                    if(empty($row["director_ope"])){ 
                            $row["director_ope"]="&nbsp;"; 
                    }
                    if(empty($row["agentes_trans"])){ 
                            $row["agentes_trans"]="&nbsp;"; 
                    }
                    if(empty($row["policia_carreteras"])){ 
                            $row["policia_carreteras"]="&nbsp;"; 
                    }
                    if(empty($row["fiscalia"])){ 
                            $row["fiscalia"]="&nbsp;"; 
                    }
                    if(empty($row["senalizacion"])){ 
                            $row["senalizacion"]="&nbsp;"; 
                    }
                    if(empty($row["bomberos"])){ 
                            $row["bomberos"]="&nbsp;"; 
                    }

                    $fechas = explode(' ', $row["fec_pro"]);

                    $tablaexcelinv .= "
                    <tr>
                            <td align='right'>".$cont."&nbsp;</td>
                            <td align='right'>".$row["id_parte"]."&nbsp;</td>
                            <td>".$fechas[0]."</td>
                            <td>".$fechas[1]."</td>
                            <td align='center'>".$row["via"]."</td>
                            <td align='center'>".$row["tramo"]."</td>
                            <td align='center'>".$row["calzada"]."</td>
                            <td align='center'>".$row["abcisa"]."</td>
                            <td >".$row["tipo_veh"]."</td>
                            <td align='center'>".$row["placa_veh"]."</td>
                            <td align='center'>".$row["marca_veh"]."</td>
                            <td align='right'>".$row["cilindraje"]."</td>
                            <td align='center'>".$rowvic["0"]."</td>
                            <td align='center'>".$rowvic2["0"]."</td>
                            <td align='center'>".$row["insp_vial"]."</td>
                            <td align='center'>".$row["ambulancia"]."</td>
                            <td align='center'>".$row["grua_con"]."</td>
                            <td align='center'>".$row["director_ope"]."</td>
                            <td align='center'>".$row["agentes_trans"]."</td>
                            <td align='center'>".$row["policia_carreteras"]."</td>
                            <td align='center'>".$row["fiscalia"]."</td>
                            <td align='center'>".$row["senalizacion"]."</td>
                            <td align='center'>".$row["bomberos"]."</td>
                    </tr>";
                }


                mysql_free_result($result);
                mysql_close($link);

                $tablaexcelinv .= '</TABLE>';
                echo $tablaexcelinv;
                $_SESSION["tablaexcelinv"] = $tablaexcelinv;
            ?>
        </form>
    </body>
</html>