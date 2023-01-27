package MVC;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;

/**
 *Permet de lancer la fenetre principale de l'application avec des paramètres prédéfinis.
 */
public class MainFrame extends Application {

	// Lancement classique d'un application JavaFX

	/**
	 * Charge les fichiers nécessaires et meets en place les paramètres de base
	 *
	 * @param _primaryStage the primary stage for this application, onto which
	 * the application scene can be set. The primary stage will be embedded in
	 * the browser if the application was launched as an applet.
	 * Applications may create other stages, if needed, but they will not be
	 * primary stages and will not be embedded in the browser.
	 */
	@Override
	public void start(Stage _primaryStage) {

		Stage primaryStage = _primaryStage;

		try {
			FXMLLoader loader = new FXMLLoader(
					MainFrameController.class.getResource("mainFrame.fxml"));
			BorderPane root = loader.load();

			Scene scene = new Scene(root, root.getPrefWidth()+20, root.getPrefHeight()+10);
			scene.getStylesheets().add(MainFrame.class.getResource("application.css").toExternalForm());

			primaryStage.setScene(scene);
			primaryStage.setTitle("Fenêtre Principale");

			MainFrameController mfc = loader.getController();
			mfc.initContext(primaryStage);

			mfc.displayDialog();

		} catch (Exception e) {
			e.printStackTrace();
			System.exit(-1);
		}
	}

	/**
	 * Sert de point d'entrée dans la classe
	 */
	public static void runApp() {
		Application.launch();
	}
}
