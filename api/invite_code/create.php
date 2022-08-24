<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Invite_code.php';

    $db = new db();
    $connect = $db->connect();
    $invite_code = new Invite_code($connect);

    $data = json_decode(file_get_contents("php://input"));
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');

    function secure_random_string($length) 
    {
      $rand_string = '';
      for($i = 0; $i < $length; $i++) 
      {
          $number = random_int(0, 36);
          $character = base_convert($number, 10, 36);
          $rand_string .= $character;
      }
   
      return $rand_string;
    }
    
    $invite_code->mb_id = $data->mb_id;
    $invite_code->group_id = $data->group_id;
    $invite_code->status = $data->status;
    $invite_code->ic_number = secure_random_string(10);
    $invite_code->ic_regdate = $objDateTime;

    if($invite_code->create()) {
        echo json_encode(
          array('message' => 'invite_code created')
        );
      } else {
        echo json_encode(
          array('message' => 'invite_code not created')
        );
      }


?>

