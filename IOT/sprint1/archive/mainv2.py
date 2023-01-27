import json
import signal
import paho.mqtt.client as mqtt

#remet à zéro le fichier de données récupérés
fileWrite = open('releve.txt', 'w')
fileWrite.close()

#déclaration des variables globales
devices = []
mqttport = 0
mqttserver = ""


def get_config():
    global mqttserver, mqttport, devices

    fileRead = open('config.txt', 'r')

    lines = fileRead.readlines()
    dict = {}
    canard = 0

    for line in lines:
        canard += 1
        if canard == 1:
            mqttserver = line.strip().split(":")[1]
        elif canard == 2:
            mqttport = int(line.strip().split(":")[1])
        elif canard < 12:
            #optimisation : tout en une seule ligne dans le fichier
            #lecture avec split(":")
            #key sur compteur pair et value sur compteur impair
            keyVal = line.strip().split(":")
            dict[keyVal[0]] = int(keyVal[1])
        elif canard > 12:
            # optimisation : en une seule ligne dans le fichier
            # lecture avec split(":")
            # boucle qui parcours le split(ne pas oublier que le premier sera "devices:") et append dans devices
            devices.append(("application/1/device/" +line.strip()+ "/event/up", 1))
    fileRead.close()
    return dict

def connect():
    global client
    # on connecte au serveur mqtt et on subscribe aux devices indiqués dans le fichier config
    print("Connexion au broker MQTT...")
    client = mqtt.Client()
    print(client.connect(mqttserver, mqttport, 600))
    client.subscribe(devices)
    print("Connecté.")

def on_message(client, userdata, message):
    global donnees
    donnees = json.loads(message.payload)

def on_write(payload):
    return 0
    #TODO
    # ouvrir fichier 'releve'
    # écrire 'payload' dans le fichier
    # fermer fichier 'releve'

def on_alarm(mqtt, obj, msg):

    #TODO
    # recharger 'config'
    # parcourir 'donnees' en prenant que les valeurs correspondnat à 0(True) dans 'dict' pour les ajouter dans 'payload' (à créer)
    # envoyer payload à "on_write"
    # relancer "alarm"

    fileWrite = open('releve.txt', 'a')
    jsonMsg = json.loads(msg.payload)

    #message = str(jsonMsg["rxInfo"][1]["name"]) + ":\nCO2 : " + str(jsonMsg["object"]["co2"]) + "\nTemp : " + str(jsonMsg["object"]["temperature"]) + "\n\n"
    print(jsonMsg["rxInfo"][1]["name"])

    #for key, val in jsonMsg["object"]:

    #fileWrite.writelines(message)
    fileWrite.close()


#on récupère les paramètres de connexion en variables globales
#on récupère dans config le dictionnaire des données à récupérer dans les messages
config = get_config()
connect()

client.on_message = on_message
signal.signal(signal.SIGALRM, on_alarm)
#signal.alarm(60)

client.loop_forever()
