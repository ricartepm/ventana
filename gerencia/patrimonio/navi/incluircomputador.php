<div id="header">
    
    <h3>Incluir Computador </h3>
    
 
 
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


$query_RsUsuario = "SELECT * FROM usuarios WHERE status_usuario = 'ativo' ORDER BY nome ASC";
$RsUsuario = mysql_query($query_RsUsuario) or die(mysql_error());
$row_RsUsuario = mysql_fetch_assoc($RsUsuario);
$totalRows_RsUsuario = mysql_num_rows($RsUsuario);


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO computadores (id_usuario, Nome_compu, modelo, tipo, Processador, Memoria_ram, Hard_disk, nr_serie, nf, plaqueta_patrimonio, ip_eth, ip_wireless, mac_eth, mac_wireless, data_instalacao, status_compu) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW(), %s)",
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['Nome_compu'], "text"),
                       GetSQLValueString($_POST['modelo'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['Processador'], "text"),
                       GetSQLValueString($_POST['Memoria_ram'], "text"),
                       GetSQLValueString($_POST['Hard_disk'], "text"),
                       GetSQLValueString($_POST['nr_serie'], "text"),
                       GetSQLValueString($_POST['nf'], "text"),
                       GetSQLValueString($_POST['plaqueta_patrimonio'], "text"),
                       GetSQLValueString($_POST['ip_eth'], "text"),
                       GetSQLValueString($_POST['ip_wireless'], "text"),
                       GetSQLValueString($_POST['mac_eth'], "text"),
                       GetSQLValueString($_POST['mac_wireless'], "text"),
                       GetSQLValueString($_POST['status_compu'], "text"));


  $Result1 = mysql_query($insertSQL) or die(mysql_error());
  $post_id = mysql_insert_id();

  $insertGoTo = "windows.php?id=$post_id";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
    echo  "<script language='javaScript'>window.location.href='index.php?pagina=incluirwindows&id=$post_id'</script>";
}
?>
  
<form action="<?php echo $editFormAction; ?>" method="post" name="form3" id="form3" >
  <table  align="center" class="solicitar">
    <tr>
      <td><p></p></td>
    </tr>
    <tr>
      <td><strong>Usuário:</strong></td>
      <td>
   <label for="id_usuario"></label>
        <select name="id_usuario" id="id_usuario">
           <option value="">Selecione o Usuário</option>
          <?php
do {  
?>
          <option value="<?php echo $row_RsUsuario['id_user']?>"><?php echo $row_RsUsuario['nome']?> <?php echo $row_RsUsuario['sobrenome']?></option>
          <?php
} while ($row_RsUsuario = mysql_fetch_assoc($RsUsuario));
  $rows = mysql_num_rows($RsUsuario);
  if($rows > 0) {
      mysql_data_seek($RsUsuario, 0);
	  $row_RsUsuario = mysql_fetch_assoc($RsUsuario);
  }
?>
      </select> </td>
    </tr>
    <tr>
      <td><strong>Nome Computador:</strong></td>
      <td><input type="text" name="Nome_compu" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Modelo:</strong></td>
      <td><input type="text" name="modelo" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Tipo:</strong></td>
      <td><label>
                  <select name="tipo" id="tipo">
     			     <option value="">Selecione a tipo</option>
                     <option value="Servidor" id="Servidor">Servidor</option>
                     <option value="Desktop" id="Desktop">Desktop</option>
                     <option value="Laptop" id="Laptop">Laptop</option>     
          </select>
      </label></td>
    </tr>
    <tr>
      <td><strong>Processador:</strong></td>
      <td><input type="text" name="Processador" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Memoria:</strong></td>
      <td>      <label>
                  <select name="Memoria_ram" id="Memoria_ram">
     			     <option value="">Selecione Memoria</option>
                     <option value="1Gb" id="1Gb">1GB</option>
                     <option value="2Gb" id="2Gb">2GB</option>
                     <option value="3GB" id="3B">3GB</option>
                     <option value="4GB" id="4GB">4GB</option> 
                     <option value="5Gb" id="5Gb">5GB</option>
                     <option value="6GB" id="6GB">6GB</option>
                     <option value="8GB" id="8GB">8GB</option>                         
                     <option value="16GB" id="16GB">16GB</option>
                     <option value="32GB" id="32GB">32GB</option> 
          </select>
      </label>
      </td>
    </tr>
    <tr>
      <td><strong>HD:</strong></td>
      <td>
             <label>
                  <select name="Hard_disk" id="Hard_disk">
     		     <option value="">Selecione HD</option>
                     <option value="250Gb" id="80Gb">80GB</option>
                     <option value="250Gb" id="160Gb">160GB</option>
                     <option value="250Gb" id="250Gb">250GB</option>
                     <option value="350GB" id="350GB">350GB</option>
                     <option value="500GB" id="500GB">500GB</option> 
                     <option value="750GB" id="750GB">750GB</option> 
                     <option value="1TB" id="1TB">1TB</option> 
                     <option value="2TB" id="1TB">2TB</option> 
          </select>
      </label></td>
    </tr>
    <tr>
      <td><strong>Nr Serie:</strong></td>
      <td><input type="text" name="nr_serie" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Nota fiscal:</strong></td>
      <td><input type="text" name="nf" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Plaqueta Patrimonio:</strong></td>
      <td><input type="text" name="plaqueta_patrimonio" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>IP eth0:</strong></td>
      <td><input type="text" name="ip_eth" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>IP Wireless:</strong></td>
      <td><input type="text" name="ip_wireless" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Mac eth0:</strong></td>
      <td><input type="text" name="mac_eth" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Mac Wireless:</strong></td>
      <td><input type="text" name="mac_wireless" value="" size="32" class="input" /></td>
    </tr>
      <tr>
      <td><strong>Status:</strong></td>
      <td><label>
        <select name="status_compu" id="status_compu">
	     <option value="">Selecione o Status</option>
         <option value="Ativo" id="novidades">Ativo</option>
         <option value="Inativo" id="cursos">Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Cadastrar" class="btn" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
    
    
    
    
    
</div><!--Fecha heade