<?php
// Projet Réservations M2L - version web mobile
// fichier : vues/VueCreerUtilisateur.php
// Rôle : visualiser la demande de création d'un nouvel utilisateur
// cette vue est appelée par le contôleur controleurs/CtrlCreerUtilisateur.php
// Création : 12/10/2015 par JM CARTRON
// Mise à jour : 2/6/2016 par JM CARTRON
?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
		
		<script>
			// associe une fonction à l'événement pageinit
			$(document).bind('pageinit', function() {
				// l'événement "click" de la case à cocher "caseAfficherMdp" est associé à la fonction "afficherMdp"
				$('#caseAfficherMdp').click( afficherMdp );

				// selon l'état de la case, le type de la zone de saisie est "text" ou "password"
				afficherMdp();
				
				<?php if ($typeMessage != '') { ?>
					// affiche la boîte de dialogue 'affichage_message'
					$.mobile.changePage('#affichage_message', {transition: "<?php echo $transition; ?>"});
				<?php } ?>
			} );

			// selon l'état de la case, le type de la zone de saisie est "text" ou "password"
			function afficherMdp() {
				// tester si la case est cochée
				if ( $("#caseAfficherMdp").is(":checked") ) {
					// la zone passe en <input type="text">
					$('#txtMdp').attr('type', 'text');
					$('#txtMdpConfirm').attr('type', 'text');
				}
				else {
					// la zone passe en <input type="password">
					$('#txtMdp').attr('type', 'password');
					$('#txtMdpConfirm').attr('type', 'password');
				};
			}
		</script>
	</head>
	
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Changer le mot de passe</h4>
				<form action="index.php?action=ChangerDeMdp" method="post" data-ajax="false">
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="txtName">Utilisateur :</label>
						<input type="text" name="txtMdp" id="txtMdp" required placeholder="Entrez le nouveau mot de passe" value="<?php echo $mdp; ?>">
						<input type="text" name="txtMdpConfirm" id="txtMdpConfirm" required placeholder="Confirmer le nouveau mot de passe" value="<?php echo $mdpConfirm; ?>">
					</div>
					<div data-role="fieldcontain" data-type="horizontal" class="ui-hide-label">
						<label for="caseAfficherMdp">Afficher le mot de passe en clair</label>
						<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" onclick="afficherMdp();" data-mini="true" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
					</div>
					<div data-role="fieldcontain">
						<input type="submit" name="btnChangerMdp" id="btnChangerMdp" value="Changer le mot de passe" data-mini="true">
					</div>
				</form>
				
				<?php /*if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					echo "<p>name = " . $name . "</p>";
				} */?>
				
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Suivi des réservations de salles<br>Maison des ligues de Lorraine (M2L)</h4>
			</div>
		</div>
		
		<?php include_once ('vues/dialog_message.php'); ?>
		
	</body>
</html>