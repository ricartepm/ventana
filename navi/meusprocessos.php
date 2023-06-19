<div id="header"
<?php if(isset($_GET['ms'])){ ?>
<?php if (isset ($_POST['add_resposta'])){
	$soli =  mysqli_real_escape_string($conectar, $_POST['id_solicitacao']);  
	$user = mysqli_real_escape_string($conectar, $_POST['id_usuario']);  
	$msg  = mysqli_real_escape_string($conectar, $_POST['ms_mensagem']);  
	$qrresp  = "INSERT INTO mensagem (id_solicitacao, id_usuario, ms_mensagem, Data) VALUES ('$soli', '$user', '$msg', NOW())";
	$stresp  = mysqli_query($conectar, $qrresp)or die (mysqli_errno());
	echo 'Recebemos sua resposta';
	
	$qrUpdateRead = "UPDATE solicitacao SET ms_read = '0' WHERE id_usuario = '$userid' AND id_solicitacao = '$soli'";
	$stUpdateRead  = mysqli_query($conectar, $qrUpdateRead)or die (mysqli_errno());
	$response = 'ok';

	require_once('../mail_config.php');
	sendMail('Recebemos sua dúvida','Sua dúvida foi recebida com sucesso',$email,$usuario);
	sendMail('Nova dúvida','Usuário '.$usuario.' postou uma nova dúvida','arquivo@ventanaserra.com.br','Arquivo Ventana');

	} 
     

   $msGet = mysqli_real_escape_string($conectar, $_GET['ms']);  
   $qrms  = " SELECT * FROM solicitacao WHERE id_usuario = '$userid' AND id_solicitacao = '$msGet'";
   $stms  = mysqli_query($conectar, $qrms)or die (mysqli_errno());
       if(mysqli_num_rows($stms) <= 0){ 
	   echo 'Desculpa, no momento não tem mensagem';
	   }else{
	 $asms = mysqli_fetch_assoc($stms);
	 if (empty($response) && $asms['ms_read_resp'] == 0){  
	 $qrUpdateRead = "UPDATE solicitacao SET ms_read_resp = '1' WHERE id_usuario = '$userid' AND id_solicitacao = '$msGet'";
	 $stUpdateRead  = mysqli_query($conectar, $qrUpdateRead)or die (mysqli_errno());
		 }
	   }
     ?>
     
  <h3> Processos Solicitado:</h3>
<table width="100%" border="0" cellspacing="2">
   <tr align="center" bgcolor="#DADADA">
     <td><strong>Usuário:</strong></td>
     <td><strong>Em:</strong></td>
     <td><strong>Processo:</strong></td>
     <td><strong>Assunto:</strong></td>
     <td><strong>Mensagem:</strong></td>
   </tr>
   <tr>
     <td align="center" ><?php
  $qrremetente = "SELECT * FROM user WHERE user_id = '$asms[id_usuario]'";
  $stremetente = mysqli_query($conectar, $qrremetente)or die (mysqli_errno());
  $asremetente = mysqli_fetch_assoc($stremetente);
     echo $asremetente['user_nome'];
 ?></td>
     <td align="center" ><?php echo date('d/m/Y H:i',  strtotime($asms['data']))?></td>
     <td align="center" ><?php echo $asms['Nr_Processo']?></td>
    <td align="center" ><?php echo $asms['assunto']?></td>
     <td align="center" ><?php echo $asms['ms']?></td>
   </tr>
</table>
<br />
 

<?php
   $qrRs  = " SELECT * FROM mensagem WHERE id_solicitacao = '$msGet'";
   $stRs  = mysqli_query($conectar, $qrRs)or die (mysqli_errno());
    if(mysqli_num_rows($stRs) <= 0){ 
	   echo 'Aguardando resposta';
	   }else{
	   while ($resst = mysqli_fetch_assoc($stRs)){
?>		   <table width="1085" border="1" align="center">
   <tr>
     <td width="164" align="center" bgcolor="#DADADA"><strong>Usuário:</strong></td>
     <td width="200" align="center" bgcolor="#DADADA"><strong>Em:</strong></td>
     <td width="672" align="center" bgcolor="#DADADA"><strong>Resposta:</strong></td>
   </tr>
 <tr>
     <td align="center" ><?php
  $qrresp = "SELECT * FROM user WHERE user_id = '$resst[id_usuario]'";
  $stresp = mysqli_query($conectar, $qrresp)or die (mysqli_errno());
  $asresp = mysqli_fetch_assoc($stresp);
     echo $asresp['user_nome'];
 ?></td>
    <td align="center" ><?php echo date('d/m/Y H:i',  strtotime($resst['Data']))?></td>
     <td align="center" ><?php echo $resst['ms_mensagem']?></td>
  </tr>
 </table>

<p>
  <?php		   
		   } // And wile   
		   
  }  // And IF
   
 ?>
  
<form action="" method="post" name="add_res" >
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><p><strong>Mensagem:</strong></p></td>
      <td><textarea name="ms_mensagem" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap"><input type="button" value="Voltar" onclick="JavaScript: window.history.back();" />        <input type="submit" value="Adicionar Resposta" onclick="this.disabled=true; this.value='enviando...'" /></td>
    </tr>
  </table>
  <input type="hidden" name="id_solicitacao" value="<?php echo $asms['id_solicitacao']; ?>" />
  <input type="hidden" name="id_usuario" value="<?php echo $userid; ?>" />
  <input type="hidden" name="add_resposta" value="" />
</form>

</a></th>
<?php 
 }  else {
    

?>    
<h1> </h1>
<table width="100%" border="0" cellspacing="2">
  <tr align="center" bgcolor="#DADADA">
    <td><strong>Solicitante</strong></td>
    <td><strong>Processo</strong></td>
    <td><strong>Caixa</strong></td>
    <td><strong>Prateleira</strong></td>
    <td><strong>Data</strong></td>
    <td><strong>Assunto</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>Excluir</strong></td>
  </tr>
  <?php if (isset ($_POST['enviar3'])){
	$soli =  mysqli_real_escape_string($conectar, $_POST['id_solicitacao']); 
	$qrUpdateRead = "DELETE FROM solicitacao WHERE id_solicitacao = '$soli'";
	$stUpdateRead  = mysqli_query($conectar, $qrUpdateRead)or die (mysqli_errno());
	
	$sopro =  mysqli_real_escape_string($conectar, $_POST['id_Processo']); 
    $qrUpdateStu = "UPDATE processo SET status = '0' WHERE ID = '$sopro'";
	$stUpdateStu  = mysqli_query($conectar, $qrUpdateStu)or die (mysqli_errno());
	
	$soUse =  mysqli_real_escape_string($conectar, $_POST['id_usuario']); 
    $qrUpdateUse = "UPDATE caixa SET Solicitante = '' WHERE id_processo = '$sopro'";
	$stUpdateUse  = mysqli_query($conectar, $qrUpdateUse)or die (mysqli_errno());

	}
 ?>
  
  <?php
  $qrabertos = "SELECT * FROM solicitacao WHERE id_usuario = '$userid' AND status = '0' ORDER BY data DESC";
  $stabertos = mysqli_query($conectar, $qrabertos)or die (mysqli_errno()); 
  if (mysqli_num_rows($stabertos) <= 0){
      echo '<tr><td colspan="8">Não Existem Solicitações no Momento!</td></tr>';
  }else{
      while ($asaberto = mysqli_fetch_assoc($stabertos)){
          
          if ($asaberto['status'] == '0'){
              $status = 'Aguardando...';
          }
          if($asaberto['ms_read_resp'] == '0' ){
              $link = '<strong>'.$asaberto['assunto'].'</strong>';              
          }else if($asaberto['ms_read_resp'] == '1' ){
              $link = $asaberto['assunto'];
          } 
          echo '<tr>';
          echo '<td align="center" >'.$usuario.'</td>';
          echo '<td align="center">'.$asaberto['Nr_Processo'].'</td>';
          echo '<td align="center" >'.$asaberto['caixa'].'</td>';
          echo '<td align="center" >'.$asaberto['Prateleira'].'</td>';
          echo ' <td align="center" > '.date('d/m/Y H:i',  strtotime($asaberto['data'])).'</td>';
          echo '<td align="center" ><a href="usuario.php?ms='.$asaberto['id_solicitacao'].'">'.$link.'</a></td>';
          echo '<td align="center" >'.$status.'</td>';
          echo '<td align="center" ><form action="" method="post" name="enviar" >
  <table align="center">
    <tr valign="baseline">
    </tr>
    <tr valign="baseline">
      
       <input type="submit" value="Excluir" /></td>
    </tr>
  </table>
   <input type="hidden" name="id_Processo" value="'.$asaberto['id_Processo'].'";/>
   <input type="hidden" name="id_usuario" value="'.$asaberto['id_usuario'].'";/>
  <input type="hidden" name="id_solicitacao" value="'.$asaberto['id_solicitacao'].'";/>
  <input type="hidden" name="enviar3" value="" />
</form> ';
          echo '</tr>';
         
      }//AND WHILE
  }//END IF ABERTOS

 }
  ?>  
</table>

</div>