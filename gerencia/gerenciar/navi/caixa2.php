<div id="header">
    
    <h3> Inserir na Caixa manual</h3>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conectar, $theValue) : mysqli_escape_string($theValue);

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
    $soPro =  mysqli_real_escape_string($conectar, $_POST['id_processo']); 
	$cadbusca = mysqli_query($conectar, "SELECT * FROM caixa WHERE id_processo = '$soPro'");
	$verificarlogin = mysqli_num_rows($cadbusca);
		if ($verificarlogin == 0){
  $insertSQL = sprintf("INSERT INTO caixa (id_processo, caixa, prateleira, data_entrada, Solicitante) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_processo'], "int"),
                       GetSQLValueString($_POST['caixa'], "text"),
                       GetSQLValueString($_POST['prateleira'], "text"),
                       GetSQLValueString($_POST['data_entrada'], "date"),
                       GetSQLValueString($_POST['Solicitante'], "text"));

  $Result1 = mysqli_query($conectar, $insertSQL) or die(mysqli_error());

  $insertGoTo = "Resultado2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  echo  "<script language='javaScript'>window.location.href='index.php?pagina=visualizar&ID=$soPro'</script>";
}else{	
	echo '<h3><strong>Processo já na caixa!</strong></h3>';	}
		}

$colname_RsProce = "-1";
if (isset($_GET['ID'])) {
  $colname_RsProce = $_GET['ID'];
}
$query_RsProce = sprintf("SELECT * FROM processo WHERE ID = %s", GetSQLValueString($colname_RsProce, "int"));
$RsProce = mysqli_query($conectar, $query_RsProce) or die(mysqli_error());
$row_RsProce = mysqli_fetch_assoc($RsProce);
$totalRows_RsProce = mysqli_num_rows($RsProce);

$query_RsGerador = "SELECT * FROM gerador_caixa ORDER BY id_caixa DESC LIMIT 2";
$RsGerador = mysqli_query($conectar, $query_RsGerador) or die(mysqli_error());
$row_RsGerador = mysqli_fetch_assoc($RsGerador);
$totalRows_RsGerador = mysqli_num_rows($RsGerador);

?>


<form action="<?php echo $editFormAction; ?>" method="post" name="caixa2" id="caixa2">
  <table align="center" class="solicitar1">
  <tr >
      <th >&nbsp;</th>
    </tr>
    <tr >
      <th>Processo:</th>
      <td ><?php echo $row_RsProce['Nr_Processo']; ?></td>
    </tr>
    <tr >
      <th>Caixa:</th>
      <td><input type="text" name="caixa" value="" size="32" class="input"/></td>
    </tr>
    <tr >
      <th >Prateleira:</th>
      <td><input type="text" name="prateleira" value="" size="32" class="input" /></td>
    </tr>
    <tr >
        <th></th>
    <td><input type="submit" value="Enviar" class="btn1"/></td>
    </tr>
  </table>
  <input type="hidden" name="id_processo" value="<?php echo $row_RsProce['ID']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
    <input type="hidden" name="executar" id="executar" value="" />
</form>
    
</div><!--Fecha Header-->