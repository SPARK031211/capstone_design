<?php
	require_once("../assets/database/mysql_config.php");

	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
		header("location: ../");
		exit;
  }

	$username_err = "";
	$password_err = "";

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		// 아이디
		$username = $_POST['username'];
		$username_e = '';

		// 패스워드
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		// 아이피 주소
		$ipaddress = $_SERVER['REMOTE_ADDR'];

		// 현재 시간 (서울 기준)
		date_default_timezone_set('Asia/Seoul');
		$created_at = date('Y-m-d H:i:s');

		if(!is_null($username) && !is_null($password) && !is_null($confirm_password)) {
			$signup_sql = query("select username from users where username='".$username."'");

			while($signup = $signup_sql->fetch_array()) {
				$username_e = $signup['username'];
			}

			if($username == $username_e) {
				$username_err ="이미 존재하는 아이디 입니다.";
			} else if($password != $confirm_password) {
				$password_err ="비밀번호가 일치하지 않습니다.";
			} else {
				$privacy_password = password_hash( $password, PASSWORD_DEFAULT);
				
				$signup_ck = "insert into users(username, password, ipaddress, created_at) values('".$username."', '".$privacy_password."', '".$ipaddress."', '".$created_at."')";

				if($db_board->query($signup_ck) === TRUE) {
					$db_board->close();
					header('Location: ../signin');
				} else {
					echo "<script>alert('회원가입에 실패하였습니다.');</script>";
				}
			}
		}
	}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ko-KR"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SignIn</title>
	
	<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
	<!-- FontAwesome 4.7.0 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
  
	<style>
    #sidebar .nav a#tab_signup {
      background: #C9EEfC;
      color: #000;
    }
  </style>
  
  <!-- Layout -->
  <link rel="stylesheet" href="../assets/css/style.css"/>
  <!-- SideBar -->
  <link rel="stylesheet" href="../assets/css/sidebar.css"/>
  <!-- Account -->
  <link rel="stylesheet" href="../assets/css/account.css"/>
  <!-- Admin -->
  <link rel="stylesheet" href="../assets/css/admin.css"/>
</head>
<body>
	<div id="viewport">
    <!-- Sidebar -->
    <?php require_once("../assets/components/nav/sidebar.php")?>

    <!-- Content -->
    <div id="content">
      <!-- Header -->
      <?php require_once("../assets/components/nav/header.php")?>

      <div class="container-fluid">
				<div id="logreg-forms">
					<form class="form-signin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Sign Up</h1>
						<input type="text" class="form-control" required="" name="username" id="username" placeholder="Id *" autofocus="" value="">
						<input type="password" class="form-control" required="" name="password" id="password" data-type="password" placeholder="Password *" value="">
						<input type="password" class="form-control" required="" name="confirm_password" id="confirm_password" data-type="confirm_password" placeholder="Confirm Password *" value="">
						
						<a class="err">
							<?php echo $username_err; echo $password_err;?>
						</a>

						<button class="btn btn-success btn-block" type="submit"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</button>
						<a class="btn btn-primary btn-block" type="button" href="../signin"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>