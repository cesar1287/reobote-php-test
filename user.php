<?php
/**
 * Pagina de usuario logado...
 */

//que tem os caminhos
include_once 'model/urls.php';
//classe Usuario
include_once 'model/class/User.class.php';

include_once 'controller/validate.php';

//testando se tem realmente alguem logado
session_start();

//se nao tiver ninguem logado volta pro index...
if(!isset($_SESSION['user_on'])){
	header("location: index.php");
}

//recuperar os dados que estão na sessao...
$user_on = $_SESSION['user_on'];


//titulo da pagina
$page_title = "Bem vindo ".$user_on->get_person_name();

//conteúdo para o usuario
function page_content(){
	global $user_on;
	
	validate_error();
	validate_success();
	
	// Este trecho chama o cadastro de contato
	// Incluindo classe para criação de tag
	include_once 'model/class/Tag.class.php';

	// Criando botão para chamar o modal
	$a = new Tag('a');
	$a->class = "btn btn-info";
	$a->href="#add_contact";
	
		// Arranjo
		$atribute = "data-toggle";
	$a->$atribute = "modal";
	$a->add_content("Novo contato");
	$a->show_tag();
	
	// Modal que conterá o form de cadastro
	$modal_id = "add_contact";
	$modal_title = "Adicionar Contato";
	$modal_file = "view/forms/add_contact.html";
	$modal_text = "";
	
	include_once 'view/modal.html';
	
}


//template
include_once 'view/template.html';