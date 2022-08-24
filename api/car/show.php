<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Car.php';

	$db = new db();
	$connect = $db->connect();
	$car = new Car($connect);

    $car->cr_id = isset($_GET['cr_id']) ? $_GET['cr_id'] : die();
    $car->show();
    $car_item = array(
        'cr_id' => $car->cr_id,
        'mb_id' => $car->mb_id,
        'group_id' => $car->group_id,	
        'status' => $car->status,
        'cr_number_classification' => $car->cr_number_classification,	
        'cr_registeration_number' => $car->cr_registeration_number,
        'cr_carname' => $car->cr_carname,
        'cr_mac_address' => $car->cr_mac_address,
        'cr_regdate' => $car->cr_regdate
    );
    print_r(json_encode($car_item));

?>
