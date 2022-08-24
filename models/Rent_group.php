<?php
class Rent_group
{
    private $conn;
	private $table = 'rent_group';

	//rent_group properties
	public $rg_id;
	public $mb_id;
	public $rg_career;
	public $rg_certificate;
	public $rg_company_registernumber;
    public $rg_title;
    public $rg_description;
    public $status;
	public $rg_regdate;

    // Constructor with DB
    public function __construct($db) 
	{
      $this->conn = $db;
    }

    public function read()
	{
		$query = "SELECT * FROM rent_group";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function group_info()
	{
		$query = "SELECT 
					`rg_id`, `mb_id`, `rg_career`, `rg_certificate`, `rg_company_registernumber`, `rg_title`, `rg_description`, `status`, `rg_admin`, `rg_regdate` 
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
		$query = "SELECT * FROM rent_group WHERE rg_id = ? LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->rg_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->rg_id = htmlspecialchars(strip_tags($row["rg_id"]));
		$this->mb_id = htmlspecialchars(strip_tags($row["mb_id"]));
        $this->rg_career = htmlspecialchars(strip_tags($row["rg_career"]));
        $this->rg_certificate = htmlspecialchars(strip_tags($row["rg_certificate"]));
        $this->rg_company_registernumber = htmlspecialchars(strip_tags($row["rg_company_registernumber"]));
		$this->rg_title = htmlspecialchars(strip_tags($row["rg_title"]));
		$this->rg_description = htmlspecialchars(strip_tags($row["rg_description"]));
		$this->status = htmlspecialchars(strip_tags($row["status"]));
		$this->rg_admin = htmlspecialchars(strip_tags($row["rg_admin"]));
		$this->rg_regdate = htmlspecialchars(strip_tags($row["rg_regdate"]));

	}

	public function create()
	{

		//이미지 처리 .jpg.png.jpeg.gif
		if($this->rg_certificate)
		{
			// $image = $postData['image']; //This a postdata here we going to collect the base64 image.
			$image = $this->rg_certificate;

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
					$this->rg_certificate = $image_name;

					$query = "INSERT INTO rent_group SET mb_id= :mb_id, rg_career= :rg_career, rg_certificate= :rg_certificate, rg_company_registernumber= :rg_company_registernumber, 
									rg_title= :rg_title, rg_description= :rg_description, status= :status, rg_regdate= :rg_regdate";
					$stmt = $this->conn->prepare($query);

					// $this->rg_id = htmlspecialchars(strip_tags($this->rg_id));
					$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
					$this->rg_career = htmlspecialchars(strip_tags( $this->rg_career));
					$this->rg_certificate = htmlspecialchars(strip_tags( $this->rg_certificate));
					$this->rg_company_registernumber = htmlspecialchars(strip_tags( $this->rg_company_registernumber));
					$this->rg_title = htmlspecialchars(strip_tags( $this->rg_title));
					$this->rg_description = htmlspecialchars(strip_tags( $this->rg_description));
					$this->status = htmlspecialchars(strip_tags( $this->status));
					$this->rg_regdate = htmlspecialchars(strip_tags( $this->rg_regdate));

					// $stmt->bindParam(':rg_id', $this->rg_id);
					$stmt->bindParam(':mb_id', $this->mb_id);
					$stmt->bindParam(':rg_career', $this->rg_career);
					$stmt->bindParam(':rg_certificate', $this->rg_certificate);
					$stmt->bindParam(':rg_company_registernumber', $this->rg_company_registernumber);
					$stmt->bindParam(':rg_title', $this->rg_title);
					$stmt->bindParam(':rg_description', $this->rg_description);
					$stmt->bindParam(':status', $this->status);
					$stmt->bindParam(':rg_regdate', $this->rg_regdate);

					if($stmt->execute()) {
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
		// $query = "INSERT INTO rent_group SET mb_id= :mb_id, rg_career= :rg_career, rg_certificate= :rg_certificate, rg_company_registernumber= :rg_company_registernumber, 
        //             rg_title= :rg_title, rg_description= :rg_description, status= :status, rg_regdate= :rg_regdate";
		// $stmt = $this->conn->prepare($query);

		// // $this->rg_id = htmlspecialchars(strip_tags($this->rg_id));
		// $this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		// $this->rg_career = htmlspecialchars(strip_tags( $this->rg_career));
		// $this->rg_certificate = htmlspecialchars(strip_tags( $this->rg_certificate));
		// $this->rg_company_registernumber = htmlspecialchars(strip_tags( $this->rg_company_registernumber));
		// $this->rg_title = htmlspecialchars(strip_tags( $this->rg_title));
        // $this->rg_description = htmlspecialchars(strip_tags( $this->rg_description));
        // $this->status = htmlspecialchars(strip_tags( $this->status));
        // $this->rg_regdate = htmlspecialchars(strip_tags( $this->rg_regdate));

		// // $stmt->bindParam(':rg_id', $this->rg_id);
		// $stmt->bindParam(':mb_id', $this->mb_id);
		// $stmt->bindParam(':rg_career', $this->rg_career);
		// $stmt->bindParam(':rg_certificate', $this->rg_certificate);
		// $stmt->bindParam(':rg_company_registernumber', $this->rg_company_registernumber);
		// $stmt->bindParam(':rg_title', $this->rg_title);
        // $stmt->bindParam(':rg_description', $this->rg_description);
        // $stmt->bindParam(':status', $this->status);
        // $stmt->bindParam(':rg_regdate', $this->rg_regdate);

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

        $query = "UPDATE rent_group SET mb_id= :mb_id, rg_career= :rg_career, rg_certificate= :rg_certificate, rg_company_registernumber= :rg_company_registernumber, 
                    rg_title= :rg_title, rg_description= :rg_description, status= :status, rg_regdate= :rg_regdate
                    WHERE rg_id= :rg_id";
		$stmt = $this->conn->prepare($query);
		
		$this->mb_id = htmlspecialchars(strip_tags( $this->mb_id));
		$this->rg_career = htmlspecialchars(strip_tags( $this->rg_career));
		$this->rg_certificate = htmlspecialchars(strip_tags( $this->rg_certificate));
		$this->rg_company_registernumber = htmlspecialchars(strip_tags( $this->rg_company_registernumber));
		$this->rg_title = htmlspecialchars(strip_tags( $this->rg_title));
        $this->rg_description = htmlspecialchars(strip_tags( $this->rg_description));
        $this->status = htmlspecialchars(strip_tags( $this->status));
        $this->rg_regdate = htmlspecialchars(strip_tags( $this->rg_regdate));
        $this->rg_id = htmlspecialchars(strip_tags($this->rg_id));
		
		$stmt->bindParam(':mb_id', $this->mb_id);
		$stmt->bindParam(':rg_career', $this->rg_career);
		$stmt->bindParam(':rg_certificate', $this->rg_certificate);
		$stmt->bindParam(':rg_company_registernumber', $this->rg_company_registernumber);
		$stmt->bindParam(':rg_title', $this->rg_title);
        $stmt->bindParam(':rg_description', $this->rg_description);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':rg_regdate', $this->rg_regdate);
        $stmt->bindParam(':rg_id', $this->rg_id);
        
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
		$query = 'DELETE FROM rent_group WHERE rg_id = :rg_id';
		// Prepare Statement
		$stmt = $this->conn->prepare($query);
		// clean data
		$this->rg_id = htmlspecialchars(strip_tags($this->rg_id));
		// Bind Data
		$stmt-> bindParam(':rg_id', $this->rg_id);
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