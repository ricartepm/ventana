<?php include '../config/connect.php';?>
<?php require_once('restrito_usuario.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include "js/scripts.php";?>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../images/logosite.jpg">
         <link href="style.css" rel="stylesheet" type="text/css" />

        <title></title>
    </head>
    <body>
       
        <div id="box">
        
        <div id="login">
            <span>Olá: <?php echo $usuario; ?> <a href="../index.php?logoff=pk">Logout</a></span>
        </div><!--fecha login-->
        
        
        <div id="logo">
            <img src="../images/logo.jpg" />
           
        </div><!--fecha logo-->
        
        
       <div id="menu" >
          <ul >
              <a href="http://www.arcese.com" class="imag"><img src="../images/arcese2.jpg" /></a>
              <a href="http://www.arcese.com" class="imag2"><img src="../images/ventanaserrafiemg teste.jpg" class="img_right"/></a>
            </ul>
        </div><!--fecha menu-->
        
   
         <div id="central">
              
             <form name="processo" action="index.php?pagina=search" enctype="multipart/form-date" method="post">
            
             <label>   
             <input type="text" name="busca" size="30"/>
             <input type="submit" name="executar" id="executar" value="Pesquisar" class="btn" />
             
            </label>
       </form>

        </div><!--Fecha central-->