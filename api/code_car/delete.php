<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Code_car.php';
    // Instantiate DB & connect
    $db = new db();
    $connect = $db->connect();

    // Instantiate blog code_car object
    $code_car = new Code_car($connect);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Set ID to UPDATE
    $code_car->ic_number = $data->ic_number;
    $code_car->member = $data->mb_id;
    
    // Delete post
    if($code_car->group_delete()) {
        echo json_encode(
        array(
            'message' => 'group deleted',
            'status' => 200
            )
        );
    } else {
        echo json_encode(
        array('message' => 'group delete fail')
        );
    }

