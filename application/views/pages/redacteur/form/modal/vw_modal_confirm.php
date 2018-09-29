<div class="modal fade" id="confirm-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-primary"><?= $this->lang->line('label_document_modal_message') ?></h4>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-lg-5 control-label"><?= $this->lang->line('label_document_modal_name') ?></label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" name="document-name" id="document-name" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  style="text-align: right; margin-top: 10px">
                        <button type="submit" class="btn btn-success" id="btn-document-valid" onclick=""><?= $this->lang->line('label_valid') ?></button>
                        &nbsp
                        <button type="button" class="btn btn-danger" id="btn-document-cancel" data-dismiss="modal"><?= $this->lang->line('label_cancel') ?></button>
                    </div>
            </div>
        </div>
    </div>
</div>