<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <form action="traitement_insc.php" method="POST" enctype="multipart/form-data">
        <p>Nom :</p> <input type="text" name="nom" id="">
        <p>Date de naissance :</p> <input type="date" name="date_naiss" id="">
        <p>Genre :</p>
        <select name="genre" id="">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>
        <p>ville :</p> <input type="text" name="ville" id="">
        <p>E-mail :</p> <input type="email" name="email" id="">
        <p>Mot de passe</p> <input type="password" name="passwd" id="">
        <label for="media">Fichier (image)</label>
        <input type="file" id="media" name="media" accept="image/*" required>
        <input type="submit" value="S'inscrire">
    </form>
</body>

</html>