import requests
from datetime import datetime, timedelta
import xmltodict
import pymysql
import schedule
import time

#현재 년, 월, 일(YYYYMMDD), 현재 시간에서 1시간 전 기준(cur:1700 => 1600)
def get_current_datetime():
    current = datetime.now()
    
    base = current + timedelta(hours=-1)
    base_date = base.date().strftime("%Y%m%d")
    hour = base.hour
    
    if hour < 10:
        base_time = "0" + str(hour) + "00"
    else:
        base_time = str(hour) + "00"
        
    return base_date, base_time

#둘 중 되는 것으로 사용
#Incoding : 'oIgVWsMzVRh5TCldNdXizPGWmO0UDzNPdicwDV6nX0jGMbK%2FZdE%2F%2Be9rUfJnlw3TngHRxkBtDn6OOEt5Z7fapQ%3D%3D'
#Decoding : 'oIgVWsMzVRh5TCldNdXizPGWmO0UDzNPdicwDV6nX0jGMbK/ZdE/+e9rUfJnlw3TngHRxkBtDn6OOEt5Z7fapQ=='
keys = 'oIgVWsMzVRh5TCldNdXizPGWmO0UDzNPdicwDV6nX0jGMbK/ZdE/+e9rUfJnlw3TngHRxkBtDn6OOEt5Z7fapQ=='
url = 'http://apis.data.go.kr/1360000/VilageFcstInfoService_2.0/getUltraSrtNcst'
#nx(gridX), ny(gridY) (68, 106) => 개신동

def forecast():
    base_date, base_time = get_current_datetime()
    # base_date = '20240519'
    # base_time = '0800'
    params ={'serviceKey' : keys, 
         'pageNo' : '1', 
         'numOfRows' : '1000', 
         'dataType' : 'XML', 
         'base_date' : base_date, 
         'base_time' : base_time, 
         'nx' : '68', 
         'ny' : '106' }
    
    # 값 요청 (웹 브라우저 서버에서 요청 - url주소와 파라미터)
    res = requests.get(url, params = params)

    #XML -> 딕셔너리
    xml_data = res.text
    dict_data = xmltodict.parse(xml_data)

    #값 가져오기
    #T1H(기온), RN1(1시간 강우량), UUU(동서바람성분), VVV(남북바람성분)
    #REH(습도), PTY(강수형태), VEC(풍향), WSD(풍속)
    weather_data = dict()
    for item in dict_data['response']['body']['items']['item']:
        
        # 강수형태: 없음(0), 비(1), 비/눈(2), 눈(3), 빗방울(5), 빗방울눈날림(6), 눈날림(7)
        if item['category'] == 'PTY':
            weather_data['sky'] = item['obsrValue']
        #습도
        if item['category'] == 'REH':
            weather_data['hum'] = item['obsrValue']
        #1시간 강우량
        if item['category'] == 'RN1':
            weather_data['pre'] = item['obsrValue']
        # 기온
        if item['category'] == 'T1H':
            weather_data['tmp'] = item['obsrValue']
        # 동서바람성분
        if item['category'] == 'UUU':
            weather_data['uuu'] = item['obsrValue']
        # 남북바람성분
        if item['category'] == 'VVV':
            weather_data['vvv'] = item['obsrValue']
        #풍향
        if item['category'] == 'VEC':
            weather_data['vec'] = item['obsrValue']
        #풍속
        if item['category'] == 'WSD':
            weather_data['wsd'] = item['obsrValue']
    
    return weather_data, base_date, base_time

def weather_input_db():
    data, base_date, base_time = forecast()

    database = pymysql.connect(
        host='localhost',
        user='root',
        password='0000',
        db='embedded',
        charset='utf8'
    )
        
    cursor = database.cursor()

    query = """INSERT INTO weather (date, sky, hum, pre, tmp, uuu, vec, vvv, wsd) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"""
    #값 순서 : base_date, base_time, sky, hum, pre, tmp, uuu, vec, vvv, wsd
    date = datetime.strptime(base_date + base_time, "%Y%m%d%H%M")

    values = [date]
    for key in data:
        values.append(data[key])
    
    cursor.execute(query, values)     
    database.commit()

    print("{} 날씨 데이터 저장".format(date))
    
    cursor.close()
    database.close()

weather_input_db()
print("Run")
# schedule.every().hour.at(":05").do(weather_input_db)

# while(True):
#     try:
#         schedule.run_pending()
#         time.sleep(60)
#     except KeyboardInterrupt:
#         break