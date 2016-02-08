<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};

if ($id != ''){
	$sql1 = "SELECT * FROM sucursales WHERE id='".$id."' ";
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
</head>

<body>

<div class="log-out">
  <div class="lo-logo"><img src="logoconcre.png" width="206" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>

    <div class="menubar" >
  <a href="programacion.php" class="op log"></a>
<?php   $sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
  <a  class="op loname">Bienvenido <?php echo $row7["nombre"];?>! </a>



  <a href="programacion.php" class="op lop">Inicio</a>
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
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
<div class="btn-proys"><a href="sucursales.php"><img src="back-clientes.png" width="44" height="44" /></a></div>
<span class="titlesec">SUCURSALES</span>
</div>  
    


<div class="tp">
<div class="subpanel">
<!--<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>
--></div>
  <div class="cf"></div>
</div>



<form method="post" action="panel/a_suc.php?id=<?php echo $id;?>&vi=<?php echo $vi;?>" name="frmRegistro">
<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
<div class="onecol"><span class="titlecol-ad"><?php if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> Sucursal </span>
  


  <div class="campitem-cliente">
    <div class="campb">      
          <div class="matemp0">Empresa 
          <input name="empresa" type="checkbox" value="s" id="empresack"onclick="checkempresa()" <?php if($row["empresa"] == 's'){echo ' checked';};?>/></div>
          <input type="text" name="empresatxt" id="empresatxt" class="matemp" placeholder="Nombre" value="<?php echo $row["direccion"];?>" style="display:none;"/>
          <div id="emprselect_div" style="display:block;" class="matemp">
            <select name="empresaselect" id="empresaselect"  class="hospitalx "  onchange="chchmz()" style="display:<?php if($row["empresa"] == 's'){echo 'none';}else{echo 'block';};?>;">
                <option value="" disabled="disabled" selected>Seleccione</option>
                <?php    
                  $sqlmtz = "SELECT * FROM sucursales WHERE empresa='s' ORDER BY nombre ASC";
                  $resultmtz = mysql_query($sqlmtz, $conn1);
                  while($rowmtz = mysql_fetch_array($resultmtz)){ 
                ?>    
                <option value="<?php echo $rowmtz["id"]?>"<?php 
                            if($row["empresa"] == $rowmtz["id"]){echo ' selected';};
                            ?>><?php echo $rowmtz["nombre"];?></option>
                <?php };//*/?>
            </select>
    </div>
    </div>


    <div class="campb dosporch">      
          <div class="matemp0">Matriz 
          <input name="matrizck" type="checkbox" value="s" id="matrizck" onclick="checkmatriz()"<?php if($row["matriz"] == 's'){echo ' checked';};?>/></div>
          <input type="text" name="matriztxt" id="matriztxt" class="matemp" placeholder="Nombre" value="<?php echo $row["direccion"];?>" style="display:none;"/>
          <div id="matrizselect_div" style="display:block;" class="matemp">
            <select name="matrizselect" id="matrizselect"  class="hospitalx " style="display:<?php if($row["matriz"] == 's'){echo 'none';}else{echo 'block';};?>;">
                <option value="" disabled="disabled" selected>Seleccione<?php //echo $id?></option>
                <?php    
                  //$sqlmtz = "SELECT * FROM sucursales WHERE matriz='".$row["matriz"]."' ORDER BY nombre ASC";
                  $sqlmtz = "SELECT * FROM sucursales WHERE empresa='".$row["empresa"]."' AND matriz='s' ORDER BY nombre ASC";
                  $resultmtz = mysql_query($sqlmtz, $conn1);
                  while($rowmtz = mysql_fetch_array($resultmtz)){ 
                ?>    
                <option value="<?php echo $rowmtz["id"]?>"<?php 
                            if($row["matriz"] == $rowmtz["id"]){echo ' selected';};
                            ?>><?php echo $rowmtz["nombre"];?></option>
                <?php };//*/?>
            </select>
    </div>
    </div>
  </div>  
 


  <script>
  function chchmz(){
      var posicion=document.getElementById('empresaselect').options.selectedIndex; //posicion
      //alert(document.getElementById('matrizselect').options[posicion].text); //valor
      var elidmtz = document.getElementById('empresaselect').options[posicion].value;
      var linkvm7 = 'selectmtrz.php?id='+elidmtz;
        $("#matrizselect_div").load(linkvm7);
  }
  function checkmatriz(){
    var chkemtz = document.getElementById("matrizck");
    if (chkemtz.checked) {
      document.getElementById("matrizselect_div").style.display = "none";
      //document.getElementById("matriztxt").style.display = "block";
    }else {
      document.getElementById("matrizselect_div").style.display = "block";
      document.getElementById("matriztxt").style.display = "none";      
    };
  }
  function checkempresa(){
    var chkemtz = document.getElementById("empresack");
    if (chkemtz.checked) {
      document.getElementById("emprselect_div").style.display = "none";
      //document.getElementById("empresatxt").style.display = "block";
    }else {
      document.getElementById("emprselect_div").style.display = "block";
      document.getElementById("empresatxt").style.display = "none";      
    };
  }
/*
  $('#matrizck').click(function(){
    if (this.checked) alert("checkbox activado");
    else alert("checkbox desactivado")
  });*/
  </script>



  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="nombre" id="textfield" placeholder="Nombre" value="<?php echo $row["nombre"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="direccion" id="textfield" placeholder="Direccion" value="<?php echo $row["direccion"];?>"/>
    </div>
  </div>



  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="mail" id="textfield" placeholder="E-Mail" value="<?php echo $row["mail"];?>"/>
    </div>
    
    <div class="campb dospor">
      <label for="textfield"></label>
      <input type="text" name="telefono" id="textfield" placeholder="Telefono" value="<?php echo $row["telefono"];?>"/>
    </div>
    
  </div>
  
  

  
  
  <div class="campitem-cliente">
  <div class="campb "> 
      <label for="textfield"></label> 
      <!--<input type="text" name="estado" id="textfield" placeholder="Estado" value="<?php echo $row["estado"];?>"/>-->

      <select name="estado" id="textfield"  class="hospitalx" style="height: 44px;">
      <option value="" disabled="disabled" selected>Estado</option>
      <?php   
        $sql9h= "SELECT * FROM estado WHERE se_puplica = 's' ORDER BY nombre ASC";
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){ 
      ?>    
      <option value="<?php echo $row9h["id"]?>"<?php 
                  if($row["estado"] == $row9h["id"]){echo ' selected';}
                  elseif($row["estado"] == '' && $row9h["id"] == '2'){echo ' selected';};
                  ?>><?php echo $row9h["nombre"];?></option>
      <?php };///?>
      </select>
    </div>

    <div class="campb dospor">      
      <select name="ciudad" id="ciudad"  class="hospitalx" style="height: 44px;">
          <option value="" disabled="disabled" selected>Ciudad</option>
          <?php  
          if($row["estado"] == ''){ 
            $sqlcit= "SELECT * FROM ciudad WHERE estado='2' ORDER BY nombre ASC";
          }else{
            $sqlcit= "SELECT * FROM ciudad WHERE estado='".$row["estado"]."' ORDER BY nombre ASC";        
          };
            $resultcit = mysql_query($sqlcit, $conn1);
            while($rowcit = mysql_fetch_array($resultcit)){ 
          ?>    
          <option value="<?php echo $rowcit["id"]?>" <?php 
                      if($row["estado"] == $rowcit["id"]){echo ' selected';}
                      elseif($row["ciudad"] == '' && $rowcit["id"] == '33'){echo ' selected';};
                      ?>><?php echo $rowcit["nombre"];?></option>
          <?php };///?>
      </select>
    </div>
  </div>


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