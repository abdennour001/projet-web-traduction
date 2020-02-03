<div class="row">
    <div class="col-12 text-center mb-5">
        <div class="ui icon header">
            <i class="tasks icon" style="color: dodgerblue"></i>
            <h2 class="content mt-4">
                Gestions des devis
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
                <th data-sortable="true">Type</th>
                <th data-sortable="true">Source</th>
                <th data-sortable="true">Destination</th>
                <th>Etat</th>
                <th data-sortable="true">Traducteur</th>
                <th data-sortable="true">Client</th>
                <th data-sortable="true">Prix</th>
                <th data-sortable="true">Date</th>
                <th>Document</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <?php $list = $this->_data["list_devis"]; ?>
            <?php if (empty($list)) : ?>
                <tr>
                    <td class="justify-content-center" colspan="3">Aucune donnée disponible</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($list as $devis) : ?>
                <tr>
                    <td><?php echo $devis->id_devis ?></td>
                    <td><?php echo $devis->type_traduction ?></td>
                    <td><?php echo utf8_encode($devis->langueSource()->nom) ?></td>
                    <td><?php echo utf8_encode($devis->langueDestination()->nom) ?></td>
                    <td>
                        <?php if ($devis->etat == 'pas-encore-repondu') :?>
                            <span class="text-danger">En attente</span>
                        <?php elseif ($devis->etat == 'refuse') : ?>
                            <span class="text-danger font-weight-bold">Refusé</span>
                        <?php else : ?>
                            <span class="text-success">Répondu</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($devis->traducteurs())) : ?>
                            <?php echo $devis->traducteurs()[0]->user()->nom . " " . $devis->traducteurs()[0]->user()->prenom ?>
                        <?php else : ?>
                            N/D
                        <?php endif; ?>
                    </td>
                    <td>
                        <span><?php echo $devis->client()->user()->nom . " " . $devis->client()->user()->prenom ?></span>
                    </td>
                    <td>
                        <span><?php echo $devis->etat != 'repondu' ? "- - - -" : $devis->prix ?></span>
                    </td>
                    <td>
                        <?php echo substr($devis->date, 0, 16) ?>
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
