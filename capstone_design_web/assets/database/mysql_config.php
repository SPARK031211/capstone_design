<?php
  $host = "localhost";
  $user = "root";
  $pw = "";
  $dbName = "capstone";

  try {
    $db_board = new mysqli($host, $user, $pw, $dbName);
    $db_board->set_charset("utf8");
    
    if(!$db_board) {
      die("DB에 연결할 수 없습니다. 관리자에게 문의해주세요." . mysqli_error($db_board) );
    }
    
    session_start();
        
    function query($db_board_query) {
      global $db_board;
      return $db_board->query($db_board_query);
    }

    date_default_timezone_set('Asia/Seoul');
    $today_data = date("Y-m-d");

    $userip = $_SERVER['REMOTE_ADDR'];
    if(isset($_SERVER['HTTP_REFERER'])){
      $referer = $_SERVER['HTTP_REFERER'];
    }	else {
      $referer = "";
    }

    if(!isset($_SESSION['visit'])) {
      $_SESSION['visit'] = "1";

      query("insert into visited_log (datetime, ipaddress) values('$today_data','$userip')");
    }
  } catch (Exception $e) {
    echo "DB 서버에 연결할 수 없습니다. 관리자에게 문의해주세요.";
  }
?>