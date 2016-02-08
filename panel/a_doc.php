<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};

$matriz = $_POST["matriz"];
$nombre = $_POST["nombre"];
$mail = $_POST["mail"];
$empresa = $_POST["empresa"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];
$estado = $_POST["estado"];

$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};


	if ($id == ''){ $aqui = '0';
$sql11 = "INSERT INTO sucursales(matriz, empresa, nombre, direccion, telefono, mail, estado, ciudad, matriztxt, matrizselect, empresatxt, matrizselect) 
VALUES('".$matriz."', '".$empresa."', '".$nombre."', '".$direccion."', '".$telefono."', '".$mail."', '".$estado."', '".$ciudad."', 
	'".$matriztxt."', '".$matrizselect."', '".$empresatxt."', '".$matrizselect."')";
$result = mysql_query($sql11);
								
	}else{
		$sql1 = "UPDATE sucursales SET matriz='".$matriz."', nombre='".$nombre."', telefono='".$telefono."',  empresa='".$empresa."',  
		direccion='".$direccion."',  mail='".$mail."',  estado='".$estado."',  estado='".$estado."',  ciudad='".$ciudad."', 
		matriztxt='".$matriztxt."', matrizselect='".$matrizselect."', empresatxt='".$empresatxt."', matrizselect='".$matrizselect."' WHERE id=".$id;				
		$result = mysql_query($sql1);
	};
		
	if($vi == ''){			header("location: ../gracias.php?tipo=suc&cliente=".$aqui);		}
	else{			header("location: ../sucursales.php");		};
	
				mysql_close($conn1);
				$llego = 'ok';
};
?>