<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Charts - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Welcome</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Smart Farm
                        </a>
                        <div class="sb-sidenav-menu-heading">마이페이지</div>
                        
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            My Page
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    내 정보 관리
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="user_info.php">회원 정보 보기</a>
                                        <a class="nav-link" href="user_update.php">회원 정보 수정</a>
                                        <a class="nav-link" href="user_delete.php">회원 탈퇴</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    작물 관리
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="register_crop.php">작물 등록</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        
                        <div class="sb-sidenav-menu-heading">메뉴</div>

                        <a class="nav-link" href="charts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            시각화 정보
                        </a>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            작물 통계
                        </a>
                    </div>
                    </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">Logged in as:</div>
                            <?php
                                echo $_SESSION['name'];
                            ?>
                        </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">재배환경 시각화 정보</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Main</a></li>
                            <li class="breadcrumb-item active">Charts</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <!--<div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div> -->
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                작물 상태 정보
                            </div>
                            <div class="card-body">
                                <canvas id="myAreaChart" width="100%" height="30">
                                    <?php
                                    include_once 'myAreaChart.php';
                                    ?>
                                </canvas>
                            </div>
                            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
                        </div>
                        <div class="card mb-4">
                            <!--<div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div> -->
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                작물 길이 예측
                            </div>
                            <div class="card-body">
                                <canvas id="predict_len_chart" width="100%" height="30"></canvas>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        fetch('http://localhost:5000/predict_len')
                                            .then(response => response.json())
                                            .then(data => {
                                                const predictedData = data.predicted_test_data.flat(); // Flatten the array
                                                const labels = data.date; // Use the date array from the response

                                                // Create the chart
                                                const ctx = document.getElementById('predict_len_chart').getContext('2d');
                                                const myChart = new Chart(ctx, {
                                                    type: 'line',
                                                    data: {
                                                        labels: labels,
                                                        datasets: [
                                                            {
                                                                label: 'Predicted leaf length(cm)',
                                                                data: predictedData,
                                                                borderColor: 'rgba(255, 99, 132, 1)',
                                                                backgroundColor: 'rgba(255, 99, 132, 1)',
                                                                borderWidth: 2,
                                                                fill: false,
                                                            },
                                                        ],
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true,
                                                                min: Math.min(...predictedData) - 5,  // Set minimum value based on predicted data
                                                                max: Math.max(...predictedData) + 5,  // Set maximum value based on predicted data
                                                            },
                                                            x: {
                                                                title: {
                                                                    display: true,
                                                                    text: 'Date', // Label for x-axis
                                                                },
                                                                ticks: {
                                                                    autoSkip: true,
                                                                    maxTicksLimit: 10, // Limit number of ticks to avoid clutter
                                                                },
                                                            },
                                                        },
                                                    },
                                                });
                                            })
                                            .catch(error => console.error('Error fetching data:', error));
                                    });
                                </script>
                            </div>
                            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
                        </div>

                        <div class="card mb-4">
                            <!--<div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div> -->
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                작물 잎 개수 예측
                            </div>
                            <div class="card-body">
                                <canvas id="predict_num_chart" width="100%" height="30"></canvas>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        fetch('http://localhost:5000/predict_num')
                                            .then(response => response.json())
                                            .then(data => {
                                                const predictedData = data.predicted_test_data.flat(); // Flatten the array
                                                const labels = data.date; // Use the date array from the response

                                                // Create the chart
                                                const ctx = document.getElementById('predict_num_chart').getContext('2d');
                                                const myChart = new Chart(ctx, {
                                                    type: 'line',
                                                    data: {
                                                        labels: labels,
                                                        datasets: [
                                                            {
                                                                label: 'Predicted leaf num',
                                                                data: predictedData,
                                                                borderColor: 'rgba(0, 128, 0, 1)',
                                                                backgroundColor: 'rgba(0, 128, 0, 1)',
                                                                borderWidth: 2,
                                                                fill: false,
                                                            },
                                                        ],
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true,
                                                                min: Math.min(...predictedData) - 5,  // Set minimum value based on predicted data
                                                                max: Math.max(...predictedData) + 5,  // Set maximum value based on predicted data
                                                            },
                                                            x: {
                                                                title: {
                                                                    display: true,
                                                                    text: 'Date', // Label for x-axis
                                                                },
                                                                ticks: {
                                                                    autoSkip: true,
                                                                    maxTicksLimit: 10, // Limit number of ticks to avoid clutter
                                                                },
                                                            },
                                                        },
                                                    },
                                                });
                                            })
                                            .catch(error => console.error('Error fetching data:', error));
                                    });
                                </script>
                            </div>
                            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        최근 1 시간 이내 재배 환경 정보
                                    </div>
                                    <div class="card-body">
                                        <canvas id="myBarChart" width="100%" height="50">
                                            <?php
                                                include_once 'crop_stat_visualization.php';
                                            ?>
                                        </canvas>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-1"></i>
                                        엑추에이터 Log 기록
                                    </div>
                                    <div class="card-body">
                                        <canvas id="myPieChart" width="100%" height="50">
                                            <?php
                                                include_once 'pichart.php';
                                            ?>
                                        </canvas></div>
                                    <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">TaeHyeok & HyeonGyu & JinGu &copy; Web Smart Farm</div>
                            <div>
                                <a href="#">tjxogur03@naver.com</a>
                                <a href="#"> &amp; uhyeongyu@naver.com</a>
                                <a href="#"> &amp; kimjingu@naver.com</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        
        <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <!-- <script src="assets/demo/chart-pie-demo.js"></script> -->
    </body>
</html>
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';


// Bar Chart Example

var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["평균온도", "평균습도", "평균수분", "평균조도"],
    datasets: [{
      label: "환경 데이터",
      backgroundColor: [
        "rgba(255, 99, 132, 1)",  // 온도: 빨간색
        "rgba(54, 162, 235, 1)",  // 습도: 파란색
        "rgba(75, 192, 192, 1)",  // 수분: 하늘색
        "rgba(255, 206, 86, 1)"   // 조도: 노란색
      ],
      borderColor: [
        "rgba(255, 99, 132, 1)",  // 온도: 빨간색
        "rgba(54, 162, 235, 1)",  // 습도: 파란색
        "rgba(75, 192, 192, 1)",  // 수분: 하늘색
        "rgba(255, 206, 86, 1)"   // 조도: 노란색
      ],
      data: [
        <?php echo json_encode($avg_temperature); ?>, 
        <?php echo json_encode($avg_humidity); ?>, 
        <?php echo json_encode($avg_moisture); ?>,
        <?php echo json_encode($avg_illumination); ?>
      ],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 1000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});




// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Fan", "Pump", "Led", "Camera"],
    datasets: [{
      data: [<?php echo json_encode($sum_fan)?>, 
            <?php echo json_encode($sum_water)?>, 
            <?php echo json_encode($sum_led)?>,
            <?php echo json_encode($sum_camera)?>],
      backgroundColor: ['#FF5675', '#32AAFF', '#FFC300', '#1cc88a'],
      hoverBackgroundColor: ['#CD1039', '#2828CD', '#FFA500	', '#17a623'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: true,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    title: {
      display: true,
      text: <?php echo json_encode($current_date)?>, // 타이틀 텍스트
      fontSize: 14 // 폰트 크기
    }
    
  },
});
</script>

<script>
var ctx = document.getElementById('myAreaChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($date); ?>,
        datasets: [
            {
                label: '온도',
                data: <?php echo json_encode($temp); ?>,
                lineTension: 0.3,
                backgroundColor: "rgba(255, 99, 132, 0.2)", // 빨간색
                borderColor: "rgba(255, 99, 132, 1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(255, 99, 132, 1)",
                pointBorderColor: "rgba(255, 255, 255, 0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(255, 99, 132, 1)",
                pointHitRadius: 50,
                pointBorderWidth: 2
            },
            {
                label: '조도',
                data: <?php echo json_encode($ill); ?>,
                lineTension: 0.3,
                backgroundColor: "rgba(255, 159, 64, 0.2)", // 주황색
                borderColor: "rgba(255, 159, 64, 1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(255, 159, 64, 1)",
                pointBorderColor: "rgba(255, 255, 255, 0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(255, 159, 64, 1)",
                pointHitRadius: 50,
                pointBorderWidth: 2
            },
            {
                label: '습도',
                data: <?php echo json_encode($humi); ?>,
                lineTension: 0.3,
                backgroundColor: "rgba(75, 192, 192, 0.2)", // 초록색
                borderColor: "rgba(75, 192, 192, 1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(75, 192, 192, 1)",
                pointBorderColor: "rgba(255, 255, 255, 0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75, 192, 192, 1)",
                pointHitRadius: 50,
                pointBorderWidth: 2
            },
            {
                label: '수분',
                data: <?php echo json_encode($mois); ?>,
                lineTension: 0.3,
                backgroundColor: "rgba(54, 162, 235, 0.2)", // 파란색
                borderColor: "rgba(54, 162, 235, 1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(54, 162, 235, 1)",
                pointBorderColor: "rgba(255, 255, 255, 0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(54, 162, 235, 1)",
                pointHitRadius: 50,
                pointBorderWidth: 2
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

