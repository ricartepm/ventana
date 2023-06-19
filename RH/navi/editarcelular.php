<div id="header">
    
    <h3>Editar Celular </h3>
    
    
   <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=celulares" >
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
    
 <?php 
     
 if(isset($_POST['editar'])){
 
$idpost    = strip_tags(trim($_POST['id_celular']));     
$iduse    = strip_tags(trim($_POST['id_usuario']));
$DD       = strip_tags(trim($_POST['DD']));
$Numero   = strip_tags(trim($_POST['numero']));
$Modelo   = strip_tags(trim($_POST['modelo']));
$IMEI     = strip_tags(trim($_POST['IMEI']));
$PIN      = strip_tags(trim($_POST['PIN']));
$Plano    = strip_tags(trim($_POST['plano']));
$stcelu   = strip_tags(trim($_POST['status_celular']));
 
$sql_edita   = ' UPDATE celulares SET id = :id, id_usuario =  :id_usuario, ddd = :ddd, numero = :numero, modelo = :modelo, '
              . 'IMEI = :IMEI, PIN = :PIN, plano = :plano, status = :status WHERE id = :id ';
    
try {
    
    $query_edita = $conect->prepare($sql_edita);
    $query_edita->bindValue(':id',$idpost,PDO::PARAM_STR);
    $query_edita->bindValue(':id_usuario',$iduse,PDO::PARAM_STR);
    $query_edita->bindValue(':ddd',$DD,PDO::PARAM_STR);
    $query_edita->bindValue(':numero',$Numero,PDO::PARAM_STR);
    $query_edita->bindValue(':modelo',$Modelo,PDO::PARAM_STR);
    $query_edita->bindValue(':IMEI',$IMEI,PDO::PARAM_STR);
    $query_edita->bindValue(':PIN',$PIN,PDO::PARAM_STR);
    $query_edita->bindValue(':plano',$Plano,PDO::PARAM_STR);
    $query_edita->bindValue(':status',$stcelu,PDO::PARAM_STR);
    $query_edita->execute();
    echo '<h3>Editado com Sucesso!</h3>';
    
} catch (PDOException $erro_insert) {
    echo 'Erro ao cadastrar'.$erro_insert->getMessage();
    
}



}

if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

   $qrcelu  = "SELECT * FROM celulares WHERE id = '$bus'";
   $stcelu  = mysql_query($qrcelu)or die (mysql_errno()); 
   
   while ($ascelu  = mysql_fetch_assoc($stcelu)){
   
  $iduse = $ascelu['id_usuario'];
  $qruse  = "SELECT * FROM usuarios WHERE id_user = '$iduse' ";
  $stuse  = mysql_query($qruse)or die (mysql_errno()); 
  $asuse  = mysql_fetch_assoc($stuse); 
   
  $query_RsUsuario = "SELECT * FROM usuarios WHERE status_usuario = 'ativo' ORDER BY nome ASC";
  $RsUsuario = mysql_query($query_RsUsuario) or die(mysql_error());
  $row_RsUsuario = mysql_fetch_assoc($RsUsuario);
  $totalRows_RsUsuario = mysql_num_rows($RsUsuario);
 
 ?>
 
<form action="" method="post" name="editar" id="editar"  enctype="multipart/form-data" >
  <table  align="center" class="solicitar1">
    <tr>
      <td><p></p></td>
    </tr>
    <tr>
      <td><strong>Usuário:</strong></td>
      <td>
   <label for="id_usuario"></label>
        <select name="id_usuario" id="id_usuario">
           <option value="<?php echo $asuse['id_user'];?>"><?php echo $asuse['nome'];?> <?php echo $asuse['sobrenome'];?></option>
          <?php
do {  
?>
     <option value="<?php echo $row_RsUsuario['id_user'];?>"><?php echo $row_RsUsuario['nome'] ;?> <?php echo $row_RsUsuario['sobrenome'];?></option>
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
      <td><strong>DD:</strong></td>
      <td><input type="text" name="DD" value="<?php echo $ascelu['ddd'];?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Numero:</strong></td>
      <td><input type="text" name="numero" value="<?php echo $ascelu['numero'];?>" size="32" class="input" /></td>
    </tr>
     <tr>
      <td><strong>Modelo:</strong></td>
      <td><input type="text" name="modelo" value="<?php echo $ascelu['modelo'];?>" size="32" class="input" /></td>
    </tr>
     <tr>
      <td><strong>IMEI:</strong></td>
      <td><input type="text" name="IMEI" value="<?php echo $ascelu['IMEI'];?>" size="32" class="input" /></td>
    </tr>
     <tr>
      <td><strong>PIN:</strong></td>
      <td><input type="text" name="PIN" value="<?php echo $ascelu['PIN'];?>" size="32" class="input" /></td>
    </tr>
    
    <tr>
      <td><strong>Plano:</strong></td>
      <td><label>
                  <select name="plano" id="plano">
     		     <option value="<?php echo $ascelu['plano'];?>"><?php echo $ascelu['plano'];?></option>
                     <option value="Plano Liberty Empresa +800" >Plano Liberty Empresa +800</option>
                     <option value="Plano Liberty Empresa +400r" >Plano Liberty Empresa +400</option>
                     <option value="Plano TIM Empresa Mundi 400" >Plano TIM Empresa Mundi 400</option>
                     <option value="Plano Liberty Empresa +300" >Plano Liberty Empresa +300</option>  
                     <option value="Plano Liberty Empresa +200" >Plano Liberty Empresa +200</option>
                     <option value="Plano Liberty Empresa +100">Plano Liberty Empresa +100</option>
                     <option value="Plano Liberty Empresa +50" >Plano Liberty Empresa +50</option>
                     <option value="Liberty Web Empresa Modem" >Liberty Web Empresa Modem</option> 
                     
          </select>
      </label></td>
    </tr>
   
      <tr>
      <td><strong>Status:</strong></td>
      <td><label>
        <select name="status_celular" id="status_celular">
	 <option value="<?php echo $ascelu['status'];?>"><?php echo $ascelu['status'];?></option>
         <option value="Ativo" >Ativo</option>
         <option value="Inativo" >Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    <input type="hidden" name="id_celular" value="<?php echo $ascelu['id'];?>" />
      <td><input type="submit" name="editar" id="iditar" value="Editar" class="btn" /></td>
    </tr>
  </table>
  
</form>

    <?php
   }
}
    ?>
 
    
</div><!--Fecha heade