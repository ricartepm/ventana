<div id="header">
    <?php include_once ("../sistema/carregando.php"); ?> 
    <h3>Computadores</h3>
    
     <table width="100%" border="0" cellspacing="2">
       
     
  <tr align="center" bgcolor="#CC0001" class="marg">
      <td><strong>Computador:</strong></td>
      <td><strong>Office:</strong></td>
      <td><strong>Windows:</strong></td>
      <td><strong>Usuário:</strong></td>
      <td><strong>Tipo:</strong></td>
      <td><strong>Status:</strong></td>
      <td><strong>Editar:</strong></td>
  </tr>
 <?php 
  if(isset ($_POST['busca']))  {
   $bus  = ($_POST['busca']);

   $qrcom  = "SELECT * FROM computadores WHERE Nome_compu LIKE '%$bus%' or modelo LIKE '%$bus%' or tipo LIKE '%$bus%' or plaqueta_patrimonio LIKE '%$bus%' or status_compu LIKE '$bus'  ORDER BY nome_compu ASC";
   $stcom  = mysqli_query($qrcom)or die (mysqli_errno()); 
   
   while ($ascom  = mysqli_fetch_assoc($stcom)){
 	
  $idoffi = $ascom['id'];
  $qroffi = "SELECT * FROM office WHERE id_computador = '$idoffi' ";
  $stoffi = mysqli_query($qroffi)or die (mysqli_errno()); 
  $asoffi = mysqli_fetch_assoc($stoffi);
   
  $idwin = $ascom['id'];
  $qrwin  = "SELECT * FROM windows WHERE id_computador = '$idwin' ";
  $stwin  = mysqli_query($qrwin)or die (mysqli_errno()); 
  $aswin  = mysqli_fetch_assoc($stwin); 

  $idus = $ascom['id_usuario'];
  $qrus  = "SELECT * FROM usuarios WHERE id_user = '$idus' ";
  $stus  = mysqli_query($qrus)or die (mysqli_errno()); 
  $asus  = mysqli_fetch_assoc($stus); 
  
  $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5"';
		 }else{
			$cor = 'style="background:#FFF"' ;
		 }
  

?>
 <tr align="center" <?PHP echo $cor;?>>
     <td><a href="#" onclick="MM_openBrWindow('compu.php?id=<?php echo $ascom['id'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $ascom['Nome_compu'];?></a></td>
     <td><a href="#" onclick="MM_openBrWindow('office.php?id=<?php echo $asoffi['id_office'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $asoffi['office'];?></a></td>
     <td><a href="#" onclick="MM_openBrWindow('windows.php?id=<?php echo $aswin['id_windows'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $aswin['S_O'];?></a></td>
     <td><a href="#" onclick="MM_openBrWindow('usuario.php?id=<?php echo $asus['id_user'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $asus['nome'];?> <?php echo $asus['sobrenome'];?></a></td>
    <td><?php echo $ascom['tipo'];?> </td>
    <td><?php echo $ascom['status_compu'];?></td>
    <td><a href="index.php?pagina=editarcomputador&id=<?php echo $ascom['id'] ; ?>">Editar</a></td>
    
  </tr>
<?php

 }
}
 ?>
  <tr>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
</table>

    
</div>
