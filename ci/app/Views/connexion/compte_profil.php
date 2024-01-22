<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Votre Titre de Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            margin-top: 50px;
        }

        .card {
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .card-title {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .card-text strong {
            width: 100px;
            display: inline-block;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="my-4"><?php echo $le_message; ?></h2>

    <?php if (!empty($utilisateur)) { ?>
        <div class="card">
            <div class="card-title">
                <h5 class="text-center">Utilisateur</h5>
            </div>
            <div class="card-body">
                <p class="card-text"><strong>Login:</strong> <?php echo $utilisateur->login_cpt; ?></p>
                <p class="card-text"><strong>Role:</strong> <?php echo ($utilisateur->role_cpt === 'O') ? 'Organisateur' : 'Administrateur'; ?></p>
                <p class="card-text"><strong>Nom:</strong> <?php echo $utilisateur->nom_cpt; ?></p>
                <p class="card-text"><strong>Prenom:</strong> <?php echo $utilisateur->prenom_cpt; ?></p>
                <!-- Bouton pour modifier le mot de passe -->
                <a href="<?php echo base_url('index.php/compte/modifier_mot_de_passe/' . $utilisateur->id_cpt); ?>" class="btn btn-primary btn-block">Modifier Mot de Passe</a>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-info" role="alert">
            Aucun compte pour le moment
        </div>
    <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
