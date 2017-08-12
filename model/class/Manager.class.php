<?php

//incluindo classe de conexao(abstrata)...
include_once 'Connect.class.php';

class Manager extends Connect{
	
	// Inserir em qualquer tabela
	public function insert_common($table, $data){
		//1º passo - Identificar a tabela...
		$query = "INSERT INTO `$table` ";
		
		//2ª passo - Identificar os campos...
		$fields = array_keys($data); //pego os indices do array
		$fields = "`".implode("`, `", $fields)."`";//string com os campos...
		$query .= "($fields) ";
		
		//3ª parte - Informar os valores
		$values = "'".implode("', '", $data)."'";
		$query .= "VALUES ($values);";
		
		//abre a conexao
		parent::open_con();
		
		//envia a query e guarda o resultado...
		$result = mysql_query($query, parent::get_con()) or die (mysql_error());

		//pegar o id que foi inserido...
		$id = mysql_insert_id();
		
		//fecha a conexao
		parent::close_con();
		
		// se nao der certo
		if($result != true){
			return false; //retorna falso(erro)
		}else{
			return $id; //se der certo: retorna o id que foi inserido
		}
	}
	
	// Selecionar em qualquer tabela
	public function select_common($table, $fields, $filters, $extra){
		
		### 1º passo - informar as colunas a serem seleciondas
		$query = "SELECT ";
		
		//testando se existem campos a serem selecionados... 
		if($fields != null){
			//se concatenaremos os mesmos a query...
			$fields = "`".implode("`, `", $fields)."`";
			$query .= $fields;
		}else{
			//ou todas as colunas...
			$query .= "* ";
		}
		
		$query .= " FROM";
		
		### 2º passo - informar a tabela
		$query .= "`$table`";
		
		### 3º passo - testa se existe filtro...
		//testa se existem filtros...
		if($filters != null){
			$query .= " WHERE ";
			
			//percorrendo o array de filtros para pegar key e value
			foreach($filters as $field=>$value){
				$query .= "`$field`='$value' AND ";
			}
			
			//removendo o ultimo "AND" da query...
			$query = substr($query, 0, -4);
		}
		
		### 4º passo - testa se existe comando extra...
		if($extra != null){
			$query .= " $extra;";
		}else{
			$query .= "";
		}
		
		### enviar, validar, e retornar dados...
		//abre a conexao
		parent::open_con();
		
		//envia e guarda o valor de retorno
		$result = mysql_query($query, parent::get_con()) or die(mysql_error());
		
		//teste se foi encontrado algum registro
		if(mysql_num_rows($result) > 0){
			
			//transporto todos os registro para o php...
			while($row = mysql_fetch_assoc($result)){
				$data_select[] = $row;
			}
			
			//fecha a conexao
			parent::close_con();
			//retornando os dados encontrados...
			return $data_select;
			
		}else{	
			//fecha a conexao
			parent::close_con();
			return false;
		}
		
	}
	
	// Atualizar em qualquer tabela
	public function update_common($table, $data, $filters){
		### 1º passo - identificar a tabela
		$query = "UPDATE `$table` SET ";

		### 2º passo - identificar os novos valores em seus campos
		foreach($data as $field=>$value){
			$query .= "`$field`='$value', ";
		}
		//removendo ultima virgula
		$query = substr($query, 0, -2);
		
		### 3º passo - identificar os filtros
		//testa se existem filtros...
		if($filters != null){
			$query .= " WHERE ";
			foreach($filters as $field=>$value){
				$query .= "`$field`='$value' AND ";
			}
			//remover o ultimo "AND"
			$query = substr($query, 0, -4);
		}
		
		//abre a conexao
		parent::open_con();
		
		//envio e guardo o retorno...
		$result = mysql_query($query, parent::get_con()) or die (mysql_error());
		
		//fecha a conexao
		parent::close_con();
		
		if($result == false){
			return false;
		}else{
			return true;
		}
	}
	
	// Remover de qualquer tabela
	public function delete_common($table, $filters){
		### 1º passo - identificar a tabela
		$query = "DELETE FROM `$table`";
		
		### 2º passo - informa os filtros(se existirem)
		//testa se existem filtros...
		if($filters != null){
			$query .= " WHERE ";
			
			//percorrendo os filtros e concatenando a query...
			foreach($filters as $field=>$value){
				$query .= "`$field`='$value' AND ";
			}
			
			//removendo o ultimo "AND"
			$query = substr($query, 0, -4);
		}
		
		//abre a conexao
		parent::open_con();
		
		//envio e guardo o retorno...
		$result = mysql_query($query, parent::get_con()) or die (mysql_error());
		
		//fecha a conexao
		parent::close_con();
		
		if($result == false){
			return false;
		}else{
			return true;
		}
		
	}
	
	public function select_special($tables, $relationships, $filters, $extra){
		$query = "SELECT ";
		
		### 1º passo - Identificar tabelas.campos...
		//percorrendo $tables para pegar o nome das tabelas
		foreach($tables as $tb_name=>$fields){
			//testo se o array de campos tem valores...
			if(empty($fields)){
				$query .= "`$tb_name`.*, ";
				
			}else{//se houverem campos a serem selecionados
				//vai buscar apenas os campos que informei...
				foreach($fields as $each_field){
					$query .= "`$tb_name`.`$each_field`, ";
				}
			}
		}
		
		//removendo a virgula que sobrou
		$query = substr($query, 0, -2);
		
		### 2º passo - identificar as tabelas
		$tb_names = array_keys($tables);
		$query .= " FROM ";
		$query .= implode(" INNER JOIN ", $tb_names);
		
		### 3º passo - identificar as relações...
		$query .= " ON ";
		foreach($relationships as $pk=>$fk){
			$pk = str_replace(".", "`.`", $pk);
			$fk = str_replace(".", "`.`", $fk);
			
			$query .= "`$pk`=`$fk` AND ";
		}
		//remover ultimo "AND"
		$query = substr($query, 0, -4);
		
		### 4º passo - indentificar os filtros
		//testa se existem filtros
		if($filters != null){
			$query .= " WHERE ";
			foreach($filters as $field=>$value){
				$query .= "`$field`='$value' AND ";
			}
			
			//removendo ultimo "AND"
			$query = substr($query, 0, -4);
		}
		
		### 5º passo - query extra
		if($extra != null){
			$query .= " $extra;";
		}else{
			$query .= ";";
		}
		
		### enviar, validar, e retornar dados...
		//abre a conexao
		parent::open_con();
		
		//envia e guarda o valor de retorno
		$result = mysql_query($query, parent::get_con()) or die(mysql_error());
		
		//teste se foi encontrado algum registro
		if(mysql_num_rows($result) > 0){
				
			//transporto todos os registro para o php...
			while($row = mysql_fetch_assoc($result)){
				$data_select[] = $row;
			}
				
			//fecha a conexao
			parent::close_con();
			//retornando os dados encontrados...
			return $data_select;
				
		}else{
			//fecha a conexao
			parent::close_con();
			return false;
		}
		
	}
	
	
	
	
	
}