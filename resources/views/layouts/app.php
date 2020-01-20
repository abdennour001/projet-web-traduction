<!DOCTYPE html>
<html lang="en">
<head>

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


    <!-- Adding font awesome icons -->
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">

    <!-- Adding custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="resources/css/style.css">

    <!-- Adding script file -->
    <script type="text/javascript" src="resources/js/script.js"></script>

    <!-- Import open sans font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800&display=swap" rel="stylesheet">

    <!-- Google reCaptcha -->
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

    <script src="resources/js/validator.js"></script>

    <title>Projet Traduction</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light sticky-top navbar-default">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <div class="d-flex align-items-center">
                <img class="logo-image" src="<?php asset('logo/logo.svg'); ?>">
                <span class="logo-name">Projet Traduction</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navBarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if(current_url() == '/' || current_url() == '/login' || current_url() == '/sign-up') echo "active"?>">
                    <a class="nav-link" href="<?php echo url('/')?>">Accueil</a>
                </li>
                <li class="nav-item <?php if(current_url() == '/our-translations') echo "active" ?>">
                    <a class="nav-link" href="<?php echo url('/our-translations')?>">Nos Traductions</a>
                </li>
                <li class="nav-item <?php if(current_url() == '/our-translators') echo "active" ?>">
                    <a class="nav-link" href="<?php echo url('/our-translators')?>">Nos Traducteurs</a>
                </li>
                <li class="nav-item <?php if(current_url() == '/blog') echo "active" ?>">
                    <a class="nav-link" href="<?php echo url('/blog')?>">Notre Blog</a>
                </li>
                <?php if (Auth::type() == Client::class) : ?>
                    <li class="nav-item <?php if(current_url() == '/devis') echo "active" ?>">
                        <a class="nav-link" href="<?php echo url('/devis') ?>">Devis</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item <?php if(current_url() == '/recruitment') echo "active" ?>">
                        <a class="nav-link" href="<?php echo url('/recruitment') ?>">Recrutement</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item <?php if(current_url() == '/about') echo "active" ?>">
                    <a class="nav-link" href="<?php echo url('/about')?>">À propos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<aside class="social-sharing" id="sideSocialMediaIcons">
    <ul class="menu-social">
        <li>
            <a class="social-item" href="#" title="facebook">
                <i class="fab fa-facebook-f fa-lg white-text"> </i>
            </a>
        </li>
        <li>
            <a class="social-item" href="#" title="twitter">
                <i class="fab fa-twitter fa-lg white-text"> </i>
            </a>
        </li>
        <li>
            <a class="social-item" href="#" title="google">
                <i class="fab fa-google-plus-g fa-lg white-text"> </i>
            </a>
        </li>
        <li>
            <a class="social-item" href="#" title="linkedin">
                <i class="fab fa-linkedin-in fa-lg white-text"> </i>
            </a>
        </li>
        <li>
            <a class="social-item" href="#" title="instagram">
                <i class="fab fa-instagram fa-lg white-text"> </i>
            </a>
        </li>
        <li>
            <a class="social-item" href="#" title="pinterst">
                <i class="fab fa-pinterest fa-lg white-text"> </i>
            </a>
        </li>
    </ul>
</aside>

<div class="row">
    <div class="col-10 offset-1 p-0">
        <!-- Image Slider -->
        <div id="slides" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#slides" data-slide-to="0" class="active"></li>
                <li data-target="#slides" data-slide-to="1"></li>
                <li data-target="#slides" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://www.migaltranslations.com/sites/default/files/translation.jpg" alt="">
                    <div class="carousel-caption">
                        <h1 class="display-2"><strong>Projet Traduction</strong></h1>
                        <h3>Traduisez facilement vos documents avec nous</h3>
                    </div>
                </div>
                <div class="carousel-item text-center">
                    <img class="w-75" src="https://store-images.s-microsoft.com/image/apps.57355.13931251942486540.f20f96b5-e764-4ecb-8e10-4e09c3fb668c.b9cd5dc2-b11d-42ea-bcc9-cd1dfdda0e0f?mode=scale&q=90&h=1080&w=1920" alt="">
                </div>
                <div class="carousel-item">
                    <img src="https://www.migaltranslations.com/sites/default/files/translation.jpg" alt=""
                         style="opacity: 0.8">
                    <div class="carousel-caption">
                        <h2 class="display-2"><strong>meilleur services</strong></h2>
                        <h3>Inscrivez-vous avec nous</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-10 offset-1 mt-5" id="mainContainer">
        <div class="row d-flex justify-content-between">
            <!-- left section -->
            <div class="col-4 text-center">
                <div class="row secondary-container">
                    <div class="col">
                        <?php echo $this->_data['actualite-content']; /*include_once view('actualite.php')*/ ?>
                    </div>
                </div>
            </div>
            <!-- right section -->
            <div class="col-8">
                <?php echo $this->_data['main-section-content'] /*include_once view("main-section.php");*/ ?>
            </div>
        </div>
    </div>
</div>
<?php include_once view('footer.php'); ?>
</body>
</html>
