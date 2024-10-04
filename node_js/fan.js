// server.js
const express = require('express');
const app = express();
const port = 3000;
const cors = require('cors');
const { exec } = require('child_process'); // 아두이노 명령어 실행을 위한 모듈
const { console } = require('inspector');
var SerialPort = require('serialport').SerialPort;

const myPort = new SerialPort({
    path:'/dev/ttyACM0',
    baudRate:9600
  });


app.use(express.json());
app.use(express.static('public')); // public 폴더에서 HTML 파일 제공
app.use(cors()); // CORS 허용


// 워터펌프 제어 라우트
app.post('/act', (req, res) => {
    const action = req.body.action; // action을 받아옴 (예: 'on' 또는 'off')
    console.log(action)
    if (action === 'on') {
        myPort.write('1', (err) => {
            if (err) {
              return res.status(500).json({ message: 'Failed to send start command' });
            }
            //res.json({ message: 'Water pump started' });
            //console.log(json({ message: 'Water pump start' }))
          });

    } else if (action === 'off') {
        myPort.write('0', (err) => {
            if (err) {
              return res.status(500).json({ message: 'Failed to send start command' });
            }
            //res.json({ message: 'Water pump started' });
            //console.log(json({ message: 'Water pump stop' }))
          });
    } else {
        res.status(400).send('Invalid action');
    }
});

app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
