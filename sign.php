<?php
//VALIDATION
$nom = $_POST ['name'];
$email = $_POST ['email'];
$password = $_POST ['password'];


$erreurs =[];

//VALDATION NOM
if(empty($nom) ){
  $erreurs[] ="NOm obligatoire ";
}

//VALDATION EMAIL
if(isset($email)){
$email =filter_var($email,FILTER_SANITIZE_EMAIL);
   if(empty($email)){
    $erreurs[]= "Email vide";
}
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $erreurs[]= "email invalide";
    }
    else{
    "votre email est ".htmlspecialchars($email);
       
    }
}
else{
    $erreurs[]= "veuillez entrer votre email";
}




//VALDATION PASSWORD

if(isset($password)){
   if(empty($password)){
 $erreurs[]= "Mot dePasse vide";
} else{
    $password= htmlspecialchars($password);
    $hashed_password= password_hash($password,PASSWORD_DEFAULT);
    echo "votre mot de passe  est". $hashed_password ;
       
    }
}
if(!empty($erreurs)){
    foreach($erreurs as $erreur){
        echo $erreur."<br>";
    }
    exit();
}


$pdo =new PDO(
    "mysql:host=localhost;dbname=sign_db;
    charset=utf8","root",""
);
$info = "INSERT INTO users (nom,email,password) VALUES(:nom,:email,:password )";
$infosUsers = $pdo->prepare($info);
$infosUsers->execute([
   "nom"=> $nom,
   "email"=> $email,
   "password" =>$hashed_password
]);


?>