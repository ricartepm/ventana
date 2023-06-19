<div id="header">
    
    <h3>Usuários </h3>
    
 
 

   <table width="100%" border="0" cellspacing="2">
  <tr align="center" bgcolor="#CC0001" class="marg">
      <td><strong>Usuario:</strong></th>
      <td><strong>Celular:</strong></th>    
      <td><strong>Nextel:</strong></th>
      <td><strong>Computador:</strong></th>
      <td><strong>Local:</strong></th>
      <td><strong>Tipo:</strong></th>      
      <td><strong>Status:</strong></th>

  </tr>
  <?php 
  if(isset ($_POST['busca']))  {
   $bus  = ($_POST['busca']);
   
   $qruse  = "SELECT * FROM usuarios WHERE nome LIKE '%$bus%' or email LIKE '%$bus%' or local LIKE '%$bus%' or setor LIKE '%$bus%' or status_usuario LIKE '$bus' ORDER BY nome ASC";
   $stuse  = mysql_query($qruse)or die (mysql_errno()); 
   
    while ($asuse  = mysql_fetch_assoc($stuse)){
 	
   $id_com = $asuse['id_user'];
   $qrcom  = "SELECT * FROM computadores WHERE id_usuario = '$id_com' ";
   $stcom  = mysql_query($qrcom)or die (mysql_errno()); 
   $ascom  = mysql_fetch_assoc($stcom);
   
   $idce  = $asuse['id_user'];
   $qrce  = "SELECT * FROM celulares WHERE id_usuario = '$idce' ";
   $stce  = mysql_query($qrce)or die (mysql_errno()); 
   $asce  = mysql_fetch_assoc($stce); 
   
   $idnex  = $asuse['id_user'];
   $qrnex  = "SELECT * FROM nextel WHERE id_user = '$idce' ";
   $stnex = mysql_query($qrnex)or die (mysql_errno()); 
   $asnex = mysql_fetch_assoc($stnex); 
   
   $i++;
   if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5;"';
		 }else{
			$cor = 'style="background:#FFF;"' ;
		 }
	 
		
 ?>

     <tr align="center" <?PHP echo $cor;?>>
      <td><a href="#" onclick="MM_openBrWindow('usuario.php?id=<?php echo $asuse['id_user'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $asuse ['nome'];?> <?php echo $asuse['sobrenome'];?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('celular.php?id=<?php echo $asce['id'] ; ?>','','menubar=yes,width=620,height=700')">(<?php echo $asce['ddd'];?>) <?php echo $asce['numero'];?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('nextel.php?id=<?php echo $asnex['id_nex'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $asnex['ID'];?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('compu.php?id=<?php echo $ascom['id'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $ascom['Nome_compu'];?></a></td>
      <td><?php echo $asuse['local'] ?></td>
      <td><?php echo $ascom['tipo'];?> </td>
      <td><?php echo $asuse['status_usuario'] ?></td>
    </tr>
<?php
	}
  }

?>
<tr>
    <td height="50" colspan="9" align="center" bgcolor="#FFFFFF">&nbsp;
      <table border="0">
        <tr>
          <td></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="60" colspan="9" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>

    
    
    
    
    
</div><!--Fecha header -->