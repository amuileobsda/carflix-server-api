<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Small_group.php';

    $db = new db();
    $connect = $db->connect();
    $small_group = new Small_group($connect);
    
    $data = json_decode(file_get_contents("php://input"));
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');

    $small_group->sg_id = $data->sg_id;
    $small_group->mb_id = $data->mb_id;
    $small_group->sg_title = $data->sg_title;
    $small_group->sg_description = $data->sg_description;
    $small_group->status = $data->status;
    $small_group->sg_regdate = $objDateTime;
    
    
    if($small_group->update()) {
        echo json_encode(
          array('message' => 'small_group updated')
        );
      } else {
        echo json_encode(
          array('message' => 'small_group not updated')
        );
      }
    

?>