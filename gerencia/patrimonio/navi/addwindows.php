<div id="header">
    
    <h3>Incluir Windows </h3>
    
 <?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO windows (id_computador, chave_windows, tipo_S_O, S_O, data_windows, nr_nota_fiscal, status_windows) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_computador'], "int"),
                       GetSQLValueString($_POST['chave_windows'], "text"),
                       GetSQLValueString($_POST['tipo_S_O'], "text"),
                       GetSQLValueString($_POST['S_O'], "text"),
                       GetSQLValueString($_POST['data_windows'], "date"),
                       GetSQLValueString($_POST['nr_nota_fiscal'], "text"),
                       GetSQLValueString($_POST['status_windows'], "text"));

  $Result1 = mysql_query($insertSQL) or die(mysql_error());
  
  $post_id = ($_POST['id_computador']);

  $insertGoTo = "office.php?id=$post_id";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
    echo  "<script language='javaScript'>window.location.href='index.php?pagina=windows'</script>";
    }
    
$query_RsCom = "SELECT * FROM computadores WHERE status_compu = 'ativo' ORDER BY Nome_compu ASC";
$RsCom = mysql_query($query_RsCom) or die(mysql_error());
$row_RsCom = mysql_fetch_assoc($RsCom);
$totalRows_RsCom = mysql_num_rows($RsCom);
    
    
    
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form3" id="form3">
 
  <table  align="center" class="solicitar">
     
    <tr>
        <td><p></p></td>
    </tr>
       <tr>
      <td><strong>Computador:</strong></td>
      <td>
   <label for="id_computador"></label>
        <select name="id_computador" id="id_computador">
           <option value=""> Selecione o Computador </option>
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
      <td><input type="text" name="chave_windows" value="" size="32" class="input" /></td>
    </tr>
    <tr >
      <td><strong>Tipo da Licença:</strong></td>
      <td><label>
        <select name="tipo_S_O" id="tipo_S_O">
	     <option value="">Selecione Tipo O S</option>
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
	     <option value="">Selecione O S</option>
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
      <td><input type="text" name="nr_nota_fiscal" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Status Windows:</strong></td>
      <td>    <label>
        <select name="status_windows" id="status_windows">
	     <option value="">Selecione o Status</option>
         <option value="Ativo" id="Ativo">Ativo</option>
         <option value="Inativo" id="Inativo">Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Cadastrar" class="btn" /></td>
    </tr>
  </table>
  <input type="hidden" name="data_windows" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
 

    
    
    
    
    
</div><!--Fecha header -->