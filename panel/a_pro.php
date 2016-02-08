<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$nombre = $_POST["nombre"];
$codigo = $_POST["codigo"];
$costo = $_POST["costo"];
$cantidad = $_POST["cantidad"];
$descripcion = $_POST["descripcion"];


	if ($id == ''){ $aqui = '0';
$sql11 = "INSERT INTO productos(nombre, codigo, costo, descripcion, cantidad) 
VALUES('".$nombre."', '".$codigo."', '".$costo."', '".$descripcion."', '".$cantidad."')";
$result = mysql_query($sql11);
								
	}else{
		$sql1 = "UPDATE productos SET nombre='".$nombre."', codigo='".$codigo."', costo='".$costo."', cantidad='".$cantidad."',  descripcion='".$descripcion."' WHERE id=".$id;				
		$result = mysql_query($sql1);
	};
		
	if($vi == ''){			header("location: ../gracias.php?tipo=pro&id=".$id);		}
	else{			header("location: ../agregar-productos.php");		};
	
				mysql_close($conn1);
				$llego = 'ok';
};
?>