<?php
// Projet Réservations M2L - version web mobile
// fichier : controleurs/CtrlCreerUtilisateur.php
// Rôle : traiter la demande de création d'un nouvel utilisateur
// Création : 21/10/2015 par JM CARTRON
// Mise à jour : 2/6/2016 par JM CARTRON

if ($_SESSION['niveauUtilisateur'] != 'administrateur' && $_SESSION['niveauUtilisateur'] != 'utilisateur') {
    // si l'utilisateur n'a pas le niveau administrateur, il s'agit d'une tentative d'accès frauduleux
    // dans ce cas, on provoque une redirection vers la page de connexion
    header ("Location: index.php?action=Deconnecter");
}
else{
    
    if ( ! isset ($_POST ["txtMdp"]) && ! isset ($_POST ["txtMdpConfirm"]) ) {
        // si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
        $mdp = '';
        $mdpConfirm = '';
        $message = '';
        $typeMessage = '';			//2 valeurs possibles : 'information' ou 'avertissement'
        $themeFooter = $themeNormal;
        include_once ('vues/VueChangerDeMdp.php');
    }
    else {
        // récupération des données postées
        if ( empty ($_POST ["txtMdp"]) == true)  $mdp = "";  else   $mdp = $_POST ["txtMdp"];
        if ( empty ($_POST ["txtMdpConfirm"]) == true)  $mdpConfirm = "";  else   $mdpConfirm = $_POST ["txtMdpConfirm"];
        
        if ($mdp == '' && $mdpConfirm == '')
        {
            // si les données sont incomplètes, réaffichage de la vue de modification avec un message explicatif
            $message = 'Données incomplètes ou incorrectes !';
            $typeMessage = 'avertissement';
            $themeFooter = $themeProbleme;
            include_once ('vues/VueChangerDeMdp.php');
        }
        if ($mdp != $mdpConfirm)
        {
            // si les deux mots de passe sont différents, avec un  message explicatif  
            $message = 'Les deux mots de passe sont différents !';
            $typeMessage = 'avertissement';
            $themeFooter = $themeProbleme;
            include_once ('vues/VueChangerDeMdp.php');
        }
        // connexion du serveur web à la base MySQL
        include_once ('modele/DAO.class.php');
        $dao = new DAO();
        global $ADR_MAIL_EMETTEUR;
        
        if ( ! isset ($_SESSION['nom']) == true)  $name = '';  else  $name = $_SESSION['nom'];
        
        //récupération du nom de l'utilisateur
        $unUtilisateur = $dao->getUtilisateur($name);
        //récupération de l'utilisateur
        $ok = $dao->modifierMdpUser($name, $mdp);
        $adresseDestinataire = $unUtilisateur->getEmail();
        
        if ( ! $ok )
        {
            // si l'enregistrement a échoué, réaffichage de la vue avec un message explicatif
            $message = "Problème lors de la modification du mot de passe !";
            $typeMessage = 'avertissement';
            $themeFooter = $themeProbleme;
            include_once ('vues/VueChangerDeMdp.php');
        }
        else {
            // envoi d'un mail de confirmation de l'enregistrement
            $sujet = "modification de votre mot de passe dans le système de réservation de M2L";
            $message = "Vous venez de modifier votre mot de passe.\n\n";
            $ok = Outils::envoyerMail($adresseDestinataire, $sujet, $message, $ADR_MAIL_EMETTEUR);
            if ( ! $ok ) {
                // si l'envoi de mail a échoué, réaffichage de la vue avec un message explicatif
                $message = "Suppression non-effectuée.<br>L'envoi du mail à l'utilisateur a rencontré un problème !";
                $typeMessage = 'avertissement';
                $themeFooter = $themeProbleme;
                include_once ('vues/VueChangerDeMdp.php');
            }
            else {
                // tout a fonctionné
                $message = "Suppression effectuée.<br>Un mail va être envoyé à l'utilisateur !";
                $typeMessage = 'information';
                $themeFooter = $themeNormal;
                include_once ('vues/VueChangerDeMdp.php');
            }
        }      
    }
}
?>