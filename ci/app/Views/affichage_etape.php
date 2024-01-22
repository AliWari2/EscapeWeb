<!-- app/Views/affichage_etape.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        p {
            margin: 10px 0;
            color: #555;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

    </style>
    <title><?php echo $titre; ?></title>
</head>
<body>
    <div class="container">
        <h2><?php echo $titre; ?></h2>

        <?php if (!empty($etape)) {  ?>
            <p>Le code de Scenario : <?php echo $etape->code_sce; ?></p>
            <p>Intitulé de l'étape : <?php echo $etape->desc_eta; ?></p>
            <?php if ($etape->lien_ind != NULL) { ?>
                <p>Le lien de l'indice : <img width='200' src="<?php echo base_url('upload/') . $etape->chemin_res; ?>"/></p>
                <a href="<?php echo $etape->lien_ind; ?>" target="_blank">Accéder à la ressource</a>
            <?php } ?>
            <p>Question associée : <?php echo $etape->intitule_eta; ?></p>

            <form action="<?php echo base_url('index.php/scenario/scenario_suivant/'.$lecode.'/'.$niveau); ?>" method="post">
                <label for="reponse">Entrez votre réponse :</label>
                <input type="text" id="reponse" name="reponse">
                <input type="hidden" name="thecode" value=<?=$lecode?>>
                <input type ="hidden" name ="niveau" value=<?=$niveau?>>
                <button type="submit">Soumettre la réponse</button>
            </form>

        <?php } else { ?>
            <p>Aucune étape trouvée pour le scénario spécifié</p>
        <?php } ?>
    </div>
</body>
</html>
