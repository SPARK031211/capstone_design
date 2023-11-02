<?php
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $result_myaccount = query("select * from users where id ='".$_SESSION["id"]."'");
    $row_myaccount = $result_myaccount->fetch_array();
    if ($row_myaccount['id'] == "1" && $row_myaccount['role'] == "Admin") {
      $sign_box = '
        <li>
          <a id="tab_adminpanel" href="../admin">
            <i class="fa fa-lock" aria-hidden="true"></i> Admin Panel
          </a>
        </li>

        <li>
          <a id="tab_mypage" href="../mypage">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> My Page
          </a>
        </li>

        <li>
          <a id="tab_signout" href="../signout">
            <i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out
          </a>
        </li>';
    } else {
      $sign_box = '
        <li>
          <a id="tab_mypage" href="../mypage">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> My Page
          </a>
        </li>
        
        <li>
          <a id="tab_signout" href="../signout">
            <i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out
          </a>
        </li>';
    }
  } else {
    $sign_box = '
      <li>
        <a style="cursor: default;">
          <i class="fa fa-user-circle" aria-hidden="true"></i> Guest
        </a>
        <a id="tab_signin" href="../signin">
          <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In
        </a>
      </li>';
  }
?>
<div id="sidebar">
  <header>
    <a>DASHBOARD</a>
  </header>
  <ul class="nav">
    <li>
      <a id="tab_home" href="../">
        <i class="fa fa-home" aria-hidden="true"></i> Home
      </a>
    </li>

    <li>
      <a id="tab_table" href="../table">
        <i class="fa fa-table" aria-hidden="true"></i> Table
      </a>
    </li>

    <li>
      <a id="tab_chart" href="../chart">
        <i class="fa fa-line-chart" aria-hidden="true"></i> Chart
      </a>
    </li>

    <li>
      <a id="tab_help" href="../help">
        <i class="fa fa-question-circle" aria-hidden="true"></i> Help
      </a>
    </li>
  </ul>

  <ul class="nav" style="position: absolute; bottom: 0px; width: 100%">
    <?php echo $sign_box; ?>
  </ul>
</div>