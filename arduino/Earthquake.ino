// Make sure you install the ESP32 Board Package and select the correct ESP32 board before compiling.
// To install the ESP32 Board Package follow the instructions here: https://github.com/espressif/arduino-esp32/blob/master/README.md#installation-instructions.

#include <WiFi.h>
#include <HTTPClient.h>
#include <PubSubClient.h>

//ADLX335 accelerometer pin configuration
const int xPin = 34; // x-axis of the accelerometer
const int yPin = 35; // y-axis
const int zPin = 32; // z-axis

// WiFi network info.
char ssid[] = "JASIM";//WiFi ssid
char wifiPassword[] = "ju211267";//WiFi password

//mqtt server configuration
const char* mqttServer = " "; //mosquitto broker address
const int mqttPort = 1883; //mostquitto broker port number
const char* mqttUser = "jasim";   //mosquitto username
const char* mqttPassword = "ju211267";    //mosquitto password

//webserver address & api key
const char* serverName = "http://rownak.info/rumky/MIC/post-esp-data.php";
String apiKeyValue = "tPmAT5Ab3j7F9";

String sensorName = "Earthquake Detector";
String sensorLocation = "Home";

WiFiClient espClient;
PubSubClient client(espClient);

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid,wifiPassword);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
  client.setServer(mqttServer, mqttPort);
  client.setCallback(callback);
 
  while (!client.connected()) {
    Serial.println("Connecting to MQTT...");
 
    if (client.connect("ES32Client", mqttUser, mqttPassword )) {
 
      Serial.println("connected");  
 
    } else {
 
      Serial.print("failed with state ");
      Serial.print(client.state());
      delay(2000);
 
    }
  }
 
  client.publish("esp/test", "Earthquake");
  client.subscribe("esp/test");
  
}

void callback(char* topic, byte* payload, unsigned int length) {
 
  Serial.print("Message arrived in topic: ");
  Serial.println(topic);
 
  Serial.print("Message:");
  for (int i = 0; i < length; i++) {
    Serial.print((char)payload[i]);
  }
 
  Serial.println();
  Serial.println("-----------------------");
 
}

void loop() {
int x = analogRead(xPin); //read from xpin
int y = analogRead(yPin); //read from ypin
int z = analogRead(zPin); //read from zpin

  //Check WiFi connection status
  if(WiFi.status()== WL_CONNECTED){
    HTTPClient http;
    
    // Your Domain name with URL path or IP address with path
    http.begin(serverName);
    
    // Specify content-type header
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    
    // Prepare your HTTP POST request data
    String httpRequestData = "api_key=" + apiKeyValue + "&sensor=" + sensorName
                          + "&location=" + sensorLocation + "&value1=" + String(x)
                          + "&value2=" + String(y) + "&value3=" + String(z) + "";
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);
    
    int httpResponseCode = http.POST(httpRequestData);
     
    // If you need an HTTP request with a content type: text/plain
    http.addHeader("Content-Type", "text/plain");
    //String httpResponseCode = http.POST("Hello, World!");
    
    // If you need an HTTP request with a content type: application/json, use the following:
    //http.addHeader("Content-Type", "application/json");
    //int httpResponseCode = http.POST("{\"value1\":\"19\",\"value2\":\"67\",\"value3\":\"78\"}");
        
    if (httpResponseCode>0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    }
    else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    // Free resources
    http.end();
  }
  else {
    Serial.println("WiFi Disconnected");
  }
  //Send an HTTP POST request every 30 seconds
  delay(30000);  
}
