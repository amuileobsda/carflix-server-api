<?php 
	session_start();

	include("../connection.php");
	include("../functions.php");

	$user_data = check_login($con);
 	// $member_count = check_member_number($con);
 	// $ceo_count = check_ceo_number($con);
 	// $car_count = check_car_number($con);

    $_SESSION['mb_id'] = $user_data['mb_id'];
    // $group_info = rent_group_info($con);

    //그룹안에서 멤버 클릭시 넘어온 구현
    $status = $_GET['status'];
    $cg_id = $_GET['cg_id'];
    $member_info = ceo_member_info($con, $cg_id, $status);

    //그룹이름가져오기
    $group_name = ceo_group_name($con, $cg_id, $status);

    //버튼 클릭시 바로 서버로 넘기는건 무리가있다 -> ajax쓰자
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['removeAction']))
    {
      $result = member_remove($con, $cg_id, $status, $_POST['removeAction']);
      echo '<script type="text/JavaScript">'; 
      echo 'alert("해당 멤버가 그룹에서 추방되었습니다!");';
      echo '</script>';
      // if($result == true)
      // {
      //   echo '<script type="text/JavaScript">'; 
      //   echo 'alert("해당 멤버가 그룹에서 추방되었습니다!");';
      //   echo 'location.reload();';
      //   echo '</script>';
      // }else
      // {
      //   return false;
      // }
    }

    //버튼 클릭시 매니저 권한부여
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['updateManagerAction']))
    {
      $result = manager_update($con, $rg_id, $status, $_POST['updateManagerAction']);
      echo '<script type="text/JavaScript">'; 
      echo 'alert("부매니저 권한이 부여되었습니다.");';
      echo '</script>';
      // if($result == true)
      // {
      //   echo '<script type="text/JavaScript">'; 
      //   echo 'alert("매니저 권한이 부여되었습니다.");';
      //   echo 'location.reload();';
      //   echo '</script>';
      //   return true;
      // }else
      // {
      //   return false;
      // }
    }

    //버튼 클릭시 일반회원 권한부여
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['updateMemberAction']))
    {
      $result = member_update($con, $rg_id, $status, $_POST['updateMemberAction']);
      echo '<script type="text/JavaScript">'; 
      echo 'alert("일반사용자 권한이 부여되었습니다.");';
      echo '</script>';
      // if($result == true)
      // {
      //   echo '<script type="text/JavaScript">'; 
      //   echo 'alert("일반회원 권한이 부여되었습니다.");';
      //   echo 'location.reload();';
      //   echo '</script>';
      //   return true;
      // }else
      // {
      //   return false;
      // }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tailwindcss Course</title>

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/0.0.0-insiders.4a070ac/tailwind.min.css" integrity="sha512-vJu7D5BpjnNXVpLBrl9LKLvmXBNjiLwge8EOZ/YS9XwiChpfKLAlydwIZvoJaDE3LI/kr3goH0MzDzNbBgyoOQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

  <link rel="stylesheet" href="output.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <div class="flex flex-row ">
  
    <div class="flex flex-col  space-y-5 justify-between min-h-screen w-60 px-2 py-4 bg-gray-50">

      <div class=" flex items-center justify-between text-gray-600 text-2xl px-5">
        <b>카플릭스</b>
        <!-- 카플릭스 -->
        <img class="mx-auto h-12 w-auto" src="../images/kcs_logo.png" alt="Workflow">
      </div>

      <div class="flex flex-col flex-auto">
        <div class="p-2 py-4 hover:bg-indigo-100">
          <div class="flex flex-row space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-700" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <h4 class="font-bold text-gray-500 hover:text-indigo-600 "><a href="member.php">대시보드</a></h4>
          </div>
        </div>
        <!-- <div class="p-2 py-4 hover:bg-indigo-100 ">
          <div class="flex flex-row space-x-3 ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500 " viewBox="0 0 20 20"
              fill="currentColor">
              <path
                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <h4 class="font-regular text-gray-500 hover:text-indigo-600"><a href="member.php">회원관리</a></h4>
          </div>
        </div> -->
        <div class="p-2 py-4 hover:bg-indigo-100 ">
          <div class="flex flex-row space-x-3 ">
            <img src="../images/small.png" class="h-6 w-6 text-indigo-500 ">
            <h4 class="font-regular text-gray-500 hover:text-indigo-600"><a href="small_group.php">소규모 그룹</a></h4>
          </div>
        </div>
        <div class="p-2 py-4 hover:bg-indigo-100 ">
          <div class="flex flex-row space-x-3 ">
          <img src="../images/ceo.png" class="h-6 w-6 text-indigo-500 ">
            <h4 class="font-regular text-gray-500 hover:text-indigo-600"><a href="ceo_group.php">대규모 그룹</a></h4>
          </div>
        </div>
        <div class="p-2 py-4 hover:bg-indigo-100 ">
          <div class="flex flex-row space-x-3 ">
          <img src="../images/rent.jpg" class="h-6 w-6 text-indigo-500 ">
            <h4 class="font-regular text-gray-500 hover:text-indigo-600"><a href="rent_group.php">렌트 그룹</a></h4>
          </div>
        </div>
        <div class="p-2 py-4 hover:bg-indigo-100">
          <div class="flex flex-row space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
            <h4 class="font-regular text-gray-500 hover:text-indigo-600">서비스</h4>
          </div>
        </div>
      </div>

      <!-- <div class="flex flex-col ">
        <button class="rounded-full bg-indigo-500 py-2 text-white text-lg">Logout</button>
		    <a href="logout.php" class="rounded-full bg-indigo-500 py-2 text-white text-lg text-center">Logout</a>
      </div> -->


    </div>


    <div class="flex-auto ">
      <div class="flex flex-col">
        <div class="flex flex-col bg-white h-24 p-2 drop-shadow-2xl">
          <div class="">
		  	<div class="text-right p-1">
				<?php echo $user_data['mb_userid']; ?>님 환영합니다.
        <a href="logout.php" class="rounded-lg bg-indigo-500 py-2 px-2 text-white text-lg text-center">Logout</a>
		  	</div>
		  	<h4 class="font-bold text-gray-500 px-1">프로젝트 기간</h4>
			<!-- <h1>This is the index page</h1> -->	
          </div>
          	<p class="text-gray-400 px-1">2022-07-24 ~ 2022-08-24</p>
        </div>
        <div class="bg-indigo-50 min-h-screen">
          <div class=" mt-8 grid lg:grid-cols-3 sm:grid-cols-2 p-4 gap-10 ">
            <!--Grid starts here-->

          </div>
          <!--Table-->
          <div class="p-4 font-bold text-gray-600"><?php echo $group_name['cg_title'] ?> 그룹 회원들</div>
          <div class="grid  lg:grid-cols-1  md:grid-cols-1 p-4 gap-3">
            <div class="col-span-2 flex flex-auto items-center justify-between  p-5 bg-white rounded shadow-sm">
              <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      No.
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      회원 아이디
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      <!-- 유저 아이디 -->
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      유저 닉네임
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      차량로그
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      마지막로그인시간
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      회원가입시간
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <?php
                  $count=0;
                  // for($i=0; $i<count($member_info); $i++){
                  foreach($member_info['data'] as $key => $val){
                  $count++;
                ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="px-2 text-sm font-medium text-gray-900">
                          <?= $key+1?>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        
                        <!-- <div class="flex-shrink-0 h-10 w-10">
                          <img class="h-10 w-10 rounded-full"
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                            alt="">
                        </div> -->
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                          <?= $val['mb_userid']?>
                          </div>
                          <div class="text-sm text-gray-500">
                          <?= $val['mb_email']?>
                          </div>
                          <div class="text-sm text-gray-500">
                          <?= $val['mb_phone']?>
                          </div>
                        </div>
                      </div>
                    </td>

                    <form method="post">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <button type="submit" name="removeAction" value="<?= $val['mb_id']?>" class="bg-rose-500 hover:bg-gray-100 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">그룹추방</button>
                      </td>

                      <td class="px-6 py-4 whitespace-nowrap">
                        <span
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                          <?= $val['mb_nickname']?>
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-500 font-medium">
                          <a href="ceo_group_member_vehicle_log.php?cg_id=<?php echo $cg_id;?>&status=<?php echo $status;?>&mb_id=<?php echo $val['mb_id'];?>" class="bg-blue-500 hover:bg-blue-100 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">차량로그</a>
                      </td>
                    
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?= $val['mb_lastlogin_datetime']?>
                      </td>

                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?= $val['mb_regdate']?>
                      </td>
                   
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500 font-medium">
                          <button type="submit" name="updateManagerAction" value="<?= $val['mb_id']?>" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">부매니저 권한</button>
                          <button type="submit" name="updateMemberAction" value="<?= $val['mb_id']?>" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">일반사용자 권한</button>
                        <!-- </div> -->
                      </td>
                    </form>

                  </tr>

                  <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>

  <!-- Required chart.js -->

  

</body>

</html>