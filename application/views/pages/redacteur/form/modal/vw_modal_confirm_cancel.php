<div class="modal fade" id="confirm-modal-cancel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-primary"><?= $this->lang->line('label_document_confirm_cancel') ?></h4>
            </div>
            <div class="modal-body">
                <input value="" type="hidden" id="document-id-cancel"/>
                <div  style="text-align: right; margin-top: 10px">
                    <button type="button" class="btn btn-success" id="btn-cancel-yes" onclick="validCancelDocument()"><?= $this->lang->line('label_yes') ?></button>
                    &nbsp
                    <button type="button" class="btn btn-danger" id="btn-cancel-no" data-dismiss="modal"><?= $this->lang->line('label_no') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>