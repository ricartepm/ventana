<?php include '../config/connect.php';?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
        <?php include "../js/scripts.php";?>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../images/logosite.jpg">
            <link href="style.css" rel="stylesheet" type="text/css" />

        <title></title>
    </head>

    
    <div id="computador">
        <table class="top">
            <tr>
                <td><img src="../images/arcese2.jpg"></img> <td   
                <td><h3>Processo</h3></td>
                <td><img src="../images/ventanaserrafiemg.jpg" class="img_right"></img></td>
            </tr>
        </table>
        

        
 <?php 
if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);
   
  $qrproce  = "SELECT * FROM processo WHERE ID = '$bus'";
  $stproce  = mysqli_query($conectar, $qrproce)or die (mysql_errno()); 
  while ($asproce  = mysqli_fetch_assoc($stproce)){
 
  $idcaixa = $asproce['ID'];
  $qrcaixa = "SELECT * FROM caixa WHERE id_processo = '$idcaixa' ";
  $stcaixa = mysqli_query($conectar, $qrcaixa)or die (mysql_errno()); 
  $ascaixa = mysqli_fetch_assoc($stcaixa);
  
  
  ?>    
       
             
        <table width="100%" border="0" cellspacing="2">
  
            <tr>
      <td><strong>Processo:</strong></td>  
    <td><?php echo $asproce['Nr_Processo'];?></td>
    </tr>
         
         <tr> 
      <td><strong>Master:</strong></td>
    <td><?php echo $asproce['Master'];?></td>
    </tr>
         
         <tr>
        <td><strong>House:</strong></td>       
    <td><?php echo $asproce['House'];?></td>
         </tr>
         
         <tr>
    <td><strong>Cliente:</strong></td>
    <td><?php echo $asproce['Cliente'];?></td>
         </tr>
         
         <tr>
     <td><strong>Data do arquivamento:</strong></td>
    <td><?php echo date ('d-m-Y' ,strtotime ( $ascaixa['data_entrada']));?></td>
  </tr>
     
    <tr>
      <td><strong>Solicitante:</strong></td>  
    <td><?php echo $ascaixa['Solicitante'];?></td>
    </tr>
         
         <tr>
    <td><strong>Caixa:</strong></td>
    <td><?php echo $ascaixa['caixa'];?></td>
         </tr>
         
         <tr>
    <td><strong>Prateleira :</strong></td>
    <td><?php echo $ascaixa['prateleira'];?> </td>
         </tr>
       
        
      <?php
  
  
  
  
 }
}
 ?>
       
        
    </div><!--Fecha div Compuator
    

</body>
