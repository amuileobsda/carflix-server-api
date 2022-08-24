<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');
	
	include_once '../../config/db.php';
	include_once '../../models/Member.php';

	// $results = $db->query("SHOW VARIABLES LIKE '%timeout%'", TRUE);
	// echo "<pre>";
	// echo "</pre>";

	// $results = $db->query("SET session wait_timeout=28800", FALSE);
	// // UPDATE - this is also needed
	// $results = $db->query("SET session interactive_timeout=28800", FALSE);

	// $results = $db->query("SHOW VARIABLES LIKE '%timeout%'", TRUE);
	// echo "<pre>";
	// echo "</pre>";
	$db = new db();
	$connect = $db->connect();
	$member = new Member($connect);
		
	$read = $member->read();
	$num = $read->rowCount();
	if($num>0)
	{
		$member_array = array();
		$member_array['data'] = array();

		while ($row = $read->fetch(PDO::FETCH_ASSOC)) 
		{
			extract($row);
			if($mb_image)
			{
				//Php 에서 이미지를 base64 인코딩으로 변환하는 방법
				$path = $_SERVER['DOCUMENT_ROOT'].'/admin/images/'.$mb_image; //Set the path where we need to upload the image.
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
			}
			$member_item = array(
				'mb_id' => $mb_id,
				'mb_userid' => $mb_userid,
				'mb_password' => $mb_password,	
				'mb_email' => $mb_email,
				'mb_phone' => $mb_phone,	
				'mb_nickname' => $mb_nickname,
				// 'mb_image' => $mb_image,
				'mb_image' => $base64,
				'mb_is_admin' => $mb_is_admin,
				'mb_register_car' => $mb_register_car,
				'mb_lastlogin_datetime' => $mb_lastlogin_datetime,
				'mb_regdate' => $mb_regdate

			);
			array_push($member_array['data'], $member_item);
		}
		echo json_encode($member_array);
	}else
	{
		echo json_encode(
	      array('message' => 'No Member Found')
	    );
	}

?>