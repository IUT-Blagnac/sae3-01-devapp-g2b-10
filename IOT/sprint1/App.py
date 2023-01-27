from datetime import datetime
import time
import json
import signal
import os
import paho.mqtt.client as mqtt

# remet à zéro le fichier de données récupérés
fileWrite = os.open('releve.txt', 0o644)
os.close(fileWrite)

# déclaration des variables globales
devices = []
mqttport = 0
mqttserver = ""

donnees = {}
dictAlert = {}
alertFile = "alertFile.txt"


def get_config():
    global mqttserver, mqttport, devices, dictAlert

    fileRead = open('config.txt', 'r')

    lines = fileRead.readlines()
    dict = {}

    mqttserver = lines[0].strip().split(":")[1]
    mqttport = int(lines[1].strip().split(":")[1])
    keyVal = lines[2].strip().split(":")
    listDevices = lines[3].strip().split(":")

    for i in range(len(keyVal) - 2):
        if (i % 3) == 0:
            dict[keyVal[i]] = keyVal[i + 1]
            dictAlert[keyVal[i]] = keyVal[i + 2]

    for j in listDevices[1:]:
        devices.append(("application/1/device/" + j + "/event/up", 1))

    fileRead.close()

    return dict


def connect():
    global client

    # on connecte au serveur mqtt et on subscribe aux devices indiqués dans le fichier config
    print("Connexion au broker MQTT...")
    client = mqtt.Client()
    client.connect(mqttserver, mqttport, 600)
    client.subscribe(devices)
    print("Connecté.")


def on_message(client, userdata, msg):
    global donnees, alertFiles, dictAlert
    config = get_config()
    dateTime = datetime.fromtimestamp(int(time.time()))

    donnees = json.loads(msg.payload)

    for key, value in config.items():
        if int(donnees["object"][key]) > int(dictAlert[key]):
            seuil = str(dictAlert[key])
            valeur = str(donnees["object"][key])
            timeStamp = str(datetime)
            fileAlert = os.open(alertFile, os.O_WRONLY | os.O_CREAT | os.O_TRUNC, 0o666)
            os.write(fileAlert,
                     str("[" + timeStamp + "] : Seuil d'alerte dépassé ! \n Seuil : " + seuil + "\n Valeur : " + valeur).encode(
                         "UTF-8"))


def on_write(donneesFiltrees):
    # TODO
    # ouvrir fichier 'releve'
    # écrire 'payload' dans le fichier
    # fermer fichier 'releve'

    print("Ecriture sur le fichier releve.txt")

    fileWrite = os.open('releve.txt', os.O_WRONLY | os.O_CREAT | os.O_TRUNC, 0o644)

    print("Fichier ouvert.")

    os.write(fileWrite, json.dumps(donneesFiltrees).encode("UTF-8"))

    print("Données écrites.")

    os.close(fileWrite)

    print("Fichier fermé.")


def on_alarm(nos, frame):
    # TODO
    # recharger 'config'
    # parcourir 'donnees' en prenant que les valeurs correspondnat à 0(True) dans 'dict' pour les ajouter dans 'payload' (à créer)
    # envoyer payload à "on_write"
    # relancer "alarm"
    print("\nFiltrage des données...")
    global donnees

    donneesFiltrees = {}
    config = get_config()

    if len(donnees) != 0:
        for key, value in config.items():
            if value == 0:
                donneesFiltrees[key] = donnees["object"][key]
        on_write(donneesFiltrees)

        donnees = {}

    signal.alarm(10)


# test pour voir dans la console
# jsonMsg = json.loads(msg.payload)

# print(jsonMsg["rxInfo"][1]["name"])

# on récupère les paramètres de connexion en variables globales
# on récupère dans config le dictionnaire des données à récupérer dans les messages
config = get_config()
connect()

client.on_message = on_message
signal.signal(signal.SIGALRM, on_alarm)
signal.alarm(10)

client.loop_forever()
