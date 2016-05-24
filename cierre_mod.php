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

            $consulta="SELECT * FROM tbl_cierre where id_parte='$id_parte'";
            $resul= mysql_query($consulta,$link);
            $row = mysql_fetch_array($resul);
       ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Cierre de via</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>

            <div id="contenedor_cierre">
                <form action="mod_cierre.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>

            </div>
             <div class="encabezado1">
                <div class="cie_horas">

                    <div class="titulo_cie"><b>Relacionar al parte:</b></div>
                    <div class="campos_cie"><?php echo $row["id_parte"]; ?></div>
                    <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $row["id_parte"]; ?>">
                </div>
            </div>
            <div class="encabezado">
                <div class="cie_horas">
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                </div>
                <div class="cie_horas">

                    <div class="titulo_cie">Fecha y Hora Inicio de Cierre:</div>
                    <div class="campos_cie"><input type="text" id="h_ini_cie" name="h_ini_cie" class="sen-class1" value="<?php echo $row["fechahoraini"]; ?>" ></div>
                    <div class="titulo_cie">Fecha y Hora Fin de Cierre:</div>
                    <div class="campos_cie"><input type="text" id="h_fin_cie" name="h_fin_cie" class="sen-class1" value="<?php echo $row["fechahorafin"]; ?>" ></div>
                </div>
            </div>
                 <div class="desc">
                 <div class="titulo_asis_ci"><b>SERVICIO PRESENTE EN EL CIERRE DE VIA</b></div>

                    <div class="bloque2">
                        <div class="texto_inc">Ambulancia:</div>
                        <?php if($row["amb"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="amb" name="amb" value="X"  class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["amb"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="amb" name="amb" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Grua Concesión:</div>
                        <?php if($row["grua_con"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="grua" name="grua" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["grua_con"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="grua" name="grua" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Agentes de transito:</div>
                        <?php if($row["agen_tran"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="agen_tran" name="agen_tran" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["agen_tran"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="agen_tran" name="agen_tran" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Señalización:</div>
                        <?php if($row["sena"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="sena" name="sena" class="checks1" value="X" checked ></div>
                        <?php } ?>
                        <?php if($row["sena"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="sena" name="sena" class="checks1" value="X" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Policía Nacional:</div>
                        <?php if($row["pol_nal"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="pol_nal" name="pol_nal" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["pol_nal"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="pol_nal" name="pol_nal" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Bomberos:</div>
                        <?php if($row["bom"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="bom" name="bom" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["bom"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="bom" name="bom" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Defensa Civil:</div>
                        <?php if($row["def_civil"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="def_civil" value="X"  name="def_civil" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["def_civil"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="def_civil" value="X" name="def_civil" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Fiscalia:</div>
                        <?php if($row["fiscalia"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="fisc" value="X" name="fisc" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["fiscalia"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="fisc" value="X" name="fisc" class="checks1" ></div>
                        <?php } ?>
                    </div>
                 <div class="bloque2">
                        <div class="texto_inc">Director Operativo:</div>
                        <?php if($row["dir_ope"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="dir_ope" value="X" name="dir_ope" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["dir_ope"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="dir_ope" value="X" name="dir_ope" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Policía de carreteras:</div>
                        <?php if($row["pol_car"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="pol_car" value="X" name="pol_car" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["pol_car"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="pol_car" value="X" name="pol_car" class="checks1" ></div>
                        <?php } ?>
                    </div>
                 <div class="bloque2">
                        <div class="texto_inc">Inspector Víal:</div>
                        <?php if($row["insp_vial"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="ins_vial" value="X" name="ins_vial" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["insp_vial"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="ins_vial" value="X" name="ins_vial" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Policia Transito:</div>
                        <?php if($row["pol_tran"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="pol_tran" value="X" name="pol_tran" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["pol_tran"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="pol_tran" value="X" name="pol_tran" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Mantenimiento:</div>
                        <?php if($row["mant"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="mant" name="mant" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["mant"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="mant" name="mant" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Residente Operativo:</div>
                        <?php if($row["res_ope"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="res_ope" name="res_ope" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["res_ope"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="res_ope" name="res_ope" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Otros, Cual?:</div>
                        <div class="otro_inc"><input type="text" id="otros_ser" name="otros_ser" class="sen-class1" checked ></div>
                     
                    </div>

               </div>
                        <div class="desc1">
                            <div class="titulo_inv"><b>DESCRIPCION</b></div>
                            <textarea id="desc_hechos" name="desc_hechos"  class="textare_inc"><?php echo $row["descrip"]; ?></textarea>
                            <div class="boton_inc">
                                <input type="submit" id="guardar" name="gruardar" Value="Guardar" class="bot" >
                                <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                            </div>
                        </div>

                    </form>
                  </div>
                </body>
                </html>