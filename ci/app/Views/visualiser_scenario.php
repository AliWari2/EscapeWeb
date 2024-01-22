<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Liste des Scénarios</title>
    <!-- Ajoutez le lien vers le fichier Bootstrap CSS ici -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Ajoutez le lien vers les icônes FontAwesome ici -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .btn-add-scenario {
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .table th {
            background-color: #343a40;
            color: #fff;
        }

        .table td img {
            max-width: 50px; /* Ajustez la taille des images ici */
            height: auto;
        }

        .btn-delete-scenario {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-delete-scenario:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Liste des Scénarios</h2>

    <!-- Bouton pour ajouter un scénario -->
    <a href="<?php echo base_url('index.php/scenario/scenario_ajouter'); ?>" class="btn btn-primary btn-add-scenario">Ajouter un scénario</a>

    <?php if (!empty($logins) && is_array($logins)) { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Login</th>
                        <th>Intitule</th>
                        <th>Image</th>
                        <th>Code</th>
                        <th>Etat</th>
                        <th> Nombre d'etapes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logins as $login) { ?>
                        <tr>
                        <td><?php echo $login['id_sce']; ?></td>
                            <td><?php echo $login['login_cpt']; ?></td>
                            <td><?php echo $login["intitule_sce"]; ?></td>
                            <td><img class="img-thumbnail" src="<?php echo base_url('upload/') . $login['image_sce'] ?>" /></td>
                            <td><?php echo $login["code_sce"]; ?></td>
                            <td><?php echo $login["etat_sce"]; ?></td>
                            <td><?php echo $login["nombre_etapes"]; ?></td>
                            <td>
                                <?php if($user == $login['login_cpt']) {?>
                                    <!-- Bouton de suppression stylisé -->
                                    <a href="<?php echo base_url('index.php/scenario/supprimer_scenario/'. $login['id_sce'] )?>" class="btn btn-danger btn-sm btn-delete-scenario" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce scénario ?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </a>
                                <?php } ?>
                                <!-- Ajout de l'icône "œil" pour afficher les détails -->
                                <a href="<?php echo base_url('index.php/scenario/afficher_detail_scenario/') . $login['code_sce'] ?>" class="btn btn-info btn-sm" title="Afficher les détails">
                                    <i class="fas fa-eye"></i> Afficher
                                </a>
                                <!-- Ajout de l'icône "éditer" pour modifier -->
                                <a href="<?php echo base_url('index.php/scenario/editer_scenario/') . $login['code_sce'] ?>" class="btn btn-primary btn-sm" title="Éditer le scénario">
                                    <i class="fas fa-edit"></i> Éditer
                                </a>

                                <!-- Ajout de l'icône "copier" pour créer une copie -->
                                <a href="<?php echo base_url('index.php/scenario/copier_scenario/') . $login['code_sce'] ?>" class="btn btn-success btn-sm" title="Copier le scénario">
                                    <i class="fas fa-copy"></i> Copier
                                </a>

                                <!-- Ajout de l'icône "activer" pour activer le scénario -->
                                <?php if($login['etat_sce'] == 'inactive') { ?>
                                    <a href="<?php echo base_url('index.php/scenario/activer_scenario/') . $login['code_sce'] ?>" class="btn btn-success btn-sm" title="Activer le scénario">
                                        <i class="fas fa-check"></i> Activer
                                    </a>
                                <?php } else { ?>
                                    <!-- Ajout de l'icône "désactiver" pour désactiver le scénario -->
                                    <a href="<?php echo base_url('index.php/scenario/desactiver_scenario/') . $login['code_sce'] ?>" class="btn btn-warning btn-sm" title="Désactiver le scénario">
                                        <i class="fas fa-times"></i> Désactiver
                                    </a>
                                <?php } ?>

                                <!-- Ajout de l'icône "remise à zéro" pour remettre à zéro -->
                                <a href="<?php echo base_url('index.php/scenario/reset_scenario/') . $login['code_sce'] ?>" class="btn btn-secondary btn-sm" title="Remise à zéro du scénario">
                                    <i class="fas fa-undo"></i> Remise à zéro
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-info" role="alert">
            <h3 class="text-center">Aucun scénario pour le moment</h3>
        </div>
    <?php } ?>
</div>

<!-- Ajoutez le lien vers les scripts Bootstrap et Popper.js ici -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
