<div class="row">
    <div class="col-12">
        <form id="chooseTranslatorForm" method="post" action="<?php echo url("/devis-choose-translator/send")?>">
            <div class="text-black-50 mb-4 text-center">
                <h1>Choix du traducteur</h1>
                <h3>Etape #2</h3>
            </div>

            <input id="selectedTranslator" type="hidden" name="selectedTranslator" value="">

            <div class="col-12 mt-5">
                <ul class="items">
                    <?php if (Session::has('list_traducteur')) : ?>
                        <div class="text-secondary my-5 text-center">
                            <p class="lead">Liste des traducteurs qui vous conviennent:</p>
                        </div>
                        <?php foreach (Session::get('list_traducteur') as $traducteur) : ?>
                            <?php $user = $traducteur->user(); ?>
                            <li class="item" data-id="<?php echo $traducteur->id_traducteur ?>">
                                <div class="d-flex d-inline-flex justify-content-start align-items-center w-100">
                                    <div class="image-profile m-5 p-5">
                                        <span style="font-size: 1.8rem"><?php echo $user->nom[0] . $user->prenom[0] ?></span>
                                    </div>
                                    <div class="d-flex flex-column justify-content-start align-items-start">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="m-0 mr-3"><?php echo $user->nom . " " . $user->prenom ?></h5>
                                            <?php for ($i = 1; $i<=5; $i++) : ?>
                                                <i class="fa fa-star mr-2" style="opacity: <?php echo $i <= $traducteur->note ? 1 : 0.6 ?> ;color: <?php echo $i <= $traducteur->note ? 'yellowgreen' : 'gray' ?>; font-size: .9rem;"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="d-flex d-inline-flex justify-content-start align-items-center mb-2">
                                            <p class="text-muted m-0 mr-2"><?php echo $user->wilaya ?></p>
                                            <i class="fas fa-circle text-muted mr-2" style="font-size: .3rem"></i>
                                            <p class="text-muted m-0 mr-2"><?php echo $user->commune ?></p>
                                            <i class="fas fa-circle text-muted mr-2" style="font-size: .3rem"></i>
                                            <p class="text-muted m-0"><?php echo $user->adresse ?></p>
                                        </div>
                                        <div class="d-flex d-inline-flex justify-content-start align-items-center">
                                            <p class="text-muted m-0 mr-2">Tel: </p>
                                            <p class="text-muted m-0 mr-4"><?php echo $user->numero ?></p>
                                        </div>
                                        <div class="d-flex d-inline-flex justify-content-start align-items-center">

                                            <p class="text-muted m-0 mr-2">Fax: </p>
                                            <p class="text-muted m-0"><?php echo $user->fax ?></p>
                                        </div>
                                        <div class="d-flex d-inline-flex justify-content-start align-items-center mb-2">
                                            <p class="text-muted m-0 mr-2">E-mail: </p>
                                            <p class="text-muted m-0"><?php echo $user->email ?></p>
                                        </div>
                                        <div class="d-flex d-inline-flex flex-wrap justify-content-start align-items-center">
                                            <?php if ($traducteur->est_assermente) : ?>
                                                <div class="tag mr-2 mb-2" style="background-color: rgba(255, 0, 0, 0.2); color: red; border-radius: 5px; padding: .2rem 1rem;">
                                                    Traducteur assermenté
                                                </div>
                                            <?php endif; ?>

                                            <?php foreach ($traducteur->langues() as $langue) : ?>
                                                <div class="tag mr-2 mb-2" style="background-color: rgba(0, 0, 0, 0.1); border-radius: 5px; color: rgba(0, 0, 0, 0.75); padding: .2rem 1rem;">
                                                    <?php echo utf8_encode($langue->nom) ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i id="<?php echo $traducteur->id_traducteur ?>" class="fa fa-check checked-symbol not-display-i"></i>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php Session::forget('list_traducteur')?>
                    <?php else : ?>
                        <li class="item">
                            <div class="alert alert-danger border-danger text-center">
                                Aucune résultat correspondante.
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col-12 text-center">
                <button id="terminer" type="submit" class="btn btn-primary mt-3" disabled>Terminer</button>
            </div>
        </form>
    </div>
</div>

<style>

    .items {
        list-style: none;
        padding-left: 0;
    }
    .item {
        position: relative;
        margin-bottom: 2.1rem;
        transition: 0.2s ease;
        border: 1px solid transparent;
    }
    .item:hover {
        background-color: rgba(0, 0, 0, 0.05);
        cursor: pointer;
    }
    .checked {
        border: 1px solid dodgerblue;
        box-shadow: 0 0 5px rgba(64, 64, 64, 0.4);
    }
    .checked-symbol {
        position: absolute;
        top: 0;
        right: 0;
        padding: .3rem;
        background: rgba(30, 139, 255, 0.41);
        margin: 0;
        font-size: 1.8rem;
        color: dodgerblue;
        transition: 0.5s ease;
    }
    .display-i {
        display: inline-block;
    }

    .not-display-i {
        display: none;
    }


</style>
