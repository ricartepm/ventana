<div id="header">
    
    <h3>Nextel</h3>
  
   <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=nextel" >
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
    
    <table width="100%" border="0" cellspacing="2">
        
   <tr align="center" bgcolor="#CC0001" class="marg">
      <td><strong>Usuario:</strong></td>
      <td><strong>DD:</strong></td>
      <td><strong>Numero:</strong></td>
       <td><strong>ID:</strong></td>
      <td><strong>Modelo:</strong></td>
      <td><strong>local:</strong></td>
      <td><strong>Status:</strong></td>
  </tr>

  
  <?php
    
   if(isset ($_POST['busca']))  {
   $bus  = ($_POST['busca']);
   
   $qrnext  = "SELECT * FROM nextel WHERE DD LIKE '$bus' or numero LIKE '%$bus%' or ID LIKE '%$bus%'  or Modelo LIKE '%$bus%' or plano LIKE '%$bus%'   or status LIKE '%$bus%'  ORDER BY ID ASC";
   $stnext  = mysql_query($qrnext)or die (mysql_errno()); 
   
    while ($asnext  = mysql_fetch_assoc($stnext)){
        
  $idus = $asnext['id_user'];
  $qrus  = "SELECT * FROM usuarios WHERE id_user = '$idus' ";
  $stus  = mysql_query($qrus)or die (mysql_errno()); 
  $asus  = mysql_fetch_assoc($stus); 
  $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5"';
		 }else{
			$cor = 'style="background:#FFF"' ;
		 }
  

?>
 <tr align="center" <?PHP echo $cor;?>>
      <td><a href="#" onclick="MM_openBrWindow('usuario.php?id=<?php echo $asus['id_user'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $asus['nome'];?> <?php echo $asus['sobrenome'];?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('nextel.php?id=<?php echo $asnext['id_nex'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $asnext['DD'];?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('nextel.php?id=<?php echo $asnext['id_nex'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $asnext['numero'];?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('nextel.php?id=<?php echo $asnext['id_nex'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $asnext['ID'];?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('nextel.php?id=<?php echo $asnext['id_nex'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $asnext['Modelo'];?></a></td>
      <td><?php echo $asus['local']; ?></td>
      <td><?php echo $asnext['status']; ?></td>
    </tr>
   
    <?php
    
    }
    }
   
   ?>
   
     <tr>
    <td height="30" colspan="6" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="48" colspan="6" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
    
</div>