<?php
// Projet Réservations M2L - version web mobile
// fichier : controleurs/CtrlConsulterReservations.php
// Rôle : traiter la demande de consultation des réservations d'un utilisateur
// écrit par Jim le 12/10/2015
// modifié par Jim le 28/6/2016

// on vérifie si le demandeur de cette action est bien authentifié
if ( $_SESSION['niveauUtilisateur'] != 'utilisateur' && $_SESSION['niveauUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else {
	// connexion du serveur web à la base MySQL
	include_once ('modele/DAO.class.php');
	$dao = new DAO();
	
	/*
	// mise à jour de la table mrbs_entry_digicode (si besoin) pour créer les digicodes manquants
	$dao->creerLesDigicodesManquants();
	*/
	
	// récupération des réservations à venir créées par l'utilisateur à l'aide de la méthode getLesReservations de la classe DAO
	$lesSalles = $dao->getLesSalles();
	
	// mémorisation du nombre de réservations
	$nbReponses = sizeof($lesSalles);

	// préparation d'un message précédent la liste
	if ($nbReponses == 0) {
		$message = "il n'y a aucune salle !";
	}
	else {
		$message = "Il y a " . $nbReponses . " salle(s) !";
	}
	
	// affichage de la vue
	include_once ('vues/VueConsulterSalles.php');
	
	unset($dao);		// fermeture de la connexion à MySQL
}