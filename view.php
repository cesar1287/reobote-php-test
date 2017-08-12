<?php
include_once 'model/urls.php';

include_once 'model/class/User.class.php';

include_once 'model/class/Tag.class.php';

//recupera os dados do usuario
session_start();
if(!isset($_SESSION['user_on'])){
	header("location: index.php");
}

$user_on = $_SESSION['user_on'];

$id_person = $_GET["id"];

//titulo da pagina
$page_title = "Perfil - ".$user_on->get_person_name();

//funcao de conteudo
function page_content(){
	//possibilitando o acesso aos dados do usuario...
	global $id_person;
	
	//montando tag de titulo do formulario...
	$leg = new Tag('legend');
	$leg->add_content('Visualizar Usuário');
	$leg->show_tag();
	
	//incluindo formulario de 
	include_once 'view/forms/view_user.html';
}

include_once 'view/template.html';
?>