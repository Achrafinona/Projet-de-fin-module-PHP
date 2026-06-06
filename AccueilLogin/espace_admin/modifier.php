<?php
    session_start() ;
    
    $dsn="mysql:host=localhost;dbname=PFM;charset=utf8";
    $user="root" ;
    $pass="achraf" ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Evenement</title>
</head>
<body>
    <form method="POST">
        <label for="id_event">id : </label>
        <input id="d_event" type="text" name="id_event">

        <br><br>
        <label for="titre_event">Titre :</label>
        <input type="text" id="titre_event" name="titre"><br><br>

        <label for="date_event">Date : </label>
        <input type="date" id="date_event" name="date"><br><br>

        <label for="Description_event">Description :</label>
        <input type="text" id="Description_event" name="description"><br><br>

        <label  for="prix_event">Prix : </label>
        <input type="text" id="prix_event" name="prix"><br><br>

        <button type="submit" name="boutton_modifier" style="color:red;" value='1'>Modifier</button>
    </form>

    <?php   
        if (isset($_POST['boutton_modifier']) && $_POST['boutton_modifier'] == '1') {
            try {
                $mysqlConnexion = new PDO($dsn, $user, $pass);
                $pdostat = $mysqlConnexion->prepare("UPDATE evenements SET titre=:titre, date_eve=:dateEven, description=:description, prix=:prix WHERE id=:id");

                $pdostat->bindValue(':id',$_POST['id_event']);
                $pdostat->bindValue(':titre',$_POST['titre']);
                $pdostat->bindValue(':dateEven',$_POST['date']);
                $pdostat->bindValue(':description',$_POST['description']);
                $pdostat->bindValue(':prix',$_POST['prix']);
                $pdostat->execute();   
                header("Location: ../page_admin.php");
                exit();
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                exit();
            }
        }
    ?>
    
</body>
</html>