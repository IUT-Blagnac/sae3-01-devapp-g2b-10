package MVC;

import java.util.Optional;

import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.ButtonType;
import javafx.stage.Stage;

/**
 * Gère les différents types de fenetres d'alertes
 */
public class AlertUtilities {

	/**
	 * Ouvre une fenetre de confirmation liée à la fenetre donnée
	 *
	 * @param _fen fenetre mère de l'alerte
	 * @param _title titre de la fenetre d'alerte
	 * @param _message message de la fenetre d'alerte
	 * @param _content contenu de la fenetre d'alerte
	 * @param _al type de l'alerte à déclencher
	 * @return True si le bouton confirmer est appuyé, False sinon
	 */
	public static boolean confirmYesCancel(Stage _fen, String _title, String _message, String _content, AlertType _al) {

		if (_al == null) {
			_al = AlertType.INFORMATION;
		}
		Alert alert = new Alert(_al);
		alert.initOwner(_fen);
		alert.setTitle(_title);
		if (_message == null || !_message.equals(""))
			alert.setHeaderText(_message);
		alert.setContentText(_content);

		Optional<ButtonType> option = alert.showAndWait();
		if (option.isPresent() && option.get() == ButtonType.OK) {
			return true;
		}
		return false;
	}

	/**
	 * Ouvre une fenetre d'alerte liée à la fenetre donnée
	 *
	 * @param _fen fenetre mère de l'alerte
	 * @param _title titre de la fenetre d'alerte
	 * @param _message message de la fenetre d'alerte
	 * @param _content contenu de la fenetre d'alerte
	 * @param _al type de l'alerte à déclencher
	 */
	public static void showAlert(Stage _fen, String _title, String _message, String _content, AlertType _al) {

		if (_al == null) {
			_al = AlertType.INFORMATION;
		}
		Alert alert = new Alert(_al);
		alert.initOwner(_fen);
		alert.setTitle(_title);
		if (_message == null || !_message.equals(""))
			alert.setHeaderText(_message);
		alert.setContentText(_content);

		alert.showAndWait();
	}
}
