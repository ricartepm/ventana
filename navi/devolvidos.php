<h3> Processos Devolvidos:</h3>
<table width="1056" border="0" align="center">
  <tr>
    <td width="130" align="center" bgcolor="#DADADA"><strong>Solicitante</strong></td>
    <td width="130" align="center" bgcolor="#DADADA"><strong>Processo</strong></td>
    <td width="100" align="center" bgcolor="#DADADA"><strong>Caixa</strong></td>
    <td width="100" align="center" bgcolor="#DADADA"><strong>Prateleira</strong></td>
    <td width="130" align="center" bgcolor="#DADADA"><strong>Data</strong></td>
    <td width="130" align="center" bgcolor="#DADADA"><strong>Assunto</strong></td>
    <td width="127" align="center" bgcolor="#DADADA"><strong>Status</strong></td>
  </tr>
  <?php
  $qrabertos = "SELECT * FROM solicitacao WHERE id_usuario = '$userid' AND status = '2' ORDER BY data DESC";
  $stabertos = mysqli_query($conectar, $qrabertos)or die (mysqli_errno());
  if (mysqli_num_rows($stabertos) <= 0){
      echo '<tr><td colspan="8">Não Existem Solicitações Entregue!</td></tr>';
  }else{
      while ($asaberto = mysqli_fetch_assoc($stabertos)){
          
          if ($asaberto['status'] == '2'){
              $status = 'Devolvido';
          }
	  if($asaberto['ms_read_resp'] == '0' ){
              $link = '<strong>'.$asaberto['assunto'].'</strong>';              
          }else if($asaberto['ms_read_resp'] == '1' ){
              $link = $asaberto['assunto'];
          }          
          echo '<tr>';
          echo '<td align="center" >'.$usuario.'</td>';
          echo '<td align="center">'.$asaberto['Nr_Processo'].'</td>';
          echo '<td align="center" >'.$asaberto['caixa'].'</td>';
          echo '<td align="center" >'.$asaberto['Prateleira'].'</td>';
          echo ' <td align="center" > '.date('d/m/Y H:i',  strtotime($asaberto['data'])).'</td>';
          echo '<td align="center" >'.$asaberto['assunto'].'</td>';
          echo '<td align="center" >'.$status.'</td>';
          echo '</tr>';
         
      }//AND WHILE
  }//END IF ABERTOS
      
  ?>  
</table>



</body>
</html>
