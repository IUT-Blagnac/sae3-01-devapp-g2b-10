package MVC;

import java.io.*;
import java.sql.Timestamp;
import java.util.Objects;
import java.util.TimerTask;

import javafx.application.Platform;
import javafx.scene.control.Alert;
import javafx.stage.Stage;

//Code d'une tâche gérée par Timer qui met à jour les BarCharts avec les données d'un fichier.
/**
 * Timer qui mets à jour les BarCharts de manière périodique et dynamique
 */
public class TaskBackground extends TimerTask {

	// Controller pour la mise à jour des BarCharts
	private MainFrameController mf;
	private Stage primaryStage;
	private float temp;
	private float seuilTemp;
	private float humi;
	private float seuilHumi;
	private float CO2;
	private float seuilCO2;
	private String[] valTab;

	// Constructeur 
	// _mf : le controller contenant les BarCharts
	/**
	 * Constructeur de TaskBackground
	 *
	 * @param _mf le controller contenant les BarCharts à mettre à jour
	 * @param _primaryStage le stage de la fenetre principale
	 */
	public TaskBackground(MainFrameController _mf, Stage _primaryStage) {
		this.mf = _mf;
		this.primaryStage = _primaryStage;
	}

	// Corps de la tâche lorsqu'elle est activée

	/**
	 * Permet de lire les données des différents fichiers,
	 * d'écrire les logs dans des fichiers,
	 * et de mettre à jour les BarCharts du controller donné au constructeur dynamiquement
	 */
	@Override
	public void run() {
		// Paramètres de la mise à jour des BarCharts
		temp = -1;
		humi = -1;
		CO2 = -1;
		valTab = null;
		String[] valTab2 = null;
		String[] configTab = null;

		//récupération des seuils d'alertes des données depuis le fichier config.txt
		try {
			File config = new File("config.txt");
			String configPath = config.getAbsolutePath();

			BufferedReader reader = new BufferedReader(new FileReader(configPath));
			String line;
			while ((line = reader.readLine()) != null) {
				if (line.startsWith("activity:")) {
					configTab = line.split(":");

					for(int i = 0; i < configTab.length; i+=3){
						switch (configTab[i]){
							case "temperature":
								seuilTemp = Float.parseFloat(configTab[i+2]);
								break;
							case "co2":
								seuilCO2 = Float.parseFloat(configTab[i+2]);
								break;
							case "humidity":
								seuilHumi = Float.parseFloat(configTab[i+2]);
								break;
						}
					}
					break;
				}
			}
			reader.close();
		} catch (IOException e) {
			e.printStackTrace();
		}

		//récupération des alertes depuis le fichier Alerte.txt
		try {
			File alertFile = new File("alertFile.txt");
			String alertFilePath = alertFile.getAbsolutePath();

			File logAlert = new File("logAlert.txt");
			String logAlertPath = logAlert.getAbsolutePath();

			BufferedReader reader = new BufferedReader(new FileReader(alertFilePath));
			FileWriter writer = new FileWriter(logAlertPath, true);
			String line;

			while ((line = reader.readLine()) != null) {
				writer.write( line+ "\n");
			}
			writer.flush();
			writer.close();
			reader.close();

			writer = new FileWriter(alertFilePath,false);
			writer.flush();
			writer.close();

		} catch (IOException e) {
			e.printStackTrace();
		}

		//récupération des données des capteurs depuis le fichier releve.txt
		try {
			File releve = new File("releve.txt");
			String relevePath = releve.getAbsolutePath();

			File logReleve = new File("logReleve.txt");
			String logRelevePath = logReleve.getAbsolutePath();

			BufferedReader reader = new BufferedReader(new FileReader(relevePath));
			FileWriter writer = new FileWriter(logRelevePath, true);
			String line;
			String releveVal = "";
			int compteur = 0;

			while ((line = reader.readLine()) != null) {
				compteur++;
				releveVal = line.substring(1,line.length()-1);
				valTab = releveVal.split(",");
			}
			reader.close();

			if(compteur != 0){
				Timestamp timestamp = new Timestamp(System.currentTimeMillis());
				writer.write(timestamp+ "\n");
				writer.write(releveVal+ "\n\n");
				writer.flush();
				writer.close();
			}
			writer = new FileWriter(relevePath,false);
			writer.flush();
			writer.close();


		} catch (IOException e) {
			e.printStackTrace();
		}

		if(valTab != null){
			for(int i = 0; i < valTab.length; i++){
				valTab2 = valTab[i].trim().split(":");

				if(Objects.equals(valTab2[0].trim(), "\"temperature\"")){
					temp = Float.parseFloat(valTab2[1].trim());
				}

				if(Objects.equals(valTab2[0].trim(), "\"humidity\"")){
					humi = Float.parseFloat(valTab2[1].trim());
				}

				if(Objects.equals(valTab2[0].trim(), "\"co2\"")){
					CO2 = Float.parseFloat(valTab2[1].trim());
				}
			}
		}

		System.out.println("Mise à jour affichage Java.\n");

		// Mise en file d'attente (dans un Runnable) de la mise à jour des BarCharts via mf.miseAJourCharts()
		// Ce Runnable sera exécuté par le thread GUI "dès que possible"
		/**
		 * Mets en file d'attente les mises à jour dynamiques de la fenetre donnée au constructeur
		 */
		Platform.runLater(new Runnable() {
			@Override
			public void run() {
				TaskBackground.this.mf.miseAJourSeuils(seuilTemp,seuilHumi,seuilCO2);
				if(valTab != null){
					TaskBackground.this.mf.miseAJourCharts(temp,humi,CO2);
				}

				if(temp >= seuilTemp){
					AlertUtilities.showAlert(primaryStage, "Seuil dépassé", "Alerte Température", "Le seuil de température à été dépassé !", Alert.AlertType.WARNING);
				}
				if(humi >= seuilHumi){
					AlertUtilities.showAlert(primaryStage, "Seuil dépassé", "Alerte Humidité", "Le seuil d'humidité à été dépassé !", Alert.AlertType.WARNING);
				}
				if(CO2 >= seuilCO2){
					AlertUtilities.showAlert(primaryStage, "Seuil dépassé", "Alerte CO2", "Le seuil de co2 à été dépassé !", Alert.AlertType.WARNING);
				}
			}

		});
		
		// Documentation de Platform.runLater ()
		// If you need to update a GUI component from a non-GUI thread, you can use that to put your update in a queue and it will be handled by the GUI thread as soon as possible.
	}
}
