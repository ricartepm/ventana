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
                <td><h3>Celular</h3></td>
                <td><img src="../../images/ventanaserrafiemg.jpg" class="img_right"></img></td>
            </tr>
        </table>
        
        
     <table width="100%" border="0" cellspacing="2">
        
 <?php 
if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

   $qrcelu  = "SELECT * FROM celulares WHERE id = '$bus'";
   $stcelu  = mysql_query($qrcelu)or die (mysql_errno()); 
   
    while ($ascelu  = mysql_fetch_assoc($stcelu)){
       
 	
  $idus = $ascelu['id_usuario'];
  $qrus  = "SELECT * FROM usuarios WHERE id_user = '$idus' ";
  $stus  = mysql_query($qrus)or die (mysql_errno()); 
  $asus  = mysql_fetch_assoc($stus); 
  
  
  ?>    
    <tr>
      <td><strong>Celular:</strong></td>  
    <td>(<?php echo $ascelu['ddd'];?>) <?php echo $ascelu['numero'];?></td>
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
    <td><?php echo $ascelu['modelo'];?></td>
         </tr>
         
                <tr>
        <td><strong>IMEI:</strong></td>       
    <td><?php echo $ascelu['IMEI'];?></td>
         </tr>
         
         <tr>
    <td><strong>PIN:</strong></td>
    <td><?php echo $ascelu['PIN'];?></td>
         </tr>
         
         <tr>
    <td><strong>Plano:</strong></td>
    <td><?php echo $ascelu['plano'];?></td>
         </tr>
         
         <tr>
     <td><strong>Status:</strong></td>
    <td><?php echo $ascelu['status'];?> </td>
         </tr>
    
             
     </table>
  <?php
 }
}
 ?>
       
        
    </div><!--Fecha div Compuator
    

</body>
