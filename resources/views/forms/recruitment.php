<form method="post">
    <div class="text-black-50 mb-4 text-center">
        <h1>Recrutement</h1>
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
    <div class="form-group">
        <div class="custom-file">
            <input type="file" accept="application/pdf" class="custom-file-input" id="fichier">
            <label class="custom-file-label" for="fichier">Choisir fichier CV (format pdf)</label>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" accept="application/pdf" multiple class="custom-file-input" id="ref">
            <label class="custom-file-label" for="ref">Fichiers des références (3 fichiers au max)</label>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="checkTraducteur" checked>
            <label class="custom-control-label" for="checkTraducteur">Traducteur assermenté ?</label>
        </div>
    </div>
    <div class="form-group" id="fichierAssermentation">
        <div class="custom-file">
            <input type="file" accept="application/pdf" class="custom-file-input" id="ref">
            <label class="custom-file-label" for="ref">Choisir fichier d'assermentation.</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3" id="envoyer">Envoyer une demande</button>
</form>

<script>
    $(function(){
        $("button[id='envoyer']").click(function(){
            let $fileUpload = $("input[id='ref']");
            if (parseInt($fileUpload.get(0).files.length)>3){
                alert("You can only upload a maximum of 3 files");
            }
        });

        $("input[id='checkTraducteur']").change(function() {
            $("div[id='fichierAssermentation']").toggle("fast", "linear");
        })
    });
</script>
