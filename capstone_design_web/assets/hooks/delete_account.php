<?php
	require_once("../database/mysql_config.php");

  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: ../signin');
		exit;
	}

  $sql = query("delete from users where id=".$_SESSION['id']);
  $_SESSION = array();
	session_destroy();

  echo "<script type='text/javascript'>";
  echo "alert('회원 탈퇴를 완료했습니다.');";
  echo "location.href='../../'";
  echo "</script>";
?>