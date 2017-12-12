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
    include_once ('vues/VueConfirmerReservation.php');
}
else {
    // récupération des données postées
    if ( empty ($_POST ["txtIdRes"]) == true)  $idRes = "";  else   $idRes = $_POST ["txtIdRes"];

    if ($nom == '') {
        // si les données sont incorrectes ou incomplètes, réaffichage de la vue de suppression avec un message explicatif
        $message = 'Données incomplètes ou incorrectes !';
        $typeMessage = 'avertissement';
        $themeFooter = $themeProbleme;
        include_once ('vues/VueConfirmerReservation.php');
    }
    else {
        // connexion du serveur web à la base MySQL
        include_once ('modele/DAO.class.php');
        $dao = new DAO();
       
        if ( $dao->existeReservation($idRes) == false ) {
            // si le nom existe déjà, réaffichage de la vue
            $message = "Numéro de réservation inexistant !";
            $typeMessage = 'avertissement';
            $themeFooter = $themeProbleme;
            include_once ('vues/VueConfirmerReservation.php');
        }
        else {
            // créateur ?
            if ( ! $dao->estLeCreateur($nom, $idRes) ) {
                // si l'utilisateur n'est pas l'auteur, réaffichage de la vue avec un message explicatif
                $message = "Vous n'êtes pas l'auteur de cette réservation !";
                $typeMessage = 'avertissement';
                $themeFooter = $themeProbleme;
                include_once ('vues/VueConfirmerReservation.php');
            }
            else {
                $laReservation = $dao->getReservation($idRes);
               
                if ($laReservation->getStatus() == 0) {
                    $message = "Cette réservation est déjà confirmée!";
                    $typeMessage = 'avertissement';
                    $themeFooter = $themeProbleme;
                    include_once ('vues/VueConfirmerReservation.php');
                }
                else {
                    // date ?
                    if ( $laReservation->getEnd_time() < time()) {
                        // si la réservation est passée, réaffichage de la vue avec un message explicatif
                        $message = "Cette réservation est déjà passée !";
                        $typeMessage = 'avertissement';
                        $themeFooter = $themeProbleme;
                        include_once ('vues/VueConfirmerReservation.php');
                    }
                    else {
                        $ok = $dao->confirmerReservation($idRes);
                        if ( ! $ok) {
                            // si l'enregistrement a échoué, réaffichage de la vue avec un message explicatif
                            $message = "Problème lors de l'enregistrement !";
                            $typeMessage = 'avertissement';
                            $themeFooter = $themeProbleme;
                            include_once ('vues/VueConfirmerReservation.php');
                        }
                        else {
                            
                            // envoi d'un mail de confirmation de l'enregistrement
                            $sujet = "Confiormation de réservation";
                            $contenuMail = "Votre réservation : " . $idRes . " est bien confirmée" . "\n";
                            
                            $adrMail = $dao->getUtilisateur($nom)->getEmail();
                            $ok = Outils::envoyerMail($adrMail, $sujet, $contenuMail, $ADR_MAIL_EMETTEUR);
                            if ( ! $ok ) {
                                // si l'envoi de mail a échoué, réaffichage de la vue avec un message explicatif
                                $message = "Enregistrement effectué.<br>L'envoi du mail à l'utilisateur a rencontré un problème !";
                                $typeMessage = 'avertissement';
                                $themeFooter = $themeProbleme;
                                include_once ('vues/VueConfirmerReservation.php');
                            }
                            else {
                                // tout a fonctionné
                                $message = "Enregistrement effectué.<br>Un mail va être envoyé à l'utilisateur !";
                                $typeMessage = 'information';
                                $themeFooter = $themeNormal;
                                include_once ('vues/VueConfirmerReservation.php');
                            }
                        }
                    }
                }
            }
        }
        unset($dao);		// fermeture de la connexion à MySQL
    }
}
