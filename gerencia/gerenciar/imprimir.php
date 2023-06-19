<?php include '../../config/connect.php';?>


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

$maxRows_RsImpre = 120;
$pageNum_RsImpre = 0;
if (isset($_GET['pageNum_RsImpre'])) {
  $pageNum_RsImpre = $_GET['pageNum_RsImpre'];
}
$startRow_RsImpre = $pageNum_RsImpre * $maxRows_RsImpre;

$colname_RsImpre = "-1";
if (isset($_GET['caixa'])) {
  $colname_RsImpre = $_GET['caixa'];
}
$query_RsImpre = sprintf("SELECT * FROM caixa WHERE caixa = %s ORDER BY id_processo ASC", GetSQLValueString($colname_RsImpre, "text"));
$query_limit_RsImpre = sprintf("%s LIMIT %d, %d", $query_RsImpre, $startRow_RsImpre, $maxRows_RsImpre);
$RsImpre = mysqli_query($conectar, $query_limit_RsImpre) or die(mysqli_error());
$row_RsImpre = mysqli_fetch_assoc($RsImpre);

if (isset($_GET['totalRows_RsImpre'])) {
  $totalRows_RsImpre = $_GET['totalRows_RsImpre'];
} else {
  $all_RsImpre = mysqli_query($conectar, $query_RsImpre);
  $totalRows_RsImpre = mysqli_num_rows($all_RsImpre);
}
$totalPages_RsImpre = ceil($totalRows_RsImpre/$maxRows_RsImpre)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Arquivo Ventana Serra</title>
<style type="text/css">
tr {
	font-family: Verdana, Geneva, sans-serif;
}
tr {
	font-size: 12px;
}
tr {
	color: #DC00001;
}
tr {
	color: #CD00001;
}
a {
	color: #CD0001;
}
body {
	color: #CD0001;
	text-align: left;
}
h3 {
	font-family: Verdana, Geneva, sans-serif;
}
h3 {
	font-size: 14px;
}
div {
	color: #000;
}
body table tr {
	color: #000;
	font-weight: bold;
}
#MenuBar5 li a {
	text-align: center;
}
body table {
	text-align: right;
}
body table tr td {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
}
body table tr td {
	font-size: 14px;
}
body table tr td {
	font-size: 10px;
}
body table tr {
	font-family: Verdana, Geneva, sans-serif;
}
body table tr td {
	text-align: center;
	font-size: 9px;
}
body table tr td table tr td table tr td {
	font-size: 9px;
}
</style>
<script type="text/javascript">
function javascript:window.open(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
</head>

<body onmousedown="javascript:window.open'imprimir.php','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=500,height=300')">
<table width="420" align="left">
  <tr bgcolor="#FFFFFF">
    <th width="213" height="79" align="left"><img src="../../images/arcese2.jpg" alt="" width="162" height="74" longdesc="../imagens/arcese2.jpg" /></th>
    <th width="245" align="right"> <img src="../../images/ventanaserrafiemg.jpg" alt="" width="186" height="77" longdesc="../imagens/ventanaserrafiemg.jpg" /></th>
  </tr>
</table>

<table width="420" height="167" border="1" align="left">
  <tr>
    <td width="105" style="font-size: 24px"><span style="text-align: left">CX:</span></td>
    <td style="text-align: center; font-size: 24px;"><?php echo $row_RsImpre['caixa']; ?></td>
  </tr>
  <tr>
    <td><span style="font-size: 14px">Local:</span></td>
    <td style="text-align: center"><span style="font-size: 14px"><?php echo $row_RsImpre['prateleira']; ?></span></td>
  </tr>
  <tr>
    <td style="font-size: 14px">Data:</td>
    <td style="text-align: center; font-size: 14px;"><?php echo date ('d/m/Y',  strtotime( $row_RsImpre['data_entrada'])); ?></td>
  </tr>
  <tr>
    <td height="59" style="font-size: 14px">Processos:</td>
    
    <td><table width="104" align="center" >
      <tr>
        <?php
$RsImpre_endRow = 0;
$RsImpre_columns = 3; // number of columns
$RsImpre_hloopRow1 = 0; // first row flag
do {
    if($RsImpre_endRow == 0  && $RsImpre_hloopRow1++ != 0) echo "<tr>";
   ?>
        <td width="96"><table width="92" height="28" border="1" align="left">
          <tr>
            <td width="82" height="22"><?php 
	   $qrproce = "SELECT * FROM processo WHERE ID = '$row_RsImpre[id_processo]'";
       $stproce = mysqli_query($conectar, $qrproce)or die (mysqli_errno());
       $asproce = mysqli_fetch_assoc($stproce);
	   echo $asproce['Nr_Processo']; 
	  
	  ?></td>
          </tr>
        </table></td>
        <?php  $RsImpre_endRow++;
if($RsImpre_endRow >= $RsImpre_columns) {
  ?>
      </tr>
      <?php
 $RsImpre_endRow = 0;
  }
} while ($row_RsImpre = mysqli_fetch_assoc($RsImpre));
if($RsImpre_endRow != 0) {
while ($RsImpre_endRow < $RsImpre_columns) {
    echo("<td>&nbsp;</td>");
    $RsImpre_endRow++;
}
echo("</tr>");
}?>
    </table>
    <p></p></td>
       
  </tr>
</table>


</body>
<script type="text/javascript">
var MenuBar2 = new Spry.Widget.MenuBar("MenuBar2", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</html>
<?php
mysqli_free_result($RsImpre);
?>
