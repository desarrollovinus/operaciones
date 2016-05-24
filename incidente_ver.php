<?php
    //Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
    session_start();
    $log=$_SESSION["log"];
    if ($log==0){
        session_destroy();
         ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
    }
    $id_parte=$_SESSION["id_parte"];
?>
         
<html>
    <head>
        <?php 
            include 'funciones.php';
            $link=Conectarse();
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Incidentes</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery-1.7.min.js"></script>
    </head>
    
    <body>
        <?php

            //Se hace la consulta en la tabla de incidente para mostrarlo en el formulario
            // $consulta="SELECT * FROM tbl_incidente where id_parte='$id_parte'";
            $consulta="select * FROM tbl_incidente INNER JOIN tbl_parte AS p ON tbl_incidente.id_parte = p.id_parte WHERE tbl_incidente.id_parte = '$id_parte'";
            $resul= mysql_query($consulta,$link);
            $row = mysql_fetch_array($resul);


         $consulta_usuario="SELECT * FROM tbl_usuarios where id_usuario='".$row['usuario']."'";
        $resul_usuario= mysql_query($consulta_usuario,$link);
        $row_usuario = mysql_fetch_array($resul_usuario);
        ?>

    <div id="contenedor_us_inc">

        <!--Formulario-->
        <form action="guardar_inc.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >

            <!--Contenedor Encabezado Logo-->
            <div id="contenedor-logo">     
                <div class="logo"></div>

<!--Botón Imprimir Planilla-->
                <input type="button"    id="imprimir"   value="Imprimir Planilla"   name="imprimir" class="bot"/>   
                <!--Botón Visualizar Fotos -->
                <input type="button"    id="atras"      value="Visualizar fotos"    name="atras"    onclick="location.href='ver_fotos.php'"             class="bot"/> 
            </div>

            <!--Contenedor Encabezado1-->
            <div class="encabezado">

                <!--Contenedor Consecutivo -->    
                <div class="global">
                    <div class="titulos">
                        <b>Consecutivo</b>
                    </div>
                    <div class="campos">
                        <?php echo $id_parte;?>
                    </div>
                </div>

                <!--Contenedor Vía--> 
                <!-- <div class="global">
                    <div class="titulos">
                        <b>Vía</b>
                    </div>
                    <div class="campos">
                        <select id="via" name="via" class="sen-class" disabled="disabled">
                            <optgroup label="Seleccione">
                                <option value=""><?php // echo $row["via"]; ?></option>
                            </optgroup>
                        </select>
                    </div>
                </div> -->

                <!--Contenedor Tramo--> 
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

                <!--Contenedor Calzada--> 
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

                <!--Contenedor Abscisa--> 
                <div class="global">
                    <div class="titulos">
                        <b>Abscisa</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="abcisa" name="abcisa" class="sen-class" value="<?php echo $row["abcisa"]; ?>" disabled="disabled">
                    </div>
                </div>

                <!--Atención--> 
                <div class="global">
                    <div class="titulos">
                        <div>¿Atendido?
                            <input type="radio" name="atendido" value="1" <?php if($row["atendido"] == 1){echo "checked";} ?>  disabled/>Si
                            <input type="radio" name="atendido" value="0" <?php if($row["atendido"] == 0){echo "checked";} ?> disabled/>No
                        </div>
                    </div>
                    <div class="campos">
                        <div>
                            <select id="motivo_atencion" name="motivo_atencion" class="sen-class" disabled>
                                <option value=""></option>
                                <?php
                                $consulta = "select * from tbl_motivo_inasistencia order by nombre ASC";
                                $resultado = mysql_query($consulta,$link);
                                while($motivo = mysql_fetch_assoc($resultado)){
                                    echo "<option value='".$motivo["id"]."'>".$motivo["nombre"]."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function(){
                                // Se pone por defecto el valor que traiga
                                $("#motivo_atencion").val("<?php echo $row['id_motivo_atencion']; ?>")
                            }) 
                        </script>
                    </div>
                </div>  
            </div>

            <!--Contenedor Encabezado2-->
            <div class="encabezado2">

                <!--Contenedor Fecha y Hora Inicio-->
                <div class="cie_horas">
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                </div>

                <div class="cie_horas">
                    <div class="titulo_cie">Fecha y Hora Inicio:</div>
                    <div class="campos_cie"><input type="text" id="h_ini_inc" name="h_ini_inc" class="sen-class"  value="<?php echo $row["h_ini_inc"]; ?>" disabled="disabled"></div>
                    <div class="titulo_cie">Fecha y Hora Fin:</div>
                    <div class="campos_cie"><input type="text" id="h_fin_inc" name="h_fin_inc" class="sen-class"  value="<?php echo $row["h_fin_inc"]; ?>" disabled="disabled"></div>
                </div>
            </div>

            <!--Contenedor Encabezado (Información del Usuario)-->
            <div class="cont_us_inc">
                <div class="titulo_inv"><b>INFORMACIÓN DEL USUARIO</b></div>

                <div class="bloque_inv">

                    <div class="bloque1_inv">

                        <!--Contenedor Nombre del Usuario y Color del Vehículo-->
                        <div class="texto_inv">Nombre del usuario</div>
                        <div class="campo_inv"><input type="text" id="nom_inv" name="nom_inv" class="sen-class"  value="<?php echo $row["us_nombre"]; ?>" disabled="disabled"></div>
                        <div class="texto_inv">Color del Vehículo</div>
                        <div class="campo_inv">
                            <select id="color_veh" name="color_veh" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["us_color_veh"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="bloque1_inv">

                        <!--Contenedor Cédula del Usuario y Marca del Vehículo-->
                        <div class="texto_inv">Cédula del usuario</div>
                        <div class="campo_inv"><input type="text" id="ced_inv" name="ced_inv" class="sen-class"  value="<?php echo $row["us_ced"]; ?>" disabled="disabled"></div>
                        <div class="texto_inv">Marca del vehículo</div>
                        <div class="campo_inv">
                            <select id="marca_veh" name="marca_veh" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["us_marca_veh"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="bloque1_inv">

                       <!--Contenedor Teléfono y Servicio-->
                       <div class="texto_inv">Teléfono</div>
                       <div class="campo_inv"><input type="text" id="tel_inv" name="tel_inv" class="sen-class"  value="<?php echo $row["us_tel"]; ?>" disabled="disabled"></div>
                       <div class="texto_inv">Servicio</div>
                       <div class="campo_inv">
                           <select id="servicio_veh" name="servicio_veh" class="sen-class" disabled="disabled">
                               <optgroup label="Seleccione">
                                   <option value=""><?php echo $row["us_serv_veh"]; ?></option>
                               </optgroup>
                           </select>
                       </div>
                    </div>

                    <div class="bloque1_inv">

                       <!--Contenedor Placa y Tipo del Vehículo-->
                       <div class="texto_inv">Placa del vehículo</div>
                       <div class="campo_inv"><input type="text" id="placa_veh" name="placa_veh" class="sen-class"  value="<?php echo $row["us_placa_veh"]; ?>" disabled="disabled"></div>
                       <div class="texto_inv">Tipo del vehículo</div>
                       <div class="campo_inv">
                           <select id="tipo_veh" name="tipo_veh" class="sen-class" disabled="disabled">
                               <optgroup label="Seleccione">
                                   <option value=""><?php echo $row["us_tipo_veh"]; ?></option>
                               </optgroup>
                           </select>
                       </div>
                    </div>

                </div>
            </div>

            <!--Contenedor Encabezado Tipo de Incidente-->
            <div class="desc">
                <div class="titulo_inv"><b>TIPO DE INCIDENTE</b></div>
                <div class="titulo_inv">
                    <select id="tipo_inc" name="tipo_inc" class="sen-class2" disabled="disabled">
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["tipo_inc"]; ?>"><?php echo $row["tipo_inc"]; ?></option>
                            <option value="ACCIDENTE DE TRABAJO">ACCIDENTE DE TRABAJO</option>
                            <option value="DERRAME DE COMBUSTIBLE">DERRAME DE COMBUSTIBLE</option>
                            <option value="DERRAME DE MATERIAL DE PLAYA">DERRAME DE MATERIAL DE PLAYA</option>
                            <option value="DERRAME SUSTANCIAS EN LA VIA">DERRAME SUSTANCIAS EN LA VÍA</option>
                            <option value="DESLIZAMIENTO DE TIERRA">DESLIZAMIENTO DE TIERRA</option>
                            <option value="EMERGENCIA">EMERGENCIA</option>
                            <option value="MANIFESTACION PUBLICA">MANIFESTACIÓN PÚBLICA</option>
                            <option value="MUERTO">MUERTO</option>
                            <option value="OBSTACULO EN LA VIA">OBSTÁCULO EN LA VÍA</option>
                            <option value="PERDIDA DE CARGA EN LA VIA">PERDIDA DE CARGA EN LA VIA</option>
                            <option value="PRIMEROS AUXILIOS Y/O TRASLADO A CENTRO ASISTENCIAL">PRIMEROS AUXILIOS Y/O TRASLADO A CENTRO ASISTENCIAL</option>
                            <option value="SEMOVIENTE MUERTO">SEMOVIENTE MUERTO</option>
                            <option value="SIN INFORMACION">SIN INFORMACIÓN</option>
                            <option value="VEHICULO ABANDONADO">VEHÍCULO ABANDONADO</option>
                            <option value="VEHICULO INMOVILIZADO">VEHÍCULO INMOVILIZADO</option>
                            <option value="VEHICULO VARADO">VEHÍCULO VARADO</option>
                            <option value="OTROS">OTROS</option>
                        </optgroup>
                    </select>
                </div>
            </div>

            <!--Contenedor Encabezado Descripción-->
            <div class="desc1">
                <div class="titulo_inv"><b>DESCRIPCION</b></div>
                <textarea id="desc_inc" name="desc_inc" class="textare_inc" disabled="disabled"> <?php echo $row["descrip"]; ?></textarea>
                <div class="boton_inc"><input type="button" id="regresar" name="regresar" Value="Regresar" class="bot" onclick="location.href='ver.php'"></div>
            </div>
            <div>
                Inspector: <b><u><?php echo $row_usuario['us_nombre']." ".$row_usuario['us_apellido']; ?></u></b>
            </div>
        </form>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#imprimir').click(function(){
                window.open('imprimir_planilla_incidente.php?parte=<?php echo $id_parte; ?>');
                });
            });
    </script>
    
    </body>
</html>