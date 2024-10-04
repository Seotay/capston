<!-- <?php
// login 성공시에 세션의 정보를 가져올 수 있음.
session_name('test_session');
session_start();

?> -->

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
                                        <a class="nav-link" href="login.html">회원 정보 보기</a>
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
                                        <a class="nav-link" href="401.html">작물 정보 보기</a>
                                        <a class="nav-link" href="404.html">작물 수정</a>
                                        <a class="nav-link" href="500.html">작물 삭제</a>
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
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            작물 주기 예측
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
                            <form id="waterForm"  onsubmit="document.reload()">
                            <div class="card-body">물공급 제어</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                     <input id='startPump' type='radio' name = "water">On
                                     <input id ='stopPump' type='radio' name = "water">Off
                                     <input class = "styled-button-water" type="submit" value="Control" >
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                            </form>
                                <script>
                                     function handleSubmit(event) {
                                    event.preventDefault();  // 폼 제출 시 페이지 새로고침 방지

                                    // 선택된 라디오 버튼 값 가져오기
                                    const waterAction = document.querySelector('input[name="water"]:checked');

                                    if (waterAction) {
                                        const actionValue = waterAction.id === 'startPump' ? 'start' : 'stop';

                                        // 서버로 POST 요청 보내기

                                        fetch('http://localhost:3000/pump',{
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({ action: actionValue }),
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                        console.log(data);
                                        alert(data.message);  // 서버 응답 메시지 표시
                                        })
                                        .catch(error => {
                                        console.error('Error:', error);
                                        });
                                    } else {
                                        alert('Please select an option.');
                                    }
                                    }

                                </script>
                        </div>
                        <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <form action="act.php" method ="GET" onsubmit="document.reload()">
                                <div class="card-body">LED 제어</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <input type='radio' name = "led" value="On">On
                                     <input type='radio' name = "led" value="Off">Off
                                     <input class = "styled-button-led" type="submit" value="Control" >
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <form action="act.php" method ="GET" onsubmit="document.reload()">
                                <div class="card-body">카메라</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                  <input type='radio' name = "camera" value="On">On
                                     <input type='radio' name = "camera" value="Off">Off
                                     <input class = "styled-button-camera" type="submit" value="Control" >
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

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
                                     <?php echo '<h2>'. $value['temp'].'</h2>'; ?>
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
                    <div class="card mb-4">
                    <h1>Sensor Data</h1>
                    <table id="data-table" border="1" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Temperature</th>
                                <th>Humidity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="data-container">
                            <!-- Data rows will be added here -->
                        </tbody>
                    </table>
                    <script>
        // Fetch sensor data from the server
        //fetch('http://localhost:3000/sensors')
    //         .then(response => {
    //             if (!response.ok) {
    //                 throw new Error('Network response was not ok');
    //             }
    //             return response.json();
    //         })
    //         .then(data => {
    //             const dataContainer = document.getElementById('data-container');
    //             dataContainer.innerHTML = ''; // Clear any existing content
    //             if (data && Array.isArray(data.data)) {
    //                 data.data.forEach(sensor => {
    //                     const row = document.createElement('tr');
    //                     row.innerHTML = `
    //                         <td>${sensor.serial_no}</td>
    //                         <td>${sensor.temp}</td>
    //                         <td>${sensor.humidity}</td>
    //                         <td>${sensor.date}</td>
    //                     `;
    //                     dataContainer.appendChild(row);
    //                 });
    //             } else {
    //                 dataContainer.innerHTML = '<tr><td colspan="4">No data found.</td></tr>';
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Fetch error:', error);
    //             const dataContainer = document.getElementById('data-container');
    //             dataContainer.innerHTML = '<tr><td colspan="4">An error occurred while fetching data.</td></tr>';
    //         });
                 </script>
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
                                        if ($result->num_rows > 0) {
                                            // 결과가 있는 경우 데이터 출력
                                            while ($value = $result->fetch_assoc()) {
                                                echo '<tr>';
                                                    echo '<td>'.$value['serial_no'].'</td>';
                                                    echo '<td>'.$value['date'].'</td>';
                                                    echo '<td>'.$value['temp'].'</td>';
                                                    echo '<td>'.$value['humidity'].'</td>';
                                                    echo '<td>'.$value['illumination'].'</td>';
                                                    echo '<td>'.$value['moisture'].'</td>';
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
                        <div class="text-muted">TaeHyeok&HyeonGyu &copy; Web Smart Farm</div>
                        <div>
                            <a href="#">tjxogur03@naver.com</a>
                            
                            <a href="#"> &amp; uhyeongyu@naver.com</a>
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
