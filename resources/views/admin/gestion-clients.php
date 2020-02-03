<div class="row">
    <div class="col-12 text-center">
        <div class="ui icon header">
            <i class="address book outline icon" style="color: dodgerblue"></i>
            <h2 class="content mt-4">
                Gestions des clients
            </h2>
        </div>
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

    <div class="col-12 mt-5">
        <table class="table table-hover table-striped"
               data-show-search-button="true"
               data-page-size="5"
               data-search="true"
               data-toggle="table"
               data-pagination="true">
            <thead style="border-top: 2px solid dodgerblue">
            <tr>
                <th data-sortable="true">#</th>
                <th data-sortable="true">Nom</th>
                <th data-sortable="true">Prénom</th>
                <th data-sortable="true">Email</th>
                <th>Numéro</th>
                <th>Fax</th>
                <th data-sortable="true">Commune</th>
                <th data-sortable="true">Wilaya</th>
                <th data-sortable="true">Adresse</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <?php $list = $this->_data["list_clients"]; ?>
            <?php if (empty($list)) : ?>
                <tr>
                    <td class="justify-content-center" colspan="3">Aucune donnée disponible</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($list as $client) : ?>
                <?php $user = $client->user(); ?>
                <tr>
                    <td><?php echo $client->id_client; ?></td>
                    <td><?php echo $user->nom ?></td>
                    <td><?php echo $user->prenom; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->numero; ?></td>
                    <td><?php echo $user->fax; ?></td>
                    <td><?php echo $user->commune; ?></td>
                    <td><?php echo $user->wilaya; ?></td>
                    <td><?php echo $user->adresse; ?></td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="" class="btn btn-outline-primary mr-2">
                                <i class="fas fa-pen small mr-2"></i>
                                <b>Modifier</b>
                            </a>
                            <?php if (Blocked::where(["id_user" => $user->id_user]) == null) : ?>
                                <a href="<?php echo url('/admin/block?id_user=' . $user->id_user) . "&url=gestion-clients" ?>" class="btn btn-outline-danger">
                                    <i class="fas fa-times mr-2"></i>
                                    <b>Bloquer</b>
                                </a>
                            <?php else : ?>
                                <a href="<?php echo url('/admin/unblock?id_user=' . $user->id_user) . "&url=gestion-clients" ?>" class="btn btn-outline-danger">
                                    <i class="fas fa-times mr-2"></i>
                                    <b>Débloquer</b>
                                </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
