<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Car.php';

    $db = new db();
    $connect = $db->connect();
    $car = new Car($connect);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');

    $car->mb_id = $data->mb_id;
    $car->group_id = $data->group_id;
    $car->status = $data->status;
    $car->cr_number_classification = $data->cr_number_classification;
    $car->cr_registeration_number = $data->cr_registeration_number;
    $car->cr_carname = $data->cr_carname;
    $car->cr_mac_address = $data->cr_mac_address;
    $car->cr_regdate = $objDateTime;
    
    if($output = $car->create()) {
        echo json_encode(
          array(
            'message' => 'car created',
            'cr_id' => $output->cr_id
          )
        );
      } else {
        echo json_encode(
          array('message' => 'car not created')
        );
      }

?>
