<?php
session_start() ;
if ($_SESSION['statut'] == 'admin')
    header("Location: page_admin.php") ;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ====== BARRE DE NAVIGATION ====== -->
<header>
    <nav class="navbar">
        <div class="logo">Inscription<span>->Evenements</span></div>
        <ul class="nav-links">
            <li><a href="even/evenement.php">Evenement</a></li>
            <li><a href="panier/panier.php">Panier</a></li>
        </ul>
        <form action="logout.php">
            <button type="submit" style="color: red;">Deconnexion </button>
        </form>
    </nav>
</header>

<!-- ====== SECTION HÉRO (partie principale) ====== -->
<main>   
   </section>
    <h2 style="color : #2ecc71;">Bonjour <?php echo $_SESSION['login'];?> </h2>
    <!-- ====== SECTION ÉTAPES ====== -->
    <section class="steps">
        
        <h2>Comment ça marche ?</h2>
        <div class="steps-container">
            <div class="step">
                <h3>1</h3>
                <h4>Créer un compte</h4>
                <p>Remplis tes informations personnelles.</p>
            </div>
            <div class="step">
                <h3>2</h3>
                <h4>Choisir tes préférences</h4>
                <p>Sélectionne la ville et les domaines qui t'intéressent.</p>
            </div>
            <div class="step">
                <h3>3</h3>
                <h4>Valider l'inscription</h4>
                <p>Envoie ton dossier et connecte-toi à ton espace.</p>
            </div>
        </div>
    </section>
</main>

<!-- ====== FOOTER ====== -->
<footer>
    <p>© 2026 Inscription->Evenements — Plateforme d'inscription aux Evenements </p>
</footer>

</body>
</html>