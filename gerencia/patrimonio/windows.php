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

    
    <div id="windows">
        <table class="top">
            <tr>
                <td><img src="../../images/arcese2.jpg"></img> <td   
                <td><h3>Windows</h3></td>
                <td><img src="../../images/ventanaserrafiemg.jpg" class="img_right"></img></td>
            </tr>
        </table>
        
        
     <table width="100%" border="0" cellspacing="2">
        
 <?php 
if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);
   
  $qrwin  = "SELECT * FROM windows WHERE id_windows = '$bus' ";
  $stwin  = mysqli_query($qrwin)or die (mysqli_errno()); 
  
   while ($aswin  = mysqli_fetch_assoc($stwin)){
  
  $idcom  = $aswin['id_computador'];
  $qrcom  = "SELECT * FROM computadores WHERE id = '$idcom'";
  $stcom  = mysqli_query($qrcom)or die (mysqli_errno()); 
  $ascom  = mysqli_fetch_assoc($stcom); 
  
  
  ?>    
    <tr>
      <td><strong>Computador:</strong></td>  
    <td><?php echo $ascom['Nome_compu'];?></td>
    </tr>
         
         <tr> 
      <td><strong>Windows:</strong></td>
    <td><?php echo $aswin['S_O'];?></td>
    </tr>
         
         <tr>
    <td><strong>Chave do Windows:</strong></td>
    <td><?php echo $aswin['chave_windows'];?></td>
         </tr>
         
         <tr>
        <td><strong>Tipo:</strong></td>       
    <td><?php echo $aswin['tipo_S_O'];?></td>
         </tr>
       
            <tr>
    <td><strong>Nota Fiscal:</strong></td>
    <td><?php echo $aswin['nr_nota_fiscal'];?></td>
         </tr>
         
         <tr>
    <td><strong>Data Instalação:</strong></td>
    <td><?php echo date('d/m/Y',  strtotime( $aswin['data_windows']));?></td>
         </tr>
    
         <tr>
     <td><strong>Status:</strong></td>
    <td><?php echo $aswin['status_windows'];?></td>
  </tr>
        
  <?php
 }
}
 ?>
       
        
    </div><!--Fecha div Compuator
    

</body>
