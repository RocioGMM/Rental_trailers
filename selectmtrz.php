<?php include ("panel/conn1.php");?>
<select name="matrizselect" id="matrizselect"  class="hospitalx matemp" style="display:block;">
                <option value="" disabled="disabled" selected>Seleccione</option>
                <?php   
                  $sqlmtz = "SELECT * FROM sucursales WHERE empresa='".$_REQUEST["id"]."' AND matriz='s' ORDER BY nombre ASC";
                  $resultmtz = mysql_query($sqlmtz, $conn1);
                  while($rowmtz = mysql_fetch_array($resultmtz)){ 
                ?>    
                <option value="<?php echo $rowmtz["id"]?>"<?php 
                            if($row["estado"] == $rowmtz["id"]){echo ' selected';};
                            ?>><?php echo $rowmtz["nombre"];?></option>
                <?php };///?>
            </select>