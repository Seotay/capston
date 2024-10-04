const SerialPort = require('serialport').SerialPort;
const Readline = require('@serialport/parser-readline').ReadlineParser;
const database = require('./db.js')

const myPort = new SerialPort({
  path: '/dev/ttyACM0',
  baudRate: 9600
});

const parser = myPort.pipe(new Readline({ delimiter: '\n' }));


// Function to listen for sensor data and insert it into the database
function listenForSensorData() {
  let sensorData = [];

  // Listen for incoming serial data
  parser.on('data', (data) => {
    console.log('Received:', data.trim());
    sensorData.push(data.trim());

    // If we have all 4 sensor values (temperature, humidity, moisture, illumination)
    if (sensorData.length === 4) {
      const temp = parseFloat(sensorData[0]);
      const humidity = parseFloat(sensorData[1]);
      const moisture = parseInt(sensorData[2], 10);
      const illumination = parseInt(sensorData[3], 10);

      const currentDate = new Date();

      // Insert data into MySQL database
      const query = 'INSERT INTO sensor02 (date, temperature, humidity, moisture, illumination) VALUES (?, ?, ?, ?, ?)';
      database.db.query(query, [currentDate, temp, humidity, moisture, illumination], (err, result) => {
        if (err) {
          console.error('Error inserting data:', err);
        } else {
          console.log('Data inserted successfully');
        }
      });

      // Reset sensor data after storing
      sensorData = [];
    }
  });

  // Error handling for the serial port
  myPort.on('error', (err) => {
    console.error('Serial port error:', err.message);
  });
}

// function of Control Unit
function controlPump(action, callback) {
  console.log(action);

  if (action === 'pumpOn') {
      myPort.write('1', (err) => {  // '1'은 펌프 시작 명령
          if (err) {
              callback(err, null);
          } else {
              callback(null, 'Water pump started');  // 올바른 메시지
          }
      });
  } else if (action === 'pumpOff') {
      myPort.write('0', (err) => {  // '0'은 펌프 중지 명령
          if (err) {
              callback(err, null);
          } else {
              callback(null, 'Water pump stopped');  // 올바른 메시지
          }
      });

  } else if (action === 'ledOn') {
      myPort.write('2', (err) => {  // '2'은 LED 켜기 명령
          if (err) {
              callback(err, null);
          } else {
              callback(null, 'LED turned on');  // 메시지 수정
          }
      });

  } else if (action === 'ledOff') {
      myPort.write('3', (err) => {  // '4'은 LED 끄기 명령
          if (err) {
              callback(err, null);
          } else {
              callback(null, 'LED turned off');  // 메시지 수정
          }
      });

  } else {
      callback(new Error('Invalid action'), null);  // 잘못된 action 처리
  }
}

// Export the function to listen for sensor data
module.exports = {
  listenForSensorData,
  controlPump
};
