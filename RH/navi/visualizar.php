<div id="header">

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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 30;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
$query_Recordset1 = sprintf("SELECT * FROM processo WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$colname_RsCaixa = "-1";
if (isset($_GET['ID'])) {
  $colname_RsCaixa = $_GET['ID'];
}
$query_RsCaixa = sprintf("SELECT * FROM caixa WHERE id_processo = %s", GetSQLValueString($colname_RsCaixa, "int"));
$RsCaixa = mysql_query($query_RsCaixa) or die(mysql_error());
$row_RsCaixa = mysql_fetch_assoc($RsCaixa);
$totalRows_RsCaixa = mysql_num_rows($RsCaixa);

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);

$colname_RsSolic = "-1";
if (isset($_GET['id_solicitacao'])) {
  $colname_RsSolic = $_GET['id_solicitacao'];
}
$query_RsSolic = sprintf("SELECT * FROM solicitacao WHERE id_solicitacao = %s", GetSQLValueString($colname_RsSolic, "int"));
$RsSolic = mysql_query($query_RsSolic) or die(mysql_error());
$row_RsSolic = mysql_fetch_assoc($RsSolic);
$totalRows_RsSolic = mysql_num_rows($RsSolic);
?>

<table width="100%" border="0" >
   <?php include_once ("sistema/carregando.php"); ?>   
    <tr align="center" bgcolor="#CC0001" class="marg">
    <td><strong>Nr.Processo: </strong></td>
    <td><strong>Master: </strong></td>
    <td><strong>House: </strong></td>
    <td><strong>Cliente: </strong></th>
    <td><strong>Data entrada: </strong></td>
    <td><strong>Solicitante: </strong></td>
    <td><strong>Caixa: </strong></td>
    <td><strong>Pratelira: </strong></td>

  </tr>
       <tr>
      <td><?php echo $row_Recordset1['Nr_Processo']; ?></td>
      <td><?php echo $row_Recordset1['Master']; ?></td>
      <td><?php echo $row_Recordset1['House']; ?></td>
      <td><?php echo $row_Recordset1['Cliente']; ?></td>
      <td><?php echo date ('d/m/Y' ,strtotime ( $row_RsCaixa['data_entrada'])); ?></td>
      <td><?php echo $row_RsCaixa['Solicitante']; ?></td>
      <td><?php echo $row_RsCaixa['caixa']; ?></td>
      <td><?php echo $row_RsCaixa['prateleira']; ?></td>
        </tr>
      </table>
  
</div>
