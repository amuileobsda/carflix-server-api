<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Car.php';
    // Instantiate DB & connect
    $db = new db();
    $connect = $db->connect();

    // Instantiate blog post object
    $car = new Car($connect);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to UPDATE
    $car->cr_id = $data->cr_id;

    // Delete post
    if($car->delete()) {
        echo json_encode(
        array('message' => 'car deleted')
        );
    } else {
        echo json_encode(
        array('message' => 'car not deleted')
        );
    }

