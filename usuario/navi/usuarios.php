<div id="header">

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

 //  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conectar, $theValue) : mysqli_escape_string($theValue);

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
  $updateSQL = sprintf("UPDATE user SET user_nome=%s, user_login=%s, user_email=%s, `nivel`=%s WHERE user_id=%s",
                       GetSQLValueString($_POST['Usuario'], "text"),
                       GetSQLValueString($_POST['login'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['nivel'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  $Result1 = mysqli_query($conectar, $updateSQL) or die(mysqli_error());

  $updateGoTo = "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RsUsuario = "-1";
if (isset($_GET['ID'])) {
  $colname_RsUsuario = $_GET['ID'];
}
$query_RsUsuario = sprintf("SELECT * FROM user WHERE user_id = %s", GetSQLValueString($colname_RsUsuario, "int"));
$RsUsuario = mysqli_query($conectar, $query_RsUsuario) or die(mysqli_error());
$row_RsUsuario = mysqli_fetch_assoc($RsUsuario);
$totalRows_RsUsuario = mysqli_num_rows($RsUsuario);$colname_RsUsuario = "-1";
if (isset($_GET['ID'])) {
  $colname_RsUsuario = $_GET['ID'];
}
$query_RsUsuario = sprintf("SELECT * FROM user WHERE user_id = %s", GetSQLValueString($colname_RsUsuario, "int"));
$RsUsuario = mysqli_query($conectar, $query_RsUsuario) or die(mysqli_error());
$row_RsUsuario = mysqli_fetch_assoc($RsUsuario);
$totalRows_RsUsuario = mysqli_num_rows($RsUsuario);
?>

    <h3>Editar Perfil</h3>
<form action="<?php echo $editFormAction; ?>" method="POST" name="Alterar" id="Alterar">
  <table align="center" class="solicitar1">
    <tr>
      <th >&nbsp;</th>
    </tr>
    <tr >
      <th>Usuario:</th>
      <td ><input type="text" name="Usuario" value="<?php echo htmlentities($row_RsUsuario['user_nome'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="input"/></td>
    </tr>
    <tr >
      <th>Login:</th>
      <td ><input type="text" name="login" value="<?php echo htmlentities($row_RsUsuario['user_login'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="input"/></td>
      <tr >
      <th >Email:</th>
      <td ><input type="text" name="email" value="<?php echo htmlentities($row_RsUsuario['user_email'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="input" /></td>
    </tr>
    <tr >
        <th></th>
        <td ><input type="button" value="Voltar" onclick="JavaScript: window.history.back();" class="btn"/>  <input type="submit" value="Alterar" class="btn"/></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>
    
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="ID" value="<?php echo $row_RsUsuario['user_id']; ?>" />
    <input type="hidden" name="nivel" value="<?php echo $row_RsUsuario['nivel']; ?>" />
    <input type="hidden" name="executar" id="executar" value="" />
  </p>
</form>

    </div>
