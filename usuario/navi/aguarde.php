<div id="header">
    <?php include_once ("sistema/carregando.php"); ?>  
    
         <h3>Aguarde...</h3>
     
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

	$sopro =  mysqli_real_escape_string($conectar, $_POST['id_Processo']); 
   	$cadbusca = mysqli_query($conectar, "SELECT * FROM caixa WHERE id_processo = '$sopro' " );
     if (mysqli_num_rows($cadbusca) >= 1){	
			
  $insertSQL = sprintf("INSERT INTO solicitacao ( id_usuario, id_Processo, Nr_Processo, caixa, Prateleira, `data`, status, assunto, nivel, ms) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_usuario'], "int"),
					   GetSQLValueString($_POST['id_Processo'], "int"),
                       GetSQLValueString($_POST['Nr_Processo'], "text"),
                       GetSQLValueString($_POST['caixa'], "text"),
                       GetSQLValueString($_POST['Prateleira'], "text"),
                       GetSQLValueString($_POST['data'], "date"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['assunto'], "text"),
                       GetSQLValueString($_POST['nivel'], "text"),
                       GetSQLValueString($_POST['ms'], "text"));



        $Result1 = mysqli_query($conectar, $insertSQL) or die(mysqli_error());
  
 	$sopro =  mysqli_real_escape_string($conectar, $_POST['id_Processo']);
	$soproce      =  mysqli_real_escape_string($conectar, $_POST['Nr_Processo']); 
        $qrUpdateStu = "UPDATE processo SET status = '1' WHERE ID = '$sopro'";
	$stUpdateStu  = mysqli_query($conectar, $qrUpdateStu)or die (mysqli_errno());
	
	$soUse =  mysqli_real_escape_string($conectar, $_POST['id_usuario']); 
        $qrUpdateUse = "UPDATE caixa SET Solicitante = '$usuario' WHERE id_processo = '$sopro'";
	$stUpdateUse  = mysqli_query($conectar, $qrUpdateUse)or die (mysqli_errno());

	require_once('../mail_config.php');
	sendMail('Recebemos sua solicitação','Sua solicitação do processo '.$soproce.' foi recebida com sucesso',$email,$usuario);
	sendMail('Nova Solicitação','Tem uma nova solicitação do usuário '.$usuario.'.','arquivo@ventanaserra.com.br','Arquivo Ventana');


  $insertGoTo = "usuario.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  echo  "<script language='javaScript'>window.location.href='index.php?pagina=meusprocessos'</script>";
   }else{	
	echo '<h3><strong>Processo não arquivado!</strong></h3>';	} 
}
?>
<?php
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

$colname_RsSolic = "-1";
if (isset($_GET['id_solicitacao'])) {
  $colname_RsSolic = $_GET['id_solicitacao'];
}
$query_RsSolic = sprintf("SELECT * FROM solicitacao WHERE id_solicitacao = %s", GetSQLValueString($colname_RsSolic, "int"));
$RsSolic = mysqli_query($conectar, $query_RsSolic) or die(mysqli_error());
$row_RsSolic = mysqli_fetch_assoc($RsSolic);
$totalRows_RsSolic = mysqli_num_rows($RsSolic);
?>


    

</div>