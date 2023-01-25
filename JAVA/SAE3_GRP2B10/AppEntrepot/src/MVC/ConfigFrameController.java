package MVC;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.CheckBox;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.io.IOException;
import java.nio.file.Files;
import java.net.URL;
import java.util.List;
import java.util.Objects;
import java.util.ResourceBundle;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
/**

 La classe ConfigFrameController gère l'interface graphique de la fenêtre de configuration. Elle permet de lire les informations de configuration contenues dans un fichier de configuration, de les afficher dans les champs de saisie correspondants, et de les enregistrer lorsque l'utilisateur clique sur le bouton de validation.
 @author Luca Straputicari , Vignal Alexandre, Fernandez Mickael, Dourlent Maxime

 */
public class ConfigFrameController implements Initializable {

    private Stage secondaryStage;
    /**
     * La méthode initialize est appelée automatiquement lorsque la classe ConfigFrameController est instanciée. Elle permet d'initialiser les champs et les checkbox de la fenêtre de configuration avec les valeurs contenues dans le fichier de configuration "config.txt".
     *
     * @param location L'URL de l'emplacement de la classe.
     *
     * @param resources Le bundle de ressources utilisé pour localiser les elements de l'interface utilisateur.
     */
    @Override
    public void initialize(URL location, ResourceBundle resources) {
        String[] valTab ;
        int co2Check = 1;
        int humiCheck = 1;
        int tempCheck = 1;

        try {
            File config = new File("config.txt");
            String configPath = config.getAbsolutePath();

            BufferedReader reader = new BufferedReader(new FileReader(configPath));
            String line;
            while ((line = reader.readLine()) != null) {
                if(line.startsWith("server:")){
                    server.setText(line.split(":")[1]);
                }
                if(line.startsWith("port:")){
                    port.setText(line.split(":")[1]);
                }
                if(line.startsWith("timer:")){
                    timerID.setText(line.split(":")[1]);
                }
                if(line.startsWith("activity:")){
                    valTab = line.split(":");

                    for (int i = 0; i < valTab.length; i+= 3){

                        if(Objects.equals(valTab[i], "co2")){
                            co2Check = Integer.parseInt(valTab[i+1]);
                            textSCO2.setText(valTab[i+2]);
                        }
                        if(Objects.equals(valTab[i], "humidity")){
                            humiCheck = Integer.parseInt(valTab[i+1]);
                            textSHUMIDITY.setText(valTab[i+2]);
                        }
                        if(Objects.equals(valTab[i], "temperature")){
                            tempCheck = Integer.parseInt(valTab[i+1]);
                            textSTEMP.setText(valTab[i+2]);
                        }
                    }
                }
                if(line.startsWith("devices:")){
                    capteurs.setText(line.substring(8));
                }
            }
            if(co2Check ==  1){
                cbCO2.setSelected(true);
                textSCO2.setDisable(false);
            }else {
                cbCO2.setSelected(false);
                textSCO2.setDisable(true);
            }
            cbCO2.setOnAction(event -> {
                textSCO2.setDisable(!cbCO2.isSelected());
            });

            if(humiCheck ==  1){
                cbHUMIDITY.setSelected(true);
                textSHUMIDITY.setDisable(false);
            }else {
                cbHUMIDITY.setSelected(false);
                textSHUMIDITY.setDisable(true);
            }
            cbHUMIDITY.setOnAction(event -> {
                textSHUMIDITY.setDisable(!cbHUMIDITY.isSelected());
            });
            if(tempCheck ==  1){
                cbTEMP.setSelected(true);
                textSTEMP.setDisable(false);
            }else {
                cbTEMP.setSelected(false);
                textSTEMP.setDisable(true);
            }
            cbTEMP.setOnAction(event -> {
                textSTEMP.setDisable(!cbTEMP.isSelected());
            });





            String fourDigitsRegex = "^\\d{1,4}$";
            Pattern pattern = Pattern.compile(fourDigitsRegex);
            port.textProperty().addListener((observable, oldValue, newValue) -> {
                Matcher matcher = pattern.matcher(newValue);

                if (!matcher.matches()) {
                    Alert alert = new Alert(Alert.AlertType.ERROR);
                    alert.setTitle("Erreur de saisie");
                    alert.setHeaderText(null);
                    alert.setContentText("Le port doit comprendre un maximum de 4 carateres et seulement des chiffres.");
                    alert.showAndWait();

                    port.setText(oldValue);
                }
            });

            String timer = "^(100|[1-9]?[0-9])$";
            Pattern pattern2 = Pattern.compile(timer);
            timerID.textProperty().addListener((observable, oldValue, newValue) -> {
                Matcher matcher = pattern2.matcher(newValue);

                if (!matcher.matches()) {
                    Alert alert = new Alert(Alert.AlertType.ERROR);
                    alert.setTitle("Erreur de saisie");
                    alert.setHeaderText(null);
                    alert.setContentText("Le timer doit etre compris entre 0 et 100.");
                    alert.showAndWait();

                    timerID.setText(oldValue);
                }
            });

            String seuil = "^(?=.*[0-9])[0-9]*$";
            Pattern pattern3 = Pattern.compile(seuil);
            textSCO2.textProperty().addListener((observable, oldValue, newValue) -> {
                Matcher matcher = pattern3.matcher(newValue);

                if (!matcher.matches()) {
                    Alert alert = new Alert(Alert.AlertType.ERROR);
                    alert.setTitle("Erreur de saisie");
                    alert.setHeaderText(null);
                    alert.setContentText("Il faut au moins un chiffre dans le seuil de CO2.");
                    alert.showAndWait();

                    textSCO2.setText(oldValue);
                }
            });
            Pattern pattern4 = Pattern.compile(seuil);
            textSHUMIDITY.textProperty().addListener((observable, oldValue, newValue) -> {
                Matcher matcher = pattern4.matcher(newValue);

                if (!matcher.matches()) {
                    Alert alert = new Alert(Alert.AlertType.ERROR);
                    alert.setTitle("Erreur de saisie");
                    alert.setHeaderText(null);
                    alert.setContentText("Il faut au moins un chiffre dans le seuil d'humidité.");
                    alert.showAndWait();

                    textSHUMIDITY.setText(oldValue);
                }
            });




            Pattern pattern5 = Pattern.compile(seuil);
            textSTEMP.textProperty().addListener((observable, oldValue, newValue) -> {
                Matcher matcher = pattern5.matcher(newValue);

                if (!matcher.matches()) {
                    Alert alert = new Alert(Alert.AlertType.ERROR);
                    alert.setTitle("Erreur de saisie");
                    alert.setHeaderText(null);
                    alert.setContentText("Il faut au moins un chiffre dans le seuil de température.");
                    alert.showAndWait();

                    textSTEMP.setText(oldValue);
                }
            });


            String serveur = "^(?!\\s*$).+";
            Pattern pattern7 = Pattern.compile(serveur);
            server.textProperty().addListener((observable, oldValue, newValue) -> {
                Matcher matcher = pattern7.matcher(newValue);

                if (!matcher.matches()) {
                    Alert alert = new Alert(Alert.AlertType.ERROR);
                    alert.setTitle("Erreur de saisie");
                    alert.setHeaderText(null);
                    alert.setContentText("Serveur ne doit pas etre vide.");
                    alert.showAndWait();

                    server.setText(oldValue);
                }
            });





            reader.close();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    @FXML
    private TextField server;
    @FXML
    private TextField port;
    @FXML
    private TextArea capteurs;
    @FXML
    private TextField timerID;
    @FXML
    private CheckBox cbCO2;
    @FXML
    private CheckBox cbTEMP;
    @FXML
    private CheckBox cbHUMIDITY;
    @FXML
    private TextField textSCO2;
    @FXML
    private TextField textSTEMP;
    @FXML
    private TextField textSHUMIDITY;
    @FXML
    private void saveConfiguration(javafx.event.ActionEvent actionEvent) {
        String serverName = server.getText();
        String portId = port.getText();
        String timer = timerID.getText();
        boolean temperatureChecked = cbTEMP.isSelected();
        String temperatureValue = textSTEMP.getText();
        boolean co2Checked = cbCO2.isSelected();
        String co2Value = textSCO2.getText();
        boolean humidityChecked = cbHUMIDITY.isSelected();
        String humidityValue = textSHUMIDITY.getText();
        String capteursValue = capteurs.getText();


        try {




            File config = new File("config.txt");
            String configPath = config.getAbsolutePath();

            Path path = Paths.get(configPath);
            List<String> lines = Files.readAllLines(path);
            for (int i = 0; i < lines.size(); i++) {
                if (lines.get(i).startsWith("server:")) {
                    lines.set(i, "server:" + serverName);
                }
                if (lines.get(i).startsWith("port:")) {
                    lines.set(i, "port:" + portId);
                }
                if (lines.get(i).startsWith("timer:")) {
                    lines.set(i, "timer:" + timer);
                }

                if (lines.get(i).matches(".*temperature.*")) {
                    lines.set(i, lines.get(i).replaceAll("temperature:[0-1]:[0-9]{1,3}", "temperature:" + (temperatureChecked ? 1 : 0) + ":" + temperatureValue));
                }
                if (lines.get(i).matches(".*co2.*") ) {
                    lines.set(i, lines.get(i).replaceAll("co2:[0-1]:[0-9]{1,3}", "co2:" + (co2Checked ? 1 : 0) + ":" + co2Value));
                }
                if (lines.get(i).matches(".*humidity.*") ) {
                    lines.set(i, lines.get(i).replaceAll("humidity:[0-1]:[0-9]{1,3}","humidity:" + (humidityChecked ? 1 : 0) + ":" + humidityValue));
                }

                if (lines.get(i).startsWith("devices:")) {
                    lines.set(i, "devices:" + capteursValue);
                }
            }
            // rewrite the file with the new values
            Files.write(path, lines);


            // show success message
            Alert alert = new Alert(Alert.AlertType.INFORMATION);

            alert.setTitle("Information Dialog");
            alert.setHeaderText(null);
            alert.setContentText("Configuration saved successfully!");
            alert.showAndWait();
            alert.close();

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}