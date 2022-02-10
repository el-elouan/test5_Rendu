<?php
class validLivreController  {

    public function __construct()
	{    
        session_start();
        error_reporting(1);
        require_once "controller/Controller.php";
        require_once "metier/Livre.php";
        require_once "PDO/LivreDB.php";
        require_once "PDO/connectionPDO.php";
        require_once "Constantes.php";
	  //TODO
        $titre = $_POST['nom'] ?? null;
        $edition = $_POST['edition'] ?? null;
        $information = $_POST['info'] ?? null;
        $auteur = $_POST['auteur'] ?? null;
        //action pour update ou insert, delete, select selectall
        $operation = $_GET['operation'] ?? null;
        if (Controller::auth()) {
            if($operation=="insert"){
                $livreDB = new LivreDB($pdo);
                $res = $livreDB->ajout(new Livre($titre, $edition, $information, $auteur));
                if ($res) {
                    echo "ça marche";
                }
            }
            else {
                //erreur on renvoit à la page d'accueil
                header('Location: accueil.php?id='.$_SESSION["token"]);
            }
        }
    }
}
