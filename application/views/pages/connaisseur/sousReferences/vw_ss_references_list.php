<div class="row">
    <div class="col-lg-12" style="margin-top: 10px">
        <div class="panel panel-default" style="border-color: #ddd;">
            <div class="panel-heading">
                <span class="panel-title"><?= $this->lang->line('label_references_manage'); ?></span>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary dropdown-toggle"  onclick="createModal('create-lot')"  data-toggle="modal" id="btn-create-lot" aria-expanded="false" style="margin-top: 3px">
                        <?= $this->lang->line('label_references_creation'); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="panel panel-default" style="margin-top: 10px">
            <div class="panel-body">
                <table width="100%" class="table table-hover dataTablesProjects" id="dataTables-ss-references">
                    <thead>
                    <tr>
                        <th class="col-md-3"><?= $this->lang->line('label_references_name'); ?></th>
                        <th class="col-md-3"><?= $this->lang->line('label_ss_references_name'); ?></th>
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ssReferences as $ssReference): ?>
                        <tr>
                            <td class="center">
                                <a href=""
                                   class="reference-name"
                                   id="reference-name-<?= $ssReference->SS_REFERENCE_ID ?>"
                                   data-pk="REFERENCE_ID"
                                   data-type="text"
                                   data-value="<?= $ssReference->REFERENCE_ID ?>"
                                   data-url="<?= base_url("connaisseur/lots/update/$ssReference->SS_REFERENCE_ID") ?>"><?= $ssReference->REFERENCE_LIBELLE ?>
                                </a>
                            </td>
                            <script>
                                $(function(){
                                    $('#reference-name--<?= $ssReference->SS_REFERENCE_ID ?>').editable({
                                        source: <?= $references_json ?>
                                    });
                                });
                            </script>
                            <td class="center">
                                <a href="#"
                                   class="ss-reference-name"
                                   id="ss-reference-name-<?= $ssReference->SS_REFERENCE_ID ?>"
                                   data-pk="SS_REFERENCE_LIBELLE"
                                   data-type="text"
                                   data-url="<?= base_url("connaisseur/sousReferences/update/$ssReference->SS_REFERENCE_ID") ?>"> <?= $ssReference->SS_REFERENCE_LIBELLE ?>
                                </a>
                            </td>

                            <td class="center">
                                <a href="#"
                                   data-href ="<?= base_url('connaisseur/sousReferences/delete/'.$ssReference->SS_REFERENCE_ID) ?>"
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