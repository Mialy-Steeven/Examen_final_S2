<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-icons.css" />
   <link rel="stylesheet" href="../assets/bootstrap/styles/style.css" />
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Connexion - Système de Gestion</title>
</head>

<body>
    <div class="main-container">
        <!-- Header -->
        <div class="page-header fade-in">
            <h1 class="page-title">
                <i class="bi bi-shield-lock"></i>
                Connexion
            </h1>
            <p class="page-subtitle">Accédez à votre espace personnel</p>
        </div>

        <!-- Formulaire de connexion -->
        <div class="form-container fade-in">
            <?php if (isset($_GET["err"]) && $_GET["err"] == 1) { ?>
                <div class="error-message">
                    <i class="bi bi-exclamation-triangle"></i>
                    Erreur de connexion. Veuillez vérifier vos identifiants.
                </div>
            <?php } ?>

            <form action="traitement_login.php" method="get">
                <div class="form-group">
                    <label class="form-label" for="nom">
                        <i class="bi bi-person"></i>
                        Nom d'utilisateur
                    </label>
                    <input type="text" name="nom" id="nom" class="form-control" required 
                           placeholder="Entrez votre nom">
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
                           placeholder="Entrez votre mot de passe">
                </div>

                <button type="submit" class="btn-primary btn-full-width">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Se connecter
                </button>
            </form>

            <div class="text-center mt-3">
                <p style="color: var(--text-light); margin-bottom: 10px;">Pas encore de compte ?</p>
                <a href="page_inscription.php" class="btn-secondary">
                    <i class="bi bi-person-plus"></i>
                    Créer un compte
                </a>
            </div>
        </div>
    </div>
</body>

</html>