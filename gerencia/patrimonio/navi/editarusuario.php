<div id="header">
    
      <h3>Editar Usuario</h3>    
    
  

   
     
      <table width="100%" border="0" cellspacing="2"  height="40px" >
     <tr align="center" bgcolor="#CC0001" class="marg" >
         
      <td><form id="form1" name="form1" method="post" action="index.php?pagina=usuario">
      
      <input type="text" name="busca" id="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter" class="btn" />
    </form></td>
     </tr>
 </table>
     
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
	
  $updateSQL = sprintf("UPDATE usuarios SET nome=%s, sobrenome=%s, email=%s, setor=%s, local=%s, status_usuario=%s WHERE id_user=%s",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['sobrenome'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['setor'], "text"),
                       GetSQLValueString($_POST['local'], "text"),
                       GetSQLValueString($_POST['status_usuario'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  
  $Result1 = mysql_query($updateSQL) or die(mysql_error());
  
  
  $updateGoTo = "index.php?pagina=usuario";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
    echo '<h3>Editado com sucesso.</h3>';
}

$colname_RsUsuario = "-1";
if (isset($_GET['id'])) {
  $colname_RsUsuario = $_GET['id'];
}
$query_RsUsuario = sprintf("SELECT * FROM usuarios WHERE id_user = %s", GetSQLValueString($colname_RsUsuario, "int"));
$RsUsuario = mysql_query($query_RsUsuario) or die(mysql_error());
$row_RsUsuario = mysql_fetch_assoc($RsUsuario);
$totalRows_RsUsuario = mysql_num_rows($RsUsuario);$colname_RsUsuario = "-1";


?>
     
    
<form action="<?php echo $editFormAction; ?>" method="POST" name="form3" id="form3">
  <table  align="center" class="solicitar1">
    <tr>
        <td><p></p></td>
    </tr>
    <tr>
      <th><strong>Nome:</strong></th>
      <td><input type="text" name="nome" value="<?php echo htmlentities($row_RsUsuario['nome'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="input" /></td>
    </tr>
    <tr >
      <th><strong>Sobrenome:</strong></th>
      <td><input type="text" name="sobrenome" value="<?php echo htmlentities($row_RsUsuario['sobrenome'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="input"/></td>
      <tr valign="baseline">
      <th><strong>Email:</strong></th>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_RsUsuario['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="input" /></td>
    </tr>
   <tr>
      <td><strong>Setor:</strong></td>
      <td> <label>
        <select name="setor" id="setor">
	 <option value="<?php echo htmlentities($row_RsUsuario['setor'], ENT_COMPAT, 'utf-8'); ?>"><?php echo htmlentities($row_RsUsuario['setor'], ENT_COMPAT, 'utf-8'); ?></option>
         <option value="Adm. e Financ." id="Adm. e Financ.">Adm. e Financ.</option>
         <option value="Administração Filial" id="Administração Filial">Administração Filial</option>
         <option value="Comercial" id="Comercial">Comercial</option>
         <option value="Controladoria" id="Controladoria">Controladoria</option>
         <option value="Controladoria" id="Controladoria">Controladoria</option>
         <option value="Desembaraço" id="Desembaraço">Desembaraço</option>
         <option value="Diretoria" id="Diretoria">Diretoria</option>
         <option value="Operações" id="Operações">Operações</option>
         <option value="Operações Rodoviárias" id="Operações Rodoviárias">Operações Rodoviárias</option>
         <option value="Princing" id="Princing">Princing</option>
         <option value="Processos Qualidade e Tecnologia" id="Processos Qualidade e Tecnologia">Processos Qualidade e Tecnologia</option>
         <option value="Recursos Humanos" id="Recursos Humanos">Recursos Humanos</option>
         <option value="Serviços Gerais" id="Serviços Gerais">Serviços Gerais</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <th ><strong>Local:</strong></th>
      <td>  
       <label>
        <select name="local" id="local">
	 <option value="<?php echo htmlentities($row_RsUsuario['local'], ENT_COMPAT, 'utf-8'); ?>"><?php echo htmlentities($row_RsUsuario['local'], ENT_COMPAT, 'utf-8'); ?></option>
         <option value="Ventana SPO" id="Ventana SPO">Ventana SPO</option>
         <option value="Ventana BHZ" id="Ventana BHZ">Ventana BHZ</option>
         <option value="Ventana SSZ" id="Ventana SSZ">Ventana SSZ</option>
         <option value="Ventana SSA" id="Ventana SSA">Ventana SSA</option>
         <option value="Ventana GRU" id="Ventana GRU">Ventana GRU</option>
         <option value="Ventana SE" id="Ventana SE">Ventana SE</option>
         <option value="Ventana RIO" id="Ventana RIO">Ventana RIO</option>
         <option value="Ventana CAJ" id="Ventana CAJ">Ventana CAJ</option>
         <option value="Ventana CNF" id="Ventana CNF">Ventana CNF</option>
         <option value="Ventana BET" id="Ventana BET">Ventana BET</option>
         <option value="Ventana CTG" id="Ventana CTG">Ventana CTG</option>
         <option value="Ventana REC" id="Ventana REC">Ventana REC</option>
        </select>
      </label>
      </strong></td>
    </tr>
    <tr>
      <th><strong>Status:</strong></th>
      <td><label>
         <select name="status_usuario" id="status_usuario">
	     <option value="<?php echo htmlentities($row_RsUsuario['status_usuario'], ENT_COMPAT, 'utf-8'); ?>"><?php echo htmlentities($row_RsUsuario['status_usuario'], ENT_COMPAT, 'utf-8'); ?></option>
         <option value="Ativo" id="Ativo">Ativo</option>
         <option value="Inativo" id="Inativo">Inativo</option>  
        </select>
      </label></td>
    </tr>
    
    <tr>
        <th></th>
        <td> <input type="submit" value="Alterar" class="btn"/></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>
    <input type="hidden" name="MM_update" value="form3" />
    <input type="hidden" name="busca" value="<?php echo $row_RsUsuario['nome']; ?>" />
    <input type="hidden" name="ID" value="<?php echo $row_RsUsuario['id_user']; ?>" />
  </p>
</form>
<p>&nbsp;</p>

    
    
    
    
   
   </div><!--Fecha reader -->
        
        </div><!--Fecha box-->  
        
    </body>
</html>