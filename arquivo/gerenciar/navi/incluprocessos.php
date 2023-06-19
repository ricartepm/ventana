
<div id="header">
    
    <h3>Incluir Processo</h3>
    
    
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

//  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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
	
	$soPro =  mysqli_real_escape_string($conectar,$_POST['Nr_Processo']); 
	$cadbusca = mysqli_query($conectar, "SELECT * FROM processo WHERE Nr_Processo = '$soPro'");
	$verificarlogin = mysqli_num_rows($cadbusca);
		if ($verificarlogin == 0){	
	
  $insertSQL = sprintf("INSERT INTO processo (Dt_Execucao, Nr_Processo, Master, House, Cliente) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Dt_Execucao'], "text"),
                       GetSQLValueString($_POST['Nr_Processo'], "text"),
                       GetSQLValueString($_POST['Master'], "text"),
                       GetSQLValueString($_POST['House'], "text"),
                       GetSQLValueString($_POST['Cliente'], "text"));

   $Result1 = mysqli_query($conectar, $insertSQL) or die(mysqli_error());
   $post_id = mysqli_insert_id($conectar);

  $insertGoTo = "caixa.php?ID=$post_id";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
    echo  "<script language='javaScript'>window.location.href='index.php?pagina=caixa&ID=$post_id'</script>";
}else{	
	echo '<h3><strong>Processo já Cadastrado!</strong> </h3>';	
	}
		}

$colname_RsProcesso = "-1";
if (isset($_GET['ID'])) {
  $colname_RsProcesso = $_GET['ID'];
}
$query_RsProcesso = sprintf("SELECT * FROM processo WHERE ID = %s", GetSQLValueString($colname_RsProcesso, "int"));
$RsProcesso = mysqli_query($conectar, $query_RsProcesso) or die(mysqli_error());
$row_RsProcesso = mysqli_fetch_assoc($RsProcesso);
$totalRows_RsProcesso = mysqli_num_rows($RsProcesso);

$colname_RsCaixa = "-1";
if (isset($_GET['ID'])) {
  $colname_RsCaixa = $_GET['ID'];
}
$query_RsCaixa = sprintf("SELECT * FROM caixa WHERE id_processo = %s", GetSQLValueString($colname_RsCaixa, "int"));
$RsCaixa = mysqli_query($conectar, $query_RsCaixa) or die(mysqli_error());
$row_RsCaixa = mysqli_fetch_assoc($RsCaixa);
$totalRows_RsCaixa = mysqli_num_rows($RsCaixa);

?>
  <tr bgcolor="#FFFFFF"><th width="188" align="center">&nbsp;</th>
   </tr>
<form action="<?php echo $editFormAction; ?>" method="post" name="registro" id="registro">
 <table align="center" class="solicitar1">
   
     <tr >
      <th >&nbsp;</th>
    </tr>
    <tr>
        <td><strong>Data:</strong></td>
      <td >
          <input type="text" name="Dt_Execucao" value="" size="32" class="input" />
      </td>
    </tr>
    <tr>
        <td><strong>Processo:</strong></td>
      <td>
          <input type="text" name="Nr_Processo" value="" class="input" />
      </td>
    </tr>
    <tr>
        <td><strong>Master:</strong></td>
      <td >
          <input type="text" name="Master" value="" class="input" />
      </td>
    </tr>
    <tr>
        <td><strong>House:</strong></td>
        <td><input type="text" name="House" value="" class="input" /></td>
    </tr>
    <tr>
        <td><strong>Cliente:</strong></td>
      <td>
          <input type="text" name="Cliente" value=""  class="input" />
      </td>
    </tr>
    <tr>
        <th></th>
        <td><input type="submit" value="Enviar" class="btn" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
  <input type="hidden" name="executar" id="executar" value="" />
</form>    
    
    
    
    
</div><!-- Fecha Header -->