<div class="row">
    <div class="col-8 offset-2">
        <form id="modifierTraducteurForm" method="post" action="<?php echo url('/edit-traducteur/editing')?>">
            <div class="text-black-50 mb-4 text-center">
                <h1>Modifier le profile</h1>
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
                <label for="nom">Nom</label>
                <input value="<?php echo Auth::user()->nom ?>" type="text" class="form-control" id="nom" name="nom" aria-describedby="nomHelp" placeholder="Entrer nom">
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input value="<?php echo Auth::user()->prenom ?>" type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer Prénom">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input value="<?php echo Auth::user()->email ?>" type="email" class="form-control" id="email" name="email" placeholder="Entrer Email">
            </div>

            <div class="form-group">
                <label for="numero">Numéro de téléphone (+213)</label>
                <input value="<?php echo Auth::user()->numero ?>" type="number" maxlength="9" minlength="9" class="form-control" id="numero" name="numero" placeholder="Numéro +213">
            </div>

            <div class="form-group">
                <label for="fax">Numéro de fax</label>
                <input value="<?php echo Auth::user()->fax ?>" type="number" minlength="5" class="form-control" id="fax" name="fax" placeholder="Numéro fax">
            </div>

            <div class="form-group">
                <label for="wilaya">Wilaya</label>
                <input value="<?php echo Auth::user()->wilaya ?>" type="text" class="form-control" id="wilaya" name="wilaya" placeholder="Entrer Wilaya">
            </div>

            <div class="form-group">
                <label for="commune">Commune</label>
                <input value="<?php echo Auth::user()->commune ?>" type="text" class="form-control" id="commune" name="commune" placeholder="Entrer Commune">
            </div>

            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input value="<?php echo Auth::user()->adresse ?>" type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrer Adresse">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Modifier</button>
            <a href="<?php echo url('/traducteur')?>" class="btn btn-secondary card-link mt-3 ml-3">Annuler</a>
        </form>
    </div>
</div>
