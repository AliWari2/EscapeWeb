<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Page Title</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
        body {
            background-color: #333;
        }

        .site-wrap {
            margin: 0 auto;
            max-width: 1200px;
            padding: 20px;
        }

        .site-navbar {
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }

        .site-menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .site-menu li {
            display: inline-block;
            margin-right: 20px;
        }

        .nav-link {
            color: black !important;
            display: inline !important;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }

        .nav-link:hover {
            color: #007bff !important;
        }
    </style>
</head>

<body class="text-white">

    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <header class="site-navbar py-4" role="banner">
            <div class="ml-auto">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li class="active"><a href="<?php echo base_url('index.php/compte/connecter') ?>" class="nav-link">DECONNEXION</a></li>
                        <li class="active"><a href="<?php echo base_url('index.php/scenario/visualiser_scenario') ?>" class="nav-link">Liste des scenarios</a></li>
                        <li class="active"><a href="<?php echo base_url('index.php/compte/afficher_profil') ?>" class="nav-link">Profil</a></li>
                    </ul>
                </nav>
            </div>
        </header>

    </div>

    <!-- Add Bootstrap JS and Popper.js links here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
