<?php
// Formato de fecha
date_default_timezone_set('America/Bogota');

// Sesión
session_start();

// Variable de sesión
$log=$_SESSION["log"];

// Si no se ha logueado
if ($log==0){
    // Se destruye la sesión
    session_destroy();
?>
    <!-- Se redirecciona -->
    <meta HTTP-EQUIV="REFRESH" content="0; url=index.php">
<?php } // if ?>

<html>
    <head>
        <?php
        // Archivo de funciones
        include 'funciones.php';
        
        // Conexión
        $link=Conectarse();
        ?>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Incidentes</title>
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
						}
						$.post("tramo.php", { elegido: elegido }, function(data){
							$("#abscisa").html("");
							array_datos = data.split('|');
							longitud = array_datos.length;
							$("#nom_tramo").val(array_datos[0]);
							$("#via").val(array_datos[1]);
						});
					});
				});
			});
		</script>

		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
    </head>
    <body>
            <?php
             //Inserta un nuevo registro con el timestamp y la cedula
            $fechahora= date('Y-m-d H:i:s');
            
           ?>
            <div id="contenedor_us_inc">
                <form action="guardar_inc.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
                    <div id="contenedor-logo">
                        <div class="logo"></div>
                    </div>
            
                    <div class="encabezado">
                        <!-- Fecha -->
                        <div class="global">
                            <div class="titulos"></div>
                            
                            <div class="campos">
                                <input type="hidden" id="fecha" name="fecha" value="<?php echo $fechahora;?>" />
                            </div>
                        </div><!-- Fecha -->
                        
                        <!-- Tramo -->
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
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- Tramo -->
                        
                        <!-- Vía -->
                        <div class="global" style="display: none">
                            <div class="titulos">
                                <b>Via</b>
                            </div>
                            <div class="campos">
                                <input type="text" class="sen-class" readonly="readonly" id="via" name="via" />
                            </div>
                        </div><!-- Vía -->
                                <!-- <input type="hiden" class="sen-class" readonly="readonly" id="via" name="via" /> -->
                        
                        <!-- Calzada -->
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
                        </div><!-- Calzada -->
                        
                        <!-- Abscisa -->
                        <div class="global">
                            <div class="titulos">
                                <b>Abscisa</b>
                            </div>
                            <div class="campos">
                                <input type="text" id="abcisa" name="abcisa" class="sen-class">
                            </div>
                        </div><!-- Abscisa -->
                        
                        <!-- Atención -->
                        <div class="global1">
                            <div>¿Fue atendido?
                                <input type="radio" name="atendido" value="1" />Si
                                <input type="radio" name="atendido" value="0" checked/>No
                            </div>

                            <div>
                                Motivo de la no atención
                                <select id="motivo_atencion" name="motivo_atencion" class="sen-class">
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
                        </div><!-- Atención -->
                    </div>

                <div class="encabezado2">
                <div class="cie_horas">
                <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $id_parte;?>" >
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                </div>
                <div class="cie_horas">

                    <div class="titulo_cie">Fecha y Hora Inicio:<img align="right" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                    <div class="campos_cie"><input type="text" id="h_ini_inc" name="h_ini_inc" class="sen-class"></div>
                    <div class="titulo_cie">Fecha y Hora Fin:<img align="right" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                    <div class="campos_cie"><input type="text" id="h_fin_inc" name="h_fin_inc" class="sen-class"></div>
					<script type="text/javascript">//<![CDATA[

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: true
						  });
						  cal.manageFields("cal_1", "h_ini_inc", "%Y-%m-%d %H:%M");
						  cal.manageFields("cal_2", "h_fin_inc", "%Y-%m-%d %H:%M");

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
                        <div class="campo_inv"><select id="color_veh" name="color_veh" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <?php
                                    $consulta10="select * from tbl_colores";
                                    $resul10=  mysql_query($consulta10,$link);
                                    while ($row10=mysql_fetch_assoc($resul10)){
                                    ?>
                                   <option value="<?php echo $row10["color"]; ?>"><?php echo $row10["color"]; ?></option>
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
                        <div class="campo_inv"><select id="marca_veh" name="marca_veh" class="sen-class">
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
                        <div class="campo_inv"><select id="servicio_veh" name="servicio_veh" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="Desconocido">Desconocido</option>
                                    <option value="Diplomatico">Diplomatico</option>
                                    <option value="N/A">No aplica</option>
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
                        <div class="campo_inv"><select id="tipo_veh" name="tipo_veh" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="Automovil">Automovil</option>
                                    <option value="Bicicleta">Bicicleta</option>
                                    <option value="Bus">Bus</option>
                                    <option value="Camion">Camion</option>
                                    <option value="Camioneta">Camioneta</option>
                                    <option value="Campero">Campero</option>
                                    <option value="Motocicleta">Motocicleta</option>
                                    <option value="Tracto_camion">Tracto camion</option>
                                    <option value="Volqueta">Volqueta</option>
					<option value="N/A">No Aplica</option>
                                </optgroup>
                            </select>
                        </div>
                        </div>
</div>
                   </div>
                        <div class="desc">
                            <div class="titulo_inv"><b>TIPO DE INCIDENTE</b></div>
                            <div class="titulo_inv"><select id="tipo_inc" name="tipo_inc" class="sen-class2">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="ACCIDENTE DE TRABAJO">ACCIDENTE DE TRABAJO</option>
                                    <option value="DERRAME DE COMBUSTIBLE">DERRAME DE COMBUSTIBLE</option>
                                    <option value="DERRAME DE MATERIAL DE PLAYA">DERRAME DE MATERIAL DE PLAYA</option>
                                    <option value="DERRAME SUSTANCIAS EN LA VIA">DERRAME SUSTANCIAS EN LA VIA</option>
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
                            </select></div>


               </div>

                    
                        <div class="desc1">
                            <div class="titulo_inv"><b>DESCRIPCION</b></div>
                            <textarea id="desc_inc" name="desc_inc" class="textare_inc"></textarea>
                            <div class="boton_inc">
                                <input type="submit" id="guardar" name="guargar"  Value="Guardar" class="bot">
                                <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                            </div>
                        </div>
                
                    </form>
                  </div>
                </body>
                </html>