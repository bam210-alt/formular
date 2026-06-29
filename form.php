
<!DOCTYPE html>

<html lang="fr">
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGN IN</title>
  <link rel="stylesheet" href="./sign.css">
</head>
<body class="page">
  <div id="formular">
    <h1>SIGN IN</h1>

    
    <form id="form" method="post" action="sign.php">
      <input name="nom" type="name" id="sign_name" placeholder="Name">
      <input name="email"  id="email" placeholder="Email">
      <input name="password" type="password" id="pwd" placeholder="Password">


    

  
      <button type="submit" id="btn">Sign In</button>
    </form>
  </div>
    <p class="link" >You already have account?<a id ="link_login" href="login.html">Login</a></p>
     
    <script>

    const loginLink = document.getElementById("link_login");

loginLink.addEventListener("click", (e) => {
  e.preventDefault();
  document.body.classList.add("fade-out");

  setTimeout(() => {
    window.location.href = "login.php";
  },1000);

});

    
    </script>  
</body>
</html>