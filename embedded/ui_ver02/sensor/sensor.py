import serial
import pymysql
from datetime import datetime
import schedule, time
import weather

print("run")

def sensor_value_input_db():
    port = serial.Serial("/dev/ttyACM0", "9600")
    
    db = pymysql.connect(
        host='localhost',
        user='root',
        password='admin',
        db='smart',
        charset='utf8'
    )
    
    cur = db.cursor()
    
    ill_data = port.readline()
    moist_data = port.readline()
    humi_data = port.readline()
    temp_data = port.readline()

    date = datetime.today()
    current_date = date.strftime("%Y/%m/%d %H:%M:%S")

    #2024-03-05기준 1주차(달력상 10주차) => 10 - 9 => 1주차
    #ex) 2024-03-12 달력상 11주차 - 9 => 2주차
    cal_week = (date.isocalendar())[1]
    current_week = cal_week - 9

    print("{} 데이터 저장".format(current_date))
    query = """INSERT INTO sensor (date, weeks,	temperature, humidity, moisture, illumination, leaf_len, leaf_num) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"""
    values = [current_date, current_week, temp_data, humi_data, moist_data, ill_data, 0, 0]

    cur.execute(query, values)
    db.commit()

    cur.close()
    db.close()

#schedule.every(1).minute.do(sensor_value_input_db)   
schedule.every().hour.at(":30").do(sensor_value_input_db)
schedule.every().hour.at(":00").do(sensor_value_input_db)

#schedule.every().hour.at(":00").do(weather.weather_input_db)
# #schedule.every(1).minute.do(weather.weather_input_db)
while(True):
   try:
       schedule.run_pending()
       time.sleep(30)
   except KeyboardInterrupt:
       break

# port = serial.Serial("/dev/ttyACM0", "9600")

# db = pymysql.connect(
#     host='localhost',
#     user='root',
#     password='admin',
#     db='smart',
#     charset='utf8'
# )

# cur = db.cursor()

# while True:
#     try:
#         ill_data = port.readline()
#         moist_data = port.readline()
#         humi_data = port.readline()
#         temp_data = port.readline()

#         date = datetime.today()
#         current_date = date.strftime("%Y/%m/%d %H:%M:%S")

#         #2024-03-05기준 1주차(달력상 10주차) => 10 - 9 => 1주차
#         #ex) 2024-03-12 달력상 11주차 - 9 => 2주차
#         cal_week = (date.isocalendar())[1]
#         current_week = cal_week - 9

#         print("{} 데이터 저장".format(current_date))
#         query = """INSERT INTO sensor (date, weeks,	temperature, humidity, moisture, illumination, leaf_len, leaf_num) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"""
#         values = [current_date, current_week, temp_data, humi_data, moist_data, ill_data, 0, 0]

#         cur.execute(query, values)
#         db.commit()
#     except KeyboardInterrupt:
#         break
    
# db.close()
