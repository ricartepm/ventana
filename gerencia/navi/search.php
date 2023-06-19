<div id="header">
    <?php include_once ("../sistema/carregando.php"); ?>  
 
    
     <table width="100%" border="0" cellspacing="2">
       
         <tr align="center" bgcolor="#CC0001" class="marg">
      <td><strong>Nr. Processo:</strong></td>
      <td><strong>Master:</strong></td>
      <td><strong>House:</strong></td>
      <td><strong>Cliente:</strong></td>
      <td><strong>Solicitar Processo</strong></td>
 
     </tr>
      
     <?php
       
      if (isset ($_POST['enviar4']) && ($_POST['enviar4']) == 'enviar'){
	$sopro =  mysqli_real_escape_string($conectar, $_POST['id_Processo']); 
	$soSta =  mysqli_real_escape_string($conectar, $_POST['stat']); 
        $soNr =  mysqli_real_escape_string($conectar, $_POST['nr']); 
   	$cadbusca = mysqli_query($conectar, "SELECT * FROM processo WHERE ID = '$sopro' AND status = '1' " );
     if (mysqli_num_rows($cadbusca) == 0){
         
	 	echo  "<script language='javaScript'>window.location.href='index.php?pagina=solicitacao&ID=$sopro'</script>";
		}else{	

                echo "<h4>Processo já Solicitado $soNr!</h4>";

		}
	}
     
     
 $bus = $_POST['busca'];
 

 $sql_pegaAtivos = 'SELECT * FROM processo WHERE Nr_Processo LIKE :bus or Master LIKE :bus or House LIKE :bus ORDER BY ID DESC LIMIT 1000 ';

 try{
	 $query_inboxAdmin = $conect->prepare($sql_pegaAtivos);
	 $query_inboxAdmin->bindValue(':bus','%'.$bus.'%',PDO::PARAM_STR);
	 $query_inboxAdmin->execute();
	 
	 $resutado_inboxAdmin = $query_inboxAdmin->fetchALL(PDO::FETCH_ASSOC);
	 
     }catch(PDOException $erro_inboxAdmin) {
		echo 'Erro ao selecionar processo'; 
      }
 
  foreach($resutado_inboxAdmin as $res_inboxAdmin){
		 $proce_id          = $res_inboxAdmin['ID'];
		 $proce_Dt_Execucao = $res_inboxAdmin['Dt_Execucao'];
		 $proce_Nr_Processo = $res_inboxAdmin['Nr_Processo'];
		 $proce_Master      = $res_inboxAdmin['Master'];
		 $proce_House       = $res_inboxAdmin['House'];
		 $proce_Cliente     = $res_inboxAdmin['Cliente'];
		 $proce_status      = $res_inboxAdmin['status'];
		 $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5"';
		 }else{
			$cor = 'style="background:#FFF"' ;
		 }
	 
       
        $sopro = mysqli_real_escape_string($conectar, $proce_id); 
   	$cadbusca = mysqli_query($conectar, "SELECT * FROM caixa WHERE id_processo = '$sopro' " );
        if (mysqli_num_rows($cadbusca) >= 1){       
          $solic = '<input type="submit" value="Solicitar" class="btn" />';
          }else{
	   $solic = '<input type="submit" value="Não arq..." class="btndis" disabled="disabled"   />' ;
		 }
                 
        $cadbuscas = mysqli_query($conectar, "SELECT * FROM processo WHERE ID = '$sopro' AND status = '1' " );
         if (mysqli_num_rows($cadbuscas) == 0){

             }else{	
                $solic = '<input type="submit" value="Já solic..." class="btndis" disabled="disabled"   />' ;

		}       
                 
 ?>
    
     

     <tr align="center" <?PHP echo $cor;?>>
      <td><a href="#" onclick="MM_openBrWindow('processo.php?id=<?php echo $proce_id ; ?>','','menubar=yes,width=620,height=700')"><?php echo $proce_Nr_Processo;?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('processo.php?id=<?php echo $proce_id ; ?>','','menubar=yes,width=620,height=700')"><?php echo $proce_Master;?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('processo.php?id=<?php echo $proce_id ; ?>','','menubar=yes,width=620,height=700')"><?php echo $proce_House;?></a></td>
      <td><a href="#" onclick="MM_openBrWindow('processo.php?id=<?php echo $proce_id ; ?>','','menubar=yes,width=620,height=700')"><?php echo $proce_Cliente;?></a></td>
      <td><form action="" method="post" name="enviar4" >
      <table align="center">
      <tr valign="baseline">
      </tr>
      <tr valign="baseline">
      
      <?php echo $solic ?></td>
     </tr>
     </table>
      <input type="hidden" name="nr" value="<?php echo $proce_Nr_Processo; ?>";/>        
      <input type="hidden" name="stat" value="<?php echo $proce_status; ?>";/>
     <input type="hidden" name="id_Processo" value="<?php echo $proce_id;?>";/>
     <input type="hidden" name="enviar4" id="executar" value="enviar" />
     </form></td></td>
   
    </tr>
<?php
        }         
      
?>
     </table>

   </div><!--Fecha reader -->
        
        </div><!--Fecha box-->  
        
