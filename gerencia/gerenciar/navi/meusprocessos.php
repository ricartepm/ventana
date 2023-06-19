
<div id="header">


<h3> Solicitações de Processos Abertos:</h3>
<table width="100%" border="0" cellspacing="2">
    <?php include_once ("sistema/carregando.php"); ?> 
   <tr align="center" bgcolor="#DADADA">
    <td><strong>Solicitante</strong></td>
    <td><strong>Processo</strong></td>
    <td><strong>Caixa</strong></td>
    <td><strong>Prateleira</strong></td>
    <td><strong>Data</strong></td>
    <td><strong>Assunto</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>Enviar</strong></td>
  </tr>
  <?php if (isset ($_POST['enviar1'])){
	$soli =  mysqli_real_escape_string($conectar, $_POST['id_solicitacao']); 
	$solpro =  mysqli_real_escape_string($conectar, $_POST['processo']); 
	$souser =  mysqli_real_escape_string($conectar, $_POST['usuario']); 
	$qrUpdateRead = "UPDATE solicitacao SET status = '1' WHERE nivel = '$nivel' AND id_solicitacao = '$soli'";
	$stUpdateRead  = mysqli_query($conectar, $qrUpdateRead)or die (mysqli_errno());

    
    $qrus = "SELECT * FROM user WHERE user_id = '$souser'";
    $stus = mysqli_query($conectar, $qrus)or die (mysqli_errno());
    $asus = mysqli_fetch_assoc($stus);

  	require_once('../mail_config.php');
	sendMail('Sua solicitação foi enviada','Seu processo '.$solpro.' foi enviado.',$asus['user_email'],$asus['user_nome']);
	
	} ?>

 <?php
  $qrabertos = "SELECT * FROM solicitacao WHERE nivel = '$nivel' AND status = '0' ORDER BY data DESC";
  $stabertos = mysqli_query($conectar, $qrabertos)or die (mysqli_errno());
  if (mysqli_num_rows($stabertos) <= 0){
      echo '<tr><td colspan="8">Não Existem Solicitações no Momento!</></tr>'; 
  }else{
      while ($asaberto = mysqli_fetch_assoc($stabertos)){
          
          if ($asaberto['status'] == 0){
              $status = 'Aguardando...';
          } 
          if($asaberto['ms_read'] == '0' ){
              $link = '<strong>'.$asaberto['assunto'].'</strong>';              
          }else if($asaberto['ms_read'] == '1' ){
              $link = $asaberto['assunto'];
          }            
		  		  
  $qruser = "SELECT * FROM user WHERE user_id = '$asaberto[id_usuario]'";
  $stuser = mysqli_query($conectar, $qruser)or die (mysqli_errno());
  $asuser = mysqli_fetch_assoc($stuser);
   $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5;"';
		 }else{
			$cor = 'style="background:#FFF;"' ;
		 }
              ?>    
          <tr align="center" <?PHP echo $cor;?>>
          <td align="center" ><?php echo $asuser['user_nome'] ; ?></td>
          <td align="center"><?php echo $asaberto['Nr_Processo'] ; ?></td>
          <td align="center" ><?php echo $asaberto['caixa']?></td>
          <td align="center" ><?php echo $asaberto['Prateleira']; ?></td>
          <td align="center" ><?php echo date('d/m/Y H:i',  strtotime($asaberto['data']));?></td>
          <td align="center" ><a href="index.php?pagina=resposta&ms=<?php echo $asaberto['id_solicitacao']; ?>"><?php echo $link; ?></a></td>
          <td align="center" ><?php echo $status ; ?></td>
          <td align="center" ><form action="" method="post" name="enviar" >
          <table align="center">
          <tr valign="baseline">
          </tr>
          <tr valign="baseline">
      
       <input type="submit" value="Enviar" onclick="this.disabled=true" class="btn"/></td>
    </tr>
  </table>
  <input type="hidden" name="id_solicitacao" value="<?php echo $asaberto['id_solicitacao'];?>"/>
  <input type="hidden" name="processo" value="<?php echo $asaberto['Nr_Processo']; ?>"/>
  <input type="hidden" name="usuario" value="<?php echo $asaberto['id_usuario']; ?>"/>
  <input type="hidden" name="enviar1" value="" />
</form> 
          </tr>
      <?php   
      }//AND WHILE
  }//END IF ABERTOS
      
  ?>  
</table>

</div>