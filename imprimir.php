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
  
  $sql9h= "SELECT * FROM cliente WHERE id='".$row["cliente"]."' ORDER BY nombre_empresa ASC";
  $result9h = mysql_query($sql9h, $conn1);
  $row9h = mysql_fetch_array($result9h);

  $sql5= "SELECT * FROM remolques WHERE id='".$row["remolque"]."'  ";
  $result5 = mysql_query($sql5, $conn1);
  $row5 = mysql_fetch_array($result5);
};
$fecha_hoy = strtotime ( '-4 hour' , strtotime ( date("Y/m/d H:i:s") ) );
$fecha_hoy = date ( 'Y/m/d H:i:s' , $fecha_hoy );

$mes_rent = substr($row["fecha_renta"],5,2);
if($mes_rent == '01' || $mes_rent == '1'){$mes_rent = 'Enero';};
if($mes_rent == '02' || $mes_rent == '2'){$mes_rent = 'Febrero';};
if($mes_rent == '03' || $mes_rent == '3'){$mes_rent = 'Marzo';};
if($mes_rent == '04' || $mes_rent == '4'){$mes_rent = 'Abril';};
if($mes_rent == '05' || $mes_rent == '5'){$mes_rent = 'Mayo';};
if($mes_rent == '06' || $mes_rent == '6'){$mes_rent = 'Junio';};
if($mes_rent == '07' || $mes_rent == '7'){$mes_rent = 'Julio';};
if($mes_rent == '08' || $mes_rent == '8'){$mes_rent = 'Agosto';};
if($mes_rent == '09' || $mes_rent == '9'){$mes_rent = 'Septiembre';};
if($mes_rent == '10'){$mes_rent = 'Octubre';};
if($mes_rent == '11'){$mes_rent = 'Noviembre';};
if($mes_rent == '12'){$mes_rent = 'Diciembre';};
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


<div class="onecol">


<div class="sinimprimir2 menuimpr">
  <div class="menuimpr_item" id="item1" onclick="mostrar_impr('carta_responsiva')">CARTA RESPONSIVA</div>
  <div class="menuimpr_item" id="item2" onclick="mostrar_impr('pagare')">PAGARE</div>
  <div class="menuimpr_item" id="item3" onclick="mostrar_impr('contrato_arrendamiento')">CONTRATO DE ARRENDAMIENTO</div>
  <div class="menuimpr_item2"  onclick='window.print();' >IMPRIMIR</div>
</div>

<script>
  function mostrar_impr(id){
    document.getElementById("carta_responsiva").style.display = "none";
    document.getElementById("pagare").style.display = "none";
    document.getElementById("contrato_arrendamiento").style.display = "none";
    document.getElementById(id).style.display = "block";
  }
</script>


<div id="carta_responsiva">
  <div class="carta_fecha">
      Hermosillo, Sonora a <?= substr($row["fecha_renta"],8,2)?> de <?= $mes_rent?> del 
      <?= substr($row["fecha_renta"],0,4)?>
  </div>
  <div class="carta_corresponda">A QUIEN CORRESPONDA.-<br>PRESENTE.-</div>
  <div class="contrato_titulo">CARTA RESPONSIVA</div>
  <div class="carta_txt">
    Por medio del presente escrito, vengo a otorgar la presente CARTA RESPONSIVA A FAVOR DE LA EMPRESA REMOLMAX 
    RENTAS Y SERVICIOS S.A. DE C.V., correspondiente al uso y goce del remolque con numero de 
    serie <strong><?= $row5["serie"]?></strong> y numero de placa <strong><?= $row5["placas"]?></strong>, 
    que me fue dado en arrendamiento 
    en esta fecha por la empresa REMOLMAX RENTAS Y SERVICIOS S.A. DE C.V., mismo remolque que manifiesto bajo 
    protesta de decir verdad, que se encuentra en optimas condiciones de uso y seguridad. Por otra parte, me hago 
    sabedor que el remolque dado en arrendamiento no cuenta con seguro de daños de ningún tipo, ni seguro contra 
    robo, por lo que acepto estas condiciones de arrendamiento para cualquier causa legal.
<p>
Así mismo, desde este momento me hago único y totalmente responsable del uso y cuidado que le daré al remolque 
mencionado en el tiempo pactado de la renta y la entrega del mismo, y por lo tanto eximo de cualquier 
responsabilidad de tipo administrativa local o federal, penal, penal federal, civil, daño a terceros, de transito 
o de cualquier tipo, a la empresa REMOLMAX RENTAS Y SERVICIOS S.A. DE C.V., la cual resulta ser propietaria del 
remolque antes descrito.
<p>
Por ultimo, también me hago único y totalmente responsable, en caso de cualquier tipo de deterioro, robo o 
extravío, embargo o cualquier otro tipo de percance que pudiera sufrir el remolque que se me entrega en renta 
por la empresa REMOLMAX RENTAS Y SERVICIOS S.A. DE C.V. Lo cual para estos supuestos, me obligo a pagar el total 
del valor del remolque motivo del presente arrendamiento.
<p>
El termino de mi responsabilidad sobre el particular, será fenecido hasta al momento de entregar la unidad rentada 
en las oficinas de la empresa REMOLMAX RENTAS Y SERVICIOS S.A. DE C.V., ubicadas en Calle Lopez del Castillo y 
Tlaxcala , Numero 4 de la Colonia Olivares de la ciudad de Hermosillo, Sonora, y para tal efecto como única 
constancia de liberación se me entregara por esta empresa constancia de recibido debidamente firmada.
  </div>
</div>







<div id="pagare" style="display:none;">
      <div class="contrato_titulo">PAGARE</div>
      <div class="pagare_txt">
            <div class="pagare_subtit">
                No. 1/1 BUENO POR $
                <input type="text" id="contrato_valor" name="contrato_valor" value="<?= $row["precio_total"]?>" 
                class="sinimprimir2 contrato_rellenar ancho1">
                <span id="contrato_valor2" class="paraimprimir2 contrato_rellenar2"><?= $row["precio_total"]?></span>
                M.N.
            </div>
<p>
En Hermosillo, Sonora A <?= substr($row["fecha_renta"],8,2)?> de <?= $mes_rent?> del <?= substr($row["fecha_renta"],0,4)?>
<p>
Debo y pagare en forma incondicional por este pagare a la orden de REMOLMAX RENTAS Y SERVICIOS S.A. DE C.V. la cantidad 
de $
<input type="text" id="contrato_valor" name="contrato_valor" value="<?= $row["precio_total"]?>" class="sinimprimir2 contrato_rellenar ancho1">
<span id="contrato_valor0" class="paraimprimir2 contrato_rellenar2"><?= $row["precio_total"]?></span>
M.N. (SON
<input type="text" id="contrato_valor" name="contrato_valor" value="<?= $row["precio_total"]?>" class="sinimprimir2 contrato_rellenar ancho1">
<span id="contrato_valorB" class="paraimprimir2 contrato_rellenar2"><?= $row["precio_total"]?></span>
00/100 M.N.) valor entregado a mi entera satisfacción, 
cantidad que será pagada en esta Ciudad de Hermosillo, Sonora. El día <?= substr($row["fecha_renta"],8,2)?> del mes de 
<?= $mes_rent?> del <?= substr($row["fecha_renta"],0,4)?>.
<p>
Si este pagare no fuese cubierto en su vencimiento, serán exigidos un interés a razón de 5 % mensual por conceptos de 
interés moratorios sobre el documento vencido.
<p>
EL SUSCRIPTOR OBLIGADO PRINCIPAL 
<input type="text" id="contrato_valor" name="contrato_valor" value="<?= $row9h["contacto"]?>" class="sinimprimir2 contrato_rellenar ancho1">
<span id="contrato_valor2" class="paraimprimir2 contrato_rellenar2"><?= $row9h["contacto"]?></span>
SE OBLIGA A PAGAR LOS GASTOS QUE IMPLIQUE EL 
COBRO DE ESTE PAGARE Y LOS HONORARIOS DE ABOGADOS QUE INTERVENGAN EN EL COBRO DEL MISMO, EN CASO DE INCURRIR EN MORA O EN 
INCUMPLIMIENTO DE PAGO POR ESTE PAGARE.
      </div>
      <div class="pagare_obl">
        <div class="pagare_obl_titl">Nombre y datos del obligado:</div>
        <div>
            <div class="pagare_obl_datta">
                <strong>Nombre: </strong> <?= $row9h["contacto"]?> <br>
                <strong>Direccion: </strong><?= $row9h["domicilio"]?>  <br>
                <strong>Colonia:</strong> <?= $row9h["colonia"]?>   <br>
                <strong>Ciudad y Estado: Hermosillo, Sonora</strong>
            </div>
            <div class="pagare_obl_otrs">
              <div>Debo y pagare:</div>
              <div class="pagare_obl_firm">Obligado Principal</div>
            </div>
        </div>
      </div>
</div>








<div class="contrato" id="contrato_arrendamiento" style="display:none;">
      <div class="contrato_titulo">CONTRATO DE ARRENDAMIENTO</div>
      <div class="contrato_txt">
          CONTRATO DE ARRENDAMIENTO DE REMOLQUE Y/O EQUIPO QUE CELEBRAN, POR UNA PARTE REMOLMAX RENTAS Y SERVICIOS 
          S.A. DE C.V. , A QUIEN EN LO SUCESIVO SE DESIGNARÁ COMO "LA ARRENDADORA", CUYOS DATOS GENERALES APARECEN 
          EN LA PARTE SUPERIOR DE ESTE CONTRATO, Y POR LA OTRA, LA PERSONA A QUIEN EN ADELANTE SE DESIGNARÁ COMO 
          "EL ARRENDATARIO", CUYO NOMBRE Y DATOS GENERALES APARECE EN EL RECUADRO A.
          <p>
          <strong>DECLARACIONES:</strong>
          <p>
          La Arrendadora declara está dispuesta en dar en arrendamiento el remolque y/o equipo de referencia, en 
          las condiciones que en las cláusulas de este contrato se especifican.
          <p>
          El Arrendatario declara que conoce el remolque y/o equipo mencionados en el recuadro B de este contrato, 
          el cual ha sido examinado por el, encontrándolo en condiciones aparentes de ser utilizado de acuerdo con 
          su naturaleza y por tanto tiene interés en tomarlo en arrendamiento según las condiciones detalladas en 
          el recuadro C.
      </div>
      <div class="contrato_campo">
          <div class="contrato_campo_txt">A</div>
          <input type="text" name="contrato_txt_A" id="contrato_txt_A" 
          value="<?= $row9h["contacto"]?>" class="contrato_campo_inpt sinimprimir"/>
          <div id="contrato_txt_A2" class="paraimprimir"><?= $row9h["contacto"]?></div>
      </div>
      <div class="contrato_campo">
          <div class="contrato_campo_txt">B</div>
          <input type="text" name="contrato_txt_B" id="contrato_txt_B" 
           onkeypress="agrega_print('contrato_txt_B')" onkeyup="agrega_print('contrato_txt_B')"
          value="<?php 
            echo 'Modelo: ('.$row5["modelo"].') Placas: ('.$row5["placas"].') Serie: ('.$row5["serie"].') Capacidad: ('.$row5["capacidad"].')'; 
          ?>" class="contrato_campo_inpt sinimprimir"/>
          <div id="contrato_txt_B2" class="paraimprimir"><?php 
            echo 'Modelo: ('.$row5["modelo"].') Placas: ('.$row5["placas"].') Serie: ('.$row5["serie"].') Capacidad: ('.$row5["capacidad"].')'; 
          ?></div>
      </div>
      <div class="contrato_campo">
          <div class="contrato_campo_txt">C</div>
          <input type="text" name="contrato_txt_C" onkeypress="agrega_print('contrato_txt_C')" onkeyup="agrega_print('contrato_txt_C')"
          id="contrato_txt_C" value="<?= $row["contrato_txt_C"]?>" class="contrato_campo_inpt sinimprimir"/>
          <div id="contrato_txt_C2" class="paraimprimir"></div>
      </div>
      <div class="contrato_txt">
        <strong>CONDICIONES GENERALES</strong>

            <ul class="contrato_li">
              <li>El período mínimo de renta es de 24 horas. No fracciones. Por lo que una vez transcurridas 24 horas, si el remolque no ha sido devuelto, empezará a correr un nuevo día completo. (Sin excepción).
              </li>

              <li>El remolque es responsabilidad del cliente. Este deberá entregarlo en las mismas condiciones en las que se lo llevó, de lo contrario habrá que hacer el ajuste de partes dañadas o extraviadas (Se trata de responsabilidad, independientemente de culpabilidad).
              </li>

              <li>Cuando un remolque llega con retraso ( Punto 1 ) o con algún daño ( Punto 2 ), el pago deberá hacerse al momento de la entrega de este sin excepción alguna. ( No se puede cerrar el contrato si no ha quedado cubierto el adeudo ).
              </li>
            </ul>
      </div>
</div>

</div>

</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script>
  function agrega_print(id){
    var id1 = id + '2';
    var contenido_c = document.getElementById(id).value;
    document.getElementById(id1).innerHTML = contenido_c;
  }
</script>
</html>

<?php

		mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
	?>