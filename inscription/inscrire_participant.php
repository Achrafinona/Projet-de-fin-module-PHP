<?php

$nom = $_POST['user_name'];
$email = $_POST['user_email'] ;
$tel = $_POST['user_tel'] ;
$annees_naissance = $_POST['Year'] ; 
$motivation = $_POST['Motivation'] ;
$source = $_POST['source_connaissance'] ; 

$login = $_POST['user_login'];
$password = $_POST['user_pass'] ;

$is_good = true;


if (empty($nom)) {
    echo "Entrez un nom complet valide.<br>";
    $is_good = false;
}

if (empty($email)) {
    echo "Entrez un email .<br>";
    $is_good = false;
}
if (empty($tel)) {
    echo "Entrez votre num de telephone .<br>";
    $is_good = false;
}
if (empty($login)) {
    echo "Entrez un login .<br>";
    $is_good = false;
} 
if (empty($password)) {
    echo "Entrez un mot de passe .<br>";
    $is_good = false;
}



if ($is_good) {
    echo "<h3>Résumé des informations :</h3>";
    
    echo "Votre nom complet : " . $nom . "<br>";
    echo "Email : " . $email . "<br>"; 
    echo "Téléphone : " . $tel . "<br>";
    echo "Année de naissance : " .$annees_naissance . "<br>" ;
    if (!empty($motivation)) 
        echo "Motivation : " .$motivation . "<br>";
    echo "Comment vous nous connaissez : " . $source . "<br>";
    
    
    $dsn="mysql:host=localhost;dbname=PFM;charset=utf8" ;
    $user="root" ;
    $pass="achraf" ;
    $mysqlConnexion=new PDO($dsn,$user,$pass) ;
     
    try{
       $pdostat=$mysqlConnexion->prepare("INSERT INTO users(login_name,login_passwd,statut,nom,email,tel) VALUES(:login1,:pass1,'user',:nom_i,:email_i,:tel_i)") ;
        $pdostat->bindValue(":login1",$login) ;
        $pdostat->bindValue(":pass1",$password) ; 
        $pdostat->bindValue(':nom_i',$nom) ;
        $pdostat->bindValue(':email_i',$email) ;
        $pdostat->bindValue(':tel_i',$tel) ;

        $pdostat->execute() ;
    }
    catch(PDOException $e){
        echo "Erreur : ".$e->getMessage() ;
        exit() ;
    }
    
    echo "<br><strong>Fichier PDF validé et inscription traitée avec succès !</strong>";
}

?>