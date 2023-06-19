<div id="header">


<h3> Processos Devolvidos:</h3>
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
  </tr>
  <?php
  $qrabertos = "SELECT * FROM solicitacao WHERE nivel = '$nivel' AND status = '2' ORDER BY data DESC";
  $stabertos = mysql_query($qrabertos)or die (mysql_errno());
  if (mysql_num_rows($stabertos) <= 0){
      echo '<tr><td colspan="8">Não Existem Solicitações Entregue!</td></tr>';
  }else{
      while ($asaberto = mysql_fetch_assoc($stabertos)){
          
          if ($asaberto['status'] == '2'){
              $status = 'Devolvido';
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
          <tr align="center"<?PHP echo $cor;?>>        
          <td align="center"><?php echo $asuser['user_nome'];?></td>
          <td align="center"><?php echo $asaberto['Nr_Processo'];?></td>
          <td align="center"><?php echo $asaberto['caixa']; ?></td>
          <td align="center"><?php echo $asaberto['Prateleira'];?></td>
          <td align="center"><?php echo date('d/m/Y H:i',  strtotime($asaberto['data']));?></td>
          <td align="center"><a href="index.php?pagina=resposta&ms=<?php echo $asaberto['id_solicitacao']; ?>"><?php echo $link ;?></a></td>
          <td align="center"><?php echo $status ;?></td>
          </tr>
         
          <?php
          
      }//AND WHILE
  }//END IF ABERTOS
      
   ?>  
</table>


</body>
  
</html>

</div>