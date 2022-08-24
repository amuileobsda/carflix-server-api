<?php 
	session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			// $query = "select * from users where user_name = '$user_name' limit 1";
			// $result = mysqli_query($con, $query);

			$query = "select * from member where mb_userid = '$user_name' AND mb_password = '$password' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					//멤버랑 관리자랑 구분 짓는 코드
					// if($user_data['user_id'] == 60776925)
					// {
					// 	header("Location: member.php");
					// 	die;
					// }
					// if($user_data['password'] === $password)
					// {

					// 	$_SESSION['user_id'] = $user_data['user_id'];
					// 	header("Location: index.php");
					// 	die;
					// }
					if($user_data['mb_is_admin'] != 'y')
					{
						$_SESSION['mb_userid'] = $user_data['mb_userid'];
						header("Location: member_dashboard/member.php");
						die;
					}else
					{
						$_SESSION['mb_userid'] = $user_data['mb_userid'];
						header("Location: index.php");
						die;
					}

					
					
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<!-- <div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div> -->
	<!-- login ui -->
	<div id="" class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
		<div class="max-w-md w-full space-y-8">
			<div>
			<img class="mx-auto h-12 w-auto" src="./images/kcs_logo.png" alt="Workflow">
			<h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">카플릭스 로그인</h2>
			<!-- <p class="mt-2 text-center text-sm text-gray-600">
				Or
				<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> start your 14-day free trial </a>
			</p> -->
			</div>

			<form class="mt-8 space-y-6" action="#" method="POST">
				<input type="hidden" name="remember" value="true">
				<div class="rounded-md shadow-sm -space-y-px">
					<div class="py-1">
						<label for="user_name" class="sr-only">User name</label>
						<input id="user_name" name="user_name" type="user_name" autocomplete="user_name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="아이디">
					</div>
					<div class="py-1">
						<label for="password" class="sr-only">Password</label>
						<input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="비밀번호">
					</div>
				</div>

				<div class="flex items-center justify-between">
					<div class="flex items-center">
						<input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
						<label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
					</div>

					<div class="text-sm">
						<!-- <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> Forgot your password? </a> -->
						<a href="signup.php" class="font-medium text-indigo-600 hover:text-indigo-500">회원가입페이지 가기</a><br><br>
					</div>
				</div>

				<div>
					<button type="submit" value="Login" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
						<span class="absolute left-0 inset-y-0 flex items-center pl-3">
							<!-- Heroicon name: solid/lock-closed -->
							<svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
							</svg>
						</span>
						로그인
					</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>