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

    
    <div id="office1">
        <table class="top">
            <tr>
                <td><img src="../../images/arcese2.jpg"></img> <td   
                <td><h3>Office</h3></td>
                <td><img src="../../images/ventanaserrafiemg.jpg" class="img_right"></img></td>
            </tr>
        </table>
        
        
     <table width="100%" border="0" cellspacing="2">
        
 <?php 
if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

  $qroffi = "SELECT * FROM office WHERE id_office = '$bus' ";
  $stoffi = mysql_query($qroffi)or die (mysql_errno()); 
  
   
   while ($asoffi  = mysql_fetch_assoc($stoffi)){
 	
   $idcom = $asoffi['id_computador'];  
   $qrcom  = "SELECT * FROM computadores WHERE id = '$idcom'";
   $stcom  = mysql_query($qrcom)or die (mysql_errno()); 
   $ascom  = mysql_fetch_assoc($stcom); 
    
  ?>    
          <tr>
      <td><strong>Computador:</strong></td>  
    <td><?php echo $ascom['Nome_compu'];?></td>
    </tr>
         
    <tr>
      <td><strong>Office:</strong></td>  
    <td><?php echo $asoffi['office'];?></td>
    </tr>
         
         <tr>
      <td><strong>Chave do Office:</strong></td>  
    <td><?php echo $asoffi['chave_office'];?></td>
    </tr>
         <tr>
        <td><strong>Tipo:</strong></td>       
    <td><?php echo $asoffi['tipo_office'];?></td>
         </tr>
     
         <tr>
    <td><strong>Nota Fiscal:</strong></td>
    <td><?php echo $asoffi['nf'];?></td>
         </tr>
    
         <tr>
    <td><strong>Data Instalação:</strong></td>
    <td><?php echo date('d/m/Y',  strtotime($asoffi['data_instalacao']));?></td>
         </tr>
    
         <tr>
     <td><strong>Status:</strong></td>
    <td><?php echo $asoffi['status_office'];?></td>
  </tr>
        
  <?php
 }
}
 ?>
       
        
    </div><!--Fecha div Compuator
    

</body>
