<div class="row">
    <div class="col-lg-12" style="margin-top: 10px">
        <div class="panel panel-default" style="border-color: #ddd;">
            <div class="panel-heading">
                <span class="panel-title"><?= $this->lang->line('label_perimeters_manage'); ?></span>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary dropdown-toggle" onclick="createModal('create-perimeter')" data-toggle="modal" id="btn-create-perimeter" aria-expanded="false" style="margin-top: 3px">
                        <?= $this->lang->line('label_perimeters_creation'); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="panel panel-default" style="margin-top: 10px">
            <div class="panel-body">
                <table width="100%" class="table table-hover dataTablesProjects" id="dataTables-perimeters">
                    <thead>
                    <tr>
                        <th class="col-md-3"><?= $this->lang->line('label_perimeters_name'); ?></th>
                        <th class="col-md-3"><?= $this->lang->line('label_perimeters_description'); ?></th>
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($perimeters as $perimeter): ?>
                        <tr>
                            <td class="center">
                                <a href="#"
                                   class="perimeter-name"
                                   id="perimeter-name-<?= $perimeter->PER_ID ?>" data-pk="PER_LIBELLE" data-type="text"
                                   data-url="<?= base_url("connaisseur/perimeters/update/$perimeter->PER_ID") ?>"> <?= $perimeter->PER_LIBELLE ?>
                                </a>
                            </td>
                            <td>
                                <a href="#"
                                   class="perimeter-description"
                                   id="perimeter-description-<?= $perimeter->PER_ID ?>" data-pk="PER_DESCRIPTION" data-type="text"
                                   data-url="<?= base_url("connaisseur/perimeters/update/$perimeter->PER_ID") ?>"> <?= $perimeter->PER_DESCRIPTION?>
                                </a>
                            </td>

                            <td class="center">
                                <a href="#"
                                   data-href ="<?= base_url('connaisseur/perimeters/delete/'.$perimeter->PER_ID) ?>"
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