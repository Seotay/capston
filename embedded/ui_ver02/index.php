<?php
    session_start(); // 세션 시작

    // 로그인 여부 확인
    if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
        // 세션에 저장된 ID와 이름을 가져옴
        $user_id = $_SESSION['id'];
        $user_name = $_SESSION['name'];
        //echo "<script>alert('$user_id')</script>";
    } else {
        // 로그인되지 않은 상태 -> 로그인 페이지로 리다이렉션
        echo "<script>alert('Please login')</script>";
        header("Location: login.php");
        exit();
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/mystyles.css" rel="stylesheet" />
</head>



</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">welcome</a>
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
                        // echo $_SESSION['name'];
                    ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">SMARTFARM</h1>
                    <ol class="breadcrumb mb-4">
                        <!-- <li class="breadcrumb-item active">Dashboard</li> -->
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <form action="act.php" method ="GET" onsubmit="document.reload()">
                                <div class="card-body">온도 제어</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <input type='radio' name = "fan" value="On">On
                                        <input type='radio' name = "fan" value="Off">Off
                                        <input class = "styled-button-temp" type="submit" value="Control" >
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <form action="act.php" method ="GET" onsubmit="document.reload()">
                            <div class="card-body">물공급 제어</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <input type='radio' name = "water" id="pumpOn" value="pumpOn">On
                                     <input type='radio' name = "water"id="pumpOff" value="pumpOff">Off
                                     <input class = "styled-button-water" id="controlPumpBtn" type="submit" value="Control" >
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <form action="act.php" method ="GET" onsubmit="document.reload()">
                                <div class="card-body">LED 제어</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                     <input type='radio' name = "led" id="ledOn" value="ledOn">On
                                     <input type='radio' name = "led" id="ledOff" value="ledOff">Off
                                     <input class = "styled-button-led" id="controlLedBtn" type="submit" value="Control" >
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <form action="act.php" method ="GET" onsubmit="document.submitForm()">
                                <div class="card-body">카메라</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                  <input type='radio' name = "camera" value="On">On
                                     <input type='radio' name = "camera" value="Off">Off
                                     <input class = "styled-button-camera" type="submit" value="Control" >
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                            </form>
                            <script>
                                function submitForm() {
                                    // Form data 전송
                                    let form = document.querySelector('form');
                                    let formData = new FormData(form);

                                    fetch('act.php', {
                                        method: 'GET',
                                        body: formData
                                    }).then(() => {
                                        // DB 값 조작 후 camera.html로 이동
                                        window.location.href = 'camera.html';
                                    });
                                }
                                </script>
                        </div>
                    </div>
                    <script>
                        // Pump 제어 버튼 클릭
                        document.getElementById('controlPumpBtn').addEventListener('click', () => {
                            const selectedAction = document.querySelector('input[name="water"]:checked');
                            if (selectedAction) {
                                fetch('http://127.0.0.1:3000/act', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ action: selectedAction.value }) // 선택된 값('pumpOn' 또는 'pumpOff') 전송
                                })
                                .then(response => response.json())
                                .then(data => {
                                    document.getElementById('status').innerText = data.message; // 서버 응답 메시지 출력
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    document.getElementById('status').innerText = 'Failed to control the pump';
                                });
                            } else {
                                alert('Please select an option for the pump');
                            }
                        });

                        // LED 제어 버튼 클릭
                        document.getElementById('controlLedBtn').addEventListener('click', () => {
                            const selectedAction = document.querySelector('input[name="led"]:checked');
                            if (selectedAction) {
                                fetch('http://127.0.0.1:3000/act', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ action: selectedAction.value }) // 선택된 값('ledOn' 또는 'ledOff') 전송
                                })
                                .then(response => response.json())
                                .then(data => {
                                    document.getElementById('status').innerText = data.message; // 서버 응답 메시지 출력
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    document.getElementById('status').innerText = 'Failed to control the LED';
                                });
                            } else {
                                alert('Please select an option for the LED');
                            }
                        });
                    </script>
                    
                    <div class="row">
                    <?php
                        include_once 'sensor.php';
                        if ($result->num_rows > 0) {
                            $value = $result->fetch_assoc();
                        }
                    ?> 
                           
                        <div class="col-xl-2 col-md-6">
                        <div class="card mb-4">
                                <div class="my-card-header">
                                    온도
                                </div>
                                <div class="my-card-body">
                                     <?php echo '<h2>'. $value['temperature'].'</h2>'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6">
                            <div class="card mb-4">
                                <div class="my-card-header">
                                    조도
                                </div>
                                <div class="my-card-body">
                                    <?php echo '<h2>'. $value['illumination'].'</h2>'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6">
                        <div class="card mb-4">
                                <div class="my-card-header">
                                    수분
                                </div>
                                <div class="my-card-body">
                                    <?php echo '<h2>'. $value['moisture'].'</h2>'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6">
                        <div class="card mb-4">
                                <div class="my-card-header">
                                    습도
                                </div>                            
                                <div class="my-card-body">
                                    <?php echo '<h2>'. $value['humidity'].'</h2>'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6">
                        <div class="card mb-4">
                                <div class="my-card-header">
                                    외부기온
                                </div>
                                <div class="my-card-body">
                                    <h2 class="current_temp"></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6">
                        <div class="card mb-4">
                                <div class="my-card-header">
                                    풍속
                                </div>
                                <div class="my-card-body">
                                    <h2 class="current_wind"></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    작물 상태 정보
                                </div>
                                <div class="card-body">
                                    <canvas id="myAreaChart" width="100%" height="40">
                                        <?php 
                                             include_once 'myAreaChart.php';
                                        ?>
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-xl-6" >
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    기상 정보
                                </div>
                                <div class="card-body">                                    
                                    <!-- 기상정보 api 출력-->
                                    <div style=" display:flex;    flex-direction: row;     justify-content: space-evenly;  padding : 40px; color : #000000;">
                                        <div style="float : left; margin-right:50px;">
                                            <div class="weather_icon"></div>
                                        </div><br>
                                        <div>
                                            <div class="current_temp" style="font-size : 40pt"></div>
                                            <div class="weather_description" style="font-size : 17pt"></div>
                                            <div class="city" style="font-size : 13pt"></div>
                                        </div>
                                        <div style="float : right; margin : -5px 0px 0px 60px; font-size : 14pt">
                                                <div class="temp_min"></div>
                                                <div class="temp_max"></div>
                                                <div class="humidity"></div>
                                                <div class="wind"></div>
                                                <div class="cloud"></div>
                                        </div>
                                    </div> 
                                </div>                          
                        </div>
                    </div> 
                </div>
                    
                <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            데이터 관리
                        </div>
                        <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>번호</th>
                                            <th>날짜</th>
                                            <th>온도</th>
                                            <th>습도</th>
                                            <th>조도</th>
                                            <th>수분</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        include_once 'data_table.php'; // table.php 파일 포함

                                        if (count($data) > 0) {
                                            // 데이터 출력
                                            foreach ($data as $value) {
                                                echo '<tr>';
                                                    echo '<td>' . $value['serial_no'] . '</td>';
                                                    echo '<td>' . $value['date'] . '</td>';
                                                    echo '<td>' . $value['temperature'] . '</td>';
                                                    echo '<td>' . $value['humidity'] . '</td>';
                                                    echo '<td>' . $value['illumination'] . '</td>';
                                                    echo '<td>' . $value['moisture'] . '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
    <script src="http://code.jquery.com/jquery-latest.js"></script>  <!-- jquery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    
    <!--<script src="assets/demo/chart-area-demo.js"></script> -->
    <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
     <script src="js/datatables-simple-demo.js"></script>
     <script src="js/openweathermap02.js"></script>
     <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> <!--날씨 아이콘-->
</body>
</html>

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

<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
type: 'bar',
data: {
labels: <?php echo json_encode($weeks); ?>,
datasets: [{
  label: "Max number of Leaf",
  backgroundColor: "rgba(54, 162, 235, 0.9)",
  borderColor: "rgba(2,117,216,1)",
  data: <?php echo json_encode($leaf_num); ?>
},{
label: "Avg length of Leaf",
  backgroundColor: "rgba(54, 162, 235, 0.5)",
  borderColor: "rgba(2,117,216,1)",
  data: <?php echo json_encode($leaf_len); ?>
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
      max: 16,
      maxTicksLimit: 10
    },
    gridLines: {
      display: true
    }
  }],
},
legend: {
//   display: false
}
}
});

</script>
