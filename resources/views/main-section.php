<div id="mainContent" class="row text-left secondary-container ml-4" style="padding-top: 15px;padding-bottom: 15px;">

    <?php if(Auth::hasUser()) : ?>
    <!-- User information here -->
        <div class="col-12">
            <div class="d-flex flex-row-reverse align-items-center">
                <a href="<?php echo url('/logout')?>" class="ml-2 btn btn-secondary card-link">Déconnexion</a>
                <a href="<?php echo url('/notifications')?>" class="btn btn-secondary ml-auto ntf-btn">
                    <?php

                        $notifications = Notification::where([
                            "id_user" => Auth::id(),
                            "AND",
                            "vu" => "0"
                        ]);

                        $notifications_count = count($notifications);

                    ?>
                    <?php if($notifications_count > 0) : ?>
                        <span class="ntf-container">
                            <span class="ntf-number"><?php echo $notifications_count ?></span>
                        </span>
                    <?php endif;?>
                    <i class="fas fa-bell"></i>
                </a>
                <div class="ml-3 d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <a href="<?php echo (Auth::type() == Client::class ? url("/client") : url("/traducteur")); ?>" style="text-decoration: none" title="Profile">
                            <h6 class="text-black-50 m-0"><?php echo Auth::user()->nom ?> <?php echo Auth::user()->prenom ?></h6>
                        </a>
                        <p class="mx-2 m-0 pb-2"><i class="fas fa-circle" style="font-size: .4rem"></i></p>
                        <p class="m-0"><?php echo Auth::type() ?></p>
                        <?php if (Auth::type() == Traducteur::class) : ?>
                            <div class="d-flex align-items-baseline justify-content-center ml-3">
                                <?php for ($i = 1; $i<=5; $i++) : ?>
                                    <i class="fa fa-star mr-2" style="opacity: <?php echo $i <= Auth::user()->traducteur()->note ? 1 : 0.6 ?> ;color: <?php echo $i <= Auth::user()->traducteur()->note ? 'yellowgreen' : 'gray' ?>; font-size: .9rem;"></i>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h6><?php echo Auth::user()->email ?></h6>
                </div>
                <a href="" style="text-decoration: none">
                    <div class="image-profile">
                        <h4><?php echo Auth::user()->nom[0]?><?php echo Auth::user()->prenom[0] ?></h4>
                    </div>
                </a>
            </div>
        </div>
        <style>
            .image-profile {
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

    <?php if (Session::has('demande-envoye')) : ?>
        <div class="col-10 offset-1 text-center mt-4">
            <div class="alert alert-success border-success">
                <?php
                echo Session::get('demande-envoye');
                Session::forget('demande-envoye');
                ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-12">
        <hr class="my-4">
    </div>

    <div class="col-12 my-4">
        <?php echo $this->_data['main-content']; /*include_once view("forms/recruitment.php");*/ ?>
    </div>
</div>

<style>

    .ntf-btn {
        position: relative;
    }

    .ntf-container {
        display: flex;
        align-items: center;
        justify-content: center;
        vertical-align: center;
        position: absolute;
        top: -20%;
        left: -20%;
        border-radius: 100%;
        background: red;
        height: 20px;
        width: 20px;
    }

    .ntf-number {
        color: white;
        font-size: .9rem;
    }

</style>

<script>

    console.log("Hello from main.")

</script>
