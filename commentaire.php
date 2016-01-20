<?php require"function/verif_connexion.php";  ?>
<?php require"function/pagination.php";  ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="images/favicon.png"/>
		<link rel="stylesheet" href="css/style.css" />
		<title>StartinG Blog</title>
	</head>

	<body>
		<header>
				<div class="logo">
					<a href="index.php"><img src="images/logo5.png" /></a>
				</div>
			<div class="formulaire">
			<?php if (!isset($_SESSION['pseudo'])) { ?>
				<form method="POST" action="index.php">
					<input  type="text" name="login" placeholder="User.."/>
					<input  type="password" name="password" placeholder="password.."/>
					<input type="submit" name="connexion" class="bouton" value="Connection" />
				</form>
					<?php }  	
					else if (isset($_SESSION['pseudo']) &&  $_SESSION['status'] == "lecteur") { 
					 
						if (isset($_SESSION['pseudo'])) {
		      				$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
		      				$req4->execute();

		      				while ($dataValue = $req4->fetch()) {
		      					$_SESSION['status'] = $dataValue['status'];
		      					$_SESSION['id_user'] = $dataValue['id_user'];
		      				}
		      			}
					?>
				<nav>
					<ul>
						<li><a href="index.php"> Accueil </a></li>
					</ul>
				</nav>
			<?php }

			else if (isset($_SESSION['pseudo']) && isset($_SESSION['status']) && $_SESSION['status'] == "auteur") {
				
						if (isset($_SESSION['pseudo'])) {
		      				$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
		      				$req4->execute();

		      				while ($dataValue = $req4->fetch()) {
		      					$_SESSION['status'] = $dataValue['status'];
		      					$_SESSION['id_user'] = $dataValue['id_user'];
		      				}
		      			}
					?>
				<nav>
					<ul>
						<li><a href="index.php"> Accueil </a></li>
						<li><a href="billet.php"> Creation de Billet </a></li>
						<li><a href="categorie.php"> Gestion des Categories </a></li>
						<li><a href="gestion_poster.php"> Gestion des Postes </a></li>
					</ul>
				</nav>
			<?php } 
			else if (isset($_SESSION['pseudo']) && isset($_SESSION['status']) && $_SESSION['status'] == "admin") {
				if (isset($_SESSION['pseudo'])) {
		      				$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
		      				$req4->execute();

		      				while ($dataValue = $req4->fetch()) {
		      					$_SESSION['status'] = $dataValue['status'];
		      					$_SESSION['id_user'] = $dataValue['id_user'];
		      				}
		      			}
					?>
				<nav>
					<ul>
						<li><a href="index.php"> Accueil </a></li>
						<li><a href="billet.php"> Creation de Billet </a></li>
						<li><a href="categorie.php"> Gestion des Categories </a></li>
						<li><a href="gestion_user.php"> Gestion Users </a></li>
						<li><a href="gestion_poster.php"> Gestion des Postes </a></li>
					</ul>
				</nav>
			<?php }else if (isset($_SESSION['pseudo']) && isset($_SESSION['status']) && $_SESSION['status'] == "bannir") { 
				echo"<script> alert('Vous avez été Banni Désolé'); </script>";
				?>
				<form method="POST" action="index.php">
					<input  type="text" name="login" placeholder="User.."/>
					<input  type="password" name="password" placeholder="password.."/>
					<input type="submit" name="connexion" class="bouton" value="Connection" />
				</form>
			<?php } ?>
			</div>
		</header>
		<hr>
		<article>
				<div id="style_poste_user">
					<?php if(isset($_SESSION['pseudo']) && $_SESSION['status'] != "bannir") 
					{ ?>
				<p align="center"> Votre Ip : <?php echo $_SERVER["SERVER_ADDR"]; ?></p>
					<p align="center">
					<?php 
						if (isset($_SESSION['pseudo']) && $_SESSION['status'] != "bannir") {
		      				$req4 =$bdd->query('SELECT * FROM tp_user WHERE pseudo = "'.$_SESSION['pseudo'].'" ');
		      				$req4->execute();
		      				while ($dataValue = $req4->fetch()) {
		      					$_SESSION['status'] = $dataValue['status'];
		      					$_SESSION['photo'] = $dataValue['avatar'];
		      				}
		      			}
					?>
				<img src='uploader/<?php echo $_SESSION['photo']; ?>' class="avatar" />
				<p/><p align="center"> Bienvenue : <?php echo $_SESSION['pseudo']."<br> Votre Status :".$_SESSION['status']; ?>  </p>
				<p align="center"> <img src="images/logout.png" class="avs" />&nbsp;&nbsp;<font color="#ffffff"><a href="function/deconnexion.php">Se Deconnecter</a></font><br />
				<?php }

				if (isset($_SESSION['pseudo']) && $_SESSION['status'] == "bannir") { ?>
		      				<center><a href="inscription.php" style="color:#f00;font-weight: bold;">Creer un Compte</a></center>
		      	<?php } ?>
				<hr />
				</div>
				<div id="style_poste">

					<fieldset>
						<?php 
						if (!isset($_SESSION['pseudo']) || isset($_SESSION['pseudo'])) {
      						$sqls= "SELECT * FROM tp_user LEFT JOIN tp_billet ON tp_user.id_user = tp_billet.id_user WHERE  tp_billet.id_billet = ".$_GET['sreemsvxy56Y63MIKyvnbsdnsbcbsupload67dump']." ";

				            $req = $bdd->query($sqls);
				            while ($donnee = $req->fetch() ) { 
				            	 ?>
				             <div>
      							<div id="id_titre"> <?php echo "<p><strong>".$donnee['titre']."</strong></p>"; ?> </div>
      							<div id="id_chapo"> <?php echo "<p>".$donnee['chapo']."</p>"; ?> </div>
      							<div id="id_image">
      							<center> <img src='uploader_poster/<?php echo $donnee['image']; ?>' class="poster_img" /> </center>
      							 </div>
      							<div id="id_corps"> <?php echo "<p>".$donnee['corps']."</p>"; ?> </div>
      							<div id="id_post">  <?php echo "<p>".$donnee['status']." : ".$donnee['pseudo']."<br/> Publier le :".$donnee['date_post']."</p>"; ?>  
      							</div>
      						</div>

				           <?php }  }?>
					</fieldset>
					<fieldset>
						
						<?php 
						$requete2 = $bdd->prepare("SELECT * FROM commentaire 
													LEFT JOIN tp_user ON commentaire.id_user = tp_user.id_user 
													WHERE commentaire.id_billet = :idBillet "
												);
						$requete2->execute(array(':idBillet' => $_GET['sreemsvxy56Y63MIKyvnbsdnsbcbsupload67dump']));

							while ($datDonnee = $requete2->fetch()) { ?>

							<section id="comm">
					            <div id="cercle">
					            	<img src='uploader/<?php echo $datDonnee['avatar']; ?>' style="border-radius:30px;" />
					            </div>

					            <div id="date">
					            	<p> Ecrit par <?php echo $datDonnee['pseudo']; ?>, le <?php echo $datDonnee['date_com']; ?> </p>
					            </div>

					            <div id="fenetre">
					            	<p> 
					            	<?php echo $datDonnee['commentaire']; ?>
					            	</p>
					            </div>
					        </section>
					        <?php
							} ?>
					</fieldset>
					<?php 
						if (isset($_SESSION['pseudo']) && $_SESSION['status'] != "bannir") { ?>
				      		<fieldset>
								<legend>Commentaire</legend>
								<form method="POST" action= <?php echo "commentaire.php?sreemsvxy56Y63MIKyvnbsdnsbcbsupload67dump=".$_GET['sreemsvxy56Y63MIKyvnbsdnsbcbsupload67dump']; ?> >
									<input type="text" name="titre_commentaire" maxlength="150" class="text_billet" placeholder="Titre du Commentaire" />
									<textarea name="corps_commentaire" id="text_post" placeholder="Entrez votre Texte...      -255 Caracteres" maxlength="255">
									</textarea>
									<input type="hidden" value=<?php echo $_GET['sreemsvxy56Y63MIKyvnbsdnsbcbsupload67dump']; ?> name="newid"/>
									<input type="submit" value="Commentaire" name="send_commentaire" />
								</form>
								<?php require"function/poste_commentaire.php"; ?>
							</fieldset>
		      			<?php }else{ ?>
		      				<fieldset>
								<legend>Commentaire</legend>
								<form method="POST">
									<input type="text" name="titre_commentaire" maxlength="150" class="text_billet" placeholder="Titre du Commentaire" disabled="true" />
									<textarea name="corps_commentaire" id="text_post" placeholder="Entrez votre Texte..." disabled="true">
									</textarea>
									<input type="submit" value="Commentaire" name="send_commentaire" disabled="true" />
								</form>
							</fieldset>
		      			<?php }
					?>
					
				</div>
							
		</article>

	</body>
	</html>
