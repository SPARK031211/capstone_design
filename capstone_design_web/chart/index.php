<?php
  require_once("../assets/database/mysql_config.php");

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $select_date = $_POST['select_date'];

    echo "<script>location.href='../chart?date=$select_date';</script>";
  }

  date_default_timezone_set('Asia/Seoul');
  $today_data = date("Y-m-d");

  if (isset($_GET['date'])) {
    $search_date = $_GET['date'];
  } else {
    $search_date = $today_data;
  }

  $sql_chart = query("select * from capstone_py where datetime like '%$search_date%' order by datetime asc");

  $parr = array();
  $tarr = array();
  while($cpl = $sql_chart->fetch_array()) {
    $date_time = $cpl['datetime'];
    $date = date_format(new DateTime($date_time), "m.d.Y");
    $hour = date("H", strtotime($date_time));
    $min = date("i", strtotime($date_time));
                
    if($hour > 12) {
      $hour = $hour - 12;
      $time = $hour.":".$min."PM";
    } else {
      $time = $hour.":".$min."AM";
    }

    $parr[] = $cpl['people_count'];;
    $tarr[] = "'".$time."'";
  }
  $pstr = implode(",", $parr);
  $tstr = implode(",", $tarr);

  $num = mysqli_num_rows($sql_chart);
  if ($num == null) {
    $result_msg = '<p>"'.$search_date.'"의 날짜는 데이터가 없습니다.</p>';
  } else {
    $result_msg = '<p>"'.$search_date.'"의 날짜로 선택된 데이터 입니다.</p>';
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
    #sidebar .nav a#tab_chart {
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
        <div id="layout_chart">
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="date">날짜를 선택하세요:
              <input type="date" class="input-date" id="select_date" name="select_date" max="<?php echo $today_data; ?>" min="2023-10-15" value="<?php echo $search_date; ?>"/>
            </label>
            <button type="sumbit" class="btn-date">확인</button>
          </form>
          <?php echo $result_msg; ?>
          <div class="chart">
            <canvas id="people_count_line_chart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    window.chartColors = {
      black: '#000'
    };

    var config = {
      type: 'line',
      data: {
        labels: [<?php echo $tstr;?>],
        datasets: [{
          label: "사람(명)",
          backgroundColor: window.chartColors.black,
          borderColor: window.chartColors.black,
          fill: false,
          data: [<?php echo $pstr;?>],
        }]
      },
      options: {
        responsive: true,
        legend: {
          display: false,
        },
        title:{
          display: true,
          text:'People Count',
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            gridLines: {
              display: false,
            },
            scaleLabel: {
              display: true,
              labelString: '<?php echo $search_date; ?>',
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
            },
          }]
        }
      }
    };

    var ctx = document.getElementById("people_count_line_chart").getContext("2d");
    var myLine = new Chart(ctx, config);
  </script>
</body>
</html>