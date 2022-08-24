<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Ceo_group.php';

    $db = new db();
    $connect = $db->connect();
    $ceo_group = new Ceo_group($connect);
    // echo "어디가 문제야?";
    $data = json_decode(file_get_contents("php://input"));
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');

    $ceo_group->mb_id = $data->mb_id;
    $ceo_group->cg_career = $data->cg_career;
    $ceo_group->cg_certificate = $data->cg_certificate;
    $ceo_group->cg_company_registernumber = $data->cg_company_registernumber;
    $ceo_group->cg_title = $data->cg_title;
    $ceo_group->cg_description = $data->cg_description;
    $ceo_group->status = $data->status;
    $ceo_group->cg_regdate = $objDateTime;
    $ceo_group->cg_id = $data->cg_id;

    echo "어디가 문제야???";

    if($ceo_group->update()) {
        echo json_encode(
          array('message' => 'ceo_group updated')
        );
      } else {
        echo json_encode(
          array('message' => 'ceo_group not updated')
        );
      }
    

?>
