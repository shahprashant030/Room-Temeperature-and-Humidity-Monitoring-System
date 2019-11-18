import RPi.GPIO as GPIO
import time
GPIO.setmode(GPIO.BCM)

TRIG = 23
ECHO = 24

MAX_DISTANCE = 5

fuel_percent = 0

print "Distance Measurement In Progress"

GPIO.setup(TRIG,GPIO.OUT)
GPIO.setup(ECHO,GPIO.IN)

GPIO.output(TRIG, False)
print "Waiting For Sensor To Settle"
time.sleep(2)

GPIO.output(TRIG, True)
time.sleep(0.00001)
GPIO.output(TRIG, False)

while GPIO.input(ECHO)==0:
	pulse_start = time.time()

while GPIO.input(ECHO)==1:
	pulse_end = time.time()      
  
pulse_duration = pulse_end - pulse_start

distance = pulse_duration x 17150

distance = round(distance, 2)

fuel_percent = (distance/MAX_DISTANCE) * 100

print "Fuel level is:",fuel_percent,"%"

GPIO.cleanup()

