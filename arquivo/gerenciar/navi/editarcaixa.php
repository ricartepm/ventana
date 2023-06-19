<div id="header">
   
    <h3>Editar Processo</h3>

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE caixa SET caixa=%s, prateleira=%s WHERE id=%s",
                       GetSQLValueString($_POST['caixa'], "text"),
					   GetSQLValueString($_POST['prateleira'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
$proc = $_POST['id_pro'];
  
   $Result1 = mysqli_query($conectar, $updateSQL) or die(mysqli_error());

  $updateGoTo = "index.php?pagina=visualizar";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
echo  "<script language='javaScript'>window.location.href='index.php?pagina=visualizar&ID=$proc'</script>";
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

?>


<form action="<?php echo $editFormAction; ?>" method="post" name="caixa2" id="caixa2">
    <table align="center" class="solicitar1">
        <tr >
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th>Processo:</th>
      <td><?php echo $row_RsProce['Nr_Processo']; ?></td>
    </tr>
    <tr>
      <th>Caixa:</th>
      <td>
          <input type="text" name="caixa" value="<?php echo htmlentities($row_RsCaixa['caixa'], ENT_COMPAT, 'utf-8'); ?>" class="input"  />
      </td>
    </tr>
    <tr>
      <th>Prateleira:</th>
      <td>
          <input type="text" name="prateleira" value="<?php echo htmlentities($row_RsCaixa['prateleira'], ENT_COMPAT, 'utf-8'); ?>" class="input" />
      </td>
    </tr>
 
    <tr>
        <th></th>
        <td><input type="submit" value="Editar" class="btn"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_RsCaixa['id']; ?>" />
  <input type="hidden" name="id_pro" value="<?php echo $row_RsCaixa['id_processo']; ?>" />
  <input type="hidden" name="executar" id="executar" value="" />
</form>

</div><!--Fecha Header-->