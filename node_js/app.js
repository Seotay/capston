const express = require('express');
const cors = require('cors');
const arduino = require('./arduino');
const app = express();
const port = 3000;

// 모든 도메인에 허용 요청
app.use(cors());
app.use(express.json());

// pump function
app.post('/act', (req, res) => {
    const { action } = req.body;
    console.log('Received action:', action);

    // Use the controlUnit function from arduino.js
    arduino.controlUnit(action, (err, message) => {
        if (err) {
            return res.status(500).json({ message: 'Failed to control pump' });
        }
        res.json({ message });
    });
});

// 센서값 저장 함수
arduino.listenForSensorData();

// root 라우터
app.get('/', (req, res) => {
  res.send('<h1>root</h1>');
});

app.listen(port, () => {
    console.log(`서버가 http://localhost:${port} 에서 실행 중입니다.`);
});
