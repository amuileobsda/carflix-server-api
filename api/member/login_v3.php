<?php
    header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');
    // header('Access-Control-Allow-Methods: POST');
    // header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
    
	include_once '../../config/db.php';
	include_once '../../models/Member.php';

	$db = new db();
	$connect = $db->connect();
	$member = new Member($connect);


    // $data = json_decode(file_get_contents("php://input"));

    $member->mb_userid = isset($_GET['mb_userid']) ? $_GET['mb_userid'] : die();
    $member->mb_password = isset($_GET['mb_password']) ? $_GET['mb_password'] : die();  
    // $member->mb_userid = $data->mb_userid;
    // $member->mb_password = $data->mb_password;
    echo $member->mb_userid;
    echo $member->mb_password;
    // read the details of user to be edited
    $stmt = $member->login_v2();
    echo "success";
    if($stmt->rowCount() > 0){
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // create array
        $user_arr=array(
            "status" => true,
            "message" => "Successfully Login!",
            "mb_id" => $row['mb_id'],
            "mb_userid" => $row['mb_userid']
        );
    }
    else{
        $user_arr=array(
            "status" => false,
            "message" => "Invalid Username or Password!",
        );
    }
    // make it json format
    print_r(json_encode($user_arr));
?>


