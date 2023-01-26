<?php
require_once ( "Invite_code.php" );


class Code_car extends Invite_code
{
    private $conn;
	private $table = 'code_car';
    private $table_2= 'invite_code';
    //code_car properties
    public $cc_id;
    public $ic_number;
    public $group_id;
    public $status;
    public $member;
    public $cc_regdate;
    public $mb_id;

    // Constructor with DB
    public function __construct($db) 
	{
      $this->conn = $db;
    }

	// public function read()
	// {
	// 	$query = "SELECT * FROM code_car";
	// 	$stmt = $this->conn->prepare($query);
	// 	$stmt->execute();
	// 	return $stmt;
	// }

    // 초대 코드 등록후 해당 그룹 보여주는 api(작업중)
    public function single_show()
	{
		// $query = "SELECT * FROM code_car WHERE member = ? and group_id = ? and status = ? ORDER BY cc_regdate DESC";
		// $stmt = $this->conn->prepare($query);
		// $stmt->bindParam(1, $this->member, $this->group_id, $this->status);
		// $stmt->execute();

         //존재하는지 예외처리
         $query = "SELECT 
                     `cc_id`, `group_id`, `status`, `cc_manager`
                    FROM 
                        " . $this->table . " 
                    WHERE 
                        group_id= '".$this->group_id."' AND status = '".$this->status."' AND member = '".$this->member."'
                        ORDER BY cc_regdate DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['cc_id'] == null || !$row['cc_id']) return false;

		$this->cc_id = htmlspecialchars(strip_tags($row["cc_id"]));
        $this->group_id = htmlspecialchars(strip_tags($row["group_id"]));
        $this->status = htmlspecialchars(strip_tags($row["status"]));
        $this->cc_manager = htmlspecialchars(strip_tags($row["cc_manager"]));

	}

    // 대표가 생성한 초대코드 등록하는 api
    public function create()
    {
        // // invite_code 메서드 호출
        // $extendsClass = new Invite_code;
        // $output = $extendsClass->check_invite_code($this->ic_number);
        // echo $output;
		$query = "SELECT 
					    `mb_id`, `group_id`, `status`, `ic_number`
					FROM 
                        " . $this->table_2 . " 
					WHERE 
                        ic_number = '".$this->ic_number."'
                    ORDER BY ic_regdate DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        // set properties
        // echo $row['group_id'];
        // echo $row['status'];
        if($row['mb_id'] == null) return false;
        if(!$row['group_id']) return false;
        if(!$row['status']) return false;
        $output = new stdClass();
        $output->mb_id = $row['mb_id'];
        $output->group_id = $row['group_id'];
        $output->status = $row['status'];
        
        // $invite_code_array = array();
		// $invite_code_array['data'] = array();
        
		// while ($output = $stmt->fetch(PDO::FETCH_ASSOC)) 
		// {
		// 	extract($output);
			
        //     $invite_code_item = array(
		// 		'mb_id' => $mb_id,
		// 		'group_id' => $group_id,
		// 		'status' => $status,	
		// 		'ic_number' => $ic_number
		// 	);
		// 	array_push($invite_code_array['data'], $invite_code_item);
		// }
        // echo $invite_code_array;

		
		// // return $output;
        // echo $output;

        if($output)
        {
            $query_2 = "INSERT INTO code_car SET ic_number= :ic_number, group_id= :group_id, status= :status, member= :member, cc_regdate= :cc_regdate";
            $stmt_2 = $this->conn->prepare($query_2);

            $this->ic_number = htmlspecialchars(strip_tags( $this->ic_number));
            $output->group_id = htmlspecialchars(strip_tags($output->group_id));
            $output->status = htmlspecialchars(strip_tags( $output->status));
            $this->member = htmlspecialchars(strip_tags( $this->member));
            $this->cc_regdate = htmlspecialchars(strip_tags( $this->cc_regdate));

            $stmt_2->bindParam(':ic_number', $this->ic_number);
            $stmt_2->bindParam(':group_id', $output->group_id);
            $stmt_2->bindParam(':status', $output->status);
            $stmt_2->bindParam(':member', $this->member);
            $stmt_2->bindParam(':cc_regdate', $this->cc_regdate);

            
            if($stmt_2->execute()) {
                
                return $output;
            }
        }else
        {
            
		    printf("Error %s.\n", $stmt->error);
		    return false;
        }
    }

    // 회원이 초대코드로 생성한 그룹해제 api
    public function group_delete()
    {
        //존재하는지 예외처리
        $query = "SELECT 
					    `cc_id`
					FROM 
                        " . $this->table . " 
					WHERE 
                        ic_number= '".$this->ic_number."' AND member = '".$this->member."'
                    ORDER BY cc_regdate DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row['cc_id'] == null) return false;


        // Create query
		 $query = 'DELETE FROM ' . $this->table . ' WHERE ic_number = :ic_number AND member = :member';

		 // Prepare Statement
		 $stmt = $this->conn->prepare($query);
	 
		 // clean data
		 $this->ic_number = htmlspecialchars(strip_tags($this->ic_number));
		 $this->member = htmlspecialchars(strip_tags($this->member));
		 // Bind Data
		 $stmt-> bindParam(':ic_number', $this->ic_number);
		 $stmt-> bindParam(':member', $this->member);
		 // Execute query
		 
		 if($stmt->execute())
		 {
		   return true;
		 }
	 
		 // Print error if something goes wrong
		 printf("Error: $s.\n", $stmt->error);
	 
		 return false;

    }

    //초대 코드로 생성한 그룹 탈퇴 api
    public function group_leave()
    {
         //존재하는지 예외처리
         $query = "SELECT 
                     `ic_number`
                    FROM 
                        " . $this->table . " 
                    WHERE 
                        group_id= '".$this->group_id."' AND status = '".$this->status."' AND member = '".$this->member."'
                        ORDER BY cc_regdate DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['ic_number'] == null) return false;
        $ic_number = $row['ic_number'];
        echo $ic_number;
        // Create query
        $query = 'DELETE FROM ' . $this->table_2 . ' WHERE ic_number = :ic_number';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $ic_number = htmlspecialchars(strip_tags($ic_number));
      
        // Bind Data
        $stmt-> bindParam(':ic_number', $ic_number);

        // Execute query

        if($stmt->execute())
        {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;

    }


}

?>