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

//resgatando dados que foram passado por get
//nome da tabela
$table = $GLOBALS['db_tables'][$_GET['table']];
//id do registro a ser excluido...
$id = $_GET['id'];

//se for pra excluir usuario
if($table == "tb_person"){
	//testa se o usuario tá excluindo a conta dele mermo...
	if($user_on->get_id_person() == $id){
		session_destroy();//destruindo a sessao dele...
		$filters['id_person'] = $id;
	}else{
		//senao gerará um erro..
		$erro = true;
	}
}

//se entrar no if é pq algo deu errado
if(isset($erro)){
	//redireciona pro index dando
	header("location: ".$GLOBALS['project_index']."/user.php?error=delete");
}else{
	//deleta o registro...
	$manager->delete_common($table, $filters);
	//redireciona informando que funfou...
	header("location: ".$GLOBALS['project_index']."?success=delete_ok");
}












