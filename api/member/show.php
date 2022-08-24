<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Member.php';

	$db = new db();
	$connect = $db->connect();
	$member = new Member($connect);

    $member->mb_id = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();
    $member->show();
    $member_item = array(
        'mb_id' => $member->mb_id,
        'mb_userid' => $member->mb_userid,
        'mb_password' => $member->mb_password,	
        'mb_email' => $member->mb_email,
        'mb_phone' => $member->mb_phone,	
        'mb_nickname' => $member->mb_nickname,
        'mb_image' => $member->mb_image,
        'mb_is_admin' => $member->mb_is_admin,
        'mb_register_car' => $member->mb_register_car,
        'mb_lastlogin_datetime' => $member->mb_lastlogin_datetime,
        'mb_regdate' => $member->mb_regdate
    );
    print_r(json_encode($member_item));

?>