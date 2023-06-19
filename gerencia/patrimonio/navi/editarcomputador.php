<div id="header">
    <h3>Editar Computador </h3>
    
 
 
<?php 
if(isset($_POST['editar'])){
    
$idPost   = strip_tags(trim($_POST['ID']));
$idUser   = strip_tags(trim($_POST['id_usuario']));
$Nome_pc  = strip_tags(trim($_POST['Nome_compu']));
$Modelo   = strip_tags(trim($_POST['modelo']));
$Tipo     = strip_tags(trim($_POST['tipo']));
$Proce    = strip_tags(trim($_POST['Processador']));
$Memor    = strip_tags(trim($_POST['Memoria_ram']));
$Hard     = strip_tags(trim($_POST['Hard_disk']));
$Serie    = strip_tags(trim($_POST['nr_serie']));
$Nota     = strip_tags(trim($_POST['nf']));
$Plaque   = strip_tags(trim($_POST['plaqueta_patrimonio']));
$Eth      = strip_tags(trim($_POST['ip_eth']));
$Wile     = strip_tags(trim($_POST['ip_wireless']));
$Mac_eth  = strip_tags(trim($_POST['mac_eth']));
$Mac_wir  = strip_tags(trim($_POST['mac_wireless']));
$Sta_com  = strip_tags(trim($_POST['status_compu']));

$sql_editar = 'UPDATE computadores SET id = :idPost, id_usuario = :idUser, Nome_compu = :Nome_pc, modelo = :Modelo, tipo = :Tipo, Processador = :Proce,'
        . ' Memoria_ram = :Memor, Hard_disk = :Hard, nr_serie = :Serie,   nf = :Nota, plaqueta_patrimonio = :Plaque, ip_eth = :Eth, '
        . 'ip_wireless = :wile, mac_eth = :Mac_eth, mac_wireless = :Mac_wir, status_compu = :Sta_com WHERE id = :idPost';
   

try {
    $query_editar = $conect->prepare($sql_editar);
    $query_editar->bindValue(':idPost',$idPost,PDO::PARAM_STR);
    $query_editar->bindValue(':idUser',$idUser,PDO::PARAM_STR);
    $query_editar->bindValue(':Nome_pc',$Nome_pc,PDO::PARAM_STR);
    $query_editar->bindValue(':Modelo',$Modelo,PDO::PARAM_STR);
    $query_editar->bindValue(':Tipo',$Tipo,PDO::PARAM_STR); 
    $query_editar->bindValue(':Proce',$Proce,PDO::PARAM_STR);
    $query_editar->bindValue(':Memor',$Memor,PDO::PARAM_STR);
    $query_editar->bindValue(':Hard',$Hard,PDO::PARAM_STR);
    $query_editar->bindValue(':Serie',$Serie,PDO::PARAM_STR);
    $query_editar->bindValue(':Nota',$Nota,PDO::PARAM_STR);
    $query_editar->bindValue(':Plaque',$Plaque,PDO::PARAM_STR);
    $query_editar->bindValue(':Eth',$Eth,PDO::PARAM_STR); 
    $query_editar->bindValue(':wile',$Wile,PDO::PARAM_STR);
    $query_editar->bindValue(':Mac_eth',$Mac_eth,PDO::PARAM_STR);
    $query_editar->bindValue(':Mac_wir',$Mac_wir,PDO::PARAM_STR);
    $query_editar->bindValue(':Sta_com',$Sta_com,PDO::PARAM_STR);
    $query_editar->execute();
    echo '<h3>Editado com sucesso.</h3>';
  
    
} catch (PDOException $erro_update) {
    echo 'Error ao editar'.$erro_update->getMessage();
}


}

if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

   $qrcom  = "SELECT * FROM computadores WHERE id = '$bus' ";
   $stcom  = mysql_query($qrcom)or die (mysql_errno()); 
   
   while ($ascom  = mysql_fetch_assoc($stcom)){
 	
       
  $idus = $ascom['id_usuario'];
  $qrus  = "SELECT * FROM usuarios WHERE id_user = '$idus' ";
  $stus  = mysql_query($qrus)or die (mysql_errno()); 
  $asus  = mysql_fetch_assoc($stus); 
   
$query_RsUsuario = "SELECT * FROM usuarios WHERE status_usuario = 'ativo' ORDER BY nome ASC";
$RsUsuario = mysql_query($query_RsUsuario) or die(mysql_error());
$row_RsUsuario = mysql_fetch_assoc($RsUsuario);
$totalRows_RsUsuario = mysql_num_rows($RsUsuario);


?>
    
  
    <form action="" method="post" name="editar" id="editar" enctype="multipart/form-data" >
  <table  align="center" class="solicitar">
    <tr>
      <td><p></p></td>
    </tr>
    <tr>
      <td><strong>Usuário:</strong></td>
      <td>
   <label for="id_usuario"></label>
        <select name="id_usuario" id="id_usuario">
           <option value="<?php echo $asus['id_user'];?>"><?php echo $asus['nome'];?> <?php echo $asus['sobrenome'];?></option>
          <?php
do {  
?>
          <option value="<?php echo $row_RsUsuario['id_user']?>"><?php echo $row_RsUsuario['nome']?> <?php echo $row_RsUsuario['sobrenome']?></option>
          <?php
} while ($row_RsUsuario = mysql_fetch_assoc($RsUsuario));
  $rows = mysql_num_rows($RsUsuario);
  if($rows > 0) {
      mysql_data_seek($RsUsuario, 0);
	  $row_RsUsuario = mysql_fetch_assoc($RsUsuario);
  }
?>
      </select> </td>
    </tr>
    <tr>
      <td><strong>Nome Computador:</strong></td>
      <td><input type="text" name="Nome_compu" value="<?php echo $ascom['Nome_compu']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Modelo:</strong></td>
      <td><input type="text" name="modelo" value="<?php echo $ascom['modelo']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Tipo:</strong></td>
      <td><label>
                  <select name="tipo" id="tipo">
     		     <option value="<?php echo $ascom['tipo']; ?>"><?php echo $ascom['tipo']; ?></option>
                     <option value="Servidor" id="Servidor">Servidor</option>
                     <option value="Desktop" id="Desktop">Desktop</option>
                     <option value="Laptop" id="Laptop">Laptop</option>     
          </select>
      </label></td>
    </tr>
    <tr>
      <td><strong>Processador:</strong></td>
      <td><input type="text" name="Processador" value="<?php echo $ascom['Processador']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Memoria:</strong></td>
      <td>      <label>
                  <select name="Memoria_ram" id="Memoria_ram">
     		     <option value="<?php echo $ascom['Memoria_ram']; ?>"><?php echo $ascom['Memoria_ram']; ?></option>
                     <option value="1Gb" id="1Gb">1GB</option>
                     <option value="2Gb" id="2Gb">2GB</option>
                     <option value="3GB" id="3B">3GB</option>
                     <option value="4GB" id="4GB">4GB</option> 
                     <option value="5Gb" id="5Gb">5GB</option>
                     <option value="6GB" id="6GB">6GB</option>
                     <option value="8GB" id="8GB">8GB</option>                         
                     <option value="16GB" id="16GB">16GB</option>
                     <option value="32GB" id="32GB">32GB</option> 
          </select>
      </label>
      </td>
    </tr>
    <tr>
      <td><strong>HD:</strong></td>
      <td>
             <label>
                  <select name="Hard_disk" id="Hard_disk">
     		     <option value="<?php echo $ascom['Hard_disk']; ?>"><?php echo $ascom['Hard_disk']; ?></option>
                     <option value="250Gb" id="80Gb">80GB</option>
                     <option value="250Gb" id="160Gb">160GB</option>
                     <option value="250Gb" id="250Gb">250GB</option>
                     <option value="350GB" id="350GB">350GB</option>
                     <option value="500GB" id="500GB">500GB</option> 
                     <option value="750GB" id="750GB">750GB</option> 
                     <option value="1TB" id="1TB">1TB</option> 
                     <option value="2TB" id="1TB">2TB</option> 
          </select>
      </label></td>
    </tr>
    <tr>
      <td><strong>Nr Serie:</strong></td>
      <td><input type="text" name="nr_serie" value="<?php echo $ascom['nr_serie']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Nota fiscal:</strong></td>
      <td><input type="text" name="nf" value="<?php echo $ascom['nf']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Plaqueta Patrimonio:</strong></td>
      <td><input type="text" name="plaqueta_patrimonio" value="<?php echo $ascom['plaqueta_patrimonio']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>IP eth0:</strong></td>
      <td><input type="text" name="ip_eth" value="<?php echo $ascom['ip_eth']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>IP Wireless:</strong></td>
      <td><input type="text" name="ip_wireless" value="<?php echo $ascom['ip_wireless']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Mac eth0:</strong></td>
      <td><input type="text" name="mac_eth" value="<?php echo $ascom['mac_eth']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Mac Wireless:</strong></td>
      <td><input type="text" name="mac_wireless" value="<?php echo $ascom['mac_wireless']; ?>" size="32" class="input" /></td>
    </tr>
      <tr>
      <td><strong>Status:</strong></td>
      <td><label>
        <select name="status_compu" id="status_compu">
	 <option value="<?php echo $ascom['status_compu']; ?>"><?php echo $ascom['status_compu']; ?></option>
         <option value="Ativo" id="novidades">Ativo</option>
         <option value="Inativo" id="cursos">Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit"  name="editar"  id="editar" value="Editar" class="btn" /></td>
    </tr>
  </table>
        <input type="hidden" name="ID" value="<?php echo $ascom['id']; ?>" />
</form>
<?php
    }

   }
   ?>
    
<p>&nbsp;</p>
</body>
</html>
    
    
    
    
    
</div><!--Fecha heade