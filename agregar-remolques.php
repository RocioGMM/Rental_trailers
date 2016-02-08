<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};

if ($id != ''){
	$sql1 = "SELECT * FROM remolques WHERE id='".$id."' ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
};


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="log-out">
  <div class="lo-logo"><img src="logogrande.svg"  height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>

    <div class="menubar" >
  <a href="programacion.php" class="op log"></a>
<?php   $sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
  <a href="cuenta.php" class="op loname">Bienvenido <?php echo $row7["nombre"];?>! <br /></a>



  <a href="programacion.php" class="op lop">Inicio</a>    
  <a href="productos.php" class="op mop">Productos</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php  };?>
  <a href="cliente.php" class="op cli">Clientes</a>
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
<div class="btn-proys"><a href="remolques.php"><img src="back-clientes.png" width="44" height="44" /></a></div>
<span class="titlesec">REMOLQUES</span>
</div>  
    


<div class="tp">
<div class="subpanel">
<!--<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>
--></div>
  <div class="cf"></div>
</div>



<form method="post" action="panel/a_rem.php?id=<?php echo $id;?>&vi=<?php echo $vi;?>" name="frmRegistro">
<div class="onecol"><span class="titlecol-ad"><?php if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> remolque </span>
  


  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <?php if ($id != ''){?><div class="chk_alq_txt">Numero</div><?php };?>
      <input type="text" name="numero" id="textfield" placeholder="Numero:" value="<?php echo $row["numero"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <?php if ($id != ''){?><div class="chk_alq_txt">Modelo</div><?php };?>
      <input type="text" name="modelo" id="textfield" placeholder="Modelo:" value="<?php echo $row["modelo"];?>"/>
    </div>
  </div>



  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <?php if ($id != ''){?><div class="chk_alq_txt">Medidas</div><?php };?>
      <input type="text" name="medidas" id="textfield" placeholder="Medidas" value="<?php echo $row["medidas"];?>"/>
    </div>    
    <div class="campb dospor">
      <label for="textfield"></label>
      <?php if ($id != ''){?><div class="chk_alq_txt">Capacidad</div><?php };?>
      <input type="text" name="capacidad" id="textfield" placeholder="Capacidad" value="<?php echo $row["capacidad"];?>"/>
    </div>
    
  </div>



  <div class="campitem-cliente">    
    <div class="campb">
      <label for="textfield"></label>
      <?php if ($id != ''){?><div class="chk_alq_txt">Serie</div><?php };?>
      <input type="text" name="serie" id="textfield" placeholder="Serie" value="<?php echo $row["serie"];?>"/>
      
    </div>  
  <div class="campb dospor"> 
      <label for="textfield"></label>       
      <?php if ($id != ''){?><div class="chk_alq_txt">Placas</div><?php };?>
      <input type="text" name="placas" id="textfield" placeholder="Placas" value="<?php echo $row["placas"];?>"/>
    </div>
  </div>


  
  
  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <?php if ($id != ''){?><div class="chk_alq_txt">Valor Real</div><?php };?>
      <input type="text" name="valor_real" id="textfield" placeholder="Valor Real" value="<?php echo $row["valor_real"];?>"/>
    </div>
    
    <div class="campb  dospor">
      <label for="textfield"></label>
      <?php if ($id != ''){?><div class="chk_alq_txt">Valor por Dia</div><?php };?>
      <input type="text" name="valor_dia" id="textfield" placeholder="Valor por dia" value="<?php echo $row["valor_dia"];?>"/>
    </div>
</div>

  
  
  <div class="campitem-cliente margin-bottom2">
    <div class="campb">
      <label for="textfield"></label>
      <?php if ($id != ''){?><div class="chk_alq_txt">Valor por semana</div><?php };?>
      <input type="text" name="valor_semana" id="textfield" placeholder="Valor por semana" value="<?php echo $row["valor_semana"];?>"/>
    </div>
    
    <div class="campb  dospor">
      <label for="textfield"></label>
      <!--<input type="text" name="placas_vehiculo" id="textfield" placeholder="Placas" value="<?php echo $row["placas_vehiculo"];?>"/>-->
    </div>
  </div>





  <div class="cf"></div>
  
  <div class="save-btns">
      <input type="submit" name="add"  value="Guardar" class="rax"/> </div>
  </div>

</div>
  
  
  
  
  
  
  
  <div class="cf"></div>
</div>
</form>
<?php //*?/?>
</body>
</html>

<?php

		mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
	?>