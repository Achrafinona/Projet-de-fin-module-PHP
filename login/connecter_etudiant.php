<?php

    session_start() ;

    $login_user = $_POST["login"] ;
    $password_user = $_POST["password"] ;

    if (empty($login_user) || empty($password_user))
        echo "Les champs login ou mot de passe est vide !<br>  " ;
    else {
    try{
        $dsn="mysql:host=localhost;dbname=PFM;charset=utf8" ;
        $user='root' ;
        $pass='achraf' ;
        $mysqlconnexion = new PDO($dsn,$user,$pass) ;
        $pdostat=$mysqlconnexion->prepare("SELECT id,login_passwd,statut FROM users where login_name = :loginName") ;
        $pdostat->bindValue(':loginName',$login_user)  ;
        $pdostat->execute() ; 

        $password_db = $pdostat->fetch(PDO::FETCH_ASSOC) ;
        if(!isset($password_db['login_passwd'])) {
            echo "Aucun utilisateur trouver <br>Pour vous inscrire veuiller cliquer ";
            echo "<a href=../inscription/inscription.html>ici</a><br>" ;
        }
        else {
            if ($password_db['login_passwd'] != $password_user) {
                echo "Mot de passe incorecte <br>rediriger ever la page : ";
                echo "<a href=login.html>page login</a>"  ;
            }
            else {
                $_SESSION['login'] = $login_user ;
                $_SESSION['id'] = $password_db['id'] ;
                $_SESSION['statut'] = $password_db['statut'] ;
                header("Location: ../AccueilLogin/page1.php") ;
            }
        }

    }   
    catch(PDOExeption $e){
        echo "Erreur  :  ". $e->getMessage() ;
        exit() ;
        }     
    }


        
?>
