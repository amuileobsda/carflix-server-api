<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Vehicle_status.php';

	$db = new db();
	$connect = $db->connect();
	$vehicle_status = new Vehicle_status($connect);

    $vehicle_status->cr_id = isset($_GET['cr_id']) ? $_GET['cr_id'] : die();
    // $vehicle_status->mb_id = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();

    if($output = $vehicle_status->vehicle_condition()) {

        if(!$output->cr_id)
        {
            echo json_encode(
                array(
                    'message' => $output->message,
                  )
              );
              return false;
        }

        echo json_encode(
          array(
                'message' => $output->message,
                'vs_startup_information' => $output->vs_startup_information,
				'cr_id' => $output->cr_id,	
				'member' => $output->member
            )
        );
      } else {
        echo json_encode(
          array(
            'message' => $output->message,
            )
        );
      }

?>
