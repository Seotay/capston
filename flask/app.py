import pandas as pd
import numpy as np
import torch
from flask_cors import CORS
from flask import Flask, jsonify, request
from sklearn.preprocessing import MinMaxScaler
from torch.autograd import Variable
from model.lstm import LSTM1
import mysql.connector
from apscheduler.schedulers.background import BackgroundScheduler

# Initialize Flask app
app = Flask(__name__)
CORS(app)

# Global variables for predictions
predicted_leaf_len = []
predicted_leaf_num = []
future_dates_str = []

def get_sensor_data():
    connection = mysql.connector.connect(
        host="localhost",      
        user="root",
        password="admin",
        database="embedded" 
    )
    cursor = connection.cursor()
    cursor.execute("SELECT serial_no, date, temperature, humidity, moisture, illumination FROM sensor02")
    data = cursor.fetchall()
    cursor.close()
    connection.close()
    return data

def preprocess_data(data):
    columns = ['serial_no', 'date', 'temperature', 'humidity', 'moisture', 'illumination']
    df = pd.DataFrame(data, columns=columns)
    df['date'] = pd.to_datetime(df['date'])
    
    # Calculate weeks
    start_date = df['date'].iloc[0]
    df['weeks'] = (df['date'] - start_date).dt.total_seconds() / (7 * 24 * 60 * 60)  # Calculate weeks
    df['weeks'] = df['weeks'].apply(lambda x: int(x))
    
    # Prepare test data
    test = df.tail().copy()
    test.index = test['date']
    test = test.drop(columns=['serial_no', 'date'])
    last_date = test.index[-1]
    future_dates = [last_date + pd.Timedelta(days=i) for i in range(1, 6)]  # Generate dates for the next 5 days

    return future_dates, test

def load_model(input_size, hidden_size, num_layers, num_classes, seq_lenth, device, class_type):
    lstm_model = LSTM1(num_classes, input_size, hidden_size, num_layers, seq_lenth).to(device)
    
    if class_type == 'leaf_len':
        lstm_model.load_state_dict(torch.load('/var/www/html/flask/model/lstm_model.pth', weights_only=True))
    elif class_type == 'leaf_num':
        lstm_model.load_state_dict(torch.load('/var/www/html/flask/model/lstm_model_ver02.pth', weights_only=True))
    
    lstm_model.eval()  # Set model to evaluation mode
    return lstm_model

def update_predictions():
    # Hyperparameters
    num_epochs = 500
    learning_rate = 0.0001
    input_size = 5
    hidden_size = 256
    num_layers = 1
    num_classes = 1

    global predicted_leaf_len, predicted_leaf_num, future_dates_str

    data = get_sensor_data()
    future_dates, test_data = preprocess_data(data)

    train_df = pd.read_csv('/var/www/html/flask/data/crop_data.tsv', sep='\t', header=0)
    train_leaf_len = train_df[['leaf_len']]
    train_leaf_num = train_df[['leaf_num']]

    mm_x = MinMaxScaler()
    mm_leaf_len = MinMaxScaler()
    mm_leaf_num = MinMaxScaler()

    X_test = mm_x.fit_transform(test_data)
    mm_leaf_len.fit_transform(train_leaf_len)
    mm_leaf_num.fit_transform(train_leaf_num)

    X_test_tensors = Variable(torch.Tensor(X_test))
    X_test_tensors_final = torch.reshape(X_test_tensors, (X_test_tensors.shape[0], 1, X_test_tensors.shape[1]))

    # GPU setting
    device = torch.device("cuda:0" if torch.cuda.is_available() else "cpu")

    # Load the LSTM model
    lstm_model_len = load_model(input_size, hidden_size, num_layers, num_classes, X_test_tensors_final.shape[0], device, class_type='leaf_len')
    lstm_model_num = load_model(input_size, hidden_size, num_layers, num_classes, X_test_tensors_final.shape[0], device, class_type='leaf_num')

    # Make predictions
    test_predict_len = lstm_model_len(X_test_tensors_final.to(device))
    predicted_leaf_len = mm_leaf_len.inverse_transform(test_predict_len.data.detach().cpu().numpy()).tolist()

    test_predict_num = lstm_model_num(X_test_tensors_final.to(device))
    predicted_leaf_num = mm_leaf_num.inverse_transform(test_predict_num.data.detach().cpu().numpy()).tolist()

    future_dates_str = [date.strftime('%Y-%m-%d %H:%M:%S') for date in future_dates]

# Set up the scheduler to update predictions every minute
scheduler = BackgroundScheduler()
scheduler.add_job(update_predictions, 'interval', minutes=1)
scheduler.start()

@app.route('/')
def home():
    return 'This is Home!'

@app.route('/predict_len', methods=['GET'])
def predict_len():
    return jsonify({
        'date': future_dates_str,
        'predicted_test_data': predicted_leaf_len
    })

@app.route('/predict_num', methods=['GET'])
def predict_num():
    return jsonify({
        'date': future_dates_str,
        'predicted_test_data': predicted_leaf_num
    })

if __name__ == '__main__':
    app.run(port=5000)
