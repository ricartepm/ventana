<div id="header">
     
    <h3>Registro:</h3>
      <form name="cadastra" id="cadastra" action="" method="post">
      
          <table  >
 

 
    <?php if(isset ($_POST['enviar'])){
    $cadUserNome  = strip_tags(trim($_POST['nome']));
    $cadUserlogin = strip_tags(trim($_POST['login']));
    $cadUserSenha = md5($_POST['senha']);
    $cadUserEmail = strip_tags(trim($_POST['email']));
	
	$cadbusca = mysqli_query($conectar, "SELECT * FROM user WHERE user_login = '$cadUserlogin' OR user_email = '$cadUserEmail'");
	$verificarlogin = mysqli_num_rows($cadbusca);
		if ($verificarlogin == 0){
	 	$cadUser = mysqli_query($conectar, "INSERT INTO user (user_nome, user_login, user_pass, user_email, nivel) VALUES ('$cadUserNome','$cadUserlogin','$cadUserSenha','$cadUserEmail', 'usuario')");
    echo '<h3>Cadastro com Sucesso!</h3><br />';
		}else{	
	echo '<h3>login ou e-mail já Registrado!</h3>';	}
        
        
	}?>
  <table align="center" class="solicitar1">
  <tr >
      <th >&nbsp;</th>
    </tr>
  <tr>
    <th>Nome:</th>
    <td>
        <input type="text" name="nome" id="nome" class="input" />
    </td>
  </tr>
  <th>Login:</th>
    <td>
        <input type="text" name="login" id="login" class="input1"/>
    </td>
  </tr>    
  <tr>
    <th>Password:</th>
    <td>
        <input type="password" name="senha" id="senha" class="input" />
    </td>
  </tr>
      <tr>
          
    <th>E-mail:</th>
    <td>
        <input type="text" name="email" id="email" class="input"/>
    </td>
      </tr>
      <tr>
          <th></th>    
          <td ><input type="submit" name="enviar" value="Registrar" class="btn"/></td>
    </tr>
</table>
</form>
   
   </div><!--Fecha reader -->
        
       
   