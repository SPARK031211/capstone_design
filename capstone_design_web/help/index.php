<?php 
  require_once("../assets/database/mysql_config.php");
  
  date_default_timezone_set('Asia/Seoul');
  $today_data = date("Y-m-d");
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ko-KR"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DB List</title>

	<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
	<!-- FontAwesome 4.7.0 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
  
  <style>
    #sidebar .nav a#tab_help {
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

  <!--Script-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
        <div id="layout_help">
          <h3>[공통 FAQ]</h3>

          <h4>모바일 화면이 이상해요.</h4>
          <li>아직까지는 Desktop 화면 사이즈에 최적화가 되었기 때문에 Mobile에서는 일부 화면이 잘릴 수 있습니다.</li>
          <br/><br/>

          <h4>Chart 사용법이 궁금해요?</h4>
          <li>Chart는 보고싶은 날짜(최대/최소 1일)를 선택하고 확인 버튼을 누르면 선택된 날짜의 데이터를 기반으로 Line Chart가 나와요.</li>
          <li>접속하는 날짜가 기본값으로 적용됩니다. (기본값: "<?php echo $today_data; ?>")입니다.</li>
          <br/><br/>

          <h4>회원가입 및 로그인을 할때 수집하는 정보가 무엇인가요?</h4>
          <li>로그인을 할때 수집되는 정보: 접속 IP, 접속 날짜 및 시간</li>
          <li>회원가입을 할때 수집되는 정보: 아이디, 패스워드, 접속 IP, 계정 데이터가 등록된 날짜 및 시간</li>
          <li>패스워드 정보는 암호화가 적용되어 저장됩니다.</li>

          <hr/>

          <h3>[관리자 FAQ]</h3>

          <h4>Admin Panel 사용 질문</h4>
          <li>현재 총 회원 수, 오늘 가입자, 프로그램 데이터 기록을 확인할 수 있고 User 데이터를 관리(삭제)할 수 있습니다.</li>
          <li>사용자의 개인정보 보호를 위해 패스워드 정보는 표시되지 않습니다.</li>
          <li>User 데이터를 삭제하면 권력 남용으로 문제가 될 수 있어 Log를 저장합니다.</li>
          <li>추후 업데이트를 통해 누적 방문자 수를 확인할 수 있게하고, 프로그램 데이터 기록을 관리할 수 있도록 테이블이 추가될 예정입니다.</li>
        </div>
      </div>
    </div>
  </div>
</body>
</html>