<div id="header">
    
    <h3>Editar Nextel </h3>
    
    
   <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=nextel" >
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
    
 <?php 
     
 if(isset($_POST['editar'])){

$id_nex   = $_POST['id_nex'];     
$iduse    = strip_tags(trim($_POST['id_usuario']));
$DD       = strip_tags(trim($_POST['DD']));
$Numero   = strip_tags(trim($_POST['numero']));
$ID       = strip_tags(trim($_POST['ID']));
$Modelo   = strip_tags(trim($_POST['modelo']));
$Plano    = strip_tags(trim($_POST['plano']));   
$data     = strip_tags(trim($_POST[date('d-m-Y')]));
$stnextel = strip_tags(trim($_POST['status']));

 
$sql_editar   = 'UPDATE nextel SET id_nex = :id_nex, id_user = :id_user, DD = :DD, numero = :numero, ID = :ID, Modelo = :Modelo,'
              . 'plano = :plano, data_ativacao = :data_ativacao, status = :status WHERE id_nex = :id_nex';
    
try {
    $query_editar = $conect->prepare($sql_editar);
    $query_editar->bindValue(':id_nex',$id_nex,PDO::PARAM_STR);
    $query_editar->bindValue(':id_user',$iduse,PDO::PARAM_STR);
    $query_editar->bindValue(':DD',$DD,PDO::PARAM_STR);
    $query_editar->bindValue(':numero',$Numero,PDO::PARAM_STR);
    $query_editar->bindValue(':ID',$ID,PDO::PARAM_STR);
    $query_editar->bindValue(':Modelo',$Modelo,PDO::PARAM_STR);
    $query_editar->bindValue(':plano',$Plano,PDO::PARAM_STR);
    $query_editar->bindValue(':data_ativacao',$data,PDO::PARAM_STR);
    $query_editar->bindValue(':status',$stnextel,PDO::PARAM_STR);
    $query_editar->execute();
    echo '<h3>Editado com Sucesso!</h3>';
    
} catch (PDOException $erro_editar) {
    echo 'Erro ao editar'.$erro_editar->getMessage();
    
}

}

if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

   $qrnext  = "SELECT * FROM nextel WHERE id_nex = '$bus' ";
   $stnext  = mysql_query($qrnext)or die (mysql_errno()); 
   
   while ($asnext  = mysql_fetch_assoc($stnext)){
 	
       
  $idus  = $asnext['id_user'];
  $qrus  = "SELECT * FROM usuarios WHERE id_user = '$idus' ";
  $stus  = mysql_query($qrus)or die (mysql_errno()); 
  $asus  = mysql_fetch_assoc($stus); 
   
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
            <option value="<?php echo $asus['id_user']; ?>"><?php echo $asus['nome']; ?> <?php echo $asus['sobrenome']; ?></option>
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
      <td><input type="text" name="DD" value="<?php echo $asnext['DD']; ?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Numero:</strong></td>
      <td><input type="text" name="numero" value="<?php echo $asnext['numero']; ?>" size="32" class="input" /></td>
    </tr>
     <tr>
      <td><strong>ID:</strong></td>
      <td><input type="text" name="ID" value="<?php echo $asnext['ID']; ?>" size="32" class="input" /></td>
    </tr>
     <tr>
      <td><strong>Modelo:</strong></td>
      <td><input type="text" name="modelo" value="<?php echo $asnext['Modelo']; ?>" size="32" class="input" /></td>
    </tr>
    
    <tr>
      <td><strong>Plano:</strong></td>
      <td><label>
                  <select name="plano" id="plano">
     		     <option value="<?php echo $asnext['plano']; ?>"><?php echo $asnext['plano']; ?></option>
                     <option value="MAISR - Plano Mais Especial" >MAISR - Plano Mais Especial</option>
                     <option value="CDT59 Controle Direto 59" >CDT59 Controle Direto 59</option>
                     <option value="DRT59 Especial Direto 59" >DRT59 Especial Direto 59</option>
                    </select>
      </label></td>
    </tr>
   
     <tr>
      <td><strong>Data Ativação:</strong></td>
      <td><input type="text" name="modelo" value="<?php echo date ('d/m/Y' ,strtotime ($asnext['data_ativacao'])); ?>" size="32" class="input" /></td>
    </tr>
    
    
      <tr>
      <td><strong>Status:</strong></td>
      <td><label>
        <select name="status" id="status">
	 <option value="<?php echo $asnext['status']; ?>"><?php echo $asnext['status']; ?></option>
         <option value="Ativo" >Ativo</option>
         <option value="Inativo" >Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    <input type="hidden" name="id_nex" value="<?php echo $asnext['id_nex']; ?>" />
      <td><input type="submit" name="editar" id="editar" value="Editar" class="btn" /></td>
    </tr>
  </table>
  
</form>

    <?php
   }
}
 ?>   
 
    
</div><!--Fecha heade