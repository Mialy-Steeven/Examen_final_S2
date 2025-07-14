<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix image object</title>
</head>

<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <p>Nom :</p> <input type="text" name="nom" id="">
        <p>categorie :</p> <input type="text" name="cat" id="">
        <p>Image :</p>
        <input type="file" id="media" name="media" accept="image/*" required class="file-input">
      <input type="submit" value="Creer">
    </form>
</body>

</html>