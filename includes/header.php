<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Switch - Accueil</title>
    <style>
        /* Styles de base pour la structure */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; line-height: 1.6; }
        
        /* Header : Logo à gauche, Nav à droite */
        header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 20px 5%; 
            background: #fff; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .logo { font-size: 24px; font-weight: bold; text-decoration: none; color: #42b883; }
        
        nav a { margin-left: 20px; text-decoration: none; color: #333; font-weight: 500; }
        nav a:hover { color: #42b883; }

        /* Style des sections et boutons */
        .container { width: 80%; margin: 40px auto; text-align: center; }
        .section-action { margin: 50px 0; padding: 30px; border: 1px solid #eee; border-radius: 10px; }
        
        .btn { 
            display: inline-block; 
            padding: 12px 25px; 
            background-color: #42b883; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
            margin-top: 15px; 
        }
        .btn:hover { background-color: #33a06f; }
    </style>
</head>
<body>

<header>
    <a href="index.php" class="logo">SWITCH</a>
    <nav>
        <a href="compte.php">Compte</a>
        <a href="vendre.php">Vendre</a>
        <a href="acheter.php">Acheter</a>
        <a href="avis.php">Avis</a>
    </nav>
</header>

<div class="container">