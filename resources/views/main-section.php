<div class="row text-left secondary-container ml-4" style="padding-top: 15px;padding-bottom: 15px;">

    <?php if(Auth::hasUser()) : ?>
    <!-- User information here -->
        <div class="col-12">
            <div class="d-flex flex-row-reverse align-items-center">
                <a href="<?php echo url('/logout')?>" class="ml-2 btn btn-secondary card-link ml-auto">Se déconnecter</a>
                <div class=" ml-3 d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <h6 class="text-black-50 m-0"><?php echo Auth::user()->nom ?> <?php echo Auth::user()->prenom ?></h6>
                        <p class="mx-2 m-0 pb-2"><i class="fas fa-circle" style="font-size: .4rem"></i></p>
                        <p class="m-0"><?php echo Auth::type() ?></p>
                    </div>
                    <h6><?php echo Auth::user()->email ?></h6>
                </div>
                <div class="image">
                    <h4><?php echo Auth::user()->nom[0]?><?php echo Auth::user()->prenom[0] ?></h4>
                </div>
            </div>
        </div>
        <style>
            .image {
                width: 3rem;
                height: 3rem;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 200%;
                background: dodgerblue;
                color: white;
                font-weight: 500;
            }
        </style>
    <?php else : ?>
        <div class="col-12">
            <div class="d-flex flex-row-reverse align-items-baseline">
                <a href="<?php echo url('/sign-up')?>" class="ml-2 btn btn-secondary card-link">Inscription</a>
                <p class="ml-2">où</p>
                <a href="<?php echo url('/login')?>" class="btn btn-primary card-link">Connexion</a>
            </div>
        </div>
    <?php endif; ?>

    <?php if (Session::has('new-user-info')) :?>

        <div class="col-10 offset-1 mt-4">
            <div class="alert alert-success border-success">
                <?php
                    echo Session::get('new-user-info');
                    Session::forget('new-user-info');
                ?>
            </div>
        </div>

    <?php endif; ?>

    <?php if (Session::has('new-traducteur-info')) :?>

        <div class="col-10 offset-1 mt-4">
            <div class="alert alert-secondary border-secondary">
                <?php
                echo Session::get('new-traducteur-info');
                Session::forget('new-traducteur-info');
                ?>
            </div>
        </div>

    <?php endif; ?>

    <div class="col-12">
        <hr class="my-4">
    </div>

    <div class="col-8 offset-2 my-4">
        <?php echo $this->_data['main-content']; /*include_once view("forms/recruitment.php");*/ ?>
    </div>
</div>

<script>

    console.log("Hello from main.")

</script>
