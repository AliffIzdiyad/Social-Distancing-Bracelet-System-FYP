#include "BLEDevice.h"
#include "EasyBuzzer.h"
#include <BLEScan.h>
#include <BLEAdvertisedDevice.h>
#include <WiFi.h>
#include <WiFiClientSecure.h>
#include <HTTPClient.h>

const char* ssid = "normila_2.4GHz@unifi";
const char* pswd = "normilaazmi";
const char* host = "bracelet.mbrainsolutions.com";

int SD_break = -1;
int scanTime = 1;
int LED = 2; //
int BUTTON = 0;
BLEScan* pBLEScan;
BLEClient*  pClient;
bool deviceFound = false;
bool LEDoff = false;
bool BotonOff = false;

class MyAdvertisedDeviceCallbacks: public BLEAdvertisedDeviceCallbacks {
    void onResult(BLEAdvertisedDevice Device) {
      bool known = false;
      bool Master = false;

      //RSSI (-80 hingga -60 = Far) , (-60 hingga -45 = Close) , (-45 kebawah = Too close)
      if (Device.getName() == "SD Bracelet - Student - 1")
      {
        Serial.print("Device distance:");
        Serial.println(Device.getRSSI());

        //=============================================================
        // Process for checking connection to server
        WiFiClient client;
        if (!client.connect(host, 80))
        {
          Serial.println("Connection Failed");
          return;
        }
        //=============================================================
        // Process for sending data to server
        String Link;
        HTTPClient http;
        Link = "http://" + String(host) + "/sendingdata.php?sensor=" + String(Device.getRSSI());
        http.begin(Link); // link execution
        http.GET();
        http.end();

        delay(10000);
        if (Device.getRSSI() > -82 && Device.getRSSI() < -70) {

          SD_break = 0;
        }
        else if (Device.getRSSI() > -70 && Device.getRSSI() < -60) {

          SD_break = 1;
        }
        else if (Device.getRSSI() > -60 ) {

          SD_break = 2;

        }
      }
    }
};

void setup() {
  Serial.begin(115200);
  pinMode(LED, OUTPUT);
  digitalWrite(LED, LOW);
  BLEDevice::init("");
  pClient  = BLEDevice::createClient();
  pBLEScan = BLEDevice::getScan();
  pBLEScan->setAdvertisedDeviceCallbacks(new MyAdvertisedDeviceCallbacks());
  pBLEScan->setActiveScan(true);
  // pBLEScan->setInterval(10);
  // pBLEScan->setWindow(9); // less or equal setInterval value
  Serial.println();
  WiFi.begin(ssid, pswd);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
}

void Bluetooth() {
  Serial.println();
  BLEScanResults foundDevices = pBLEScan->start(scanTime, false);
  Serial.println("BLE Scanning");
  deviceFound = false;
  BLEScanResults scanResults = pBLEScan->start(1);
  unsigned int frequency = 400;
  unsigned int frequency1 = 600;
  unsigned int onDuration = 50;
  unsigned int offDuration = 100;
  unsigned int beeps = 2;
  unsigned int pauseDuration = 500;
  unsigned int cycles = 30;

  switch (SD_break)
  {
    case 0:
      Serial.println("Nearby Person Detected");
      Serial.println("LED is ON now");
      for (int i = 0; i < 2; i++)
      {
        LEDoff = true;
        digitalWrite(LED, HIGH);
        EasyBuzzer.beep(frequency, onDuration, offDuration, beeps, pauseDuration, cycles);
        BUTTON = 0;
        delay(400);
      }
      break;
    case 1:
      Serial.println("Almost break social Distance!");
      Serial.println("LED is ON now");
      for (int i = 0; i < 7; i++)
      {
        LEDoff = true;
        digitalWrite(LED, HIGH);
        EasyBuzzer.beep(frequency1, onDuration, offDuration, beeps, pauseDuration, cycles);
        BUTTON = 0;
        delay(200);
        digitalWrite(LED,LOW);
      }
      break;
    case 2:
      Serial.println("Social DIstancing Breached!!!");
      Serial.println("LED is ON now");
      for (int i = 0; i < 20; i++)
      {
        LEDoff = true;
        digitalWrite(LED, HIGH);
        EasyBuzzer.beep(frequency1, onDuration, offDuration, beeps, pauseDuration, cycles);
        BUTTON = 0;
        delay(400);
        digitalWrite(LED,LOW);
      }
      break;
    default:
      Serial.println("No person Detected");
      EasyBuzzer.stopBeep();
      digitalWrite(LED, LOW);
      delay(1000);
      break;
  }
  pBLEScan->clearResults(); // delete results fromBLEScan buffer to release memory
  SD_break = -1;
}

void loop() {
  Bluetooth();
  EasyBuzzer.update();
}
