<?PHP 
define('HOST','localhost');
define('DB','va');
define('USER','root');
define('PASS','Andr0meDA');

$conexao = 'mysql:host='.HOST.';dbname='.DB;

try{
	$conect = new PDO($conexao,USER,PASS);
	$conect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
}catch (PDOexception $erro_conecta){
	echo 'Erro ao conectar, Favor informe pelo email rfilho@ventanaserra.com.br';
}

?>
