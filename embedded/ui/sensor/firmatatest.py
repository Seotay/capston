from pyfirmata import Arduino, util
import time

board = Arduino("/dev/ttyACM0")
print("DDD")

while True:
    board.digital[3].write(1)
    board.digital[5].write(0)
    time.sleep(2)

    board.digital[3].write(0)
    board.digital[5].write(0)
    time.sleep(2)