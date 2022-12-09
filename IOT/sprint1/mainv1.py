import json
import paho.mqtt.client as mqtt

#config

mqttserver = "chirpstack.iut-blagnac.fr"
mqttport = 1883

fileRead = open('config.txt', 'r')
fileWrite = open('releve.txt', 'w')
fileWrite.close()

lines = fileRead.readlines()
devices = []

canard = 0
for line in lines:
    canard += 1
    if canard == 1:
        mqttserver = line.strip()[8:]
    elif canard == 2:
        mqttport = int(line.strip()[6:])
    elif canard > 3:
        devices.append(("application/1/device/" +line.strip()+ "/event/up", 1))



def get_data(mqtt, obj, msg):
    fileWrite = open('releve.txt', 'a')
    jsonMsg = json.loads(msg.payload)
    #co2 = jsonMsg["object"]["co2"]
    #temp = jsonMsg["object"]["temperature"]
    message = str(jsonMsg["rxInfo"][1]["name"]) + ":\nCO2 : " + str(jsonMsg["object"]["co2"]) + "\nTemp : " + str(jsonMsg["object"]["temperature"]) + "\n\n"
    print(jsonMsg["rxInfo"][1]["name"])
    #print(jsonMsg["object"]["co2"])
    #print(jsonMsg["object"]["temperature"])
    fileWrite.writelines(message)
    fileWrite.close()

print("Connexion au broker MQTT...")

client = mqtt.Client()

client.connect(mqttserver, mqttport, 600)

#client.subscribe([("application/1/device/24e124128c017760/event/up",2)])
#client.subscribe([("application/1/device/24e124128c017760/event/up",2), ("application/1/device/24e124128c011778/event/up",1), ("application/1/device/24e124128c012114/event/up", 0)])
client.subscribe(devices)
print("subscribed")

client.on_message = get_data

client.loop_forever()
