<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
?>
<html>
    <head>
        <meta HTTP-EQUIV="REFRESH" content="0; url=index.php">
<?php
}
$id_parte=$_SESSION["id_parte"];

include 'funciones.php';
$link=Conectarse();
$consulta="SELECT * FROM tbl_grua where id_parte='$id_parte'";
$resul= mysql_query($consulta,$link);
?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Grua</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <script src="js/jscal2.js"></script>
        <script src="js/lang/es.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jscal2.css" />
        <link rel="stylesheet" type="text/css" href="css/border-radius.css" />
        <link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <script type="text/javascript" src="js/jquery-1.7.min.js"></script>
    </head>
    <body>
        <div id="campo_inv">
            <input type="button" id="imprimir" name="imprimir" Value="Imprimir Planilla"  class="bot"">
            <input type="button" id="regresar" name="regresar" Value="Regresar"  onclick="location.href='ver.php'"class="bot">
        </div>
        <?php
            While ($row = mysql_fetch_assoc($resul)){
        ?>
        
        <div id="contenedor-logo">
            <div class="logo"></div>
        </div>
        <div id="contenedor_us_grua">
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                        <b>Consecutivo</b>
                    </div>
                    <div class="campos">
                        <?php echo $row["id_parte"]; ?>
                    </div>
                </div>
                <div class="global">
                    <div class="titulos">
                        <b>V&iacute;a</b>
                    </div>
                    <div class="campos">
                        <input type="text" class="sen-class" readonly="readonly" id="via" name="via" value="<?php echo $row["via"]; ?>">
                    </div>
                </div>
                <div class="global">
                    <div class="titulos">
                        <b>Tramo</b>
                    </div>
                    <div class="campos">
                        <select id="tramo" name="tramo" class="sen-class" disabled="disabled">
                            <optgroup label="Seleccione">
                                <option value=""><?php echo $row["tramo"]; ?></option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="global">
                    <div class="titulos">
                        <b>Calzada</b>
                    </div>
                    <div class="campos">
                        <select id="calzada" name="calzada" class="sen-class" disabled="disabled">
                            <optgroup label="Seleccione">
                                <option value=""><?php echo $row["calzada"]; ?></option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="global">
                    <div class="titulos">
                        <b>Abscisa</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="abcisa" name="abcisa" class="sen-class" value="<?php echo $row["abcisa"]; ?>" disabled="disabled">
                    </div>
                </div>
            </div>
            <div class="encabezado2">
                <div class="cie_horas">
                    <div class="titulo_horas1"> </div>
                    <div class="campos_horas1">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                    <div class="titulo_horas2"></div>
                    <div class="campos_horas1">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                    <div class="titulo_horas2"></div>
                    <div class="campos_horas1">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_3" name="cal_3"></div>
                </div>
                <div class="cie_horas">
                    <div class="titulo_horas">Fecha y Hora Pedido:</div>
                    <div class="campos_horas"><input type="text" id="h_fin_ped" name="h_fin_ped" class="sen-class" value="<?php echo $row["h_ped"]; ?>" disabled="disabled"></div>
                    <div class="titulo_horas">Fecha y Hora Inicio:</div>
                    <div class="campos_horas"><input type="text" id="h_ini_inc" name="h_ini_inc" class="sen-class" value="<?php echo $row["fechahorainicio"]; ?>" disabled="disabled"></div>
                    <div class="titulo_horas">Fecha y Hora Fin:</div>
                    <div class="campos_horas"><input type="text" id="h_fin_inc" name="h_fin_inc" class="sen-class" value="<?php echo $row["fechahorafin"]; ?>" disabled="disabled"></div>
                    <script type="text/javascript">//<![CDATA[
                        var cal = Calendar.setup({
                            onSelect: function(cal) { cal.hide() },
                            showTime: true
                        });
                        cal.manageFields("cal_1", "h_fin_ped", "%Y-%m-%d %H:%M");
                        cal.manageFields("cal_2", "h_ini_inc", "%Y-%m-%d %H:%M");
                        cal.manageFields("cal_3", "h_fin_inc", "%Y-%m-%d %H:%M");
                //]]></script>
                </div>
            </div>
            <div class="cont_us_inc">
                <div class="titulo_inv"><b>INFORMACI&Oacute;N DEL USUARIO</b></div>
                <div class="bloque_inv">
                    <div class="bloque1_inv">
                        <div class="texto_inv">Nombre del usuario</div>
                        <div class="campo_inv"><input type="text" id="nom_inv" name="nom_inv" class="sen-class" value="<?php echo $row["nom_us"]; ?>" disabled="disabled"></div>
                        <div class="texto_inv">Color del Vehiculo</div>
                        <div class="campo_inv">
                            <select id="color_veh" name="color_veh" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["color_veh"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="bloque1_inv">
                        <div class="texto_inv">Cedula del usuario</div>
                        <div class="campo_inv"><input type="text" id="ced_inv" name="ced_inv" class="sen-class" value="<?php echo $row["ced_us"]; ?>" disabled="disabled"></div>
                        <div class="texto_inv">Marca del vehiculo</div>
                        <div class="campo_inv">
                            <select id="marca_veh" name="marca_veh" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row[""]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="bloque1_inv">
                        <div class="texto_inv">Telefono</div>
                        <div class="campo_inv"><input type="text" id="tel_inv" name="tel_inv" class="sen-class" value="<?php echo $row["tel_us"]; ?>" disabled="disabled"></div>
                        <div class="texto_inv">Servicio</div>
                        <div class="campo_inv">
                            <select id="servicio_veh" name="servicio_veh" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["serv_veh"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="bloque1_inv">
                        <div class="texto_inv">Placa del veh&iacute;culo</div>
                        <div class="campo_inv"><input type="text" id="placa_veh" name="placa_veh" class="sen-class" value="<?php echo $row["placa_veh"]; ?>" disabled="disabled"></div>
                        <div class="texto_inv">Tipo del vehiculo</div>
                        <div class="campo_inv">
                            <select id="tipo_veh" name="tipo_veh" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["tipo_veh"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="desc">
                <div class="titulo_inv1"><b>MOTIVO DEL SERVICIO</b></div>
                <div class="titulo_inv1"><b>SERVICIO PRESTADO</b></div>
                <div class="titulo_inv1">
                    <select id="mot_serv" name="mot_serv" class="sen-class" disabled="disabled">
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["mot_serv"]?>"><?php echo $row["mot_serv"]?></option>
                            <option value="Accidente">Accidente</option>
                            <option value="Varado">Varado</option>
                            <option value="Inmovilizado">Inmovilizado</option>
                            <option value="Apoyo">Apoyo</option>
                            <option value="Otros">Otros</option>
                        </optgroup>
                    </select>
                </div>
                <div class="titulo_inv1">
                    <select id="serv_pres" name="serv_pres" class="sen-class" disabled="disabled">
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["serv_pres"]?>"><?php echo $row["serv_pres"]?></option>
                            <option value="Traslado">Traslado</option>
                            <option value="Senalizacion">Señalización</option>
                            <option value="Apoyo">Apoyo</option>
                            <option value="Otros">Otros</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="desc1">
                <div class="bloque2">
                    <div class="titulo_inv1"><b>OTRA INFORMACI&Oacute;N</b></div>
                    <div class="titulo_inv1"><b>OPINI&Oacute;N DEL USUARIO AL SERVICIO</b></div>
                </div>
                <div class="bloque2">
                    <div class="texto_inc1">Autoriza movimiento del vehiculo:</div>
                    <div class="check_inc3"><input type="text" id="aut_mov" name="aut_mov" class="sen-class" value="<?php echo $row["autoriza_mov"]?>" disabled="disabled"></div>
                    <div class="texto_inc2">Excelente:</div>
                        <?php if($row["excelente"]=='X'){ ?>
                    <div class="check_inc1"><input type="checkbox" id="excelente" name="excelente" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["excelente"]==''){ ?>
                    <div class="check_inc1"><input type="checkbox" id="excelente" name="excelente" class="checks1" disabled="disabled" ></div>
                        <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_inc1">En calidad de:</div>
                    <div class="check_inc3"><input type="text" id="calidad" name="calidad" class="sen-class" value="<?php echo $row["en_calidad_de"]?>" disabled="disabled" ></div>
                    <div class="texto_inc2">Bueno:</div>
                        <?php if($row["bueno"]=='X'){ ?>
                    <div class="check_inc1"><input type="checkbox" id="bueno" name="bueno" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["bueno"]==''){ ?>
                    <div class="check_inc1"><input type="checkbox" id="bueno" name="bueno" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_inc1">Nombre sitio de finalizacion:</div>
                    <div class="check_inc3"><input type="text" id="nom_fin" name="nom_fin" class="sen-class" value="<?php echo $row["nom_fin"]?>" disabled="disabled" ></div>
                    <div class="texto_inc2">Regular:</div>
                        <?php if($row["regular"]=='X'){ ?>
                    <div class="check_inc1"><input type="checkbox" id="regular" name="regular" value="X" class="checks1" checked disabled="disabled"> </div>
                        <?php } ?>
                        <?php if($row["regular"]==''){ ?>
                    <div class="check_inc1"><input type="checkbox" id="regular" name="regular" value="X" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_inc1">Lugar de finalización:</div>
                    <div class="check_inc4">
                        <select id="lug_fin" name="lug_fin" class="sen-class" disabled="disabled">
                            <optgroup label="Seleccione">
                                <option value="<?php echo $row["lug_fin"]?>"><?php echo $row["lug_fin"]?></option>
                                <option value="PARQ VARIOS EN EL MUNICIPIO DE BARBOSA">PARQ VARIOS DE BARBOSA</option>
                                <option value="PARQ VARIOS EN EL MUNICIPIO DE GIRARDOTA">PARQ VARIOS DE GIRARDOTA</option>
                                <option value="PARQ  VARIOS EN EL MUNICIPIO DE COPACABANA">PARQ  VARIOS COPACABANA</option>
                                <option value="PARQ VARIOS EN EL MUNICIPIO DE BELLO">PARQ VARIOS DE BELLO</option>
                                <option value="BAHIA">BAHÍA</option>
                                <option value="BAHIA PEAJES CONCESIÓN">BAHIA PEAJES CONCESIÓN</option>
                                <option value="EN EL MISMO SITIO (SENALIZACIÓN)">EN EL MISMO SITIO (SEÑALIZACIÓN)</option>
                                <option value="OTRO">OTRO</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="texto_inc2">Malo:</div>
                        <?php if($row["malo"]=='X'){ ?>
                    <div class="check_inc1"><input type="checkbox" id="malo" name="malo" value="X" class="checks1" checked disabled="disabled" ></div>
                        <?php } ?>
                        <?php if($row["malo"]==''){ ?>
                    <div class="check_inc1"><input type="checkbox" id="malo" name="malo" value="X" class="checks1" disabled="disabled" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc1">Tipo de grua:</div>
                        <div class="check_inc4">
                            <select id="tipo_grua" name="tipo_grua" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["tipo_grua"]?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                <div class="bloque2">
                    <div class="texto_inc1">Operador de gr&uacute;a:</div>
                    <div class="check_inc3"><input type="text" id="oper_grua" name="oper_grua" class="sen-class" value="<?php echo $row["oper_grua"] ?>" disabled="disabled"></div>
                </div>
            </div>
            <div class="desc1">
                <div class="titulo_inv"><b>DESCRIPCI&Oacute;N</b></div>
                <textarea id="desc_grua" name="desc_grua" class="textare_inc" disabled="disabled"><?php echo $row["desc_grua"]?></textarea>
            </div>
        </div>
        <?php
        }
        ?>
        <script>
        $(document).ready(function(){
                $('#imprimir').click(function(){
                window.open('reportes/grua.php?parte=<?php echo $id_parte; ?>');
            });
        });
        </script>
    </body>
</html>
