<div id="header">
    
    <h3>Windows</h3>
    
     <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=windows" >
      
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
    
    <table width="100%" border="0" cellspacing="2">
   <tr align="center" bgcolor="#CC0001" class="marg">
       <td><strong>Windows:</strong></td>
       <td><strong>Chave do Windows:</strong></td>
       <td><strong>Computador:</strong></td>
       <td><strong>Status:</strong></td>
       <td><strong>Editar:</strong></td>
  </tr>
 <?php 
if(isset ($_POST['busca']))  {
   $bus  = ($_POST['busca']);
   
   $qrwin  = "SELECT * FROM windows WHERE S_O LIKE '%$bus%' or chave_windows LIKE '%$bus%' or status_windows LIKE '$bus' ORDER BY chave_windows ASC";
   $stwin  = mysqli_query($qrwin)or die (mysqli_errno()); 
   
    while ($aswin  = mysqli_fetch_assoc($stwin)){
 	
   $id_com = $aswin['id_computador'];
   $qrcom  = "SELECT * FROM computadores WHERE id = '$id_com' ";
   $stcom  = mysqli_query($qrcom)or die (mysqli_errno()); 
   $ascom  = mysqli_fetch_assoc($stcom);
   $i++;
		 if($i % 2 == 0){
		    $cor = 'style="background:#E6FFF5;"';
		 }else{
			$cor = 'style="background:#FFF;"' ;
		 }
		
 ?>

     <tr align="center" <?PHP echo $cor;?>>
    <td><a href="#" onclick="MM_openBrWindow('windows.php?id=<?php echo $aswin['id_windows'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $aswin['S_O'];?></a></td>
    <td><a href="#" onclick="MM_openBrWindow('windows.php?id=<?php echo $aswin['id_windows'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $aswin['chave_windows'];?></a></td>
    <td><a href="#" onclick="MM_openBrWindow('compu.php?id=<?php echo $ascom['id'] ; ?>','','menubar=yes,width=620,height=700')"><?php echo $ascom['Nome_compu'];?></a></td>
    <td><?php echo $aswin['status_windows'];?></td>
    <td><a href="index.php?pagina=editarwindows&id=<?php echo $aswin['id_windows'] ; ?>">Editar</a></td>
  </tr>
<?php
 }
}
 ?>
  <tr>
    <td height="30" colspan="6" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="48" colspan="6" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<td align="center" bgcolor="#DADADA"></td>
<tr>
  <td></td></td>
</tr>
<tr>
  <td align="center" bgcolor="#DADADA"></td>
</tr>

    
</div>
