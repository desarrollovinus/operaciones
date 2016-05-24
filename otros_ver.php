<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
$ced=$_SESSION["ced"];
$id_parte=$_SESSION["id_parte"];
?>
<html>
    <head>
       <?php include 'funciones.php';
       $link=Conectarse();
       ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Otros</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>
            <?php
            //Se lee el registro que se acaba de insertar
            $consulta="SELECT * FROM tbl_otros where id_parte='$id_parte'";
            $resul= mysql_query($consulta,$link);
            $row = mysql_fetch_array($resul);
           ?>
            <div id="contenedor_otros_ins">
                <form action="guardar_otros.php" name="frm_ot_insp" id="frm_ot_insp" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>
            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
            </div>
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                        <b>Consecutivo</b>
                    </div>
                    <div class="campos">
                        <?php echo $id_parte; ?>
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Via</b>
                    </div>
                    <div class="campos">
                        <select id="via" name="via" class="sen-class" disabled="disabled">
                        <optgroup label="Seleccione">
                            <option value=""><?php echo $row["via"]; ?></option>

                            </optgroup>
                            </select>
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
                        <input type="text" id="abcisa" name="abcisa" value="<?php echo $row["abcisa"]; ?>" class="sen-class" disabled="disabled">
                    </div>
                </div>
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

                    <div class="titulo_cie">Fecha y Hora Inicio:</div>
                    <div class="campos_cie"><input type="text" id="h_ini_otros" name="h_ini_otros" value="<?php echo $row["h_ini_otros"]; ?>" disabled="disabled" class="sen-class1"></div>
                    <div class="titulo_cie">Fecha y Hora Fin:</div>
                    <div class="campos_cie"><input type="text" id="h_fin_otros" name="h_fin_otros" value="<?php echo $row["h_fin_otros"]; ?>" disabled="disabled" class="sen-class1"></div>
                </div>
            </div>
                 <div class="desc">
                     <div class="titulo_otr"><b>DESCRIPCION</b></div>
                     <textarea id="desc_otros" name="desc_otros"  class="text_otros_des" disabled="disabled" ><?php echo $row["descrip"]; ?></textarea>
                     <div class="boton_otros">
                     <input type="button" id="regresar" name="regresar" Value="Regresar" class="bot" onclick="location.href='ver.php'">
                 </div>
                </div>






                    </form>
                  </div>
                </body>
                </html>