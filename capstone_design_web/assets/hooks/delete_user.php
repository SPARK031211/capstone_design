<?php
	require_once("../database/mysql_config.php");

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $uid = $_POST["user_num"];

      // 아이피 주소
      $u_ipaddress = $_SERVER['REMOTE_ADDR'];
  
      // 현재 시간 (서울 기준)
      date_default_timezone_set('Asia/Seoul');
      $u_date = date('Y-m-d H:i:s');

      $sql = query("delete from users where id='$uid';");
      $sql = query("insert into user_admin_log(connected_id, category, ipaddress, datetime) values('".$_SESSION['id']."', 'User 데이터 삭제', '".$u_ipaddress."', '".$u_date."')");

      echo "<script type='text/javascript'>";
      echo "alert('계정을 성공적으로 삭제했습니다.');";
      echo "location.href='../../admin'";
      echo "</script>";
    }
  }
?>