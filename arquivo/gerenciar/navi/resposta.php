<div id="header">
   <h3> Mensagens:</h3>    
     
<?php if(isset($_GET['ms'])){ ?>
<?php if (isset ($_POST['add_resposta'])){
	$soli    =  mysql_real_escape_string($_POST['id_solicitacao']);  
	$sopros  =  mysql_real_escape_string($_POST['processo']);
	$user    =  mysql_real_escape_string($_POST['id_usuario']);  
	$userer  =  mysql_real_escape_string($_POST['usuario']);
	$msg     =  mysql_real_escape_string($_POST['ms_mensagem']);  
	$qrresp  = "INSERT INTO mensagem (id_solicitacao, id_usuario, ms_mensagem, Data) VALUES ('$soli', '$user', '$msg', NOW())";
	$stresp  = mysql_query($qrresp)or die (mysql_errno());
	echo '<h3> Eviamos sua resposta!</h3>';
	
	$qrUpdateRead = "UPDATE solicitacao SET ms_read_resp = '0' WHERE nivel = '$nivel' AND id_solicitacao = '$soli'";
	$stUpdateRead  = mysql_query($qrUpdateRead)or die (mysql_errno());
	$response = 'ok';

	$qrus = "SELECT * FROM user WHERE user_id = '$userer'";
    $stus = mysql_query($qrus)or die (mysql_errno());
    $asus = mysql_fetch_assoc($stus);

	require_once('../mail_config.php');
	sendMail('Arquivo respondeu','Arquivo respondeu sopre seu pedido do processo.'.$sopros.'.',$asus['user_email'],$asus['user_nome']);
	
	} ?>
 

<?php
   $msGet = mysql_real_escape_string($_GET['ms']);  
   $qrms  = " SELECT * FROM solicitacao WHERE nivel = '$nivel' AND id_solicitacao = '$msGet'";
   $stms  = mysql_query($qrms)or die (mysql_errno());
       if(mysql_num_rows($stms) <= 0){ 
	   echo 'Desculpa, no momento não tem mensagem';
	   }else{
	 $asms = mysql_fetch_assoc($stms);
	 if (empty($response) && $asms['ms_read'] == 0){  
	 $qrUpdateRead = "UPDATE solicitacao SET ms_read = '1' WHERE nivel = '$nivel' AND id_solicitacao = '$msGet'";
	 $stUpdateRead  = mysql_query($qrUpdateRead)or die (mysql_errno());
		 }
	   }
     ?>
 
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
  $stremetente = mysql_query($qrremetente)or die (mysql_errno());
  $asremetente = mysql_fetch_assoc($stremetente);
     echo $asremetente['user_nome'];
 ?></td>
     <td align="center" ><?php echo date('d/m/Y H:i',  strtotime($asms['data']))?></td>
     <td align="center" ><?php echo $asms['Nr_Processo']?></td>
    <td align="center" ><?php echo $asms['assunto']?></td>
     <td align="center" ><?php echo $asms['ms']?></td>
   </tr>
</table>

 


<?php
   $qrRs  = " SELECT * FROM mensagem WHERE id_solicitacao = '$msGet'";
   $stRs  = mysql_query($qrRs)or die (mysql_errno());
    if(mysql_num_rows($stRs) <= 0){ 
	  
	   }else{
	   while ($resst = mysql_fetch_assoc($stRs)){
?>
<table width="100%" border="0" cellspacing="2">
   <tr align="center" bgcolor="#DADADA">
     <td><strong>Usuário:</strong></td>
     <td><strong>Em:</strong></td>
     <td><strong>Resposta:</strong></td>
   </tr>
 <tr>
     <td align="center" ><?php
  $qrresp = "SELECT * FROM user WHERE user_id = '$resst[id_usuario]'";
  $stresp = mysql_query($qrresp)or die (mysql_errno());
  $asresp = mysql_fetch_assoc($stresp);
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
</form>

</a></th>
<?php 
 } 
    

?>    

</div>