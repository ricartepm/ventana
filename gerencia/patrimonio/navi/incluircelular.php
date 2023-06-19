<div id="header">
    
    <h3>Incluir Celular </h3>
    
    
   <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=celulares" >
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
    
 <?php 
     
 if(isset($_POST['cadastrar'])){
 
$iduse    = strip_tags(trim($_POST['id_usuario']));
$DD       = strip_tags(trim($_POST['DD']));
$Numero   = strip_tags(trim($_POST['numero']));
$Modelo   = strip_tags(trim($_POST['modelo']));
$IMEI     = strip_tags(trim($_POST['IMEI']));
$PIN      = strip_tags(trim($_POST['PIN']));
$Plano    = strip_tags(trim($_POST['plano']));
$stcelu   = strip_tags(trim($_POST['status_celular']));
 
$sql_inclui   = ' INSERT INTO celulares (id_usuario,ddd,numero,modelo,IMEI,PIN,plano,status)';
$sql_inclui  .= ' VALUES (:id_usuario,:ddd,:numero,:modelo,:IMEI,:PIN,:plano,:status)' ;
    
try {
    
    $query_inclui = $conect->prepare($sql_inclui);
    $query_inclui->bindValue(':id_usuario',$iduse,PDO::PARAM_STR);
    $query_inclui->bindValue(':ddd',$DD,PDO::PARAM_STR);
    $query_inclui->bindValue(':numero',$Numero,PDO::PARAM_STR);
    $query_inclui->bindValue(':modelo',$Modelo,PDO::PARAM_STR);
    $query_inclui->bindValue(':IMEI',$IMEI,PDO::PARAM_STR);
    $query_inclui->bindValue(':PIN',$PIN,PDO::PARAM_STR);
    $query_inclui->bindValue(':plano',$Plano,PDO::PARAM_STR);
    $query_inclui->bindValue(':status',$stcelu,PDO::PARAM_STR);
    $query_inclui->execute();
    echo '<h3>Cadastro com Sucesso!</h3>';
    
} catch (PDOException $erro_insert) {
    echo 'Erro ao cadastrar'.$erro_insert->getMessage();
    
}



}

   
$query_RsUsuario = "SELECT * FROM usuarios WHERE status_usuario = 'ativo' ORDER BY nome ASC";
$RsUsuario = mysql_query($query_RsUsuario) or die(mysql_error());
$row_RsUsuario = mysql_fetch_assoc($RsUsuario);
$totalRows_RsUsuario = mysql_num_rows($RsUsuario);
 
 ?>
 
<form action="" method="post" name="cadastrar" id="cadastrar"  enctype="multipart/form-data" >
  <table  align="center" class="solicitar1">
    <tr>
      <td><p></p></td>
    </tr>
    <tr>
      <td><strong>Usuário:</strong></td>
      <td>
   <label for="id_usuario"></label>
        <select name="id_usuario" id="id_usuario">
           <option value="">Selecione o Usuário</option>
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
      <td><input type="text" name="DD" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Numero:</strong></td>
      <td><input type="text" name="numero" value="" size="32" class="input" /></td>
    </tr>
     <tr>
      <td><strong>Modelo:</strong></td>
      <td><input type="text" name="modelo" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>IMEI:</strong></td>
      <td><input type="text" name="IMEI" value="" size="32" class="input" /></td>
    </tr>
     <tr>
      <td><strong>PIN:</strong></td>
      <td><input type="text" name="PIN" value="" size="32" class="input" /></td>
    </tr>
    
    <tr>
      <td><strong>Plano:</strong></td>
      <td><label>
                  <select name="plano" id="plano">
     		     <option value="">Selecione a Plano</option>
                     <option value="Plano Liberty Empresa +800" >Plano Liberty Empresa +800</option>
                     <option value="Plano Liberty Empresa +400" >Plano Liberty Empresa +400</option>
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
	 <option value="">Selecione o Status</option>
         <option value="Ativo" >Ativo</option>
         <option value="Inativo" >Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>

      <td><input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="btn" /></td>
    </tr>
  </table>
  
</form>

    
 
    
</div><!--Fecha heade