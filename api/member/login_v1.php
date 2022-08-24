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

    $data = json_decode(file_get_contents("php://input"));

    $member->mb_userid = $data->mb_userid;
    $member->mb_password = $data->mb_password;
    echo "12";
    $result = $member->member_login();
    echo "123";
    // $query = "SELECT * FROM member WHERE mb_userid = '$member->mb_userid' AND mb_password = '$member->mb_password'";
	  // $result = mysqli_query($connect, $query);

    echo $result;

    if(mysqli_num_rows($result)>0){ 

        $checkUserquery="SELECT mb_id, mb_userid FROM member WHERE mb_userid='$member->mb_userid' and mb_password='$member->mb_password'";
        $resultant=mysqli_query($connect, $checkUserquery);
    
        if(mysqli_num_rows($resultant)>0){
    
          while($row=$resultant->fetch_assoc())
          
          $response['user']=$row;
          $response['error']="200";
          $response['message']="login success";
        }
        else{
          $response['user']=(object)[];
          $response['error']="400";
          $response['message']="Wrong credentials";
    
        }
       

      }
      else{
    
        $response['user']=(object)[];
        $response['error']="400";
        $response['message']="user does not exist";
    
    
      }
    
      echo json_encode($response);
        

?>