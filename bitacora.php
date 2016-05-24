<?php
//Se define zona horaria
date_default_timezone_set('America/Bogota');
session_start();
?>

<html>
    <head>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Añadir registro en bitácora</title>
    </head>
    <body>
    <?php
    //Se conecta con la base de datos
    include("funciones.php");
    
    $link=Conectarse();
    $ced=$_SESSION["ced"];
    $fechahora= date('Y-m-d H:i:s');
    ?>
        <form action="procesar.php" name="frmc" id="frmc" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
                <div class="logo"></div>
                <input type="hidden" id="ced" name="ced" value="<?php echo $ced; ?>">
            </div>
            <div id="contenedor">
                <table width="900" border="0" cellspacing="0" cellpadding="0" align="left" class="tabla" >
                    <tr>
                        <td>
                            <table border="0" style="border: none">
                                <tr>
                                    <td>
                                        <b><font size="2">FECHA Y HORA</font></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo $fechahora; ?>
                                        <input type="hidden" id="fecha" name="fecha" value="<?php echo date('Y-m-d H:i:s'); date("Y")." - ".date("m")." - ".date("s")."  ".date("H:i:s"); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><font size="2"> PERSONA QUE REPORTA</font></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" id="per_reporta" name="per_reporta" size="30" >
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table border="0" style="border: none">
                                <tr>
                                    <td>
                                        <b><font size="2">ASUNTO</font></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="asunto" id="asunto" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><font size="2">DAÑOS</font></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" id="danos" name="danos" size="30">
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table border="0" style="border: none">
                                <tr>
                                    <td>
                                        <b><font size="2"> MOTIVO</font></b>
                                    </td>
                                    <td>
                                        <b><font size="2"> HERIDOS</font></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select id="com_motivo" name="com_motivo">
                                            <optgroup label="Seleccione">
                                                <option value=""></option>
                                                <option value="accidente">Accidente</option>
                                                <option value="accidente_cancelado">Accidente Cancelado</option>
                                                <option value="cierre de via">Cierre de via</option>
                                                <option value="incidente">Incidente</option>
                                                <option value="emergencias">Emergencias</option>
                                                <option value="otros">Otros</option>
                                            </optgroup>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="com_heridos" name="com_heridos">
                                            <optgroup label="Seleccione">
                                                <option value=""></option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </optgroup>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <b><font size="2"> UBICACION REPORTADA</font></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="text" id="ubi_reportada" name="ubi_reportada" size="50">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="50px">
                        <td colspan="2"><b><center size="2">EMISOR</center></b></td>
                        <td><b><center size="2">IMPORTANCIA</center></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table border="0" style="border: none" width="100%" >
                                <tr>
                                    <td>
                                        <input type="radio" name="emisor"  id="ambulancia" value="ambulancia concesion">
                                        <label for="ambulancia">Ambulancia</label>
                                    </td>
                                    <td>
                                        <input type="radio" name="emisor" id="bomberos" value="bomberos">
                                        <label for="bomberos">Bomberos</label>
                                    </td>
                                    <td>
                                        <input type="radio" name="emisor"  id="defensa" value="defensa civil">
                                        <label for="defensa">Defensa Civil</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="emisor" id="grua_planchon" value="grua planchon">
                                        <label for="grua_planchon">Grúa planchón</label>
                                    </td>
                                    <td>
                                        <input type="radio" name="emisor" id="grua_pluma" value="grua pluma">
                                        <label for="grua_pluma">Grúa pluma</label>
                                    </td>
                                    <td>
                                        <input type="radio" name="emisor" id="inspector" value="inspector vial">
                                        <label for="inspector">Inspector vial</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="emisor" id="peaje_cisneros" value="peaje cisneros">
                                        <label for="peaje_cisneros">Peaje Cisneros</label>
                                    </td>
                                    <td>
                                        <input type="radio" name="emisor" id="mantenimiento" value="mantenimiento">
                                        <label for="mantenimiento">Personal mantenimiento</label>
                                    </td>
                                    <td>
                                        <input type="radio" name="emisor" id="poli_transito_cisneros" value="politto cisneros">
                                        <label for="poli_transito_cisneros">Policía de Tránsito Cisneros</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="emisor" id="poli_transito_nus" value="politto nus">
                                        <label for="poli_transito_nus">Policía de Tránsito Nus</label>
                                    </td>
                                    <td>
                                        <input type="radio" name="emisor" id="us018000" value="usuario 018000">
                                        <label for="us018000">Usuario 018000</label>
                                    </td>
                                    <td>
                                        <input type="radio" name="emisor" id="otros" value="otros">
                                        <label for="otros">otros</label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table border="0" style="border: none; text-align: center;" width="100%" >
                                <tr>
                                    <td>
                                        <input type="radio" name="importancia" id="alta" value="alta">
                                        <label for="alta"><b>ALTA</b></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="importancia" id="media" value="media">
                                        <label for="media"><b>MEDIA</b></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="importancia" id="baja" value="baja">
                                        <label for="baja"><b>BAJA</b></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="importancia" id="sin" value="sin">
                                        <label for="sin"><b>SIN</b></label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="50px">
                        <td colspan="3"><b><center size="2">ANOTACIONES</center></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <textarea name="anotacion" id="anotacion" class="textarea" ></textarea>
                            </center>
                        </td>
                        <td>
                            <center>
                                <input type="submit" id="guardar" name="guardar" class="button" value="Guardar informacion en bitacora" ><br><br>
                                <input type="button" name="salir" id="salir" class="button" value="Salir sin guardar" onclick="location.href='querys.php'">
                           </center>
                        </td>
                    </tr>
                </table>
                <!-- <table width="900" border="0" cellspacing="0" cellpadding="0" align="left" class="tabla" >
                    <tr>
                        <td align="center" colspan="1" ><b></b></td>
                        <td align="center" colspan="2"><b><font size="2">FECHA Y HORA</font></b></td>
                        <td align="center" colspan="2"> <b><font size="2">ASUNTO</font></b> </td>
                        <td align="center" colspan="1"><b><font size="2"> MOTIVO</font></b></td>
                        <td align="center" colspan="2"><b><font size="2">HERIDOS</font></b></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="1">
                            <input type="hidden" id="consecutivo" name="consecutivo" value="<?php #echo $consecutivo;?>" >
                        </td>
                        <td align="center" colspan="2">
                            <?php // echo $fechahora; ?>
                            <input type="hidden" id="fecha" name="fecha" value="<?php // echo date('Y-m-d H:i:s'); //date("Y")." - ".date("m")." - ".date("s")."  ".date("H:i:s"); ?>">
                        </td>
                        <td align="center" colspan="2"><input type="text" name="asunto" id="asunto" size="30"></td>
                        <td align="center" colspan="1">
                            <select id="com_motivo" name="com_motivo">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="accidente">Accidente</option>
                                    <option value="accidente_cancelado">Accidente Cancelado</option>
                                    <option value="cierre de via">Cierre de via</option>
                                    <option value="incidente">Incidente</option>
                                    <option value="emergencias">Emergencias</option>
                                    <option value="otros">Otros</option>
                                </optgroup>
                            </select>
                        </td>
                        <td align="center" colspan="2">
                            <select id="com_heridos" name="com_heridos">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </optgroup>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                           <b><font size="2"> PERSONA QUE REPORTA</font></b>
                        </td>
                        <td colspan="2" align="center">
                            <b><font size="2">DAÑOS</font></b>
                        </td>
                        <td colspan="4" align="center" >
                            <b><font size="2"> UBICACION REPORTADA</font></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <input type="text" id="per_reporta" name="per_reporta" size="30" >
                        </td>
                        <td colspan="2" align="center">
                            <input type="text" id="danos" name="danos" size="30">
                        </td>
                        <td colspan="4" align="center" >
                            <input type="text" id="ubi_reportada" name="ubi_reportada" size="50">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="6">
                            <b><font size="2">EMISOR</font></b>
                        </td>
                        <td align="center" colspan="3">
                            <b><font size="2">IMPORTANCIA</font></b>
                        </td>
                    </tr>

                    <tr>
                        <td align="right" width="5%" class="check1">
                            <input type="radio" name="emisor" id="us018000" value="usuario 018000">
                        </td>
                        <td align="left" class="label4">
                            Usuario 018000
                        </td>
                        <td align="right" width="5%" class="check1">
                            <input type="radio" name="emisor" id="mantenimiento" value="mantenimiento">
                        </td>
                        <td align="left" class="label4">
                            Mantenimiento
                        </td>
                        <td align="right" width="5%" class="check1">
                            <input type="radio" name="emisor" id="politransito" value="policia de transito" >
                        </td>
                        <td align="left" width="30%" class="label5">
                            Policia de transito
                        </td>
                        <td align="right" class="check1">
                            <input type="radio" name="importancia" id="alta" value="alta"><br>
                        </td>
                        <td align="left" class="label4" >
                            <b>ALTA</b>
                        </td>
                    </tr>
                    <tr>
                       <td align="right" width="5%" class="check">
                            <input type="radio" name="emisor" id="ustel" value="usuario tel">
                        </td>
                        <td align="left" class="label">
                            Usuario Tel
                        </td>
                        <td align="right" width="5%" class="check">
                           <input type="radio" name="emisor" id="peajes" value="peajes regency">
                        </td>
                        <td align="left" class="label">
                            Peajes Regency
                        </td>
                        <td align="right" width="5%" class="check">
                            <input type="radio" name="emisor" id="dogman" value="dogman seguridad">
                        </td>
                        <td align="left" width="30%" class="label3">
                            Dogman Seguridad
                        </td>
                        <td align="right" class="check">
                            <input type="radio" name="importancia" id="media" value="media">
                        </td>
                        <td align="left" class="label1" >
                            <b>MEDIA</b>
                        </td>
                    </tr>
                    <tr>
                       <td align="right" width="5%" class="check">
                            <input type="radio" name="emisor" id="inspector" value="inspector vial">
                        </td>
                        <td align="left" class="label">
                            Inspector Vial
                        </td>
                        <td align="right" width="5%" class="check">
                           <input type="radio" name="emisor" id="radiooper" value="radio operador CCO">
                        </td>
                        <td align="left" class="label">
                            Radio operador CCO
                        </td>
                        <td align="right" width="5%" class="check">
                            <input type="radio" name="emisor" id="haceb" value="haceb">
                        </td>
                        <td align="left" width="30%" class="label3">
                            Haceb (quitar)
                        </td>
                        <td align="right" class="check">
                            <input type="radio" name="importancia" id="baja" value="baja">
                        </td>
                        <td align="left" class="label1" >
                            <b>BAJA</b>
                        </td>
                    </tr>
                    <tr>
                      <td align="right" width="5%" class="check">
                           <input type="radio" name="emisor" id="grua" value="grua concesion">
                       </td>
                       <td align="left" class="label">
                           Grua concesion
                       </td>
                       <td align="right" width="5%" class="check">
                          <input type="radio" name="emisor" id="bomberos" value="bomberos">
                       </td>
                       <td align="left" class="label">
                           Bomberos
                       </td>
                       <td align="right" width="5%" class="check">
                           <input type="radio" name="emisor" id="otros" value="otros">
                       </td>
                       <td align="left" width="30%" class="label3">
                           Otros, Cual?
                       </td>
                       <td align="right" class="check">
                           <input type="radio" name="importancia" id="sin" value="sin">
                       </td>
                       <td align="left" class="label1" >
                           <b>SIN</b>
                       </td>
                   </tr>
                    <tr>
                      <td align="right" width="5%" class="check">
                           <input type="radio" name="emisor" id="politto" value="tramo norte politto">
                       </td>
                       <td align="left" class="label">
                           Tramo norte politto
                       </td>
                       <td align="right" width="5%" class="check">
                          <input type="radio" name="emisor"  id="defensa" value="defensa civil">
                       </td>
                       <td align="left" class="label">
                           Defensa Civil
                       </td>
                       <td class="label"></td>
                       <td width="30%" class="label3">
                         <input type="text">
                       </td>
                   </tr>
                    <tr>
                       <td align="right" class="check">
                            <input type="radio" name="emisor"  id="pershatovial" value="personal hatovial">
                        </td>
                        <td align="left" class="label">
                            Personal Vinus
                        </td>
                        <td align="right" class="check">
                           <input type="radio" name="emisor"  id="ambulancia" value="ambulancia concesion">
                        </td>
                        <td align="left" class="label">
                            Ambulancia concesion
                        </td>
                        <td class="label"> </td>
                        <td class="label3">. </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="8">
                            <b><font size="2">ANOTACIONES</font></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <center>
                                <textarea name="anotacion" id="anotacion" class="textarea" ></textarea>
                            </center>
                        </td>
                       <td colspan="2">
                           <center>
                                <input type="submit" id="guardar" name="guardar" class="button" value="Guardar informacion en bitacora" ><br><br>
                                <input type="button" name="salir" id="salir" class="button" value="Salir sin guardar" onclick="location.href='querys.php'">
                           </center>
                       </td>
                    </tr>
                </table> -->
            </div>
        </form>
    </body>
</html>