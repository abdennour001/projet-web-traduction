<div class="row">
    <div class="col-8 offset-2">
        <form id="sendDevisForm" method="post" action="<?php echo url('/devis/send')?>" enctype="multipart/form-data">
            <div class="text-black-50 mb-5 text-center">
                <h1>Demande de devis</h1>
                <h3>Etape #1</h3>
            </div>


            <?php if (Session::has('error-send-devis')) : ?>
                <div class="alert alert-danger border-danger">
                    <?php
                    echo Session::get('error-send-devis');
                    Session::forget('error-send-devis');
                    ?>
                </div>
            <?php endif; ?>

            <?php if (Session::has('devis-sent')) : ?>
                <div class="alert alert-success border-success">
                    <?php
                    echo Session::get('devis-sent');
                    Session::forget('devis-sent');
                    ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="langueOrigine">Langue source</label>
                <select id="langueOrigine" class="custom-select" name="langue_source">
                    <?php foreach (Langue::all($order_by = 'DESC') as $langue) : ?>
                        <option value="<?php echo $langue->id_langue ?>" selected><?php echo utf8_encode($langue->nom); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="langueSource">Langue destination</label>
                <select id="langueSource" class="custom-select" name="langue_destination">
                    <?php foreach (Langue::all($order_by = 'DESC') as $langue) : ?>
                        <option value="<?php echo $langue->id_langue ?>" selected><?php echo utf8_encode($langue->nom); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="type">Type de traduction</label>
                <select id="type" class="custom-select" name="type">
                    <option value="general" selected>Général</option>
                    <option value="scientifique">Scientifique</option>
                    <option value="site-web">Site web</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Commentaires</label>
                <textarea class="form-control" id="comment" name="comments" data-error="Veuillez entrer vos commentaires." required="required" rows="3"></textarea>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" data-error="Veuillez entrer votre document." required="required" name="document" id="fichier">
                    <label class="custom-file-label" for="fichier">Choisir fichier</label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkTraducteur" name="assermente" value="1">
                    <label class="custom-control-label" for="checkTraducteur">Voulez vous un traducteur assermenté ?</label>
                </div>
            </div>
            <div style="height: 32px"></div>
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6LcmZs0UAAAAAJX5M6N-sYp_F49FCXeDjkQ10VVO" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                <input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
                <div class="help-block with-errors"></div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3 text-center">Envoyer</button>
            </div>
        </form>

    </div>
</div>
