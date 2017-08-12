<?php 

//o arquivo que possui os caminhos...
include_once 'model/urls.php';

//arquivo de validação
include_once 'controller/validate.php';

### testar se existe usuario logado...
//startar a sessao
session_start();

//se existir ele redireciona pra pagina "user.php"
if(isset($_SESSION['user_on'])){
	header("location: user.php");
}


//titulo da pagina...
$page_title = "Página Inicial";

//conteudo da pagina...
function page_content(){
	//chamando funções de validação...
	validate_error();
	validate_success();
	
	
	### incluir o modal de cadastro/login...
	$modal_id = "login_add_user";
	$modal_title = "Login / Cadastro";
	$modal_text = "";
	$modal_file = $GLOBALS['project_path']."/view/tabs.html";
	
	include_once 'view/modal.html';
	#########################################
	
	
	echo '<h4>Teste Projeto</h4>
	</br>
	Desenvolver uma aplicação com autenticação de usuários.
	</br></br>
	<h4>Requisitos</h4>
	</br>
	Back-end
	</br></br>
	CRUD de Usuários
	</br></br>
	Criar um gerenciamento aonde seja possível Criar, Listar, Editar e Visualizar um Usuário.
	</br></br>
	Atributos de um Usuário são:
	</br></br>
		nome
		</br>
		email
		</br>
		senha
		</br>
		data de nascimento
	</br></br>
	<h4>Front-end</h4>
	</br>
	Login / Cadastro
	</br></br>
		Formulário de login deve ser email e senha
		</br>
		Formulário de cadastro deve ser obrigatório apenas nome, email e senha
		</br></br>
	<h4>Home</h4>
	</br>
		A listagem dos usuários deve ser realizado na página inicial, com paginação, trazendo os usuários mais recentes primeiro.
		</br>
		Ao clicar no usuário redirecionar para uma página que carregue todos os dados do mesmo, exceto senha';
}

include_once 'view/template.html';

?>