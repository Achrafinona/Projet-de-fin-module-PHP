<?php
    session_start() ; 
    $dsn="mysql:host=localhost;dbname=PFM;charset=utf8";
    $user="root" ;
    $pass="achraf" ;

    $id_user = $_SESSION['id'] ;
    $table = [] ;
    $tableau_date = [] ;
    $tableau_prix = [] ;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../style.css">
     <style>
        table {
            width: 86%;
            border-collapse: collapse;
            table-layout: fixed;      
        }
        td, th {
            border: 1px solid black;
            padding: 8px;
            word-wrap: break-word;     /
            overflow: hidden;
        }
        td:nth-child(1) { width: 5%; }  
        td:nth-child(2) { width: 20%; }  
        td:nth-child(3) { width: 10%; }  
        td:nth-child(4) { width: 45%; }
        td:nth-child(5) { width: 8%; }   
        td:nth-child(6) { width: 12%; }  
    </style>
    <title>Inscription aux Evenements</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Inscription<span>->Evenements</span></div>
            <ul class="nav-links">
                <li><a href="../even/evenement.php">Evenement</a></li>
                <li><a href="panier.php">Panier</a></li>
            </ul>
            <form action="../logout.php">
                <button type="submit" style="color: red;">Deconnexion </button>
            </form>
        </nav>
    </header>
    <div>
        <?php
            if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])){
                echo "<h2>Votre panier : </h2>" ;
                try {
                    $mysqlConnexion=new PDO($dsn,$user,$pass) ;
                    $table = array_unique($_SESSION['panier']) ;
                    echo "<table style=width:86%><tr><td>id</td><td>Titre</td><td>Date</td><td>Description</td><td>Prix</td></tr>" ;

                    $totale = 0;
                    $tableau_prix = [] ;
                    $tableau_date = [] ;
                    for ($i=0;$i<count($table);$i++) {
                        $pdostat = $mysqlConnexion->prepare("SELECT * FROM evenements WHERE id= :id_number  ;") ;
                        $pdostat->bindValue(':id_number',$table[$i]) ; 
                        $pdostat->execute() ;
                        $ligne =  $pdostat->fetch(PDO::FETCH_ASSOC) ;

                        $totale += (float)$ligne['prix'] ;
                        $tableau_prix[] = $ligne['prix'] ;
                        $tableau_date[] = $ligne['date_eve'] ;

                        echo "<tr>" ;
                        echo "<td>". $ligne['id']. "</td>" ;
                        echo "<td>". $ligne['titre']. "</td>" ;
                        echo "<td>". $ligne['date_eve']. "</td>" ;
                        echo "<td>". $ligne['description']. "</td>" ;
                        echo "<td>". $ligne['prix']. "  DH</td>" ;
                        echo "</tr>" ;
                        }
                    echo "</table>" ;
                    echo "<h3>Prix totale : ". $totale ."  DH</h3>" ;
                }
                catch (PDOException $e){
                    echo "Erreur :  ". $e->getMessage() ;
                    exit() ;
                }
                echo "<form method='POST'>" ;
                echo "<button type='submit' name='accepter_boutt' value='1'>Accepter</button>" ;
                echo "</form>" ;

                //Si le boutton accepter est appuie : 
                if (isset($_POST['accepter_boutt']) && $_POST['accepter_boutt']== '1'){
                    try {
                        $mysqlConnexion = new PDO($dsn,$user,$pass) ;
                        for ($i=0;$i< count($table) ;$i++ ){
                            $pdostat = $mysqlConnexion->prepare("INSERT INTO inscription(id_user,id_event,date_ins,prix) values ($id_user,:event_i,:date_i,:prix_i) ;") ;
                            $pdostat->bindValue(':event_i',$table[$i]) ;
                            $pdostat->bindValue(':date_i',$tableau_date[$i]) ;
                            $pdostat->bindValue(':prix_i',$tableau_prix[$i]) ;
                            $pdostat->execute() ;
                        }
                        $_SESSION['panier'] = null ;
                        header("Location:../page1.php")  ;
                    }
                    catch(PDOException $e){
                        echo "Erreur : ". $e->getMessage() ;
                        exit() ;
                    }
                }
    
            }
            else
                echo "<h2>Votre panier est vide</h2>" ;

        ?>

    </div>
</body>
</html>