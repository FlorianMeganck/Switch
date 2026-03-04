<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch - Le troc étudiant</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        :root { --primary: #42b883; --dark: #2c3e50; --bg: #f9fafb; --text-muted: #6b7280; }
        body { font-family: 'Inter', sans-serif; margin: 0; background: var(--bg); color: var(--dark); line-height: 1.5; }
        
        header { 
            background: white; padding: 0 5%; height: 70px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 100;
        }
        
        .logo { font-size: 1.4rem; font-weight: 800; color: var(--primary); letter-spacing: -1px; text-decoration: none; }
        nav a { text-decoration: none; color: var(--dark); margin-left: 25px; font-weight: 600; font-size: 0.9rem; transition: 0.2s; }
        nav a:hover { color: var(--primary); }
        
        .btn-add { background: var(--primary); color: white !important; padding: 10px 20px; border-radius: 8px; }
        .container { padding: 40px 5%; max-width: 1200px; margin: 0 auto; }
        
        .card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: 0.3s; }
        .card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="logo">SWITCH.</a>
        <nav>
            <a href="index.php">Explorer</a>
            <a href="#">Mes échanges</a>
            <a href="#" class="btn-add">Déposer une annonce</a>
        </nav>
    </header>
    <main class="container">