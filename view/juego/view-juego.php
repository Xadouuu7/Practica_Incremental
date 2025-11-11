<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido al juego</h1>
    <?php
        session_start(); 
        require "../../controller/middleware/check-auth.php";
        require_login(true);
        if (isset($_SESSION['user'])) {
            echo "<p>Usuario: " . htmlspecialchars($_SESSION['user']['usuario']) . "</p>";
            
        } else {
            echo "<p>No hay usuario autenticado.</p>";
        }
    ?>
</body>
</html>