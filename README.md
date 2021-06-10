Make sure your OS is up to date with following commands:

sudo apt update
sudo apt upgrade
Istall CircuitPython Libraries
CircuitPython libraries are a set of Python libraries from Adafruit which simplify external sensors management. These libraries require Python3. Check if it is installed with command:

python3 --version
Otherwise, install python3:

sudo apt install python3
Install pip for python3:

sudo apt install python3-pip
Enable I2C and SPI
Enable and configure I2C (standard designed to allow one chip to talk another)

sudo apt install -y python-smbus
sudo apt install -y i2c-tools
And enable Raspberry PI I2C kernel support with:

sudo raspi-config
In following config screen, go to Interfacing Options > I2C. Enable it by pressing yes in next screen and following confirmation. Once enabled, you should be forwarded again to raspi-config home page.

To enable SPI, go again in Interfacing Options >SPI. Enable it by pressing yes in next screen and following confirmation.
Click Finish in raspi-config home page to go back ssh terminal.

Install Python Libraries
Start from GPIO library:
pip3 install RPI.GPIO
Finally, install adafruit-blinka library. This includes also a few different libraries such as adafruit-pureio (our ioctl-only i2c library), spidev (for SPI interfacing), Adafruit-GPIO (for detecting your board) and of course adafruit-blinka):

pip3 install adafruit-blinka
Setup CircuitPython-DHT
Following adafruit dht library will be required to enable communication of Raspberry PI with DHT11 sensor:
pip3 install adafruit-circuitpython-dht
sudo apt install libgpiod2
Create a new reading script named DHT11Test.py:

nano DHT11Test.py
Insert the following code:

import time
import board
import adafruit_dht
#Initial the dht device, with data pin connected to:
dhtDevice = adafruit_dht.DHT11(board.D17)
while True:
    try:
         # Print the values to the serial port
         temperature_c = dhtDevice.temperature
         temperature_f = temperature_c * (9 / 5) + 32
         humidity = dhtDevice.humidity
         print("Temp: {:.1f} F / {:.1f} C    Humidity: {}% "
               .format(temperature_f, temperature_c, humidity))
    except RuntimeError as error:     # Errors happen fairly often, DHT's are hard to read, just keep going
         print(error.args[0])
    time.sleep(2.0)
And finally execute by typing:

 python3 DHT11Test.py
This code will show measured data and also makes you aware that DHT11 sensor naturally receives a number of reading errors (as also referenced in adafruit comment inside the script):

pi@raspberrypi:~ $ python3 DHT11Test.py
Temp: 66.2 F / 19.0 C    Humidity: 56%
Temp: 66.2 F / 19.0 C    Humidity: 56%
Temp: 66.2 F / 19.0 C    Humidity: 56%
Temp: 66.2 F / 19.0 C    Humidity: 56%
Checksum did not validate. Try again.
Temp: 66.2 F / 19.0 C    Humidity: 56%
A full buffer was not returned.  Try again.
Temp: 66.2 F / 19.0 C    Humidity: 56%
Checksum did not validate. Try again.
Temp: 66.2 F / 19.0 C    Humidity: 56%
Temp: 66.2 F / 19.0 C    Humidity: 56%
Temp: 66.2 F / 19.0 C    Humidity: 56%
Temp: 66.2 F / 19.0 C    Humidity: 56%
Temp: 66.2 F / 19.0 C    Humidity: 56%
To have a clean list of correct measurements from Raspberry PI with DHT11, change inside code the line “print(error.args[0])” with “pass”. This avoids printing errors on terminal and outputs readings when it is corretly received:

pi@raspberrypi:~ $ python3 DHT11Test.py
Temp: 66.2 F / 19.0 C    Humidity: 55%
Temp: 66.2 F / 19.0 C    Humidity: 55%
Temp: 66.2 F / 19.0 C    Humidity: 55%
Temp: 66.2 F / 19.0 C    Humidity: 55%
Temp: 66.2 F / 19.0 C    Humidity: 55%
Temp: 66.2 F / 19.0 C    Humidity: 55%
Temp: 66.2 F / 19.0 C    Humidity: 55%
Temp: 66.2 F / 19.0 C    Humidity: 55%
