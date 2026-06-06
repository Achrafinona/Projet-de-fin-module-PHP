<?php
    session_start() ;
    $dsn="mysql:host=localhost;dbname=PFM;charset=utf8";
    $user="root" ;
    $pass="achraf" ;

    if (!isset($_SESSION['panier']))
        $_SESSION['panier'] = [] ;
    if (isset($_POST['boutt_ajouter'])){
        $_SESSION['panier'][] = $_POST['id_panier'] ;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../style.css">
     <style>
        table, th, td {
        border:1px solid black;
        }
    </style>
    <title>Inscription aux Evenements</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Inscription<span>->Evenements</span></div>
            <ul class="nav-links">
                <li><a href="evenement.php">Evenement</a></li>
                <li><a href="../panier/panier.php">Panier</a></li>
            </ul>
            <form action="../logout.php">
                <button type="submit" style="color: red;">Deconnexion </button>
            </form>
        </nav>
    </header>
    <div>
        <h2>Liste des evenements : </h2>
        <?php
        try {
            $mysqlConnexion=new PDO($dsn,$user,$pass) ;
            $pdostat=$mysqlConnexion->query("SELECT * FROM evenements ;") ;
            $pdostat->execute() ;
            $table_evenements = $pdostat->fetchall();
            
            //affichage sous forme de tableau 
            echo "<table style=width:86%><tr><td>id</td><td>Titre</td><td>Date</td><td>Description</td><td>Prix</td><td>Operation</td></tr>" ;
            foreach ($table_evenements as $table_row) {
                echo "<tr>" ;
                echo "<td>". $table_row['id']."</td>";
                echo "<td>". $table_row['titre']."</td>";
                echo "<td>". $table_row['date_eve']."</td>";
                echo "<td>". $table_row['description']."</td>";
                echo "<td>". $table_row['prix']."  DH</td>";

                echo "<form method='POST'>" ;
                echo "<input type='hidden' name='id_panier' value=".$table_row['id'].">" ;
                echo "<td><button type='submit' name='boutt_ajouter'>ajouter</button></td>" ;
                echo "</form>"  ;

                echo "</tr>" ;
            }
            echo "</table>" ;

        }catch(PDOException $e){
            echo "Erreur : ".$e->getMessage() ;
            exit() ;
        }

        ?>

    </div>
</body>
</html>
