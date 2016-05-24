<?php
session_start();
$con=$_SESSION[id_parte];
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Modificación de Victimas</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>
<form action="guardar_vic.php" id="form_vic" method="post">
              <div id="botonera_vic">
                  <input type="submit"  name="guardar" id="guardar" value="Guardar" class="bot">
                  <input type="button" name="cab" id="can" value="Cancelar" class="bot" onclick="location.href='selc_vic.php'">
              </div>
<?php
include 'funciones.php';
$link=Conectarse();

$id_parte=$_SESSION["id_parte"];
$id_vic=$_POST["dato"];

$cons="select * from tbl_victimas where id_vic='$id_vic'";
$res=  mysql_query($cons,$link);


$row=  mysql_fetch_array($res)
    ?>

    <div id="contenedor_vic">
                        <div class="titulo_inv"><b>RELACION DE VICTIMAS <?php echo $cont; ?></b></div>
                        <div class="bloque_inv">
                        <div class="bloque1_inv">
                        <div class="texto_inv">Nombre de la victima</div>
                        <div class="campo_inv"><input type="text" id="nom_vic" name="nom_vic" value="<?php echo $row['nombre_vic']; ?>" class="sen-class"></div>
                        <div class="texto_inv">Placa Vehiculo al que pertenece</div>
                        <?php
                        $consulta="SELECT * FROM tbl_involucrados where id_parte='$id_parte'";
                        $resul= mysql_query($consulta,$link);

                        ?>
                        <div class="campo_inv"><select id="pla_vic" name="pla_vic" class="sen-class">
                        <optgroup label="Seleccione">
                        <option value="<?php echo $row["placa_veh_vic"]?>"><?php echo $row["placa_veh_vic"]?></option>
                        <?php
                        while ($row1 = mysql_fetch_array($resul)){?>

                        <option value="<?php echo $row1["placa_veh"]?>"><?php echo $row1["placa_veh"]?></option>

                        <?php } ?>
                        </optgroup>
                            </select></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Cedula de la victima</div>
                        <div class="campo_inv"><input type="text" id="ced_vic" name="ced_vic" value="<?php echo $row['cedula']; ?>" class="sen-class"></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Estado de la victima</div>
                        <div class="campo_inv"><select id="estado_vic" name="estado_vic" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value="<?php echo $row['estado_vic']; ?>"><?php echo $row['estado_vic']; ?></option>
                                    <option value="muerto">Muerto</option>
                                    <option value="herido">Herido</option>
                                    </optgroup>
                            </select></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Tipo de victima</div>
                        <div class="campo_inv"><select id="rel_vic" name="rel_vic" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value="<?php echo $row['relacion_vic']; ?>"><?php echo $row['relacion_vic']; ?></option>
                                    <option value="motociclista">Motociclista</option>
                                    <option value="parrillero">Parrillero</option>
                                    <option value="conductor">Conductor</option>
                                    <option value="pasajero">Pasajero</option>
                                    <option value="ciclista">Ciclista</option>
                                    <option value="peaton">Peaton</option>
                                    </optgroup>
                            </select></div>
                        <div class="texto_inv"></div>
                        </div>

                            <input type="hidden" id="id_vic" name="id_vic" value="<?php echo $row['id_vic']; ?>">
                    </div>

                            </div>

</form>
                </body>
</html>
