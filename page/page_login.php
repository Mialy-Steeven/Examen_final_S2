<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="traitement_login.php" method="get">
       <p>Nom :</p> <input type="text" name="nom" id="">
       <p>E-mail :</p> <input type="email" name="email" id="">
       <p>Mot de passe</p>    <input type="password" name="passwd" id="">
       <input type="submit" value="Se connecter">
    </form>
    <a href="page_inscription.php">s'incrire</a>
</body>
</html>