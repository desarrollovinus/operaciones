<?php
session_start();
$con=$_SESSION['id_parte'];
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
        <form action="inv_ins.php" name="forminvol" id="forminvol" enctype="multipart/form-data" method="post" >
            <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $con ;?>" >
            <div id="contenedor_inv">
                <div class="titulo_inv"><b>VEH&Iacute;CULOS INVOLUCRADOS</b></div>
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
                            <div class="texto_inv">Placa del veh&iacute;culo</div>
                            <div class="campo_inv"><input type="text" id="placa_inv" name="placa_inv" class="sen-class"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="texto_inv">Color del Veh&iacute;culo</div>
                            <div class="campo_inv">
                                <select id="color_veh" name="color_veh" class="sen-class">
                                    <optgroup label="Seleccione">
                                        <option value=""></option>
                                            <?php
                                            $consulta10="select * from tbl_colores order by color";
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
                                        <option value=""></option>
                                            <?php
                                            $consulta2="select * from tbl_marcas order by nombre";
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
                            <div class="texto_inv">Tipo del veh&iacute;culo</div>
                            <div class="campo_inv">
                                <select id="tipo_veh" name="tipo_veh" class="sen-class">
                                    <optgroup label="Seleccione">
                                        <option value=""></option>
                                        <option value="automovil">Automovil</option>
                                        <option value="bicicleta">Bicicleta</option>
                                        <option value="bus">Bus</option>
                                        <option value="camion">Camion</option>
                                        <option value="motocicleta">Motocicleta</option>
                                        <option value="tracto_camion">Tracto camion</option>
                                        <option value="volqueta">Volqueta</option>
                                        <option value="otros">Otros</option>
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
                        <td><div class="campo_inv"><input type="submit" name="nuevo" id="nuevo" value="Añadir" class="botones">
                            <input type="button" name="next" id="next" value="Siguiente" onclick="location.href='victimas.php'" class="botones"></div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table><br>
                <table border=1 cellspacing=1 cellpadding=1 width="900" >
                    <tr align="center">
                        <td>&nbsp;<b>NOMBRE</b></td>
                        <td>&nbsp;<b>C&Eacute;DULA</b>&nbsp;</td>
                        <td>&nbsp;<b>TELEFONO</b>&nbsp;</td>
                        <td>&nbsp;<b>CELULAR</b>&nbsp;</td>
                        <td>&nbsp;<b>PLACA</b>&nbsp;</td>
                        <td>&nbsp;<b>COLOR</b>&nbsp;</td>
                        <td>&nbsp;<b>MARCA</b>&nbsp;</td>
                        <td>&nbsp;<b>SERVICIO</b>&nbsp;</td>
                        <td>&nbsp;<b>TIPO</b>&nbsp;</td>
                        <td>&nbsp;<b>CILINDRAJE</b>&nbsp;</td>
                    </tr>
                    <?php
                    $consul="select * from tbl_involucrados where id_parte=$con";
                    $result=mysql_query($consul,$link);
                    
                    while($vect_ins = mysql_fetch_assoc($result)) {
                        printf(
                            "<tr width=900px>
                                <td >&nbsp;%s</td>
                                <td align ='right'>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td align ='right'>&nbsp;%s c.c.&nbsp;</td>
                            </tr>",
                        $vect_ins["nombre"],$vect_ins["cedula"],$vect_ins["telefono"],$vect_ins["celular"],$vect_ins["placa_veh"],$vect_ins["color_veh"],$vect_ins["marca_veh"],$vect_ins["servicio_veh"],$vect_ins["tipo_veh"],$vect_ins["cilindraje"]);
                    }//Fin while
                    ?>
                </table>
            </div>
        </form>
    </body>
</html>
