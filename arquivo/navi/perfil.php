<div id="header">

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

//  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conectar, $theValue) : mysqli_escape_string($conectar, $theValue);
 
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

$maxRows_Recordset1 = 300;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['busca'])) {
  $colname_Recordset1 = $_GET['busca'];
}
$query_Recordset1 = sprintf("SELECT * FROM user WHERE user_id LIKE %s", GetSQLValueString($colname_Recordset1 , "text"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysqli_query($conectar, $query_limit_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysqli_query($conectar, $query_Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<table width="100%" border="0" cellspacing="2">

   <?php include_once ("sistema/carregando.php"); ?>   
    <tr align="center" bgcolor="#CC0001" class="marg">
       <td><strong>Usuario:</strong></td>
       <td><strong>Login:</strong></td>
       <td><strong>E-mail:</strong></td>
       <td><strong>Editar:</strong></td>
       <td><strong>Alterar Senha:</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['user_nome']; ?></td>
      <td><?php echo $row_Recordset1['user_login']; ?></td>
      <td><?php echo $row_Recordset1['user_email']; ?></td>
      <td><a href="index.php?pagina=usuarios&ID=<?php echo $userid; ?>">Editar</a></td>
      <td><a href="index.php?pagina=alterarsenha&ID=<?php echo $userid; ?>">Alterar</a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
<tr>
    <td height="50" colspan="6" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="60" colspan="6" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>

</div>