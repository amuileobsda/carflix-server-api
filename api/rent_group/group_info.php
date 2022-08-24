<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Rent_group.php';

	$db = new db();
	$connect = $db->connect();
	$rent_group = new Rent_group($connect);

    $rent_group->mb_id = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();
    // $rent_group->group_info();

    $read = $rent_group->group_info();
    echo "1";
    // echo $read;
	$num = $read->rowCount();
	if($num>0)
	{
		$rent_group_array = array();
		$rent_group_array['data'] = array();

		while ($row = $read->fetch(PDO::FETCH_ASSOC)) 
		{
			extract($row);
			
            $rent_group_item = array(
				'rg_id' => $rg_id,
				'mb_id' => $mb_id,
				'rg_career' => $rg_career,	
				'rg_certificate' => $rg_certificate,
				'rg_company_registernumber' => $rg_company_registernumber,	
				'rg_title' => $rg_title,
                'rg_description' => $rg_description,
				'status' => $status,	
				'rg_admin' => $rg_admin,
				'rg_regdate' => $rg_regdate
			);
			array_push($rent_group_array['data'], $rent_group_item);
		}
		echo json_encode($rent_group_array);
	}else
	{
		echo json_encode(
	      array('message' => 'No rent_group Found')
	    );
	}

?>
