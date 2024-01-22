<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titre) ?></title>
    <!-- Ajoutez ici vos liens vers les fichiers CSS, Bootstrap, etc. -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><?= esc($titre) ?></h2>

    <?= session()->getFlashdata('error') ?>

    <?php echo form_open('/compte/connecter'); ?>
    <?= csrf_field() ?>

    <label for="pseudo">Pseudo :</label>
    <input type="input" name="pseudo" value="<?= set_value('pseudo') ?>" required>
    <?= validation_show_error('pseudo', '<p class="error-message">', '</p>') ?>

    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" required>
    <?= validation_show_error('mdp', '<p class="error-message">', '</p>') ?>

    <input type="submit" name="submit" value="Se connecter">
    </form>
</div>

<!-- Ajoutez ici vos scripts JavaScript, Bootstrap, etc. -->

</body>
</html>
