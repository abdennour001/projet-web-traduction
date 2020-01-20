<div class="row">
    <div class="col-8 offset-2">
        <h1 class="text-black-50 text-center">Notre Blog</h1>

        <hr class="my-5">

        <?php if ($this->has('title')) : ?>
            <h2 class="text-black-50 text-center">
                <?php echo $this->get('title')?>
            </h2>
        <?php else : ?>
            <div class="alert alert-secondary">
                Cliquez sur un article pour le lire.
            </div>
        <?php endif; ?>
    </div>
    <div class="col-10 offset-1">
        <p class="text-justify mt-4">
            <?php echo $this->has('body') ? $this->get('body') : "" ?>
        </p>
        <p class="text-muted">
            <?php echo $this->has('date') ? $this->get('date') : "" ?>
        </p>
    </div>
</div>
