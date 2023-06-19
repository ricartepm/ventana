
<div id="header">
    
    <h3>Impressão da Etiqueta</h3>


   <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=impressao2" >
      <strong>Pesquisa Por Caixa:</strong>
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
  
     <table width="100%" border="0" cellspacing="2">
    
  <tr align="center" bgcolor="#CC0001" class="marg">
      <td><strong>Nr. Processo:</strong></td>
      <td><strong>Prateleira:</strong></td>
      <td><strong>Data de Entrada:</strong></td>
      <td><strong>Caixa:</strong></td>
      <td><strong>Data Execução:</strong></td>
  </tr>
  <?php
   $bus = $_POST['busca'];
 

 $sql_pegaAtivos = 'SELECT * FROM caixa WHERE caixa LIKE :bus  ORDER BY ID DESC LIMIT 2000 ';

 try{
	 $query_inboxAdmin = $conect->prepare($sql_pegaAtivos);
	 $query_inboxAdmin->bindValue(':bus','%'.$bus.'%',PDO::PARAM_STR);
	 $query_inboxAdmin->execute();
	 
	 $resutado_inboxAdmin = $query_inboxAdmin->fetchALL(PDO::FETCH_ASSOC);
	 
     }catch(PDOException $erro_inboxAdmin) {
		echo 'Erro ao selecionar processo'; 
      }
 
  foreach($resutado_inboxAdmin as $res_inboxAdmin){
		 $proce_id_caixa     = $res_inboxAdmin['id'];
		 $proce_id_processo  = $res_inboxAdmin['id_processo'];
		 $proce_caixa        = $res_inboxAdmin['caixa'];
		 $proce_pratelira    = $res_inboxAdmin['prateleira'];
		 $proce_data_entrada = $res_inboxAdmin['data_entrada'];
		 $proce_solicitante  = $res_inboxAdmin['solicitante'];
		 $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5;"';
		 }else{
			$cor = 'style="background:#FFF;"' ;
		 }
	 
		
 ?>

     <tr align="center" <?PHP echo $cor;?>>
      <td ><?php 
	   $qrproce = "SELECT * FROM processo WHERE ID = '$proce_id_processo'";
           $stproce = mysqli_query($conectar, $qrproce)or die (mysqli_errno());
           $asproce = mysqli_fetch_assoc($stproce);
	   echo $asproce['Nr_Processo']; ?></td>
      
      <td><?php echo $proce_pratelira; ?></td>
      <td><?php echo date ('d/m/Y',  strtotime( $proce_data_entrada)); ?></td>
      <td><?php echo $proce_caixa; ?></td>
      <td><?php echo $asproce['Dt_Execucao']; ?></td>
    </tr>
    
    <?php
  }
?>
    
    </form></td>
  </tr>

</table>
    
    
    
    
    
</div><!-- Fecha Header -->