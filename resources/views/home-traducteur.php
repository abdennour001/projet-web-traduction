<div class="row">
    <div class="col-8 offset-2">
        <h1 class="text-black-50 text-center">Traducteur</h1>
        <hr class="my-5">
    </div>
    <?php if (!Auth::user()->traducteur()->est_approuve) : ?>
        <div class="col-10 offset-1 text-center">
            <div class="alert alert-secondary border-secondary">
                Vous devez envoyer une demande de recrutement pour commencer à travailler avec nous en tant que traducteur.
            </div>
            <a href="<?php echo url('/recruitment')?>" class="btn btn-primary mt-2">Envoyer une demande maintenant</a>
        </div>
    <?php endif; ?>
</div>
