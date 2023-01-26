<?php
class Invite_code
{
    private $conn;
	private $table = 'invite_code';
    //invite_code properties
    public $ic_id;
    public $mb_id;
    public $group_id;
    public $status;
    public $ic_number;
    public $ic_regdate;

    // Constructor with DB
    public function __construct($db) 
	{
      $this->conn = $db;
    }

	public function read()
	{
		$query = "SELECT * FROM invite_code";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

    public function show()
	{
		$query = "SELECT * FROM invite_code WHERE mb_id = ? ORDER BY ic_regdate DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->mb_id);
		$stmt->execute();
        return $stmt;
		// $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// $this->ic_id = htmlspecialchars(strip_tags($row["ic_id"]));
		// $this->mb_id = htmlspecialchars(strip_tags($row["mb_id"]));
        // $this->group_id = htmlspecialchars(strip_tags($row["group_id"]));
        // $this->status = htmlspecialchars(strip_tags($row["status"]));
        // $this->ic_number = htmlspecialchars(strip_tags($row["ic_number"]));
		// $this->ic_regdate = htmlspecialchars(strip_tags($row["ic_regdate"]));

	}

    public function create()
    {
        $query = "INSERT INTO invite_code SET mb_id= :mb_id, group_id= :group_id, status= :status, ic_number= :ic_number, ic_regdate= :ic_regdate";
		$stmt = $this->conn->prepare($query);

		$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		$this->group_id = htmlspecialchars(strip_tags($this->group_id));
		$this->status = htmlspecialchars(strip_tags( $this->status));
		$this->ic_number = htmlspecialchars(strip_tags( $this->ic_number));
		$this->ic_regdate = htmlspecialchars(strip_tags( $this->ic_regdate));

		$stmt->bindParam(':mb_id', $this->mb_id);
		$stmt->bindParam(':group_id', $this->group_id);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':ic_number', $this->ic_number);
		$stmt->bindParam(':ic_regdate', $this->ic_regdate);

		
		if($stmt->execute()) {
			
			return true;
		}
		
		printf("Error %s.\n", $stmt->error);
		return false;

    }

	// public function check_invite_code($ic_number)
	// {
	
	// 	$query = "SELECT 
	// 				`ic_id`, `mb_id`, `group_id`, `status`, `ic_number`, `ic_regdate`
	// 				FROM 
    //                     invite_code
	// 				WHERE 
    //                     ic_number = '".$this->ic_number."'
    //                 ORDER BY ic_regdate DESC";
	// 	$stmt = $this->conn->prepare($query);
	// 	$stmt->execute();

    //     $output = $stmt->fetch(PDO::FETCH_ASSOC);
	
	// 	return $output;
	// }



}

?>