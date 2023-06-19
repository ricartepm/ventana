<div id="header">
      
    <h3>Senha</h3>
<?php

require_once('../mail_config.php');

    //gerador de senha randomica
        function geraSenha(){
               
                //caracteres que serão usados na senha randomica
                $chars = 'abcdxyswzABCDZYWSZ0123456789';
                //ve o tamnha maximo que a senha pode ter
                $max = strlen($chars) - 1;
                //declara $senha
                $senha = null;
               
                //loop que gerará a senha de 8 caracteres
                for($i=0;$i < 8; $i++){
                       
                        $senha .= $chars{mt_rand(0,$max)};
       
                }
                return $senha;         
        }
       
        $senha = geraSenha();
       
        //Corpo do email
       
        //inicializa 2 variaveis para que  php.ini nao retorne erros
       
        //destinatario
        $para =  $_POST['email'];
        //para o envio em formato HTML
        $headers = "MIME-Version: 1.0";
        $headers = "Content-type: text/html; charset=utf-8\r\n";
        //endereço do remitente
        $headers .= "From: Mude para seu nome, empresa etc...";


        //corpo do email
        $mensagem = "Olá ";
        $mensagem .= ".<br \><br \>Você está recebendo este email porque solicitou o reenvio de sua senha.";
        $mensagem .= "<br \><br \><br \>Caso não tenha solicitado, remova esta mensagem imediatamente !";
        $mensagem .= "<br \><br \><br \>Sua nova senha de acesso é: ";
        $mensagem .= '<strong>'.$senha.'</strong>';
        $mensagem .= "<br \><br \><br \>Vá ao site e mude sua senha !";
        $mensagem .= "<br \><br \><br \><br \>Esta é uma mensagem automática, não responda !";
       
        //envia a senha para o email com a função mail
        $envia = mail($para,"Recuperação de senha",$mensagem,$headers);
       
        if($envia){
               
                $senha = md5($senha);
       
                $query_senha = mysqli_query($conectar, "UPDATE user SET user_pass = '$senha' WHERE user_email = '$email'");
}
    
    ?>
   </div><!--Fecha reader -->
        
        </div><!--Fecha box-->  
