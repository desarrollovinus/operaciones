<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
$ced=$_SESSION["ced"];
?>
<html>
    <head>
       <?php include 'funciones.php';
       $link=Conectarse();
       ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Grua</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
            <script src="js/jscal2.js"></script>
            <script src="js/lang/es.js"></script>		
            <script src="js/jquery-1.7.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("#tramo").change(function () {
                        $("#tramo option:selected").each(function () {
                            elegido=$(this).val();
                            $("#punto").val("");
                            $("#punto").attr("title","");
                            $("#nom_tramo").val("");
                            $("#via").val("");
                            $("#abscisa").html("");
                            if(elegido=="Seleccione"){
                                return false;
                            }//Fin if
                            $.post("tramo.php", { elegido: elegido }, function(data){
                                $("#abscisa").html("");
                                    array_datos = data.split('|');
                                    longitud = array_datos.length;
                                    $("#nom_tramo").val(array_datos[0]);
                                    $("#via").val(array_datos[1]);
                                    /*select_abscisas = "<option value='Seleccione'>Seleccione</option>";
                                    for(i = 2; i < longitud; i+=2){
                                            id=array_datos[i];
                                            abscisa=array_datos[i+1];
                                            select_abscisas += "<option value="+ id + ">" + abscisa + "</option>";
                                    }
                                    $("#abscisa").html(select_abscisas);*/
                                });//Fin .post
                        });//Fin each.function
                    });//Fin change.function
                /*$("#abscisa").change(function () {
                        $("#abscisa option:selected").each(function () {
                                elegido=$(this).val();
                                $("#punto").val("");
                                $("#punto").attr("title","");
                                if(elegido=="Seleccione"){
                                        return false;
                                }
                                $.post("abscisa.php", { elegido: elegido }, function(data){
                                        $("#punto").val(data);
                                        $("#punto").attr("title",data);
                                });			
                            });
                    });*/
                });//Fin document.ready 
            </script>
            <link rel="stylesheet" type="text/css" href="css/jscal2.css" />
            <link rel="stylesheet" type="text/css" href="css/border-radius.css" />
            <link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
    </head>
    <body>
        <div id="contenedor_us_grua">
            <form action="guardar_grua.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
                <div id="contenedor-logo">
                    <div class="logo"></div>
                </div>
                <div class="encabezado">
                    <div class="global">
                        <div class="titulos">
                            <b>Consecutivo</b>
                        </div>
                        <div class="campos">
                            <input type="text" id="id_parte" name="id_parte" class="sen-class" >
                        </div>
                    </div>
                    <div class="global">
                        <div class="titulos">
                            <b>Via</b>
                        </div>
                        <div class="campos">
                            <input type="text" class="sen-class" readonly="readonly" id="via" name="via"></input>
                        </div>
                    </div>
                    <div class="global">
                        <div class="titulos">
                            <b>Tramo</b>
                        </div>
                        <div class="campos">
                            <select id="tramo" name="tramo" class="sen-class">
                                <option value="" selected></option>
                                <?php
                                    $consulta = "select * from tbl_tramos order by id";
                                    $resultado = mysql_query($consulta,$link);
                                    while($tramo = mysql_fetch_assoc($resultado)){
                                        echo "<option value='".$tramo["id"]."'>Tramo ".$tramo["id"]."</option>";
                                    }//Fin while
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="global">
                        <div class="titulos">
                            <b>Calzada</b>
                        </div>
                        <div class="campos">
                            <select id="calzada" name="calzada" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="W">W</option>
                                    <option value="E">E</option>
                                    <option value="N/A">N/A</option>
                                    <option value="W/E">W/E</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="global">
                        <div class="titulos">
                            <b>Abscisa</b>
                        </div>
                        <div class="campos">
                            <input type="text" id="abcisa" name="abcisa" class="sen-class">
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
                        <div class="campos_horas"><input type="text" id="h_ped" name="h_ped" class="sen-class"></div>
                        <div class="titulo_horas">Fecha y Hora Inicio:</div>
                        <div class="campos_horas"><input type="text" id="h_ini_grua" name="h_ini_grua" class="sen-class"></div>
                        <div class="titulo_horas">Fecha y Hora Fin:</div>
                        <div class="campos_horas"><input type="text" id="h_fin_grua" name="h_fin_grua" class="sen-class"></div>
                            <script type="text/javascript">//<![CDATA[
                                var cal = Calendar.setup({
                                    onSelect: function(cal) { cal.hide() },
                                    showTime: true
                                });//Fin var
                                cal.manageFields("cal_1", "h_ped", "%Y-%m-%d %H:%M");
                                cal.manageFields("cal_2", "h_ini_grua", "%Y-%m-%d %H:%M");
                                cal.manageFields("cal_3", "h_fin_grua", "%Y-%m-%d %H:%M");
                        //]]></script>
                    </div>
                </div>
                <div class="cont_us_inc">
                    <div class="titulo_inv"><b>INFORMACION DEL USUARIO</b></div>
                    <div class="bloque_inv">
                        <div class="bloque1_inv">
                            <div class="texto_inv">Nombre del usuario</div>
                            <div class="campo_inv"><input type="text" id="nom_inv" name="nom_inv" class="sen-class"></div>
                            <div class="texto_inv">Color del Vehiculo</div>
                            <div class="campo_inv">
                                <select id="color_veh" name="color_veh" class="sen-class">
                                    <optgroup label="Seleccione">
                                        <option value=""></option>
                                        <?php 
                                        $consulta="select * from tbl_colores";
                                        $resul=  mysql_query($consulta,$link);
                                        while ($row=mysql_fetch_assoc($resul)){
                                        ?>
                                       <option value="<?php echo $row["color"]; ?>"><?php echo $row["color"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="bloque1_inv">
                            <div class="texto_inv">Cedula del usuario</div>
                            <div class="campo_inv"><input type="text" id="ced_inv" name="ced_inv" class="sen-class"></div>
                            <div class="texto_inv">Marca del vehiculo</div>
                            <div class="campo_inv">
                                <select id="marca_veh" name="marca_veh" class="sen-class">
                                    <optgroup label="Seleccione">
                                        <option value=""></option>
                                        <?php
                                        $consulta2="select * from tbl_marcas";
                                        $resul2=  mysql_query($consulta2,$link);
                                        while ($row2=mysql_fetch_assoc($resul2)){
                                        ?>
                                       <option value="<?php echo $row2["nombre"]; ?>"><?php echo $row2["nombre"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="bloque1_inv">
                            <div class="texto_inv">Telefono</div>
                            <div class="campo_inv"><input type="text" id="tel_inv" name="tel_inv" class="sen-class"></div>
                            <div class="texto_inv">Servicio</div>
                            <div class="campo_inv">
                                <select id="servicio_veh" name="servicio_veh" class="sen-class">
                                    <optgroup label="Seleccione">
                                        <option value=""></option>
                                        <option value="Desconocido">Desconocido</option>
                                        <option value="Diplomatico">Diplomatico</option>
                                        <option value="No_aplica">No aplica</option>
                                        <option value="Oficial">Oficial</option>
                                        <option value="Particular">Particular</option>
                                        <option value="Publico">Publico</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="bloque1_inv">
                        <div class="texto_inv">Placa del vehiculo</div>
                        <div class="campo_inv"><input type="text" id="placa_veh" name="placa_veh" class="sen-class"></div>
                        <div class="texto_inv">Tipo del vehiculo</div>
                            <div class="campo_inv">
                                <select id="tipo_veh" name="tipo_veh" class="sen-class">
                                    <optgroup label="Seleccione">
                                        <option value=""></option>
                                        <option value="Automovil">Automovil</option>
                                        <option value="Bicicleta">Bicicleta</option>
                                        <option value="Bus">Bus</option>
                                        <option value="Camion">Camion</option>
                                        <option value="Camioneta">Camioneta</option>
                                        <option value="Campero">Campero</option>
                                        <option value="Furgon">Furg&oacute;n</option>
                                        <option value="Microbus">Campero</option>
                                        <option value="Motocicleta">Motocicleta</option>
                                        <option value="Tracto_camion">Tracto camion</option>
                                        <option value="Volqueta">Volqueta</option>
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
                        <select id="mot_serv" name="mot_serv" class="sen-class">
                            <optgroup label="Seleccione">
                                <option value=""></option>
                                <option value="Accidente">Accidente</option>
                                <option value="Varado">Varado</option>
                                <option value="Inmovilizado">Inmovilizado</option>
                                <option value="Apoyo">Apoyo</option>
                                <option value="Otros">Otros</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="titulo_inv1">
                        <select id="serv_pres" name="serv_pres" class="sen-class">
                            <optgroup label="Seleccione">
                                <option value=""></option>
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
                        <div class="titulo_inv1"><b>OTRA INFORMACION</b></div>
                        <div class="titulo_inv1"><b>OPINION DEL USUARIO AL SERVICIO</b></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc1">Autoriza movimiento del vehiculo:</div>
                        <div class="check_inc3"><input type="text" id="aut_mov" name="aut_mov"  class="sen-class"></div>
                        <div class="texto_inc2">Excelente:</div>
                        <div class="check_inc1"><input type="checkbox" id="excelente" value="X" name="excelente" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc1">En calidad de:</div>
                        <div class="check_inc3"><input type="text" id="calidad" name="calidad" class="sen-class"></div>
                        <div class="texto_inc2">Bueno:</div>
                        <div class="check_inc1"><input type="checkbox" id="bueno" name="bueno" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc1">Nombre sitio de finalizacion:</div>
                        <div class="check_inc3"><input type="text" id="nom_fin" name="nom_fin" class="sen-class"></div>
                        <div class="texto_inc2">Regular:</div>
                        <div class="check_inc1"><input type="checkbox" id="regular" name="regular" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc1">Lugar de finalización:</div>
                        <div class="check_inc4">
                            <select id="lug_fin" name="lug_fin" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="PARQ VARIOS EN EL MUNICIPIO DE BARBOSA">PARQ VARIOS EN EL MUNICIPIO DE BARBOSA</option>
                                    <option value="PARQ VARIOS EN EL MUNICIPIO DE GIRARDOTA">PARQ VARIOS EN EL MUNICIPIO DE GIRARDOTA</option>
                                    <option value="PARQ  VARIOS EN EL MUNICIPIO DE COPACABANA">PARQ  VARIOS EN EL MUNICIPIO DE COPACABANA</option>
                                    <option value="PARQ VARIOS EN EL MUNICIPIO DE BELLO">PARQ VARIOS EN EL MUNICIPIO DE BELLO</option>
                                    <option value="BAHIA">BAHÍA</option>
                                    <option value="BAHIA PEAJES CONCESIÓN">BAHIA PEAJES CONCESIÓN</option>
                                    <option value="EN EL MISMO SITIO (SENALIZACIÓN)">EN EL MISMO SITIO (SEÑALIZACIÓN)</option>
                                    <option value="OTRO">OTRO</option>
                                </optgroup>
                            </select></div>
                        <div class="texto_inc2">Malo:</div>
                        <div class="check_inc1"><input type="checkbox" id="malo" name="malo" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc1">Tipo de grua:</div>
                        <div class="check_inc4">
                            <select id="tipo_grua" name="tipo_grua" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="Planchon">Planchon</option>
                                    <option value="Pluma">Pluma</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc1">Operador de grua:</div>
                        <div class="check_inc3"><input type="text" id="oper_grua" name="oper_grua" class="sen-class"></div>
                    </div>
                </div>
                <div class="desc1">
                    <div class="titulo_inv"><b>DESCRIPCION</b></div>
                    <textarea id="desc_grua" name="desc_grua" class="textare_inc"></textarea>
                    <div class="boton_inc">
                        <input type="submit" id="guardar" name="guargar" Value="Guardar" class="bot">
                        <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>