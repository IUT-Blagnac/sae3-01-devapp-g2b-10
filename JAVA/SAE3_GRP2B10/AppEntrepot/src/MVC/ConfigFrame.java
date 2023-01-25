package MVC;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.stage.Stage;

import java.io.IOException;

/**
 *
 *  Permet de lancer la fenetre de configuration de l'application avec des paramètres prédéfinis.
 *
 */
public class ConfigFrame extends Application {
    /**
     * Charge les fichiers nécessaires et meets en place les paramètres de base
     *
     * @param _primaryStage the primary stage for this application, onto which
     * the application scene can be set. The primary stage will be embedded in
     * the browser if the application was launched as an applet.
     * Applications may create other stages, if needed, but they will not be
     * primary stages and will not be embedded in the browser.
     * @throws Exception
     */
    @Override
    public void start(Stage _primaryStage) throws Exception {

        Stage primaryStage = _primaryStage;

        try {
            FXMLLoader fxmlLoader = new FXMLLoader();
            fxmlLoader.setLocation(getClass().getResource("configFrame.fxml"));

            Scene scene = new Scene(fxmlLoader.load(), 600, 400);
            Stage stage = new Stage();
            stage.setTitle("Configuration");
            stage.setScene(scene);
            stage.show();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    /**
     * Sert de point d'entrée dans la classe
     */
    public static void runApp() {
        Application.launch();
    }
}
