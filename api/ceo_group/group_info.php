<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Ceo_group.php';

	$db = new db();
	$connect = $db->connect();
	$ceo_group = new Ceo_group($connect);

    $ceo_group->mb_id = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();
    // $ceo_group->group_info();

    $read = $ceo_group->group_info();
    echo "1";
    // echo $read;
	$num = $read->rowCount();
	if($num>0)
	{
		$ceo_group_array = array();
		$ceo_group_array['data'] = array();

		while ($row = $read->fetch(PDO::FETCH_ASSOC)) 
		{
			extract($row);
			
            $ceo_group_item = array(
				'cg_id' => $cg_id,
				'mb_id' => $mb_id,
				'cg_career' => $cg_career,	
				'cg_certificate' => $cg_certificate,
				'cg_company_registernumber' => $cg_company_registernumber,	
				'cg_title' => $cg_title,
                'cg_description' => $cg_description,
				'status' => $status,	
				'cg_admin' => $cg_admin,
				'cg_regdate' => $cg_regdate
			);
			array_push($ceo_group_array['data'], $ceo_group_item);
		}
		echo json_encode($ceo_group_array);
	}else
	{
		echo json_encode(
	      array('message' => 'No ceo_group Found')
	    );
	}

?>
