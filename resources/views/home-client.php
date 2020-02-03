<div class="row">
    <div class="col-12">

        <h1 class="text-black-50 text-center">Activités récentes</h1>
        <hr class="w-25 my-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-black-50 text-center">Vos Devis</h2>

                <?php $result = Devis::paginate(5, $page_no = "page_no_1", $total_pages = "total_pages_1"); ?>
                <table class="table table-striped table-hover mt-4">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type</th>
                        <th scope="col">Etat</th>
                        <th scope="col">Traducteur</th>
                        <th scope="col">Assermenté</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result['result']  as $devis) :?>
                        <?php if ($devis->id_client == Auth::id()) : ?>
                            <tr class='clickable-row' data-href='<?php echo url("/demande-devis?id_devis={$devis->id_devis}") ?>'>
                                <th scope="row"><?php echo $devis->id_devis;?></th>
                                <td><?php echo $devis->type_traduction;?></td>
                                <?php if ($devis->etat == 'pas-encore-repondu') :?>
                                    <td class="text-danger">En attente</td>
                                <?php elseif ($devis->etat == 'refuse') : ?>
                                    <td class="text-danger font-weight-bold"><?php echo "Refusé";?></td>
                                <?php else : ?>
                                    <td class="text-success"><?php echo "Repondu";?></td>
                                <?php endif; ?>
                                <?php if (!empty($devis->traducteurs())) : ?>
                                    <td><?php echo $devis->traducteurs()[0]->user()->nom . " " . $devis->traducteurs()[0]->user()->prenom ?></td>
                                <?php else : ?>
                                    <td class="text-danger">N/D</td>
                                <?php endif; ?>
                                <td class="<?php if ($devis->traducteur_assermente == 1) echo "text-success"; else echo "text-danger"; ?>"><?php if ($devis->traducteur_assermente == 1) echo "Oui"; else echo "Non"; ?></td>
                                <td><?php echo substr($devis->date, 0, 16);?></td>
                            </tr>
                        <?php endif;?>
                    <?php endforeach; ?>
                    <?php if (empty($result['result'])) : ?>
                        <tr>
                            <td colspan="7">Vous n'avez pas des devis.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>

                <ul class="pagination justify-content-center mt-5">
                    <li class="page-item <?php if($result['page_no_1'] <= 1){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($result['page_no_1'] <= 1){ echo '#'; } else { echo "?page_no_1=".($result['page_no_1'] - 1)."#mainContent"; } ?>">Prev</a>
                    </li>

                    <?php for ($i=1; $i<=$result['total_pages_1']; $i++) :?>
                        <li class="page-item <?php if ($i == $result['page_no_1']) {echo 'active'; }?>">
                            <a class="page-link <?php if ($i == $result['page_no_1']) {echo 'text-white'; }?> " href="<?php echo '?page_no_1='.$i.'#mainContent'; ?>"><?php echo $i?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?php if($result['page_no_1'] >= $result['total_pages_1']){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($result['page_no_1'] >= $result['total_pages_1']){ echo '#'; } else { echo "?page_no_1=".($result['page_no_1'] + 1)."#mainContent"; } ?>">Next</a>
                    </li>
                </ul>
            </div>
        </div>


<!--        gestion des traductions-->


        <div class="row mt-5">
            <div class="col-12">
                <h2 class="text-black-50 text-center">Vos Demandes de traduction</h2>

                <?php $result = Traduction::paginate(5); ?>
                <table class="table table-striped table-hover mt-4">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Etat</th>
                        <th scope="col">#Devis</th>
                        <th scope="col">Traducteur</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result['result']  as $traduction) :?>
                        <?php if ($traduction->devis()->client()->id_client == Auth::id()) : ?>
                            <tr class='clickable-row' data-href='<?php echo url("/demande-traduction?id_traduction={$traduction->id_traduction}") ?>'>
                                <th scope="row"><?php echo $traduction->id_traduction;?></th>
                                <?php if ($traduction->etat == 'pas-encore-demarre') :?>
                                    <td class="text-danger">En attente</td>
                                <?php elseif($traduction->etat == 'en-cours') : ?>
                                    <td class="text-primary">En cours</td>
                                <?php elseif($traduction->etat == 'finis') : ?>

                                    <?php if ($traduction->note == -1) : ?>
                                        <td class="text-danger font-weight-bold">
                                            <i class="fa fa-exclamation-triangle mr-2"></i>
                                            Signalé
                                        </td>
                                    <?php else : ?>
                                        <td class="text-success font-weight-bold">Finis</td>
                                    <?php endif; ?>

                                <?php elseif($traduction->etat == 'abandonne') : ?>
                                    <td class="text-danger font-weight-bold">Abandonné</td>
                                <?php endif; ?>
                                <td><?php echo $traduction->devis()->id_devis;?></td>
                                <?php if (!empty($traduction->devis()->traducteurs())) : ?>
                                    <td><?php echo $traduction->devis()->traducteurs()[0]->user()->nom . " " . $traduction->devis()->traducteurs()[0]->user()->prenom ?></td>
                                <?php else : ?>
                                    <td class="text-danger">N/D</td>
                                <?php endif; ?>
                                <td><?php echo substr($traduction->date, 0, 16);?></td>
                            </tr>
                        <?php endif;?>
                    <?php endforeach; ?>
                    <?php if (empty($result['result'])) : ?>
                        <tr>
                            <td colspan="5 text-center">Vous n'avez pas des demandes de traduction.</td>
                        </tr>
                    <?php endif; ?>
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
        </div>

    </div>
</div>
