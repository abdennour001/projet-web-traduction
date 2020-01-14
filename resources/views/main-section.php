<div class="row text-left secondary-container ml-4" style="padding-top: 15px;padding-bottom: 15px;">
    <div class="col-12">
        <div class="d-flex flex-row-reverse align-items-baseline">
            <a href="<?php echo url('/signup')?>" class="ml-2 btn btn-secondary card-link">Inscription</a>
            <p class="ml-2">où</p>
            <a href="<?php echo url('/signin')?>" class="btn btn-primary card-link">Connexion</a>
        </div>
    </div>
    <div class="col-8 offset-2 my-4">
        <?php echo $this->_data['main-content']; /*include_once view("forms/recruitment.php");*/ ?>
    </div>
</div>

<script>

    console.log("Hello from main.")

</script>
