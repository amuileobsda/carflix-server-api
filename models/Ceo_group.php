<?php
class Ceo_group
{
    private $conn;
	private $table = 'ceo_group';

	//ceo_group properties
	public $cg_id;
	public $mb_id;
	public $cg_career;
	public $cg_certificate;
	public $cg_company_registernumber;
    public $cg_title;
    public $cg_description;
    public $status;
	public $cg_regdate;

    // Constructor with DB
    public function __construct($db) 
	{
      $this->conn = $db;
    }

    public function read()
	{
		$query = "SELECT * FROM ceo_group";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function group_info()
	{
		$query = "SELECT 
					`cg_id`, `mb_id`, `cg_career`, `cg_certificate`, `cg_company_registernumber`, `cg_title`, `cg_description`, `status`, `cg_admin`, `cg_regdate` 
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
		$query = "SELECT * FROM ceo_group WHERE cg_id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->cg_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->cg_id = htmlspecialchars(strip_tags($row["cg_id"]));
		$this->mb_id = htmlspecialchars(strip_tags($row["mb_id"]));
        $this->cg_career = htmlspecialchars(strip_tags($row["cg_career"]));
        $this->cg_certificate = htmlspecialchars(strip_tags($row["cg_certificate"]));
        $this->cg_company_registernumber = htmlspecialchars(strip_tags($row["cg_company_registernumber"]));
		$this->cg_title = htmlspecialchars(strip_tags($row["cg_title"]));
		$this->cg_description = htmlspecialchars(strip_tags($row["cg_description"]));
		$this->status = htmlspecialchars(strip_tags($row["status"]));
		$this->cg_admin = htmlspecialchars(strip_tags($row["cg_admin"]));
		$this->cg_regdate = htmlspecialchars(strip_tags($row["cg_regdate"]));

	}

	public function create()
	{
		//이미지 처리 .jpg.png.jpeg.gif
		if($this->cg_certificate)
		{
			// $image = $postData['image']; //This a postdata here we going to collect the base64 image.
			$image = $this->cg_certificate;

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
					$this->cg_certificate = $image_name;

					// echo "잘실행되고있다.";
					$query = "INSERT INTO ceo_group SET mb_id= :mb_id, cg_career= :cg_career, cg_certificate= :cg_certificate, cg_company_registernumber= :cg_company_registernumber, 
									cg_title= :cg_title, cg_description= :cg_description, status= :status, cg_regdate= :cg_regdate";
					$stmt = $this->conn->prepare($query);

					// $this->cg_id = htmlspecialchars(strip_tags($this->cg_id));
					$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
					$this->cg_career = htmlspecialchars(strip_tags( $this->cg_career));
					$this->cg_certificate = htmlspecialchars(strip_tags( $this->cg_certificate));
					$this->cg_company_registernumber = htmlspecialchars(strip_tags( $this->cg_company_registernumber));
					$this->cg_title = htmlspecialchars(strip_tags( $this->cg_title));
					$this->cg_description = htmlspecialchars(strip_tags( $this->cg_description));
					$this->status = htmlspecialchars(strip_tags( $this->status));
					$this->cg_regdate = htmlspecialchars(strip_tags( $this->cg_regdate));

					// $stmt->bindParam(':cg_id', $this->cg_id);
					$stmt->bindParam(':mb_id', $this->mb_id);
					$stmt->bindParam(':cg_career', $this->cg_career);
					$stmt->bindParam(':cg_certificate', $this->cg_certificate);
					$stmt->bindParam(':cg_company_registernumber', $this->cg_company_registernumber);
					$stmt->bindParam(':cg_title', $this->cg_title);
					$stmt->bindParam(':cg_description', $this->cg_description);
					$stmt->bindParam(':status', $this->status);
					$stmt->bindParam(':cg_regdate', $this->cg_regdate);

					// echo "잘실행되고있다.";
					if($stmt->execute()) {
					// echo "잘실행되고있다.";
					return true;
					}
				
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

		// // echo "잘실행되고있다.";
		// $query = "INSERT INTO ceo_group SET mb_id= :mb_id, cg_career= :cg_career, cg_certificate= :cg_certificate, cg_company_registernumber= :cg_company_registernumber, 
        //             cg_title= :cg_title, cg_description= :cg_description, status= :status, cg_regdate= :cg_regdate";
		// $stmt = $this->conn->prepare($query);

		// // $this->cg_id = htmlspecialchars(strip_tags($this->cg_id));
		// $this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		// $this->cg_career = htmlspecialchars(strip_tags( $this->cg_career));
		// $this->cg_certificate = htmlspecialchars(strip_tags( $this->cg_certificate));
		// $this->cg_company_registernumber = htmlspecialchars(strip_tags( $this->cg_company_registernumber));
		// $this->cg_title = htmlspecialchars(strip_tags( $this->cg_title));
        // $this->cg_description = htmlspecialchars(strip_tags( $this->cg_description));
        // $this->status = htmlspecialchars(strip_tags( $this->status));
        // $this->cg_regdate = htmlspecialchars(strip_tags( $this->cg_regdate));

		// // $stmt->bindParam(':cg_id', $this->cg_id);
		// $stmt->bindParam(':mb_id', $this->mb_id);
		// $stmt->bindParam(':cg_career', $this->cg_career);
		// $stmt->bindParam(':cg_certificate', $this->cg_certificate);
		// $stmt->bindParam(':cg_company_registernumber', $this->cg_company_registernumber);
		// $stmt->bindParam(':cg_title', $this->cg_title);
        // $stmt->bindParam(':cg_description', $this->cg_description);
        // $stmt->bindParam(':status', $this->status);
        // $stmt->bindParam(':cg_regdate', $this->cg_regdate);

		// // echo "잘실행되고있다.";
		// if($stmt->execute()) {
		// 	// echo "잘실행되고있다.";
		// 	return true;
		// }
		// echo "왜 여기로 넘어와?.";
	}

	public function update()
	{
		// echo "잘실행되고있다.";

        $query = "UPDATE ceo_group SET mb_id= :mb_id, cg_career= :cg_career, cg_certificate= :cg_certificate, cg_company_registernumber= :cg_company_registernumber, cg_title= :cg_title,  cg_description= :cg_description,  status= :status, cg_regdate= :cg_regdate 
                    WHERE cg_id= :cg_id";
		$stmt = $this->conn->prepare($query);
        
		$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		$this->cg_career = htmlspecialchars(strip_tags( $this->cg_career));
		$this->cg_certificate = htmlspecialchars(strip_tags( $this->cg_certificate));
		$this->cg_company_registernumber = htmlspecialchars(strip_tags( $this->cg_company_registernumber));
		$this->cg_title = htmlspecialchars(strip_tags( $this->cg_title));
        $this->cg_description = htmlspecialchars(strip_tags( $this->cg_description));
        $this->status = htmlspecialchars(strip_tags( $this->status));
        $this->cg_regdate = htmlspecialchars(strip_tags( $this->cg_regdate));
        $this->cg_id = htmlspecialchars(strip_tags($this->cg_id));

		$stmt->bindParam(':mb_id', $this->mb_id);
		$stmt->bindParam(':cg_career', $this->cg_career);
		$stmt->bindParam(':cg_certificate', $this->cg_certificate);
		$stmt->bindParam(':cg_company_registernumber', $this->cg_company_registernumber);
		$stmt->bindParam(':cg_title', $this->cg_title);
        $stmt->bindParam(':cg_description', $this->cg_description);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':cg_regdate', $this->cg_regdate);
        $stmt->bindParam(':cg_id', $this->cg_id);
        
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
		$query = 'DELETE FROM ceo_group WHERE cg_id = :cg_id';
		// Prepare Statement
		$stmt = $this->conn->prepare($query);
		// clean data
		$this->cg_id = htmlspecialchars(strip_tags($this->cg_id));
		// Bind Data
		$stmt-> bindParam(':cg_id', $this->cg_id);
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