<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};

$nombre = $_POST["nombre"];
$mail = $_POST["mail"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];
$estado = $_POST["estado"];

if($_POST["matrizck"] == 's'){$matriz = $_POST["matrizck"];}else{$matriz = $_POST["matrizselect"];};
if($_POST["empresa"] == 's'){$empresa = $_POST["empresa"];}else{$empresa = $_POST["empresaselect"];};


$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};


	if ($id == ''){ $aqui = '0';
$sql11 = "INSERT INTO sucursales(matriz, empresa, nombre, direccion, telefono, mail, estado, ciudad) 
VALUES('".$matriz."', '".$empresa."', '".$nombre."', '".$direccion."', '".$telefono."', '".$mail."', '".$estado."', '".$ciudad."')";
$result = mysql_query($sql11);
								
	}else{
		$sql1 = "UPDATE sucursales SET matriz='".$matriz."',  empresa='".$empresa."', nombre='".$nombre."',   direccion='".$direccion."',  
		telefono='".$telefono."', mail='".$mail."', estado='".$estado."', ciudad='".$ciudad."' WHERE id=".$id;				
		$result = mysql_query($sql1);
	};
		
	if($vi == ''){			header("location: ../gracias.php?tipo=suc&id=".$_POST["id"]);		}
	else{			header("location: ../sucursales.php");		};
	
				mysql_close($conn1);
				$llego = 'ok';
};
?>