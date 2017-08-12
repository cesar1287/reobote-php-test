<?php
include_once dirname(__DIR__).'/model/urls.php';

include_once ($GLOBALS['project_path'].'/model/db_data.php');

include_once ($GLOBALS['project_path'].'/model/class/User.class.php');

include_once ($GLOBALS['project_path'].'/model/class/Manager.class.php');


//testar se o usuario tá logado...
session_start();

if(!isset($_SESSION['user_on'])){
	header("location: ".$GLOBALS['project_index']);
}

//resgatando dados do usuario...
$user_on = $_SESSION['user_on'];

//criando objeto do gerenciador...
$manager = new Manager($db_host, $db_user, $db_password, $db_name);

//recebe todos os dados
$data = $_POST;

//pega o nome da tabela
$table = $GLOBALS['db_tables'][$_POST['table']];

//remove o ultimo elemento dos dados que foram enviados: a tabela..
array_pop($data);


//testa pra ver se é atualização de usuario
if($table == "tb_person"){
	//validar se o cara quer atualizar a propria conta
	if($user_on->get_id_person() == $data['id']){
		//filtros da atualização
		$filters['id_person'] = $data['id'];
		
		//atualizando a senha só se o usuario tiver requisitado
		if(!empty($data['user_password'])){
			//criptografando senha
			$new_data['user_password'] = sha1(sha1($data['user_password']));
		
			//atualizando a senha...
			$manager->update_common("tb_user", $new_data, $filters);
		}
		//deleta a senha do array $data...
		unset($data['user_password']);
		unset($data['id']);
		
		//atualizar os dados da sessao...
		$user_on->set_person_name($data['person_name']);
		$user_on->set_person_email($data['person_email']);
		$_SESSION['user_on'] = $user_on;
		
	}else{
		$erro = true;
	}
}

//testa pra atualizar
if(isset($erro)){
	header("location: ".$GLOBALS['project_index']."/user.php?error=update");
}else{
	
	$manager->update_common($table, $data, $filters);
	header("location: ".$GLOBALS['project_index']."/user.php?success=update_ok");
}







