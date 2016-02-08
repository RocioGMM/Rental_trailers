<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$cliente = $_POST["cliente"];
$vendedor = $_POST["vendedor"];
$precio = $_POST["precio_total"];
$comentarios = $_POST["comentarios"];
$fecha = date("Y-m-d H:i:s");
$cant_producto = $_POST["cant_producto"];


	if ($id == ''){ $aqui = '0';
		$sql11 = "INSERT INTO venta(cliente, vendedor, precio, fecha, comentarios) 
		VALUES('".$cliente."', '".$vendedor."', '".$precio."', '".$fecha."', '".$comentarios."')";
		$result = mysql_query($sql11);								
	}else{
		$sql1 = "UPDATE venta SET cliente='".$cliente."', vendedor='".$codigo."', precio='".$precio."',  fecha='".$fecha."', comentarios='".$comentarios."' WHERE id=".$id;				
		$result = mysql_query($sql1);
	};//*/
		
		

		//$sql1 = "SELECT * FROM venta WHERE id='11' ";
	if ($id == ''){
		$sql1 = "SELECT * FROM venta WHERE fecha='".$fecha."' AND vendedor='".$vendedor."' ";
	}else{
		$sql1 = "SELECT * FROM venta WHERE id='".$id."' ";
	};
		$result1 = mysql_query($sql1, $conn1);
		$row1 = mysql_fetch_array($result1);



		for ($i=1; $i < $cant_producto+1; $i++) { 
			
			$p_canti = "cantidad".$i;
			$cantidad = $_POST[$p_canti];

			$p_producto = "producto".$i;
			$producto = $_POST[$p_producto];

			$p_idp = "idp".$i;
			$idp = $_POST[$p_idp];


			$sql2 = "SELECT * FROM productos WHERE id='".$producto."' ";
			$result2 = mysql_query($sql2, $conn1);
			$row2 = mysql_fetch_array($result2);

			//echo $p_producto.': '. $producto.'<br>';

			$precio_t = $row2["costo"] * $cantidad;
			//echo $row2["costo"].' * '.$cantidad.' = '.$precio_t;


			if ($row2["id"] != '' && $idp == ''){
				$sql11 = "INSERT INTO venta_prod(venta, cantidad, producto, fecha, precio_u, precio_t) 
				VALUES('".$row1["id"]."', '".$cantidad."', '".$producto."', '".$fecha."', '".$row2["costo"]."', '".$precio_t."')";
				$result = mysql_query($sql11);
			}elseif ($idp != ''){
				$sql1 = "UPDATE venta_prod SET cantidad='".$cantidad."', producto='".$producto."',  
				precio_u='".$row2["costo"]."',  precio_t='".$precio_t."',  fecha='".$fecha."' WHERE id=".$idp;				
				$result = mysql_query($sql1);
			};
		}//FIN del FOR

//echo 'iissii';
	if($vi == ''){			header("location: ../gracias.php?tipo=pro&id=".$id);		}
	else{			header("location: ../agregar-productos.php");		};
	
				mysql_close($conn1);
				$llego = 'ok';
};
