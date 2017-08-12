<?php

//incluindo o arquivo com as variaveis de caminho
include_once dirname(__DIR__).'/model/urls.php';

//arquivo com os dados do banco de dados
include_once ($GLOBALS['project_path'].'/model/db_data.php');

//classe que gerencia o banco...
include_once ($GLOBALS['project_path'].'/model/class/Manager.class.php');

//criar o objeto do tipo Gerenciador
$manager = new Manager($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);

//receber os dados que vem do form

### dados da nova pessoa...
$person['person_name'] = mysql_real_escape_string($_POST['person_name']);
$person['person_email'] = mysql_real_escape_string($_POST['person_email']);
$person['person_birth'] = mysql_real_escape_string($_POST['person_birth']);

### dados do novo usuario...
//criptografando senha
$user['user_password'] = sha1(sha1($_POST['user_password']));

### invocando o metodo de inserir...
//inserindo nova pessoa
$result = $manager->insert_common("tb_person", $person);

//pegando id da pessoa inserida...
$user['id_user'] = $result;

//cria o novo usuario usando o id da pessoa cadastrada...
$manager->insert_common("tb_user", $user);

//redireciona pro index...
header("location: ".$GLOBALS['project_index']."/?success=user_insert");
?>