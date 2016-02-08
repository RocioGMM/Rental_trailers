<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$c = $_POST["c"];if($c == ''){$c = $_REQUEST["c"];};
$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};
$id_categ = $_POST["id_categ"];if($id_categ == ''){$id_categ = $_REQUEST["id_categ"];};
//$id_categ = $_REQUEST["id_categ"];


	$sql1 = "SELECT * FROM sucursales WHERE id='".$id."' ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
	$bandera = 'ok';

	
/*if($_SESSION["city_habilita"]	!= '1' && $_SESSION["tipo"] != 'admin'){ 	
if($_SESSION["ciudad"] < 6){$c = '1';};
if($_SESSION["ciudad"] > 5){$c = '2';};
};*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="log-out">
  <div class="lo-logo"><img src="logopocket.png" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>


    <div class="menubar" >
      <a href="programacion.php" class="op log"></a>
<?php   $sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
  <a href="cuenta.php" class="op loname">Bienvenido <?php echo $row7["nombre"];?>! <br />

</a>

      <a href="programacion.php" class="op lop">Inicio</a>
    <?php if($_SESSION["tipo"] == 'admin' || $_SESSION["estadisticas"] == '1'){?>   <a href="estadisticas.php" class="op mop">Estadisticas</a><?php };?>
    <?php if($_SESSION["tipo"] == 'admin' || $_SESSION["usuarios"] == '1'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php };?>
    </div>
    
  <div class="bann-int">
<div class="today">
<?php  
  $created = date("Y-m-d H:i:s");
  $dia_hoy = substr($created,8,2);
  $mes_hoy = substr($created,5,2); 
?>
<span class="day"><?php echo replacemes($mes_hoy);?></span>
<span class="dayn"><?php echo $dia_hoy;?> </span>
</div>
<div class="btn-proys"><a href="sucursales.php"><img src="back-clientes.png" width="44" height="44" /></a></div>
<span class="titlesec">SUCURSALES</span>
</div>
    
  <div class="tp">
	<div class="subpanel"><!--
		<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
		<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>-->
	</div>
	<div class="cf"></div>
</div>
  
    
<form method="post" action="panel/b_suc.php?id=<?php echo $id;?>&tipo=<?php echo $tipo;?>" name="frmRegistro">
<input type="hidden" id="id" name="id" value="<?php echo $id;?>">

<div class="onecol"><span class="titlecol-ad">Eliminar Sucursal </span>
  

<div class="campitem-cliente">

    <div class="campb">Nombre: <?php echo $row["nombre"];?> </div>
    <div class="campb dospor">Telefono: <?php echo $row["telefono"];?> 
    
    </div>
  </div>
  
  <div class="campitem-cliente">    
    <div class="campb"> E-Mail: <?php echo $row["mail"];?>    </div>
    
    <div class="campb dospor">Direccion: <?php	echo $row9["direccion"]?>
    </div>
  </div>
  <div class="campitem-cliente">
    <!--<div class="campb">Correo:  <?php echo $row["email"];?> </div>-->
</div>
  <div class="save-btns">
    <div class="campc">
      <input type="submit" name="add"  value="Eliminar" class="rax"/> 		
<!-- <a href="javascript:document.forma.submit();" class="ra">Guardar</a> -->
</div>
</div>

  
  <div class="cf"></div>
</div>
</form>
</body>


</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};		
	?>