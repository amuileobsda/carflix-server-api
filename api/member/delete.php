<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Member.php';
    // Instantiate DB & connect
    $db = new db();
    $connect = $db->connect();

    // Instantiate blog post object
    $member = new Member($connect);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to UPDATE
    $member->mb_id = $data->mb_id;

    // Delete post
    if($member->delete()) {
      echo json_encode(
        array('message' => 'member deleted')
      );
    } else {
      echo json_encode(
        array('message' => 'member not deleted')
      );
    }

