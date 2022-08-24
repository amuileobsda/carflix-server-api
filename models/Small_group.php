<?php
class Small_group
{
    private $conn;
	private $table = 'small_group';

	//small_group properties
	public $sg_id;
	public $mb_id;
	public $sg_title;
	public $sg_description;
	public $status;
	public $sg_regdate;

    // Constructor with DB
    public function __construct($db) 
	{
      $this->conn = $db;
    }

    public function read()
	{
		$query = "SELECT * FROM small_group";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function group_info()
	{
		$query = "SELECT 
					`sg_id`, `mb_id`, `sg_title`, `sg_description`, `status`, `sg_admin`, `sg_regdate` 
					FROM 
						" . $this->table . "  
					WHERE 
						mb_id = '".$this->mb_id."'";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	public function show()
	{
		$query = "SELECT * FROM small_group WHERE sg_id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->sg_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->sg_id = htmlspecialchars(strip_tags($row["sg_id"]));
		$this->mb_id = htmlspecialchars(strip_tags($row["mb_id"]));
		$this->sg_title = htmlspecialchars(strip_tags($row["sg_title"]));
		$this->sg_description = htmlspecialchars(strip_tags($row["sg_description"]));
		$this->status = htmlspecialchars(strip_tags($row["status"]));
		$this->sg_admin = htmlspecialchars(strip_tags($row["sg_admin"]));
		$this->sg_regdate = htmlspecialchars(strip_tags($row["sg_regdate"]));

	}

	public function create()
	{
		// echo "잘실행되고있다.";
		$query = "INSERT INTO small_group SET mb_id= :mb_id, sg_title= :sg_title, sg_description= :sg_description, status= :status, sg_regdate= :sg_regdate";
		$stmt = $this->conn->prepare($query);

		// $this->sg_id = htmlspecialchars(strip_tags($this->sg_id));
		$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		$this->sg_title = htmlspecialchars(strip_tags( $this->sg_title));
		$this->sg_description = htmlspecialchars(strip_tags( $this->sg_description));
		$this->status = htmlspecialchars(strip_tags( $this->status));
		$this->sg_regdate = htmlspecialchars(strip_tags( $this->sg_regdate));

		// $stmt->bindParam(':sg_id', $this->sg_id);
		$stmt->bindParam(':mb_id', $this->mb_id);
		$stmt->bindParam(':sg_title', $this->sg_title);
		$stmt->bindParam(':sg_description', $this->sg_description);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':sg_regdate', $this->sg_regdate);

		// echo "잘실행되고있다.";
		if($stmt->execute()) {
			// echo "잘실행되고있다.";
			return true;
		}
		// echo "왜 여기로 넘어와?.";
		printf("Error %s.\n", $stmt->error);
		return false;
	}

	public function update()
	{
		// echo "잘실행되고있다.";
		$query = "UPDATE small_group SET mb_id= :mb_id, sg_title= :sg_title, sg_description= :sg_description, status= :status, sg_regdate= :sg_regdate
					WHERE sg_id = :sg_id";

		$stmt = $this->conn->prepare($query);
        
		$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		$this->sg_title = htmlspecialchars(strip_tags( $this->sg_title));
		$this->sg_description = htmlspecialchars(strip_tags( $this->sg_description));
		$this->status = htmlspecialchars(strip_tags( $this->status));
		$this->sg_regdate = htmlspecialchars(strip_tags( $this->sg_regdate));
        $this->sg_id = htmlspecialchars(strip_tags($this->sg_id));
        
		$stmt->bindParam(':mb_id', $this->mb_id);
		$stmt->bindParam(':sg_title', $this->sg_title);
		$stmt->bindParam(':sg_description', $this->sg_description);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':sg_regdate', $this->sg_regdate);
		$stmt->bindParam(':sg_id', $this->sg_id);
        
		// echo "잘실행되고있다.";
		if($stmt->execute()) {
			// echo "잘실행되고있다.";
			return true;
		}
		// echo "왜 여기로 넘어와?.";
		printf("Error %s.\n", $stmt->error);
		return false;
	}

	public function delete()
	{
		// Create query
		$query = 'DELETE FROM small_group WHERE sg_id = :sg_id';
		// Prepare Statement
		$stmt = $this->conn->prepare($query);
		// clean data
		$this->sg_id = htmlspecialchars(strip_tags($this->sg_id));
		// Bind Data
		$stmt-> bindParam(':sg_id', $this->sg_id);
		// Execute query
		if($stmt->execute()) {
		  return true;
		}
		// Print error if something goes wrong
		printf("Error: $s.\n", $stmt->error);
	
		return false;
	}


}

?>