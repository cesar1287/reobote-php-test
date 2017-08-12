<?php
//classe abstrata para controle da conexao...
abstract class Connect{
	private $db_host; //servidor onde está o banco de dados 
	private $db_user; //usuario do banco de dados
	private $db_password; //senha do usuario do banco de dados
	private $db_name; //nome do banco de dados
	
	private $con; //link da conexao que sera realizada...
	
	//construtor da classe Connect...
	public function __construct($db_host, $db_user, $db_password, $db_name){
		$this->db_host = $db_host;
		$this->db_user = $db_user;
		$this->db_password = $db_password;
		$this->db_name = $db_name;
	}
	
	//abrir a conexao e selecionar o banco de dados...
	public function open_con(){
		//conectar ao MySQL...
		$this->con = mysql_connect($this->db_host, $this->db_user, $this->db_password) or die (mysql_error());

		//seleciono o banco de dados a ser usado
		mysql_select_db($this->db_name, $this->con) or die (mysql_error());
	}
	
	//pegar a conexao... usar...
	public function get_con(){
		return $this->con;
	}
	
	//fechar a conexao...
	public function close_con(){
		mysql_close($this->con);
	}
}