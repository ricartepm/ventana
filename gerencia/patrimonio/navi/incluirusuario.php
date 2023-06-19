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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO usuarios (nome, sobrenome, email, setor, `local`, status_usuario) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['sobrenome'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['setor'], "text"),
                       GetSQLValueString($_POST['local'], "text"),
                       GetSQLValueString($_POST['status_usuario'], "text"));

  $Result1 = mysql_query($insertSQL) or die(mysql_error());

  $insertGoTo = "computadores.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  echo  "<script language='javaScript'>window.location.href='index.php?pagina=incluircomputador'</script>";
}
?>
    
        <h3>Cadastrar Usuários </h3>
     <table width="100%" border="0" cellspacing="2"  height="40px" >
     <tr align="center" bgcolor="#CC0001" class="marg" >
      <td><form id="form1" name="form1" method="post" action="index.php?pagina=usuario">
      <input type="text" name="busca" id="busca"  size="30" class="input2" />
      <input type="submit" name="button" id="button" value="Enter" class="btn" />
    </form></td>
     </tr>
     </table>
        

<form action="<?php echo $editFormAction; ?>" method="post" name="form3" id="form3">
  <p>&nbsp;</p>
  <table  align="center" class="solicitar1">
    <tr>
        <td></p></td>
    </tr>
    <tr>
      <td><strong>Nome:</strong></td>
      <td><input type="text" name="nome" value="" size="32" class="input"/></td>
    </tr>
    <tr>
      <td><strong>Sobrenome:</strong></td>
      <td><input type="text" name="sobrenome" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Email:</strong></td>
      <td><input type="text" name="email" value="" size="32" class="input" /></td>
    </tr>
    <tr>
      <td><strong>Setor:</strong></td>
      <td> <label>
        <select name="setor" id="setor">
	     <option value="">Selecione Setor</option>
         <option value="Adm. e Financ." id="Adm. e Financ.">Adm. e Financ.</option>
         <option value="Administração Filial" id="Administração Filial">Administração Filial</option>
         <option value="Comercial" id="Comercial">Comercial</option>
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
      <td><strong>Local:</strong></td>
      <td>  
       <label>
        <select name="local" id="local">
	     <option value="">Selecione Local</option>
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
          <option value="Ventana CWB" id="Ventana SE">Ventana CWB</option>
        </select>
      </label>
      </strong></td>
    </tr>
    <tr>
      <td><strong>Status:</strong></td>
      <td><label>
         <select name="status_usuario" id="status_usuario">
	     <option value="">Selecione o Status</option>
         <option value="Ativo" id="Ativo">Ativo</option>
         <option value="Inativo" id="Inativo">Inativo</option>  
        </select>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Cadastrar" class="btn" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form3" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
    
    
    
    
</div><!--Fecha header -->