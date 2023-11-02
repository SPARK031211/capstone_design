<?php
  require_once("../assets/database/mysql_config.php");
  
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $result_myaccount = query("select * from users where id ='".$_SESSION["id"]."'");
    $row_myaccount = $result_myaccount->fetch_array();

    if ($row_myaccount['role'] != "Admin") {
      echo "<script type='text/javascript'>";
      echo "alert('접속 권한이 없습니다.');";
      echo "location.href='../';";
      echo "</script>";
      exit;
    }

    $result_myuserdata = query("select * from user_signin_log where connected_id ='".$_SESSION['id']."' order by idx desc");

    date_default_timezone_set('Asia/Seoul');
    $today_data = date("Y-m-d");
    
    # 가입한 총 유저 카운트
    $sql_users = query("select * from users");
    $row_users_num = mysqli_num_rows($sql_users);

    # 오늘 가입한 유저 카운트
    $sql_today_users = query("select * from users where created_at like '%$today_data%' order by created_at desc");
    $row_today_users_num = mysqli_num_rows($sql_today_users);

    # 밀집 상황 기록 카운트
    $sql_count = query("select * from capstone_py");
    $row_count_num = mysqli_num_rows($sql_count);
  } else {
    echo "<script type='text/javascript'>";
    echo "alert('로그인 완료 후 이용 가능합니다.');";
    echo "location.href='../signin';";
    echo "</script>";
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
    #sidebar .nav a#tab_adminpanel {
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
        <div id="layout_adminpanel">
          <div class="row" style="padding-top: 30px">
            <div class="col-sm-3">
              <section>
                <div class="account-box">
                  <p>누적 방문자 (명)</p>
                  <h4>제작중</h4>
                </div>
              </section>
            </div>

            <div class="col-sm-3">
              <section>
                <div class="account-box">
                  <p>총 회원 수 (명)</p>
                  <h4><?php echo $row_users_num; ?> 명</h4>
                </div>
              </section>
            </div>

            <div class="col-sm-3">
              <section>
                <div class="account-box">
                  <p>오늘 가입자 (명)</p>
                  <h4><?php echo $row_today_users_num; ?> 명</h4>
                </div>
              </section>
            </div>

            <div class="col-sm-3">
              <section>
                <div class="account-box">
                  <p>밀집도 기록 (개)</p>
                  <h4><?php echo $row_count_num; ?> 개</h4>
                </div>
              </section>
            </div>
          </div>

          <div class="row" style="padding-top: 30px;">
            <div class="col-sm-6">
              <section>
                <div class="account-box">
                  <h4>User 관리</h4>

                  <table class="signlog-table">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>아이디</th>
                        <th>아이피</th>
                        <th>역할</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Del</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(isset($_GET['page'])) {
                          $page = $_GET['page'];
                        } else {
                          $page = 1;
                        }

                        $row_userdata_num = mysqli_num_rows($sql_users); //게시판 총 레코드 수
                        $list = 5; //한 페이지에 보여줄 개수
                        $block_ct = 5; //블록당 보여줄 페이지 개수

                        $block_num = ceil($page / $block_ct); // 현재 페이지 블록 구하기
                        $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                        $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

                        $total_page = ceil($row_userdata_num / $list); // 페이징한 페이지 수 구하기
                        if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
                        $total_block = ceil($total_page / $block_ct); //블럭 총 개수
                        $start_num = ($page - 1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

                        $result_userdata_table = query("select * from users order by id asc limit $start_num, $list");
                    
                        while($userdata = $result_userdata_table->fetch_array()) {
                          $userdata_id = $userdata['id'];
                          $userdata_username = $userdata['username'];
                          $userdata_ipaddress = $userdata['ipaddress'];
                          $userdata_role = $userdata['role'];
                          $userdata_datetime = $userdata['created_at'];
                          $userdata_date = date("M d, Y", strtotime($userdata_datetime));
                          $userdata_time = date("H:m:s", strtotime($userdata_datetime));
                      ?>
                      <form action="../assets/hooks/delete_user" method="post">
                        <tr>
                          <td data-th="No.">
                            <?php echo $userdata_id ?>
                            <input type="id" name="user_num" id="user_num" value="<?php echo $userdata_id ?>" hidden>
                          </td>
                          <td data-th="아이디">
                            <?php echo $userdata_username ?>
                            <input type="text" name="user_name" id="user_name" value="<?php echo $userdata_username ?>" hidden>
                          </td>
                          <td data-th="아이피">
                            <?php echo $userdata_ipaddress ?>
                            <input type="text" name="userdata_ipaddress" id="user_ipaddress" value="<?php echo $userdata_ipaddress ?>" hidden>
                          </td>
                          <td data-th="역할">
                            <?php echo $userdata_role ?>
                            <input type="text" name="user_role" id="user_role" value="<?php echo $userdata_role ?>" hidden>
                          </td>
                          <td data-th="Date">
                            <?php echo $userdata_date ?>
                            <input type="text" name="user_date" id="user_date" value="<?php echo $userdata_date ?>" hidden>
                          </td>
                          <td data-th="Time">
                            <?php echo $userdata_time ?>
                            <input type="text" name="user_time" id="user_time" value="<?php echo $userdata_time ?>" hidden>
                          </td>
                          <td data-th="Del">
                            <button type="sumbit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                          </td>
                        </tr>
                      </form>
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
                              echo "<li><a href='../admin?page=$pre'><</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
                            }

                            echo "<li><a>Page $page of $total_page</a></li>";

                            if($page >= $total_page) { //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
                              echo "<li><a>></a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
                            } else {
                              $next = $page + 1; //next변수에 page + 1을 해준다.
                              echo "<li><a href='../admin?page=$next'>></a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
                            }
                          }
                        ?>
                      </ul>
                    </div>
                  </nav>
                </div>
              </section>
            </div>
            
            <div class="col-sm-6">
              <section>
                <!--div class="account-box">
                  <h4></h4>
                </div-->
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>