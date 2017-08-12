<?php

function validate_success(){
	// se nao houver requisição de erro retorna sem executar
	// o restante da função
	if(!isset($_GET['success'])){
		return false;
	}
	
	//vai analisar cada opção de erro
	switch($_GET['success']){
		case "user_insert":
			$alert_class = "success";
			$alert_title = "Usuário Inserido com sucesso!!!";
			$alert_text = "A nova contra foi criada e já pode ser colocada em uso!";
	

			//incluir o alert...
			break;
		case "update_ok":
			$alert_class = "success";
			$alert_title = "Usuário atualizado com sucesso!!!";
			$alert_text = "A nova contra foi atualizada!";
		
		
			//incluir o alert...
			break;
		case "delete_ok":
			$alert_class = "success";
			$alert_title = "Registro excluído!";
			$alert_text = "Os dados não se encontram disponíveis";
		break;
		//
			
	}
	
	include_once ($GLOBALS['project_path'].'/view/alert.html');
}

function validate_error(){
	
	// se nao houver requisição de erro retorna sem executar
	// o restante da função
	if(!isset($_GET['error'])){
		return false;
	}
	
	//vai analisar cada opção de erro
	switch($_GET['error']){
		case "user_not_found":
			$alert_class = "danger";
			$alert_title = "Usuário não encontrado!!!";
			$alert_text = "O email informado está inválido ou não se encontra no banco de dados!";
	
			//incluir o alert...
			break;
		
		case "password_incorrect":
			$alert_class = "danger";
			$alert_title = "Senha Incorreta!!!";
			$alert_text = "A senha informada não corresponde ao email informado!!!";
			break;
			
		case "delete":
			
			$alert_class = "danger";
			$alert_title = "Erro ao Excluir";
			$alert_text = "Ocorreu algum erro ao tentar excluir o registro!";
			
			break;
	}
	
	include_once ($GLOBALS['project_path'].'/view/alert.html');
}
?>