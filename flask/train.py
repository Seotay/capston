from sklearn.datasets import load_iris
from sklearn.linear_model import LogisticRegression
from sklearn.model_selection import train_test_split
import joblib

# 1. 데이터 로드 및 전처리
iris = load_iris()
X, y = iris.data, iris.target

# 2. 학습 데이터와 테스트 데이터 분리
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# 3. 모델 학습
model = LogisticRegression(max_iter=200)
model.fit(X_train, y_train)

# 4. 모델 저장
joblib.dump(model, 'iris_model.pkl')
print("Model saved!")
