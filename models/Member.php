<?php
class Member
{

	private $conn;
	private $table = 'member';

	//member properties
	public $mb_id;
	public $mb_userid;
	public $mb_password;
	public $mb_email;
	public $mb_phone;
	public $mb_nickname;
	public $mb_image;
	public $mb_is_admin;
	public $mb_register_car;
	public $mb_lastlogin_datetime;
	public $mb_regdate;

    // Constructor with DB
    public function __construct($db) 
	{
      $this->conn = $db;
    }

	public function read()
	{
		$query = "SELECT * FROM member";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function show()
	{
		$query = "SELECT * FROM member WHERE mb_id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->mb_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if($row["mb_image"])
		{
			//Php 에서 이미지를 base64 인코딩으로 변환하는 방법
			$path = $_SERVER['DOCUMENT_ROOT'].'/admin/images/'.$row["mb_image"]; //Set the path where we need to upload the image.
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		}

		$this->mb_id = htmlspecialchars(strip_tags($row["mb_id"]));
		$this->mb_userid = htmlspecialchars(strip_tags($row["mb_userid"]));
		$this->mb_password = htmlspecialchars(strip_tags($row["mb_password"]));
		$this->mb_email = htmlspecialchars(strip_tags($row["mb_email"]));
		$this->mb_phone = htmlspecialchars(strip_tags($row["mb_phone"]));
		$this->mb_nickname = htmlspecialchars(strip_tags($row["mb_nickname"]));
		// $this->mb_image = htmlspecialchars(strip_tags($row["mb_image"]));
		$this->mb_image = htmlspecialchars(strip_tags($base64));
		$this->mb_is_admin = htmlspecialchars(strip_tags($row["mb_is_admin"]));
		$this->mb_register_car = htmlspecialchars(strip_tags($row["mb_register_car"]));
		$this->mb_lastlogin_datetime = htmlspecialchars(strip_tags($row["mb_lastlogin_datetime"]));
		$this->mb_regdate = htmlspecialchars(strip_tags($row["mb_regdate"]));

	}

	public function show_single_name()
	{
		$query = "SELECT mb_userid FROM member WHERE mb_userid = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->mb_userid);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->mb_userid = htmlspecialchars(strip_tags($row["mb_userid"]));
	}

	public function member_login()
	{
		
		//echo $this->mb_userid;
		//echo $this->mb_password;
		$sql = "SELECT * FROM member WHERE mb_userid = ? AND mb_password = ?";
		
		$stmt = $this->conn->prepare($sql);
		
		$this->mb_userid = htmlspecialchars(strip_tags($this->mb_userid));
		$this->mb_password = htmlspecialchars(strip_tags( $this->mb_password));
		$stmt->bind_param(':mb_userid', $this->mb_userid);
		$stmt->bind_param(':mb_password', $this->mb_password);
		
		$stmt->execute();
		

		$result = $stmt->get_result(); // get the mysqli result
		// $user = $result->fetch_assoc(); // fetch data
		while ($row = $result->fetch_assoc()) {
			echo $row['mb_id'];
		}

		// $row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		// $this->mb_id = htmlspecialchars(strip_tags($row["mb_id"]));
		// $this->mb_userid = htmlspecialchars(strip_tags($row["mb_userid"]));

		
		// if($stmt->execute()) {
		
		// 	// $stmt->execute();
		
		// 	// $row = $stmt->fetch(PDO::FETCH_ASSOC);
			
		
		// 	return true;
		// }

		// $output = $stmt->execute();
		
		// $row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		// return $row;
	}

	public function login_v2()
	{
		// select all query with user inputed username and password
		$query = "SELECT
		 `mb_id`, `mb_userid`, `mb_password`
					FROM
						" . $this->table . " 
					WHERE
						mb_userid='".$this->mb_userid."' AND mb_password='".$this->mb_password."'";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}


	public function create()
	{
		//이미지 처리 .jpg.png.jpeg.gif
		if($this->mb_image)
		{
			// $image = $postData['image']; //This a postdata here we going to collect the base64 image.
			$image = $this->mb_image;

			$image_name = ""; //declaring the image name variable
			if (strlen($image) > 0) { //Set the validation that if image lenght must be greater than 0. So image is in base64 so it will be in string

				$image = str_replace('data:image/png;base64,', '', $image);
				$image = str_replace(' ', '+', $image);
				
				$image_name = round(microtime(true) * 1000). ".jpg"; //Giving new name to image.

				$image_upload_dir = $_SERVER['DOCUMENT_ROOT'].'/admin/images/'.$image_name; //Set the path where we need to upload the image.
				chmod($_SERVER['DOCUMENT_ROOT'].'/admin/images/', 0777);

				$flag = file_put_contents($image_upload_dir, base64_decode($image));
				//Here is the main code to convert Base64 image into the real image/Normal image.

				//file_put_contents is function of php. first parameter is the path where you neeed to upload the image. second parameter is the base64image and with the help of base64_decode function we decoding the image.
				// echo $image;
				// print $flag ? $flag : 'Unable to save the file.';
				// echo $image_name;
				// echo $image_upload_dir;
				if($flag){ //Basically flag variable is set for if image get uploaded it will give us true then we will save it in database or else we give response for fail.
					//여기까지 넘어오면 이미지 생성된거라서 insert해주자.
					// echo $flag;
					$this->mb_image = $image_name;
					$query = "INSERT INTO member SET mb_userid= :mb_userid, mb_password= :mb_password, mb_email= :mb_email, mb_phone= :mb_phone, mb_nickname= :mb_nickname, 
					mb_image= :mb_image, mb_is_admin= :mb_is_admin, mb_register_car= :mb_register_car, mb_lastlogin_datetime= :mb_lastlogin_datetime, mb_regdate= :mb_regdate";
					$stmt = $this->conn->prepare($query);

					// $this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
					$this->mb_userid = htmlspecialchars(strip_tags($this->mb_userid));
					$this->mb_password = htmlspecialchars(strip_tags( $this->mb_password));
					$this->mb_email = htmlspecialchars(strip_tags( $this->mb_email));
					$this->mb_phone = htmlspecialchars(strip_tags( $this->mb_phone));
					$this->mb_nickname = htmlspecialchars(strip_tags( $this->mb_nickname));

					$this->mb_image = htmlspecialchars(strip_tags( $this->mb_image));
					$this->mb_is_admin = htmlspecialchars(strip_tags( $this->mb_is_admin));
					$this->mb_register_car = htmlspecialchars(strip_tags( $this->mb_register_car));
					$this->mb_lastlogin_datetime = htmlspecialchars(strip_tags( $this->mb_lastlogin_datetime));
					$this->mb_regdate = htmlspecialchars(strip_tags( $this->mb_regdate));

					// $stmt->bindParam(':mb_id', $this->mb_id);
					$stmt->bindParam(':mb_userid', $this->mb_userid);
					$stmt->bindParam(':mb_password', $this->mb_password);
					$stmt->bindParam(':mb_email', $this->mb_email);
					$stmt->bindParam(':mb_phone', $this->mb_phone);
					$stmt->bindParam(':mb_nickname', $this->mb_nickname);
					$stmt->bindParam(':mb_image', $this->mb_image);
					$stmt->bindParam(':mb_is_admin', $this->mb_is_admin);
					$stmt->bindParam(':mb_register_car', $this->mb_register_car);
					$stmt->bindParam(':mb_lastlogin_datetime', $this->mb_lastlogin_datetime);
					$stmt->bindParam(':mb_regdate', $this->mb_regdate);
					
					if($stmt->execute()) {
						
						return true;
					}


					// $qry2 = mysqli_query($conn,'INSERT into image (id,name) VALUES("","'.$image_name.'")');
					// $res['data']['image'] = $image_name;
					// $res['status'] = 'success';
					// $res['message'] = 'Base64 image uploaded';

					//So lets try to upload image via postman
				}else{
					$res['data'] = array();
					$res['status'] = 'fail';
					$res['message'] = 'Something wrong';
					return false;
				}
				
			}else{
				$res['data'] = array();
				$res['status'] = 'fail';
				$res['message'] = 'Please passed image';
				return false;
			}
		}
		printf("Error %s.\n", $stmt->error);
		return false;

		
		// $query = "INSERT INTO member SET mb_userid= :mb_userid, mb_password= :mb_password, mb_email= :mb_email, mb_phone= :mb_phone, mb_nickname= :mb_nickname, 
		// 			mb_image= :mb_image, mb_is_admin= :mb_is_admin, mb_register_car= :mb_register_car, mb_lastlogin_datetime= :mb_lastlogin_datetime, mb_regdate= :mb_regdate";
		// $stmt = $this->conn->prepare($query);

		// // $this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		// $this->mb_userid = htmlspecialchars(strip_tags($this->mb_userid));
		// $this->mb_password = htmlspecialchars(strip_tags( $this->mb_password));
		// $this->mb_email = htmlspecialchars(strip_tags( $this->mb_email));
		// $this->mb_phone = htmlspecialchars(strip_tags( $this->mb_phone));
		// $this->mb_nickname = htmlspecialchars(strip_tags( $this->mb_nickname));
		// $this->mb_image = htmlspecialchars(strip_tags( $this->mb_image));
		// $this->mb_is_admin = htmlspecialchars(strip_tags( $this->mb_is_admin));
		// $this->mb_register_car = htmlspecialchars(strip_tags( $this->mb_register_car));
		// $this->mb_lastlogin_datetime = htmlspecialchars(strip_tags( $this->mb_lastlogin_datetime));
		// $this->mb_regdate = htmlspecialchars(strip_tags( $this->mb_regdate));

		// // $stmt->bindParam(':mb_id', $this->mb_id);
		// $stmt->bindParam(':mb_userid', $this->mb_userid);
		// $stmt->bindParam(':mb_password', $this->mb_password);
		// $stmt->bindParam(':mb_email', $this->mb_email);
		// $stmt->bindParam(':mb_phone', $this->mb_phone);
		// $stmt->bindParam(':mb_nickname', $this->mb_nickname);
		// $stmt->bindParam(':mb_image', $this->mb_image);
		// $stmt->bindParam(':mb_is_admin', $this->mb_is_admin);
		// $stmt->bindParam(':mb_register_car', $this->mb_register_car);
		// $stmt->bindParam(':mb_lastlogin_datetime', $this->mb_lastlogin_datetime);
		// $stmt->bindParam(':mb_regdate', $this->mb_regdate);
		
		// if($stmt->execute()) {
		
		// 	return true;
		// }
		
	}

	public function update()
	{
		
		$query = "UPDATE member SET mb_userid= :mb_userid, mb_password= :mb_password, mb_email= :mb_email, mb_phone= :mb_phone, mb_nickname= :mb_nickname, 
					mb_is_admin= :mb_is_admin, mb_register_car= :mb_register_car, mb_lastlogin_datetime= :mb_lastlogin_datetime, mb_regdate= :mb_regdate
					WHERE mb_id = :mb_id";
		$stmt = $this->conn->prepare($query);
		
		$this->mb_userid = htmlspecialchars(strip_tags($this->mb_userid));
		$this->mb_password = htmlspecialchars(strip_tags( $this->mb_password));
		$this->mb_email = htmlspecialchars(strip_tags( $this->mb_email));
		$this->mb_phone = htmlspecialchars(strip_tags( $this->mb_phone));
		$this->mb_nickname = htmlspecialchars(strip_tags( $this->mb_nickname));
		// $this->mb_image = htmlspecialchars(strip_tags( $this->mb_image));
		$this->mb_is_admin = htmlspecialchars(strip_tags( $this->mb_is_admin));
		$this->mb_register_car = htmlspecialchars(strip_tags( $this->mb_register_car));
		$this->mb_lastlogin_datetime = htmlspecialchars(strip_tags( $this->mb_lastlogin_datetime));
		$this->mb_regdate = htmlspecialchars(strip_tags( $this->mb_regdate));
		$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));

		$stmt->bindParam(':mb_userid', $this->mb_userid);
		$stmt->bindParam(':mb_password', $this->mb_password);
		$stmt->bindParam(':mb_email', $this->mb_email);
		$stmt->bindParam(':mb_phone', $this->mb_phone);
		$stmt->bindParam(':mb_nickname', $this->mb_nickname);
		// $stmt->bindParam(':mb_image', $this->mb_image);
		$stmt->bindParam(':mb_is_admin', $this->mb_is_admin);
		$stmt->bindParam(':mb_register_car', $this->mb_register_car);
		$stmt->bindParam(':mb_lastlogin_datetime', $this->mb_lastlogin_datetime);
		$stmt->bindParam(':mb_regdate', $this->mb_regdate);
		$stmt->bindParam(':mb_id', $this->mb_id);

		
		if($stmt->execute()) {
			
			return true;
		}
		
		printf("Error %s.\n", $stmt->error);
		return false;
	}

	public function delete()
	{
		// Create query
		$query = 'DELETE FROM member WHERE mb_id = :mb_id';
		// Prepare Statement
		$stmt = $this->conn->prepare($query);
		// clean data
		$this->mb_id = htmlspecialchars(strip_tags($this->mb_id));
		// Bind Data
		$stmt-> bindParam(':mb_id', $this->mb_id);
		// Execute query
		if($stmt->execute()) {
		  return true;
		}
		// Print error if something goes wrong
		printf("Error: $s.\n", $stmt->error);
	
		return false;
	}

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