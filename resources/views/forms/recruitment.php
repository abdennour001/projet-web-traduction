<div class="row">
    <div class="col-8 offset-2">
        <form id="recruitmentForm" method="post" action="<?php echo url('/recruitment/send')?>" enctype="multipart/form-data">
            <div class="text-black-50 mb-4 text-center">
                <h1>Recrutement</h1>
            </div>

            <hr class="my-5">

            <div class="form-group">
                <div class="custom-file">
                    <input type="file" accept="application/pdf" class="custom-file-input" name="cv" id="fichier">
                    <label class="custom-file-label" for="fichier">Choisir fichier CV (format pdf)</label>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" accept="application/pdf" multiple class="custom-file-input" name="ref[]" id="ref">
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
                    <input type="file" accept="application/pdf" class="custom-file-input" name="ass" id="ref">
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

            $('.custom-file-input').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('.custom-file-input')[0].files[0].name;
                $(this).next('label').text(file);
            });

        </script>

    </div>
</div>
