<?php
//connect database by PDO
class db
{
	private $servername = "ec2-13-56-94-107.us-west-1.compute.amazonaws.com";
	private $username = "root";
	private $password = "kcsghkdlxld";
	private $db = "kcs_schema";
	
	private $mysqli = "";
    private $result = array();
    // private $conn = false;

	//데이터베이스 연결
	public function connect()
	{
		$this->conn = null;
		try{
			$this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->db."", $this->username, $this->password, array(
			    PDO::ATTR_PERSISTENT => true
			));
			// set the PDO error mode to exception
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connected successfully";

		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
		return $this->conn;
	}

	//connect database using consturcted method
    // public function __construct()
    // {
    //     if (!$this->conn) {
    //         $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->db);
    //         $this->conn = true;

    //         if ($this->mysqli->connect_error) {
    //             array_push($this->result, $this->mysqli_connection_error);
    //             return false;
    //         }
    //     } else {
    //         return true;
    //     }
    // }

	// public function select($table, $row = "*", $join = null, $where = null, $order = null, $limit = null)
    // {
    //     if ($this->tableExist($table)) {
    //         $sql = "SELECT $row FROM $table";
    //         if ($join != null) {
    //             $sql .= " JOIN $join";
    //         }
    //         if ($where != null) {
    //             $sql .= " WHERE $where";
    //         }
    //         if ($order != null) {
    //             $sql .= " ORDER BY $order";
    //         }
    //         if ($limit != null) {
    //             $sql .= " LIMIT $limit";
    //         }
    //         $query = $this->mysqli->query($sql);
    //         if ($query) {
    //             $this->result = $query->fetch_all(MYSQLI_ASSOC);
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

	// // get result
    // public function getResult()
    // {
    //     $val = $this->result;
    //     $this->result = array();
    //     return $val;
    // }

}

?>