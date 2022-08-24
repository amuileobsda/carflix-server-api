<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Vehicle_status.php';

	$db = new db();
	$connect = $db->connect();
	$vehicle_status = new Vehicle_status($connect);

    $vehicle_status->cr_id = isset($_GET['cr_id']) ? $_GET['cr_id'] : die();
    $vehicle_status->member = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();
    $vehicle_status->vs_startup_information = isset($_GET['how']) ? $_GET['how'] : die();

    $vehicle_status->vs_latitude = '0';
    $vehicle_status->vs_longitude = '0';
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');
    $vehicle_status->vs_regdate = $objDateTime;

    if($vehicle_status->vs_startup_information == 'lock')
    {
        if( $output = $vehicle_status->lock()) {
            echo json_encode(
              array(
                    'message' => 'success locked',
                    // 'vs_id' => $output->vs_id,
                    // 'vs_startup_information' => $output->vs_startup_information,
                    'status' => 200
                )
            );
          } else {
            echo json_encode(
              array('message' => 'fail lock')
            );
          }
    }else
    {
        if($vehicle_status->vs_startup_information != 'unlock')
        {
            //lock이나 unlock이 아니면 trunk_lock이거나 trunk_unlock
            if($vehicle_status->vs_startup_information == 'trunk_lock')
            {
                if( $output = $vehicle_status->trunk_lock()) {
                  echo json_encode(
                    array(
                          'message' => 'success trunk_locked',
                          // 'vs_id' => $output->vs_id,
                          // 'vs_startup_information' => $output->vs_startup_information,
                          'status' => 200
                      )
                  );
                  return true;
                } else {
                  echo json_encode(
                    array('message' => 'fail trunk_locked')
                  );
                  return false;
                }
            }else
            { 
                  //예외처리
                  if($vehicle_status->vs_startup_information != 'trunk_unlock')
                  {
                        echo json_encode(
                          array('message' => 'fail trunk_unlock')
                        );
                        return false;
                  }

                  if( $output = $vehicle_status->trunk_unlock()) 
                  {
                    echo json_encode(
                      array(
                            'message' => 'success trunk_unlocked',
                            // 'vs_id' => $output->vs_id,
                            // 'vs_startup_information' => $output->vs_startup_information,
                            'status' => 200
                        )
                    );
                    return true;
                  } else 
                  {
                    echo json_encode(
                      array('message' => 'fail trunk_unlock')
                    );
                    return false;
                  }
            }

        }
        if( $output = $vehicle_status->unlock()) {
            echo json_encode(
              array(
                    'message' => 'success unlocked',
                    // 'vs_id' => $output->vs_id,
                    // 'vs_startup_information' => $output->vs_startup_information,
                    'status' => 200
                )
            );
            return true;
          } else {
            echo json_encode(
              array('message' => 'fail unlock')
            );
            return false;
          }
    }


?>
