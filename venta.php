<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$c = $_POST["c"];if($c == ''){$c = $_REQUEST["c"];};
$e = $_POST["e"];if($e == ''){$e = $_REQUEST["e"];};
$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};
$id_categ = $_POST["id_categ"];if($id_categ == ''){$id_categ = $_REQUEST["id_categ"];};
$movil = $_POST["movil"];if($movil == ''){$movil = $_REQUEST["movil"];};
//$id_categ = $_REQUEST["id_categ"];

if ($id != ''){
	$sql1 = "SELECT * FROM venta WHERE id='".$id."' ORDER BY id ASC";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
 };
 

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<title>Administrador</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" rel="stylesheet" href="jquery.datetimepicker.css"/>




	<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>
<!-- Add fancyBox -->
<link rel="stylesheet" href="source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="source/jquery.fancybox.pack.js?v=2.1.5"></script>
<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
		$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 270,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
	</script>

    
</head>

<body>

<div class="gruap">

<div class="log-out">
  <div class="lo-logo"><img src="logogrande.svg" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>

<div class="menubar">
  <a href="programacion.php" class="op log"></a>
<?php 	$sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
  <a href="cuenta.php" class="op loname">Bienvenido <?php echo $row7["nombre"];?>! </a>


  <a href="programacion.php" class="op lop">Inicio</a>  
  <a href="remolques.php" class="op lop">Remolques</a>
  <a href="productos.php" class="op mop">Productos</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php  };?>
</div>


<div class="bann-int">
<div class="today">
<?php 	
	$created = date("Y-m-d H:i:s");
	$dia_hoy = substr($created,8,2);
	$mes_hoy = substr($created,5,2); 
?>
<span class="day"><?php echo replacemes($mes_hoy);?></span>
<span class="dayn"><?php echo $dia_hoy; ?>  </span>

<!--<iframe src="calendario.php"width="303" height="205" scrolling="no" style="  position: absolute;border: 0;top: -91px;left: 116px;"></iframe>-->

</div>
<div class="btn-proys"><a href="programacion.php"><img src="checkicon.png" width="44" height="44" /></a></div>
<span class="titlesec">VENTA</span>
</div>

<div class="tp">
	<div class="subpanel"><!--
		<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
		<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>-->
	</div>
	<div class="cf"></div>
</div>


<form method="post" action="panel/a_ven.php?tipo=<?php echo $tipo;?>&id=<?php echo $id;?>" name="frmRegistro" enctype="multipart/form-data" >
<input type="hidden" name="id" value="<?php echo $row["id"];?>"/>

<div class="onecol" id="lugari"><span class="titlecol-ad"><?php if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> venta </span>


<div class="cf"></div>

  <div class="campitem-cliente">    
    <?php /*
    	$nro_producto = '0';
    	$sql5p = "SELECT * FROM producto ORDER BY nombre ASC";// Producto
		$result5p = mysql_query($sql5p, $conn1);
		$total_productos = mysql_num_rows($result5p);
		while($row5p = mysql_fetch_array($result5p)){
		if($row["id"] != ''){
	    	$sql5pv = "SELECT * FROM producto_venta WHERE producto='".$row5p["id"]."' AND evento='".$row["id"]."' ORDER BY id ASC";// Producto asignado
			$result5pv = mysql_query($sql5pv, $conn1);
			$row5pv = mysql_fetch_array($result5pv);
			//echo 'aaasssiii '.$row["id"];
		};
		$nro_producto = $nro_producto + 1;
	?>
    <div class="campproducto">
    	<input type="checkbox" name="venta<?= $nro_producto?>" id="checkbox" value="1"  <?php if($row5pv["venta"] == '1'){ echo 'checked="checked"';};?>/>
    	<?php echo $row5p["nombre"];?>
    	<input type="text" name="precio<?= $nro_producto?>" id="textfield" placeholder="Cotizacion" value="<?php echo $row5pv["precio"];?>" class="campproductoin"/>
    </div>
    <input type="hidden" name="id_producto<?= $nro_producto?>" value="<?= $row5p["id"];?>"/>
    <input type="hidden" name="id_producto_ven<?= $nro_producto?>" value="<?= $row5pv["id"];?>"/>
    <?php };//*/?>
    
  </div>
<!--
  <div class="campitem-cliente">    
    <div class="campb ">
      <label for="textfield"></label>
      <input type="text" name="eventoname" id="textfield" placeholder="Producto" value="<?php echo $row["evento"];?>"/>
    </div>
  </div>-->

  
  <div class="campitem-cliente">

    <div class="campb">
      <select name="cliente" id="textfield"  class="hospitalx" style="height: 44px;">
      <option value="" disabled="disabled" selected>Cliente </option>
      <?php    
      	$sql9h= "SELECT * FROM cliente ORDER BY nombre_empresa ASC";
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){ 
      ?>    
      <option value="<?php echo $row9h["id"]?>"<?php 
                  if($row["cliente"] == $row9h["id"]){
                  echo ' selected';};?>><?php echo $row9h["nombre_empresa"].' ('.$row9h["contacto"].')';?></option>
      <?php };///?>
      </select>
    </div>

 <a href="agregar-cliente.php?vi=1" class="addbtn"></a>

  </div>



<?php if($_SESSION["tipo"] == 'admin'){?>
  <div class="campitem-cliente">

    <div class="campb ">
      <select name="vendedor" id="textfield"  class="hospitalx" style="height: 44px;">
      <option value=""disabled="disabled" selected>Asignar vendedor</option>
      <?php //  
        $sql9h= "SELECT * FROM vendedor ORDER BY nombre, apellido ASC";
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){ 
      ?>    
      <option value="<?php echo $row9h["id"]?>"<?php 
                  if($row["vendedor"] == $row9h["id"]){
                  echo ' selected';};?>><?php echo $row9h["nombre"].' '.$row9h["apellido"]?></option>
      <?php };///?>
      </select>
    </div>

  </div>
 <?php 		};	?> 





  <div class="campitem-cliente">
  

<?php if($id == ''){?>
    <div class="campb" id="tabla_de_productos">
      		<div>
			      <select name="producto1" id="producto1"  class="cantimpt" onchange="recalculador('1')">
					      <option value="" selected>Producto</option>
					      <?php //  
					        $sqlpro= "SELECT * FROM productos ORDER BY nombre ASC";
					        $resultpro = mysql_query($sqlpro, $conn1);
					        while($rowpro = mysql_fetch_array($resultpro)){ 
					      ?>    
					      <option value="<?php echo $rowpro["id"]?>"<?php if($row["vendedor"] == $rowpro["id"]){
					                  echo ' selected';};?>><?php echo $rowpro["nombre"].' ($'.$rowpro["costo"].')';?> </option>
					      <?php };///?>
			      </select>
			      <div class="cantidad_v">
						      <select name="cantidad1" id="cantidad1"  class="hospitalx" onchange="recalculador('1')">
								      <option value="0" disabled="disabled" selected>Cantidad</option>
								      <option value="1" >1</option><option value="2" >2</option><option value="3" >3</option>
								      <option value="4" >4</option><option value="5" >5</option><option value="6" >6</option>
								      <option value="7" >7</option><option value="8" >8</option><option value="9" >9</option>
								      <option value="10" >10</option>
						      </select>						      
			      </div>
			</div>
      </div>
<?php }else{?>
    <div class="campb" id="tabla_de_productos">
      		<?php $cuenta = 0; $total_precion_mod = 0;
      				$sqlpro_v= "SELECT * FROM venta_prod WHERE venta='".$id."' ORDER BY id ASC";
					$resultpro_v = mysql_query($sqlpro_v, $conn1);
					while($rowpro_v = mysql_fetch_array($resultpro_v)){ 
						$cuenta = $cuenta + 1;
						$total_precion_mod = $total_precion_mod + $rowpro_v["precio_t"];
      		?>
      		<input type="hidden" name="idp<?=  $cuenta ?>" value="<?= $rowpro_v["id"]?>"/>
      		<div id="tabla_de_productos<?=  $cuenta ?>" class="tabla_de_productos_post">
			      <select name="producto<?=  $cuenta ?>" id="producto<?=  $cuenta ?>"  class="cantimpt" onchange="recalculador('<?=  $cuenta ?>')">
					      <option value="" selected>Producto</option>
					      <?php //  
					        $sqlpro= "SELECT * FROM productos ORDER BY nombre ASC";
					        $resultpro = mysql_query($sqlpro, $conn1);
					        while($rowpro = mysql_fetch_array($resultpro)){ 
					      ?>    
					      <option value="<?php echo $rowpro["id"]?>"<?php if($rowpro_v["producto"] == $rowpro["id"]){
					                  echo ' selected';};?>><?php echo $rowpro["nombre"].' ($'.$rowpro["costo"].')';?> </option>
					      <?php };///?>
			      </select>
			      <div class="cantidad_v">
						      <select name="cantidad<?=  $cuenta ?>" id="cantidad<?=  $cuenta ?>"  class="hospitalx" onchange="recalculador('<?=  $cuenta ?>')">
								      <option value="0" disabled="disabled" selected>Cantidad</option>
								      <option value="1" <?php if($rowpro_v["cantidad"] == '1'){echo ' selected';};?>>1</option>
								      <option value="2" <?php if($rowpro_v["cantidad"] == '2'){echo ' selected';};?>>2</option>
								      <option value="3" <?php if($rowpro_v["cantidad"] == '3'){echo ' selected';};?>>3</option>
								      <option value="4" <?php if($rowpro_v["cantidad"] == '4'){echo ' selected';};?>>4</option>
								      <option value="5" <?php if($rowpro_v["cantidad"] == '5'){echo ' selected';};?>>5</option>
								      <option value="6" <?php if($rowpro_v["cantidad"] == '6'){echo ' selected';};?>>6</option>
								      <option value="7" <?php if($rowpro_v["cantidad"] == '7'){echo ' selected';};?>>7</option>
								      <option value="8" <?php if($rowpro_v["cantidad"] == '8'){echo ' selected';};?>>8</option>
								      <option value="9" <?php if($rowpro_v["cantidad"] == '9'){echo ' selected';};?>>9</option>
								      <option value="10" <?php if($rowpro_v["cantidad"] == '10'){echo ' selected';};?>>10</option>
						      </select>						      
			      </div>
			</div>
			<?php };?>
      </div>
<?php };?>


    <div class="campb dosporch">

      <div id="preciodecompra">$<?php echo $total_precion_mod;?></div>
      <input type="hidden" name="precio_total" id="precio_total" value="<?php echo $total_precion_mod;?>"/>
      <input type="hidden" name="cant_producto" id="cant_producto" value="<?php if($id == ''){echo '1';}else{echo $cuenta;};?> "/>
    </div>
  </div>

<div class="campitem"><a onclick="cloneprod()">(Agregar Producto)</a></div>


<div class="cf"></div>



 
<div class="campitem">
    <div class="campe" ><span class="lbelbg" style="margin-top:34px">OBSERVACIONES</span></div>    
    <div class="campc">
      <textarea name="comentarios"  cols="" rows="" placeholder="Observaciones"><?php echo $row["comentarios"];?></textarea>
    </div>
</div>
  

<div class="save-btns">
<a href="#" class="addbtn-editp"></a> 
<input type="submit" name="add"  value="Guardar" class="rax"/>



</div>

  
   
  <div class="cf"></div>
</div>
</div>
</form>


<div id="tabla_de_productos_muestra" style="display:none;" class="tabla_de_productos_post">
			      <select name="producto1" id="producto0"  class="cantimpt" onchange="recalculador()">
					      <option value="" disabled="disabled" selected>Producto</option>
					      <?php //  
					        $sqlpro= "SELECT * FROM productos ORDER BY nombre ASC";
					        $resultpro = mysql_query($sqlpro, $conn1);
					        while($rowpro = mysql_fetch_array($resultpro)){ 
					      ?>    
					      <option value="<?php echo $rowpro["id"]?>"<?php if($row["vendedor"] == $rowpro["id"]){
					                  echo ' selected';};?>><?php echo $rowpro["nombre"].' ($'.$rowpro["costo"].')';?> </option>
					      <?php };///?>
			      </select>
			      <div class="cantidad_v">
						      <select name="cantidad1" id="cantidad0"  class="hospitalx" onchange="recalculador()">
								      <option value="0" disabled="disabled" selected>Cantidad</option>
								      <option value="1" >1</option><option value="2" >2</option><option value="3" >3</option>
								      <option value="4" >4</option><option value="5" >5</option><option value="6" >6</option>
								      <option value="7" >7</option><option value="8" >8</option><option value="9" >9</option>
								      <option value="10" >10</option>
						      </select>						      
			      </div>
			</div>

</body>


<script type="text/javascript">
      		function recalculador(id){
      			var precio_total = 0;
      			var vueltas_for = document.getElementById("cant_producto").value;
      			for (var i = 0; i < vueltas_for; i++) {
		      			var id = i + 1;
		      			var cantid = 'cantidad' + id;
		      			var cantidad0 = document.getElementById(cantid);
		      			var produid = 'producto' + id;
		      			var producto0 = document.getElementById(produid);
						if(cantidad0.selectedIndex<0){
						    var cantidad = '1';
						}
						else{
						    var cantidad = cantidad0.options[cantidad0.selectedIndex].value;
						};

						if(producto0.selectedIndex<0){//No hay producto seleccionada
						    elem1 = 0;				
						}else{var producto = producto0.options[producto0.selectedIndex].text;};

							if(producto.indexOf('$') != -1){							
									var elem = producto.split(' ($');
									elem1 = elem[1].replace(')', '');
							}else{elem1 = 0;};
							var precio_parcial =  elem1 * cantidad;
							precio_total =  precio_parcial + precio_total;
					};//FIN DEL FOR

					document.getElementById("preciodecompra").innerHTML = '$' + precio_total;
					document.getElementById("precio_total").value = precio_total;
      		}

function cloneprod() {
		 var porId=document.getElementById('cant_producto').value;// Obtenemos el valor de la cantidad actual de elementos por el id del input bandera
		 porId2 = parseInt(porId);
		 var nuevovalor = porId2 + 1;

		var id_tbl_new = "tabla_de_productos" + nuevovalor;
		var clonedDiv = $('#tabla_de_productos_muestra').clone(); // Clono
		clonedDiv.attr("id", id_tbl_new); // Cambio ID
		var segundo_p = document.getElementById('tabla_de_productos');// Despues de quien lo quiero meter		
		$('#tabla_de_productos').append(clonedDiv);

		 var segundo_f = document.getElementById(id_tbl_new).getElementsByTagName("select");// primer select
		 segundo_f[0].id = "producto" + nuevovalor;
		 segundo_f[0].name = "producto" + nuevovalor;
		 
		 segundo_f[1].id = "cantidad" + nuevovalor;
		 segundo_f[1].name = "cantidad" + nuevovalor;

		 document.getElementById(id_tbl_new).style.display = "block";
		 document.getElementById('cant_producto').value = nuevovalor;
	}

      </script>
    

<script> // EVITAR EL SUBMIT AL APRETAR LA TECLA ENTER
function pulsar(e) { 
  tecla = (document.all) ? e.keyCode :e.which; 
  return (tecla!=13); 
} 
</script>



<?php    $created = date("Y-m-d H:i:s");	?>

<!--<script type="text/javascript" src="./jquery.js"></script>-->
<script type="text/javascript" src="jquery.datetimepicker.js"></script>
<script type="text/javascript">
$('#datetimepicker').datetimepicker()
<!--	.datetimepicker({value:'<?php //echo $created;?>',step:10});-->

$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});



       
<?php for($i = 1 ; $i < $cantidadeveact + 1 ; $i++){//apertura del for de muchas horas?>
$('#datetimepicker1<?php echo $i?>').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:30,
	
})<?php /*if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?>',step:10})
<?php };//*/?> 
;
$('#datetimepicker2<?php echo $i?>').datetimepicker({
//	yearOffset:222,
	lang:'es',
	timepicker:false,
	format:'d/m/Y',
	
//	format:'d/m/Y',
	formatDate:'d/m/y',
//	minDate:'-1970/01/02', // yesterday is minimum date
//	maxDate:'+1970/01/02' // and tommorow is maximum date calendar
})<?php /*if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],0,4).'/'.substr($row["fecha_entrega"],5,2).'/'.substr($row["fecha_entrega"],8,2);?>',step:10})
<?php };//*/?> 
;
<?php } //cierre del for de muchas horas?>





<?php 	for($i = 0 ; $i < $cantfechafin + 1 ; $i++){//apertura del for de fechas fin en Contratacion?> 
$('#datetimepicker2<?php echo $arrayfechafin[$i]?>f').datetimepicker({
	lang:'es',
	timepicker:false,
	format:'d/m/Y',
	formatDate:'d/m/y',
});
<?php } //cierre del for de fechas fin en Contratacion?>




      

$('#datetimepicker3').datetimepicker({
<?php /*if($id != ''){?>
	mask:'<?php echo substr($row["fecha_entrega"],0,4).'/'.substr($row["fecha_entrega"],5,2).'/'.substr($row["fecha_entrega"],8,2).' '.substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?> ',
<?php };*/?> 
	lang:'es',
	timepicker:false,
//	format:'d/m/Y',
	formatDate:'Y/m/d',
	inline:true
})<?php if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],0,4).'/'.substr($row["fecha_entrega"],5,2).'/'.substr($row["fecha_entrega"],8,2).' '.substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?>',step:10})
<?php };?> 
;
$('#datetimepicker3b').datetimepicker({
<?php if($id != ''){?>
	mask:'<?php echo substr($row["fecha_entrega"],0,4).'/'.substr($row["fecha_entrega"],5,2).'/'.substr($row["fecha_entrega"],8,2).' '.substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?> ',
<?php };?> 
	datepicker:false,
	format:'H:i',
	step:30,
	inline:true,
	allowTimes:['08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','80:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00']
})<?php if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?>',step:10})
<?php };?> 
;
</script>



<script type="text/javascript">
    
    document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};  
</script>  


</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};		
	?>