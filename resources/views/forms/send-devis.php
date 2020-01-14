<form method="post">
    <div class="text-black-50 mb-4 text-center">
        <h1>Demande de devis</h1>
    </div>

    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" aria-describedby="nomHelp" placeholder="Enter nom">
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenom" placeholder="Enter Prénom">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter Email">
    </div>
    <div class="form-group">
        <label for="numero">Numéro de téléphone (+213)</label>
        <input type="number" maxlength="9" minlength="9" class="form-control" id="numero" placeholder="Numéro +213">
    </div>
    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" maxlength="9" minlength="9" class="form-control" id="adresse" placeholder="Adresse">
    </div>
    <div class="form-group">
        <label for="langueOrigine">Langue origine</label>
        <select id="langueOrigine" class="custom-select">
            <option value="fr" selected>Francais</option>
            <option value="en">English</option>
            <option value="ar">Arabe</option>
        </select>
    </div>
    <div class="form-group">
        <label for="langueSource">Langue source</label>
        <select id="langueSource" class="custom-select">
            <option value="fr" selected>Francais</option>
            <option value="en">English</option>
            <option value="ar">Arabe</option>
        </select>
    </div>
    <div class="form-group">
        <label for="type">Type de traduction</label>
        <select id="type" class="custom-select">
            <option value="gen" selected>Général</option>
            <option value="sc">Scientifique</option>
            <option value="web">Site web</option>
        </select>
    </div>
    <div class="form-group">
        <label for="comment">Commentaires</label>
        <textarea class="form-control" id="comment" rows="3"></textarea>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="fichier">
            <label class="custom-file-label" for="fichier">Choisir fichier</label>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="checkTraducteur">
            <label class="custom-control-label" for="checkTraducteur">Voulez vous un traducteur assermenté ?</label>
        </div>
    </div>
    <div style="height: 32px"></div>
    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6LcmZs0UAAAAAJX5M6N-sYp_F49FCXeDjkQ10VVO" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
        <input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
        <div class="help-block with-errors"></div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Envoyer</button>
</form>
