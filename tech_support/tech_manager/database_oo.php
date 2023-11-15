<?php
class Database
{
	private $dsn, $username, $password;
	
	public function __construct() {
		$this->dsn = 'mysql:host=localhost;dbname=tech_support';
		$this->username = 'ts_user';
		$this->password = 'pa55word';
		
	}
	
	public function connect() {
    
	try {
        $db = new PDO($this->dsn, $this->username, $this->password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
	return $db;
	}
}
?>