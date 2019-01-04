<?php

	

	class Database
	{

		private $hostdb = "localhost";
		private $userdb = "";
		private $passdb = "";
		private $namedb = "social";
		private $pdo;
		private $datacheck;


		public function __construct(){

			$this->connectDB(); // when ever object is created connectDB function will auto run and db connection will be established
		}




		private function connectDB() //db connection function
		{
			if (!isset($this->pdo)) {
				try {
					
					$link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb,$this->userdb,$this->passdb); // connecting database
					$link -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // for exception 
					$link -> exec("SET CHARACTER SET utf8"); // setting up the character set
					$this->pdo = $link; // putting connection to a private property
					return $this->pdo;

				} catch (PDOException $e) {
					
					die("Failed to connect with Database".$e->getMessage()); // showing error message while failed to connect with database

				}
			}
		}


/*
		public function escaping($datainput){

			$this->datacheck = $this->pdo-> quote($datainput);								
			
			return $this->datacheck;

		}
*/



		//for basic select query multiple row
		public function select($query,$params = array()){

			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		//for basic select query single row
		public function select_one_row($query,$params = array()){

			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		//for basic insert query
		public function insert($query,$params = array()){

			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);

			return true;

		}
		//for basic update query

		public function update($query,$params = array()){

			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);

			return true;
		}

		public function delete($query,$params = array()){

			$stmt = $this->pdo->prepare($query);
			
			if ($stmt->execute($params)) {
				return true;
			}else{
				return false;
			}

		} 
















	}


?>