<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="스마트팜 영상 스트리밍" />
    <meta name="author" content="Your Name" />
    <title>스마트팜 카메라 스트리밍</title>
</head>
<body>
    <h1>스마트팜 실시간 영상</h1>
    <img id="cameraStream" width="640" height="480" alt="Video Stream"/>
    
    <script>
        // img 태그의 src 속성에 Python 서버의 스트리밍 URL을 설정
        document.getElementById('cameraStream').src = "http://localhost:5000/stream.mjpg";
    </script>
</body>
</html>