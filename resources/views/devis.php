<div class="row">
    <div class="col-12 text-center">
        <h1 class="text-black-50">Devis</h1>
    </div>

    <?php if (Session::has('respond-devis')) : ?>
        <div class="col-10 offset-1 text-center mt-4">
            <div class="alert alert-success border-success">
                <?php
                echo Session::get('respond-devis');
                Session::forget('respond-devis');
                ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-8 offset-2">
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">#:</h4>
            <p class="lead ml-2"><?php echo $this->get('devis')->id_devis ?></p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Date:</h4>
            <p class="lead ml-2"><?php echo substr($this->get('devis')->date, 0, 16); ?></p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Type:</h4>
            <p class="lead ml-2"><?php echo $this->get('devis')->type_traduction ?></p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <div class="d-flex w-100 justify-content-between">
                <h4 class="text-black-50">Source:</h4>
                <p class="lead ml-2"><?php echo utf8_encode($this->get('devis')->langueSource()->nom) ?></p>
                <h4 class="text-black-50 ml-auto">Destination:</h4>
                <p class="lead ml-2"><?php echo utf8_encode($this->get('devis')->langueDestination()->nom) ?></p>
            </div>
        </div>
        <div class="d-flex align-items-baseline text-left my-4 flex-wrap">
            <h4 class="text-black-50 mr-2">Commentaire:</h4>
            <p style="display: block; word-wrap: break-word;"><?php echo $this->get('devis')->commentaires; ?></p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Etat:</h4>
            <p class="lead ml-2">
                <?php if ($this->get('devis')->etat == 'pas-encore-repondu') :?>
                    <span class="text-danger">En attente</span>
                <?php elseif ($this->get('devis')->etat == 'refuse') : ?>
                    <span class="text-danger font-weight-bold">Refusé</span>
                <?php else : ?>
                    <span class="text-success">Répondu</span>
                <?php endif; ?>
            </p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Traducteur:</h4>
            <p class="lead ml-2">
                <?php if (!empty($this->get('devis')->traducteurs())) : ?>
                    <?php echo $this->get('devis')->traducteurs()[0]->user()->nom . " " . $this->get('devis')->traducteurs()[0]->user()->prenom ?>
                <?php else : ?>
                    N/D
                <?php endif; ?>
            </p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Client:</h4>
            <p class="lead ml-2">
                <span><?php echo $this->get('devis')->client()->user()->nom . " " . $this->get('devis')->client()->user()->prenom ?></span>
            </p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Prix:</h4>
            <p class="lead ml-2">
                <span><?php echo $this->get('devis')->etat != 'repondu' ? "- - - -" : $this->get('devis')->prix ?></span>
            </p>
        </div>

        <div class="d-flex align-items-baseline text-left my-4 flex-wrap">
            <h4 class="text-black-50 mr-2">Document:</h4>
            <a id="goToFile" href="file://<?php echo $this->get('devis')->document()->path ?>" style="text-decoration: none" target="_self">
                <?php echo document_name($this->get('devis')->document()->path) ?>
                <i class="fas fa-arrow-circle-right ml-2" style="font-size: 1.2rem;"></i>
            </a>
        </div>

        <div class="mt-5">
            <?php if (Auth::type() == Client::class) : ?>
                <?php if ($this->get('devis')->etat == 'repondu') : ?>
                    <?php if ($this->get('devis')->traduction() != null) : ?>
                        <a href="<?php echo url('/demande-traduction?id_traduction='.$this->get('devis')->traduction()->id_traduction)?>" class="btn btn-primary card-link">Vérifier la demande</a>
                    <?php else : ?>
                        <a href="<?php echo url('/demande-traduction/send?id_devis='.$this->get('devis')->id_devis)?>" class="btn btn-primary card-link">Demande traduction</a>
                    <?php endif; ?>
                <?php endif; ?>
                <a href="#"
                   data-toggle="modal" data-target="#exampleModal3"
                   class="btn btn-outline-danger card-link">Supprimer</a>
            <?php else : ?>
                <?php if ($this->get('devis')->etat == 'pas-encore-repondu') : ?>
                    <hr class="w-100 mt-4">
                    <form method="post" action="<?php echo url('/devis/respond')?>">
                        <input type="hidden" name="devis" value="<?php echo $this->get('devis')->id_devis ?>">
                        <div class="row">
                            <div class="col-8 text-left">
                                <div class="form-group">
                                    <label for="prix">Prix</label>
                                    <input type="prix" class="form-control" id="prix" name="prix" aria-describedby="prix" placeholder="Entrer prix" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary card-link mt-2">Repondre</button>
                    </form>
                    <hr class="w-100 mt-4">
                    <a href="<?php echo url('/devis/refuser?id_devis='.$this->get('devis')->id_devis)?>" class="btn btn-outline-danger card-link mt-2">Refuser</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead">Voulez-vous vraiment supprimer ce devis ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-outline-danger" href="<?php echo url('/devis/delete?id_devis='.$this->get('devis')->id_devis)?>">Oui</a>
            </div>
        </div>
    </div>
</div>

<style>

    .fas.fa-arrow-circle-right {
        transition: 0.25s ease-in;
    }

    #goToFile:hover .fas.fa-arrow-circle-right {
        transform: translateX(10px);
    }

</style>
