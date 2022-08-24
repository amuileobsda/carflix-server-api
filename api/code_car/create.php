<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Code_car.php';

    $db = new db();
    $connect = $db->connect();
    $code_car = new Code_car($connect);

    $data = json_decode(file_get_contents("php://input"));
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');

    
    $code_car->ic_number = $data->ic_number;
    // $code_car->group_id = $data->group_id;
    // $code_car->status = $data->status;
    $code_car->member = $data->member;
    $code_car->cc_regdate = $objDateTime;
    
    if($output = $code_car->create()) {
        echo json_encode(
          array(
                'message' => 'group invited',
                'mb_id' => $output->mb_id,
                'group_id' => $output->group_id,
                'status' => $output->status,
            )
        );
      } else {
        echo json_encode(
          array('message' => 'group not invited')
        );
      }


?>

