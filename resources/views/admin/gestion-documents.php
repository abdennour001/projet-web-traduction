<div class="row">
    <div class="col-12 text-center">
        <div class="ui icon header">
            <i class="archive icon" style="color: dodgerblue"></i>
            <h2 class="content mt-4">
                Gestions des documents
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
                <th data-field="id" data-sortable="true">#</th>
                <th  data-sortable="true">Date</th>
                <th>Path</th>
                <th>Type</th>
                <th  data-sortable="true">#Devis</th>
                <th  data-sortable="true">#Traduction</th>
                <th  data-sortable="true">Client</th>
                <th  data-sortable="true">Traducteur</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <?php $list = $this->_data["list_documents"]; ?>
            <?php if (empty($list)) : ?>
                <tr>
                    <td class="justify-content-center" colspan="9">Aucune donnée disponible</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($list as $document) : ?>
                <tr>
                    <td><?php echo $document->id_document; ?></td>
                    <td><?php echo substr($document->date, 0, 16) ?></td>
                    <?php if ($document->id_devis == 0) : ?>
                        <td class="text-secondary"><?php echo document_name($document->path, $type = 'document-traduit-traduction')?></td>
                    <?php else : ?>
                        <td class="text-secondary"><?php echo document_name($document->path, $type = 'document-source-devis')?></td>
                    <?php endif; ?>
                    <?php if ($document->id_devis == 0) : ?>
                        <td class="text-success">Traduit</td>
                    <?php else : ?>
                        <td class="text-info">Source</td>
                    <?php endif; ?>
                    <td><?php echo $document->id_devis == 0 ? "---" : $document->id_devis; ?></td>
                    <td><?php echo $document->traduction()->id_traduction; ?></td>
                    <?php if ($document->id_devis != 0) : ?>
                        <td><?php echo $document->devis()->client()->user()->nom . " " . $document->devis()->client()->user()->prenom ; ?></td>
                        <td><?php echo $document->devis()->traducteurs()[0]->user()->nom . " " . $document->devis()->traducteurs()[0]->user()->prenom; ?></td>
                    <?php else : ?>
                        <td></td>
                        <td></td>
                    <?php endif; ?>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="javascript:void(0)"
                               class="btn btn-outline-danger mr-2"
                               data-toggle="modal" data-target="#exampleModal5"
                            >
                                <i class="fas fa-times mr-2"></i>
                                <b>Supprimer</b>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead">Voulez-vous vraiment supprimer ce document ?</p>
                <p class="alert alert-warning">
                    <span class="blockquote" style="display: block;">
                        <i class="fa fa-exclamation-triangle mr-2"></i>
                        Attention!
                    </span>
                    Le devis et la traduction de ce document seront également supprimées.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-outline-danger" href="<?php echo url('/admin/gestion-documents/delete?id_document='.$document->id_document); ?>">Supprimer</a>
            </div>
        </div>
    </div>
</div>
