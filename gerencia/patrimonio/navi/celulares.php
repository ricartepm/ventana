<div id="header">
    
    <h3>Celulares</h3>
    
  
   <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=celulares" >
      
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
      <td><strong>Modelo:</strong></td>
      <td><strong>local:</strong></td>
      <td><strong>Status:</strong></td>
       <td><strong>Editar:</strong></td>

  </tr>

  
  <?php
    
   if(isset ($_POST['busca']))  {
   $bus  = ($_POST['busca']);
   
  
   
   $qrcelu  = "SELECT * FROM celulares WHERE ddd LIKE '$bus' or numero LIKE '%$bus%' or modelo LIKE '%$bus%'  or plano LIKE '%$bus%'   or status LIKE '%$bus%'  ORDER BY ddd ASC";
   $stcelu  = mysql_query($qrcelu)or die (mysql_errno()); 
   
    while ($ascelu  = mysql_fetch_assoc($stcelu)){
        
  $idus = $ascelu['id_usuario'];
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
       <td><a href="#" onclick="MM_openBrWindow('celular.php?id=<?php echo $ascelu['id'] ; ?>','','menubar=yes,width=620,height=700')"> <?php echo $ascelu['ddd'];?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('celular.php?id=<?php echo $ascelu['id'] ; ?>','','menubar=yes,width=620,height=700')"> <?php echo $ascelu['numero'];?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('celular.php?id=<?php echo $ascelu['id'] ; ?>','','menubar=yes,width=620,height=700')"> <?php echo $ascelu['modelo'];?></a></td>
      <td><?php echo $asus['local']; ?></td>
      <td><?php echo $ascelu['status']; ?></td>
      <td><a href="index.php?pagina=editarcelular&id=<?php echo $ascelu['id'] ; ?>">Editar</a></td>
      
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