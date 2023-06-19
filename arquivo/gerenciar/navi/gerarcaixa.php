
<div id="header">
    
    <h3>Gerar Nova Caixa</h3>
    
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
  $insertSQL = sprintf("INSERT INTO gerador_caixa (id_caixa) VALUES (%s)",
                       GetSQLValueString($_POST['id_caixa'], "int"));

  $Result1 = mysqli_query($conectar, $insertSQL) or die(mysqli_error());

  $insertGoTo = "index.php?pagina=gerarcaixa";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_RsProce = "-1";
if (isset($_GET['ID'])) {
  $colname_RsProce = $_GET['ID'];
}
$query_RsProce = sprintf("SELECT * FROM processo WHERE ID = %s", GetSQLValueString($colname_RsProce, "int"));
$RsProce = mysqli_query($conectar, $query_RsProce) or die(mysqli_error());
$row_RsProce = mysqli_fetch_assoc($RsProce);
$totalRows_RsProce = mysqli_num_rows($RsProce);

$colname_RsCaixa = "-1";
if (isset($_GET['ID'])) {
  $colname_RsCaixa = $_GET['ID'];
}
$query_RsCaixa = sprintf("SELECT * FROM caixa WHERE id_processo = %s", GetSQLValueString($colname_RsCaixa, "int"));
$RsCaixa = mysqli_query($conectar, $query_RsCaixa) or die(mysqli_error());
$row_RsCaixa = mysqli_fetch_assoc($RsCaixa);
$totalRows_RsCaixa = mysqli_num_rows($RsCaixa);

$query_RsGerador = "SELECT * FROM gerador_caixa ORDER BY id_caixa DESC LIMIT 1";
$RsGerador = mysqli_query($conectar, $query_RsGerador) or die(mysqli_error());
$row_RsGerador = mysqli_fetch_assoc($RsGerador);
$totalRows_RsGerador = mysqli_num_rows($RsGerador);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
     <table align="center" class="gerar">
    <tr >
      <th >&nbsp;</th>
    </tr>
    <tr ">
      <th>Ultima Caixa:</th>
      <td><?php echo $row_RsGerador['id_caixa']?></td>
    </tr>
    <tr >
      <th >Gerar Nova Caixa:</th>
      <td ><input type="submit" value="Gerar" class="btn" /></td>
    </tr>
    <tr >
      <th >&nbsp;</th>
    </tr>
  </table>
  <input type="hidden" name="id_caixa" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>

</body>
</html>
    
    
    
</div><!-- Fecha Header -->