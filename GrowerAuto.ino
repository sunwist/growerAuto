#include <WiFi.h>
#include <WebServer.h>
#include <DHT.h>

#define PINODHT 5 // sensor de umidade e temperatura ambiente
#define MODELODHT DHT11
DHT dht(PINODHT, MODELODHT);
#define sensor 39 // sensor umidade do solo
 
const char* ssid = "UPLEARN1";
const char* password = "UpLe@rn1";
WiFiServer server(80);

String header;
String estado_rele = "off";
String estado_rele2 = "off";

const int rele = 2;
const int rele2 = 4;
int valorumidade;
const char* estado;

unsigned long currentTime = millis();
unsigned long previousTime = 0;
// define o tempo em milissegundos (2000ms = 2s)
const long timeoutTime = 2000;

void setup() {
  Serial.begin(115200);
  // inicializa as variaveis do output
  pinMode(sensor, OUTPUT);
  pinMode(rele, OUTPUT);
  pinMode(rele2, OUTPUT);

  // reles desligados
  digitalWrite(rele, HIGH);
  digitalWrite(rele2, HIGH);

  // conectando no wifi
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  // mostra o ip do web server
  Serial.println("");
  Serial.println("WiFi connected.");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  server.begin();
}

int readSensor() {
  digitalWrite(sensor, HIGH);  // liga o sensor
  delay(1000);
  int val = analogRead(sensor);             // leitura analogica do sensor
  valorumidade = map(val, 0, 1023, 0, 34);  // funcao map de conversao do valor do sensor
  digitalWrite(sensor, LOW);           // desliga o sensor
  return valorumidade;                      // retorna o valor da umidade convertido
}

void loop() {
  WiFiClient client = server.available();  // verifica se ha clientes
  dht.begin();
  int solo = readSensor();
  //aguardar alguns segundos entre as medidas
  delay(500);

  // determina o estado do solo
  if (solo >= 50) {
    Serial.print("O solo está em ");
    Serial.print(solo);
    Serial.print("%\n");
    Serial.println("Status: Solo seco\n\n");
    estado = "Solo seco!";
  } else if (solo < 50) {
    Serial.print("O solo está em ");
    Serial.print(solo);
    Serial.print("%\n");
    Serial.println("Status: Solo umido\n\n");
    estado = "Solo úmido";
  }

  // if(solo>=80){
  //   digitalWrite(rele, LOW);
  //   delay(2000);
  // }else{
  //   digitalWrite(rele, HIGH);
  // }

  // lendo as informações
  int umi = dht.readHumidity();
  int tempC = dht.readTemperature();

  // verificando se as leituras falharam
  if (isnan(umi) || isnan(tempC)) {
    Serial.println("!!!");
    delay(500);
  }
  if (client) {  // se tiver um novo cliente
    currentTime = millis();
    previousTime = currentTime;
    Serial.println("New Client.");                                             // mostra no monitor
    String currentLine = "";                                                   // String para segurar dados do cliente
    while (client.connected() && currentTime - previousTime <= timeoutTime) {  // loop while quando o cliente estiver conectado
      currentTime = millis();  
      if (client.available()) {  // se houver bytes para ler do cliente
        char c = client.read();  // leitura
        Serial.write(c);         // mostra no monitor
        header += c;
        if (c == '\n') {
          if (currentLine.length() == 0) {
            client.println("HTTP/1.1 200 OK");
            client.println("Content-type:text/html");
            client.println("Connection: close");
            client.println();

            // ligar botoes
            if (header.indexOf("GET /2/on") >= 0) {
              Serial.println("Irrigação ON");
              estado_rele = "on";
              digitalWrite(rele, LOW);
            } else if (header.indexOf("GET /2/off") >= 0) {
              Serial.println("Irrigação OFF");
              estado_rele = "off";
              digitalWrite(rele, HIGH);
            }
            if (header.indexOf("GET /4/on") >= 0) {
              Serial.println("Adubação ON");
              estado_rele2 = "on";
              digitalWrite(rele2, LOW);
            } else if (header.indexOf("GET /4/off") >= 0) {
              Serial.println("Adubação OFF");
              estado_rele2 = "off";
              digitalWrite(rele2, HIGH);
            }

            // pagina html
            client.println("<html><html lang=\"pt-BR\"> <head> <meta charset=\"UTF-8\"> <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">");
            client.println("<link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD\" crossorigin=\"anonymous\">");
            client.println("<style> @import url(\'https://fonts.googleapis.com/css?family=Montserrat:400,800\'); #sensor { text-align: center; font-size: 1.4em; font-family: 'Montserrat', sans-serif; padding-top:40px; padding-bottom: 20px;display: flex; justify-content: center; align-items: center;}");
            client.println(".title {font-family: 'Lato', sans-serif; font-weight: 600;}");
            client.println("p {padding: 1px;}");
            client.println("#ambiente {width: 350px;height: 400px;}");
            client.println("#solo {width: 350px; height: 400px;}");
            client.println("#controlar{width: 350px; height: 400px;}");
            client.println("</style></head>");
            client.println("</style></head><body>");
            client.println("<div class=\"container justify-content-center\" id=\"sensor\"><div class=\"row\"><div class=\"col\">");
            client.println("<div class=\"card border-success rounded-2 shadow\" id=\"ambiente\"><div class=\"card-body bg-white rounded-2\">");
            client.println("<p class=\"title\">Umidade e Temperatura Ambiente<br></p>");
            client.println("<p>Temperatura<br>");
            client.println((int)tempC);
            client.println("°C<br><br></p><p>Umidade<br>");
            client.println((int)umi);
            client.println("%</p></div></div></div>");
            client.println("<div class=\"col\"><div class=\"card border-success rounded-2 shadow\" id=\"solo\"><div class=\"card-body bg-white rounded-2\">");
            client.println("<p class=\"title\">Umidade do Solo</p>");
            client.println("<p class=\"p-3\">Sensor<br>");
            client.println(solo);
            client.println("%<br></p><p class=\"p-3\">Estado<br>");
            client.println(estado);
            client.println("</p></div></div></div>");
            client.println("<div class=\"col\"><div class=\"card border-success rounded-2 shadow\" id=\"controlar\">");
            client.println("<div class=\"card-body bg-white rounded-2\"><p class=\"title\">Controle</p>");
            client.println("<p>Irrigação<br><p>");
            if (estado_rele == "off") { // se o rele estiver off, o botao fica on para que o usuario ligue
              client.println("<p><a href=\"/2/on\"><button class=\"button\">ON</button></a></p><br>");
            } else { // senao fica off, ou seja, o rele esta ligado e o usuario pode desligar quando quiser
              client.println("<p><a href=\"/2/off\"><button class=\"button\">OFF</button></a></p><br>");
            }
            client.println("<p>Adubação<br></p>");
            if (estado_rele2 == "off") {
              client.println("<p><a href=\"/4/on\"><button class=\"button\">ON</button></a></p>");
            } else {
              client.println("<p><a href=\"/4/off\"><button class=\"button\">OFF</button></a></p>");
            }
            client.println("</div></div></div></body></html>");

            client.println();
            // quebra o loop
            break;
          } else {
            currentLine = "";
          }
        } else if (c != '\r') {
          currentLine += c;     
        }
      }
    }
    header = "";
    client.stop();
    Serial.println("Client disconnected.");
    Serial.println("");
  }
}
