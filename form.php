<!DOCTYPE html>

<html lang="fr">
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGN IN</title>
  <style>
  *{
    margin:0;
    padding:0;
    -webkit-tap-highlight-color: transparent;
outline:none;

    
  }
  body{
    background: radial-gradient(circle, #007bff 0%, #00008b 100%);
    color:rgba(255,255,255,0.9);
    text-align:center
    }
  .page {
  transition: opacity 0.5s ease;
  opacity: 1;
}

.fade-out {
  opacity: 0;
}
  h1{
    margin:25px auto;
    font-size:40px;
  }
  #formular{
   
    background: rgba(255,255,255,0.2);
  
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);
    border:2px solid white;
    border-radius:20px;
    max-width:70%;
    margin: 75px auto;
    height:70vh;
    max-height:80vh;
   box-shadow: 5px -5px 25px white;
  }
  #form{ 
    
    display: flex;
    flex-direction: column;
    gap:1rem;
    
     /* Espace entre les champs */
}
  input{
    width:75%;
    height:2.5rem;
    margin:8px auto;
    border:2px solid #00008b;
    border-radius:10px;
    transition:1s;
    font-size:20px


  }
  
  input::placeholder{
    padding-left: 15px;
    font-size:15px
}

input:focus 
input:active{
      background:#007bff  ;
    color:white;
    border:2px solid white;
    border-radius:10px;
    width:72%;
   box-shadow: 5px -5px 25px white;


  }
 input:hover::placeholder,
input:focus ::placeholder,
input:active::placeholder{
      color:white;
      font-weight:bold;
      font-size:20px

}

  #btn{
    width:60%;
    height:50px;
    margin:20px auto;
    border-radius:10px;
    border:2px solid white;
    background:#007bff;
    color:white;
    font-size:20px;
    transition:1s;
 

  }
  #btn:hover,
  #btn:focus,
  #btn:active {
    width:58%;
    height:45px;
    border-radius:10px;
    border:2px solid #007bff;
    background:#FFFFFF;
    color:#007bff;
    font-weight:bold


  }
  p{
    margin-top:10px;
   font-size:25px

  }
  #link_login{
    color:white;
    
  }
  .erreur{
    color:red
  }
  
  
  
  </style>
</head>
<body class="page">
  <div id="formular">
    <h1>Sign In</h1>
    <form id="form" method="post" action="sign.php">
      <input name="nom" type="name" id="sign_name" placeholder="Name">
     <?php
     if(isset($erreurs["empty-name"])){
     echo "<p class='erreur'>{$erreurs['empty-name']}</p>";
     }
     ?>

      <input name="email"  id="email" placeholder="Email">
     <?php
     if(isset($erreurs['empty-email'])){
      echo"<p class='erreur'>{$erreurs['empty-email']}</p>";
     } elseif(isset($erreurs['ivalid-email'])){
      echo"<p class='erreur'> {$erreurs['invalid-email']}</p>";
     }
  
     elseif(isset($erreurs['nom'])){
     echo" <p class='erreur'>{$erreurs['empty-name']}</p>";
     }
     ?>




      <input name="password" type="password" id="pwd" placeholder="Password">
     <?php
     if(isset($erreurs['empty-password'])){
     echo" <p class='erreur'> {$erreurs['empty-password']}</p>";
     } 
     if(isset($erreurs['short-password'])){
      echo"<p class='erreur> {$erreurs['short-password']}</p>";
     }
     ?>

    

  
      <button type="submit" id="btn">Sign In</button>
    </form>
  </div>
    <p>You already have account?<a id ="link_login" href="login.html">Login</a></p>
     
    <script>

    const loginLink = document.getElementById("link_login");

loginLink.addEventListener("click", (e) => {
  e.preventDefault();
  document.body.classList.add("fade-out");

  setTimeout(() => {
    window.location.href = "login.html";
  },1000);

});

    
    </script>  
</body>
</html>