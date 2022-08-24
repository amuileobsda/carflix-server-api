<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');
	
	include_once '../../config/db.php';
	include_once '../../models/Small_group.php';

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
	$small_group = new Small_group($connect);
		
	$read = $small_group->read();
	$num = $read->rowCount();
	if($num>0)
	{
		$small_group_array = array();
		$small_group_array['data'] = array();

		while ($row = $read->fetch(PDO::FETCH_ASSOC)) 
		{
			extract($row);
			
            $small_group_item = array(
				'sg_id' => $sg_id,
				'mb_id' => $mb_id,
				'sg_title' => $sg_title,	
				'sg_description' => $sg_description,
				'status' => $status,	
				'sg_admin' => $sg_admin,
				'sg_regdate' => $sg_regdate
			);
			array_push($small_group_array['data'], $small_group_item);
		}
		echo json_encode($small_group_array);
	}else
	{
		echo json_encode(
	      array('message' => 'No small_group Found')
	    );
	}

?>