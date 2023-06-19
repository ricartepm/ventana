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
                <td><h3>Computadores</h3></td>
                <td><img src="../../images/ventanaserrafiemg.jpg" class="img_right"></img></td>
            </tr>
        </table>
        
        
     <table width="100%" border="0" cellspacing="2">
        
 <?php 
if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

   $qrcom  = "SELECT * FROM computadores WHERE id = '$bus'";
   $stcom  = mysql_query($qrcom)or die (mysql_errno()); 
   
   while ($ascom  = mysql_fetch_assoc($stcom)){
 	
  $idoffi = $ascom['id'];
  $qroffi = "SELECT * FROM office WHERE id_computador = '$idoffi' ";
  $stoffi = mysql_query($qroffi)or die (mysql_errno()); 
  $asoffi = mysql_fetch_assoc($stoffi);
   
  $idwin = $ascom['id'];
  $qrwin  = "SELECT * FROM windows WHERE id_computador = '$idwin' ";
  $stwin  = mysql_query($qrwin)or die (mysql_errno()); 
  $aswin  = mysql_fetch_assoc($stwin); 

  $idus = $ascom['id_usuario'];
  $qrus  = "SELECT * FROM usuarios WHERE id_user = '$idus' ";
  $stus  = mysql_query($qrus)or die (mysql_errno()); 
  $asus  = mysql_fetch_assoc($stus); 
  
  ?>    
    <tr>
      <td><strong>Computador:</strong></td>  
    <td><?php echo $ascom['Nome_compu'];?></td>
    </tr>
         
         <tr> 
      <td><strong>Modelo:</strong></td>
    <td><?php echo $ascom['modelo'];?></td>
    </tr>
         
         <tr>
        <td><strong>Tipo:</strong></td>       
    <td><?php echo $ascom['tipo'];?></td>
         </tr>
         
         <tr>
    <td><strong>Processador:</strong></td>
    <td><?php echo $ascom['Processador'];?></td>
         </tr>
         
         <tr>
     <td><strong>Memoria Ram:</strong></td>
    <td><?php echo $ascom['Memoria_ram'];?> </td>
         </tr>
    
         <tr>
    <td><strong>HD:</strong></td>
    <td><?php echo $ascom['Hard_disk'];?></td>
         </tr>
    
         <tr>
    <td><strong>Nr de Serie:</strong></td>
    <td><?php echo $ascom['nr_serie'];?></td>
         </tr>
    
         <tr>
    <td><strong>Nota Fiscal:</strong></td>
    <td><?php echo $ascom['nf'];?></td>
         </tr>
    
         <tr>
    <td><strong>Plaqueta Patrimônio:</strong></td>
    <td><?php echo $ascom['plaqueta_patrimonio'];?></td>
         </tr>
    
         <tr>
    <td><strong>IP Eth0:</strong></td>
    <td><?php echo $ascom['ip_eth'];?></td>
         </tr>
         
         <tr>
    <td><strong>IP Wi-fi :</strong></td>
    <td><?php echo $ascom['ip_wireless'];?> </td>
         </tr>

         <tr>
    <td><strong>Mac Eth0:</strong></td>
    <td><?php echo $ascom['mac_eth'];?></td>
         </tr>
    
         <tr>
    <td><strong>Mac Wi-fi:</strong></td>
    <td><?php echo $ascom['mac_wireless'];?></td>
         </tr>
    
         <tr>
    <td><strong>Data Instalação:</strong></td>
    <td><?php echo date('d/m/Y',  strtotime($ascom['data_instalacao']));?></td>
         </tr>
    
         <tr>
     <td><strong>Status:</strong></td>
    <td><?php echo $ascom['status_compu'];?></td>
  </tr>
     </table>
  <?php
 }
}
 ?>
       
        
    </div><!--Fecha div Compuator
    

</body>
