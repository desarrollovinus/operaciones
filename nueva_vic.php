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
        <title>Registro de Victimas</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <script language="javascript" src="js/validaciones.js" type="text/javascript"></script>
    </head>
    <body>
<form action="vic_ins1.php" name="formvict1" id="formvict1" enctype="multipart/form-data" method="post" >
    <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $con ;?>" >
    <div id="contenedor_vic">
                        <div class="titulo_inv"><b>RELACION DE VICTIMAS</b></div>
                        <div class="bloque_inv">
                        <div class="bloque1_inv">
                        <div class="texto_inv">Nombre de la victima</div>
                        <div class="campo_inv"><input type="text" id="nom_vic" name="nom_vic" class="sen-class"></div>
                        <div class="texto_inv">Placa Vehiculo al que pertenece</div>
                        <?php
                        $consulta="SELECT * FROM tbl_involucrados where id_parte='$con'";
                        $resul= mysql_query($consulta,$link);

                        ?>
                        <div class="campo_inv"><select id="pla_vic" name="pla_vic" class="sen-class">
                        <optgroup label="Seleccione">
                        <option value=""></option>
                        <?php
                        while ($row = mysql_fetch_array($resul)){?>

                        <option value="<?php echo $row["placa_veh"]?>"><?php echo $row["placa_veh"]?></option>

                        <?php } ?>
                        </optgroup>
                            </select></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Cedula de la victima</div>
                        <div class="campo_inv"><input type="text" id="ced_vic" name="ced_vic" class="sen-class"></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Estado de la victima</div>
                        <div class="campo_inv"><select id="estado_vic" name="estado_vic" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="muerto">Muerto</option>
                                    <option value="herido">Herido</option>
                                    </optgroup>
                            </select></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Tipo de victima</div>
                        <div class="campo_inv"><select id="rel_vic" name="rel_vic" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="motociclista">Motociclista</option>
                                    <option value="parrillero">Parrillero</option>
                                    <option value="conductor">Conductor</option>
                                    <option value="pasajero">Pasajero</option>
                                    <option value="ciclista">Ciclista</option>
                                    <option value="peaton">Peaton</option>
                                    </optgroup>
                            </select></div>
                        <div class="texto_inv"></div>
                        <div class="campo_inv"><input type="submit" id="nueva_vic" name="nueva_vic" value="Guardar" class="botones" >
                        <input type="button" id="sig" name="sig" value="Cancelar" onclick="location.href='selc_vic.php'" class="botones"></div>
                        </div>


                    </div>

                            </div>
</form>
                </body>
</html>

