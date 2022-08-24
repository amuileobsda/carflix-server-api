<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Member.php';

    $db = new db();
    $connect = $db->connect();
    $member = new Member($connect);
    // echo "어디가 문제야?";
    $data = json_decode(file_get_contents("php://input"));
    // echo "어디가 문제야?";
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');
    
    $member->mb_userid = $data->mb_userid;
    $member->mb_password = $data->mb_password;
    $member->mb_email = $data->mb_email;
    $member->mb_phone = $data->mb_phone;
    $member->mb_nickname = $data->mb_nickname;
    $member->mb_image = $data->mb_image;
    $member->mb_is_admin = $data->mb_is_admin;
    $member->mb_register_car = $data->mb_register_car;
    $member->mb_lastlogin_datetime = $objDateTime;
    $member->mb_regdate = $objDateTime;

    if($member->create()) {
        echo json_encode(
          array('message' => 'member created')
        );
      } else {
        echo json_encode(
          array('message' => 'member not created')
        );
      }


?>