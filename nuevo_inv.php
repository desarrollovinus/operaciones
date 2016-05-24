<?php
session_start();
$con=$_SESSION[id_parte];
?>

<html>
    <head>
        <?php include 'funciones.php';
        $link=Conectarse();
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Involucrados</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <script language="javascript" src="js/validaciones.js" type="text/javascript"></script>
    </head>
    <body>
        <form action="inv_ins1.php" name="forminvol1" id="forminvol1" enctype="multipart/form-data" method="post" >
            <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $con ;?>">
            <div id="contenedor_inv">
                <div class="titulo_inv"><b>VEHICULOS INVOLUCRADOS</b></div>
                <div class="bloque_inv">
                    <table>
                        <tr>
                            <td>
                                <div class="texto_inv">Nombre del usuario</div><br>
                                <div class="campo_inv"><input type="text" id="nom_inv" name="nom_inv" class="sen-class"></div>
                            </td>
                            <td>
                                <div class="texto_inv">C&eacute;dula del usuario</div><br>
                                <div class="campo_inv"><input type="text" id="ced_inv" name="ced_inv" class="sen-class"></div>
                            </td>
                            <td>
                                <div class="texto_inv">Tel&eacute;fono</div><br>
                                <div class="campo_inv"><input type="text" id="tel_inv" name="tel_inv" class="sen-class"></div>
                            </td>
                            <td>
                                <div class="texto_inv">Celular</div><br>
                                <div class="campo_inv"><input type="text" id="cel_inv" name="cel_inv" class="sen-class"></div>
                            </td>
                            <td>
                                <div class="texto_inv">Placa del vehiculo</div>
                                <div class="campo_inv"><input type="text" id="placa_inv" name="placa_inv" class="sen-class"></div>
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="texto_inv">Color del Vehiculo</div>
                                <div class="campo_inv">
                                    <select id="color_veh" name="color_veh" class="sen-class">
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
                            </td>
                            <td>
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
                            </td>
                            <td>
                                <div class="texto_inv">Servicio</div>
                                <div class="campo_inv">
                                    <select id="servicio_veh" name="servicio_veh" class="sen-class">
                                        <optgroup label="Seleccione">
                                            <option value=""></option>
                                            <option value="desconocido">Desconocido</option>
                                            <option value="diplomatico">Diplomatico</option>
                                            <option value="no_aplica">No aplica</option>
                                            <option value="oficial">Oficial</option>
                                            <option value="particular">Particular</option>
                                            <option value="publico">Publico</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="texto_inv">Tipo del vehiculo</div>
                                <div class="campo_inv"><select id="tipo_veh" name="tipo_veh" class="sen-class">
                                        <optgroup label="Seleccione">
                                            <option value=""></option>
                                            <option value="automovil">Automovil</option>
                                            <option value="bicicleta">Bicicleta</option>
                                            <option value="bus">Bus</option>
                                            <option value="camion">Camion</option>
                                            <option value="motocicleta">Motocicleta</option>
                                            <option value="tracto_camion">Tracto camion</option>
                                            <option value="volqueta">Volqueta</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="texto_inv">Cilindraje del veh&iacute;culo</div>
                                <div class="campo_inv"><select id="cilindraje_veh" name="cilindraje_veh" class="sen-class">
                                        <optgroup label="Seleccione">
                                            <option value=""></option>
                                                <?php
                                                $consulta_cilndraje = "select * from tbl_cilindraje";
                                                $resultado_cilindraje =  mysql_query($consulta_cilndraje,$link);
                                                while ($fila = mysql_fetch_assoc($resultado_cilindraje)){
                                                ?>
                                            <option value="<?php echo $fila["cilindraje"]; ?>"><?php echo $fila["cilindraje"] ?></option>
                                                <?php
                                                }
                                                ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <div>
                                    <input type="submit" name="nuevo" id="nuevo" value="Guardar" class="botones">
                                    <input type="button" name="next" id="next" value="Cancelar" onclick="location.href='selc_inv.php'" class="botones">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </body>
</html>
