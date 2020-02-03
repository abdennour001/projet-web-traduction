<div class="row">
    <div class="col-12 text-center">
        <div class="ui icon header">
            <i class="clipboard icon" style="color: dodgerblue"></i>
            <h2 class="content mt-4">
                Gestions des traductions
            </h2>
        </div>
    </div>

    <div class="col-12 text-left mb-5">
        <h2>Filtrer par:</h2>
        <form action="#">
            <div class="form-group" style="width: 30%">
                <div class="d-flex justify-content-center align-items-baseline">
                    <label for="ass" class="lead w-50">Etat</label>
                    <select id="ass" class="custom-select mr-5" name="ass">
                        <option value="tous" selected>Tous</option>
                        <option value="pas-encore-repondu">Pas encore répondu</option>
                        <option value="refuse">Réfusé</option>
                        <option value="repondu">Répondu</option>
                    </select>

                    <button id="signin" type="submit" class="btn btn-secondary ml-5">Filtrer</button>

                </div>
            </div>
        </form>
    </div>

    <div class="col-12">
        <table  id="dtBasicExample" class="table table-hover table-striped"
                data-show-search-button="true"
                data-page-size="5"
                data-search="true"
                data-toggle="table"
                data-pagination="true">
            <thead style="border-top: 2px solid dodgerblue">
            <tr>
                <th data-sortable="true">#</th>
                <th>Type</th>
                <th data-sortable="true">Source</th>
                <th data-sortable="true">Destination</th>
                <th>Etat</th>
                <th data-sortable="true">Traducteur</th>
                <th data-sortable="true">Client</th>
                <th data-sortable="true">#Devis</th>
                <th data-sortable="true">Prix</th>
                <th>Document traduit</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <?php $list = $this->_data["list_traductions"]; ?>
            <?php if (empty($list)) : ?>
                <tr>
                    <td class="justify-content-center" colspan="11">Aucune donnée disponible</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($list as $traduction) : ?>
                <tr>
                    <td><?php echo $traduction->id_devis ?></td>
                    <td><?php echo $traduction->devis()->type_traduction ?></td>
                    <td><?php echo utf8_encode($traduction->devis()->langueSource()->nom) ?></td>
                    <td><?php echo utf8_encode($traduction->devis()->langueDestination()->nom) ?></td>
                    <td>
                        <?php if ($traduction->etat == 'pas-encore-demarre') :?>
                            <span class="text-danger">En attente</span>
                        <?php elseif ($traduction->etat == 'en-cours') : ?>
                            <span class="text-primary">En cours</span>
                        <?php elseif ($traduction->etat == 'finis') : ?>

                            <?php if ($traduction->note == -1) : ?>
                                <span class="text-danger">
                                    <i class="fa fa-exclamation-triangle mr-2"></i>
                                    Signalé
                                </span>
                            <?php else : ?>
                                <span class="text-success">Finis</span>
                            <?php endif; ?>

                        <?php elseif ($traduction->etat == 'abandonne') : ?>
                            <span class="text-danger font-weight-bolder">Abandonné</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($traduction->devis()->traducteurs())) : ?>
                            <?php echo $traduction->devis()->traducteurs()[0]->user()->nom . " " . $traduction->devis()->traducteurs()[0]->user()->prenom ?>
                        <?php else : ?>
                            N/D
                        <?php endif; ?>
                    </td>
                    <td>
                        <span><?php echo $traduction->devis()->client()->user()->nom . " " . $traduction->devis()->client()->user()->prenom ?></span>
                    </td>
                    <td>
                        <?php echo $traduction->devis()->id_devis;?>
                    </td>
                    <td>
                        <span><?php echo $traduction->devis()->etat != 'repondu' ? "- - - -" : $traduction->devis()->prix ?></span>
                    </td>
                    <td>
                        <a id="goToFile" href="#" style="text-decoration: none" target="_self">
                            Vérifier
                        </a>
                    </td>
                    <td>
                        <a href="" class="btn btn-outline-danger">
                            <i class="fas fa-times mr-2"></i>
                            <b>Supprimer</b>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>
