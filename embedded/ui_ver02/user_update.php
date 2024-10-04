<?php
include 'dbconfig.php'; // 데이터베이스 연결 파일 포함
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id']; // 세션에서 사용자 ID 가져오기
    $current_password = $_POST['password'];
    $new_password = $_POST['pw'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];

    // 기존 비밀번호 확인 쿼리
    $sql = "SELECT pw FROM user WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['pw'] == $current_password){

            // 정보 업데이트 쿼리
            $update_sql = "UPDATE user SET pw = '$new_password', name = '$name', email = '$email', phonenumber = '$phonenumber', address = '$address' WHERE id = '$user_id'";
            
            if ($conn->query($update_sql) === TRUE) {
                echo "<script>alert('정보가 성공적으로 수정되었습니다.'); window.location.href='user_info.php';</script>";
            } else {
                echo "<script>alert('정보 수정 중 오류가 발생했습니다.');</script>";
            }
        } else {
            echo "<script>alert('기존 비밀번호가 올바르지 않습니다.');</script>";
        }
    } else {
        echo "<script>alert('사용자를 찾을 수 없습니다.');</script>";
    }
}

$conn->close();
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

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            My Page
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    내 정보 관리
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="user_info.php">회원 정보 보기</a>
                                        <a class="nav-link" href="user_update.php">회원 정보 수정</a>
                                        <a class="nav-link" href="user_delete.php">회원 탈퇴</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    작물 관리
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
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
                    <h1 class="mt-4">회원 정보 수정</h1>
                    <ol class="breadcrumb mb-4">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li> -->
                        <!-- <li class="breadcrumb-item active">Static Navigation</li> -->
                    </ol>

                    <!-- 회원 정보 수정 폼 -->

                    <form action="user_update.php" class="form-signin" style="max-width:500px; margin: 0 auto;" method="post">

                        <div class="mb-3">
                            <label for="password">비밀번호</label>
                            <input type="password" name="password" placeholder='기존 비밀번호' class="form-control" required>
                        </div>

                        <div class="mb-3">
                                <label th:for="nickname">비밀번호 변경</label>
                                <input type="password" name = "pw" placeholder = '비밀번호 변경' class="form-control" id = "password_1">
                                                             

                        <div class="mb-3">
                            <label for="name">이름</label>
                            <input type="text" name="name" placeholder='사용자 이름 변경' class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder='이메일 입력' class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tel">전화번호</label>
                            <input type="tel" name="phonenumber" placeholder='전화번호 입력' class="form-control"
                                id="phonenumber" required>
                        </div>

                        <div class="mb-3">
                            <label for="address">주소</label>
                            <input type="text" name="address" placeholder='주소 변경' class="form-control" id="address"required>
                        </div>

                        <div class="mb-3">
                            <button class="w-100 btn btn-lg btn-primary" type="submit">수정</button>
                        </div>

                        <div class="mb-3">
                            <a type="button" style="color:white" class="w-100 btn btn-lg btn-secondary"
                                onclick="window.history.back();">취소</a>
                        </div>

                    </form>



                    <!-- <div class="card mb-4">
                        <div class="card-body">When scrolling, the navigation stays at the top of the page. This is the
                            end of the static navigation demo.</div>
                    </div> -->
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
    

</body>

</html>