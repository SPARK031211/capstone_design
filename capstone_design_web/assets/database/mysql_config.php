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
  } catch (Exception $e) {
    echo "DB 서버에 연결할 수 없습니다. 관리자에게 문의해주세요.";
  }
?>