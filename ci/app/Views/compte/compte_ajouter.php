<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouveau compte</title>
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

        .form-group {
            margin-bottom: 20px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Créer un nouveau compte</h2>

    <?= session()->getFlashdata('error') ?>

    <?php echo form_open('/compte/compte_ajouter'); ?>
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="role">Rôle :</label>
        <select name="role" class="form-control">
            <option value="A">Administrateur</option>
            <option value="O">Organisateur</option>
            <option value="V">Visiteur</option>
        </select>
    </div>

    <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="input" name="prenom" class="form-control">
    </div>

    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="input" name="nom" class="form-control">
    </div>

    <div class="form-group">
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" class="form-control">
    <div class="error-message"><?= validation_show_error('pseudo') ?></div>
</div>


    <div class="form-group">
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" class="form-control">
        <div class="error-message"><?= validation_show_error('mdp') ?></div>
    </div>

    <div class="form-group">
        <label for="mdp_confirmation">Confirmer le mot de passe :</label>
        <input type="password" name="mdp_confirmation" class="form-control">
        <div class="error-message"><?= validation_show_error('mdp_confirmation') ?></div>
    </div>

    <button type="submit" class="btn btn-success">Créer un nouveau compte</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
