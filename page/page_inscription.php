<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-icons.css" />
   <link rel="stylesheet" href="../assets/bootstrap/styles/style.css" />
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Inscription - Système de Gestion</title>
</head>

<body>
    <div class="main-container">
        <!-- Header -->
        <div class="page-header fade-in">
            <h1 class="page-title">
                <i class="bi bi-person-plus"></i>
                Inscription
            </h1>
            <p class="page-subtitle">Créez votre compte pour accéder au système</p>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="form-container fade-in">
            <form action="traitement_insc.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label" for="nom">
                        <i class="bi bi-person"></i>
                        Nom complet
                    </label>
                    <input type="text" name="nom" id="nom" class="form-control" required 
                           placeholder="Entrez votre nom complet">
                </div>

                <div class="form-group">
                    <label class="form-label" for="date_naiss">
                        <i class="bi bi-calendar"></i>
                        Date de naissance
                    </label>
                    <input type="date" name="date_naiss" id="date_naiss" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="genre">
                        <i class="bi bi-gender-ambiguous"></i>
                        Genre
                    </label>
                    <select name="genre" id="genre" class="form-select" required>
                        <option value="">Sélectionnez votre genre</option>
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="ville">
                        <i class="bi bi-geo-alt"></i>
                        Ville
                    </label>
                    <input type="text" name="ville" id="ville" class="form-control" required 
                           placeholder="Entrez votre ville">
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="bi bi-envelope"></i>
                        Adresse e-mail
                    </label>
                    <input type="email" name="email" id="email" class="form-control" required 
                           placeholder="exemple@email.com">
                </div>

                <div class="form-group">
                    <label class="form-label" for="passwd">
                        <i class="bi bi-lock"></i>
                        Mot de passe
                    </label>
                    <input type="password" name="passwd" id="passwd" class="form-control" required 
                           placeholder="Choisissez un mot de passe sécurisé">
                </div>

                <div class="form-group">
                    <label class="form-label" for="media">
                        <i class="bi bi-image"></i>
                        Photo de profil
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" id="media" name="media" accept="image/*" required class="file-input">
                        <label for="media" class="file-input-label">
                            <i class="bi bi-cloud-upload d-block"></i>
                            Cliquez pour sélectionner une image
                            <br>
                            <small>Formats acceptés: JPG, PNG, GIF</small>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-primary btn-full-width">
                    <i class="bi bi-check-circle"></i>
                    Créer mon compte
                </button>
            </form>

            <div class="text-center mt-3">
                <p style="color: var(--text-light); margin-bottom: 10px;">Déjà un compte ?</p>
                <a href="page_login.php" class="btn-secondary">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Se connecter
                </a>
            </div>
        </div>
    </div>

    <script>
         //Amélioration de l'input file
        document.getElementById('media').addEventListener('change', function(e) {
            const label = document.querySelector('.file-input-label');
            const fileName = e.target.files[0]?.name;
            
            if (fileName) {
                label.innerHTML = `
                    <i class="bi bi-check-circle d-block" style="color: var(--success-color);"></i>
                    Fichier sélectionné: ${fileName}
                `;
            }
        });
    </script>
</body>

</html>