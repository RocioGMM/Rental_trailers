<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$numero = $_POST["numero"];
$modelo = $_POST["modelo"];
$medidas = $_POST["medidas"];
$capacidad = $_POST["capacidad"];
$serie = $_POST["serie"];
$placas = $_POST["placas"];
$valor_real = $_POST["valor_real"];
$valor_dia = $_POST["valor_dia"];
$valor_semana = $_POST["valor_semana"];


	if ($id == ''){ $aqui = '0';
$sql11 = "INSERT INTO remolques(numero, modelo, medidas, capacidad, serie, placas, valor_real, valor_dia, valor_semana) 
VALUES('".$numero."', '".$modelo."', '".$medidas."', '".$capacidad."', '".$serie."', '".$placas."', '".$valor_real."', '".$valor_dia."', '".$valor_semana."')";
$result = mysql_query($sql11);
								
	}else{
		$sql1 = "UPDATE remolques SET numero='".$numero."', modelo='".$modelo."', medidas='".$medidas."',  capacidad='".$capacidad."',  
		serie='".$serie."', placas='".$placas."',  valor_real='".$valor_real."', valor_dia='".$valor_dia."', valor_semana='".$valor_semana."' WHERE id=".$id;				
		$result = mysql_query($sql1);
	};
		
	if($vi == ''){			header("location: ../gracias.php?tipo=rem&id=".$id);		}
	else{			header("location: ../agregar-venta.php");		};
	
				mysql_close($conn1);
				$llego = 'ok';
};
?>