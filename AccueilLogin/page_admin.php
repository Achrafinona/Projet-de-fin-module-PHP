<?php 
    session_start() ;
    $dsn="mysql:host=localhost;dbname=PFM;charset=utf8";
    $user="root" ;
    $pass="achraf" ;
    $mysqlConnexion=new PDO($dsn,$user,$pass) ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin space</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table, th, td {
        border:1px solid black;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Inscription<span>->Evenements</span></div>
            <form action="logout.php">
                <button type="submit" style="color: red;">Deconnexion </button>
            </form>
        </nav>
    </header>
    <h2>Liste des evenements : </h2>
        <?php
        try {
            
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

                echo "<td>" ;
                echo "<form method='POST'>" ;
                echo "<input type='hidden' name='event_i' value='".$table_row['id']."'>" ;
                echo "<button type='submit' name='boutton_event' value='modifier' style='color:blue;'>Modifier</button>" ;
                echo "<button type='submit' name='boutton_event' value='supprimer' style='color:red;'>Supprimer</button>" ;
                echo "</form>" ;
                echo "</td>" ;

                echo "</tr>" ;
            }
            echo "</table>" ;
            
            echo "<form method='POST'>";
            echo "<button type='submit' name='boutton_event' value='ajouter' style='color:green;'>Ajouter</button>";
            echo "</form>";
            // si supprimer 
            if (isset($_POST['boutton_event'])){
                if ($_POST['boutton_event'] == 'modifier') {
                    header("Location:espace_admin/modifier.php") ;
                }
                else if ($_POST['boutton_event'] == 'supprimer'){
                    $pdostat=$mysqlConnexion->prepare("DELETE FROM evenements WHERE id=:id") ;
                    $pdostat->bindValue(':id',$_POST['event_i']) ;
                    $pdostat->execute();
                }
                else if ($_POST['boutton_event'] == 'ajouter')
                    header("Location:espace_admin/ajouter.php") ;           
            }

            
             

        }catch(PDOException $e){
            echo "Erreur : ".$e->getMessage() ;
            exit() ;
        }

        ?>

    
</body>
</html>