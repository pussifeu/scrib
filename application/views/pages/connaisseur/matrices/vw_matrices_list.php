<div class="row">
    <div class="col-lg-12" style="margin-top: 10px">
        <div class="panel panel-default" style="border-color: #ddd;">
            <div class="panel-heading">
                <span class="panel-title"><?= $this->lang->line('label_matrices_manage'); ?></span>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary dropdown-toggle" onclick="createModal('create-matrices')" data-toggle="modal" id="btn-create-matrices" aria-expanded="false" style="margin-top: 3px">
                        <?= $this->lang->line('label_matrices_creation'); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="panel panel-default" style="margin-top: 10px">
            <div class="panel-body">
                <table width="100%" class="table table-hover dataTablesProjects" id="dataTables-matrices">
                    <thead>
                    <tr>
                        <th class="col-md-2"><?= $this->lang->line('label_references_name'); ?></th>
                        <th class="col-md-2"><?= $this->lang->line('label_ss_references_name'); ?></th>
                        <th class="col-md-1"><?= $this->lang->line('label_matrices_name'); ?></th>
                        <th class="col-md-2"><?= $this->lang->line('label_matrices_doc_ref'); ?></th>
                        <th class="col-md-2"><?= $this->lang->line('label_matrices_version'); ?></th>
                        <th class="col-md-2"><?= $this->lang->line('label_matrices_resume'); ?></th>
                        <th class="col-md-2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($matrices as $matrice): ?>
                        <tr>
                            <td class="center"><?= $matrice->REFERENCE_LIBELLE ?></td>
                            <td class="center"><?= $matrice->SS_REFERENCE_LIBELLE ?></td>
                            <td class="center">
                                <a href="#"
                                   class="matrices-name"
                                   id="matrices-name-<?= $matrice->MATRICES_ID ?>" data-pk="MATRICES_NAME" data-type="text"
                                   data-url="<?= base_url("connaisseur/matrices/update/$matrice->MATRICES_ID") ?>"> <?= $matrice->MATRICES_NAME ?>
                                </a>
                            </td>

                            <td class="center">
                                <a href="#"
                                   class="matrices-name"
                                   id="matrices-doc-ref-<?= $matrice->MATRICES_ID ?>" data-pk="MATRICES_DOC_REF" data-type="text"
                                   data-url="<?= base_url("connaisseur/matrices/update/$matrice->MATRICES_ID") ?>"> <?= $matrice->MATRICES_DOC_REF ?>
                                </a>
                            </td>


                            <td class="center">
                                <a href="#"
                                   class="matrices-name"
                                   id="matrices-version-<?= $matrice->MATRICES_ID ?>" data-pk="MATRICES_VERSION" data-type="text"
                                   data-url="<?= base_url("connaisseur/matrices/update/$matrice->MATRICES_ID") ?>"> <?= $matrice->MATRICES_VERSION ?>
                                </a>
                            </td>


                            <td class="center">
                                <a href="#"
                                   class="matrices-name"
                                   id="matrices-resume-<?= $matrice->MATRICES_ID ?>" data-pk="MATRICES_RESUME" data-type="textarea"
                                   data-url="<?= base_url("connaisseur/matrices/update/$matrice->MATRICES_ID") ?>"> <?= $matrice->MATRICES_RESUME ?>
                                </a>
                            </td>

                            <td class="center">

                                <a href="<?= base_url('connaisseur/matrices/detail/'.$matrice->MATRICES_ID) ?>"
                                        class="btn btn-sm btn-primary display-form-edit"
                                        data-placement = "right"
                                        data-toggle="modal"
                                        data-original-title="Modifier">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="#"
                                   data-href ="<?= base_url('connaisseur/matrices/delete/'.$matrice->MATRICES_ID) ?>"
                                   class="btn btn-sm btn-danger"
                                   data-placement="right"
                                   data-target="#confirm-delete"
                                   data-original-title="Supprimer"
                                   data-toggle="modal">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>