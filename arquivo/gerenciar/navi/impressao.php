<div id="header">
    
    <h3>Impressão da Etiqueta</h3>


   <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=impressao" >
      <strong>Pesquisa Por Caixa:</strong>
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
  
     <table width="100%" border="0" cellspacing="2">
    
  <tr align="center" bgcolor="#CC0001" class="marg">
      <td><strong>Caixa:</strong></td>
      <td><strong>Imprimir:</strong></td>
  </tr>
  <?php
 
 $bus = $_POST['busca'];
 

 $sql_pegaAtivos = 'SELECT * FROM gerador_caixa WHERE id_caixa LIKE :bus  ORDER BY id_caixa DESC LIMIT 2000 ';

 try{
	 $query_inboxAdmin = $conect->prepare($sql_pegaAtivos);
	 $query_inboxAdmin->bindValue(':bus','%'.$bus.'%',PDO::PARAM_STR);
	 $query_inboxAdmin->execute();
	 
	 $resutado_inboxAdmin = $query_inboxAdmin->fetchALL(PDO::FETCH_ASSOC);
	 
     }catch(PDOException $erro_inboxAdmin) {
		echo 'Erro ao selecionar processo'; 
      }
 
  foreach($resutado_inboxAdmin as $res_inboxAdmin){
		 $proce_id_caixa     = $res_inboxAdmin['id_caixa'];
		 $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5;"';
		 }else{
			$cor = 'style="background:#FFF;"' ;
		 }
	 
		
 ?>
    
     

     <tr align="center" <?PHP echo $cor;?>>
      <td><?php echo $proce_id_caixa; ?></td>
      <td><a href="#" onclick="MM_openBrWindow('imprimir.php?caixa=<?php echo $proce_id_caixa ; ?>','','menubar=yes,width=450,height=700')">Imprimir</a></td>
    </tr>
    
    <?php
  }
?>
    
    </form></td>
  </tr>

</table>
    
    
    
    
    
</div><!-- Fecha Header -->