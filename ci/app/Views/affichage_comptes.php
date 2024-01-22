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
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .btn-primary {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
        }

        h2, h3 {
            color: #007bff;
        }

        /* Styles pour différencier les comptes actifs et désactivés */
        .compte-actif {
            background-color: #c8e6c9; /* couleur pour les comptes actifs */
        }

        .compte-desactive {
            background-color: #ffcdd2; /* couleur pour les comptes désactivés */
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4"><?php echo $titre; ?></h2>
    <a href="<?php echo base_url('index.php/compte/creer/'); ?>" class="btn btn-primary">Ajouter un profil</a>

    <?php if (!empty($logins) && is_array($logins)) { ?>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($logins as $pseudos) { ?>
                <tr class="<?php echo ($pseudos['etat_cpt'] == 'A') ? 'compte-actif' : 'compte-desactive'; ?>">
                    <td><?php echo $pseudos['id_cpt']; ?></td>
                    <td><?php echo $pseudos["login_cpt"]; ?></td>
                    <td><?php echo $pseudos["prenom_cpt"]; ?></td>
                    <td><?php echo $pseudos["nom_cpt"]; ?></td>
                    <td><?php echo $pseudos["etat_cpt"]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <h3 class="mt-4">Aucun compte pour le moment</h3>
    <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
