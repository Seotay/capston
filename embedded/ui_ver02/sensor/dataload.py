import pymysql
import pandas as pd
import matplotlib.pyplot as plt

db = pymysql.connect(
    host='localhost',
    user='root',
    password='admin',
    db='test',
    charset='utf8'
)

cur = db.cursor()

query = "SELECT date, ill, mois, humi, temp FROM test_data_table"
cur.execute(query)

data = cur.fetchall()

print(data)
cols = ['일자','조도', '토양수분', '습도', '온도']
df = pd.DataFrame(data, columns=cols)
print(df)
print(df.shape)
x = range(df.shape[0])

print(x)
plt.figure(figsize=(10,5))
plt.plot(x, df['온도'])
plt.show()



