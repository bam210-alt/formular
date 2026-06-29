<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TABLE INSCRIPTION</title>
    <style>
        h2,p{
            text-align:center;
            font-size:25px
        }
        table{
            max-width: 60%;
            margin: 20px auto;
            border-collapse:collapse;
        }
        th,td{
            padding: 10px;
        }
        tr{
            border:1px solid black;
            background: white;


        }
        th {
            background: black;
            text-transform: uppercase;
            color:white;;
            border:1px solid white
        }
        tbody{
            color: black;
        }
        tbody td {
            border:1px solid black;
            border
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

$selectLastUser ="SELECT nom FROM utilisateur ORDER BY id DESC LIMIT 1 ";
$last_user = $mysqlClient->query($selectLastUser);
$display_last_user =$last_user->fetch();

echo "<h2 >Bonjour {$display_last_user['nom']}</h2>";
echo "<p>Vous etes maintenant inscrit</p>";






$data ="SELECT nom,email,dateCreation FROM utilisateur";
  $executeData= $mysqlClient->query($data);
  $utilisateur= $executeData->fetchAll();

  ?>
    
    <table>
    
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Date Creation</th>
            </tr>
        
            <tbody>
            <?php foreach ($utilisateur as $user):  ?>
                <tr>
                    <td><?= htmlspecialchars($user['nom']) ?></td>
                    <td><?= htmlspecialchars($user ['email']) ?></td>
                    <td><?= htmlspecialchars($user ['dateCreation']) ?></td>
            <?php endforeach ; ?>
                </tr>

            </tbody>

    </table>
    
</body>
</html>