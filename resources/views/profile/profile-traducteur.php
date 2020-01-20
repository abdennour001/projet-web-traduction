<div class="row">
    <div class="col-8 offset-2">
        <h1 class="text-center text-black-50 mb-5">Profile Traducteur</h1>

        <div class="d-flex align-items-baseline justify-content-center mb-5">
            <?php for ($i = 1; $i<=5; $i++) : ?>
                <i class="fa fa-star mr-4" style="opacity: <?php echo $i <= Auth::user()->traducteur()->note ? 1 : 0.6 ?> ;color: <?php echo $i <= Auth::user()->traducteur()->note ? 'yellowgreen' : 'gray' ?>; font-size: 1.4rem;"></i>
            <?php endfor; ?>
        </div>

        <div class="d-flex align-items-baseline justify-content-between text-left my-4">
            <div class="d-flex">
                <h4 class="text-black-50 font-weight-bold">Approuvé:</h4>
                <p class="lead ml-2"><?php echo Auth::user()->traducteur()->est_approuve ? "Oui" : "Non" ;?></p>
            </div>
            <div class="d-flex">
                <h4 class="text-black-50 font-weight-bold">Assermenté:</h4>
                <p class="lead ml-2"><?php echo Auth::user()->traducteur()->est_approuve ? "Oui" : "Non" ;?></p>
            </div>
        </div>

        <hr class="my-4">

        <div class="d-flex align-items-baseline justify-content-between my-4">
            <h4 class="text-black-50">Nom:</h4>
            <p class="lead ml-2"><?php echo Auth::user()->nom ?></p>

            <h4 class="text-black-50 ml-auto">Prénom:</h4>
            <p class="lead ml-2"><?php echo Auth::user()->prenom ?></p>
        </div>

        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Email:</h4>
            <p class="lead ml-2"><?php echo Auth::user()->email?></p>
        </div>

        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Numéro:</h4>
            <p class="lead ml-2">+213 <?php echo Auth::user()->numero?></p>
        </div>

        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Fax:</h4>
            <p class="lead ml-2"><?php echo Auth::user()->fax?></p>
        </div>

        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Wilaya:</h4>
            <p class="lead ml-2"><?php echo Auth::user()->wilaya?></p>
        </div>

        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Commune:</h4>
            <p class="lead ml-2"><?php echo Auth::user()->commune?></p>
        </div>

        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Adresse:</h4>
            <p class="lead ml-2"><?php echo Auth::user()->adresse?></p>
        </div>

        <a href="<?php echo url('/edit-traducteur')?>" class="btn btn-primary card-link">Modifier</a>

    </div>
</div>
