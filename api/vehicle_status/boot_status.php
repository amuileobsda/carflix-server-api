<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Vehicle_status.php';

    $db = new db();
    $connect = $db->connect();
    $vehicle_status = new Vehicle_status($connect);

    $data = json_decode(file_get_contents("php://input"));
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');

    if($data->vs_startup_information != 'on') return false;
    
    $vehicle_status->vs_startup_information = $data->vs_startup_information;
    $vehicle_status->cr_id = $data->cr_id;
    $vehicle_status->member = $data->member;
    $vehicle_status->vs_authentication_value = '';
    $vehicle_status->vs_latitude = $data->vs_latitude;
    $vehicle_status->vs_longitude = $data->vs_longitude;
    $vehicle_status->vs_regdate = $objDateTime;
    
    if($output = $vehicle_status->boot_status()) {
        echo json_encode(
          array(
                'message' => 'success send',
                'status' => 201
                // 'mb_id' => $output->mb_id,
                // 'group_id' => $output->group_id,
                // 'status' => $output->status,
            )
        );
      } else {
        echo json_encode(
          array('message' => 'send fail')
        );
      }


?>

