<div id="header">

 <h3>Processos Solicitados</h3>
    
    <table width="100%" border="0" cellspacing="2"  height="40px" >
        <tr align="center" bgcolor="#CC0001" class="marg" >

            <td><form id="form1" name="form1" method="post" action="index.php?pagina=pesquisaprocessos">

                    <input type="text" name="busca" id="busca"  size="30" class="input2" />
                    <input type="submit" name="button" id="button" value="Pesquisar" class="btn" />
                </form></td>
        </tr>
    </table>
    <?php include_once ("../sistema/carregando.php"); ?>  


    <table width="100%" border="0" cellspacing="2">

        <tr align="center" bgcolor="#CC0001" class="marg">
            <td><strong>Solicitante</strong></td>
            <td><strong>Processo</strong></td>
            <td><strong>Caixa</strong></td>
            <td><strong>Prateleira</strong></td>
            <td><strong>Assunto</strong></td>
            <td><strong>Status</strong></td>
            <td><strong>Enviar</strong></td>
        </tr>

 <?php if (isset ($_POST['enviar1'])){
	$soli =  mysqli_real_escape_string($conectar, $_POST['id_solicitacao']); 
	$solpro =  mysqli_real_escape_string($conectar, $_POST['processo']); 
	$souser =  mysqli_real_escape_string($conectar, $_POST['usuario']); 
       	$soudate =  mysqli_real_escape_string($conectar, $_POST['date']); 
	$qrUpdateRead = "UPDATE solicitacao SET status = '1', data_trans = NOW() WHERE  id_solicitacao = '$soli'";
	$stUpdateRead  = mysqli_query($conectar, $qrUpdateRead)or die (mysqli_errno());

    
    $qrus = "SELECT * FROM user WHERE user_id = '$souser'";
    $stus = mysqli_query($conectar, $qrus)or die (mysqli_errno());
    $asus = mysqli_fetch_assoc($stus);

  	require_once('../mail_config.php');
	sendMail('Sua solicitação foi enviada','Seu processo '.$solpro.' foi enviado.',$asus['user_email'],$asus['user_nome']);
	
        
 } ?>        
        
  <?php if (isset ($_POST['enviar2'])){
	$soli =  mysqli_real_escape_string($conectar, $_POST['id_solicitacao']); 
	$sousu =  mysqli_real_escape_string($conectar,$_POST['id_usuario']); 
	$soupro =  mysqli_real_escape_string($conectar, $_POST['processo']); 
	$qrUpdateRead = "$conectar, UPDATE solicitacao SET status = '2', data_devo = NOW() WHERE  id_solicitacao = '$soli'";
	$stUpdateRead  = mysqli_query($conectar, $qrUpdateRead)or die (mysqli_errno());
	
	$sopro =  mysqli_real_escape_string($conectar, $_POST['id_Processo']); 
        $qrUpdateStu = "$conectar,  UPDATE processo SET status = '0' WHERE ID = '$sopro'";
	$stUpdateStu  = mysqli_query($conectar, $qrUpdateStu)or die (mysqli_errno());
	
	$soUse =  mysqli_real_escape_string($conectar, $_POST['id_usuario']); 
        $qrUpdateUse = "$conectar, UPDATE caixa SET Solicitante = '' WHERE id_processo = '$sopro'";
	$stUpdateUse  = mysqli_query($conectar, $qrUpdateUse)or die (mysqli_errno());

        $qruse = "$conectar, SELECT * FROM user WHERE user_id = '$sousu'";
        $stuse = mysqli_query($conectar, $qruse)or die (mysqli_errno());
        $asuse = mysqli_fetch_assoc($stuse);

  	require_once('../mail_config.php');
	sendMail('Solicitação finalizada','Seu processo '.$soupro.' foi arquivado',$asuse['user_email'],$asuse['user_nome']);
        
	}
   ?>        
  
        
   <?php if(isset ($_POST['busca']))  {
   $bus  = ($_POST['busca']);
   
   $qr_soli  = "SELECT * FROM solicitacao WHERE  Nr_Processo LIKE '%$bus%' or caixa LIKE '%$bus%' or status LIKE '$bus' ORDER BY Nr_Processo DESC";
   $st_soli  = mysqli_query($conectar, $qr_soli)or die (mysqli_errno()); 
   
    while ($as_soli = mysqli_fetch_assoc($st_soli)){
 	
            $i++;
            if ($i % 2 == 0) {
                $cor = 'style="background:#E6FFF5"';
            } else {
                $cor = 'style="background:#FFF"';
            }

            if ($as_soli['status'] == 0) {
                $status = 'Aguardando...';
             $link_devo = '<a href="index.php?pagina=resposta_gerecial&ms=' ;
            }

            if ($as_soli['status'] == '1') {
                $status = 'Em Tránsito!';
                $link_devo = '<a href="index.php?pagina=resposta_gerecial&ms=' ;
            }

            if ($as_soli['status'] == '2') {
                $status = 'Devolvido';
                $link_devo = '<a href="index.php?pagina=mensagem&ms=' ;
            }

            if ($as_soli['ms_read'] == '0') {
                $link = '<strong>' . $as_soli['assunto'] . '</strong>';
            } else if ($as_soli['ms_read'] == '1') {
                $link = $as_soli['assunto'];
            }

            $soli_id_user = $as_soli['id_usuario'];
            $qruser = "SELECT * FROM user WHERE user_id = '$soli_id_user'";
            $stuser = mysqli_query($conectar, $qruser)or die(mysqli_errno());
            $asuser = mysqli_fetch_assoc($stuser);



        if ($as_soli['status'] == 0) {       

        $solic = ' <input type="submit" value="Enviar" onclick="this.disabled=true" class="btn"/></td>'
                . '<input type="hidden" name="enviar1" value="" />';
          }

        if ($as_soli['status'] == 1) {

        $solic = '<input type="submit" value="entregue" class="btndis"   />'
                . '<input type="hidden" name="enviar2" value="" />' ;
		 }
                 

        if ($as_soli['status']== 2) {

         $solic = '<input type="submit" value="Devolvido" class="btndis" disabled="disabled"   />' ;

		}       

                
                ?>
       

            <tr align="center" <?PHP echo $cor; ?>>
                <td align="center" ><?php echo $asuser['user_nome']; ?></td>
                <td align="center"><?php echo $as_soli['Nr_Processo']; ?></td>
                <td align="center" ><?php echo $as_soli['caixa'] ?></td>
                <td align="center" ><?php echo $as_soli['Prateleira']; ?></td>
                <td align="center" ><?php echo $link_devo ; ?><?php echo $as_soli['id_solicitacao']; ?>"><?php echo $link; ?></a></td>
                <td align="center" ><?php echo $status; ?> </td>
                <td align="center" ><form action="" method="post" name="enviar" >
                        <table align="center">
                            <tr valign="baseline">
                            </tr>
                            <tr valign="baseline">

                                <?php echo $solic ?></td>
                            </tr>
                        </table>
                        <input type="hidden" name="id_Processo" value="<?php echo $as_soli['id_Processo']; ?>"/>
                        <input type="hidden" name="id_solicitacao" value="<?php echo $as_soli['id_solicitacao']; ?>"/>
                        <input type="hidden" name="processo" value="<?php echo $as_soli['Nr_Processo']; ?>"/>
                        <input type="hidden" name="usuario" value="<?php echo $as_soli['id_usuario']; ?>"/>
                        <input type="hidden" name="date" value="NOW()"/>
                        
                    </form> 
                    <?php
         }
                    
       }
                ?>
    </table>

</div><!--Fecha reader -->

</div><!--Fecha box-->  
