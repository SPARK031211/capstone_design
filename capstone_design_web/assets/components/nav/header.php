<?php
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $result_myaccount = query("select * from users where id ='".$_SESSION["id"]."'");
    $row_myaccount = $result_myaccount->fetch_array();
    $my_username = $row_myaccount["username"];
    $my_role = $row_myaccount["role"];

    $welcome_msg = "Welcome, ".$my_username."";
  } else {
    $welcome_msg = "로그인이 필요합니다.";
  }
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right m-nav">
      <li>
        <a><i class="fa fa-bell text-danger"></i></a>
      </li>
      <li class="m-navbtn">
        <a><i class="fa fa-bars" aria-hidden="true"></i></a>
      </li>
    </ul>
  </div>
</nav>

<script>
  jQuery(function($) {
    $(document).ready(function() {
      const sidenavBtn = $(".m-navbtn");
      const sidenav = $("#sidebar");

      sidenavBtn.click(function() {
        if(sidenav.css("display") == "none") {
          sidenav.show();
        } else {
          sidenav.hide();
        }
      });
      $(".m-navbtn").click(function() {
        if($("#sidebar").css("display") != "none") {
          $('#sidebar').removeClass('active');
        } else {
          $('#sidebar').addClass('active');
        }
      });
    });

    window.onresize = function() {
      const screenWidth = screen.availWidth;
      if(screenWidth > 768) {
        $('#sidebar').removeClass('active');
        $('body').css({
          overflow: "auto"
        });
      } else {
        $('#sidebar').addClass('active');
      }
    };
  });
</script>