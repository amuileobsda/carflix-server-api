<?php
class Vehicle_status
{
    private $conn;
	private $table = 'vehicle_status';
	private $table_2 = 'car_registeration';
	//vehicle_status properties
	public $vs_id;
	public $vs_startup_information;
	public $cr_id;
	public $member;
	public $vs_authentication_value;
	public $vs_latitude;
	public $vs_longitude;
	public $vs_regdate;

    // Constructor with DB
    public function __construct($db) 
	{
      $this->conn = $db;
    }

    // public function read()
	// {
	// 	$query = "SELECT * FROM car_registeration";
	// 	$stmt = $this->conn->prepare($query);
	// 	$stmt->execute();
	// 	return $stmt;
	// }

	public function show()
	{
		$query = "SELECT
		 `vs_id`, `vs_startup_information`, `cr_id`, `member`, `vs_authentication_value`, `vs_latitude`, `vs_longitude`, `vs_regdate`
					FROM
						" . $this->table . " 
					WHERE
						cr_id='".$this->cr_id."' 
					ORDER BY vs_regdate DESC
					LIMIT 0, 120";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	// 2022-08-28 현재 차량이 켜질수있는지 아니면 다른사람이 타고있는지 체크
	public function vehicle_condition()
	{
		$vehicle_condition = 'off';

		$query = "SELECT
		 	`vs_startup_information`, `cr_id`, `member`
					FROM
						" . $this->table . " 
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


	// 시동상태 전송
	public function boot_status()
	{
		// Create query
		$query = 'INSERT INTO ' . $this->table . ' SET vs_startup_information = :vs_startup_information, cr_id = :cr_id, member = :member, vs_authentication_value = :vs_authentication_value, vs_latitude = :vs_latitude, vs_longitude = :vs_longitude, vs_regdate = :vs_regdate';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->vs_startup_information = htmlspecialchars(strip_tags($this->vs_startup_information));
		$this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		$this->member = htmlspecialchars(strip_tags($this->member));
		$this->vs_authentication_value = htmlspecialchars(strip_tags($this->vs_authentication_value));
		$this->vs_latitude = htmlspecialchars(strip_tags($this->vs_latitude));
		$this->vs_longitude = htmlspecialchars(strip_tags($this->vs_longitude));
		$this->vs_regdate = htmlspecialchars(strip_tags($this->vs_regdate));
		// Bind data
		$stmt->bindParam(':vs_startup_information', $this->vs_startup_information);
		$stmt->bindParam(':cr_id', $this->cr_id);
		$stmt->bindParam(':member', $this->member);
		$stmt->bindParam(':vs_authentication_value', $this->vs_authentication_value);
		$stmt->bindParam(':vs_latitude', $this->vs_latitude);
		$stmt->bindParam(':vs_longitude', $this->vs_longitude);
		$stmt->bindParam(':vs_regdate', $this->vs_regdate);

		// Execute query
		if($stmt->execute()) {
		  return true;
		}
	}

	// 시동꺼짐 정보전송
	public function boot_off()
	{
		// Create query
		$query = 'INSERT INTO ' . $this->table . ' SET vs_startup_information = :vs_startup_information, cr_id = :cr_id, member = :member, vs_authentication_value = :vs_authentication_value, vs_latitude = :vs_latitude, vs_longitude = :vs_longitude, vs_regdate = :vs_regdate';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->vs_startup_information = htmlspecialchars(strip_tags($this->vs_startup_information));
		$this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		$this->member = htmlspecialchars(strip_tags($this->member));
		$this->vs_authentication_value = htmlspecialchars(strip_tags($this->vs_authentication_value));
		$this->vs_latitude = htmlspecialchars(strip_tags($this->vs_latitude));
		$this->vs_longitude = htmlspecialchars(strip_tags($this->vs_longitude));
		$this->vs_regdate = htmlspecialchars(strip_tags($this->vs_regdate));
		// Bind data
		$stmt->bindParam(':vs_startup_information', $this->vs_startup_information);
		$stmt->bindParam(':cr_id', $this->cr_id);
		$stmt->bindParam(':member', $this->member);
		$stmt->bindParam(':vs_authentication_value', $this->vs_authentication_value);
		$stmt->bindParam(':vs_latitude', $this->vs_latitude);
		$stmt->bindParam(':vs_longitude', $this->vs_longitude);
		$stmt->bindParam(':vs_regdate', $this->vs_regdate);

		// Execute query
		if($stmt->execute()) {
		  return true;
		}
	}

	// 아두이노에 문제있을때
	public function connection_status()
	{
		// Create query
		$query = 'INSERT INTO ' . $this->table . ' SET vs_startup_information = :vs_startup_information, cr_id = :cr_id, member = :member, vs_authentication_value = :vs_authentication_value, vs_latitude = :vs_latitude, vs_longitude = :vs_longitude, vs_regdate = :vs_regdate';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->vs_startup_information = htmlspecialchars(strip_tags($this->vs_startup_information));
		$this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		$this->member = htmlspecialchars(strip_tags($this->member));
		$this->vs_authentication_value = htmlspecialchars(strip_tags($this->vs_authentication_value));
		$this->vs_latitude = htmlspecialchars(strip_tags($this->vs_latitude));
		$this->vs_longitude = htmlspecialchars(strip_tags($this->vs_longitude));
		$this->vs_regdate = htmlspecialchars(strip_tags($this->vs_regdate));
		// Bind data
		$stmt->bindParam(':vs_startup_information', $this->vs_startup_information);
		$stmt->bindParam(':cr_id', $this->cr_id);
		$stmt->bindParam(':member', $this->member);
		$stmt->bindParam(':vs_authentication_value', $this->vs_authentication_value);
		$stmt->bindParam(':vs_latitude', $this->vs_latitude);
		$stmt->bindParam(':vs_longitude', $this->vs_longitude);
		$stmt->bindParam(':vs_regdate', $this->vs_regdate);

		// Execute query
		if($stmt->execute()) {
		  return true;
		}
	}

	//시동요청이 올바른가 api
	//이거 살짝 잘못만든거같은데 ? 아닌가?
	//2022.08.23
	public function start_request_check()
	{
		// echo "어디가문제야>?";
		//car_registeration 테이블에서 확인
		$query = "SELECT
		 				`cr_id`
					FROM
						" . $this->table_2 . " 
					WHERE
						cr_id='".$this->cr_id."'
					ORDER BY cr_regdate DESC";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row['cr_id'] == null) return false;

		// echo "어디가문제야>?";
		$vs_startup_information = 'on';
		$member = $this->mb_id;
		$vs_authentication_value = '';
		$vs_latitude = '';
		$vs_longitude = '';
		$now = new DateTime();
    	$objDateTime = $now->format('Y-m-d H:i:s');
		// echo "어디가문제야>?";
		//검증됐으니 vehicle_status 테이블로 가서 저장해둔다.
		// Create query
		$query = 'INSERT INTO ' . $this->table . ' SET vs_startup_information = :vs_startup_information, cr_id = :cr_id, member = :member, vs_authentication_value = :vs_authentication_value, vs_latitude = :vs_latitude, vs_longitude = :vs_longitude, vs_regdate = :vs_regdate';

		// Prepare statement
		$stmt = $this->conn->prepare($query);
		// echo "어디가문제야>?";
		// Clean data
		$vs_startup_information = htmlspecialchars(strip_tags($vs_startup_information));
		$this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		$member = htmlspecialchars(strip_tags($member));
		$vs_authentication_value = htmlspecialchars(strip_tags($vs_authentication_value));
		$vs_latitude = htmlspecialchars(strip_tags($vs_latitude));
		$vs_longitude = htmlspecialchars(strip_tags($vs_longitude));
		$objDateTime = htmlspecialchars(strip_tags($objDateTime));
		// Bind data
		$stmt->bindParam(':vs_startup_information', $vs_startup_information);
		$stmt->bindParam(':cr_id', $this->cr_id);
		$stmt->bindParam(':member', $member);
		$stmt->bindParam(':vs_authentication_value', $vs_authentication_value);
		$stmt->bindParam(':vs_latitude', $vs_latitude);
		$stmt->bindParam(':vs_longitude', $vs_longitude);
		$stmt->bindParam(':vs_regdate', $objDateTime);
		$stmt->execute();
		// echo "어디가문제야>?";
		//vehicle_status 테이블에서 확인
		$query_2 = "SELECT
		 				`vs_id`
					FROM
						" . $this->table . " 
					WHERE
						cr_id='".$this->cr_id."' AND member='".$this->mb_id."' 
					ORDER BY vs_regdate DESC";
		// prepare query statement
		$stmt = $this->conn->prepare($query_2);
		// execute query
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$output = new stdClass();
		$output->vs_id = $row['vs_id'];
		return $output;

	}

	public function lock()
	{
		// Create query
		$query = 'INSERT INTO ' . $this->table . ' SET vs_startup_information = :vs_startup_information, cr_id = :cr_id, member = :member, vs_authentication_value = :vs_authentication_value, vs_latitude = :vs_latitude, vs_longitude = :vs_longitude, vs_regdate = :vs_regdate';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Clean data
		$this->vs_startup_information = htmlspecialchars(strip_tags($this->vs_startup_information));
		$this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		$this->member = htmlspecialchars(strip_tags($this->member));
		$this->vs_authentication_value = htmlspecialchars(strip_tags($this->vs_authentication_value));
		$this->vs_latitude = htmlspecialchars(strip_tags($this->vs_latitude));
		$this->vs_longitude = htmlspecialchars(strip_tags($this->vs_longitude));
		$this->vs_regdate = htmlspecialchars(strip_tags($this->vs_regdate));
		// Bind data
		$stmt->bindParam(':vs_startup_information', $this->vs_startup_information);
		$stmt->bindParam(':cr_id', $this->cr_id);
		$stmt->bindParam(':member', $this->member);
		$stmt->bindParam(':vs_authentication_value', $this->vs_authentication_value);
		$stmt->bindParam(':vs_latitude', $this->vs_latitude);
		$stmt->bindParam(':vs_longitude', $this->vs_longitude);
		$stmt->bindParam(':vs_regdate', $this->vs_regdate);

		// Execute query
		if($stmt->execute()) {
		  return true;
		}
	}

	public function unlock()
	{
		// Create query
		$query = 'INSERT INTO ' . $this->table . ' SET vs_startup_information = :vs_startup_information, cr_id = :cr_id, member = :member, vs_authentication_value = :vs_authentication_value, vs_latitude = :vs_latitude, vs_longitude = :vs_longitude, vs_regdate = :vs_regdate';

		// Prepare statement
		$stmt = $this->conn->prepare($query);
		
		// Clean data
		$this->vs_startup_information = htmlspecialchars(strip_tags($this->vs_startup_information));
		$this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		$this->member = htmlspecialchars(strip_tags($this->member));
		$this->vs_authentication_value = htmlspecialchars(strip_tags($this->vs_authentication_value));
		$this->vs_latitude = htmlspecialchars(strip_tags($this->vs_latitude));
		$this->vs_longitude = htmlspecialchars(strip_tags($this->vs_longitude));
		$this->vs_regdate = htmlspecialchars(strip_tags($this->vs_regdate));
		// Bind data
		$stmt->bindParam(':vs_startup_information', $this->vs_startup_information);
		$stmt->bindParam(':cr_id', $this->cr_id);
		$stmt->bindParam(':member', $this->member);
		$stmt->bindParam(':vs_authentication_value', $this->vs_authentication_value);
		$stmt->bindParam(':vs_latitude', $this->vs_latitude);
		$stmt->bindParam(':vs_longitude', $this->vs_longitude);
		$stmt->bindParam(':vs_regdate', $this->vs_regdate);

		// Execute query
		if($stmt->execute()) {
		  return true;
		}
	}

	public function trunk_lock()
	{
		// Create query
		$query = 'INSERT INTO ' . $this->table . ' SET vs_startup_information = :vs_startup_information, cr_id = :cr_id, member = :member, vs_authentication_value = :vs_authentication_value, vs_latitude = :vs_latitude, vs_longitude = :vs_longitude, vs_regdate = :vs_regdate';

		// Prepare statement
		$stmt = $this->conn->prepare($query);
		
		// Clean data
		$this->vs_startup_information = htmlspecialchars(strip_tags($this->vs_startup_information));
		$this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		$this->member = htmlspecialchars(strip_tags($this->member));
		$this->vs_authentication_value = htmlspecialchars(strip_tags($this->vs_authentication_value));
		$this->vs_latitude = htmlspecialchars(strip_tags($this->vs_latitude));
		$this->vs_longitude = htmlspecialchars(strip_tags($this->vs_longitude));
		$this->vs_regdate = htmlspecialchars(strip_tags($this->vs_regdate));
		// Bind data
		$stmt->bindParam(':vs_startup_information', $this->vs_startup_information);
		$stmt->bindParam(':cr_id', $this->cr_id);
		$stmt->bindParam(':member', $this->member);
		$stmt->bindParam(':vs_authentication_value', $this->vs_authentication_value);
		$stmt->bindParam(':vs_latitude', $this->vs_latitude);
		$stmt->bindParam(':vs_longitude', $this->vs_longitude);
		$stmt->bindParam(':vs_regdate', $this->vs_regdate);

		// Execute query
		if($stmt->execute()) {
		  return true;
		}
	}

	public function trunk_unlock()
	{
		// Create query
		$query = 'INSERT INTO ' . $this->table . ' SET vs_startup_information = :vs_startup_information, cr_id = :cr_id, member = :member, vs_authentication_value = :vs_authentication_value, vs_latitude = :vs_latitude, vs_longitude = :vs_longitude, vs_regdate = :vs_regdate';

		// Prepare statement
		$stmt = $this->conn->prepare($query);
		
		// Clean data
		$this->vs_startup_information = htmlspecialchars(strip_tags($this->vs_startup_information));
		$this->cr_id = htmlspecialchars(strip_tags($this->cr_id));
		$this->member = htmlspecialchars(strip_tags($this->member));
		$this->vs_authentication_value = htmlspecialchars(strip_tags($this->vs_authentication_value));
		$this->vs_latitude = htmlspecialchars(strip_tags($this->vs_latitude));
		$this->vs_longitude = htmlspecialchars(strip_tags($this->vs_longitude));
		$this->vs_regdate = htmlspecialchars(strip_tags($this->vs_regdate));
		// Bind data
		$stmt->bindParam(':vs_startup_information', $this->vs_startup_information);
		$stmt->bindParam(':cr_id', $this->cr_id);
		$stmt->bindParam(':member', $this->member);
		$stmt->bindParam(':vs_authentication_value', $this->vs_authentication_value);
		$stmt->bindParam(':vs_latitude', $this->vs_latitude);
		$stmt->bindParam(':vs_longitude', $this->vs_longitude);
		$stmt->bindParam(':vs_regdate', $this->vs_regdate);

		// Execute query
		if($stmt->execute()) {
		  return true;
		}
	}

	// public function show()
	// {
	// 	$query = "SELECT * FROM vehicle_status WHERE cr_id = ? LIMIT 1";
	// 	$stmt = $this->conn->prepare($query);
	// 	$stmt->bindParam(1, $this->cr_id);
	// 	$stmt->execute();

	// 	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	// 	$this->cr_id = htmlspecialchars(strip_tags($row["cr_id"]));
	// 	$this->mb_id = htmlspecialchars(strip_tags($row["mb_id"]));
	// 	$this->group_id = htmlspecialchars(strip_tags($row["group_id"]));
	// 	$this->status = htmlspecialchars(strip_tags($row["status"]));
	// 	$this->cr_number_classification = htmlspecialchars(strip_tags($row["cr_number_classification"]));
	// 	$this->cr_registeration_number = htmlspecialchars(strip_tags($row["cr_registeration_number"]));
	// 	$this->cr_carname = htmlspecialchars(strip_tags($row["cr_carname"]));
	// 	$this->cr_mac_address = htmlspecialchars(strip_tags($row["cr_mac_address"]));
	// 	$this->cr_regdate = htmlspecialchars(strip_tags($row["cr_regdate"]));

	// }

	


}

?>