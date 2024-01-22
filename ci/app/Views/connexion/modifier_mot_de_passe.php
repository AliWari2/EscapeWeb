<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier le mot de passe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
        }

        label {
            font-weight: bold;
            color: #495057;
        }

        input {
            margin-bottom: 15px;
        }

        button {
            background-color: #28a745;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            margin-top: 20px;
            font-size: 16px;
            color: #007bff;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>Modifier le mot de passe</h2>

        <!-- Ajoutez le code pour le formulaire de modification du mot de passe -->
        <form method="post" action="<?= base_url('index.php/compte/modifier_mot_de_passe') ?>">

            <div class="form-group">
                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>

            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

            <button type="submit" class="btn btn-success">Modifier le mot de passe</button>

            <!-- Bouton Annuler -->
            <a href="<?= base_url('index.php/compte/afficher_profil') ?>" class="btn btn-secondary">Annuler</a>
        </form>

        <!-- Afficher les messages éventuels -->
        <?php if (isset($message)) { ?>
            <div class="message"><?= $message ?></div>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
