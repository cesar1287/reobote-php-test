<?php

include_once dirname(__DIR__)."/model/urls.php";
include_once ($GLOBALS['project_path']."/model/db_data.php");
include_once ($GLOBALS['project_path']."/model/class/Manager.class.php");
include_once ($GLOBALS['project_path']."/model/class/User.class.php");

//recebendo dados do form de login
$email = $_POST['person_email'];
$password = sha1(sha1($_POST['user_password']));

//criando objeto gerenciador
$manager = new Manager($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);

//preparando a busca relacionada
$tables['tb_user'] = array();
$tables['tb_person'] = array();
$relationships['tb_user.id_user'] = "tb_person.id_person";
$filters['person_email'] = $email;
$extra = null;

$user = $manager->select_special($tables, $relationships, $filters, $extra);

### começamos a validar o resultado
//se nao encontrar ninguem...
if($user == false){
	//volta pro index levando msg de erro...
	header("location: ".$GLOBALS['project_index']."?error=user_not_found");
}else{
	//senao: significa q o usuario foi encontrado
	//iremos testar se a senha é a mesma que está no banco
	if($password == $user[0]['user_password']){
		//se entrar no if significa q as senhas correspondem
		//ou seja pode logar...
		
		//criando e setando dados do objeto do usuario
		$user_on = new User	($user[0]['person_name'], $user[0]['person_email'], $user[0]['user_password']);
		$user_on->set_id_person($user[0]['id_person']);
		$user_on->set_person_photo($user[0]['person_photo']);
		
		//criar a sessao
		session_start(); //iniciando o serviço de sessao
		
		//criando a sessao "user_on" 
		$_SESSION['user_on'] = $user_on;

		//redireciona pro index com o usuario logado...
		header("location: ".$GLOBALS['project_index']);
		
		
	}else{
		//senao significa que a senha tá errada
		header("location: ".$GLOBALS['project_index']."?error=password_incorrect");
	}
	
}


//fazer a busca

//validar o resultado

//instanciar usuario

//criar sessao

//redirecionar
