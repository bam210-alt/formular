<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TABLE INSCRIPTION</title>
    <style>
        table{
            max-width: 60%;
            margin: 20px auto;
        }
        th,td{
            padding: 10px;
        }
        tr{
            border:px solid black;
            background: orange;


        }
        th {
            color: black;
            text-transform: uppercase;
        }
        tbody{
            color: white;
        }

    </style>
</head>
<body>
<?php
try { 
    $mysqlClient = new PDO('mysql:host=localhost; dbname=inscription_db;charset=utf8', 'root', ''); }
 catch (Exception $e) 
 { die('Erreur: '.$e->getMessage());
 }

$data ="SELECT * FROM utilisateur";
  $executeData= $mysqlClient->query($data);
  $utilisateur= $executeData->fetchAll();

  ?>
    
    <table>
    
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Mot de passe</th>
                <th>Date Creation</th>
            </tr>
        
            <tbody>
            <?php foreach ($utilisateur as $user):  ?>
                <tr>
                    <td><?= htmlspecialchars($user['nom']) ?></td>
                    <td><?= htmlspecialchars($user ['email']) ?></td>
                    <td><?= htmlspecialchars($user['password']) ?></td>
                    <td><?= htmlspecialchars($user ['dateCreation']) ?></td>
            <?php endforeach ; ?>
                </tr>

            </tbody>

    </table>
    
</body>
</html>