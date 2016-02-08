<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};

$cliente = $_POST["cliente"];
$vendedor = $_POST["vendedor"];
//$remolque = $_POST["remolque"];
$valor_dia = $_POST["valor_dia"];
$valor_semana = $_POST["valor_semana"];

if($id == ''){
	$fecha_captura = date("Y/m/d H:i:s");
	$fecha_captura = strtotime ( '-4 hour' , strtotime ( $fecha_captura ) ) ;
	$fecha_captura = date ( 'Y/m/d H:i:s' , $fecha_captura );
}else{
	$fecha_captura = $_POST["fecha_captura"];
};

$fecha_renta = substr($_REQUEST["fecha_renta"],6,4).'-'.substr($_REQUEST["fecha_renta"],3,2).'-'.substr($_REQUEST["fecha_renta"],0,2);
$horaRET0 = str_replace(' ', '', substr($_REQUEST["fecha_renta"],11,5));
$horaRET0 = str_pad($horaRET0, 5, "0", STR_PAD_LEFT); 
$fecha_renta .= ' '.$horaRET0;
$fecha_alquilada = substr($_REQUEST["fecha_alquilada"],6,4).'-'.substr($_REQUEST["fecha_alquilada"],3,2).'-'.substr($_REQUEST["fecha_alquilada"],0,2);
$fecha_alquilada .= ' '.$horaRET0;
//.substr($row["fecha_renta"],11,5);
//$_REQUEST["fecha_alquilada"];
$fecha_devolucion = substr($_REQUEST["fecha_devolucion"],6,4).'-'.substr($_REQUEST["fecha_devolucion"],3,2).'-'.substr($_REQUEST["fecha_devolucion"],0,2);
$horaRET = str_replace(' ', '', substr($_REQUEST["fecha_devolucion"],11,5));
$horaRET = str_pad($horaRET, 5, "0", STR_PAD_LEFT); 
$fecha_devolucion .= ' '.$horaRET;

$cambio = $_POST["cambio"];
$fecha_cambio = $_POST["fecha_cambio"];
$precio_antes_cambio = $_POST["precio_antes_cambio"];
$precio_total = $_POST["precio_total"];
$tiempo = $_POST["tiempo"];
$cantidad = $_POST["cantidad"];

$danos = $_POST["danos"];
$observaciones = $_POST["observaciones"];

if($tiempo == 'dias'){$remolque = $valor_dia;}else{$remolque = $valor_semana;};

if($_SESSION["tipo"] == 'admin') {
	 $vendedor = $_POST["vendedor"];
}else{
	 $vendedor = $_SESSION["vendedor"];
};

	if ($id == ''){ $aqui = '0';
$sql11 = "INSERT INTO alquiler(cliente, vendedor, remolque, fecha_captura, fecha_renta, fecha_alquilada, 
	cantidad, tiempo, 
	precio_total, danos, observaciones) 
VALUES('".$cliente."', '".$vendedor."', '".$remolque."', '".$fecha_captura."', '".$fecha_renta."', '".$fecha_alquilada."', 
	'".$cantidad."', '".$tiempo."', '".$precio_total."', '".$danos."', '".$observaciones."')";
$result = mysql_query($sql11);
								
	}else{
		$sql1 = "UPDATE alquiler SET cliente='".$cliente."', vendedor='".$vendedor."', remolque='".$remolque."',  
		fecha_captura='".$fecha_captura."',  fecha_renta='".$fecha_renta."',  fecha_alquilada='".$fecha_alquilada."',  
		fecha_devolucion='".$fecha_devolucion."',  cambio='".$cambio."', fecha_cambio='".$fecha_cambio."', 
		precio_antes_cambio='".$precio_antes_cambio."',  precio_total='".$precio_total."', tiempo='".$tiempo."',
		cantidad='".$cantidad."', danos='".$danos."', observaciones='".$observaciones."' WHERE id=".$id;			
		$result = mysql_query($sql1);
	};
	
if($_POST["imprimir"] == ''){
	if($vi == ''){			header("location: ../gracias.php?tipo=alq&alq=".$aqui);		}
	else{			header("location: ../alquiler.php");		};
}else{
	if($id==''){		
		$sql1 = "SELECT * FROM alquiler WHERE cliente='".$cliente."' AND  vendedor='".$vendedor."' 
		AND  remolque='".$remolque."' AND  precio_total='".$precio_total."' ORDER BY id DESC ";
		$result1 = mysql_query($sql1, $conn1);
		$row = mysql_fetch_array($result1);
		$id = $row["id"];
	};$horas = substr($_REQUEST["fecha_renta"],11,5);
	header("location: ../imprimir.php?id=".$id."&fecha=".$_POST["fecha_renta"]."&fecha_renta=".$fecha_renta);
};
				mysql_close($conn1);
				$llego = 'ok';
};
?>