<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Small_group.php';

	$db = new db();
	$connect = $db->connect();
	$small_group = new Small_group($connect);

    $small_group->mb_id = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();
    // $small_group->group_info();

    $read = $small_group->group_info();
    // echo "1";
    // echo $read;
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
