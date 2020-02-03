<div class="row">
    <div class="col-12">
        <h1 class="text-black-50 text-center">Nos Traducteurs</h1>
        <hr class="my-4 w-25">
    </div>
    <div class="col-12 text-center">
        <form method="post" action="<?php echo url('/our-translators/search') ?>">
            <div class="d-flex d-inline-flex align-items-center justify-content-between">
                <div class="form-group text-left">
                    <?php
                    $langueSource = old('langueSource');
                    $langueDest = old('langueDest');
                    ?>
                    <label for="langueSource">Langue source</label>
                    <select id="langueSource" class="custom-select" name="langueSource">
                        <?php foreach (Langue::all($order_by = 'ASC') as $langue) : ?>
                            <option value="<?php echo $langue->id_langue ?>" <?php echo $langue->id_langue == $langueSource ? "selected" : ""?> ><?php echo utf8_encode($langue->nom); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <i class="fas fa-sync-alt mx-5 text-black-50" style="font-size: 1.5rem"></i>

                <div class="form-group text-left">
                    <label for="langueDest">Langue destination</label>
                    <select id="langueDest" class="custom-select" name="langueDest">
                        <?php foreach (Langue::all($order_by = 'ASC') as $langue) : ?>
                            <option value="<?php echo $langue->id_langue ?>" <?php echo $langue->id_langue == $langueDest ? "selected" : ""?> ><?php echo utf8_encode($langue->nom); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <button id="signin" type="submit" class="btn btn-primary mt-3 mr-4">Rechercher</button>

        </form>
    </div>

    <div class="col-12 mt-5">
        <ul class="items">
            <?php if (Session::has('list_traducteur')) : ?>
                <?php foreach (Session::get('list_traducteur') as $traducteur) : ?>
                <?php $user = $traducteur->user(); ?>
                    <li class="item">
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
                                    <p class="text-muted m-0 mr-2">Tel: (+213)</p>
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
                    </li>
                <?php endforeach; ?>
            <?php Session::forget('list_traducteur')?>
            <?php else : ?>
                <li class="item">
                    <?php if($langueSource == null && $langueDest == null) : ?>
                        <div class="alert alert-secondary border-secondary text-center">
                            Résultat du recherche ici
                        </div>
                    <?php else : ?>
                        <div class="alert alert-danger border-danger text-center">
                            Aucune résultat.
                        </div>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<style>

    .items {
        list-style: none;
        padding-left: 0;
    }
    .item {
        margin-bottom: 2.1rem;
    }
    .item:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

</style>
