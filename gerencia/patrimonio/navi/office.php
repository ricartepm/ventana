<div id="header">
    
    <h3>Office</h3>
    
     <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=office" >
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
    
    <table width="100%" border="0" cellspacing="2">
   <tr align="center" bgcolor="#CC0001" class="marg">

         <td><strong>Office:</strong></td>
       <td><strong>Chave office:</strong></td>
       <td><strong>Computador:</strong></td>
       <td><strong>Status:</strong></td>
       <td><strong>Editar:</strong></td>
     </tr>
 <?php 
if(isset ($_POST['busca']))  {
   $bus  = ($_POST['busca']);
   
  
   
   $qrcha  = "SELECT * FROM office WHERE office LIKE '%$bus%' or chave_office LIKE '%$bus%' or status_office LIKE '$bus'  ORDER BY chave_office ASC";
   $stcha  = mysql_query($qrcha)or die (mysql_errno()); 
   
    while ($ascha  = mysql_fetch_assoc($stcha)){
 	
   $id_com = $ascha['id_computador'];
   $qrcom  = "SELECT * FROM computadores WHERE id = '$id_com' ";
   $stcom  = mysql_query($qrcom)or die (mysql_errno()); 
   $ascom  = mysql_fetch_assoc($stcom);
   $i++; 
   if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5;"';
		 }else{
			$cor = 'style="background:#FFF;"' ;
		 }
		
 ?>

    <tr align="center" <?PHP echo $cor;?>>
    <td><a href="#" onclick="MM_openBrWindow('office.php?id=<?php echo $ascha['id_office'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $ascha['office'];?></a></td>
    <td><a href="#" onclick="MM_openBrWindow('office.php?id=<?php echo $ascha['id_office'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $ascha['chave_office'];?></a></td>
    <td><a href="#" onclick="MM_openBrWindow('compu.php?id=<?php echo $ascom['id'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $ascom['Nome_compu'];?></a></td>
    <td><?php echo $ascha['status_office'];?></td>
    <td><a href="index.php?pagina=editaroffice&id=<?php echo $ascha['id_office'] ; ?>">Editar</a></td>
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
