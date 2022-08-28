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

    //그룹안에서 차량 클릭후 로그보기로 넘어온 구현
    $cr_id = $_GET['cr_id'];
    
    $car_info_log = car_info_log($con, $cr_id);

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
          <div class="p-4 font-bold text-gray-600">차량로그
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
                      차량 상태
                    </th>
                    <!-- <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      유저 아이디
                    </th> -->
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      유저아이디
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      번호
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      위도
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      경도
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                      로그기록시간
                    </th>
                    <!-- <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th> -->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <?php
                  $count=0;
                  // for($i=0; $i<count($member_info); $i++){
                  foreach($car_info_log['data'] as $key => $val){
                  $count++;
                ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="px-2 text-sm font-medium text-gray-900">
                          <?= $key+1?>
                        </div>
                    </td>

    
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                         <?= $val['vs_startup_information']?>
                      </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-green-800">
                         <?= $val['mb_userid']?>
                      </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-green-800">
                         <?= $val['mb_phone']?>
                      </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                         <?= $val['vs_latitude']?>
                      </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                         <?= $val['vs_longitude']?>
                      </span>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      <?= $val['vs_regdate']?>
                    </td>
                
               

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