<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};

if ($id != ''){
	$sql1 = "SELECT * FROM alquiler WHERE id='".$id."' ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
};
$fecha_hoy = strtotime ( '-4 hour' , strtotime ( date("Y/m/d H:i:s") ) );
$fecha_hoy = date ( 'Y/m/d H:i:s' , $fecha_hoy );

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
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
  $created = date("Y/m/d H:i:s");
  $dia_hoy = substr($created,8,2);
  $mes_hoy = substr($created,5,2); 
?>
<span class="day"><?php echo replacemes($mes_hoy);?></span>
<span class="dayn"><?php echo $dia_hoy;?> </span>
</div>
<div class="btn-proys"><a href="cliente.php"><img src="back-clientes.png" width="44" height="44" /></a></div>
<span class="titlesec">ALQUILER DE REMOLQUES</span>
</div>  
    


<div class="tp">
<div class="subpanel">
<!--<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>
--></div>
  <div class="cf"></div>
</div>



<form method="post" action="panel/a_alq.php?id=<?php echo $id;?>&vi=<?php echo $vi;?>" name="frmRegistro">
<div class="onecol"><span class="titlecol-ad"><?php if($id == ''){echo 'Agregar';}else{echo 'Modificar';};?> alquiler </span>
  






  
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

    <div class="campb margin-bottom">
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

 <?php    };  ?> 

  




 

    <div class="campb margin-bottom dosporch">
      <select name="valor_dia" id="remolque_dia"  class="hospitalx delckheck" 
      style="height: 44px;display:<?php if($row["tiempo"] == 'semanas'){echo 'none';}else{echo 'inline-block';};?>"
      onclick="calculador_p();cambia_select1()">
      <option value="0" disabled="disabled" selected>Remolque </option>
      <?php    
        $sql9h= "SELECT * FROM remolques ORDER BY numero ASC";
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){ 
      ?>    
      <option value="<?php echo $row9h["id"]?>"<?php 
                  if($row["remolque"] == $row9h["id"]){
                  echo ' selected';};?>><?php echo $row9h["modelo"].' - '.$row9h["capacidad"].' ($'.$row9h["valor_dia"].')';?></option>
      <?php };///?>
      </select>
      <select name="valor_semana" id="remolque_semana"  class="hospitalx delckheck" 
      style="height: 44px;display:<?php if($row["tiempo"] == 'semanas'){echo 'inline-block';}else{echo 'none';};?>" 
      onclick="calculador_p();cambia_select2()">
      <option value="0" disabled="disabled" selected>Remolque </option>
      <?php    
        $sql9h= "SELECT * FROM remolques ORDER BY numero ASC";
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){ 
      ?>    
      <option value="<?php echo $row9h["id"]?>"<?php 
                  if($row["remolque"] == $row9h["id"]){
                  echo ' selected';};?>><?php echo $row9h["modelo"].' - '.$row9h["capacidad"].' ($'.$row9h["valor_semana"].')';?></option>
      <?php };///?>
      </select>
      <?php if($id != ''){?>
            <div class="cambiox">
              <div class="chk_alq3">Cambio  <input type="checkbox" name="cambio" value="si" id="cambio" 
              <?php if($row["cambio"]=='si'){echo 'checked disabled';}; ?> onclick="cambia_rem()"></div>
              <input type="hidden" name="fecha_cambio0" id="fecha_cambio0" value="<?php echo $fecha_hoy;?>"/>
              <input type="hidden" name="fecha_cambio" id="fecha_cambio" value="<?php echo $row["fecha_cambio"];?>"/>
              <input type="hidden" name="remolque_antes_cambio0" id="remolque_antes_cambio0" value="<?php echo $row["remolque"];?>"/>
              <input type="hidden" name="remolque_antes_cambio" id="remolque_antes_cambio" value="<?php echo $row["remolque_antes_cambio"];?>"/>
              <input type="hidden" name="precio_antes_cambio0" id="precio_antes_cambio0" value="<?php echo $row["precio_total"];?>"/>
              <input type="hidden" name="precio_antes_cambio" id="precio_antes_cambio" value="<?php echo $row["precio_antes_cambio"];?>"/>
            </div>
      <?php };?>
    </div>



  
    <div class="campb margin-bottom">
      <label for="textfield"></label>
      <div class="chk_alq_txt">Fecha de Renta</div>
      <input type="text" name="fecha_renta" class="inputgral2" placeholder="Fecha de Alquiler"  id="datetimepicker" 
      value="<?php if($id != ""){echo $row["fecha_renta"];}else{echo $fecha_hoy;};?>"/>
    </div>
  

<?php if ($id != ''){?>
    <div class="campb dospor margin-bottom" id="fecha_deb">
      <label for="textfield"></label>
      <div class="chk_alq_txt">Fecha de Devolucion</div>
      <input type="text" name="fecha_devolucion" class="inputgral2" placeholder="Fecha de Devolucion" id="datetimepicker2"
       value="<?= $row["fecha_devolucion"];?>"/>
    </div>
<?php };?>


    
    <div class="campb">
      <div class="chk_alq">
            <div class="chk_alq_txt">Tiempo de alquiler</div>
            <div class="chk_alq1">Dias  <input type="radio" name="tiempo" value="dias" checked onclick="cambia_select_p1()"></div>
            <div class="chk_alq2"><input type="radio" name="tiempo" value="semanas" onclick="cambia_select_p2()"> Semanas</div>
      </div>
      <div class="cantidad_a">
                  <select name="cantidad" id="cantidad"  class="hospitalx"  onclick="calculador_p()">
                      <option value="0" disabled="disabled" selected>Cantidad</option>
                      <option value="1" <?php if($row["cantidad"] == '1'){echo 'selected';};?>>1</option>
                      <option value="2" <?php if($row["cantidad"] == '2'){echo 'selected';};?>>2</option>
                      <option value="3" <?php if($row["cantidad"] == '3'){echo 'selected';};?>>3</option>
                      <option value="4" <?php if($row["cantidad"] == '4'){echo 'selected';};?>>4</option>
                      <option value="5" <?php if($row["cantidad"] == '5'){echo 'selected';};?>>5</option>
                      <option value="6" <?php if($row["cantidad"] == '6'){echo 'selected';};?>>6</option>
                      <option value="7" <?php if($row["cantidad"] == '7'){echo 'selected';};?>>7</option>
                  </select>                 
      </div>
    </div>
  


  <script>
  function cambia_rem(){
    var checkboxes = document.getElementById("cambio");
   if (checkboxes.checked) {
      var fecha_cambio = document.getElementById("fecha_cambio0").value;
      var precio_antes_cambio = document.getElementById("precio_antes_cambio0").value;
      var remolque_antes_cambio = document.getElementById("remolque_antes_cambio0").value;
      document.getElementById("remolque_antes_cambio").value = remolque_antes_cambio;
      document.getElementById("precio_antes_cambio").value = precio_antes_cambio;
      document.getElementById("fecha_cambio").value = fecha_cambio;
     }
    
  }

  function cambia_select_p1(){
    document.getElementById("remolque_dia").style.display = "inline-block";
    document.getElementById("remolque_semana").style.display = "none";
    calculador_p();
  }
  function cambia_select_p2(){
    document.getElementById("remolque_dia").style.display = "none";
    document.getElementById("remolque_semana").style.display = "inline-block";
    calculador_p();
  }
  function cambia_select1(){
    document.getElementById('remolque_semana').value = document.getElementById('remolque_dia').value
  }
  function cambia_select2(){
    document.getElementById('remolque_dia').value = document.getElementById('remolque_semana').value
  }
  function calculador_p(){
                var cantidad0 = document.getElementById("cantidad");
                var cantidad = cantidad0.options[cantidad0.selectedIndex].value;

                var valor_dia0 = document.getElementById("remolque_dia");
                var valor_dia1 = valor_dia0.options[valor_dia0.selectedIndex].text;
                if(valor_dia1.indexOf('$') != -1){              
                    var elem = valor_dia1.split(' ($');
                    valor_dia = elem[1].replace(')', '');
                }else{valor_dia = 0;};

                var valor_semana0 = document.getElementById("remolque_semana");
                var valor_semana1 = valor_semana0.options[valor_semana0.selectedIndex].text;
                if(valor_semana1.indexOf('$') != -1){              
                    var elem2 = valor_semana1.split(' ($');
                    valor_semana = elem2[1].replace(')', '');
                }else{valor_semana = 0;};

                var radioButTrat = document.getElementsByName("tiempo");
                for (var i=0; i<radioButTrat.length; i++) {
                        if (radioButTrat[i].checked == true) { var tiempo_cant = radioButTrat[i].value; }
                }

                if(tiempo_cant == 'dias'){var valor_elegido = valor_dia;}
                else{var valor_elegido = valor_semana;}
                
                var valor_total = valor_elegido * cantidad;

                document.getElementById("preciodecompra").innerHTML = '$' + valor_total;
                document.getElementById("precio_total").value = valor_total;

                var fecha = document.getElementById("datetimepicker").value;/*Extraigo dias de "dia de Renta"*/
                var d = new Date(fecha); /*transformo la fecha extraida en formato fecha de javascript*/
                var cantidaddi = cantidad * 1;/*creo la variable cantidad de dias para saber cuantos dias tengo que sumar*/
                if (tiempo_cant == 'semanas'){ cantidaddi = cantidaddi * 7; };/*si son semanas multiplico *7 dias*/
                d.setDate(d.getDate()+cantidaddi);/*sumo los dias correspondientes a la fecha*/
                var fch = d.toLocaleString();/*transformo la fecha en formato fecha aceptable*/

                var fchcad = fch.split("/");//fotmato fecha de php
                var fchcad2 = fchcad[2].split(" ");
                var estaes = fchcad2[0] + "/" + fchcad[1] + "/"  + fchcad[0] + " " + fchcad2[1];

                document.getElementById("regreso").innerHTML = estaes;
                document.getElementById("fecha_alquilada").value = estaes;
                /*$('#datetimepicker2').datetimepicker()
                .datetimepicker({value:estaes,step:10});*/

                var checkboxes = document.getElementById("cambio");
                if (checkboxes.checked) {
                  var precio_antes_cambio = document.getElementById("precio_antes_cambio").value;
                  precio_antes_cambio = precio_antes_cambio * 1;
                  var resto_din = valor_total - precio_antes_cambio;
                  document.getElementById("resto").innerHTML = '$' + resto_din;
                  document.getElementById("restodiv").style.display = "block";
                }
  }
  </script>
  
  
  <div class="campb dosporch">
      <div>Fecha de Regreso: <div id="regreso"><?= $row["fecha_alquilada"]?></div></div>
      <div id="preciodecompra">$<?php echo $row["precio_total"];?></div>
      <div id="restodiv" style="display:<?php if($row["cambio"]=='si'){echo 'block';}else{echo 'none';}?>">
      Resto por el cambio: <div id="resto"><?php $resto = $row["precio_total"] - $row["precio_antes_cambio"];echo '$ '.$resto;?>
      </div>
        <?php if($id != '' && $row["cambio"]=='si'){
                $sqlrem9= "SELECT * FROM remolques ORDER BY numero ASC";
                $resultrem9 = mysql_query($sqlrem9, $conn1);
                $rowrem9 = mysql_fetch_array($resultrem9);

                echo '('.$rowrem9["modelo"].' - '.$rowrem9["capacidad"].')';
        };?>
      </div>
      <input type="hidden" name="precio_total" id="precio_total" value="<?php echo $row["precio_total"];?>"/>      
      <input type="hidden" name="fecha_captura" id="fecha_captura" value="<?php echo $row["fecha_captura"];?>"/>
      <input type="hidden" name="fecha_alquilada" id="fecha_alquilada" value="<?php echo $row["fecha_alquilada"];?>"/>      
  </div>


<div class="campitem margin-bottom2">
    <div class="campe" ><span class="lbelbg" style="margin-top:34px">DAÑOS
               <input type="checkbox" name="danos" value="si" id="danos" 
              <?php if($row["danos"]=='si'){echo 'checked ';}; ?> >    
    </span></div> 
    <div class="campc">
      <textarea name="observaciones"  cols="" rows="" placeholder="Observaciones del Daño"><?php echo $row["observaciones"];?></textarea>
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
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
$('#datetimepicker').datetimepicker()
  .datetimepicker({value:'<?php if($id != ""){echo $row["fecha_renta"];}else{echo $fecha_hoy;};?>',step:10});
$('#datetimepicker2').datetimepicker()
  .datetimepicker({value:'<?php if($id != ""){echo $row["fecha_devolucion"];};?>',step:10});
</script>
</html>

<?php

		mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
	?>