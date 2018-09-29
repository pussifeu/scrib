<div class="row">
    <div class="col-lg-12" style="margin-top: 10px">
        <div class="panel panel-default" style="border-color: #ddd;">
            <div class="panel-heading">
                <span class="panel-title"><?= $this->lang->line('label_document_list'); ?></span>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary dropdown-toggle" onclick="createNewDocument()" data-toggle="modal" id="btn-create-document" aria-expanded="false" style="margin-top: 3px">
                        <?= $this->lang->line('label_document_create'); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="panel panel-default" style="margin-top: 10px">
            <div class="panel-body">
                <table width="100%" class="table table-hover dataTables-projects" id="dataTables-documents">
                    <thead>
                    <tr>
                        <th class="col-md-1"><?= $this->lang->line('label_document_number'); ?></th>
                        <th class="col-md-3"><?= $this->lang->line('label_document_name'); ?></th>
                        <th class="col-md-3"><?= $this->lang->line('label_document_new_name'); ?></th>
                        <th class="col-md-2"><?= $this->lang->line('label_document_state'); ?></th>
                        <th class="col-md-2"><?= $this->lang->line('label_document_version'); ?></th>
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($documents as $document): ?>
                        <tr>
                            <td class="center"><?= $document->DOC_NUMERO?></td>
                            <td><?= $document->DOC_NOM_ORIGINAL?></td>
                            <td><?= $document->DOC_NOM_DONNEE?></td>
                            <td class="center"><?= $document->ETAT_NOM?></td>
                            <td class="center"><?= $document->DOC_VERSION?></td>
                            <td class="center">
                                <?php if ($document->DOC_ETAT_ID != TERMINEE) : ?>
                                    <a href="<?php echo base_url('redacteur/editDocument/'.$document->DOC_ID.'/'.$document->DOC_VERSION) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="right" title="" data-original-title="Éditer">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php echo base_url('redacteur/printDocument/'.$document->DOC_ID.'/true') ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="right" title="" data-original-title="Imprimer">
                                        <i class="fa fa-print"></i>
                                    </a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>