<form method="post">
    <div class="text-black-50 mb-4 text-center">
        <h1>Inscription</h1>
    </div>

    <div class="form-group">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="client" name="type" class="custom-control-input">
            <label class="custom-control-label" for="client">Client</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="traducteur" name="type" class="custom-control-input">
            <label class="custom-control-label" for="traducteur">Traducteur</label>
        </div>
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

    <!-- Section Traducteur -->
    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" maxlength="9" minlength="9" class="form-control" id="adresse" placeholder="Enter Adresse">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Connexion</button>
</form>
