const express = require('express');
const app = express();
const port = 3000;
const cors = require('cors');
const SerialPort = require('serialport').SerialPort; // serialport 모듈 가져오기
const Readline = require('@serialport/parser-readline').ReadlineParser;

// 시리얼 포트 설정 (아두이노 연결)
const myPort = new SerialPort({
    path: '/dev/ttyACM0',
    baudRate: 9600
});

const parser = myPort.pipe(new Readline({ delimiter: '\n' })); // 시리얼 데이터 읽기용 파서

app.use(express.json());
app.use(express.static('public')); // public 폴더에서 HTML 파일 제공
app.use(cors()); // CORS 허용

// 워터펌프 제어 라우트
app.post('/act', (req, res) => {
    const action = req.body.action; // action을 받아옴 (예: 'on' 또는 'off')
    console.log(`Action received: ${action}`); // 전달된 액션 로깅

    if (action === 'pumpOn') {
        myPort.write('1', (err) => {
            if (err) {
                return res.status(500).json({ message: 'Failed to send start command' });
            }
            res.json({ message: 'Water pump started' });
            console.log('Water pump started');
        });

    } else if (action === 'pumpOff') {
        myPort.write('0', (err) => {
            if (err) {
                return res.status(500).json({ message: 'Failed to send stop command' });
            }
            res.json({ message: 'Water pump stopped' });
            console.log('Water pump stopped');
        });
    } else {
        res.status(400).json({ message: 'Invalid action' });
    }
});

// 서버 실행
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
