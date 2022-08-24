<?php
	header('Access-Control-Allow-Origin: *');
  	header('Content-Type: application/json');

	include_once '../../config/db.php';
	include_once '../../models/Invite_code.php';

	$db = new db();
	$connect = $db->connect();
	$invite_code = new Invite_code($connect);

    $invite_code->mb_id = isset($_GET['mb_id']) ? $_GET['mb_id'] : die();
    // $invite_code->show();

    $read = $invite_code->show();
    $num = $read->rowCount();
    if($num>0)
    {
        $invite_code_array = array();
		$invite_code_array['data'] = array();

		while ($row = $read->fetch(PDO::FETCH_ASSOC)) 
		{
			extract($row);
	
            $invite_code_item = array(
				'ic_id' => $ic_id,
				'mb_id' => $mb_id,
				'group_id' => $group_id,	
				'status' => $status,
				'ic_number' => $ic_number,	
				'ic_regdate' => $ic_regdate
			);
			array_push($invite_code_array['data'], $invite_code_item);
		}
		echo json_encode($invite_code_array);
        
    }else
    {
        echo json_encode(
            array('message' => 'No invite_code Found')
          );
    }

?>
