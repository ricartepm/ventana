<div id="header">
     <?php include_once ("../../sistema/carregando.php"); ?>
    <h3>Editar Usuários do Arquivo</h3>
    
 
 
 <table width="100%" border="0" cellspacing="2"  height="40px" >
    
     <tr align="center" bgcolor="#CC0001" class="marg" >
         
      <td><form id="form1" name="form1" method="post" action="index.php?pagina=usuario">
      <strong>Usúario:</strong>
      <input type="text" name="busca" id="busca"  size="30" class="input2" />
      <input type="submit" name="executar" id="executar" value="Enter" class="btn" />
    </form></td>
     </tr>
 </table>
     
     <table width="100%" border="0" cellspacing="2">
       
  <tr align="center" bgcolor="#CC0001" class="marg">
      <td><strong>Usuario:</strong></td>
      <td><strong>Login:</strong></td>
      <td><strong>E-mail:</strong></td>
      <td><strong>Level:</strong></td>
      <td><strong>Editar:</strong></td>
      <td><strong>Alterar Senha:</strong></td>
  </tr>

      <?php
  
  
$bus = $_POST['busca'];
 

 $sql_pegaAtivos = 'SELECT * FROM user WHERE user_nome LIKE :bus or user_login LIKE :bus ORDER BY user_nome ASC ';

 try{
	 $query_inboxAdmin = $conect->prepare($sql_pegaAtivos);
	 $query_inboxAdmin->bindValue(':bus','%'.$bus.'%',PDO::PARAM_STR);
	 $query_inboxAdmin->execute();
	 
	 $resutado_inboxAdmin = $query_inboxAdmin->fetchALL(PDO::FETCH_ASSOC);
	 
     }catch(PDOException $erro_inboxAdmin) {
		echo 'Erro ao selecionar processo'; 
      }
 
  foreach($resutado_inboxAdmin as $res_inboxAdmin){
		 $users_id          = $res_inboxAdmin['user_id'];
		 $users_nome        = $res_inboxAdmin['user_nome'];
		 $users_login       = $res_inboxAdmin['user_login'];
		 $users_email      = $res_inboxAdmin['user_email'];
		 $users_nivel       = $res_inboxAdmin['nivel'];
		 $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5;"';
		 }else{
			$cor = 'style="background:#FFF;"' ;
		 }
	 
		
 ?>





  
    <tr align="center" <?PHP echo $cor;?>>
      <td><?php echo $users_nome; ?></td>
      <td><?php echo $users_login; ?></td>
      <td><?php echo $users_email; ?></td>
      <td><?php echo $users_nivel; ?></td>
      <td><a href="index.php?pagina=usuarios&ID=<?php echo $users_id; ?>">Editar</a></td>
      <td><a href="index.php?pagina=alterarsenha&ID=<?php echo $users_id; ?>">Alterar</a></td>
    </tr>
   

 <?php
  
    }
  ?>

    
    
    
    
    
</div><!--Fecha header -->