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

    $member->mb_userid = isset($_GET['mb_userid']) ? $_GET['mb_userid'] : die();
    $member->show_single_name();
    $member_item = array(
        'mb_userid' => $member->mb_userid,
    );
    print_r(json_encode($member_item));
    

    // $data = json_decode(file_get_contents("php://input"));
    // echo "어디가 문제야?";
    // echo $data;
    // $member->mb_userid = $data->mb_userid;
    // echo $member;
    // $member->show_single_name();
    // $member_item = array(
    //     'mb_userid' => $member->mb_userid,
    // );
    // print_r(json_encode($member_item));
?>