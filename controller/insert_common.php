<?php

	//incluindo o arquivo com as variaveis de caminho
	include_once dirname(__DIR__).'/model/urls.php';
	
	//arquivo com os dados do banco de dados
	include_once ($GLOBALS['project_path'].'/model/db_data.php');
	
	//classe que gerencia o banco...
	include_once ($GLOBALS['project_path'].'/model/class/Manager.class.php');
	
	//criar o objeto do tipo Gerenciador
	$manager = new Manager($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	// Recebendo dados do form
	$data = $_POST;
	
	// Pegando o nome da tabela
	$table = $GLOBALS['db_tables'][$data['table']];
	
	// Remover a tabela do array $data
	array_pop($data);
	
	$manager->insert_common($table, $data);
	
	// Redireciona informando que deu certo
	header("location: ".$GLOBALS['project_index']."/user.php?sucess=insert_ok");
	
?>