<?php
include_once 'dbconfig.php';
session_start(); // 세션 시작
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    
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
    <title>Static Navigation - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/mystles.css" rel="stylesheet" />
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

                    <ol class="breadcrumb mb-4">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li> -->
                        <!-- <li class="breadcrumb-item active">Static Navigation</li> -->
                    </ol>

                    <!-- 사용자 정보 보기 -->
                    <style>
                        
                        .user_info_container {
                        max-width: 800px;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #fff;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                        table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 20px;
                        }
                        table, th, td {
                        border: 1px solid #ddd;
                        }
                        th, td {
                        padding: 10px;
                        text-align: left;
                        }
                        th {
                        background-color: #f8f8f8;
                        }
                    </style>

                     <h1 class="mt-4">나의 정보</h1>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Password</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                            </tr>
                                
                            <?php
                            
                            // 세션에 저장된 사용자 ID 확인
                                // 사용자 정보 조회 쿼리
                                $sql = "SELECT id, pw, name, email, phonenumber, address 
                                        FROM user 
                                        WHERE id = '$user_id';";
                                
                                // 쿼리 실행
                                $result = $conn->query($sql);

                                // 결과 확인
                                if ($result) {
                                    if ($result->num_rows > 0) {
                                        // 결과가 있는 경우 데이터 출력
                                        while ($value = $result->fetch_assoc()) {
                                            echo '<tr>';
                                                echo '<td>' . htmlspecialchars($value['id']) . '</td>';
                                                echo '<td>********</td>'; // 비밀번호는 숨김 처리
                                                echo '<td>' . htmlspecialchars($value['name']) . '</td>';
                                                echo '<td>' . htmlspecialchars($value['email']) . '</td>';
                                                echo '<td>' . htmlspecialchars($value['phonenumber']) . '</td>';
                                                echo '<td>' . htmlspecialchars($value['address']) . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                } else {
                                    echo "<script>alert('Error executing query.')</script>";
                                }
                                
                            ?>
                        </table>
                        <h1 class="mt-4">작물 정보</h1>
                        <table>
                            <tr>
                                <th>작물명</th>
                                <th>품종</th>
                                <th>심기 일자</th>
                                <th>작물 이미지</th>
                            </tr>
                                <?php
                                // 세션에 저장된 사용자 ID 확인
                                
                                    // 사용자 ID에 따른 작물 정보 조회 쿼리
                                    $sql = "SELECT crop_num, crop_name, variety, planting_date, crop_image 
                                            FROM crop 
                                            WHERE user_id = '$user_id';";
                                    
                                    // 쿼리 실행
                                    $result = $conn->query($sql);

                                    // 결과 확인
                                    if ($result) {
                                        if ($result->num_rows > 0) {
                                            // 결과가 있는 경우 데이터 출력
                                            while ($value = $result->fetch_assoc()) {
                                                echo '<tr>';
                                                    echo '<td>' . htmlspecialchars($value['crop_name']) . '</td>';
                                                    echo '<td>' . htmlspecialchars($value['variety']) . '</td>';
                                                    echo '<td>' . htmlspecialchars($value['planting_date']) . '</td>';
                                                    echo '<td><img src="crop_image' . htmlspecialchars($value['crop_image']) . '" alt="작물 이미지" style="width:100px; height:auto;"></td>';
                                                    
                                                    echo '<td style="text-align: center; padding: 5px; width: 90px;"><form action="delete_crop.php" method="post" style="margin:0;">
                                                                <input type="hidden" name="crop_num" value="' . htmlspecialchars($value['crop_num']) . '">
                                                                <button type="submit" class="btn btn-primary btn-block" onclick="return confirm(\'정말 삭제하시겠습니까?\');">삭제</button>
                                                            </form></td>';
                                                    echo '</tr>';
                                            }
                                        } else {
                                            echo "<script>alert('등록된 작물이 없습니다.')</script>";
                                            
                                          
                                        }
                                    } else {
                                        echo "<script>alert('Error executing query.')</script>";
                                    }
                                $conn->close();
                                ?>
                        </table>
                    

                    
                    <!-- <div class="card mb-4">
                        <div class="card-body">When scrolling, the navigation stays at the top of the page. This is the
                            end of the static navigation demo.</div>
                    </div> -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>