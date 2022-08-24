<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    // header('Access-Control-Allow-Methods: DELETE');
    // header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Car.php';
    // Instantiate DB & connect
    $db = new db();
    $connect = $db->connect();

    // Instantiate blog car object
    $car = new Car($connect);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Set ID to UPDATE
    $car->mb_id = $data->mb_id;
    $car->cr_mac_address = $data->cr_mac_address;
    
    // Delete post
    if($output = $car->registration_delete_request()) {
        echo json_encode(
        array(
                'message' => 'car delete request success',
                'cr_id' => $output->cr_id,
                'status' => 200
            )
        );
    } else {
        echo json_encode(
        array('message' => 'car delete request fail')
        );
    }

