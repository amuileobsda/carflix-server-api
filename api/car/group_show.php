<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Car.php';

	$db = new db();
	$connect = $db->connect();
	$car = new Car($connect);

    $car->mb_id = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();
    $car->group_id = isset($_GET['group_id']) ? $_GET['group_id'] : die();
    $car->status = isset($_GET['status']) ? $_GET['status'] : die();

    // $member->mb_userid = isset($_GET['mb_userid']) ? $_GET['mb_userid'] : die();
    // $member->mb_password = isset($_GET['mb_password']) ? $_GET['mb_password'] : die();  
    // $car->group_info();

    $read = $car->group_show();
    echo "1";
    // echo $read;
	$num = $read->rowCount();
	if($num>0)
	{
		$car_array = array();
		$car_array['data'] = array();

		while ($row = $read->fetch(PDO::FETCH_ASSOC)) 
		{
			extract($row);
			
            $car_item = array(
				'cr_id' => $cr_id,
				'mb_id' => $mb_id,
				'group_id' => $group_id,	
				'status' => $status,
				'cr_number_classification' => $cr_number_classification,	
				'cr_registeration_number' => $cr_registeration_number,
				'cr_carname' => $cr_carname,
				'cr_mac_address' => $cr_mac_address,
				'cr_regdate' => $cr_regdate
			);
			array_push($car_array['data'], $car_item);
		}
		echo json_encode($car_array);
	}else
	{
		echo json_encode(
	      array('message' => 'No car Found')
	    );
	}

?>
