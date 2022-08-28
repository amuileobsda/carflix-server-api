<?php 
	session_start();

	include("../connection.php");
	include("../functions.php");

  $mb_userid = $_SESSION['mb_userid'];
  $mb_id = $_SESSION['mb_id'];
  // $mb_id = $_GET['mb_id'];
  // $mb_userid = $_GET['mb_userid'];
  // echo $mb_id;

	$user_data = check_login($con);
	$member_count = check_member_number($con);
	$ceo_count = check_ceo_number($con);
	$car_count = check_car_number($con);

  $small_group_number = check_small_group_number($con, $mb_id);
  $ceo_group_number = check_ceo_group_number($con, $mb_id);
  $rent_group_number = check_rent_group_number($con, $mb_id);
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
        <div class="flex flex-col bg-white h-16 p-2 drop-shadow-2xl">
          <div class="">
		  	<div class="text-right p-1">
				  <?php echo $user_data['mb_userid']; ?>님 환영합니다.
          	<!-- <div class=""> -->
            <!-- <button class="rounded-full bg-indigo-500 py-2 text-white text-lg">Logout</button> -->
            <a href="../logout.php" class="rounded-lg bg-indigo-500 py-2 px-2 text-white text-lg text-center">Logout</a>
          	<!-- </div> -->
		  	</div>
		  	<!-- <h4 class="font-bold text-gray-500 px-1">프로젝트 기간</h4> -->
			<!-- <h1>This is the index page</h1> -->	
          </div>
          	<!-- <p class="text-gray-400 px-1">2022-07-24 ~ 2022-08-24</p> -->
        </div>
        <div class="bg-indigo-50 min-h-screen">
          <div class=" mt-8 grid lg:grid-cols-3 sm:grid-cols-2 p-4 gap-5 ">
            <!--Grid starts here-->
            <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm border-solid border-2 border-sky-500">
              <div>
                <div class="text-sm text-gray-400 font-bold">소규모 그룹수</div>
                <div class="flex items-center pt-1">
                  <div class="text-3xl font-medium font-extrabold text-gray-600 "><?php echo $small_group_number['cnt']; ?></div>
                </div>
              </div>
              <div class="text-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                    clip-rule="evenodd" />
                </svg>
              </div>
            </div>

            <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm border-solid border-2 border-sky-500">
              <div>
                <div class="text-sm text-gray-400 font-bold">대규모 그룹수 </div>
                <div class="flex items-center pt-1">
                  <div class="text-3xl font-medium font-extrabold text-gray-600 "><?php echo $ceo_group_number['cnt']; ?></div>
                </div>
              </div>
              <div class="text-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                    clip-rule="evenodd" />
                </svg>
              </div>
            </div>

            <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm border-solid border-2 border-sky-500">
              <div>
                <div class="text-sm text-gray-400 font-bold">렌트 그룹수</div>
                <div class="flex items-center pt-1">
                  <div class="text-3xl font-medium font-extrabold text-gray-600 "><?php echo $rent_group_number['cnt']; ?></div>
                </div>
              </div>
              <div class="text-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
              </div>
            </div>

            <!-- <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm">
              <div>
                <div class="text-sm text-gray-400 ">Total</div>
                <div class="flex items-center pt-1">
                  <div class="text-3xl font-medium text-gray-600 ">1000</div>
                </div>
              </div>
              <div class="text-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
              </div>
            </div> -->
            <!-- Grid ends here..-->

          </div>

          <!-- 그래프 그리기 -->
          <div class=" mt-2 grid  lg:grid-cols-3  md:grid-cols-3 p-4 gap-3">

            <div class="col-span-1 flex flex-col   p-8 bg-white rounded shadow-sm border-solid border-2 border-sky-500 " >
              <b class="flex flex-row text-gray-500">등록한 차량수</b>
              <!-- <canvas class="p-5" id="chartLine"></canvas> -->
			  	    <div class="flex items-center pt-1">
                  <div class="text-3xl font-medium font-extrabold text-gray-600 blur-sm">100</div>
            	</div>
            </div>

            <div class="col-span-1 flex flex-col   p-8 bg-white rounded shadow-sm border-solid border-2 border-sky-500">
              <b class="flex flex-row text-gray-500">활성화된 차량수</b>
			        <div class="flex items-center pt-1">
                  <div class="text-3xl font-medium font-extrabold text-gray-600 blur-sm">33</div>
            	</div>
            </div>

            <!-- <div class="col-span-1 flex flex-col   p-8 bg-white rounded shadow-sm">
              <b class="flex flex-row text-gray-500"></b>
              
            </div> -->

            <!-- <div class=" flex flex-col   p-5 bg-white rounded shadow-sm">
              <b class="flex flex-row text-gray-500">Occupancy Percentage</b>
              <canvas class="p-5" id="chartRadar"></canvas>
            </div> -->
          </div>

          <!--Table-->
          <!-- <div class="p-4 font-bold text-gray-600">회원들</div>
          <div class="grid  lg:grid-cols-1  md:grid-cols-1 p-4 gap-3">
            <div class="col-span-2 flex flex-auto items-center justify-between  p-5 bg-white rounded shadow-sm">
              <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      회원 아이디
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      유저 닉네임
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      차량 등록여부
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      마지막로그인시간
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      회원가입시간
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <img class="h-10 w-10 rounded-full"
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                            alt="">
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            Jane Cooper
                          </div>
                          <div class="text-sm text-gray-500">
                            jane.cooper@example.com
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        user_id
                      </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        no
                      </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      2022-08-24 17:50
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      2022-08-24 17:50
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>

                  </tr>

                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <img class="h-10 w-10 rounded-full"
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                            alt="">
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            Jane Cooper
                          </div>
                          <div class="text-sm text-gray-500">
                            jane.cooper@example.com
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        user_id
                      </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        no
                      </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      2022-08-24 17:50
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      2022-08-24 17:50
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                  </tr>

                  
                </tbody>
              </table>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Required chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Chart line -->
  <script>
    const labels = ["January", "February", "March", "April", "May", "June"];
    const data = {
      labels: labels,
      datasets: [{
        label: "My First dataset",
        backgroundColor: "hsl(252, 82.9%, 67.8%)",
        borderColor: "hsl(252, 82.9%, 67.8%)",
        data: [0, 10, 5, 2, 20, 30, 45],
      }, ],
    };

    const configLineChart = {
      type: "line",
      data,
      options: {},
    };

    var chartLine = new Chart(
      document.getElementById("chartLine"),
      configLineChart
    );
  </script>

  <script>
    const dataRadar = {
      labels: [
        "Reservation 1",
        "Reservation 2",
        "Reservation 3",
        "Reservation 4",
        "Reservation 5",
        "Reservation 6",
        "Reservation 7",
      ],
      datasets: [{
          label: "My First Dataset",
          data: [65, 59, 90, 81, 56, 55, 40],
          fill: true,
          backgroundColor: "rgba(255,105,180)",
          borderColor: "rgb(255,20,147)",
          pointBackgroundColor: "rgb(133, 105, 241)",
          pointBorderColor: "#fff",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgb(133, 105, 241)",
        },
        {
          label: "My Second Dataset",
          data: [28, 48, 40, 19, 96, 27, 100],
          fill: true,
          backgroundColor: "rgba(255,105,180)",
          borderColor: "rgb(0,191,255)",
          pointBackgroundColor: "rgb(54, 162, 235)",
          pointBorderColor: "#fff",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgb(54, 162, 235)",
        },
      ],
    };

    const configRadarChart = {
      type: "radar",
      data: dataRadar,
      options: {},
    };

    var chartBar = new Chart(
      document.getElementById("chartRadar"),
      configRadarChart
    );
  </script>

</body>

</html>