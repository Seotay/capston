<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Static Navigation - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Welcome</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
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
                    SMARTFARM
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">실시간 영상 정보</h1>
                    <ol class="breadcrumb mb-4">
                    
                    </ol>
                    <div class="card mb-4" id="cameraCard">
                        <img id="cameraStream" alt="Video Stream" /> 
                        <script>
                            // img 태그의 src 속성에 Python 서버의 스트리밍 URL을 설정
                            document.getElementById('cameraStream').src = "http://localhost:5000/stream.mjpg";
                        </script>  
                    </div>

                    <style>
                        /* card 가운데 정렬 */
                        #cameraCard {
                            display: flex;
                            justify-content: center; /* 가로 중앙 정렬 */
                            align-items: center; /* 세로 중앙 정렬 */
                            flex-direction: column;
                            background-color: #f8f9fa; /* 카드 배경색 */
                            padding: 20px;
                            border-radius: 10px; /* 카드 모서리를 둥글게 */
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 그림자 효과 */
                            margin: 20px auto; /* 상하 간격 및 좌우 중앙 */
                            max-width: 80%; /* 카드의 최대 너비를 설정 */
                        }

                        /* 이미지 스타일 */
                        #cameraStream {
                            width: 650px; /* 이미지 너비 */
                            height: 480px; /* 이미지 높이 */
                            border: 3px solid #007bff; /* 이미지 테두리 */
                            border-radius: 8px; /* 이미지 모서리를 둥글게 */
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* 그림자 효과 */
                            margin-bottom: 10px; /* 이미지와 카드 간격 */
                        }

                        /* 반응형 디자인을 위해 작은 화면에서의 이미지 크기 조정 */
                        @media (max-width: 768px) {
                            #cameraStream {
                                width: 100%; /* 작은 화면에서는 이미지가 화면 너비를 차지 */
                                height: auto; /* 높이를 비율에 맞게 조정 */
                            }
                            #cameraCard {
                                max-width: 95%; /* 작은 화면에서 카드 너비 */
                            }
                        }
                    </style>    

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
</body>

</html>