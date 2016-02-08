<?php
include ("panel/conn1.php");

/*
//Añadir CAMPO A TABLA
$anadir="ALTER TABLE ";
$anadir.="cliente";
$anadir.=" ADD vendedor VARCHAR(113) not null ";
mysql_query($anadir, $conn1);
*/
//$resultado = mysql_query("SHOW COLUMNS FROM cliente");

$resultado = mysql_query("SHOW COLUMNS FROM cliente");
while ($fila = mysql_fetch_assoc($resultado)) {
        print_r($fila);
        echo '<br>';
    }

/*$sql1 = "SELECT * FROM evento_act  ORDER BY id DESC LIMIT 0,10";
  $result1 = mysql_query($sql1, $conn1);
  while($row = mysql_fetch_array($result1)){
    $sql2 = "SELECT * FROM evento WHERE id='".$row["evento"]."' ORDER BY id DESC";
    $result2 = mysql_query($sql2, $conn1);
    $row2 = mysql_fetch_array($result2);
    echo '('.$row["id"].') cat:'.$row["evento_cat"].' - evento: ('.$row["evento"].') '.$row2["evento"].'<br>'.' - fecha: '.$row["fecha"].'<br>';
  };*/



/* 
$anadir="ALTER TABLE ";
$anadir.="evento";
$anadir.=" ADD cerrarforz VARCHAR(140) not null ";
mysql_query($anadir, $conn1);

$resultado = mysql_query("SHOW COLUMNS FROM evento");
if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
if (mysql_num_rows($resultado) > 0) {
    while ($fila = mysql_fetch_assoc($resultado)) {
        print_r($fila);
        echo '<br>';
    }
}//*/
/*
$sql11 = "INSERT INTO evento_cat(nombre, fecha, archivo, serie, folio, importe, checkedeve, se_publica, orden) 
VALUES('Llamadas*', '1', '0', '0', '0', '0', '1', 's', '1')";
$result = mysql_query($sql11);

$sql11 = "INSERT INTO evento_cat(nombre, fecha, archivo, serie, folio, importe, checkedeve, se_publica, orden) 
VALUES('Visitas', '1', '0', '0', '0', '0', '1', 's', '2')";
$result = mysql_query($sql11);

$sql11 = "INSERT INTO evento_cat(nombre, fecha, archivo, serie, folio, importe, checkedeve, se_publica, orden) 
VALUES('Cotizacion', '1', '1', '1', '1', '1', '1', 's', '4')";
$result = mysql_query($sql11);

$sql11 = "INSERT INTO evento_cat(nombre, fecha, archivo, serie, folio, importe, checkedeve, se_publica, orden) 
VALUES('Cierre', '1', '1', '1', '1', '1', '1', 's', '6')";
$result = mysql_query($sql11);

$sql11 = "INSERT INTO evento_cat(nombre, fecha, archivo, serie, folio, importe, checkedeve, se_publica, orden) 
VALUES('Diagnostico', '1', '0', '0', '0', '0', '1', 's', '3')";
$result = mysql_query($sql11);

$sql11 = "INSERT INTO evento_cat(nombre, fecha, archivo, serie, folio, importe, checkedeve, se_publica, orden) 
VALUES('Muestra', '1', '0', '0', '0', '0', '1', 's', '5')";
$result = mysql_query($sql11);
//*/
/*       
$sql1 = "DELETE FROM evento_cat WHERE id='7'  ";
  $result = mysql_query($sql1);
$sql1 = "DELETE FROM evento_cat WHERE id='8'  ";
  $result = mysql_query($sql1);
$sql1 = "DELETE FROM evento_cat WHERE id='9'  ";
  $result = mysql_query($sql1);
//*/

/*$tabla="CREATE TABLE IF NOT EXISTS `cliente` ( 
                  `id` int NOT NULL auto_increment, 
                  `nombre_empresa` varchar(111) NOT NULL, 
                  `contacto` varchar(111) NOT NULL, 
                  `email` varchar(111) NOT NULL, 
                  `celular` varchar(111) NOT NULL, 
                  `telefono` varchar(111) NOT NULL, 
                  `domicilio` varchar(111) NOT NULL, 
                  `calle` varchar(111) NOT NULL, 
                  `colonia` varchar(111) NOT NULL, 
                  `ciudad` varchar(111) NOT NULL, 
                  `estado` varchar(111) NOT NULL, 
                  `cospos` varchar(111) NOT NULL, 
                  `rfc` varchar(111) NOT NULL, 
                  `razonsocial` varchar(111) NOT NULL, 
                  PRIMARY KEY  (`id`)                
) "; //*/
/*
$tabla="CREATE TABLE IF NOT EXISTS `evento` ( 
                  `id` int NOT NULL auto_increment, 
                  `evento` varchar(111) NOT NULL, 
                  `cliente` varchar(111) NOT NULL, 
                  `fecha_captura` datetime NOT NULL, 
                  `celular` varchar(111) NOT NULL, 
                  `comentarios` varchar(111) NOT NULL, 
                  `vendedor` varchar(111) NOT NULL, 
                   PRIMARY KEY  (`id`) 
) ";
$crear_tabla=mysql_query($tabla,$conn1) or die(mysql_error()); 
//$result3 = mysql_query($sql3, $conn1);

$resultado = mysql_query("SHOW COLUMNS FROM evento");
if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
if (mysql_num_rows($resultado) > 0) {
    while ($fila = mysql_fetch_assoc($resultado)) {
        print_r($fila);
        echo '<br>';
    }
}
echo '<br>' ;
$tabla="CREATE TABLE IF NOT EXISTS `evento_act` ( 
                  `id` int NOT NULL auto_increment, 
                  `evento` varchar(111) NOT NULL, 
                  `evento_cat` varchar(111) NOT NULL, 
                  `checkedeve` varchar(111) NOT NULL, 
                  `fecha` datetime NOT NULL, 
                  `archivo` varchar(111) NOT NULL, 
                  `folio` varchar(111) NOT NULL, 
                  `serie` varchar(111) NOT NULL, 
                  `importe` varchar(111) NOT NULL, 
                  `vendedor` varchar(111) NOT NULL, 
                   PRIMARY KEY  (`id`) 
) "; 
$crear_tabla=mysql_query($tabla,$conn1) or die(mysql_error()); 
//$result3 = mysql_query($sql3, $conn1);

$resultado = mysql_query("SHOW COLUMNS FROM evento_act");
if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
if (mysql_num_rows($resultado) > 0) {
    while ($fila = mysql_fetch_assoc($resultado)) {
        print_r($fila);
        echo '<br>';
    }
}
echo '<br>';
$tabla="CREATE TABLE IF NOT EXISTS `evento_cat` ( 
                  `id` int NOT NULL auto_increment, 
                  `nombre` varchar(111) NOT NULL, 
                  `fecha` datetime NOT NULL, 
                  `archivo` varchar(111) NOT NULL, 
                  `serie` varchar(111) NOT NULL, 
                  `folio` varchar(111) NOT NULL, 
                  `importe` varchar(111) NOT NULL,
                  `checkedeve` varchar(111) NOT NULL,
                  `se_publica` varchar(111) NOT NULL,
                  `orden` varchar(111) NOT NULL,
                   PRIMARY KEY  (`id`) 
) "; 
$crear_tabla=mysql_query($tabla,$conn1) or die(mysql_error()); 
//$result3 = mysql_query($sql3, $conn1);

$resultado = mysql_query("SHOW COLUMNS FROM evento_cat");
if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
if (mysql_num_rows($resultado) > 0) {
    while ($fila = mysql_fetch_assoc($resultado)) {
        print_r($fila);
        echo '<br>';
    }
}
echo '<br>';
 $tabla="CREATE TABLE IF NOT EXISTS `usuario` ( 
                  `id` int NOT NULL auto_increment, 
                  `user` varchar(111) NOT NULL, 
                  `pass` varchar(111) NOT NULL, 
                  `tipo` varchar(111) NOT NULL, 
                  `ciudad` varchar(111) NOT NULL, 
                  `nombre` varchar(111) NOT NULL,
                  `apellido` varchar(111) NOT NULL,
                  `email` varchar(111) NOT NULL,
                  `usuarios` varchar(111) NOT NULL,
                  `estadisticas` varchar(111) NOT NULL,
                  `vendedor` varchar(111) NOT NULL, 
                   PRIMARY KEY  (`id`) 
) "; 
$crear_tabla=mysql_query($tabla,$conn1) or die(mysql_error()); 
//$result3 = mysql_query($sql3, $conn1);

$resultado = mysql_query("SHOW COLUMNS FROM usuario");
if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
if (mysql_num_rows($resultado) > 0) {
    while ($fila = mysql_fetch_assoc($resultado)) {
        print_r($fila);
        echo '<br>';
    }
}
echo '<br>';//*/
/*
 $tabla="CREATE TABLE IF NOT EXISTS `vendedor` ( 
                  `id` int NOT NULL auto_increment, 
                  `nombre` varchar(111) NOT NULL, 
                  `apellido` varchar(111) NOT NULL, 
                  `domicilio` varchar(111) NOT NULL, 
                  `ciudad` varchar(111) NOT NULL, 
                  `estado` varchar(111) NOT NULL, 
                  `pais` varchar(111) NOT NULL, 
                  `telefono` varchar(111) NOT NULL, 
                  `email` varchar(111) NOT NULL, 
                  `celular` varchar(111) NOT NULL,  
                   PRIMARY KEY  (`id`) 
) "; 
$crear_tabla=mysql_query($tabla,$conn1) or die(mysql_error()); 
//$result3 = mysql_query($sql3, $conn1);

$resultado = mysql_query("SHOW COLUMNS FROM vendedor");
if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
if (mysql_num_rows($resultado) > 0) {
    while ($fila = mysql_fetch_assoc($resultado)) {
        print_r($fila);
        echo '<br>';
    }
}//*/       
  
	//*/