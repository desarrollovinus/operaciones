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
        <title>Registro de Emergencias</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>
             <?php
            //Se lee el registro que se acaba de insertar
            $consulta="SELECT * FROM tbl_parte where motivo_parte=''";
            $resul= mysql_query($consulta,$link);

            //$id_parte=$row[id_parte];
           ?>
            <div id="contenedor_us_inc">
                <form action="guardar_emer_up.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>

            </div>
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                        <b>Consecutivo</b>
                    </div>
                    <div class="campos">
                        <select id="id_parte" name="id_parte">
                    <optgroup label="Seleccione">
                    <option value=""></option>
                    <?php while($row = mysql_fetch_array($resul)){?>
                    <option value="<?php echo $row[id_parte]; ?>"><?php echo $row[id_parte]; ?></option>
                    <?php } ?>
                    </optgroup>
                    </select>
                    </div>
                    </div>

                <div class="global">
                    <div class="titulos">
                        <b>Via</b>
                    </div>
                    <div class="campos">
                        <select id="via" name="via" class="sen-class">
                        <optgroup label="Seleccione">
                            <option value=""></option>
                            <option value="2510">2510</option>
                            <option value="6205">6205</option>
                            <option value="Departamental">Departamental</option>
                            </optgroup>
                            </select>
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Tramo</b>
                    </div>
                    <div class="campos">
                        <select id="tramo" name="tramo" class="sen-class">
                        <optgroup label="Seleccione">
                            <option value=""></option>
                            <option value="1">Tramo 1</option>
                            <option value="4">Tramo 4</option>
                            <option value="5">Tramo 5</option>
                            <option value="6">Tramo 6</option>
                            <option value="8">Tramo 8</option>
                            <option value="9">Tramo 9</option>
                            <option value="10">Tramo 10</option>
                            </optgroup>
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
                
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                </div>
                <div class="cie_horas">

                    <div class="titulo_cie">Fecha y Hora Inicio:</div>
                    <div class="campos_cie"><input type="text" id="h_ini_emer" name="h_ini_emer" class="sen-class1"></div>
                    <div class="titulo_cie">Fecha y Hora Fin:</div>
                    <div class="campos_cie"><input type="text" id="h_fin_emer" name="h_fin_emer" class="sen-class1"></div>
                </div>
            </div>
                        <div class="desc">
                            <div class="titulo_inv"><b>TIPO DE EMERGENCIA</b></div>

                    <div class="bloque2">
                        <div class="texto_inc">Derrame de sustancias:</div>
                        <div class="check_inc"><input type="checkbox" id="derra_sust" name="derra_sust" value="X" class="checks1"></div>
                        <div class="texto_inc">Derrumbe sobre la vía:</div>
                        <div class="check_inc"><input type="checkbox" id="derr_via" name="derr_via" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Perdida de banca:</div>
                        <div class="check_inc"><input type="checkbox" id="per_banca" name="per_banca" value="X" class="checks1"></div>
                        <div class="texto_inc">Fuga de gas u otros productos:</div>
                        <div class="check_inc"><input type="checkbox" id="fuga_gas" name="fuga_gas" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Problemas de orden público:</div>
                        <div class="check_inc"><input type="checkbox" id="pro_orden" name="pro_orden" value="X" class="checks1"></div>
                        <div class="texto_inc">Caida de puente:</div>
                        <div class="check_inc"><input type="checkbox" id="cai_puente" name="cai_puente" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Desborde de quebradas u otros:</div>
                        <div class="check_inc"><input type="checkbox" id="des_quebrada" name="des_quebrada" value="X" class="checks1"></div>
                        <div class="texto_inc">Inundación:</div>
                        <div class="check_inc"><input type="checkbox" id="inundacion" name="inundacion" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Incendio:</div>
                        <div class="check_inc"><input type="checkbox" id="incendio" name="incendio" value="X" class="checks1"></div>
                        <div class="texto_inc">Otros, Cual?:</div>
                        <div class="otro_inc"><input type="text" id="otros_em" name="otros_em" class="sen-class"></div>
                    </div>

               </div>
                        <div class="desc1">
                            <div class="titulo_inv"><b>DESCRIPCION</b></div>
                            <textarea id="desc_eme" name="desc_eme" class="textare_inc"></textarea>
                            <div class="boton_inc">
                                <input type="submit" id="guardar" name="guargar" Value="Guardar" class="bot">
                                <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                            </div>
                        </div>




                    </form>
                  </div>
                </body>
                </html>