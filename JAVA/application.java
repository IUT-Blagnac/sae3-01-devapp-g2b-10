
import java.io.FileWriter;
import java.io.IOException;
import java.util.Scanner;

public class test {  
  public static void main(String[] args) {  
    try {  
    	
      //Fichier config.txt sur lequel on va écrire la configuration pour la partie  python
      FileWriter myWriter = new FileWriter("config.txt");
      boolean contine=true;
      
     //Demande le serveur à sélectionner
      Scanner server = new Scanner(System.in);
      System.out.println("Serveur : ");
	  String serveur = server.next();
     
	//Demande le port à sélectionner
	  Scanner port = new Scanner(System.in);
	  System.out.println("Port : ");
	  CharSequence Port= port.next();
	//Ecris dans config.txt le nom du serveur et le port
	  myWriter.write("server :"+serveur+"\n"+"port :"+Port+"\ndevices :\n");
	//Demande le nom du device jusqu'a ce qu'on selectionne 2, pour définir la fin des devices
      while(contine!=false) {
      Scanner device = new Scanner(System.in);
      System.out.println("Device : ");
      CharSequence device1= device.next();
      
      
      Scanner choix = new Scanner(System.in);
      System.out.println("Autre device ? Si oui tapez \"1\"sinon tapez \"2");
      int choixx = choix.nextInt();
    
    //Ajoute au fichier les devices 1 par 1
      if(choixx==1) {
    	  myWriter.append(device1+"\n");
    
      }else if(choixx==2) {
    	  myWriter.append(device1+"\n");
    	  contine =false; 
      }
      }
    
    //Ferme le ficheir config.txt
      myWriter.close();
      System.out.println("Le fichier configuration est écrit.");
    } catch (IOException e) {
      System.out.println("An error occurred.");
      e.printStackTrace();
    } 
  }  
} 

              

