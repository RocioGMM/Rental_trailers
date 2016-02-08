<?php
session_start();
if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user') || ($_SESSION["tipo"] == 'vendedor')){
include ("panel/conn1.php");
include ("panel/rempla_fech.php");
$mas = $_POST["mas"];if($mas == ''){$mas = $_REQUEST["mas"];};
$otro_hoy = $_POST["otro_hoy"];if($otro_hoy == ''){$otro_hoy = $_REQUEST["otro_hoy"];};
$buscar = $_POST["buscar"];if($buscar == ''){$buscar = $_REQUEST["buscar"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};
$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};


if ($_SESSION["tipo"] == 'admin'){
	$lugar_lib = $_REQUEST["lugar"];
}else{
	$lugar_lib = $_SESSION["lugar"];	
};

if($lugar_lib == ''){$lugar_lib = '1';};


$tamanio_pag = 15;
$pagina = $_GET["pagina"];
	
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
	}
else{
	$inicio = ($pagina  - 1) * $tamanio_pag;
	};
		
$sqlpag = "SELECT * FROM libramientos WHERE lugar='".$lugar_lib."'		";
$rspag = mysql_query($sqlpag);
$total_registros = mysql_num_rows($rspag);
$total_paginas = ceil($total_registros / $tamanio_pag);
mysql_free_result($rspag);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Administrador</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
input.cambusc {
	border: 1px solid #948EB7;
	color: #666;
	display: block;
	float: left;
	margin-top: 0px;
	margin-right: 7px;
	margin-bottom: 0px;
	margin-left: 0px;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="includes/ice/ice.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width">
</head>

<body>
<div class="gruap">

<div class="log-out">
  <div class="lo-logo"><img src="logogrande.svg" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	var s = $("#sticker");
	var pos = s.position();	
	var stickermax = $(document).outerHeight() - $("#footer").outerHeight() - s.outerHeight() - 40; //40 value is the total of the top and bottom margin
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		//s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
		if (windowpos >= pos.top && windowpos < stickermax) {
			s.attr("style", ""); //kill absolute positioning
			s.addClass("stick"); //stick it
		} else if (windowpos >= stickermax) {
			s.removeClass(); //un-stick
			s.css({position: "absolute", top: stickermax + "px"}); //set sticker right above the footer
			
		} else {
			s.removeClass(); //top of page
		}
	});
	//alert(stickermax); //uncomment to show max sticker postition value on doc.ready
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var s = $("#stickem");
	var pos = s.position();	
	var stickermax = $(document).outerHeight() - $("#footer").outerHeight() - s.outerHeight() - 40; //40 value is the total of the top and bottom margin
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		//s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos -1px);
		if (windowpos >= pos.top && windowpos < stickermax) {
			s.attr("style", ""); //kill absolute positioning
			s.addClass("stickem"); //stick it
		} else if (windowpos >= stickermax) {
			s.removeClass(); //un-stick
			s.css({position: "absolute", top: stickermax + "px"}); //set sticker right above the footer
			
		} else {
			s.removeClass(); //top of page
		}
	});
	//alert(stickermax); //uncomment to show max sticker postition value on doc.ready
});
</script>


<div class="menubar">
  <a href="programacion.php" class="op log" id="logbiev"></a>
<?php 	$sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
<a class="op loname" id="bienve">Bienvenido, <?php echo $row7["nombre"];?>! <br />
<?php 
		if ($_SESSION["tipo"] != 'user'){
		$sql7 = "SELECT * FROM vendedor WHERE id='".$_SESSION["vendedor"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
</a>
<?php };?>


  <a href="remolques.php" class="op lop">Remolques</a>
  <a href="productos.php" class="op mop">Productos</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  
	<!--<a href="usuarios.php" class="op rop">Usuarios</a>-->
	<a href="usuarios.php" class="op rop">Usuarios</a>
<?php  };?>
  <a href="cliente.php" class="op cli">Clientes</a>
</div>

<div class="bann">
<div class="subpanel">
 




</div>

    <?php 	
			$created = strtotime ( '-4 hour' , strtotime ( date("Y/m/d H:i:s") ) );
			$created = date ( 'Y/m/d H:i:s' , $created );
			//$created = date ( 'Y-m-d H:i:s' , strtotime( "$created -7 hour" ) );//resta 7 horas porque el server esta adelandado 7 horas			
			//echo $created;

if($otro_hoy != ''){	$hoy = $otro_hoy;}
else{  		$hoy = substr($created,0,4).'-'.substr($created,5,2).'-'.substr($created,8,2);		};
//echo $hoy;
			$dia_hoy = substr($hoy,8,2);
			$mes_hoy = substr($hoy,5,2);
			$ano_hoy = substr($hoy,0,4);
			 
			$cuenta_dias = 1;
			$empieza = '';
			$dia_cuadro = $ano_hoy.'-'.$mes_hoy.'-01';
			$dia_primero = $ano_hoy.'-'.$mes_hoy.'-01';
			
			$fecha_inicio = $ano_hoy.'-'.$mes_hoy.'-01'; //primer dia del mes
			
			$mes = mktime( 0, 0, 0, $mes_hoy, 1, $ano_hoy ); //encontrar ultimo dia del mes
			$ultimo_dia = date("t",$mes);
			$fecha_fin = $ano_hoy.'-'.$mes_hoy.'-'.$ultimo_dia;// ultimo dia del mes

$dia_testeo = $dia_cuadro;
for($h = 1 ; $h < 32 ; $h ++){
 
	if ($_SESSION["tipo"] == 'vendedor'){
		$sql1 = "SELECT * FROM evento_act WHERE fecha='".$dia_testeo."' AND vendedor='".$_SESSION["vendedor"]."' ORDER BY fecha DESC";
	}else{
		$sql1 = "SELECT * FROM evento_act WHERE fecha='".$dia_testeo."' ORDER BY fecha DESC";
	};
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
	if($row["id"] != ''){ 		$matriz_testeo[$h] = 'ok'; 		};
	$dia_testeo = date ( 'Y-m-j' , strtotime( "$dia_testeo +1 day" ) );
	}
	$mes_sig = date ( 'Y-m-j' , strtotime( "$hoy +1 month" ) );
	$mes_ant = date ( 'Y-m-j' , strtotime( "$hoy -1 month" ) );


	?>
         

<div class="today"><span class="day">
<?php $dia_sem= date("w",mktime(0, 0, 0, substr($hoy,5,2), substr($hoy,8,2), substr($hoy,0,4)));	 //localizo el dia de la semana que comienzo el mes
echo replacedia_sem($dia_sem);// dia de la semana en texto?></span>
  <span class="dayn"><?php echo $dia_hoy;// dia del mes en numero?> </span></div>
<div class="cal">
<a href="programacion.php?otro_hoy=<?php echo $mes_ant;?>" class="cal-l"></a>
<a href="programacion.php?est=4&otro_hoy=<?php echo $mes_sig;?>" class="cal-r"></a>
<div class="mbar"> <?php echo replacemes($mes_hoy).' '.$ano_hoy;//mes y año?> </div>
  <div class="daysbar">
  <span class="day-w">dom</span><span class="day-w">lun</span><span class="day-w">mar</span><span class="day-w">mie</span><span class="day-w">jue</span><span class="day-w">vie</span><span class="day-w">sab</span>
  </div>
  <div class="cfl"></div>


<?php /////////////////////////////  CALENDARIO


//echo '<span class="day-a">'.$fecha_inicio.'</span>';
$dias_cap = '::';
$contador_X = 0; //es el contador para saber que dia de la semana cae el 1º dia
$cantidad_dias_rep = 0;
//for ($cantidad_dias_rep = 0; $cantidad_dias_rep < 2;) {	 	// Sigue hasta que se le indica que llega el dia domingo de la sem del ultimo dia (si=1)
//for($cantidad_dias_rep = 1 ; $cantidad_dias_rep < 2 ){
	$empieza = '';
	
for($cantidad_dias_rep = 1 ; $cantidad_dias_rep < 35 ; $cantidad_dias_rep ++){ 
//echo $cantidad_dias_rep.'.';

if($empieza != 'ok'){
$dia= date("w",mktime(0, 0, 0, substr($dia_cuadro,5,2), substr($dia_cuadro,8,2), substr($dia_cuadro,0,4)));	 //localizo el dia de la semana que comienzo el mes
if($contador_X == $dia){		$empieza = 'ok';		};  /// una vez que encuentro el dia empiezo a avanzar
if($contador_X != $dia){echo '<span class="day-a">.</span>';	};
$contador_X = $contador_X + 1;
};

if($empieza == 'ok'){//////////////////////////////  A partir de aqui empiezo a contar

//////////////////////////////////////////////////////////							
// if($matriz_testeo[ (int) substr($dia_cuadro,8,2)] == 'ok' && $empieza == 'ok' && $mes_hoy == substr($dia_cuadro,5,2)){ //condicion de si hay algo ese dia

$hoy0= $dia_cuadro.' 00:00:00';
$hoy3= $dia_cuadro.' 23:59:00';
	
	if ($_SESSION["tipo"] == 'vendedor'){
		//$sqlf = "SELECT * FROM evento_act WHERE fecha='".$dia_testeo."' AND vendedor='".$_SESSION["vendedor"]."' ORDER BY fecha DESC";
		$sqlf = "SELECT * FROM evento_act WHERE  fecha>='".$hoy0."' AND fecha<'".$hoy3."' AND vendedor='".$_SESSION["vendedor"]."' ORDER BY fecha ASC";
	}else{
		$sqlf = "SELECT * FROM evento_act WHERE  fecha>='".$hoy0."' AND fecha<'".$hoy3."' ORDER BY fecha ASC";
	};
	
$resultf = mysql_query($sqlf, $conn1);
$rowf = mysql_fetch_array($resultf);
//$dias_cap .= '... ('.$hoy0.'*'.$hoy3.') '.$rowf["id"];


						$mescc = mktime( 0, 0, 0, substr($hoy,5,2), 1, substr($hoy,0,4) ); //encontrar ultimo dia del mes
						$ultimo_diacc = date("t",$mescc);
						$fech_compl_ultimo = substr($hoy,0,4).'-'.substr($hoy,5,2).'-'.$ultimo_diacc;
//						echo '('.$ultimo_diacc.')';
						//if(substr($dia_cuadro,8,2) == $ultimo_diacc){ $empieza = 'ultimo';		};//*/
						$mes_cuadro_cc = substr($dia_cuadro,5,2);
	//	if ($dia_cuadro <= $fech_compl_ultimo){
		if ($mes_cuadro_cc == $mes_hoy){
			if ($hoy == $dia_cuadro){	echo '<span class="day-a cact">';
			}else{echo '<span class="day-a'; 		if($rowf["id"] != ''){ echo ' cact2';}; 		echo '">';};				
							echo '<a href="programacion.php?est=4&otro_hoy='.$dia_cuadro.'" class="day-a">';							
							$dia_calend = substr($dia_cuadro,8,2);
							//echo str_pad(substr($dia_cuadro,8,2), 2, "0", STR_PAD_LEFT); 
							echo str_pad($dia_calend, 2, "0", STR_PAD_LEFT);// pone "0" (cero) a la izquierda si hace falta
							echo '</a>';
			echo '</span>';
		}
							$cuenta_dias = $cuenta_dias + 1;		
							//$dia_ultimo = $dia_cuadro;
						//	$dia_cuadro = date ( 'Y-m-j' , strtotime( "$dia_cuadro00 +1 day" ) );
						
					//		$dia_siguiente = substr($dia_cuadro,8,2) + 1;
							$dia_siguiente = date ( 'Y-m-j' , strtotime( "$dia_cuadro +1 day" ) ); 
							$dia_siguiente0 = str_pad(substr($dia_siguiente,5,2), 2, "0", STR_PAD_LEFT);
							$dia_siguiente1 = str_pad(substr($dia_siguiente,8,2), 2, "0", STR_PAD_LEFT);
							$dia_siguiente = substr($dia_siguiente,0,4).'-'.$dia_siguiente0.'-'.$dia_siguiente1;
					//		$dia_cuadro = substr($dia_cuadro,0,4).'-'.substr($dia_cuadro,5,2).'-'.$dia_siguiente; 
							$dia_cuadro = $dia_siguiente;	
							//if($cuenta_dias == '4'){		echo $dia_cuadro;		};
							if($dia_cuadro == $fecha_fin){$cantidad_dias_rep =1;};//*/

};

?>
<?php 	}// del for*/   //  CALENDARIO?>
  </div>		<?php //echo $created;?>

<?php if ($_SESSION["tipo"] != 'user'){?>
<div class="bite"><a href="alquiler.php?lugar=<?= $_REQUEST["lugar"];?>" class="baddb">.</a>ALQUILER REMOLQUE<?php //echo $dias_cap;?></div>
<div class="bite"><a href="venta.php" class="badd">.</a>VENTA DE PRODUCTOS<?php //echo $dias_cap;?></div>
<?php };?>

<div class="cf"></div><!--
    <div class="icons-men"><a href="doctor.php"><img src="ic-usuario.png" width="31" height="20" />DOCTORES</a></div>
    <div class="icons-men" style=" margin-right:50px;"><a href="productos.php"><img src="ic-usuario.png" width="31" height="20" />PRODUCTOS</a></div>
    -->
    
</div>






<div class="onecolc_tto">



<div class="onecolc"> 



<span class="titlecol tcolor eiix">
	<a href="programacion.php" class="<?php if($tipo=='' || $tipo=='3'){echo 'boldcss';};?>">ALQUILERES DE REMOLQUES</a> - 
	<a href="programacion.php?tipo=1" class="<?php if($tipo=='1'){echo 'boldcss';};?>">VENTAS DE PRODUCTOS</a> 
<?php if($tipo == '3'){?>
<div class="titulo_list">
	Listado de alquileres
	
	<?php
		if($id != ''){
			$sqlr4 = "SELECT * FROM remolques  WHERE id='".$id."' ORDER BY id DESC ";
			$resultr4 = mysql_query($sqlr4, $conn1);
			$rowr4 = mysql_fetch_array($resultr4);
			echo 'Remolque: ('.$rowr4["numero"].') '.$rowr4["modelo"].' - '.$rowr4["placas"];
			echo '<br><a href="programacion.php?tipo=3">(Ver todos los alquileres)</a>';
		};
	?>
</div>
<?php };?>
</span>
<div class="divline"></div>
<div id="stickem"></div>
 


<?php if($tipo==''){////////////////////////////////////////    ALQUILER DE REMOLQUES?> 
  <div id="sticker">  
    <div class="time-j ti">NUM</div>
    <div class="t-contact">NOMBRE</div>
    <div class="t-contact">MODELO</div>
    <div class="t-desit">ALQUILER</div>
    <!--<div class="t-desit">PROGRESO</div>-->
    <div class="t-progres"></div>
  </div>

 <?php $i_rem = 0;
	
	$sql1 = "SELECT * FROM remolques ORDER BY id DESC ";
	$result1 = mysql_query($sql1, $conn1);
	while($row = mysql_fetch_array($result1)){
	
		$sql2 = "SELECT * FROM alquiler WHERE remolque='".$row["id"]."' ORDER BY id DESC ";
		$result2 = mysql_query($sql2, $conn1);
		$row2 = mysql_fetch_array($result2); 

		if($row2["fecha_devolucion"]=='0000-00-00 00:00:00' && $fecha_alquiler > $created){ $est_rem = "2"; /*alquilado//*/}
		elseif($row2["fecha_devolucion"]=='0000-00-00 00:00:00' && $fecha_alquiler < $created){ $est_rem = "1"; /*retrasado//*/}
		else{ $est_rem = "3"; };//disponible

		//$array_rem[$i_rem, "id"] = $row["id"];
		//$array_rem[$i_rem, "estado"] = $est_rem;
		$array_rem[$row["id"]] = $est_rem;
		$i_rem = $i_rem + 1;

	};

	asort($array_rem);// Ordenar

	foreach ($array_rem as $key => $val) {

	$sql1 = "SELECT * FROM remolques WHERE id='".$key."' ORDER BY id DESC ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);

	$sql2 = "SELECT * FROM alquiler WHERE remolque='".$row["id"]."' ORDER BY id DESC ";
	$result2 = mysql_query($sql2, $conn1);
	$row2 = mysql_fetch_array($result2);  


  ?>
  <div class="initem">
    <div class="time-j ti">  <?php echo $row["numero"]// NUMERO		?>...	</div>
    <div class="contact">  <?php echo $row["medidas"]// MEDIDAS	?>	</div>
    <div class="contact">  <?php echo $row["modelo"]// MODELO	?>	</div>
    <div class="t-progres imgalcost nitop" style="color:#777;">  
    <?php // $created
    $fecha_alquiler = strtotime ( '+2 hour' , strtotime ( $row2["fecha_alquilada"] ) );
    $fecha_alquiler = date ( 'Y/m/d H:i:s' , $fecha_alquiler );
    //echo $created.'<br>'.$fecha_alquiler.'<br>';
    if($row2["fecha_devolucion"]=='0000-00-00 00:00:00' && $fecha_alquiler > $created){//si no devolvio pero todavia esta en fecha
    	$datetime1 = new DateTime($created);
		$datetime2 = new DateTime($fecha_alquiler);
		$interval = $datetime1->diff($datetime2);
		//echo $interval->format('%R%a días');// + 2 Dias
		echo '<strong style="color:#FF0000;">Alquilado hasta:<br>'.$fecha_alquiler.' Faltan ';
		echo $interval->format('%a días');
		echo '</strong>';

    }elseif($row2["fecha_devolucion"]=='0000-00-00 00:00:00' && $fecha_alquiler < $created){
    		if($row["fecha_renta"]!='' && $row["fecha_renta"]!='0000-00-00 00:00:00') {
    			echo '<strong style="color:#FF0000;">Alquilado hasta:<br>'.$fecha_alquiler.'</strong>';
    		}else{echo '(Falta colocar correctamente la fecha en que se alquilo el remolque)';};
    }else{echo 'Disponible';};
   ?>
    </div>  
    


<?php if($_SESSION["tipo"] != 'user'){?>
<div class="ic-idel">
	<a href="programacion.php?tipo=3&id=<?php echo $row["id"];?>" target="_self">
		<img src="editaricon.png" width="44" height="44" border="0" />
	</a>
</div>
<?php };?> 


<?php 	/*	if($_SESSION["tipo"] == 'admin'){		?>
<div class="ic-idel"><a href="eliminar-libra.php?id=<?php echo $row["id"];?>" target="_self"><img src="delete1.png" width="44" height="44" border="0" /></a></div>
<?php 		};		///*/?>


    <br /> 
  
  </div>
<?php }; };///////////////////////////////////////////////////////////    FIN DE ALQUILER DE REMOLQUES?>
 


<?php if($tipo=='1'){////////////////////////////////////////    VENTA DE PRODUCTOS?> 
  <div id="sticker">  
    <div class="time-j ti">CODIGO</div>
    <div class="t-contact">NOMBRE</div>
    <div class="t-contact">COSTO</div>
    <div class="t-desit">STOCK</div>
    <!--<div class="t-desit">PROGRESO</div>-->
    <div class="t-progres"></div>
  </div>

 <?php 
	$sql1 = "SELECT * FROM productos ORDER BY id DESC ";
	$result1 = mysql_query($sql1, $conn1);
	while($row = mysql_fetch_array($result1)){
	
	$sql2 = "SELECT * FROM venta_prod WHERE producto='".$row["id"]."' AND fecha>'".$row["fecha"]."' ORDER BY id DESC ";
	$result2 = mysql_query($sql2, $conn1);
	$total_prodvendidos = mysql_num_rows($result2);
//	$row2 = mysql_fetch_array($result2);  
	$total_enstock = 0;
	$total_enstock = $row["cantidad"] - $total_prodvendidos;
	//echo $total_enstock.' = '.$row["cantidad"]." - ".$total_prodvendidos.'<br>';
  ?>
  <div class="initem">
    <div class="time-j ti">  <?php echo $row["codigo"]// codigo		?>	</div>
    <div class="contact">  <?php echo $row["nombre"]// nombre	?>	</div>
    <div class="contact">  $ <?php echo $row["costo"]// costo	?>	</div>
    <div class="t-progres imgalcost nitop" style="color:#777;">  
    <?php // $created
    	//echo 'En stock:'.$row["cantidad"];
    if($total_enstock > '0'){
    	echo 'Vendidos desde el ultimo control de stock:'.$total_prodvendidos;
    	echo '<br>En stock:'.$total_enstock;
    }else{
    	echo '<span style="color:#FF0000;">NO HAY PRODUCTOS EN STOCK</span>';
    };
   	?>
    </div>  
    
<?php if($_SESSION["tipo"] != 'user'){?>
<div class="ic-idel"><a href="agregar-productos.php?id=<?php echo $row["id"];?>" target="_self"><img src="editaricon.png" width="44" height="44" border="0" /></a></div>
<?php };?> 


<?php 		if($_SESSION["tipo"] == 'admin'){		?>
<div class="ic-idel"><a href="eliminar-productos.php?id=<?php echo $row["id"];?>" target="_self"><img src="delete1.png" width="44" height="44" border="0" /></a></div>
<?php 		};		?>


    <br /> 
  
  </div>
<?php }; };///////////////////////////////////////////////////////////    FIN DE VENTA DE PRODUCTOS?> 




<?php if($tipo=='3'){////////////////////////////////////////    ALQUILER DE REMOLQUES LISTADO?> 
  <div id="sticker">  
    <div class="t-contact"><?php if($id != ''){echo 'CLIENTE';}else{echo 'REMOLQUE';};?></div>
    <div class="t-contact">RENTA</div>
    <div class="t-contact">DEVOLUCION</div>
    <div class="t-desit">COMENTARIOS</div>
    <!--<div class="t-desit">PROGRESO</div>-->
    <div class="t-progres"></div>
  </div>

 <?php 
 	if($id != ''){
	$sql2 = "SELECT * FROM alquiler WHERE remolque='".$id."' ORDER BY id DESC ";
	}else{
	$sql2 = "SELECT * FROM alquiler ORDER BY id DESC ";
	};
	$result2 = mysql_query($sql2, $conn1);
	while($row2 = mysql_fetch_array($result2)){

	$sql1 = "SELECT * FROM remolques  WHERE id='".$row2["remolque"]."' ORDER BY id DESC ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);

	$sql3 = "SELECT * FROM cliente  WHERE id='".$row2["cliente"]."' ORDER BY id DESC ";
	$result3 = mysql_query($sql3, $conn1);
	$row3 = mysql_fetch_array($result3);
	 
  ?>
  <div class="initem">
    <div class="contact">  <?php if($id != ''){echo $row3["contacto"];}else{echo $row["modelo"].' ('.$row["medidas"].')';};?></div>
    <div class="contact">  <?php echo $row2["fecha_renta"]// RENTA	?>	</div>
    <div class="contact">  <?php // DEVOLUCION
    	if($row2["fecha_devolucion"]!='0000-00-00 00:00:00'){
    		echo $row2["fecha_devolucion"];
    	}else{
    		echo 'PENDIENTE';
    	};
    ?>	</div>
    <div class="t-progres imgalcost nitop" style="color:#777;">  
    <?php echo $row["observaciones"]// COMENTARIOS	?>
    </div>  
    

    
<?php if($_SESSION["tipo"] != 'user'){?>
<div class="ic-idel">
	<a href="alquiler.php?id=<?php echo $row2["id"];?>" target="_self">
		<img src="editaricon.png" width="44" height="44" border="0" />
	</a>
</div>
<?php };?> 


<?php 	/*	if($_SESSION["tipo"] == 'admin'){		?>
<div class="ic-idel"><a href="eliminar-libra.php?id=<?php echo $row["id"];?>" target="_self"><img src="delete1.png" width="44" height="44" border="0" /></a></div>
<?php 		};		///*/?>


    <br /> 
  
  </div>
<?php }; };///////////////////////////////////////////////////////////    FIN DE ALQUILER DE REMOLQUES LISTADO?>
  
  
  
  <div class="paginadors"><!---------------------------------------- PAGINADOR  ---------------------------------- -->
<?php if(($pagina - 1) > 0){?>
<div class="paginadors2 separapagder">
  <?php echo '<a href="index.php?pagina='.($pagina - 1).'" >Anterior</a>';?></div>
<?php };?>


<?php
  if($pagina > 5){
    $inicio0s = $pagina - 5;
    $fin0s =  $pagina - 1;
    for($i=$inicio0s;$i<=$fin0s;$i++){     echo '<div class="paginadors2 separapagder"><a href="programacion.php?pagina='.$i.'">'.$i.'</a></div>';          };
  };
?>
<?php
if($total_paginas > 1){
  if($pagina > 5){
    $inicio1s = $pagina;
    $fin1s =  $pagina + 5;
  }else{
    $inicio1s = 1;
    $fin1s =  "11";    
  };
  if($fin1s > $total_paginas){$fin1s = $total_paginas;}
  for($i=$inicio1s;$i<=$fin1s;$i++){
    if($pagina == $i){        echo '<div class="paginadors3 separapagder">'.$i.'</div>';      }
    else{      echo '<div class="paginadors2 separapagder"><a href="programacion.php?pagina='.$i.'">'.$i.'</a></div>';      };
    };

  };
?>

<?php if(($pagina + 1) <= $total_paginas){?>
    <div class="paginadors2"><?php echo '<a href="programacion.php?pagina='.($pagina + 1).'">Siguiente</a>';?></div>
<?php };?>
</div>






  
  
  <div class="cf"></div>
</div>


</div>






</div>
</body>
</html>

<?php
	mysql_close($conn1);
	}
else{
	//header("location: index.php");
	echo $_SESSION["user"];
	};	
?>
