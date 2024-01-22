
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Page Title</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="my-4"><?php echo $le_message; /*echo $total->nb */?></h2>
    <?php if (!empty($scenario)) { ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Utilisateur</h5>
                <p class="card-text">Login: <?php echo $scenario->login_cpt; ?></p>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-info" role="alert">
            Aucun compte pour le moment
        </div>
    <?php } ?>
</div>

<!-- Add Bootstrap JS and Popper.js links here -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
