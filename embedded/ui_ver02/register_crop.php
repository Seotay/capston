<?php
include_once 'dbconfig.php';

session_start(); // 세션 시작

// 작물 등록 폼에서 제출된 데이터를 받아옴
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // 세션에서 사용자 ID 가져오기
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id']; // 로그인한 사용자의 ID
    } else {
        echo "사용자가 로그인하지 않았습니다.";
        exit();
    }

    $crop_name = $_POST['crop_name'];
    $variety = $_POST['variety'];
    $planting_date = $_POST['planting_date'];

    // 파일 업로드 처리
    if (isset($_FILES['crop_image']) && $_FILES['crop_image']['error'] == 0) {
        $crop_image = $_FILES['crop_image'];

        // 이미지 파일의 정보
        $image_name = $crop_image['name'];
        $image_tmp_name = $crop_image['tmp_name'];
        $image_size = $crop_image['size'];
        $image_error = $crop_image['error'];

        // 이미지 업로드 디렉토리
        $upload_directory = 'uploads/'; // 이 디렉토리가 존재해야 합니다.

        // 파일 확장자 확인 (예: jpg, png 등)
        $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_extension, $allowed_extensions) && $image_size <= 2000000) { // 2MB 이하
            // 이미지 파일 저장
            $new_image_name = uniqid('', true) . '.' . $file_extension; // 고유한 파일 이름 생성
            move_uploaded_file($image_tmp_name, $upload_directory . $new_image_name);

            // 데이터베이스에 작물 정보 저장
            $sql = "INSERT INTO crop (user_id, crop_name, variety, planting_date, crop_image) VALUES ('$user_id', '$crop_name', '$variety', '$planting_date', '$new_image_name')";

            if ($conn->query($sql) === TRUE) {
                echo "작물 등록 완료";
                header("Location: register_crop.php"); // 성공 페이지로 리다이렉트
                exit();
            } else {
                echo "작물 등록 실패: " . $conn->error;
            }
        } else {
            echo "허용되지 않는 파일 형식이거나 파일 크기가 너무 큽니다.";
        }
    } else {
        echo "이미지 파일을 업로드하는 데 문제가 발생했습니다.";
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
                    SMARTFARM
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">작물 등록</h1>
                    <ol class="breadcrumb mb-4">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li> -->
                        <!-- <li class="breadcrumb-item active">Static Navigation</li> -->
                    </ol>
                    <div class="row">
                        <div class="card mb-4" style="border:0px;">
                            <div class="card-body">


                                <!-- 작물 정보 등록 폼 -->
                                <form action="register_crop.php" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="crop_name" name="crop_name" type="text"
                                                    placeholder="Enter crop name" required />
                                                <label for="crop_name">작물명</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="variety" name="variety" type="text"
                                                    placeholder="Enter variety" required />
                                                <label for="variety">품종</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="planting_date" name="planting_date" type="date"
                                            placeholder="Enter planting date" required />
                                        <label for="planting_date">심기일자</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="crop_image" name="crop_image" type="file"
                                            accept="image/*" required />
                                        <label for="crop_image">작물 이미지</label>
                                    </div>

                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-block">등록하기</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>



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