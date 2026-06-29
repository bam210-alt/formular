<?php
//VALIDATION
if($_SERVER["REQUEST_METHOD"]==="POST"){
$nom = $_POST ['nom'];
$email = $_POST ['email'];
$password = $_POST ['password'];
}
$pdo =new PDO(
    "mysql:host=localhost;dbname=sign_db;
    charset=utf8","root",""
);

$erreurs =[];

//VALDATION NOM
if(empty($nom) ){
  $erreurs['empty-name'] ="NOm obligatoire ";
}

//VALDATION EMAIL
if(isset($email)){
$email =filter_var($email,FILTER_SANITIZE_EMAIL);
   if(empty($email)){
    $erreurs['empty-email']= "Email vide";
}
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $erreurs['invalid-email']= "email invalide";
    }
    else{
    "votre email est ".htmlspecialchars($email);
       
    }
}
else{
    $erreurs['email-not-enterred']= "veuillez entrer votre email";
}
$existEmail= "SELECT * FROM users WHERE EMAIL =:email";
$verifEmail =$pdo->prepare($existEmail);
 $verifEmail->execute(
    [
        "email"=>$email
    ]
);

$user =$verifEmail->fetch();
if ($user){
    $erreurs['used-email']= "Email already Used ";
}

//VALDATION PASSWORD

if(isset($password)){
   if(empty($password)){
 $erreurs['empty-password']= "Mot dePasse vide";
}
elseif (strlen($password)<5 ){
    $erreurs['short-password']= 'mot de passe trop court';
}
 else{
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



$info = "INSERT INTO users (nom,email,password) VALUES(:nom,:email,:password )";
$infosUsers = $pdo->prepare($info);
$infosUsers->execute([
   "nom"=> $nom,
   "email"=> $email,
   "password" =>$hashed_password
]);

?>