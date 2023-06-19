<div id="header">

    <h3> Mensagens:</h3>    
  

  
<?php if(isset($_GET['ms'])){ ?>
<?php if (isset ($_POST['add_resposta'])){
	$soli =  mysqli_real_escape_string($conectar, $_POST['id_solicitacao']);  
	$user = mysqli_real_escape_string($conectar, $_POST['id_usuario']);  
	$msg  = mysqli_real_escape_string($conectar, $_POST['ms_mensagem']);  
	$qrresp  = "INSERT INTO mensagem (id_solicitacao, id_usuario, ms_mensagem, Data) VALUES ('$soli', '$user', '$msg', NOW())";
	$stresp  = mysqli_query($conectar, $qrresp)or die (mysqli_errno());
	echo '<h3>Recebemos sua resposta! </h3>';
	
	$qrUpdateRead = "UPDATE solicitacao SET ms_read = '0' WHERE id_usuario = '$userid' AND id_solicitacao = '$soli'";
	$stUpdateRead  = mysqli_query($conectar, $qrUpdateRead)or die (mysqli_errno());
	$response = 'ok';

	require_once('../mail_config.php');
	sendMail('Recebemos sua dúvida','Sua dúvida foi recebida com sucesso',$email,$usuario);
	sendMail('Nova dúvida','Usuário '.$usuario.' postou uma nova dúvida','arquivo@ventanaserra.com.br','Arquivo Ventana');

	} 
     
 $msGet = mysqli_real_escape_string($conectar, $_GET['ms']);  
   $qrms  = " SELECT * FROM solicitacao WHERE  id_solicitacao = '$msGet'";
   $stms  = mysqli_query($conectar, $qrms)or die (mysqli_errno());
       if(mysqli_num_rows($stms) <= 0){ 
	   echo 'Desculpa, no momento não tem mensagem';
	   }else{
	 $asms = mysqli_fetch_assoc($stms);
	 if (empty($response) && $asms['ms_read'] == 0){  
	 $qrUpdateRead = "UPDATE solicitacao SET ms_read = '1' WHERE  id_solicitacao = '$msGet'";
	 $stUpdateRead  = mysqli_query($conectar, $qrUpdateRead)or die (mysqli_errno());
		 }
	   }
     ?>
     

<table width="100%" border="0" cellspacing="2">

    <tr align="center" bgcolor="#CC0001" class="marg">
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
	  
	   }else{
	   while ($resst = mysqli_fetch_assoc($stRs)){
?>
<table width="100%" border="0" cellspacing="2">
    <tr align="center" bgcolor="#CC0001" class="marg">
     <td><strong>Usuário:</strong></td>
     <td><strong>Em:</strong></td>
     <td><strong>Resposta:</strong></td>
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
<form action="" method="post" name="add_res" id="add_res">
    <table align="center" class="solicitar2">
        <tr >
      <th >&nbsp;</th>
    </tr>
     <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><p><strong>Mensagem:</strong></p></td>
      <td><textarea name="ms_mensagem" id="ms_mensagem" cols="100" rows="10"></textarea></td>
    </tr>
    <tr valign="baseline">
        <td colspan="2" align="center" nowrap="nowrap"><input type="button" value="Voltar" onclick="JavaScript: window.history.back();" class="btn"/>        
            <input type="submit" name="add_res" id="add_res" value="Adicionar Resposta" onclick="this.disabled=true; this.value='enviando...'" class="btn1"/></td>
    </tr>
  </table>
  <input type="hidden" name="id_solicitacao" value="<?php echo $asms['id_solicitacao']; ?>" />
  <input type="hidden" name="id_usuario" value="<?php echo $userid; ?>" />
  <input type="hidden" name="add_resposta" value="" />
  <input type="hidden" name="executar" id="executar" value="" />
</form>

</a></th>
<?php 
 } 
    

?>    

</div>