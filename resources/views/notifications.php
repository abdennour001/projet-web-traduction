<div class="row">
    <div class="col-12">
        <h1 class="text-black-50 mb-5 text-center">Vos Notifications</h1>
        <?php

            $result = Notification::paginate(5);

            $result_filtered = array_filter($result['result'], function ($array) {
                if ($array->id_user == Auth::id()) return true;
                else return false;
            });

        ?>
        <?php if (count($result_filtered) <= 0) : ?>
            <div class="text-muted text-center">
                Vous n'avez pas des notifications.
            </div>
        <?php endif; ?>
        <div class="list-group list-group-flush">
            <?php foreach ($result_filtered as $notification) :?>
                <?php if ($notification->id_user == Auth::id()) : ?>
                    <a href="#" class="list-group-item
                    list-group-item-action
                    flex-column
                    align-items-start
                    <?php echo $notification->vu ? "" : "list-group-item-info"?>">
                        <div class="d-flex w-100 justify-content-between">
                            <h5><?php echo $notification->title ?></h5>
                            <p class="text-muted"><?php echo substr($notification->created_at, 0, 16) ?></p>
                        </div>
                        <p class="m-0 mt-2 text-muted"><?php echo $notification->description ?></p>
                    </a>
                <?php endif;?>
            <?php

                $notification->vu = 1;
                $notification->update();

                ?>
            <?php endforeach; ?>
        </div>

        <?php if (count($result_filtered) > 0) : ?>
            <ul class="pagination justify-content-center mt-5">
                <li class="page-item <?php if($result['page_no'] <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($result['page_no'] <= 1){ echo '#'; } else { echo "?page_no=".($result['page_no'] - 1)."#mainContent"; } ?>">Prev</a>
                </li>

                <?php for ($i=1; $i<=$result['total_pages']; $i++) :?>
                    <li class="page-item <?php if ($i == $result['page_no']) {echo 'active'; }?>">
                        <a class="page-link <?php if ($i == $result['page_no']) {echo 'text-white'; }?> " href="<?php echo '?page_no='.$i.'#mainContent'; ?>"><?php echo $i?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if($result['page_no'] >= $result['total_pages']){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($result['page_no'] >= $result['total_pages']){ echo '#'; } else { echo "?page_no=".($result['page_no'] + 1)."#mainContent"; } ?>">Next</a>
                </li>
            </ul>
        <?php endif; ?>

    </div>
</div>

<style>
</style>
