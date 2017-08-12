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
	
	//titulo da pagina
	$page_title = "Perfil - ".$user_on->get_person_name();
	
	//funcao de conteudo
	function page_content(){
		//possibilitando o acesso aos dados do usuario...
		global $user_on;
		
		$a = new Tag('a');
		$a->href = "controller/delete_common.php?table=1&id=".$user_on->get_id_person();
			$i = new Tag('i');
			$i->class = "glyphicon glyphicon-remove";
		$a->add_content($i);
		$a->add_content(" Excluir conta<br><br>");
		$a->show_tag();
		
		
		//montando tag de titulo do formulario...
		$leg = new Tag('legend');
		$leg->add_content('Alteração de Dados');
		$leg->show_tag();
		
		
		
		//incluindo formulario de 
		include_once 'view/forms/add_user.html';
	}
	
	include_once 'view/template.html';
	
	
	
	