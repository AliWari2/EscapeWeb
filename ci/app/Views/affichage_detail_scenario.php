<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #343a40;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 20px;
        }

        .scenario-details {
            margin-top: 20px;
        }

        .scenario-details p {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><?= $titre ?></h2>

    <?php if ($scenario): ?>
        <div>
            <img src="<?= base_url('upload/' . $scenario->image_sce) ?>" alt="Image du scénario">
        </div>

        <div class="scenario-details">
            <p><strong>Titre:</strong> <?= $scenario->intitule_sce ?></p>
            <p><strong>Code:</strong> <?= $scenario->code_sce ?></p>
            <p><strong>Auteur:</strong> <?= $scenario->login_cpt ?></p>
            <p><strong>Etat du scenario:</strong> <?= $scenario->etat_sce ?></p>
            <p><strong>Question:</strong> <?= $scenario->intitule_eta ?></p>
            <p><strong>Reponse:</strong> <?= $scenario->reponse_eta ?></p>
            <!-- Ajoutez d'autres champs en fonction de votre modèle -->
        </div>
    <?php else: ?>
        <p>Scenario non trouvé.</p>
    <?php endif; ?>

    <!-- Ajoutez ici d'autres éléments HTML ou scripts au besoin -->

</div>

</body>
</html>
