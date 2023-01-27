package application;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;
import java.util.Timer;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.chart.BarChart;
import javafx.scene.chart.XYChart;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.layout.StackPane;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.stage.StageStyle;
import javafx.stage.WindowEvent;

/**

 La classe MainFrameController est la classe controlleur pour la fenêtre principale de l'application. Elle gère la mise en place de la fenêtre, la gestion des événements et les mises à jour des données.

 @author Luca Straputicari , Vignal Alexandre, Fernandez Mickael, Dourlent Maxime

 @version 1.0
 */
public class MainFrameController implements Initializable {

	/**
	 Fenêtre physique contenant l'application
	 */
	private Stage primaryStage;

	/**
	 Timer utilisé pour mettre à jour les graphiques de la fenêtre
	 */
	private TaskBackground tb;
	private Timer timer;

	// Thread
	//private RunBackground rb;

	/**
	 Initialise le contexte de la fenêtre en paramétrant les composants et en validant l'état des composants.
	 @param _containingStage Stage contenant l'application
	 */

	public void initContext(Stage _containingStage) {
		this.primaryStage = _containingStage;
		this.configure();
		this.validateComponentState();
		this.primaryStage.setResizable(false);
	}
	/**
	 Affiche la fenêtre principale de l'application et met à jour les graphiques avec les données initiales.
	 */
	public void displayDialog() {

        this.primaryStage.show();

		// Création des données initiales des Diagrammes "en barres" (BarChart)
		chartUn.setTitle("Température (en °C)");
		chartDeux.setTitle("Humidité (en %)");
		chartTrois.setTitle("CO2 (en ppm)");

		chartUn.legendVisibleProperty().set(false);
		chartUn.getYAxis().setLabel("Degrés Celsius");
		chartUn.getXAxis().setTickMarkVisible(false);
		chartUn.setVisible(false);
		//chartUn.animatedProperty().set(false);

		chartDeux.legendVisibleProperty().set(false);
		chartDeux.getYAxis().setLabel("Pourcentage");
		chartDeux.getXAxis().setTickMarkVisible(false);
		chartDeux.setVisible(false);
		//chartDeux.animatedProperty().set(false);

		chartTrois.legendVisibleProperty().set(false);
		chartTrois.getYAxis().setLabel("Parties par million");
		chartTrois.getXAxis().setTickMarkVisible(false);
		chartTrois.setVisible(false);
		//chartTrois.animatedProperty().set(false);

		XYChart.Series<String, Number> series1 = new XYChart.Series<>();
		XYChart.Series<String, Number> series2 = new XYChart.Series<>();
		XYChart.Series<String, Number> series3 = new XYChart.Series<>();
		series1.getData().add(new XYChart.Data<>("", 20.3));
		series2.getData().add(new XYChart.Data<>("", 65.5));
		series3.getData().add(new XYChart.Data<>("", 200.5));

		this.chartUn.getData().add(series1);
		this.chartDeux.getData().add(series2);
		this.chartTrois.getData().add(series3);

		// Mise à jour BarCharts par Timer
		
		// Création de la tâche à réaliser périodiquement
		this.tb = new TaskBackground(this, this.primaryStage);
		
		// Création du timer qui va lancer la tâche tb régulièrement
		this.timer = new Timer();
		
		// Démarrage du timer avec le délai de première exécution et l'intervalle de répétition
		this.timer.scheduleAtFixedRate(
		        this.tb ,
		        1000L,  //delay before first execution
		        5000L); //time between executions


	}

	/**
	 Méthode de validation de l'état des composants de la fenêtre. Elle met à jour les textes des labels et des boutons.
	 */
	private void validateComponentState() {
		this.lblUn.setText("Valeurs :");
		this.lblDeux.setText("");
		this.lblTrois.setText("");
		this.lblQuatre.setText("");

		this.lblCinq.setText("Seuils d'alertes :");
		this.lblSix.setText("");
		this.lblSept.setText("");
		this.lblHuit.setText("");

		this.BtnUn.setText("Log de relevés");
		this.BtnDeux.setText("Log d'alertes");
		this.BtnTrois.setText("configuration");
	}
	/**
	 Méthode de configuration de la fenêtre et des composants. Elle ajoute un écouteur d'événement pour la fermeture de la fenêtre.
	 */
	private void configure() {
		this.primaryStage.setOnCloseRequest(e -> this.closeWindow(e));
	}

	// Gestion du stage
	private Object closeWindow(WindowEvent e) {
		this.doQuit();
		e.consume();
		return null;
	}

	// Attributs de la scene + actions
	// 8 Label pour afficher les valeurs numériques
	@FXML
	private Label lblUn;
	@FXML
	private Label lblDeux;
	@FXML
	private Label lblTrois;
	@FXML
	private Label lblQuatre;
	@FXML
	private Label lblCinq;
	@FXML
	private Label lblSix;
	@FXML
	private Label lblSept;
	@FXML
	private Label lblHuit;

	@FXML
	private Button BtnUn;
	@FXML
	private Button BtnDeux;
	@FXML
	private Button BtnTrois;
	@FXML
	private Button btnQuit;

	// Les BarCharts (Diagramme "en barres")
	@FXML
	private BarChart<String, Number> chartUn;
	@FXML
	private BarChart<String, Number> chartDeux;
	@FXML
	private BarChart<String, Number> chartTrois;

	@Override
	public void initialize(URL location, ResourceBundle resources) {
	}

	@FXML
	private void doQuit() {
		if (AlertUtilities.confirmYesCancel(this.primaryStage, "Quitter Appli Principale",
				"Etes vous sur de vouloir quitter l'appli ?", null, AlertType.CONFIRMATION)) {

			// Arrêt "propre" du thread de mise à jour
			//this.rb.stopIt();
			
			// Arrêt du timer
			this.timer.cancel();
			
			this.primaryStage.close();
			
			// Optionnel : arrêt de l'application (ici tout s'arrête proprement)
			//System.exit(0);
		}
	}

	@FXML
	private void handleLogReleveButton(){
		openLogWindow("Log de relevés", "logReleve.txt");
	}

	@FXML
	private void handleLogAlertButton(){
		openLogWindow("Log d'alertes", "logAlert.txt");
	}
	/**
	 Méthode qui permet d'ouvrir une fenêtre contenant un fichier de log.
	 @param _title le titre de la fenêtre
	 @param _fileName le nom du fichier de log à afficher
	 */
	private void openLogWindow(String _title, String _fileName) {

		try {
			File log = new File(_fileName);
			String logPath = log.getAbsolutePath();

			BufferedReader reader = new BufferedReader(new FileReader(logPath));
			String line;
			String text = "";

			while ((line = reader.readLine()) != null) {
				text += line + "\n";
			}

			Stage newStage = new Stage();
			newStage.setTitle(_title);

			TextArea logAlert = new TextArea(text);
			logAlert.setEditable(false);

			StackPane root = new StackPane();
			root.getChildren().add(logAlert);
			newStage.setScene(new Scene(root, 600, 500));
			newStage.show();

		} catch (IOException e) {
			throw new RuntimeException(e);
		}
	}

	public void handleConfigButton(ActionEvent event) {
		try {
			FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("configFrame.fxml"));
			Parent root1 = (Parent) fxmlLoader.load();
			Stage stage = new Stage();
			stage.initModality(Modality.APPLICATION_MODAL);
			stage.setTitle("Configuration");
			stage.setScene(new Scene(root1));
			stage.show();
		} catch (IOException e) {
			throw new RuntimeException(e);
		}
	}
/**

 La méthode miseAJourSeuils permet de mettre à jour les seuils d'alertes affichés sur la fenêtre de l'application.
 @param _seuil1 Le seuil de température en degrés Celsius.
 @param _seuil2 Le seuil d'humidité en pourcentage.

 @param _seuil3 Le seuil de CO2 en parties par million (ppm).
 */

	public void miseAJourSeuils(float _seuil1, float _seuil2, float _seuil3){
		this.lblSix.setText("Seuil Température : " +_seuil1+ "°C");
		this.lblSept.setText("Seuil Humidité : " +_seuil2+ "%");
		this.lblHuit.setText("Seuil CO2 : " +_seuil3+ "ppm");
	}

/**

 La méthode miseAJourCharts permet de mettre à jour les graphiques de température, d'humidité et de CO2 affichés sur la fenêtre de l'application.
 @param _valueToSet1 La valeur de température à afficher sur le graphique. Si la valeur est égale à -1, le graphique n'est pas affiché.
 @param _valueToSet2 La valeur d'humidité à afficher sur le graphique. Si la valeur est égale à -1, le graphique n'est pas affiché.
 @param _valueToSet3 La valeur de CO2 à afficher sur le graphique. Si la valeur est égale à -1, le graphique n'est pas affiché.
 */

 public void miseAJourCharts(float _valueToSet1, float _valueToSet2, float _valueToSet3) {

		if(_valueToSet1 == -1){
			this.chartUn.setVisible(false);
			this.lblDeux.setText("");
			this.lblSix.setText("");
		}else{
			this.chartUn.setVisible(true);
			this.lblDeux.setText("Température :" +_valueToSet1+ "°C");


			XYChart.Series<String, Number> series1 = new XYChart.Series<>();
			series1.getData().add(new XYChart.Data<>("", _valueToSet1));
			this.chartUn.getData().set(0,series1);
		}
		if(_valueToSet2 == -1){
			this.chartDeux.setVisible(false);
			this.lblTrois.setText("");
			this.lblSept.setText("");
		}else{
			this.chartDeux.setVisible(true);
			this.lblTrois.setText("Humidité : " +_valueToSet2+ "%");

			XYChart.Series<String, Number> series2 = new XYChart.Series<>();
			series2.getData().add(new XYChart.Data<>("", _valueToSet2));
			this.chartDeux.getData().set(0,series2);
		}
		if(_valueToSet3 == -1){
			this.chartTrois.setVisible(false);
			this.lblQuatre.setText("");
			this.lblHuit.setText("");
		}else{
			this.chartTrois.setVisible(true);
			this.lblQuatre.setText("CO2 : " +_valueToSet3+ "ppm");

			XYChart.Series<String, Number> series3 = new XYChart.Series<>();
			series3.getData().add(new XYChart.Data<>("", _valueToSet3));
			this.chartTrois.getData().set(0,series3);
		}
	}
}
