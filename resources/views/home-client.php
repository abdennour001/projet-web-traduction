<div class="text-center">
    <h1 class="text-black-50">Activités récentes</h1>
    <?php $result = Devis::paginate(5); ?>
    <table class="table table-striped table-hover mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">Commentaire</th>
                <th scope="col">Etat</th>
                <th scope="col">Assermenté</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result['result']  as $devis) :?>
                <?php if ($devis->id_client == Auth::id()) : ?>
                    <tr>
                        <th scope="row"><?php echo $devis->id_devis;?></th>
                        <td><?php echo $devis->type_traduction;?></td>
                        <td><?php echo $devis->commentaires;?></td>
                        <?php if ($devis->etat == 'pas-encore-demarre') :?>
                            <td>En attente</td>
                        <?php else : ?>
                            <td><?php echo $devis->etat;?></td>
                        <?php endif; ?>
                        <td><?php if ($devis->traducteur_assermente == 1) echo "Oui"; else echo "Non"; ?></td>
                        <td><?php echo $devis->date;?></td>
                    </tr>
                <?php endif;?>
            <?php endforeach; ?>
        </tbody>
    </table>

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

</div>
