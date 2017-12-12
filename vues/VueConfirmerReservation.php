<?php
// Projet Réservations M2L - version web mobile
// fichier : controleurs/VueConfirmerReservation.php
// Rôle : Confirmer une réservation
// Création : 28/11/2017 par Kylian
// Mise à jour : 28/11/2017 par Kylian
?>
<!doctype >
<html>
<head>
		<?php include_once ('vues/head.php'); ?>
		
		<script>
			// associe une fonction à l'événement pageinit
			$(document).bind('pageinit', function() {
				<?php if ($typeMessage != '') { ?>
					// affiche la boîte de dialogue 'affichage_message'
					$.mobile.changePage('#affichage_message', {transition: "<?php echo $transition; ?>"});
				<?php } ?>
			} );
		</script>
	</head>
	
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Confirmer une réservation</h4>
				<form action="index.php?action=ConfirmerReservation" method="post" data-ajax="false">
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="txtIdRes">Réservation :</label>
						<input type="text" name="txtIdRes" id="txtIdRes" required placeholder="Entrez l'id de réservation" value="<?php echo $idRes; ?>"/>
					</div>
					
					<div data-role="fieldcontain">
						<input type="submit" name="btnAnnulerRes" id="btnAnnulerRes" value="Confirmer la réservation" data-mini="true">
					</div>
				</form>

				<?php if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					echo "<p>id de réservation = " . $idRes . "</p>";
				} ?>
				
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Suivi des réservations de salles<br>Maison des ligues de Lorraine (M2L)</h4>
			</div>
		</div>
		
		<?php include_once ('vues/dialog_message.php'); ?>
		
	</body>
</html>