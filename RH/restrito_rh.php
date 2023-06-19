<?php if(isset($LogSessionId) && $LogSessionId != ''){

  $verificaUser = mysql_query("SELECT * FROM user WHERE user_id = '$LogSessionId'");
 while($res = mysql_fetch_array($verificaUser)){
              $userid  = $res['user_id'];  
              $usuario = $res['user_nome'];
              $login   = $res['user_login'];
              $senha   = $res['user_pass'];
              $email   = $res['user_email'];
              $nivel   = $res['nivel'];
			  
               $_SESSION['log_id']       = $userid;
               $_SESSION['log_usuario']  = $usuario;
               $_SESSION['log_login']    = $login;
               $_SESSION['log_senha']    = $senha;
               $_SESSION['log_email']    = $email;
               $_SESSION['log_Nivel']    = $nivel;
 }

 if($userid == $LogSessionId && $login == $LogSessionLogin && $senha == $logSessionSenha && $nivel == 'rh'){

 }else{
 echo 'Acesso Restrito ao RH <a href="../index.php">Clique aqui para Logar</a>';
 die;
 }

}else{
 echo 'Acesso Restrito <a href="../index.php">Clique aqui para Logar</a>';
 die;
}?>