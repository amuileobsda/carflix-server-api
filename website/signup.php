<?php 
	session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		$mb_email = 'test@test.com';
		$mb_phone = $_POST['mb_phone'];
		$mb_nickname = $_POST['mb_nickname'];
		$mb_image = 'test.jpg';
		$mb_is_admin = 'n';
		$mb_register_car = 'n';

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name) && !empty($mb_phone) && !empty($mb_nickname))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into member (mb_userid, mb_password, mb_email, mb_phone, mb_nickname, mb_image, mb_is_admin, mb_register_car) values ('$user_name','$password', '$mb_email',  '$mb_phone', '$mb_nickname', '$mb_image', '$mb_is_admin ', '$mb_register_car' )";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
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
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div> -->

	<!-- signup ui -->
	<div id="" class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
		<div class="max-w-md w-full space-y-8">
			<div>
			<img class="mx-auto h-12 w-auto" src="./images/kcs_logo.png" alt="Workflow">
			<h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">카플릭스 회원가입</h2>
			<!-- <p class="mt-2 text-center text-sm text-gray-600">
				Or
				<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> start your 14-day free trial </a>
			</p> -->
			</div>

			<form class="mt-8 space-y-6" action="#" method="POST">
				<input type="hidden" name="remember" value="true">
				<div class="rounded-md shadow-sm -space-y-px">
					<div class="py-1">
						<label for="user_name" class="sr-only">아이디</label>
						<input id="user_name" name="user_name" type="user_name" autocomplete="user_name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="아이디">
					</div>
					<div class="py-1">
						<label for="password" class="sr-only">비밀번호</label>
						<input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="비밀번호">
					</div>
					<div class="py-1">
						<label for="re_password" class="sr-only">비번확인</label>
						<input id="re_password" name="re_password" type="password" autocomplete="current-repassword" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="비번확인">
					</div>

					<div class="py-1">
						<label for="mb_phone" class="sr-only">폰번호</label>
						<input id="mb_phone" name="mb_phone" type="phone" autocomplete="current-repassword" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="폰번호">
					</div>
					<div class="py-1">
						<label for="mb_nickname" class="sr-only">닉네임</label>
						<input id="mb_nickname" name="mb_nickname" type="password" autocomplete="current-repassword" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="닉네임">
					</div>

				</div>

				<div class="flex items-center justify-between">
					<div class="flex items-center">
						<input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
						<label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
					</div>

					<div class="text-sm">
						<!-- <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> Forgot your password? </a> -->
						<a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">로그인페이지 가기</a><br><br>
					</div>
				</div>

				<div>
					<button type="submit" value="Signup" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
						<span class="absolute left-0 inset-y-0 flex items-center pl-3">
							<!-- Heroicon name: solid/lock-closed -->
							<svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
							</svg>
						</span>
						회원가입
					</button>
				</div>
			</form>
		</div>
	</div>


</body>
</html>