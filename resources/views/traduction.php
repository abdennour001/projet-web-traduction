<div class="row">
    <div class="col-12 text-center">
        <h1 class="text-black-50">Demande de traduction</h1>
    </div>

    <?php if ($this->get('traduction')->etat == "finis" && $this->get('traduction')->note != 0) : ?>
        <div class="col-12 text-center">
            <div class="d-flex justify-content-center align-items-center my-4">
                <?php for ($i = 1; $i<=5; $i++) : ?>
                    <i class="fa fa-star mr-4" style="opacity: <?php echo $i <= $this->get('traduction')->note ? 1 : 0.6 ?> ;color: <?php echo $i <= $this->get('traduction')->note ? 'yellowgreen' : 'gray' ?>; font-size: 1.4rem;"></i>
                <?php endfor; ?>
            </div>
        </div>
        <?php if ($this->get('traduction')->note < 0) : ?>
            <div class="col-12 text-center my-4">
                <span class="lead alert alert-danger">
                    <i class="fa fa-exclamation-triangle mr-2"></i>
                    Signalé
                </span>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (Session::has('new-traduction')) : ?>
        <div class="col-10 offset-1 text-center mt-4">
            <div class="alert alert-success border-success">
                <?php
                echo Session::get('new-traduction');
                Session::forget('new-traduction');
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (Session::has('respond-traduction')) : ?>
        <div class="col-10 offset-1 text-center mt-4">
            <div class="alert alert-success border-success">
                <?php
                echo Session::get('respond-traduction');
                Session::forget('respond-traduction');
                ?>
            </div>
        </div>
    <?php endif; ?>


    <div class="col-8 offset-2">
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">#:</h4>
            <p class="lead ml-2">
                <span><?php echo $this->get('traduction')->id_traduction ?></span>
            </p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Date:</h4>
            <p class="lead ml-2"><?php echo substr($this->get('traduction')->date, 0, 16) ?></p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Etat:</h4>
            <p class="lead ml-2">
                <span>
                    <?php if ($this->get('traduction')->etat == 'pas-encore-demarre') :?>
                        <span class="text-danger">En attente</span>
                    <?php elseif ($this->get('traduction')->etat == 'en-cours') : ?>
                        <span class="text-primary">En cours</span>
                    <?php elseif ($this->get('traduction')->etat == 'finis') : ?>

                        <?php if ($this->get('traduction')->note == -1) : ?>
                            <span class="alert-danger alert">
                                <i class="fa fa-exclamation-triangle mr-2"></i>
                                Signalé
                            </span>
                        <?php else : ?>
                            <span class="text-success">Finis</span>
                        <?php endif; ?>

                    <?php elseif ($this->get('traduction')->etat == 'abandonne') : ?>
                        <span class="text-danger font-weight-bolder">Abandonné</span>
                    <?php endif; ?>
                </span>
            </p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">#Devis:</h4>
            <p class="lead ml-2 p-0 m-0">
                <span><?php echo $this->get('traduction')->id_devis ?></span>
            </p>
            <a href="<?php echo url("/demande-devis?id_devis={$this->get('traduction')->devis()->id_devis}") ?>" class="btn btn-outline-secondary ml-auto">vérifier le devis</a>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Traducteur:</h4>
            <p class="lead ml-2"><?php echo $this->get('traduction')->devis()->traducteurs()[0]->user()->nom . " " . $this->get('traduction')->devis()->traducteurs()[0]->user()->prenom; ?></p>
        </div>
        <div class="d-flex align-items-baseline text-left my-4">
            <h4 class="text-black-50">Client:</h4>
            <p class="lead ml-2"><?php echo $this->get('traduction')->devis()->client()->user()->nom . " " . $this->get('traduction')->devis()->client()->user()->prenom; ?></p>
        </div>
        <?php if ($this->get('traduction')->etat == "finis") : ?>
            <div class="d-flex align-items-baseline text-left my-4 flex-wrap">
                <h4 class="text-black-50">Document traduit:</h4>
                <a id="goToFile" class="align-items-center" href="file://<?php echo $this->get('traduction')->document()->path ?>" style="text-decoration: none" target="_self">
                    <?php echo document_name($this->get('traduction')->document()->path, $type = 'document-traduit-traduction') ?>
                    <i class="fas fa-arrow-circle-right ml-2" style="font-size: 1.2rem;"></i>
                </a>
            </div>
        <?php endif; ?>
        <?php if (Auth::type() == Client::class) : ?>
            <?php if ($this->get('traduction')->etat != "finis") : ?>
                <a href="#"
                   data-toggle="modal" data-target="#exampleModal3"
                   class="btn btn-outline-danger card-link">Annuler</a>
            <?php else: ?>
<!--                rate here -->
                <?php if ($this->get('traduction')->note == 0) : ?>
                    <hr class="my-5">
                    <div class="d-flex flex-column align-items-baseline my-4 flex-wrap w-100">
                        <h4 class="text-black-50 text-left">Noter ce travail:</h4>
                        <ul id="rate" class="d-flex text-center align-items-baseline mt-4 ml-0 pl-0" style="list-style: none">
                            <?php for ($i = 1; $i<=5; $i++) : ?>
                                <li data-index="<?php echo $i; ?>">
                                    <i title="<?php echo $i; ?>" class="fa fa-star mr-4 star-gray" style="font-size: 1.8rem;"></i>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                    <hr class="my-5">
                    <a href="#"
                       data-toggle="modal" data-target="#exampleModal5"
                       class="btn btn-outline-danger card-link">
                        <i class="fa fa-exclamation-triangle mr-2"></i>
                        Signaler la traduction
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        <?php else : ?>
            <?php if ($this->get('traduction')->etat == "pas-encore-demarre") : ?>
                <a href="<?php echo url('/demande-traduction/respond?id_traduction='.$this->get('traduction')->id_traduction); ?>"
                   class="btn btn-primary card-link">Accepter</a>
                <a href="#"
                   data-toggle="modal" data-target="#exampleModal3"
                   class="btn btn-outline-danger card-link">Refusé</a>
            <?php elseif ($this->get('traduction')->etat == "en-cours") : ?>

                <hr class="w-100 mt-4">
                <form method="post" action="<?php echo url('/demande-traduction/rendre-travail')?>" enctype="multipart/form-data">
                    <input type="hidden" name="traduction" value="<?php echo $this->get('traduction')->id_traduction ?>">
                    <div class="row">
                        <div class="col-8 text-left">
                            <div class="form-group" id="fichierAssermentation">
                                <div class="custom-file">
                                    <input id="rendre" type="file" accept="application/pdf" class="custom-file-input" name="ass" required>
                                    <label class="custom-file-label" for="ref">Fichier traduit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary card-link">Rendre le travail</button>
                </form>
                <hr class="w-100 mt-4">
                <a href="javascript:void(0)"
                   data-toggle="modal" data-target="#exampleModal4"
                   class="btn btn-outline-danger card-link">Abandonner</a>
            <?php endif; ?>
        <?php endif; ?>
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
                <p class="lead">Voulez-vous vraiment refuser cet demande ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-outline-danger" href="<?php echo url('/demande-traduction/refuser?id_traduction='.$this->get('traduction')->id_traduction); ?>">Refuser</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead">Voulez-vous vraiment refuser cet demande ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-outline-danger" href="<?php echo url('/demande-traduction/refuser?id_traduction='.$this->get('traduction')->id_traduction); ?>">Abandonner</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead">Voulez-vous vraiment singaler cet demande ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-outline-danger" href="<?php echo url('/demande-traduction/signaler?traduction='.$this->get('traduction')->id_traduction); ?>">Signaler</a>
            </div>
        </div>
    </div>
</div>

<style>

    input[type='file']:hover {
        cursor: pointer;
    }

    .fas.fa-arrow-circle-right {
        transition: 0.25s ease-in;
    }

    #goToFile:hover .fas.fa-arrow-circle-right {
        transform: translateX(10px);
    }

    #rate > li {
        cursor: pointer;
        transition: 0.2s ease-in;
    }

    #rate > li:active {
        transform: scale(.5);
    }

    #rate > li > i {
        text-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    }


    .star-gray {
        opacity: 0.6;
        color: gray;
    }

    .star-yellow {
        opacity: 1;
        color: yellowgreen;
    }

</style>

<script>
    $(document).ready(function() {
        $('#rendre').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#rendre')[0].files[0].name;
            $(this).next('label').text(file);
        });

        var isClicked = false;

        $('#rate > li').click(function () {
            var li = $(this);
            var index = li.attr('data-index');

            isClicked = true;

            //

            window.location = "/projet/demande-traduction/rate?traduction=" + <?php echo $this->get('traduction')->id_traduction ?> + "&" + "rate=" + index;

            //

            for (var i = 1; i <= 5; i++) {
                var li2 = $("#rate > li[data-index = " + i + "] > i");

                if (i <= index) {
                    li2.removeClass('star-gray');
                    li2.addClass('star-yellow');
                } else {
                    li2.removeClass('star-yellow');
                    li2.addClass('star-gray');
                }
            }
        }).hover(function () {
            if (!isClicked) {
                var li = $(this);
                var index = li.attr('data-index');

                for (var i = 1; i <= 5; i++) {
                    var li2 = $("#rate > li[data-index = " + i + "] > i");

                    if (i <= index) {
                        li2.removeClass('star-gray');
                        li2.addClass('star-yellow');
                    } else {
                        li2.removeClass('star-yellow');
                        li2.addClass('star-gray');
                    }
                }
            }
        }, function () {
           if (!isClicked) {
               for (var i = 1; i <= 5; i++) {
                   var li2 = $("#rate > li[data-index = " + i + "] > i");
                   li2.removeClass('star-yellow');
                   li2.addClass('star-gray');
               }
           }
        })

    });
</script>
