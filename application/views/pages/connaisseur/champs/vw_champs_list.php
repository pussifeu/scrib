<div class="row">
    <div class="col-lg-12" style="margin-top: 10px">
        <div class="panel panel-default" style="border-color: #ddd;">
            <div class="panel-heading">
                <span class="panel-title"><?= $this->lang->line('label_champs_manage'); ?></span>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary dropdown-toggle" onclick="createModal('create-champs')" data-toggle="modal" id="btn-create-champs" aria-expanded="false" style="margin-top: 3px">
                        <?= $this->lang->line('label_champs_creation'); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="panel panel-default" style="margin-top: 10px">
            <div class="panel-body">
                <table width="100%" class="table table-hover dataTablesProjects" id="dataTables-champs">
                    <thead>
                        <tr>
                            <th class="col-md-2"><?= $this->lang->line('label_champs_value'); ?></th>
                            <th class="col-md-2"><?= $this->lang->line('label_champs_type'); ?></th>
                            <th class="col-md-2"><?= $this->lang->line('label_champs_default_value'); ?></th>
                            <th class="col-md-2"><?= $this->lang->line('label_champs_msg_help'); ?></th>
                            <th class="col-md-2"><?= $this->lang->line('label_champs_libelle'); ?></th>
                            <th class="col-md-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($champs as $champ): ?>
                        <tr>
                            <td class="center">
                                <a href="#"
                                   class="champs-name"
                                   id="champs-val-<?= $champ->CHAMPS_ID ?>"
                                   data-pk="CHAMPS_VAL"
                                   data-type="text"
                                   data-url="<?= base_url("connaisseur/champs/update/$champ->CHAMPS_ID") ?>"> <?= $champ->CHAMPS_VAL ?>
                                </a>
                            </td>

                            <td class="center">
                                <a href="#"
                                   class="champs-name"
                                   id="champs-type-<?= $champ->CHAMPS_ID ?>"
                                   data-pk="CHAMPS_TYPE_ID"
                                   data-value="<?= $champ->CHAMPS_TYPE_ID ?>"
                                   data-type="select"
                                   data-url="<?= base_url("connaisseur/champs/update/$champ->CHAMPS_ID") ?>">
                                </a>
                            </td>

                            <script>
                                $(function(){
                                    $('#champs-type-<?= $champ->CHAMPS_ID ?>').editable({
                                        source: <?= $typeschampsjson ?>
                                    });
                                });
                            </script>

                            <td class="center">
                                <a href="#"
                                   class="champs-name"
                                   id="champs-default-value-<?= $champ->CHAMPS_ID ?>"
                                   data-pk="CHAMPS_DEFAULT_VALUE"
                                   data-type="text"
                                   data-url="<?= base_url("connaisseur/champs/update/$champ->CHAMPS_ID") ?>"> <?= $champ->CHAMPS_DEFAULT_VALUE ?>
                                </a>
                            </td>

                            <td class="center">
                                <a href="#"
                                   class="champs-name"
                                   id="champs-libelle-<?= $champ->CHAMPS_ID ?>"
                                   data-pk="CHAMPS_MSG_HELP"
                                   data-type="text"
                                   data-url="<?= base_url("connaisseur/champs/update/$champ->CHAMPS_ID") ?>"> <?= $champ->CHAMPS_MSG_HELP ?>
                                </a>
                            </td>

                            <td class="center">
                                <a href="#"
                                   class="champs-name"
                                   id="champs-name-<?= $champ->CHAMPS_ID ?>"
                                   data-pk="CHAMPS_LIBELLE"
                                   data-type="text"
                                   data-url="<?= base_url("connaisseur/champs/update/$champ->CHAMPS_ID") ?>"> <?= $champ->CHAMPS_LIBELLE ?>
                                </a>
                            </td>

                            <td class="center">
                                <a
                                   class="btn btn-sm btn-primary display-form-edit"
                                   data-champ = "<?php echo htmlspecialchars(json_encode((array)$champ)) ?>"
                                   data-typechamp = "<?php echo htmlspecialchars(json_encode((array)$typeschampsjson)) ?>"
                                   data-placement = "right"
                                   data-toggle="modal"
                                   data-id="<?= $champ->CHAMPS_ID ?>"
                                   data-original-title="Modifier">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="#"
                                   data-href ="<?= base_url('connaisseur/champs/delete/'.$champ->CHAMPS_ID) ?>"
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