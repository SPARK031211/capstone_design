<?php
  require_once("../assets/database/mysql_config.php");

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $result_mysignlog = query("select * from user_signin_log where connected_id ='".$_SESSION['id']."' order by datetime desc");
    
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("로그인 완료 후 이용 가능합니다.");';
    echo "location.href='../signin';";
    echo '</script>';
    exit;
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
  <title>DB List</title>

	<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
	<!-- FontAwesome 4.7.0 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
  
  <style>
    #sidebar .nav a#tab_mypage {
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
        <div id="layout_account">
          <h3>계정 정보</h3>

          <div class="row" style="padding-top: 30px;">
            <div class="col-sm-6">
              <section class="account-box">
                <div class="member-info">
                  <h4>회원 정보</h4>

                  <table class="memberinfo-table">
                    <tbody>
                      <tr>
                        <td data-th="Id"><?php echo $my_username; ?></td>
                        <td data-th="Role"><?php echo $my_role; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </section>
              
              <section>
                <div class="account-box">
                  <h4>회원 탈퇴 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
                  <p>계정을 삭제하면 계정은 즉시 삭제가 됩니다.</p>
                  <div class="text-right">
                    <form action="../assets/hooks/delete_account" method="post">
                      <button type="sumbit" class="btn-del-account">탈퇴하기</button>
                    </form>
                  </div>
                </div>
              </section>
            </div>
            <div class="col-sm-6">
              <div class="account-box">
                <h4>로그인 기록</h4>

                <table class="signlog-table">
                  <thead>
                    <tr>
                      <th>IP</th>
                      <th>Date</th>
                      <th>Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(isset($_GET['page'])) {
                        $page = $_GET['page'];
                      } else {
                        $page = 1;
                      }

                      $row_mysignlog_num = mysqli_num_rows($result_mysignlog); //게시판 총 레코드 수
                      $list = 5; //한 페이지에 보여줄 개수
                      $block_ct = 5; //블록당 보여줄 페이지 개수

                      $block_num = ceil($page / $block_ct); // 현재 페이지 블록 구하기
                      $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                      $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

                      $total_page = ceil($row_mysignlog_num / $list); // 페이징한 페이지 수 구하기
                      if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
                      $total_block = ceil($total_page / $block_ct); //블럭 총 개수
                      $start_num = ($page - 1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

                      $result_mysignlog_table = query("select * from user_signin_log where connected_id ='".$_SESSION['id']."' order by idx desc limit $start_num, $list");
                      while($signlog = $result_mysignlog_table->fetch_array()) {
                        $signlog_ipaddress = $signlog['ipaddress'];
                        $signlog_datetime = $signlog['datetime'];
                        $signlog_date = date("M d, Y", strtotime($signlog_datetime));
                        $signlog_time = date("H:m:s", strtotime($signlog_datetime));
                    ?>
                    <tr>
                      <td data-th="IP"><?php echo $signlog_ipaddress; ?></td>
                      <td data-th="Date"><?php echo $signlog_date; ?></td>
                      <td data-th="Time"><?php echo $signlog_time; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>

                <nav class="text-right">
                  <div id="page_num">
                    <ul class="pagination">
                      <?php
                        if($total_page != 0) {
                          if($page <= 1) { //만약 page가 1보다 크거나 같다면 빈값
                            echo "<li><a><</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
                          } else {
                            $pre = $page - 1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
                            echo "<li><a href='../mypage?page=$pre'><</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
                          }

                          echo "<li><a>Page $page of $total_page</a></li>";

                          if($page >= $total_page) { //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
                            echo "<li><a>></a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
                          } else {
                            $next = $page + 1; //next변수에 page + 1을 해준다.
                            echo "<li><a href='../mypage?page=$next'>></a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
                          }
                        }
                      ?>
                    </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>