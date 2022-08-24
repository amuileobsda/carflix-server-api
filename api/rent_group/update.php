<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Rent_group.php';

    $db = new db();
    $connect = $db->connect();
    $rent_group = new Rent_group($connect);
    // echo "어디가 문제야?";
    $data = json_decode(file_get_contents("php://input"));
    $now = new DateTime();
    $objDateTime = $now->format('Y-m-d H:i:s');

    $rent_group->mb_id = $data->mb_id;
    $rent_group->rg_career = $data->rg_career;
    $rent_group->rg_certificate = $data->rg_certificate;
    $rent_group->rg_company_registernumber = $data->rg_company_registernumber;
    $rent_group->rg_title = $data->rg_title;
    $rent_group->rg_description = $data->rg_description;
    $rent_group->status = $data->status;
    $rent_group->rg_regdate = $objDateTime;
    $rent_group->rg_id = $data->rg_id;

    echo "어디가 문제야???";

    if($rent_group->update()) {
        echo json_encode(
          array('message' => 'rent_group updated')
        );
      } else {
        echo json_encode(
          array('message' => 'rent_group not updated')
        );
      }
    

?>
