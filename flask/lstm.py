import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import datetime
import torch
import torch.nn as nn
from torch.autograd import Variable
import torch.optim as optim
from torch.utils.data import Dataset, DataLoader
from sklearn.preprocessing import StandardScaler, MinMaxScaler


# GPU setting
device = torch.device("cuda:0" if torch.cuda.is_available() else "cpu")
print(device)


# Load data
df = pd.read_csv('crop_data.tsv', header=0, sep='\t')

# convert to datetime type
df['date'] = pd.to_datetime(df['date'])

# Split year, month, day
df['year'] = df['date'].dt.year
df['month'] = df['date'].dt.month
df['day'] = df['date'].dt.day
df.index = df['date']
df.drop(columns=['serial_no'], inplace=True) # remove column
X, y = df[['year', 'month', 'day', 'weeks', 'temperature', 'humidity', 'moisture', 'illumination', 'leaf_num']], df[['leaf_len']]



# Normailization and Scaling
mm = MinMaxScaler()


X_mm = mm.fit_transform(X)
y_mm = mm.fit_transform(y) 

# Train Data
X_train = X_mm[:int(len(X)*0.8), :]
X_test = X_mm[int(len(X)*0.8):, :]

# Test Data
y_train = y_mm[:int(len(X)*0.8), :]
y_test = y_mm[int(len(X)*0.8):, :] 

print("Training Shape", X_train.shape, y_train.shape)
print("Testing Shape", X_test.shape, y_test.shape) 

X_train_tensors = Variable(torch.Tensor(X_train))
X_test_tensors = Variable(torch.Tensor(X_test))

y_train_tensors = Variable(torch.Tensor(y_train))
y_test_tensors = Variable(torch.Tensor(y_test))

X_train_tensors_final = torch.reshape(X_train_tensors,   (X_train_tensors.shape[0], 1, X_train_tensors.shape[1]))
X_test_tensors_final = torch.reshape(X_test_tensors,  (X_test_tensors.shape[0], 1, X_test_tensors.shape[1]))

print("Training Shape", X_train_tensors_final.shape, y_train_tensors.shape)
print("Testing Shape", X_test_tensors_final.shape, y_test_tensors.shape) 



# Define LSTM Model
class LSTM1(nn.Module):
  def __init__(self, num_classes, input_size, hidden_size, num_layers, seq_length):
    super(LSTM1, self).__init__()
    self.num_classes = num_classes #number of classes
    self.num_layers = num_layers #number of layers
    self.input_size = input_size #input size
    self.hidden_size = hidden_size #hidden state
    self.seq_length = seq_length #sequence length
 
    self.lstm = nn.LSTM(input_size=input_size, hidden_size=hidden_size,
                      num_layers=num_layers, batch_first=True) #lstm
    self.fc_1 =  nn.Linear(hidden_size, 128) #fully connected 1
    self.fc = nn.Linear(128, num_classes) #fully connected last layer

    self.relu = nn.ReLU() 

  def forward(self,x):
    h_0 = Variable(torch.zeros(self.num_layers, x.size(0), self.hidden_size)).to(device) #hidden state
    c_0 = Variable(torch.zeros(self.num_layers, x.size(0), self.hidden_size)).to(device) #internal state   
    output, (hn, cn) = self.lstm(x, (h_0, c_0)) #lstm with input, hidden, and internal state
   
    hn = hn.view(-1, self.hidden_size)
    out = self.relu(hn)
    out = self.fc_1(out)
    out = self.relu(out)
    out = self.fc(out)
   
    return out 
  


# Hyper parameters
num_epochs = 500 
learning_rate = 0.0001
input_size = 9 
hidden_size = 256
num_layers = 1
num_classes = 1 
lstm1 = LSTM1(num_classes, input_size, hidden_size, num_layers, X_train_tensors_final.shape[1]).to(device)
loss_function = torch.nn.MSELoss()
optimizer = torch.optim.Adam(lstm1.parameters(), lr=learning_rate)



# Training
for epoch in range(num_epochs):
  outputs = lstm1.forward(X_train_tensors_final.to(device))
  optimizer.zero_grad()
  loss = loss_function(outputs, y_train_tensors.to(device))
  loss.backward() #calculates the loss of the loss function
  optimizer.step() #improve from loss, i.e backprop

  if epoch % 100 == 0:
    print("Epoch: %d, loss: %1.5f" % (epoch, loss.item())) 



# predict train data
train_predict = lstm1(X_train_tensors_final.to(device))  # Forward pass
data_predict_train = train_predict.data.detach().cpu().numpy()  # Numpy conversion
dataY_plot_train = y_train_tensors.data.numpy()
data_predict_train = mm.inverse_transform(data_predict_train)  # Reverse transformation
dataY_plot_train = mm.inverse_transform(dataY_plot_train)


# predict test data
test_predict = lstm1(X_test_tensors_final.to(device))
data_predict_test = test_predict.data.detach().cpu().numpy()
dataY_plot_test = y_test_tensors.data.numpy()
data_predict_test = mm.inverse_transform(data_predict_test)  # Reverse transformation
dataY_plot_test = mm.inverse_transform(dataY_plot_test)

# visualization
plt.figure(figsize=(10, 6))
plt.axvline(x=len(dataY_plot_train), c='r', linestyle='--', label='Train/Test Split')

# train data
plt.plot(dataY_plot_train, label='Actual Train Data', color='blue')  # Actual train plot
plt.plot(data_predict_train, label='Predicted Train Data', color='cyan')  # Predicted train plot

# test data
plt.plot(range(len(dataY_plot_train), len(dataY_plot_train) + len(dataY_plot_test)), dataY_plot_test, label='Actual Test Data', color='green')  # Actual test plot
plt.plot(range(len(dataY_plot_train), len(dataY_plot_train) + len(dataY_plot_test)), data_predict_test, label='Predicted Test Data', color='orange')  # Predicted test plot

# label and legend
plt.title('Time-Series Prediction')
plt.xlabel('Time')
plt.ylabel('Values')
plt.legend()
plt.show()
