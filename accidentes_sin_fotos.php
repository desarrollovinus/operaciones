<?php
//Se carga el archivo de funciones
include 'funciones.php';

//Se hace la consulta de todos los accidentes
// $consulta = mysql_query("Select * from tbl_accidente where fotos = 0 order by id_parte", Conectarse());
$consulta = mysql_query("Select * from tbl_accidente order by id_parte", Conectarse());

//Se cuenta la cantidad de accidentes que no tienen fotos
if(mysql_num_rows($consulta) == 0){
    echo utf8_decode("No se han encontrado accidentes sin registros fotográfico");
}else{
    echo "Se han encontrado ".number_format(mysql_num_rows($consulta), 0, '', '.')." accidentes sin fotograf&iacute;as";
}

//Se establece la ruta de las fotos
$ruta = "files/";
?>
<html>
    <head>
        <title>Accidentes sin fotos</title>
    </head>
    <body>
        <!--Tabla que mostrara los accidentes que no tienen fotos-->
        <table border="1" style="text-align: right; width: 100%">
            <!--Se abre una fila para empezar a llenar la tabla-->
            <tr>
            <?php
            //Se declara el contador que va a controlar la cantidad de celdas
            $cont = 0;
            
            //Se declara el contador que va a controlar la cantidad de imagenes
            $numero_archivos = 0;
            
            //Se empiezan a recorrer los accidentes
            while ( $row = mysql_fetch_array($consulta)){
                //Se aumenta el contador de celdas
                $cont++;
                
                //Se recorre cada carpeta en busca de imagenes
                foreach(glob($ruta.$row['id_parte']."/*") as $archivo){
                    //se aumenta el contador de imagenes
                    $numero_archivos++;
                }
                
                //Se pone un 1 a todos los accidentes que tienen fotos
                if($numero_archivos > 0){
                    //Consulta que hara el update
                    $insercion = "update tbl_accidente set fotos = 1 where id_parte = ".$row['id_parte'];
                    //Ejecucion de la consulta
                    mysql_query($insercion, Conectarse());
                }else{
                    //Consulta que hara el update
                    $insercion = "update tbl_accidente set fotos = 0 where id_parte = ".$row['id_parte'];
                    //Ejecucion de la consulta
                    mysql_query($insercion, Conectarse());
                }
                ?>
                <!--Se abre la celda-->
                <td>
                    <?php
                    //Se imprime el id del parte correspondiente a ese accidente
                    echo $row['id_parte'];
                    
                    //Se resetea el numero de imagenes
                    $numero_archivos = 0;
                    ?>
                </td>
                <?php
                //Se controla que la celda llegue al limite
                if ($cont % 30 == 0){
                ?>
            <!--Cuando la celda llegue al limite, se va a cerrar la fila y se abre una fila nueva-->    
            </tr>
            <tr>
            <?php 
                }//Fin if
            }//Fin while
            ?>
            <!--Finalmente se cierra la fila-->
            </tr>
        </table>
    </body>
</html>
