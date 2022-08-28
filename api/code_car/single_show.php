<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Code_car.php';

	$db = new db();
	$connect = $db->connect();
	$code_car = new Code_car($connect);

    $code_car->member = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();
    $code_car->group_id = isset($_GET['group_id']) ? $_GET['group_id'] : die();
    $code_car->status = isset($_GET['status']) ? $_GET['status'] : die();
    $code_car->single_show();

    $code_car_item = array(
        'cc_id' => $code_car->cc_id,
        'group_id' => $code_car->group_id,	
        'status' => $code_car->status,
        'cc_manager' => $code_car->cc_manager,
    );
    print_r(json_encode($code_car_item));

?>
