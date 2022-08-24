<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Ceo_group.php';

	$db = new db();
	$connect = $db->connect();
	$ceo_group = new Ceo_group($connect);

    $ceo_group->cg_id = isset($_GET['cg_id']) ? $_GET['cg_id'] : die();
    $ceo_group->show();
    $ceo_group_item = array(
        'cg_id' => $ceo_group->cg_id,
        'mb_id' => $ceo_group->mb_id,
        'cg_career' => $ceo_group->cg_career,	
        'cg_certificate' => $ceo_group->cg_certificate,
        'cg_company_registernumber' => $ceo_group->cg_company_registernumber,	
        'cg_title' => $ceo_group->cg_title,
        'cg_description' => $ceo_group->cg_description,
        'status' => $ceo_group->status,
        'cg_admin' => $ceo_group->cg_admin,
        'cg_regdate' => $ceo_group->cg_regdate
    );
    print_r(json_encode($ceo_group_item));

?>
