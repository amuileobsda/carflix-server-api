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
    echo "1";
    $stmt = $member->member_login();
    echo "3";
    if($stmt->rowCount() > 0)
    {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $user_arr = array(
            "status" => true,
            "message" => "success login",
            "mb_id" => $row["mb_id"],
        );
    }else{
        $user_arr = array(
            "status" => false,
            "message" => "invalid username or password",
        );
    }

    print_r(json_encode($user_arr));
?>