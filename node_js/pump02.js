const SerialPort = require('serialport').SerialPort;
const Readline = require('@serialport/parser-readline').ReadlineParser;

// 시리얼 포트 설정 (아두이노 연결)
const myPort = new SerialPort({
    path: '/dev/ttyACM0',
    baudRate: 9600
});

const parser = myPort.pipe(new Readline({ delimiter: '\n' })); // 시리얼 데이터 읽기용 파서

// 워터펌프 제어 함수
function controlPump(action, callback) {
    if (action === 'on') {
        myPort.write('1', (err) => {
            if (err) {
                callback(err, null);
            } else {
                callback(null, 'Water pump started');
            }
        });
    } else if (action === 'off') {
        myPort.write('0', (err) => {
            if (err) {
                callback(err, null);
            } else {
                callback(null, 'Water pump stopped');
            }
        });
    } else {
        callback(new Error('Invalid action'), null);
    }
}

// 모듈 내보내기
module.exports = {
    controlPump
};