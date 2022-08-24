<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Ceo_group.php';
    // Instantiate DB & connect
    $db = new db();
    $connect = $db->connect();

    // Instantiate blog post object
    $ceo_group = new Ceo_group($connect);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to UPDATE
    $ceo_group->cg_id = $data->cg_id;

    // Delete post
    if($ceo_group->delete()) {
        echo json_encode(
        array('message' => 'ceo_group deleted')
        );
    } else {
        echo json_encode(
        array('message' => 'ceo_group not deleted')
        );
    }



