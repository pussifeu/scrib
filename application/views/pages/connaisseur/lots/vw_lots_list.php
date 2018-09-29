<div class="row">
    <div class="col-lg-12" style="margin-top: 10px">
        <div class="panel panel-default" style="border-color: #ddd;">
            <div class="panel-heading">
                <span class="panel-title"><?= $this->lang->line('label_lots_manage'); ?></span>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary dropdown-toggle"  onclick="createModal('create-lot')"  data-toggle="modal" id="btn-create-lot" aria-expanded="false" style="margin-top: 3px">
                        <?= $this->lang->line('label_lots_creation'); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="panel panel-default" style="margin-top: 10px">
            <div class="panel-body">
                <table width="100%" class="table table-hover dataTablesProjects" id="dataTables-lots">
                    <thead>
                    <tr>
                        <th class="col-md-3"><?= $this->lang->line('label_lots_perimeter'); ?></th>
                        <th class="col-md-3"><?= $this->lang->line('label_lots_name'); ?></th>
                        <th class="col-md-3"><?= $this->lang->line('label_lots_description'); ?></th>
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lots as $lot): ?>
                        <tr>
                            <td class="center">
                                <a href="#"
                                   class="lot-perimeter"
                                   id="lot-perimeter-<?= $lot->LOT_ID ?>"
                                   data-pk="LOT_PER_ID"
                                   data-type="select"
                                   data-value="<?= $lot->LOT_PER_ID ?>"
                                   data-url="<?= base_url("connaisseur/lots/update/$lot->LOT_ID") ?>">
                                </a>
                            </td>

                            <script>
                                $(function(){
                                    $('#lot-perimeter-<?= $lot->LOT_ID ?>').editable({
                                        source: <?= $perimeters_json ?>
                                    });
                                });
                            </script>
                            <td class="center">
                                <a href="#"
                                   class="lot-name"
                                   id="lot-name-<?= $lot->LOT_ID ?>"
                                   data-pk="LOT_LIBELLE"
                                   data-type="text"
                                   data-url="<?= base_url("connaisseur/lots/update/$lot->LOT_ID") ?>"> <?= $lot->LOT_LIBELLE ?>
                                </a>
                            </td>
                            <td>
                                <a href="#"
                                   class="lot-description"
                                   id="lot-description-<?= $lot->LOT_ID ?>" data-pk="LOT_DESCRIPTION" data-type="text"
                                   data-url="<?= base_url("connaisseur/lots/update/$lot->LOT_ID") ?>"> <?= $lot->LOT_DESCRIPTION?>
                                </a>
                            </td>

                            <td class="center">
                                <a href="#"
                                   data-href ="<?= base_url('connaisseur/lots/delete/'.$lot->LOT_ID) ?>"
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