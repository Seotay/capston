# from flask import Flask, jsonify
# from flask_cors import CORS

# app = Flask(__name__)
# CORS(app)  # CORS 허용 설정

# @app.route('/sound/<name>', methods=['GET'])
# def get_sound(name):
#     if name == "dog":
#         return jsonify({"sound": "멍멍"})
#     elif name == "cat":
#         return jsonify({"sound": "야옹"})
#     elif name == "pig":
#         return jsonify({"sound": "꿀꿀"})
#     else:
#         return jsonify({"sound": "알수없음"})

# if __name__ == "__main__":
#     app.run(port=5000)

from flask import Flask, request, jsonify
from flask_cors import CORS
import joblib
import numpy as np

# 1. Flask 애플리케이션 설정    
app = Flask(__name__)
CORS(app)

# 2. 저장된 모델 로드
model = joblib.load('./flask/iris_model.pkl')

# 3. 예측 API 엔드포인트
@app.route('/predict', methods=['POST'])
def predict():
    # 4. 요청 데이터 가져오기
    data = request.json['data']  # 요청된 JSON에서 'data' 키로 입력 데이터 받기
    
    # 5. 입력 데이터를 NumPy 배열로 변환
    input_data = np.array(data).reshape(1, -1)
    
    # 6. 예측 수행
    prediction = model.predict(input_data)
    predicted_class = int(prediction[0])
    
    # 7. 예측 결과 반환
    return jsonify({'prediction': predicted_class})

if __name__ == "__main__":
    app.run(port=5000)
