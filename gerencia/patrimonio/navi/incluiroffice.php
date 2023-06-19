<div id="header">
    
    <h3>Incluir Office </h3>
    
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
  $insertSQL = sprintf("INSERT INTO office (id_computador, chave_office, tipo_office, office, nf, data_instalacao, status_office) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_computador'], "int"),
                       GetSQLValueString($_POST['chave_office'], "text"),
                       GetSQLValueString($_POST['tipo_office'], "text"),
                       GetSQLValueString($_POST['office'], "text"),
                       GetSQLValueString($_POST['nf'], "text"),
                       GetSQLValueString($_POST['data_instalacao'], "date"),
                       GetSQLValueString($_POST['status_office'], "text"));

  $Result1 = mysql_query($insertSQL) or die(mysql_error());

  $post_id = ($_POST['id_computador']);
  
  $insertGoTo = "buscacomputador.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
    echo  "<script language='javaScript'>window.location.href='index.php?pagina=computador&id=$post_id'</script>";
}

?>


<form action="<?php echo $editFormAction; ?>" method="post"  name="form3" id="form3">
  
  <table  align="center" class="solicitar">
      
    <tr>
      <td><p></p></td>
    </tr>
    <tr>
      <td><strong>Chave Office:</strong></td>
      <td><strong>
              <input type="text" name="chave_office" value="" size="32" class="input" />
      </strong></td>
    </tr>
    <tr>
      <td><strong> Tipo de Linceça:</strong></td>
      <td><strong>
        <label>
        <select name="tipo_office" id="tipo_office">
	     <option value="">Selecione Tipo O S</option>
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
	     <option value="">Selecione O S</option>
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
              <input type="text" name="nf" value="" size="32" class="input" />
      </strong></td>
    </tr>
    <tr>
      <td><strong>Status:</strong></td>
      <td>
      <label>
         <select name="status_office" id="status_office">
	     <option value="">Selecione o Status</option>
         <option value="Ativo" id="Ativo">Ativo</option>
         <option value="Inativo" id="Inativo">Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <td><input type="submit" value="Cadastrar" class="btn" /></td>
    </tr>
  </table>
  <input type="hidden" name="id_computador" value="<?php echo $_GET['id']; ?>" />
  <input type="hidden" name="data_instalacao" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>

 

    
    
    
    
    
</div><!--Fecha header -->