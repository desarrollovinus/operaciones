<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
?>

<html>
    <head>
        <title> Modificaci&oacute;n de Involucrados</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css"/>
    </head>
    <body>
        <form action="guardar_inv.php" id="form_inv" method="post">
            <div id="botonera_inv">
                <input type="submit"  name="guardar" id="guardar" value="Guardar" class="bot">
                <input type="button"  name="canc" id="canc" value="Cancelar" class="bot" onclick="location.href='selc_inv.php'" >
            </div>
            
            <?php
            include 'funciones.php';
            $link=Conectarse();

            $id_parte=$_SESSION["id_parte"];
            $id_inv=$_POST["dato"];

            $cons="select * from tbl_involucrados where id_inv='$id_inv'";
            $res=  mysql_query($cons,$link);

            $row=  mysql_fetch_array($res);
            ?>

            <div id="contenedor_inv">
                <div class="titulo_inv"><b>VEH&Iacute;CULO INVOLUCRADO <?php echo $cont; ?></b></div>
                    <div class="bloque_inv">
                        <table>
                            <tr>
                                <td>
                                    <div class="texto_inv">Nombre del usuario</div><br>
                                    <div class="campo_inv"><input type="text" id="nom_inv" name="nom_inv" class="sen-class" value="<?php echo $row['nombre'] ?>"></div>
                                </td>
                                <td>
                                    <div class="texto_inv">C&eacute;dula del usuario</div><br>
                                    <div class="campo_inv"><input type="text" id="ced_inv" name="ced_inv" class="sen-class" value="<?php echo $row['cedula'] ?>"></div>
                                </td>
                                <td>
                                    <div class="texto_inv">Tel&eacute;fono</div><br>
                                    <div class="campo_inv"><input type="text" id="tel_inv" name="tel_inv" value="<?php echo $row['telefono'] ?>" class="sen-class"></div>
                                </td>
                                <td>
                                    <div class="texto_inv">Celular</div><br>
                                    <div class="campo_inv"><input type="text" id="cel_inv" name="cel_inv" value="<?php echo $row['celular'] ?>" class="sen-class"></div>
                                </td>
                                <td>
                                    <div class="texto_inv">Placa del veh&iacute;culo</div>
                                    <div class="campo_inv"><input type="text" id="placa_inv" name="placa_inv" value="<?php echo $row['placa_veh'] ?>" class="sen-class"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="texto_inv">Color del Veh&iacute;culo</div>
                                    <div class="campo_inv">
                                        <select id="color_veh" name="color_veh" class="sen-class">
                                            <optgroup label="Seleccione">
                                                <option value="<?php echo $row['color_veh'] ?>"><?php echo $row['color_veh'] ?></option>
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
                                    <div class="texto_inv">Marca del veh&iacute;culo</div>
                                    <div class="campo_inv">
                                        <select id="marca_veh" name="marca_veh" class="sen-class">
                                            <optgroup label="Seleccione">
                                                <option value="<?php echo $row['marca_veh'] ?>"><?php echo $row['marca_veh'] ?></option>
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
                                                <option value="<?php echo $row['servicio_veh'] ?>"><?php echo $row['servicio_veh'] ?></option>
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
                                    <div class="campo_inv">
                                        <select id="tipo_veh" name="tipo_veh" class="sen-class">
                                            <optgroup label="Seleccione">
                                                <option value="<?php echo $row['tipo_veh'] ?>"><?php echo $row['tipo_veh'] ?></option>
                                                <option value="automovil">Automovil</option>
                                                <option value="bicicleta">Bicicleta</option>
                                                <option value="bus">Bus</option>
                                                <option value="camion">Camion</option>
                                                <option value="motocicleta">Motocicleta</option>
                                                <option value="tracto_camion">Tracto camion</option>
                                                <option value="volqueta">Volqueta</option>
                                                <option value="otro">Otro</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="texto_inv">Cilindraje del veh&iacute;culo</div>
                                    <div class="campo_inv"><select id="cilindraje_veh" name="cilindraje_veh" class="sen-class">
                                            <optgroup label="Seleccione">
                                                <option value="<?php echo $row["cilindraje"]; ?>"><?php echo $row["cilindraje"]; ?></option>
                                                    <?php
                                                    $consulta_cilndraje = "select * from tbl_cilindraje";
                                                    $resultado_cilindraje =  mysql_query($consulta_cilndraje,$link);
                                                    while ($fila = mysql_fetch_assoc($resultado_cilindraje)){
                                                    ?>
                                                <option value="<?php echo $fila["cilindraje"]; ?>"><?php echo $fila["cilindraje"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <input type="hidden" id="id_inv" name="id_inv" value="<?php echo $row['id_inv'];?>">
        </form>
    </body>
 </html>