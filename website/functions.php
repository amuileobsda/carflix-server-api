<?php

function check_login($con)
{
	// if(isset($_SESSION['user_id']))
	// {
	// 	$id = $_SESSION['user_id'];
	// 	$query = "select * from users where user_id = '$id' limit 1";

	// 	$result = mysqli_query($con, $query);
	// 	if($result && mysqli_num_rows($result) > 0)
	// 	{
	// 		$user_data = mysqli_fetch_assoc($result);
	// 		return $user_data;
	// 	}
	// }

	if(isset($_SESSION['mb_userid']))
	{
		$id = $_SESSION['mb_userid'];
		$query = "select * from member where mb_userid = '$id' limit 1";

		$result = mysqli_query($con, $query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;
}
//회원들 정보
function member_management_info($con)
{

	$query = "select * from member where mb_is_admin = 'n' order by mb_regdate desc";

	$result = mysqli_query($con, $query);
	
	$result_array = array();
	$result_array['data'] = array();

	while ($row = mysqli_fetch_assoc($result))
	{

		extract($row);
        $item = array(
				'mb_id' => $mb_id,
				'mb_userid' => $mb_userid,
				'mb_password' => $mb_password,	
				'mb_email' => $mb_email,
				'mb_phone' => $mb_phone,	
				'mb_nickname' => $mb_nickname,
				'mb_image' => $mb_image,
				'mb_register_car' => $mb_register_car,
				'mb_lastlogin_datetime' => $mb_lastlogin_datetime,
				'mb_regdate' => $mb_regdate
		);
		array_push($result_array['data'], $item);
	 }
	
	 return $result_array;
}
//소규모 그룹
function samllgroup_management_info($con)
{
	$query = "select * from small_group as t1 left join member as t2 on t1.mb_id = t2.mb_id order by sg_regdate desc";

	$result = mysqli_query($con, $query);
	
	$result_array = array();
	$result_array['data'] = array();

	while ($row = mysqli_fetch_assoc($result))
	{

		extract($row);
        $item = array(
				'sg_id' => $sg_id,
				'mb_id' => $mb_id,
				'mb_userid' => $mb_userid,
				'mb_phone' => $mb_phone,
				'mb_nickname' => $mb_nickname,
				'sg_title' => $sg_title,	
				'sg_description' => $sg_description,
				'status' => $status,	
				'sg_regdate' => $sg_regdate
		);
		array_push($result_array['data'], $item);
	 }
	
	 return $result_array;
}
//대규모 그룹
function ceogroup_management_info($con)
{
	$query = "select * from ceo_group as t1 left join member as t2 on t1.mb_id = t2.mb_id order by cg_regdate desc";

	$result = mysqli_query($con, $query);
	
	$result_array = array();
	$result_array['data'] = array();

	while ($row = mysqli_fetch_assoc($result))
	{
		extract($row);
		//조인쓸까하다가 여기서 그냥 뽑아오자 회원정보
		
		// $query = "select * from member where mb_id = '$mb_id'";

		// $result = mysqli_query($con, $query);
		// if($result && mysqli_num_rows($result) > 0)
		// {
		// 	$user_data = mysqli_fetch_assoc($result);

			
		// }
		// echo $user_data['mb_userid'];

		
        $item = array(
				'cg_id' => $cg_id,
				'mb_id' => $mb_id,
				'mb_userid' => $mb_userid,
				'mb_phone' => $mb_phone,
				'mb_nickname' => $mb_nickname,
				'cg_career' => $cg_career,	
				'cg_certificate' => $cg_certificate,
				'cg_company_registernumber' => $cg_company_registernumber,	
				'cg_title' => $cg_title,	
				'cg_description' => $cg_description,	
				'status' => $status,	
				'cg_regdate' => $cg_regdate
		);
		array_push($result_array['data'], $item);
	 }
	
	 return $result_array;
}
//렌트 그룹
function rentgroup_management_info($con)
{
	$query = "select * from rent_group as t1 left join member as t2 on t1.mb_id = t2.mb_id order by rg_regdate desc";

	$result = mysqli_query($con, $query);
	
	$result_array = array();
	$result_array['data'] = array();

	while ($row = mysqli_fetch_assoc($result))
	{

		extract($row);
        $item = array(
				'rg_id' => $rg_id,
				'mb_id' => $mb_id,
				'mb_userid' => $mb_userid,
				'mb_phone' => $mb_phone,
				'mb_nickname' => $mb_nickname,
				'rg_career' => $rg_career,	
				'rg_certificate' => $rg_certificate,
				'rg_company_registernumber' => $rg_company_registernumber,	
				'rg_title' => $rg_title,	
				'rg_description' => $rg_description,	
				'status' => $status,	
				'rg_regdate' => $rg_regdate
		);
		array_push($result_array['data'], $item);
	 }
	
	 return $result_array;
}

//member_dashboard/small_group.php
//멤버의 소규모 그룹 정보
function samll_group_info($con)
{
	
	$id = $_SESSION['mb_id'];
	// $query = "select * from member where mb_userid = '$id' limit 1";

	$query = "select * from small_group as t1 left join member as t2 on t1.mb_id = t2.mb_id  where t2.mb_id = '$id'  order by sg_regdate desc";

	$result = mysqli_query($con, $query);
	
	$result_array = array();
	$result_array['data'] = array();

	while ($row = mysqli_fetch_assoc($result))
	{

		extract($row);
        $item = array(
				'sg_id' => $sg_id,
				'mb_id' => $mb_id,
				'mb_userid' => $mb_userid,
				'mb_phone' => $mb_phone,
				'mb_nickname' => $mb_nickname,
				'sg_title' => $sg_title,	
				'sg_description' => $sg_description,
				'status' => $status,	
				'sg_regdate' => $sg_regdate
		);
		array_push($result_array['data'], $item);
	 }
	
	 return $result_array;
}
//member_dashboard/ceo_group.php
//멤버의 대규모 그룹 정보
function ceo_group_info($con)
{
	$id = $_SESSION['mb_id'];
	$query = "select * from ceo_group as t1 left join member as t2 on t1.mb_id = t2.mb_id where t2.mb_id = '$id' order by cg_regdate desc";

	$result = mysqli_query($con, $query);
	
	$result_array = array();
	$result_array['data'] = array();

	while ($row = mysqli_fetch_assoc($result))
	{
		extract($row);
		//조인쓸까하다가 여기서 그냥 뽑아오자 회원정보
		
        $item = array(
				'cg_id' => $cg_id,
				'mb_id' => $mb_id,
				'mb_userid' => $mb_userid,
				'mb_phone' => $mb_phone,
				'mb_nickname' => $mb_nickname,
				'cg_career' => $cg_career,	
				'cg_certificate' => $cg_certificate,
				'cg_company_registernumber' => $cg_company_registernumber,	
				'cg_title' => $cg_title,	
				'cg_description' => $cg_description,	
				'status' => $status,	
				'cg_regdate' => $cg_regdate
		);
		array_push($result_array['data'], $item);
	 }
	
	 return $result_array;
}

//렌트 그룹
function rent_group_info($con)
{
	$id = $_SESSION['mb_id'];
	$query = "select * from rent_group as t1 left join member as t2 on t1.mb_id = t2.mb_id where t2.mb_id = '$id' order by rg_regdate desc";

	$result = mysqli_query($con, $query);
	
	$result_array = array();
	$result_array['data'] = array();

	while ($row = mysqli_fetch_assoc($result))
	{

		extract($row);
        $item = array(
				'rg_id' => $rg_id,
				'mb_id' => $mb_id,
				'mb_userid' => $mb_userid,
				'mb_phone' => $mb_phone,
				'mb_nickname' => $mb_nickname,
				'rg_career' => $rg_career,	
				'rg_certificate' => $rg_certificate,
				'rg_company_registernumber' => $rg_company_registernumber,	
				'rg_title' => $rg_title,	
				'rg_description' => $rg_description,	
				'status' => $status,	
				'rg_regdate' => $rg_regdate
		);
		array_push($result_array['data'], $item);
	 }
	
	 return $result_array;
}
//member_dashboard/member.php 소규모그룹수
function check_small_group_number($con)
{
	$id = $_SESSION['mb_id'];
	$query = "select count(*) as cnt from small_group where mb_id = '$id'";

	$result = mysqli_query($con, $query);
	if($result && mysqli_num_rows($result) > 0)
	{
		$user_count = mysqli_fetch_assoc($result);
		return $user_count;
	}

}
//member_dashboard/member.php 대규모그룹수
function check_ceo_group_number($con)
{
	$id = $_SESSION['mb_id'];
	$query = "select count(*) as cnt from ceo_group where mb_id = '$id'";

	$result = mysqli_query($con, $query);
	if($result && mysqli_num_rows($result) > 0)
	{
		$user_count = mysqli_fetch_assoc($result);
		return $user_count;
	}
}
//member_dashboard/member.php 렌트그룹수
function check_rent_group_number($con)
{
	$id = $_SESSION['mb_id'];
	$query = "select count(*) as cnt from rent_group where mb_id = '$id'";

	$result = mysqli_query($con, $query);
	if($result && mysqli_num_rows($result) > 0)
	{
		$user_count = mysqli_fetch_assoc($result);
		return $user_count;
	}

}

function check_member_number($con)
{
	$query = "select count(*) as cnt from member";

	$result = mysqli_query($con, $query);
	if($result && mysqli_num_rows($result) > 0)
	{
		$user_count = mysqli_fetch_assoc($result);
		return $user_count;
	}

	//redirect to login
	// header("Location: login.php");
	// die;
}

function check_ceo_number($con)
{
	$query = "select count(*) as cnt from member where mb_register_car = 'y'";

	$result = mysqli_query($con, $query);
	if($result && mysqli_num_rows($result) > 0)
	{
		$ceo_count = mysqli_fetch_assoc($result);
		return $ceo_count;
	}
}

function check_car_number($con)
{
	$query = "select count(*) as cnt from car_registeration";

	$result = mysqli_query($con, $query);
	if($result && mysqli_num_rows($result) > 0)
	{
		$car_count = mysqli_fetch_assoc($result);
		return $car_count;
	}
}



function random_num($length)
{
	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}