<?php

//VALLIDATION, SECURISISATION ET PROTECTION ,EMPECHER EMAIL DOUBLE  ,AFFICHER ERREUR
try { 
    $mysqlClient = new PDO('mysql:host=localhost; dbname=inscription_db;charset=utf8', 'root', ''); }
 catch (Exception $e) 
 { die('Erreur: '.$e->getMessage());
 }
$erreurs =[];
if($_SERVER['REQUEST_METHOD']==="POST"){
    //tableau association ou tableau numerotes pour $erreurs

    if (empty($_POST['nom'])){
        $erreurs['nom']="REQUIRED NAME";

    }

    if (empty($_POST['email'])){
        $erreurs['email']="REQUIRED EMAIL";
    }else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $erreurs['email-invalid']='INVALID EMAIL  ';
    }

    $sql = 'SELECT id FROM utilisateur WHERE email=:email';
    $verification= $mysqlClient->prepare($sql);
    if(!empty($_POST['email'])){
        $verification->execute(['email'=>$_POST['email']]);
    }

    if ($verification->fetch()){
        $erreurs['email-exist']="cet email existe deja ";
    } 

   if (empty($_POST['password'])){
   $erreurs['password']="REQUIRED PASSWORD ";
   }else if(strlen($_POST["password"])<6){
        $erreurs['password-invalid']='mot de passe trop court ';

    }

// ON PEUT AFFICHER LES ERREURS SUR UNE AUTRE PAGE SI ON UTILISE PAS CE CODE SUR LE FORMULAIRE HTML
    if(empty($erreurs)){
   $nom =$_POST['nom'];
    $email =$_POST['email'];
   $password =password_hash($_POST['password'],PASSWORD_DEFAULT) ;

   $sqlquery ="INSERT INTO utilisateur (nom,email,password,dateCreation) VALUES (:nom,:email,:password,:dateCreation)";
   $insertion =$mysqlClient->prepare($sqlquery);
   try { 
   $insertion ->execute(
    [
        'nom'=> $nom,
        'email'=> $email,
        'password'=> $password,
        'dateCreation'=>date("Y-m-d H:i:s")
    ]
   );

   header("Location:tableinscription.php");
   exit();

  }
 catch (PDOException $e) {
 
echo 'PAGE 404 NOT FOUND ';
 
 }

    }else { 
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <title>SIGN I</title>
 </head>
 <body class="page">
    <div id="formular">
    <h1>SIGN IN</h1>
    <form action="sign.php" method="post">
        <div class="erreur"><?=  $erreurs['nom'] ??' '?></div>
        <input type="text" name="nom" id="sign_name" placeholder ="Name" value="<?= htmlspecialchars($_POST['nom'] ?? '' )?>"> 

        <div  class="erreur"><?><?=  $erreurs['email'] ??' ' ?></div>
        <input type="text" name="email" id="email" placeholder ="EMAIL" value="<?= htmlspecialchars($_POST['email'] ?? '' )?>">
         <div  class="erreur"><?><?=  $erreurs['email-exist'] ??'' ?></div>


        <input type="password" name="password" id="pwd"  placeholder ="Mot de Passe " > 
        <div  class="erreur"><?><?=  $erreurs['password'] ??' ' ?></div>
         <div  class="erreur"><?><?=  $erreurs['password-invalid'] ??' ' ?></div>
 

        <input type="submit" value="submit" id="btn">
    <p>You already have account?<a id ="link_login" href="login.html">Login</a></p>


    </form>
    </div>
  

 </body>
 </html>

  <?php 
  }
}

   ?>
  