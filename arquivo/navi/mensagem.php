<div id="header">

   <h3> Mensagens:</h3>    
     
<?php if(isset($_GET['ms'])){ ?>
<?php if (isset ($_POST['add_resposta'])){
	$soli    =  mysqli_real_escape_string($_POST['id_solicitacao']);  
	$sopros  =  mysqli_real_escape_string($_POST['processo']);
	$user    =  mysqli_real_escape_string($_POST['id_usuario']);  
	$userer  =  mysqli_real_escape_string($_POST['usuario']);
	$msg     =  mysqli_real_escape_string($_POST['ms_mensagem']);  
	$qrresp  = "INSERT INTO mensagem (id_solicitacao, id_usuario, ms_mensagem, Data) VALUES ('$soli', '$user', '$msg', NOW())";
	$stresp  = mysqli_query($conectar, $qrresp)or die (mysqli_errno());
	echo '<h3> Eviamos sua resposta!</h3>';
	
	$qrUpdateRead = "UPDATE solicitacao SET ms_read_resp = '0' WHERE nivel = '$nivel' AND id_solicitacao = '$soli'";
	$stUpdateRead  = mysqli_query($conectar, $qrUpdateRead)or die (mysqli_errno());
	$response = 'ok';

	$qrus = "SELECT * FROM user WHERE user_id = '$userer'";
    $stus = mysqli_query($conectar, $qrus)or die (mysqli_errno());
    $asus = mysqli_fetch_assoc($stus);

	require_once('../mail_config.php');
	sendMail('Arquivo respondeu','Arquivo respondeu sopre seu pedido do processo.'.$sopros.'.',$asus['user_email'],$asus['user_nome']);
	
	} ?>
 

<?php
   $msGet = mysqli_real_escape_string($conectar, $_GET['ms']);  
   $qrms  = " SELECT * FROM solicitacao WHERE nivel = '$nivel' AND id_solicitacao = '$msGet'";
   $stms  = mysqli_query($conectar, $qrms)or die (mysqli_errno());
       if(mysqli_num_rows($stms) <= 0){ 
	   echo 'Desculpa, no momento não tem mensagem';
	   }else{
	 $asms = mysqli_fetch_assoc($stms);
	 if (empty($response) && $asms['ms_read'] == 0){  
	 $qrUpdateRead = "UPDATE solicitacao SET ms_read = '1' WHERE nivel = '$nivel' AND id_solicitacao = '$msGet'";
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
 
<?php 
 } 
    

?>    

</div>