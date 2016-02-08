<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};

if ($id != ''){
	$sql1 = "SELECT * FROM cliente WHERE id='".$id."' ";
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
<span class="dayn"><?php echo $dia_hoy;?> </span>
</div>
<div class="btn-proys"><a href="cliente.php"><img src="back-clientes.png" width="44" height="44" /></a></div>
<span class="titlesec">CLIENTES</span>
</div>  
    


<div class="tp">
<div class="subpanel">
<!--<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>
--></div>
  <div class="cf"></div>
</div>



<form method="post" action="panel/a_cli.php?id=<?php echo $id;?>&vi=<?php echo $vi;?>" name="frmRegistro">
<div class="onecol"><span class="titlecol-ad"><?php if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> cliente </span>
  




<?php /*if($_SESSION["tipo"] != 'vendedor') {?>
  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <!--<input type="text" name="vendedor" id="textfield" placeholder="Vendedor asignado:" value="<?php echo $row["vendedor"];?>"/>-->
      <select name="vendedor" id="textfield"  class="hospitalx" style="height: 44px;">
      <option value="" disabled="disabled" selected>Vendedor </option>
      <?php //  
        $sql9h= "SELECT * FROM vendedor ORDER BY nombre, apellido ASC";
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){ 
      ?>    
      <option value="<?php echo $row9h["id"]?>"<?php 
                  if($row["vendedor"] == $row9h["id"]){
                  echo ' selected';}; 
                  ?>><?php echo $row9h["nombre"].' '.$row9h["apellido"]?></option>
      <?php };///?>
      </select>
    </div><div class="campb dospor">
      <label for="textfield"></label>
      <!--<input type="text" name="rfc" id="textfield" placeholder="RFC:" value="<?php echo $row["rfc"];?>"/>      -->
    </div>
  </div>
<?php };//*/?>





  <div class="campitem-cliente">
    <div class="campb">
      <div>Nombre:</div>
      <input type="text" name="contacto" id="textfield" placeholder="" value="<?php echo $row["contacto"];?>"/>
      <div class="margintop">Domicilio:</div>
      <input type="text" name="domicilio" id="textfield" placeholder="" value="<?php echo $row["domicilio"];?>"/>    
      <div class="margintop">Colonia</div>
      <input type="text" name="colonia" id="textfield" placeholder="" value="<?php echo $row["colonia"];?>"/>      
      <div class="margintop">Teléfono</div>
      <input type="text" name="telefono" id="textfield" placeholder="" value="<?php echo $row["telefono"];?>"/>  
    </div>
    <div class="campb dosporch">
      <div>Empresa:</div>
      <input type="text" name="nombre" id="textfield" placeholder="" value="<?php echo $row["nombre_empresa"];?>"/>
      <div class="margintop">Domicilio de la empresa</div>
      <input type="text" name="domicilio_emp" id="textfield" placeholder="" value="<?php echo $row["domicilio_emp"];?>"/> 
      <div class="margintop">Colonia de la empresa</div>
      <input type="text" name="colonia_empr" id="textfield" placeholder="" value="<?php echo $row["colonia_empr"];?>"/>
      <div class="margintop">Telefono de la Empresa</div>
      <input type="text" name="telefono_emp" id="textfield" placeholder="" value="<?php echo $row["telefono_emp"];?>"/> 
    </div>
  </div>



  
  <div class="campitem-cliente">
    <div class="campb">
      <div>Serie Vehiculo Remolcador</div>
      <input type="text" name="targeta_circulacion" id="textfield" value="<?php echo $row["targeta_circulacion"];?>"/>
    </div>
    
    <div class="campb  dospor">
      <div>Placas</div>
      <input type="text" name="placas_vehiculo" id="textfield" placeholder="" value="<?php echo $row["placas_vehiculo"];?>"/>
    </div>
  </div>


  
  
  
  <div class="campitem-cliente">
  <div class="campb "> 
      <div>IFE</div>
      <input type="text" name="ife" id="textfield" placeholder="" value="<?php echo $row["ife"];?>"/>
    </div>

    <div class="campb dospor">
      <label for="textfield"></label>
      <!--<input type="text" name="cp" id="textfield" placeholder="Codigo Postal" value="<?php echo $row["cospos"];?>"/>-->
    </div>
  </div>



  <!--
  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="razonsocial" id="textfield" placeholder="RS:" value="<?php echo $row["razonsocial"];?>"/>
    </div><div class="campb dospor">
      <label for="textfield"></label>
      <input type="text" name="rfc" id="textfield" placeholder="RFC:" value="<?php echo $row["rfc"];?>"/>      
    </div>
  </div>
-->


  <div class="cf"></div>
  
  <div class="save-btns">
      <input type="submit" name="add"  value="Guardar" class="rax"/> </div>
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