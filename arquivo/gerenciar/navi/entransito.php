<div id="header">


<h3> Processos em Tránsito:</h3>
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
    <td><strong>Fechar</strong></td>
  </tr>
  <?php if (isset ($_POST['enviar2'])){
	$soli =  mysql_real_escape_string($_POST['id_solicitacao']); 
	$sousu =  mysql_real_escape_string($_POST['id_usuario']); 
	$soupro =  mysql_real_escape_string($_POST['Processo']); 
	$qrUpdateRead = "UPDATE solicitacao SET status = '2' WHERE nivel = '$nivel' AND id_solicitacao = '$soli'";
	$stUpdateRead  = mysql_query($qrUpdateRead)or die (mysql_errno());
	
	$sopro =  mysql_real_escape_string($_POST['id_Processo']); 
        $qrUpdateStu = "UPDATE processo SET status = '0' WHERE ID = '$sopro'";
	$stUpdateStu  = mysql_query($qrUpdateStu)or die (mysql_errno());
	
	$soUse =  mysql_real_escape_string($_POST['id_usuario']); 
        $qrUpdateUse = "UPDATE caixa SET Solicitante = '' WHERE id_processo = '$sopro'";
	$stUpdateUse  = mysql_query($qrUpdateUse)or die (mysql_errno());

    $qruse = "SELECT * FROM user WHERE user_id = '$sousu'";
    $stuse = mysql_query($qruse)or die (mysql_errno());
    $asuse = mysql_fetch_assoc($stuse);

  	require_once('../mail_config.php');
	sendMail('Solicitação finalizada','Seu processo '.$soupro.' foi arquivado',$asuse['user_email'],$asuse['user_nome']);
	
	}
   ?>
  
  <?php
  $qrabertos = "SELECT * FROM solicitacao WHERE nivel = '$nivel' AND status = '1' ORDER BY data DESC";
  $stabertos = mysql_query($qrabertos)or die (mysql_errno());
  if (mysql_num_rows($stabertos) <= 0){
      echo '<tr><td colspan="8">Não Existem Solicitações no Momento!</td></tr>';
  }else{
      while ($asaberto = mysql_fetch_assoc($stabertos)){
          
          if ($asaberto['status'] == '1'){
               $status = 'Em Tránsito!';
          }
          if($asaberto['ms_read'] == '0' ){
              $link = '<strong>'.$asaberto['assunto'].'</strong>';              
          }else if($asaberto['ms_read'] == '1' ){
              $link = $asaberto['assunto'];
          }
              
         $qruser = "SELECT * FROM user WHERE user_id = '$asaberto[id_usuario]'";
         $stuser = mysql_query($qruser)or die (mysql_errno());
         $asuser = mysql_fetch_assoc($stuser);   
 
                 $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5;"';
		 }else{
			$cor = 'style="background:#FFF;"' ;
		 }
              ?>    
          <tr align="center" <?PHP echo $cor;?>>
         <td align="center" ><?php echo $asuser['user_nome']; ?></td>
          <td align="center"><?php echo $asaberto['Nr_Processo'] ; ?></td>
          <td align="center" ><?php echo $asaberto['caixa']?></td>
          <td align="center" ><?php echo $asaberto['Prateleira']; ?></td>
          <td align="center" ><?php echo date('d/m/Y H:i',  strtotime($asaberto['data']));?></td>
          <td align="center" ><a href="index.php?pagina=resposta&ms=<?php echo $asaberto['id_solicitacao']; ?>"><?php echo $link; ?></a></td>
          <td align="center" ><?php echo $status ; ?></td>
          <td align="center"><form action="" method="post" name="enviar" >
          <table align="center">
          <tr valign="baseline">
          </tr>
          <tr valign="baseline">
      
       <input type="submit" value="Entregue" onclick="this.disabled=true" class="btn"/></td>
    </tr>
  </table>
  <input type="hidden" name="id_solicitacao" value="<?php echo $asaberto['id_solicitacao'];?>"/>
  <input type="hidden" name="processo" value="<?php echo $asaberto['Nr_Processo']; ?>"/>
  <input type="hidden" name="usuario" value="<?php echo $asaberto['id_usuario']; ?>"/>
  <input type="hidden" name="enviar2" value="" />
</form> 
          </tr>

      
          <?php
      }//AND WHILE
  }//END IF ABERTOS
      
  ?>  
</table
><br />

</div>

