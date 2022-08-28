<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Car.php';
	
	//2022-08-28 현재 차량이 시동중인지 시동가능인지 처리
	// include_once '../../models/Vehicle_status.php';

	$db = new db();
	$connect = $db->connect();
	$car = new Car($connect);
	//2022-08-28 현재 차량이 시동중인지 시동가능인지 처리
	// $vehicle_status = new Vehicle_status($connect);

    $car->mb_id = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();
    $car->group_id = isset($_GET['group_id']) ? $_GET['group_id'] : die();
    $car->status = isset($_GET['status']) ? $_GET['status'] : die();

    // $member->mb_userid = isset($_GET['mb_userid']) ? $_GET['mb_userid'] : die();
    // $member->mb_password = isset($_GET['mb_password']) ? $_GET['mb_password'] : die();
    // $car->group_info();

    $read = $car->group_show();
    // echo "1";
    // echo $read;
	$num = $read->rowCount();
	if($num>0)
	{
		$car_array = array();
		$car_array['data'] = array();

		while ($row = $read->fetch(PDO::FETCH_ASSOC)) 
		{
			extract($row);

			//2022-08-28 현재 차량이 시동중인지 시동가능인지 처리
			$car->cr_id = isset($cr_id) ? $cr_id : die();
			// $output = $vehicle_status->vehicle_condition();

			$output = $car->vehicle_condition();
			
			if(!$output->cr_id)
			{
				$car_item = array(
					'cr_id' => $cr_id,
					'mb_id' => $mb_id,
					'group_id' => $group_id,	
					'status' => $status,
					'cr_number_classification' => $cr_number_classification,	
					'cr_registeration_number' => $cr_registeration_number,
					'cr_carname' => $cr_carname,
					'cr_mac_address' => $cr_mac_address,
					'message'=>$output->message,
					// 'output'=>$output,
					'cr_regdate' => $cr_regdate
				);
				array_push($car_array['data'], $car_item);
			}else
			{
				$car_item = array(
					'cr_id' => $cr_id,
					'mb_id' => $mb_id,
					'group_id' => $group_id,	
					'status' => $status,
					'cr_number_classification' => $cr_number_classification,	
					'cr_registeration_number' => $cr_registeration_number,
					'cr_carname' => $cr_carname,
					'cr_mac_address' => $cr_mac_address,
					'message'=>$output->message,
					// 'output'=>$output,
					'cr_regdate' => $cr_regdate
				);
				array_push($car_array['data'], $car_item);
			}
			
           
		}
		echo json_encode($car_array);
	}else
	{
		echo json_encode(
	      array('message' => 'No car Found')
	    );
	}

?>
