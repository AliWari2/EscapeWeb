<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .scenarios-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px;
        }

        .scenario {
            width: calc(30% - 20px);
            margin: 10px;
            border: 1px solid #ddd;
            padding: 15px;
            box-sizing: border-box;
            background-color: #fff;
            border-radius: 8px;
            transition: transform 0.3s;
        }

        .scenario:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .scenario img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .scenario h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .scenario p {
            margin: 5px 0;
            color: #777;
        }

        .scenario a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            transition: color 0.3s;
        }

        .scenario a:hover {
            color: #217dbb;
        }

        h3 {
            text-align: center;
            color: #555;
        }
    </style>
    <title>Tableau PHP</title>
</head>
<body>
    <div class="scenarios-container">
        <?php if (!empty($scenarios) && is_array($scenarios)) : ?>
            <?php foreach ($scenarios as $scenario) : ?>
                <div class='scenario'>
                    <h2><?php echo $scenario["intitule_sce"]; ?></h2>
                    <img src="<?php echo base_url('upload/') . $scenario['image_sce']?>" alt="Scenario Image">
                    <!-- Ajoutez ici la colonne correspondant au niveau de difficulté -->
                    <p>Niveau de difficulté: </p>
                    <a href="<?php echo base_url('index.php/scenario/afficher_etape/') . $scenario["code_sce"]; ?>/1">NIVEAU 1</a>
                    <a href="<?php echo base_url('index.php/scenario/afficher_etape/') . $scenario["code_sce"]; ?>/2">NIVEAU 2</a>
                    <a href="<?php echo base_url('index.php/scenario/afficher_etape/') . $scenario["code_sce"]; ?>/3">NIVEAU 3</a>
                    <p>Auteur: <?php echo $scenario["login_cpt"]; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <h3>Aucun scénario disponible pour le moment</h3>
        <?php endif; ?>
    </div>
</body>
</html>
