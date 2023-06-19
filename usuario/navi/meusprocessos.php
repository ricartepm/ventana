<div id="header">

    <?php include_once ("sistema/carregando.php"); ?> 
<h3> Processos Solicitados:</h3>
<table width="100%" border="0" cellspacing="2">

    <tr align="center" bgcolor="#CC0001" class="marg">
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
  $stabertos = mysqli_query($conectar,$qrabertos)or die (mysqli_errno());
  if (mysqli_num_rows($stabertos) <= 0){
      echo '<tr class="res"><td colspan="8">Não Existem Solicitações no Momento!</td></tr>';
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
                 $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5"';
		 }else{
			$cor = 'style="background:#FFF"' ;
		 }
              ?>    
          <tr align="center" <?PHP echo $cor;?>>
          <td align="center" ><?php echo $usuario ; ?></td>
          <td align="center"><?php echo $asaberto['Nr_Processo'] ; ?></td>
          <td align="center" ><?php echo $asaberto['caixa']?></td>
          <td align="center" ><?php echo $asaberto['Prateleira']; ?></td>
          <td align="center" ><?php echo date('d/m/Y H:i',  strtotime($asaberto['data']));?></td>
          <td align="center" ><a href="index.php?pagina=resposta&ms=<?php echo $asaberto['id_solicitacao']; ?>"><?php echo $link; ?></a></td>
          <td align="center" ><?php echo $status ; ?></td>
          <td><form action="" method="post" name="enviar" >
          <table align="center">
           <tr valign="baseline">
      
         <input type="submit" value="Excluir" class="btn"/></td>
         </tr>
         </table>
           <input type="hidden" name="id_Processo" value="<?php echo $asaberto['id_Processo'];?>"/>
         <input type="hidden" name="id_usuario" value="<?php echo $asaberto['id_usuario'];?>"/>
         <input type="hidden" name="id_solicitacao" value="<?php echo $asaberto['id_solicitacao'];?>";/>
         <input type="hidden" name="enviar3" value="" />
         </form>
          </tr>
       
              <?php  
      }//AND WHILE
  }//END IF ABERTOS
      
  ?>  
</table>
</div>

