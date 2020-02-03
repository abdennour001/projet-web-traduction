<div class="row">
    <div class="col-12 text-center mb-5">
        <div class="ui icon header">
            <i class="address book icon" style="color: dodgerblue"></i>
            <h2 class="content mt-4">
                Gestions des traducteurs
            </h2>
        </div>
    </div>
    <div class="col-12 text-left mb-4">
        <h2>Filtrer par:</h2>
        <form action="#">
            <div class="form-group w-75">
                <div class="d-flex justify-content-center align-items-baseline">
                    <label for="ass" class="lead w-100">Traducteur Assermenté</label>
                    <select id="ass" class="custom-select mr-5" name="ass">
                        <option value="-1" selected>Tous</option>
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>

                    <label for="ass" class="lead w-100">Traducteur Approuvé</label>
                    <select id="ass" class="custom-select" name="ass">
                        <option value="-1" selected>Tous</option>
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>

                    <button id="signin" type="submit" class="btn btn-secondary ml-5">Filtrer</button>

                </div>
            </div>
        </form>
    </div>
    <div class="col-12 mt-4">
        <?php if (Session::has('controller-msg')) : ?>
            <div class="alert alert-success border-success alert-dismissible fade show" role="alert">
                <?php
                echo Session::get('controller-msg');
                Session::forget('controller-msg');
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-12 mb-5">
        <table  id="dtBasicExample" class="table table-hover table-striped table-borderless"
                data-show-search-button="true"
                data-page-size="5"
                data-search="true"
                data-toggle="table"
                data-pagination="true">
            <thead style="border-top: 2px solid dodgerblue">
                <tr>
                    <th data-field="id" data-sortable="true">#</th>
                    <th data-sortable="true">Nom</th>
                    <th data-sortable="true">Prénom</th>
                    <th data-sortable="true">Email</th>
                    <th>Assermenté</th>
                    <th>Approuvé</th>
                    <th>Numéro</th>
                    <th>Fax</th>
                    <th>Commune</th>
                    <th data-sortable="true">Wilaya</th>
                    <th data-sortable="true">Adresse</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
            <?php $list = $this->_data["list_traducteurs"]; ?>
            <?php if (empty($list)) : ?>
                <tr>
                    <td class="justify-content-center" colspan="3">Aucune donnée disponible</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($list as $translator) : ?>
            <?php $user = $translator->user(); ?>
                <tr>
                    <td><?php echo $translator->id_traducteur; ?></td>
                    <td><?php echo $user->nom ?></td>
                    <td><?php echo $user->prenom; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td class="<?php echo $translator->est_assermente ? "text-success" : "text-danger" ?>"><?php echo $translator->est_assermente ? "Oui" : "Non" ; ?></td>
                    <td class="<?php echo $translator->est_approuve ? "text-success" : "text-danger" ?>"><?php echo $translator->est_approuve ? "Oui" : "Non" ; ?></td>
                    <td><?php echo $user->numero; ?></td>
                    <td><?php echo $user->fax; ?></td>
                    <td><?php echo $user->commune; ?></td>
                    <td><?php echo $user->wilaya; ?></td>
                    <td><?php echo $user->adresse; ?></td>
                    <td>
                        <div class="d-flex justify-content-start flex-wrap">
                            <?php if ( !$translator->est_approuve && $translator->demande() != null ) : ?>
                                <a href="<?php echo url('/admin/gestion-traducteurs/approve?id_traducteur='.$translator->id_traducteur) ?>" class="btn btn-outline-success mr-2 mb-2">
                                    <i class="fas fa-check mr-2"></i>
                                    <b>Approuver</b>
                                </a>
                                <a href="<?php echo url('/admin/gestion-traducteurs/disapprove?id_traducteur='.$translator->id_traducteur) ?>" class="btn btn-outline-danger mr-2">
                                    <i class="fas fa-times mr-2"></i>
                                    <b>Désapprouver</b>
                                </a>
                            <?php elseif (!$translator->est_approuve && $translator->demande() == null) :  ?>
                                <?php if (Blocked::where(["id_user" => $translator->id_traducteur]) != null) : ?>
                                    <a href="<?php echo url('/admin//unblock?id_user=' . $translator->id_traducteur) ?>" class="btn btn-outline-danger">
                                        <i class="fas fa-times mr-2"></i>
                                        <b>Débloquer</b>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php echo url('/admin/block?id_user=' . $translator->id_traducteur) . "&url=gestion-traducteurs" ?>" class="btn btn-outline-danger">
                                        <i class="fas fa-times mr-2"></i>
                                        <b>Bloquer</b>
                                    </a>
                                <?php endif; ?>
                            <?php else : ?>
                                <a href="" class="btn btn-outline-primary mr-2">
                                    <i class="fas fa-pen mr-2"></i>
                                    <b>Modifier</b>
                                </a>
                                <?php if (Blocked::where(["id_user" => $translator->id_traducteur]) != null) : ?>
                                    <a href="<?php echo url('/admin/unblock?id_user=' . $translator->id_traducteur) ?>" class="btn btn-outline-danger">
                                        <i class="fas fa-times mr-2"></i>
                                        <b>Débloquer</b>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php echo url('/admin/block?id_user=' . $translator->id_traducteur) . "&url=gestion-traducteurs" ?>" class="btn btn-outline-danger">
                                        <i class="fas fa-times mr-2"></i>
                                        <b>Bloquer</b>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
