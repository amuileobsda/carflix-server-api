<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Vehicle_status.php';

	$db = new db();
	$connect = $db->connect();
	$vehicle_status = new Vehicle_status($connect);

    $vehicle_status->cr_id = isset($_GET['cr_id']) ? $_GET['cr_id'] : die();
    $vehicle_status->mb_id = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();

	if( $output = $vehicle_status->start_request_check()) {
        echo json_encode(
          array(
                'message' => 'success boot on',
                'vs_id' => $output->vs_id,
                // 'vs_startup_information' => $output->vs_startup_information,
                'status' => 200
            )
        );
      } else {
        echo json_encode(
          array('message' => 'fail boot on')
        );
      }

?>
