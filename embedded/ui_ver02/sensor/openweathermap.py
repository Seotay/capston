import requests
import json
 
city = "Seoul"
apikey = "ee92d96bff43ee54f6814aa55f1ffa20"
lang = "kr"
 
api = f"""http://api.openweathermap.org/data/2.5/\
weather?q={city}&appid={apikey}&lang={lang}&units=metric"""
 
result = requests.get(api)
 
data = json.loads(result.text)
 
print(data)