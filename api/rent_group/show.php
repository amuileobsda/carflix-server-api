<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Rent_group.php';

	$db = new db();
	$connect = $db->connect();
	$rent_group = new Rent_group($connect);

    $rent_group->rg_id = isset($_GET['rg_id']) ? $_GET['rg_id'] : die();
    $rent_group->show();
    $rent_group_item = array(
        'rg_id' => $rent_group->rg_id,
        'mb_id' => $rent_group->mb_id,
        'rg_career' => $rent_group->rg_career,	
        'rg_certificate' => $rent_group->rg_certificate,
        'rg_company_registernumber' => $rent_group->rg_company_registernumber,	
        'rg_title' => $rent_group->rg_title,
        'rg_description' => $rent_group->rg_description,
        'status' => $rent_group->status,
        'rg_admin' => $rent_group->rg_admin,
        'rg_regdate' => $rent_group->rg_regdate
    );
    print_r(json_encode($rent_group_item));

?>
