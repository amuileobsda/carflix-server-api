<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
	include_once '../../models/Car.php';

    $db = new db();
    $connect = $db->connect();
    $car = new Car($connect);
    
    $data = json_decode(file_get_contents("php://input"));
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');

    $car->cr_id = $data->cr_id;
    $car->mb_id = $data->mb_id;
    $car->group_id = $data->group_id;
    $car->status = $data->status;
    $car->cr_number_classification = $data->cr_number_classification;
    $car->cr_registeration_number = $data->cr_registeration_number;
    $car->cr_carname = $data->cr_carname;
    $car->cr_mac_address = $data->cr_mac_address;
    $car->cr_regdate = $objDateTime;

    if($car->update()) {
        echo json_encode(
          array('message' => 'car updated')
        );
      } else {
        echo json_encode(
          array('message' => 'car not updated')
        );
      }

?>
