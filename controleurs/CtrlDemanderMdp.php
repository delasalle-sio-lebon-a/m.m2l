<?php
// Projet Réservations M2L - version web mobile
// fichier : controleurs/CtrlAnnulerReservation.php
// Rôle : Traiter l'annulation d'une réservation
// Création : 21/11/2017 par Kylian
// Mise à jour : 21/11/2017 par Kylian

$nom = $_SESSION['nom'];

if ( ! isset ($_POST ["txtIdRes"]) ) {
    // si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
    $idRes="";
    $message = '';
    $typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
    $themeFooter = $themeNormal;
    include_once ('vues/VueDemanderMdp.php');
}
else {
    // récupération des données postées
    if ( empty ($_POST ["txtIdRes"]) == true)  $idRes = "";  else   $idRes = $_POST ["txtIdRes"];

    if ($idRes == '') {
        // si les données sont incorrectes ou incomplètes, réaffichage de la vue de suppression avec un message explicatif
        $message = 'Données incomplètes ou incorrectes !';
        $typeMessage = 'avertissement';
        $themeFooter = $themeProbleme;
        include_once ('vues/VueDemanderMdp.php');
    }
    else {
        // connexion du serveur web à la base MySQL
        include_once ('modele/DAO.class.php');
        $dao = new DAO();
       
        if ( $dao->existeUtilisateur($idRes)->getName() == false ) {
            // si le nom existe déjà, réaffichage de la vue
            $message = "Nom d'utilisateur inexistant !";
            $typeMessage = 'avertissement';
            $themeFooter = $themeProbleme;
            include_once ('vues/VueDemanderMdp.php');
        }
       
                    else {
                        $ok = $dao->envoyerMdp($idRes);
                        if ( ! $ok) {
                            // si l'enregistrement a échoué, réaffichage de la vue avec un message explicatif
                            $message = "Problème lors de l'enregistrement !";
                            $typeMessage = 'avertissement';
                            $themeFooter = $themeProbleme;
                            include_once ('vues/VueDemanderMdp.php');
                        }
                        else {
                            
                            // envoi d'un mail de confirmation de l'enregistrement
                            $sujet = "envoie de mdp";
                            $contenuMail = "Votre mdp : " . $idRes .  "\n";
                            
                            $adrMail = $dao->getUtilisateur($nom)->getEmail();
                            $ok = Outils::envoyerMail($adrMail, $sujet, $contenuMail, $ADR_MAIL_EMETTEUR);
                            if ( ! $ok ) {
                                // si l'envoi de mail a échoué, réaffichage de la vue avec un message explicatif
                                $message = "Enregistrement effectué.<br>L'envoi du mail à l'utilisateur a rencontré un problème !";
                                $typeMessage = 'avertissement';
                                $themeFooter = $themeProbleme;
                                include_once ('vues/VueDemanderMdp.php');
                            }
                            else {
                                // tout a fonctionné
                                $message = "Enregistrement effectué.<br>Un mail va être envoyé à l'utilisateur !";
                                $typeMessage = 'information';
                                $themeFooter = $themeNormal;
                                include_once ('vues/VueDemanderMdp.php');
                            }
                        }
                    }
                 }
    unset($dao);
    
            }
        // fermeture de la connexion à MySQL
    

