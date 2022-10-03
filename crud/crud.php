<?php

class Database{
	
	private $conn = false; // Check to see if the connection is active
	private $db; 
	
	// Function to make connection to database
	public function connect(){
		if(!$this->conn){
			$connection = file_get_contents('../DB/DB.json');  
            $this->db = json_decode($connection);
            if($this->db){
            	return true; 
            }else{
                return false; // Problem connecting return FALSE
            }  
        }else{  
            return true; // Connection has already been made return TRUE 
        }  	
	}
	
	// Function to SELECT from the database
	public function select_login($login, $password){
		foreach ($this->db as $key => $obj){
			if ($obj->login == $login || $obj->password == $password) {
				return $obj;
			} else {
				return false;
			}
		}
    }

	public function select_register($login, $email){
		foreach ($this->db as $key => $obj) {
			if ($obj->login == $login) {
				return 'login';
			}
			elseif ($obj->email == $email) {
				return 'email';
			}
		}
    }
	
	// Function to insert into the database
    public function insert($login, $password, $name, $email){
		$user = (object)[
			"name" => $name,
			"login" => $login,
			"email" => $email,
			"password" => $password,
		];
		$this->db[] = $user;
		$json = json_encode($this->db); 
		file_put_contents('../DB/DB.json', $json);
    }
} 