<?php

/*
echo '<div class="container">';

echo '<nav class="navbar navbar-expand-lg navbar-light" style="background-color: transparent ">';
echo '<ul class="nav justify-content-center">';
echo '  <li class="nav-item"><a class="nav-link" href="index.php?action=accueil&id='.$_SESSION["token"].'">Accueil</a></li>';
echo '<li class="nav-item"><a class="nav-link" href="index.php?action=ajoutLivre&id='.$_SESSION["token"].'">Ajouter un livre</a></li>';
echo '<li class="nav-item"><a class="nav-link" href="index.php?action=allLivre&id='.$_SESSION["token"].'">Liste des livres</a></li>';
echo '  <li class="nav-item"><a class="nav-link" href="index.php?action=deleteLivre&id='.$_SESSION["token"].'">Supprimer un livre</a></li>';
echo '  <li class="nav-item"><a class="nav-link" href="index.php?action=moncompte&id='.$_SESSION["token"].'">Mon Compte</a></li>';
echo '  <li class="nav-item"><a class="nav-link " href="index.php">Déconnexion</a></li>';
echo '</ul>';
echo '</nav>';
*/
echo '
<nav class="navbar navbar-inverse" style="z-index:1000;background-color:white;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="height:50px;">MENU</button>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Bibliotheque</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">';

      	if ($page=='accueil') {
        	echo '<li class="nav-item"><a class="nav-link" href="index.php?action=accueil&id='.$_SESSION["token"].'" style="color:red;">Accueil</a></li>';
        } else {
			echo '<li class="nav-item"><a class="nav-link" href="index.php?action=accueil&id='.$_SESSION["token"].'">Accueil</a></li>';
        }

        if ($page=='ajout') {
        	echo '<li class="nav-item"><a class="nav-link" href="index.php?action=ajoutLivre&id='.$_SESSION["token"].'" style="color:red;">Ajouter un livre</a></li>';
        } else {
			echo '<li class="nav-item"><a class="nav-link" href="index.php?action=ajoutLivre&id='.$_SESSION["token"].'">Ajouter un livre</a></li>';
        }
        echo '
        <li class="nav-item"><a class="nav-link" href="index.php?action=allLivre&id='.$_SESSION["token"].'">Liste des livres</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=deleteLivre&id='.$_SESSION["token"].'">Supprimer un livre</a></li>
        ';
        if ($page=='compte') {
			echo '<li class="nav-item"><a class="nav-link" href="index.php?action=moncompte&id='.$_SESSION["token"].'" style="color:red;">Mon Compte</a></li>';
		} else {
			echo '<li class="nav-item"><a class="nav-link" href="index.php?action=moncompte&id='.$_SESSION["token"].'">Mon Compte</a></li>';
		}
		echo '
        <li class="nav-item"><a class="nav-link " href="index.php">Déconnexion</a></li>
        ';
      echo '</ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
';



?>