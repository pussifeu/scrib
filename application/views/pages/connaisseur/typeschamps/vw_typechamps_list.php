<div class="row">
    <div class="col-lg-12" style="margin-top: 10px">
        <div class="panel panel-default" style="border-color: #ddd;">
            <div class="panel-heading">
                <span class="panel-title"><?= $this->lang->line('label_typeschamp_manage'); ?></span>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary dropdown-toggle"  onclick="createModal('create-typechamp')"  data-toggle="modal" id="btn-create-lot" aria-expanded="false" style="margin-top: 3px">
                        <?= $this->lang->line('label_typeschamp_creation'); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="panel panel-default" style="margin-top: 10px">
            <div class="panel-body">
                <table width="100%" class="table table-hover dataTablesProjects" id="dataTables-typeschamps">
                    <thead>
                    <tr>
                        <th class="col-md-3"><?= $this->lang->line('label_typeschamp_name'); ?></th>
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($typeschamps as $typeschamp): ?>
                        <tr>
                            <td class="center">
                                <a href="#"
                                   class="typeschamp-name"
                                   id="typeschamp-name-<?= $typeschamp->TYPC_ID ?>" data-pk="TYPC_LIBELLE" data-type="text"
                                   data-url="<?= base_url("connaisseur/typedeschamps/update/$typeschamp->TYPC_ID") ?>"> <?= $typeschamp->TYPC_LIBELLE ?>
                                </a>
                            </td>
                            <td class="center">
                                <a href="#"
                                   data-href ="<?= base_url('connaisseur/typechamps/delete/'.$typeschamp->TYPC_ID) ?>"
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