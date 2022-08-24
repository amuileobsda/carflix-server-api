<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Small_group.php';

	$db = new db();
	$connect = $db->connect();
	$small_group = new Small_group($connect);

    $small_group->sg_id = isset($_GET['sg_id']) ? $_GET['sg_id'] : die();
    $small_group->show();
    $small_group_item = array(
        'sg_id' => $small_group->sg_id,
        'mb_id' => $small_group->mb_id,
        'sg_title' => $small_group->sg_title,	
        'sg_description' => $small_group->sg_description,
        'status' => $small_group->status,	
        'sg_admin' => $small_group->sg_admin,
        'sg_regdate' => $small_group->sg_regdate
    );
    print_r(json_encode($small_group_item));

?>