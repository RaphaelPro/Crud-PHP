
<!-- Conexão... -->
<?php
//Sample Database Connection Syntax for PHP and MySQL.
// if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
//     echo 'We don\'t have mysqli!!!';
// } else {
//     echo 'Phew we have it!';
// }

//Connect To Database
$servername = "mysqlASW";
$username = "root";
$password = "root";
$dbname = "biblioteca";

// mysql_connect($servername,$username, $password); //ou desconexão ("html>script language='JavaScript'>alert(“Não foi possível se conectar ao banco de dados! Tente novamente mais tarde.'),history.go(-1)/script>/html>");
// mysql_select_db($dbname);


// $con = mysqli_connect($servername,$username,$password,$dbname);
$con = new mysqli($servername, $username, $password, $dbname);

	# Verifique se o registro existe
	
	$query = "SELECT * FROM user";
	
	$result = mysqli_query($con,$query);
	
	if($result){
		while($row = mysqli_fetch_array($result)){
            $login = $row["login"];
            $senha = $row["senha"];
			echo "Login: ".$login."<br/>";
			echo "Senha: ".$senha."<br/>";
		}
	}
    
    if(!$con){
        die('Não está conectado'. mysqli_error());
    }
        echo('Conectado com sucesso');
        

//Conexão

//Validação dos campos
if(null !== ($_POST["login"] && null !== ($_POST["senha"]))){
    if(empty($_POST["login"]))
     $erro = "Entre com o Login";
    else
    if(empty($_POST["senha"]))
     $erro = "Entre com a senha";
    else{
        //Crud fica aqui
        //---Cadastro
         $login = $_POST["login"];
         $senha = $_POST["senha"];

        
        //  $command = $con->prepare("Insert into 'user'('login','senha') VALUE (?,?)");
        //  $command->bind_param('sssd'l, $ogin, $senha);
        
        $stmt = $con->prepare("INSERT INTO user(login, senha) VALUES (?, ?)");

        $stmt->bind_param('ss', $login, $senha);
        
         if(!mysqli_stmt_execute($stmt)){
           $erro = $command -> error;
         }else{
             echo("Dados Cadastrados com sucesso");
         }
    }     
}
mysqli_close($con);
?>
<html>
    <head>
        <title>Teste</title>
    </head>
    <body>
        <form method="POST">
            <input type="text" name="login" placeholder="Login">
            <input type="password" name="senha" placeholder="Senha">
            <button type="submit">Enviar</button>
        </form>
    </body>
</html>
