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
                <td><h3>Usuário</h3></td>
                <td><img src="../../images/ventanaserrafiemg.jpg" class="img_right"></img></td>
            </tr>
        </table>

 <?php 
if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

   
  $qrus  = "SELECT * FROM usuarios WHERE id_user = '$bus' ";
  $stus  = mysql_query($qrus)or die (mysql_errno()); 
  $asus  = mysql_fetch_assoc($stus);
      ?>    
        <table width="100%" border="0" cellspacing="2">
        <tr>
      <td><strong>Nome:</strong></td>  
    <td><?php echo $asus['nome'];?> <?php echo $asus['sobrenome'];?></td>
    </tr>
         
         <tr> 
      <td><strong>E-mail:</strong></td>
    <td><?php echo $asus['email'];?></td>
    </tr>
         
         <tr>
        <td><strong>Setor:</strong></td>       
    <td><?php echo $asus['setor'];?></td>
         </tr>
         
         <tr>
    <td><strong>Local:</strong></td>
    <td><?php echo $asus['local'];?></td>
         </tr>
         
         <tr>
     <td><strong>Status:</strong></td>
    <td><?php echo $asus['status_usuario'];?></td>
  </tr>
     </table>
  
    <?php
 }

 ?>     
        
  <?php    
        
   $idcom  = $asus['id_user'];
   $qrcom  = "SELECT * FROM computadores WHERE id_usuario = '$idcom'";
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
        
    ?>      
    <table width="100%" border="0" cellspacing="2">
      
    <tr>
      <td><strong>Computador:</strong></td>  
    <td><?php echo $ascom['Nome_compu'];?></td>
    </tr>
        
         <tr>
    <td><strong>Tipo:</strong></td>
    <td><?php echo $ascom['tipo'];?></td>
         </tr>
         
        <tr>
      <td><strong>Windows:</strong></td>  
    <td><?php echo $aswin['S_O'];?></td>
    </tr>
         
         <tr>
    <td><strong>Office:</strong></td>
    <td><?php echo $asoffi['office'];?></td>
         </tr> 
          
         <tr>
    <td><strong>PLaqueta Patrimônio:</strong></td>
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
    
      </table>
        <?php
   }
   
   ?>     
        
        <?php 
   
 
    $idce = $asus['id_user'];
    $qrce  = "SELECT * FROM celulares WHERE id_usuario = '$idce' ";
    $stce  = mysql_query($qrce)or die (mysql_errno()); 
    while ($asce  = mysql_fetch_assoc($stce)){  
    
        ?>
        
        <table width="100%" border="0" cellspacing="2">
        
    <tr>
      <td><strong>Celular:</strong></td>  
    <td><?php echo $asce['numero'];?></td>
    </tr>
         
         <tr>
    <td><strong>DD:</strong></td>
    <td><?php echo $asce['ddd'];?></td>
         </tr>
         
         <tr>
    <td><strong>Planp:</strong></td>
    <td><?php echo $asce['plano'];?> </td>
         </tr>
    
      </table>
      <?php
    }
    ?>
        
  <?php
   $idnex  = $ascom['id_user'];
   $qrnex  = "SELECT * FROM nextel WHERE id_user = '$idce' ";
   $stnex = mysql_query($qrnex)or die (mysql_errno()); 
   while ($asnex = mysql_fetch_assoc($stnex)){ 
  
  ?>
        
       <table width="100%" border="0" cellspacing="2">
        
    <tr>
      <td><strong>Nextel:</strong></td>  
    <td><?php echo $asnex['ID'];?></td>
    </tr>
         
         <tr>
    <td><strong>ID:</strong></td>
    <td>(<?php echo $asnex['DD'];?>) <?php echo $asnex['numero'];?></td>
         </tr>
         
         <tr>
    <td><strong>Plano:</strong></td>
    <td><?php echo $asnex['plano'];?> </td>
         </tr>
    
      </table>
        
        
        
      <?php
  
  
   }
  

 ?>
       
        
    </div><!--Fecha div Compuator
    

</body>
