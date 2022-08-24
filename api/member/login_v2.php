<?php
    header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
    
	include_once '../../config/db.php';
	include_once '../../models/Member.php';

	$db = new db();
	$connect = $db->connect();
	$member = new Member($connect);

// if ($member) {

    $data = json_decode(file_get_contents("php://input"));
    $member->mb_userid = $data->mb_userid;
    $member->mb_password = $data->mb_password;

    echo $member->mb_userid;
    echo $member->mb_password;

    // $db->select('member', '*', null, "mb_userid='{$member->mb_userid}'", null, null);
    $datas = $member->member_login();
    echo "서버문제?";

    foreach ($datas as $data) {
        $mb_id = $data['mb_id'];
        $mb_userid = $data['mb_userid'];
        // $mb_password=$data['mb_password'];
        echo "여기까지 왓나?";
        if (!$mb_id) {
            echo json_encode([
                'status' => 0,
                'message' => 'Invalid Carditional',
            ]);
        } else {
            
            echo json_encode([
                'status' => 1,
                'mb_id' => $mb_id,
                'message' => 'Login Successfully',
            ]);
        }
    }

// } else {
//     echo json_encode([
//         'status' => 0,
//         'message' => 'Access Denied',
//     ]);
// }