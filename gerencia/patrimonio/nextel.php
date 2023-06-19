<?php include '../../config/connect.php';?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
        <?php include "../js/scripts.php";?>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="images/logosite.jpg">
            <link href="style.css" rel="stylesheet" type="text/css" />

        <title></title>
    </head>

    
    <div id="computador">
        <table class="top">
            <tr>
                <td><img src="../../images/arcese2.jpg"></img> <td   
                <td><h3>Nextel</h3></td>
                <td><img src="../../images/ventanaserrafiemg.jpg" class="img_right"></img></td>
            </tr>
        </table>
        
        
     <table width="100%" border="0" cellspacing="2">
        
 <?php 
if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

   $qrnex  = "SELECT * FROM nextel WHERE id_nex = '$bus'";
   $stnex = mysql_query($qrnex)or die (mysql_errno()); 
   
    while ($asnex  = mysql_fetch_assoc($stnex)){
       
 	
  $idus = $asnex['id_user'];
  $qrus  = "SELECT * FROM usuarios WHERE id_user = '$idus' ";
  $stus  = mysql_query($qrus)or die (mysql_errno()); 
  $asus  = mysql_fetch_assoc($stus); 
  
  
  ?>    
    <tr>
      <td><strong>Celular Nextel:</strong></td>  
    <td>(<?php echo $asnex['DD'];?>) <?php echo $asnex['numero'];?></td>
    </tr>
      
         <tr>
      <td><strong>Nextel ID:</strong></td>  
    <td><?php echo $asnex['ID'];?></td>
    </tr>
         
     <tr> 
      <td><strong>Usuario:</strong></td>
    <td><?php echo $asus['nome'];?> <?php echo $asus['sobrenome'];?></td>
    </tr>
       
          <tr> 
      <td><strong>Local:</strong></td>
    <td><?php echo $asus['local'];?> </td>
    </tr>
         
         <tr>
        <td><strong>Modelo:</strong></td>       
    <td><?php echo $asnex['Modelo'];?></td>
         </tr>
         
         <tr>
    <td><strong>Plano:</strong></td>
    <td><?php echo $asnex['plano'];?></td>
         </tr>
         
         <tr>
     <td><strong>Status:</strong></td>
    <td><?php echo $asnex['status'];?> </td>
         </tr>
    
         <tr>
    <td><strong>Data Ativação:</strong></td>
    <td><?php echo date('d/m/Y ',  strtotime($asnex['data_ativacao']));?></td>
         </tr>
    
       
     </table>
  <?php
 }
}
 ?>
       
        
    </div><!--Fecha div Compuator
    

</body>
