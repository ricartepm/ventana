<?php include ('config/connect.php');?>

<div id="menu_lateral">
    <ul>
    <form name="login" action="" method="POST" >
     <?php if (isset ($_GET['logoff'])){
     unset ($_SESSION['log_id']);
     unset ($_SESSION['log_usuario']);
     unset ($_SESSION['log_login']);
     unset ($_SESSION['log_senha']);
     unset ($_SESSION['log_email']);
     unset ($_SESSION['log_Nivel']);
}
?>
            <label>
            <span>Login:</span>      
            <input type="text" name="login" />
            </label>
            
             <label>
            <span class="senha_txt">Password:</span>      
            <input type="password" name="senha" class="senha" />
            <input type="submit" name="logar"  value="Enter" class="btn"/>    
               
 <?php if(isset ($_POST['logar'])){
     
    $cadUserlogin = $_POST['login'];
    $cadUserSenha = md5($_POST['senha']);
    $verifica = mysqli_query($conectar, "SELECT * FROM user WHERE user_login = '$cadUserlogin' AND user_pass = '$cadUserSenha'");
    $rows = mysqli_num_rows($verifica);

    if ($rows <= '0'){
    
      echo '<h1>Erro ao logar - Login ou Password errado!</h1>';
      }else {
          while($res = mysqli_fetch_array($verifica)){
              $userid  = $res ['user_id'];  
              $usuario = $res ['user_nome'];
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
          if($nivel == 'admin'){
               echo  header("Location: admin/index.php");
          }  elseif ($nivel == 'usuario' ) {
               echo  header("Location: usuario/index.php");
          }  elseif ($nivel == 'gerencia') {
              echo  header("Location: gerencia/index.php");
          }elseif ($nivel == 'arquivo') {
               echo  header("Location: arquivo/index.php");
          }elseif ($nivel == 'rh') {
               echo  header("Location: RH/index.php");
          }
    }       
}?>
      </label>  
      
           </form>
        
                <li><a href="index.php?pagina=registro">&raquo;Registrar</a></li>  

                
    
</ul>

        </div><!--Fecha menu Lateral-->