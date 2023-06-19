<div id="header">
    <h3>Editar Office </h3>
    
    
     <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=office" >
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
 
<?php 
if(isset($_POST['editar'])){
    
$idPost   = strip_tags(trim($_POST['ID']));
$idCom    = strip_tags(trim($_POST['id_compu']));
$Chave    = strip_tags(trim($_POST['chave_office']));
$Tipo     = strip_tags(trim($_POST['tipo_office']));
$Sistema  = strip_tags(trim($_POST['office']));
$Nota     = strip_tags(trim($_POST['nf']));
$Stat_off = strip_tags(trim($_POST['status_office']));


$sql_editar = 'UPDATE office SET id_office = :idPost, id_computador = :idCom, chave_office = :Chave, tipo_office = :Tipo,'
        . 'office = :Sistema, nf = :Nota, status_office = :Stat_off WHERE id_office = :idPost';
   

try {
    $query_editar = $conect->prepare($sql_editar);
    $query_editar->bindValue(':idPost',$idPost,PDO::PARAM_STR);
    $query_editar->bindValue(':idCom',$idCom,PDO::PARAM_STR);
    $query_editar->bindValue(':Chave',$Chave,PDO::PARAM_STR);
    $query_editar->bindValue(':Tipo',$Tipo,PDO::PARAM_STR); 
    $query_editar->bindValue(':Sistema',$Sistema,PDO::PARAM_STR);
    $query_editar->bindValue(':Nota',$Nota,PDO::PARAM_STR);
    $query_editar->bindValue(':Stat_off',$Stat_off,PDO::PARAM_STR);
    $query_editar->execute();
    echo '<h3>Editado com sucesso.</h3>';
  
    
} catch (PDOException $erro_update) {
    echo 'Error ao editar'.$erro_update->getMessage();
}


}

if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

   $qroff  = "SELECT * FROM office WHERE id_office = '$bus'";
   $stoff  = mysql_query($qroff)or die (mysql_errno()); 
   
   while ($asoff  = mysql_fetch_assoc($stoff)){
   
  $idcom = $asoff['id_computador'];
  $qrcom  = "SELECT * FROM computadores WHERE id = '$idcom' ";
  $stcom  = mysql_query($qrcom)or die (mysql_errno()); 
  $ascom  = mysql_fetch_assoc($stcom); 

$query_RsCom = "SELECT * FROM computadores WHERE status_compu = 'ativo' ORDER BY Nome_compu ASC";
$RsCom = mysql_query($query_RsCom) or die(mysql_error());
$row_RsCom = mysql_fetch_assoc($RsCom);
$totalRows_RsCom = mysql_num_rows($RsCom);

?>
    
  
    <form action="" method="post" name="editar" id="editar" enctype="multipart/form-data" >
 
  <table  align="center" class="solicitar">
     
    <tr>
        <td><p></p></td>
    </tr>
      <tr>
      <td><strong>Computador:</strong></td>
      <td>
   <label for="id_compu"></label>
        <select name="id_compu" id="id_compu">
           <option value="<?php echo $ascom['id'];?>"><?php echo $ascom['Nome_compu'];?></option>
          <?php
do {  
?>
          <option value="<?php echo $row_RsCom['id']?>"><?php echo $row_RsCom['Nome_compu']?> </option>
          <?php
} while ($row_RsCom = mysql_fetch_assoc($RsCom));
  $rows = mysql_num_rows($RsCom);
  if($rows > 0) {
      mysql_data_seek($RsCom, 0);
	  $row_RsCom = mysql_fetch_assoc($RsCom);
  }
?>
      </select> </td>
    </tr>
   
    <tr>
      <td><strong>Chave Office:</strong></td>
      <td><strong>
              <input type="text" name="chave_office" value="<?php echo $asoff['chave_office'];?>" size="32" class="input" />
      </strong></td>
    </tr>
    <tr>
      <td><strong> Tipo de Linceça:</strong></td>
      <td><strong>
        <label>
        <select name="tipo_office" id="tipo_office">
	     <option value="<?php echo $asoff['tipo_office'];?>"><?php echo $asoff['tipo_office'];?></option>
         <option value="OEM" id="OEM">OEM</option>
         <option value="FPP" id="FPP">FPP</option> 
         <option value="Open License" id="Open License">Open License</option> 
        </select>
      </label>
      </strong></td>
    </tr>
    <tr>
      <td><strong>Office:</strong></td>
      <td><strong>
        <label>
        <select name="office" id="office">
	     <option value="<?php echo $asoff['office'];?>"><?php echo $asoff['office'];?></option>
         <option value="2003 Basic Edition" id="2003 Basic Edition">2003 Basic Edition</option>
         <option value="2003 Standard Edition" id="2003 Standard Edition">2003 Standard Edition</option>
         <option value="2003 Professional Edition" id="2003 Professional Edition">2003 Professional Edition</option>
         <option value="2003 Pro Enterprise" id="2003 Pro Enterprise">2003 Pro Enterprise</option>
         <option value="2003 Small Business" id="2003 Small Business">2003 Small Business</option>
         <option value="2007 Basic Edition" id="2007 Basic Edition">2007 Basic Edition</option>
         <option value="2007 Home and Student" id="2007 Home and Student">2007 Home and Student</option>
         <option value="2007 Standard" id="2007 Standard">2007 Standard</option>
         <option value="2007 Small Business" id="2007 Small Business">2007 Small Business</option>
         <option value="2007 Professional" id="2007 Professional">2007 Professional</option>
         <option value="2007 Ultimate" id="2007 Ultimate">2007 Ultimate</option>
         <option value="2007 Professional Plus" id="2007 Professional Plus">2007 Professional Plus</option>
         <option value="2007 Enterprise" id="2007 Enterprise">2007 Enterprise</option>
         <option value="2010 Home and Student" id="2010 Home and Student">2010 Home and Student</option>
         <option value="2010 Home and Business" id="2010 Home and Business">2010 Home and Business</option>
         <option value="2010 Standard" id="2010 Standard">2010 Standard</option>
         <option value="2010 Professional" id="2010 Professional">2010 Professional</option>
         <option value="2010 Professional Plus" id="2010 Professional Plus">2010 Professional Plus</option>
         <option value="2013 starter" id="2013 starter">2013 starter</option>
         <option value="2013 Office Home and Student" id="2013 Office Home and Student">2013 Office Home and Student</option>
         <option value="2013 Office Home and Std" id="2013 Office Home and Std">2013 Office Home and Std</option>
         <option value="2013 Office Home and Business" id="2013 Office Home and Business">2013 Office Home and Business</option>
         <option value="2013 Office Professional" id="2013 Office Professional">2013 Office Professional</option>
         <option value="2013 Office Professional Plus" id="2013 Office Professional Plus">2013 Office Professional Plus</option> 
         <option value="2013 OfficeStandard" id="2013 OfficeStandard">2013 OfficeStandard</option>
         <option value="LibreOffice" id="LibreOffice">LibreOffice</option>
         <option value="OpenOffice" id="OpenOffice">OpenOffice</option>
         <option value="Open " id="Open ">Open </option>
         </select>
      </label>
      </strong></td>
    </tr>
    <tr>
      <td><strong>Nota fiscal:</strong></td>
      <td><strong>
              <input type="text" name="nf" value="<?php echo $asoff['nf'];?>" size="32" class="input" />
      </strong></td>
    </tr>
    <tr>
      <td><strong>Status:</strong></td>
      <td>
      <label>
         <select name="status_office" id="status_office">
	     <option value="<?php echo $asoff['status_office'];?>"><?php echo $asoff['status_office'];?></option>
         <option value="Ativo" id="Ativo">Ativo</option>
         <option value="Inativo" id="Inativo">Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <td><input type="submit" value="Editar" name="editar" class="btn" /></td>
    </tr>
  </table>
         <input type="hidden" name="ID" value="<?php echo $asoff['id_office']; ?>" />
 </form>
    
<?php
    }

   }
   ?>
    
<p>&nbsp;</p>
</body>
</html>
    
    
    
    
    
</div><!--Fecha heade