<?php
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
       <?php include 'funciones.php';
       $link=Conectarse();
       ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Emergencias</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>
            <?php
            $consulta="SELECT * FROM tbl_emergencias where id_parte='$id_parte'";
            $resul= mysql_query($consulta,$link);
            $row = mysql_fetch_array($resul);
           ?>
            <div id="contenedor_us_inc">
                <form action="guardar_emer.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>
            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
            </div>
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                     Consecutivo
                    </div>
                    <div class="campos">
                       <?php echo $row["id_parte"];?>

                    </div>
                    </div>

                <div class="global">
                    <div class="titulos">
                        <b>Via</b>
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
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                </div>
                <div class="cie_horas">

                    <div class="titulo_cie">Fecha y Hora Inicio:</div>
                    <div class="campos_cie"><input type="text" id="h_ini_emer" name="h_ini_emer" class="sen-class1" value="<?php echo $row["h_ini_emer"]; ?>" disabled="disabled" ></div>
                    <div class="titulo_cie">Fecha y Hora Fin:</div>
                    <div class="campos_cie"><input type="text" id="h_fin_emer" name="h_fin_emer" class="sen-class1" value="<?php echo $row["h_fin_emer"]; ?>" disabled="disabled"></div>
                </div>
            </div>
                        <div class="desc2">
                            <div class="titulo_inv"><b>TIPO DE EMERGENCIA</b></div>

                    <div class="bloque2">
                        <div class="texto_inc">Derrame de sustancias:</div>
                        <?php if($row["derr_sustancias"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="derra_sust" name="derra_sust" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["derr_sustancias"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="derra_sust" name="derra_sust" class="checks1" disabled="disabled" ></div>
                        <?php } ?>
                        <div class="texto_inc">Derrumbe sobre la vía:</div>
                        <?php if($row["derr_via"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="derr_via" name="derr_via" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["derr_via"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="derr_via" name="derr_via" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Perdida de banca:</div>
                        <?php if($row["perd_banca"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="per_banca" name="per_banca" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["perd_banca"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="per_banca" name="per_banca" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_inc">Fuga de gas u otros productos:</div>
                        <?php if($row["fuga_gas"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="fuga_gas" name="fuga_gas" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["fuga_gas"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="fuga_gas" name="fuga_gas" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Problemas de orden público:</div>
                        <?php if($row["prob_orden"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="pro_orden" name="pro_orden" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["prob_orden"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="pro_orden" name="pro_orden" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_inc">Caida de puente:</div>
                        <?php if($row["caida_puente"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="cai_puente" name="cai_puente" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["caida_puente"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="cai_puente" name="cai_puente" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Desborde de quebradas u otros:</div>
                        <?php if($row["desb_queb"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="des_quebrada" name="des_quebrada" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["desb_queb"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="des_quebrada" name="des_quebrada" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_inc">Inundación:</div>
                        <?php if($row["inundacion"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="inundacion" name="inundacion" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["inundacion"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="inundacion" name="inundacion" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Incendio:</div>
                        <?php if($row["incendio"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="incendio" name="incendio" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["incendio"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="incendio" name="incendio" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_inc">Otros, Cual?:</div>
                        <div class="otro_inc"><input type="text" id="otros_em" name="otros_em" class="sen-class" value="<?php echo $row["otros"]; ?>" disabled="disabled" ></div>
                    </div>

               </div>
                        <div class="desc1">
                            <div class="titulo_inv"><b>DESCRIPCION</b></div>
                            <textarea id="desc_eme" name="desc_eme" class="textare_inc" disabled="disabled"><?php echo $row["descrip"]; ?></textarea>
                            <div class="boton_inc"><input type="button" id="regresar" name="regresar" Value="Regresar" class="bot" onclick="location.href='ver.php'"></div>
                        </div>




                    </form>
                  </div>
                  Firma:_____________________________
                </body>
                </html>