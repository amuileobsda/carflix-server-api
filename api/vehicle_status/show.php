<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Vehicle_status.php';

	$db = new db();
	$connect = $db->connect();
	$vehicle_status = new Vehicle_status($connect);

    $vehicle_status->cr_id = isset($_GET['cr_id']) ? $_GET['cr_id'] : die();
    // $vehicle_status->group_id = isset($_GET['group_id']) ? $_GET['group_id'] : die();
    // $vehicle_status->status = isset($_GET['status']) ? $_GET['status'] : die();

    // $member->mb_userid = isset($_GET['mb_userid']) ? $_GET['mb_userid'] : die();
    // $member->mb_password = isset($_GET['mb_password']) ? $_GET['mb_password'] : die();  
    // $car->group_info();

    $read = $vehicle_status->show();
    
    // echo $read;
	$num = $read->rowCount();
	if($num>0)
	{
		$vehicle_status_array = array();
		$vehicle_status_array['data'] = array();

		while ($row = $read->fetch(PDO::FETCH_ASSOC)) 
		{
			extract($row);
			
            $vehicle_status_item = array(
				'vs_id' => $vs_id,
				'vs_startup_information' => $vs_startup_information,
				'cr_id' => $cr_id,	
				'member' => $member,
				'vs_authentication_value' => $vs_authentication_value,	
				'vs_latitude' => $vs_latitude,
				'vs_longitude' => $vs_longitude,
				'vs_regdate' => $vs_regdate
			);
			array_push($vehicle_status_array['data'], $vehicle_status_item);
		}
		echo json_encode($vehicle_status_array);
	}else
	{
		echo json_encode(
	      array('message' => 'No vehicle_status Found')
	    );
	}

?>
