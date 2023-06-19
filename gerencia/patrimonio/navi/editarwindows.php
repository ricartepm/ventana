<div id="header">
    <h3>Editar windows </h3>
    
   <table width="100%" border="0" cellspacing="2"  height="40px" >
       
   <tr align="center" bgcolor="#CC0001" class="marg" >
       <td><form id="form1" name="form1" method="post" action="index.php?pagina=windows" >
      
      
      <input type="text" name="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter"  class="btn"/>
      
    </form></td>
  </tr>
   </table>
 
<?php 
if(isset($_POST['editar'])){
    
$idPost   = strip_tags(trim($_POST['ID']));
$idCom    = strip_tags(trim($_POST['id_compu']));
$Chave    = strip_tags(trim($_POST['chave_windows']));
$Tipo     = strip_tags(trim($_POST['tipo_S_O']));
$Sistema  = strip_tags(trim($_POST['S_O']));
$Nota     = strip_tags(trim($_POST['nr_nota_fiscal']));
$Stat_win = strip_tags(trim($_POST['status_windows']));


$sql_editar = 'UPDATE windows SET id_windows = :idPost, id_computador = :idCom, Chave_windows = :Chave, tipo_S_O = :Tipo,'
        . 'S_O = :Sistema, nr_nota_fiscal = :Nota, status_windows = :Stat_win WHERE id_windows = :idPost';
   

try {
    $query_editar = $conect->prepare($sql_editar);
    $query_editar->bindValue(':idPost',$idPost,PDO::PARAM_STR);
    $query_editar->bindValue(':idCom',$idCom,PDO::PARAM_STR);
    $query_editar->bindValue(':Chave',$Chave,PDO::PARAM_STR);
    $query_editar->bindValue(':Tipo',$Tipo,PDO::PARAM_STR); 
    $query_editar->bindValue(':Sistema',$Sistema,PDO::PARAM_STR);
    $query_editar->bindValue(':Nota',$Nota,PDO::PARAM_STR);
    $query_editar->bindValue(':Stat_win',$Stat_win,PDO::PARAM_STR);
    $query_editar->execute();
    echo '<h3>Editado com sucesso.</h3>';
  
    
} catch (PDOException $erro_update) {
    echo 'Error ao editar'.$erro_update->getMessage();
}


}

if(isset ($_GET['id']))  {
   $bus  = ($_GET['id']);

   $qrwin  = "SELECT * FROM windows WHERE id_windows = '$bus'";
   $stwin  = mysql_query($qrwin)or die (mysql_errno()); 
   
   while ($aswin  = mysql_fetch_assoc($stwin)){
   
  $idcom = $aswin['id_computador'];
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
   <label for="id_usuario"></label>
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
      <td><strong>Chave Windows:</strong></td>
      <td><input type="text" name="chave_windows" value="<?php echo $aswin['chave_windows'];?>" size="32" class="input" /></td>
    </tr>
    <tr >
      <td><strong>Tipo da Licença:</strong></td>
      <td><label>
        <select name="tipo_S_O" id="tipo_S_O">
	     <option value="<?php echo $aswin['tipo_S_O'];?>"><?php echo $aswin['tipo_S_O'];?></option>
         <option value="OEM" id="OEM">OEM</option>
         <option value="FPP" id="FPP">FPP</option> 
         <option value="Open License" id="Open License">Open License</option> 
        </select>
      </label></td>
    </tr>
    <tr>
      <td><strong>Sistaema Operacional:</strong></td>
      <td><label>
        <select name="S_O" id="S_O">
	     <option value="<?php echo $aswin['S_O'];?>"><?php echo $aswin['S_O'];?></option>
         <option value="XP Professional" id="XP Professional">XP Professional</option>
         <option value="Vista Starter Edition " id="Vista Starter Edition">Vista Starter Edition</option>
         <option value="Vista Home Basic" id="Vista Home Basic">Vista Home Basic</option>
         <option value="Vista Home Premium" id="Vista Home Premium">Vista Home Premium</option>
         <option value="Vista Business" id="Vista Business">Vista Business</option>
         <option value="Vista Ultimate" id="Vista Ultimate">Vista Ultimate</option>
         <option value="7 Starter Edition" id="7 Starter Edition">7 Starter Edition</option>
         <option value="7 Home Basic" id="7 Home Basic">7 Home Basic</option>
         <option value="7 Home Premium" id="7 Home Premium">7 Home Premium</option>
         <option value="7 Professional" id="7 Professional">7 Professional</option>
         <option value="7 Ultimate" id="7 Ultimate">7 Ultimate</option>
         <option value="7 Enterprise" id="7 Enterprise">7 Enterprise</option>
         <option value="8" id="8">8</option>
         <option value="8 Professional" id="8 Professional">8 Professional</option>
         <option value="8 Enterprise" id="8 Enterprise">8 Enterprise</option>
         <option value="2003 Web Edition" id="2003 Web Edition">2003 Web Edition</option>
         <option value="2003 Standard Edition" id="2003 Standard Edition">2003 Standard Edition</option>
         <option value="2003 Enterprise Edition" id="2003 Enterprise Edition">2003 Enterprise Edition</option>
         <option value="2003 Datacenter Edition" id="2003 Datacenter Edition">2003 Datacenter Edition</option>
         <option value="2008 Standard Edition" id="2008 Standard Edition">2008 Standard Edition</option>
         <option value="2008 Enterprise Edition" id="2008 Enterprise Edition">2008 Enterprise Edition</option>
         <option value="2008 Datacenter Edition" id="2008 Datacenter Edition">2008 Datacenter Edition</option>
         <option value="2008 HPC Server 2008" id="2008 HPC Server 2008">2008 HPC Server 2008</option>
         <option value="2008 Web Server 2008" id="2008 Web Server 2008">2008 Web Server 2008</option> 
         <option value="2008 Storage Server 2008" id="2008 Storage Server 2008">2008 Storage Server 2008</option>
         <option value="2008 Small Business 2008" id="2008 Small Business 2008">2008 Small Business 2008</option>
         <option value="2008 Essentials Business" id="2008 Essentials Business">2008 Essentials Business</option>
         <option value="2008 Foundation" id="2008 Foundation">2008 Foundation</option>
         <option value="2008 R Foundation" id="2008 R Foundation">2008 R Foundation</option>
         <option value="2008 R Standard Edition" id="2008 R Standard Edition">2008 R Standard Edition</option>
         <option value="2008 R Web Server 2008" id="2008 R Web Server 2008">2008 R Web Server 2008</option>
         <option value="2008 R HPC Server 2008" id="2008 R HPC Server 2008">2008 R HPC Server 2008</option>
         <option value="2008 R Enterprise Edition" id="2008 R Enterprise Edition">2008 R Enterprise Edition</option>
         <option value="2008 R Datacenter Edition" id="2008 R Datacenter Edition">2008 R Datacenter Edition</option>
         <option value="2008 R Itanium" id="2008 R Itanium">2008 R Itanium</option> 
         <option value="2012 Standard Edition" id="2012 Standard Edition">2012 Standard Edition</option>
         <option value="2012 Datacenter Edition" id="2012 Datacenter Edition">2012 Datacenter Edition</option>
         <option value="2012 Essentials" id="2012 Essentials">2012 Essentials</option>
         <option value="2012 Foundation" id="2012 Foundation">2012 Foundation</option>
         <option value="Debian" id="Debian">Debian</option>
         <option value="Open Suse" id="Open Suse">Open Suse</option>
         <option value="Open Linux" id="Open Linux">Open Linux</option> 
        </select>
      </label></td>
    </tr>

    <tr>
      <td><strong>Nr nota fiscal:</strong></td>
      <td><input type="text" name="nr_nota_fiscal" value="<?php echo $aswin['nr_nota_fiscal'];?>" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Status Windows:</strong></td>
      <td>    <label>
        <select name="status_windows" id="status_windows">
	     <option value="<?php echo $aswin['status_windows'];?>"><?php echo $aswin['status_windows'];?></option>
         <option value="Ativo" id="Ativo">Ativo</option>
         <option value="Inativo" id="Inativo">Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="editar" name="editar" class="btn" /></td>
    </tr>
  </table>
        <input type="hidden" name="ID" value="<?php echo $aswin['id_windows']; ?>" />
  </form>
<?php
    }

   }
   ?>
    
<p>&nbsp;</p>
</body>
</html>
    
    
    
    
    
</div><!--Fecha heade