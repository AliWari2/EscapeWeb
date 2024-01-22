<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title><?php echo $titre; ?></title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .table {
            background-color: #ffffff;
        }

        th, td {
            text-align: center;
        }

        .thead-dark th {
            background-color: #343a40;
            color: #fff;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4 display-4 font-weight-bold"><?php echo $titre; ?></h2>
        
        <?php if (!empty($logins) && is_array($logins)) : ?>
            <div class="table-responsive">
                <table class='table table-bordered mt-4'>
                    <thead class='thead-dark'>
                        <tr>
                            <th class="font-weight-bold">Intitulé</th>
                            <th class="font-weight-bold">Description</th>
                            <th class="font-weight-bold">Auteur</th>
                            <th class="font-weight-bold">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logins as $pseudos) : ?>
                            <tr>
                                <td><?php echo $pseudos['intitule_act']; ?></td>
                                <td><?php echo $pseudos['desc_act']; ?></td>
                                <td><?php echo $pseudos['Auteur']; ?></td>
                                <td><?php echo $pseudos['date_act']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="alert alert-info mt-3" role="alert">
                Aucune actualité disponible pour le moment
            </div>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap JS and dependencies (jQuery, Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
