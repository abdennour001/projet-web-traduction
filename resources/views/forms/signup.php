<form id="signUpForm" method="post" action="<?php echo url('/sign-up/signing')?>">
    <div class="text-black-50 mb-4 text-center">
        <h1>Inscription</h1>
    </div>

    <?php if (Session::has('error-sign-up')) : ?>
        <div class="alert alert-danger border-danger">
            <?php
            echo Session::get('error-sign-up');
            Session::forget('error-sign-up');
            ?>
        </div>
    <?php endif; ?>


    <div class="form-group">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="client" name="type" value="Client" class="custom-control-input" checked>
            <label class="custom-control-label" for="client">Client</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="traducteur" name="type" value="Traducteur" class="custom-control-input">
            <label class="custom-control-label" for="traducteur">Traducteur</label>
        </div>
    </div>

    <div class="form-group">
        <label for="nom">Nom</label>
        <input value="<?php echo old('nom') ?>" type="text" class="form-control" id="nom" name="nom" aria-describedby="nomHelp" placeholder="Entrer nom">
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input value="<?php echo old('prenom') ?>" type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer Prénom">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input value="<?php echo old('email') ?>" type="email" class="form-control" id="email"name="email" placeholder="Entrer Email">
    </div>
    <div class="form-group">
        <label for="password">Mot de pass</label>
        <input type="password" minlength="4" class="form-control" id="password" name="password" placeholder="Entrer mot de pass">
    </div>
    <div class="form-group">
        <label for="passwordRepeat">Confirmation du mot de pass</label>
        <input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat" placeholder="Entrer mot de pass à nouveau">
    </div>
    <div class="form-group">
        <label for="numero">Numéro de téléphone (+213)</label>
        <input value="<?php echo old('numero') ?>" type="number" maxlength="9" minlength="9" class="form-control" id="numero" name="numero" placeholder="Numéro +213">
    </div>

    <!-- Section Traducteur -->
    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input value="<?php echo old('adresse') ?>" type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrer Adresse">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Connexion</button>
</form>
