<?php

class Model{

		
	static $connections = array();

	public $table = false;
	public $db = 'default';
	public $current_db;
	public $primaryKey='id';

	 public function __construct(){
		
		//initialisations
			if($this->table === false){
			$this->table = strtolower(get_class($this)).'s';	
		}

		//connexion BDD

		$db = Conf::$databases[$this->db];


		if(isset(Model::$connections[$this->db])){
			$this->current_db = Model::$connections[$this->db];
			return true;
		}

		try{
			$mysqli = (mysqli_connect($db['host'],
									$db['login'],
									$db['password'],
									$db['dbname']
				) or die ("could not connect to mysql"));

			Model::$connections = $mysqli;
			$this->current_db = $mysqli;		

		}
		catch(MYSQLException $e){
				die($e->getMessage());
			}	
		}




	public function find($req){
		$sql = 'SELECT';

		if(isset($req['fields'])){
			if (is_array($req['fields'])) {
				$sql .=implode(',', $$req['fields']);			
			}else{
				$sql .= $req['fields'];
			}
		}else{
			$sql .='*';
		}

		$sql .= 'FROM '.$this->table;


		//construction de la condition
		if(isset($req['conditions'])){
			$sql .= ' WHERE ';
			if(!is_array($req['conditions'])){
				$sql .= $req['conditions'];
			}else{
				$cond = array();
				foreach ($req['conditions'] as $key => $value) {
					if(!is_numeric($value)){
						$value = "'".mysql_real_escape_string($value)."'";
					}					
					$cond[] = "$key = $value";
				}
				$sql .= implode(' AND ', $cond);
			}
		}

		if(isset($req['limit'])){
			$sql .= ' LIMIT '.$req['limit'];
			
		}

		
		// print_r(Model::$connections[$this->current_db]);

		$pre = mysqli_query($this->current_db,$sql);

		$r= mysqli_fetch_assoc($pre);
		return $r;

		
	}

	public function findFirst($req){

	return current($this->find($req));
	}

	public function FindCount($conditions){
		$res=$this->FindFirst(array(
			'fields'=> 'count('.$this->primaryKey.') as count',
			'conditions'=> $conditions
			));
		return $res->count();
	}

	public function delete($id){
		$sql = "DELETE FORM {$this->table} WHERE {$this->primaryKey} = $id ";
		$this->current_db->query($sql);
	}

	public function save($data){
		$key = $this->primaryKey;
		$fields = array();
		$d = array();
		if(isset($data->$key)) unset($data->$key);
		foreach($data as $k=>$v){
			$fields[] .= " $k=:$k";
			$d[":$k"] = $v;
		}
		if(isset($data->$key) && !empty($data->$key)){
			$sql = ' UPDATE '.$this->table.' SET '.implode(',',$fields).'WHERE'.$key.'='.$key;
			$this->id = $data->$key;
			
		} else{			
			$sql = ' INSERT INTO '.$this->table.' SET '.implode(',',$fields);
			$this->id = $data->$key;
		}
				
		$pre = mysqli_query($this->current_db,$sql);

		$r= mysqli_fetch_assoc($pre);
		return $r;
		// $pre->execute($d);	
	} 

} 

?>