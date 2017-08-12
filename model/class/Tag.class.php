<?php
	
	class Tag{
		
		public $tag_name;
		public $tag_properties = array(); //array de caracteristicas
		public $tag_content = array(); //array de content..
		
		
		// name da tag
		public function __construct($tag_name){
			$this->tag_name = $tag_name;
		}
		
		//atributos da tag
		public function __set($propertie_name, $propertie_value){
			$this->tag_properties[$propertie_name] = $propertie_value;
		}
		
		//content - pode ser outra tag, ou apenas texto
		public function add_content($content){
			$this->tag_content[] = $content; 
		}
		
		//open tag
		public function open_tag(){
			echo "<$this->tag_name ";
			
			if($this->tag_properties){
				//adicionar os atributos
				foreach($this->tag_properties as $name=>$value){
					echo "$name=\"$value\" ";
				}
			}
			
			echo ">";
			
		}
		
		//show_tag
		public function show_tag(){
			//open a tag
			$this->open_tag();
			
			if($this->tag_content){
				foreach($this->tag_content as $content){
					//testa se content é outra tag
					if(is_object($content)){
						$content->show_tag();
					}else{
						echo $content; //se for texto
					}
				}
			}
			//close a tag
			$this->close_tag();
		}
		
		//close_tag...
		public function close_tag(){
			echo "</$this->tag_name>";
		}
		
		
		
		
		
		
	}
	