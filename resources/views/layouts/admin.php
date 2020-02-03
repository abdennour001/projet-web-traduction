<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/projet/admin">

    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!-- Latest compiled and minified bootstrap CSS -->
    <link rel="stylesheet" href="resources/css/bootstrap.css">


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>


    <!-- Adding font awesome icons -->
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">

    <!-- Adding custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="resources/css/style.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.0/semantic.css">
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.0/semantic.js">
    </script>

    <!-- Import open sans font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800&display=swap" rel="stylesheet">

    <title>Panneau administrateur</title>

    <style>
        body {
            background-color: #ffffff;
            background-image: linear-gradient(315deg, #ffffff 0%, rgba(248, 247, 244, 0.94) 74%);
        }
    </style>

</head>
<body>
<?php if (Auth::hasAdmin()) : ?>
    <div id="sidebar" class="ui inverted left vertical sidebar menu pt-md-2" style="font-size: 1.1rem; overflow-x: hidden">
        <h2 class="ui logo icon image text-center" style="color: white">
            <i class="map icon"></i>
            <b>Panneau administrateur</b>
        </h2>
        <div class="row my-3">
            <div class="col-6 text-center pb-2">
                <div class='font-weight-bold text-center text-white'>
                    <i class="home icon"></i>
                    Admin
                </div>
            </div>
            <div class="col-6">
                <div class='font-weight-bold text-center text-white-50'></div>
                <div class='text-xl-center text-white-50'><strong><</strong><?php echo Auth::admin()->login; ?><strong>></strong></div>
            </div>
        </div>
        <div class="item">
            <div class="header">
                Gestion des traducteurs
            </div>
            <a href="<?php echo url('/admin/gestion-traducteurs')?>" class="item <?php echo current_url() == "/admin/gestion-traducteurs" ? "bg-primary" : ""?>">
                <i class="address book icon"></i>
                Liste des traducteurs
            </a>
            <a href="<?php echo url('/admin/gestion-devis')?>" class="item <?php echo current_url() == "/admin/gestion-devis" ? "bg-primary" : ""?>">
                <i class="tasks icon"></i>
                Liste des devis
            </a>
            <a href="<?php echo url('/admin/gestion-traductions')?>" class="item <?php echo current_url() == "/admin/gestion-traductions" ? "bg-primary" : ""?>">
                <i class="clipboard icon"></i>
                Liste des traductions
            </a>
        </div>
        <div class="item">
            <div class="header">
                Gestion des clients
            </div>
            <a href="<?php echo url('/admin/gestion-clients')?>" class="item <?php echo current_url() == "/admin/gestion-clients" ? "bg-primary" : ""?>">
                <i class="address book outline icon"></i>
                List des clients
            </a>
        </div>
        <div class="item">
            <div class="header">
                Gestion des documents
            </div>
            <a href="<?php echo url('/admin/gestion-documents')?>" class="item <?php echo current_url() == "/admin/gestion-documents" ? "bg-primary" : ""?>">
                <i class="archive icon"></i>
                List des documents
            </a>
        </div>
        <div class="item">
            <div class="header">
                Statistiques
            </div>
            <a href="<?php echo url('/admin/statistiques')?>" class="item <?php echo current_url() == "/admin/statistiques" ? "bg-primary" : ""?>">
                <i class="chart line icon"></i>
                Afficher les Statistiques
            </a>
        </div>
        <div class="item">
            <div class="header">
                <a id="logout" class="item" href="<?php echo url('/admin/logout')?>">
                    Déconnexion
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid pusher">
        <div class="d-flex mt-2">
            <a id="push" href="javascript:void(0)" class="btn toggle-button p-0 m-0 ml-2" style="font-size: 1.6rem;">
                <i class="bars icon"></i> Menu
            </a>
        </div>
        <div class="pt-lg-5">
            <?php echo $this->_data['main-content-admin'] ?>
        </div>
    </div>
<?php else : ?>
    <?php echo $this->_data['main-content-admin'] ?>
<?php endif; ?>

</body>

<script>
    $(document).ready(function () {
        $(".toggle-button").on("click", function () {
            $('.ui.sidebar').sidebar('toggle');
        });
    });
</script>
</html>
