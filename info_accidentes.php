<?php
session_start();
?>
<html>
    <head>
        <title>Informe de Accidentalidad</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>
        <form action="info_excel.php" method="POST">
            <h1>INFORME DE ACCIDENTALIDAD</h1>
                <div style="padding-bottom: 20px;">
                    <input type="submit" name="excel" id="bot1" value="Generar Accidentalidad en Excel" >
                    <input type="button" name="regresar" id="bot1" value="Regresar" onclick="location.href='informes.php'" >
                </div>
                <?php

                include("funciones.php");
                $link=Conectarse();
                $f_ini=$_POST['pri_fec'];
                $f_fin=$_POST['seg_fec'];

                $x = 1; //dias a sumar
                $fecha= date("Y-m-d", strtotime("$f_fin + ". $x ." days")); //se suman los $x dias

                $consulta="Select * from tbl_accidente where fec_con between '$f_ini' and '$fecha' order by fec_con";
                $result=  mysql_query($consulta,$link);

                $tablaexcelacc='
                <TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="2000px">
                    <TR align="center">
                        <TD>&nbsp;<b>CONSECUTIVO</b></TD>
                        <TD>&nbsp;<b>PARTE</b>&nbsp;</TD>
                        <TD width="20%">&nbsp;&nbsp;&nbsp;&nbsp;<b>FECHA</b>&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                        <TD width="5%">&nbsp;<b>HORA</b>&nbsp;</TD>
                        <TD width=" 5%">&nbsp;<b>V&Iacute;A</b>&nbsp;</TD>
                        <TD width="5%">&nbsp;<b>TRAMO</b>&nbsp;</TD>
                        <TD width="5%">&nbsp;<b>CALZADA</b>&nbsp;</TD>
                        <TD width="5%">&nbsp;<b>ABSCISA</b>&nbsp;</TD>
                        <TD width="157px" >&nbsp;<b>N&Uacute;MERO DE INVOLUCRADOS</b>&nbsp;</TD>
                        <TD width="150px">&nbsp;<b>HORA DE CONOCIMIENTO</b>&nbsp;</TD>
                        <TD width="150px">&nbsp;<b>HORA DE ATENCI&Oacute;N</b>&nbsp;</TD>
                        <TD width="150px">&nbsp;<b>HORA T&Eacute;RMINO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>CHOQUE CONTRA VEH&Iacute;CULO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>COHQUE CONTRA OBJETO FIJO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>ATROPELLO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>VOLCAMIENTO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>CA&Iacute;DA DEL OCUPANTE</b>&nbsp;</TD>
                        <TD>&nbsp;<b>CHOQUE CONTRA SEMOVIENTE</b>&nbsp;</TD>
                        <TD>&nbsp;<b>OTROS</b>&nbsp;</TD>
                        <TD>&nbsp;<b>N&Uacute;MERO DE HERIDOS</b>&nbsp;</TD>
                        <TD>&nbsp;<b>N&Uacute;MERO DE MUERTOS</b>&nbsp;</TD>
                        <TD>&nbsp;<b>EXCESO DE VELOCIDAD</b>&nbsp;</TD>
                        <TD>&nbsp;<b>IMPRUDENCIA DEL PEAT&Oacute;N</b>&nbsp;</TD>
                        <TD>&nbsp;<b>IMPRUDENCIA DEL CONDUCTOR</b>&nbsp;</TD>
                        <TD>&nbsp;<b>FALTA DE PRECAUCI&Oacute;N</b>&nbsp;</TD>
                        <TD>&nbsp;<b>EMBRIAGUEZ</b>&nbsp;</TD>
                        <TD>&nbsp;<b>FALLAS MEC&Aacute;NICAS</b>&nbsp;</TD>
                        <TD>&nbsp;<b>NO MANTENER LA DISTANCIA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>SEMOVIENTE EN LA V&Iacute;A</b>&nbsp;</TD>
                        <TD>&nbsp;<b>ADELANTAR</b>&nbsp;</TD>
                        <TD>&nbsp;<b>OTROS</b>&nbsp;</TD>
                        <TD>&nbsp;<b>HERIDO CONDUCTOR MOTOCICLETA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>HERIDO PARRILLERO MOTOCICLETA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>HERIDO CONDUCTOR</b>&nbsp;</TD>
                        <TD>&nbsp;<b>HERIDO PASAJERO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>HERIDO PEAT&Oacute;N</b>&nbsp;</TD>
                        <TD>&nbsp;<b>HERIDO CICLISTA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>MUERTO CONDUCTOR MOTOCILISTA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>MUERTO PARRILLERO MOTOCICLETA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>MUERTO CONDUCTOR</b>&nbsp;</TD>
                        <TD>&nbsp;<b>MUERTO PASAJERO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>MUERTO PEAT&Oacute;N</b>&nbsp;</TD>
                        <TD>&nbsp;<b>MUERTO CICLISTA</b>&nbsp;</TD>
                    </TR>';
                    $cont=0;
                    while($row = mysql_fetch_array($result)) {
                        $cont++;

                        /*----------------------------Consulta Numero de Involucrados----------------------------------------*/
                        $invol="select count(id_parte) from tbl_involucrados where id_parte=$row[id_parte]";
                        $res=  mysql_query($invol,$link);
                        $rowinv=  mysql_fetch_array($res);

                        /*----------------------------Consuta Numero de Heridos-----------------------------------------------*/
                        $vic="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='herido'";
                        $res1= mysql_query($vic,$link);
                        $rowvic= mysql_fetch_array($res1);

                        /*----------------------------Consulta Numero de victimas----------------------------------------------*/
                        $vic2="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='muerto'";
                        $res2= mysql_query($vic2,$link);
                        $rowvic2= mysql_fetch_array($res2);

                        /*----------------------------Consulta Numero de heridos y muertos moto----------------------------------------------*/
                        $vic3="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='herido' and relacion_vic='motociclista' ";
                        $res3= mysql_query($vic3,$link);
                        $rowvic3= mysql_fetch_array($res3);

                        $vic_m1="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='muerto' and relacion_vic='motociclista' ";
                        $resu1= mysql_query($vic_m1,$link);
                        $rowmuer1= mysql_fetch_array($resu1);


                        /*----------------------------Consulta Numero de heridos moto parrillero----------------------------------------------*/
                        $vic4="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='herido' and relacion_vic='parrillero' ";
                        $res4= mysql_query($vic4,$link);
                        $rowvic4= mysql_fetch_array($res4);

                        $vic_m2="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='muerto' and relacion_vic='parrillero' ";
                        $resu2= mysql_query($vic_m2,$link);
                        $rowmuer2= mysql_fetch_array($resu2);

                        /*----------------------------Consulta Numero de heridos conductor----------------------------------------------*/
                        $vic5="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='herido' and relacion_vic='conductor' ";
                        $res5= mysql_query($vic5,$link);
                        $rowvic5= mysql_fetch_array($res5);

                        $vic_m3="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='muerto' and relacion_vic='conductor' ";
                        $resu3= mysql_query($vic_m3,$link);
                        $rowmuer3= mysql_fetch_array($resu3);


                         /*----------------------------Consulta Numero de heridos pasajero----------------------------------------------*/
                        $vic6="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='herido' and relacion_vic='pasajero' ";
                        $res6= mysql_query($vic6,$link);
                        $rowvic6= mysql_fetch_array($res6);

                        $vic_m4="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='muerto' and relacion_vic='pasajero' ";
                        $resu4= mysql_query($vic_m4,$link);
                        $rowmuer4= mysql_fetch_array($resu4);

                        /*----------------------------Consulta Numero de heridos peaton----------------------------------------------*/
                        $vic7="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='herido' and relacion_vic='peaton' ";
                        $res7= mysql_query($vic7,$link);
                        $rowvic7= mysql_fetch_array($res7);

                        $vic_m5="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='muerto' and relacion_vic='peaton' ";
                        $resu5= mysql_query($vic_m5,$link);
                        $rowmuer5= mysql_fetch_array($resu5);

                        /*----------------------------Consulta Numero de heridos conductor----------------------------------------------*/
                        $vic8="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='herido' and relacion_vic='ciclista' ";
                        $res8= mysql_query($vic8,$link);
                        $rowvic8= mysql_fetch_array($res8);

                        $vic_m6="select count(estado_vic) from tbl_victimas where id_parte=$row[id_parte] and estado_vic='muerto' and relacion_vic='ciclista' ";
                        $resu6= mysql_query($vic_m6,$link);
                        $rowmuer6= mysql_fetch_array($resu6);

                        if(empty($rowinv["0"])){ $rowinv["0"]="&nbsp;"; }
                        if(empty($row["ch_contra_veh"])){ $row["ch_contra_veh"]="&nbsp;"; }
                        if(empty($row["inmovilizado"])){ $row["inmovilizado"]="&nbsp;"; }
                        if(empty($row["ch_contra_obj"])){ $row["ch_contra_obj"]="&nbsp;"; }
                        if(empty($row["atropello"])){ $row["atropello"]="&nbsp;"; }
                        if(empty($row["volcamiento"])){ $row["volcamiento"]="&nbsp;"; }
                        if(empty($row["caida_del_ocu"])){ $row["caida_del_ocu"]="&nbsp;"; }
                        if(empty($row["ch_contra_sem"])){ $row["ch_contra_sem"]="&nbsp;"; }
                        if(empty($row["otros_acc"])){ $row["otros_acc"]="&nbsp;"; }
                        if(empty($rowvic["0"])){ $rowvic["0"]="&nbsp;"; }
                        if(empty($rowvic2["0"])){ $rowvic2["0"]="&nbsp;"; }
                        if(empty($row["exc_vel"])){ $row["exc_vel"]="&nbsp;"; }
                        if(empty($row["imp_peat"])){ $row["imp_peat"]="&nbsp;"; }
                        if(empty($row["imp_con"])){ $row["imp_con"]="&nbsp;"; }
                        if(empty($row["falta_pre"])){ $row["falta_pre"]="&nbsp;"; }
                        if(empty($row["embri"])){ $row["embri"]="&nbsp;"; }
                        if(empty($row["fallas"])){ $row["fallas"]="&nbsp;"; }
                        if(empty($row["no_dis"])){ $row["no_dis"]="&nbsp;"; }
                        if(empty($row["sem_via"])){ $row["sem_via"]="&nbsp;"; }
                        if(empty($row["ade_proh"])){ $row["ade_proh"]="&nbsp;"; }
                        if(empty($row["hip_otros"])){ $row["hip_otros"]="&nbsp;"; }

                        $date = explode(" ",$row["fec_pro"]);
                        $hora_c = explode(" ",$row["fec_con"]);
                        $hora_i = explode(" ",$row["fechahora_ini"]);
                        $hora_f = explode(" ",$row["fechahora_fin"]);

                        //comprobando si el parte está incompleto
                        $incompleto = accidente_incompleto($row["id_parte"],$link);

                        $color_fila = "";

                        if($incompleto){
                            $color_fila = "bgcolor='red'";
                        }

                        $tablaexcelacc .=
                            "<tr $color_fila>
                                <td align='right'>".$cont."&nbsp;</td>
                                <td align='right'>".$row["id_parte"]."</td>
                                <td>".$date[0]."</td>
                                <td>".$date[1]."</td>
                                <td>".$row["via"]."</td>
                                <td align='center'>".$row["tramo"]."</td>
                                <td align='center'>".$row["calzada"]."</td>
                                <td align='center'>".$row["abcisa"]."</td>
                                <td align='center'>".$rowinv["0"]."</td>
                                <td>".$hora_c[1]."</td>
                                <td>".$hora_i[1]."</td>
                                <td>".$hora_f[1]."</td>
                                <td align='center'>".$row["ch_contra_veh"]."</td>
                                <td align='center'>".$row["ch_contra_obj"]."</td>
                                <td align='center'>".$row["atropello"]."</td>
                                <td align='center'>".$row["volcamiento"]."</td>
                                <td align='center'>".$row["caida_del_ocu"]."</td>
                                <td align='center'>".$row["ch_contra_sem"]."</td>
                                <td align='center'>".$row["otros_acc"]."</td>
                                <td align='center'>".$rowvic["0"]."</td>
                                <td align='center'>".$rowvic2["0"]."</td>
                                <td align='center'>".$row["exc_vel"]."</td>
                                <td align='center'>".$row["imp_peat"]."</td>
                                <td align='center'>".$row["imp_con"]."</td>
                                <td align='center'>".$row["falta_pre"]."</td>
                                <td align='center'>".$row["embri"]."</td>
                                <td align='center'>".$row["fallas"]."</td>
                                <td align='center'>".$row["no_dis"]."</td>
                                <td align='center'>".$row["sem_via"]."</td>
                                <td align='center'>".$row["ade_proh"]."</td>
                                <td align='center'>".$row["hip_otros"]."</td>
                                <td align='center'>".$rowvic3["0"]."</td>
                                <td align='center'>".$rowvic4["0"]."</td>
                                <td align='center'>".$rowvic5["0"]."</td>
                                <td align='center'>".$rowvic6["0"]."</td>
                                <td align='center'>".$rowvic7["0"]."</td>
                                <td align='center'>".$rowvic8["0"]."</td>
                                <td align='center'>".$rowmuer1["0"]."</td>
                                <td align='center'>".$rowmuer2["0"]."</td>
                                <td align='center'>".$rowmuer3["0"]."</td>
                                <td align='center'>".$rowmuer4["0"]."</td>
                                <td align='center'>".$rowmuer5["0"]."</td>
                                <td align='center'>".$rowmuer6["0"]."</td>
                            </tr>";   

                   }//Fin while
                   mysql_free_result($result);
                   mysql_close($link);

                       $tablaexcelacc .='</TABLE>';
                       echo $tablaexcelacc;
                       $_SESSION["tablaexcelacc"]=$tablaexcelacc;
                ?>
        </form>
    </body>
</html>