<?php
class Car
{
    private $conn;
	private $table = 'car_registeration';
	private $table_2 = 'vehicle_status';

	//Car properties
	public $cr_id;
	public $mb_id;
	public $group_id;
	public $status;
	public $cr_number_classification;
	public $cr_registeration_number;
	public $cr_carname;
	public $cr_mac_address;
	public $cr_regdate;

    // Constructor with DB
    public function __construct($db) 
	{
      $this->conn = $db;
    }

    public function read()
	{
		$query = "SELECT * FROM car_registeration";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function group_show()
	{
		$query = "SELECT
		 `cr_id`, `mb_id`, `group_id`, `status`, `cr_number_classification`, `cr_registeration_number`, `cr_carname`,  `cr_mac_address`, `cr_regdate`
					FROM
						" . $this->table . " 
					WHERE
						mb_id='".$this->mb_id."' AND group_id='".$this->group_id."' AND status='".$this->status."'";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;

	}

	public function show()
	{
		$query = "SELECT * FROM car_registeration WHERE cr_id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->cr_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->cr_id = htmlspecialchars(strip_tags($row["cr_id"]));
		$this->mb_id = htmlspecialchars(strip_tags($row["mb_id"]));
		$this->group_id = htmlspecialchars(strip_tags($row["group_id"]));
		$this->status = htmlspecialchars(strip_tags($row["status"]));
		$this->cr_number_classification = htmlspecialchars(strip_tags($row["cr_number_classification"]));
		$this->cr_registeration_number = htmlspecialchars(strip_tags($row["cr_registeration_number"]));
		$this->cr_carname = htmlspecialchars(strip_tags($row["cr_carname"]));
		$this->cr_mac_address = htmlspecialchars(strip_tags($row["cr_mac_address"]));
		$this->cr_regdate = htmlspecialchars(strip_tags($row["cr_regdate"]));

	}

	public function create()
	{
		
		$query = "INSERT INTO car_registeration SET mb_id= :mb_id, group_id= :group_id, status= :status, cr_number_classification= :cr_number_classification, cr_registeration_number= :cr_registeration_number, 
					cr_carname= :cr_carname, cr_mac_address= :cr_mac_address, cr_regdate= :cr_regdate";
		$stmt = $this->conn->prepare($query);

		// $this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		$this->group_id = htmlspecialchars(strip_tags( $this->group_id));
		$this->status = htmlspecialchars(strip_tags( $this->status));
		$this->cr_number_classification = htmlspecialchars(strip_tags( $this->cr_number_classification));
		$this->cr_registeration_number = htmlspecialchars(strip_tags( $this->cr_registeration_number));
		$this->cr_carname = htmlspecialchars(strip_tags( $this->cr_carname));
		$this->cr_mac_address = htmlspecialchars(strip_tags( $this->cr_mac_address));
		$this->cr_regdate = htmlspecialchars(strip_tags( $this->cr_regdate));

		// $stmt->bindParam(':cr_id', $this->cr_id);
		$stmt->bindParam(':mb_id', $this->mb_id);
		$stmt->bindParam(':group_id', $this->group_id);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':cr_number_classification', $this->cr_number_classification);
		$stmt->bindParam(':cr_registeration_number', $this->cr_registeration_number);
		$stmt->bindParam(':cr_carname', $this->cr_carname);
		$stmt->bindParam(':cr_mac_address', $this->cr_mac_address);
		$stmt->bindParam(':cr_regdate', $this->cr_regdate);

		
		if($stmt->execute()) {
			//차량 등록요청후 cr_id 넘겨주자.
			$query = "SELECT 
					    `cr_id`
					FROM 
                        " . $this->table . " 
					WHERE 
                        cr_mac_address = '".$this->cr_mac_address."'
                    ORDER BY cr_regdate DESC";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row['cr_id'] == null) return false;
			$output = new stdClass();
			$output->cr_id = $row['cr_id'];

			return $output;
		}
		
		printf("Error %s.\n", $stmt->error);
		return false;
	}

	public function update()
	{
		
		$query = "UPDATE car_registeration SET mb_id= :mb_id, group_id= :group_id, status= :status, cr_number_classification= :cr_number_classification, cr_registeration_number= :cr_registeration_number, 
					cr_carname= :cr_carname, cr_mac_address= :cr_mac_address, cr_regdate= :cr_regdate
					WHERE cr_id = :cr_id";

		$stmt = $this->conn->prepare($query);
        
		$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		$this->group_id = htmlspecialchars(strip_tags( $this->group_id));
		$this->status = htmlspecialchars(strip_tags( $this->status));
		$this->cr_number_classification = htmlspecialchars(strip_tags( $this->cr_number_classification));
		$this->cr_registeration_number = htmlspecialchars(strip_tags( $this->cr_registeration_number));
		$this->cr_carname = htmlspecialchars(strip_tags( $this->cr_carname));
		$this->cr_mac_address = htmlspecialchars(strip_tags( $this->cr_mac_address));
		$this->cr_regdate = htmlspecialchars(strip_tags( $this->cr_regdate));
        $this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
        
		$stmt->bindParam(':mb_id', $this->mb_id);
		$stmt->bindParam(':group_id', $this->group_id);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':cr_number_classification', $this->cr_number_classification);
		$stmt->bindParam(':cr_registeration_number', $this->cr_registeration_number);
		$stmt->bindParam(':cr_carname', $this->cr_carname);
		$stmt->bindParam(':cr_mac_address', $this->cr_mac_address);
		$stmt->bindParam(':cr_regdate', $this->cr_regdate);
        $stmt->bindParam(':cr_id', $this->cr_id);
        
		
		if($stmt->execute()) {
			
			return true;
		}
		
		printf("Error %s.\n", $stmt->error);
		return false;
	}

	public function delete()
	{
		// Create query
		$query = 'DELETE FROM car_registeration WHERE cr_id = :cr_id';
		// Prepare Statement
		$stmt = $this->conn->prepare($query);
		// clean data
		$this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		// Bind Data
		$stmt-> bindParam(':cr_id', $this->cr_id);
		// Execute query
		if($stmt->execute()) {
		  return true;
		}
		// Print error if something goes wrong
		printf("Error: $s.\n", $stmt->error);
	
		return false;
	}

	//차량 등록해제 요청 api
	public function registration_delete_request()
	{
		$query = "SELECT 
					    `cr_id`
					FROM 
                        " . $this->table . " 
					WHERE 
                        mb_id= '".$this->mb_id."' AND cr_mac_address = '".$this->cr_mac_address."'
                    ORDER BY cr_regdate DESC";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row['cr_id'] == null) return false;
			$output = new stdClass();
			$output->cr_id = $row['cr_id'];

			return $output;
	}

	//차량 맥주소로 삭제 요청 api
	public function macaddress_delete()
	{
		//존재하는지 한번더 예외처리
		$query = "SELECT 
					    `cr_id`
					FROM 
                        " . $this->table . " 
					WHERE 
						cr_mac_address= '".$this->cr_mac_address."'
                    ORDER BY cr_regdate DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row['cr_id'] == null) return false;


		 // Create query
		 $query = 'DELETE FROM ' . $this->table . ' WHERE cr_mac_address = :cr_mac_address';

		 // Prepare Statement
		 $stmt = $this->conn->prepare($query);
	 
		 // clean data
		 $this->cr_mac_address = htmlspecialchars(strip_tags($this->cr_mac_address));
		 
		 // Bind Data
		 $stmt-> bindParam(':cr_mac_address', $this->cr_mac_address);

		 // Execute query
		 
		 if($stmt->execute())
		 {
		   return true;
		 }
	 
		 // Print error if something goes wrong
		 printf("Error: $s.\n", $stmt->error);
	 
		 return false;
	}

	//차량 등록해제 요청후 -> 제거 성공 api
	public function registration_delete()
	{
		//존재하는지 한번더 예외처리
		$query = "SELECT 
					    `cr_mac_address`
					FROM 
                        " . $this->table . " 
					WHERE 
                        cr_id= '".$this->cr_id."' AND mb_id = '".$this->mb_id."'
                    ORDER BY cr_regdate DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row['cr_mac_address'] == null) return false;


		 // Create query
		 $query = 'DELETE FROM ' . $this->table . ' WHERE cr_id = :cr_id AND mb_id = :mb_id';

		 // Prepare Statement
		 $stmt = $this->conn->prepare($query);
	 
		 // clean data
		 $this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		 $this->mb_id = htmlspecialchars(strip_tags($this->mb_id));
		 // Bind Data
		 $stmt-> bindParam(':cr_id', $this->cr_id);
		 $stmt-> bindParam(':mb_id', $this->mb_id);
		 // Execute query
		 
		 if($stmt->execute())
		 {
		   return true;
		 }
	 
		 // Print error if something goes wrong
		 printf("Error: $s.\n", $stmt->error);
	 
		 return false;

	}

	// 2022-08-28 현재 차량이 켜질수있는지 아니면 다른사람이 타고있는지 체크
	public function vehicle_condition()
	{
		$vehicle_condition = 'off';

		$query = "SELECT
			`vs_startup_information`, `cr_id`, `member`
					FROM
						" . $this->table_2 . " 
					WHERE
						cr_id='".$this->cr_id."'
					ORDER BY vs_regdate DESC
					LIMIT 0, 1";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!$row['vs_startup_information'])
		{
			$output = new stdClass();
			$output->message = '차량시동상태를 걸어주세요.';

			return $output;
		}

		if($row['vs_startup_information'] != 'off') 
		{
			$output = new stdClass();
			$output->message = '시동중';
			return $output;
		}

		$output = new stdClass();
		$output->vs_startup_information = $row['vs_startup_information'];
		$output->cr_id = $row['cr_id'];
		$output->member = $row['member'];
		$output->message = '시동가능';
		return $output;
	}

}

?>