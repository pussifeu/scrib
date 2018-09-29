<div class="row" style="margin-bottom:20px;">
    <div class="col-md-4">
        <button type="submit"
                id="btn-document-save"
                class="btn btn-sm btn-primary"
                data-toggle="modal"
                onclick="generateOrSaveDocument(ENCOURS)"
                name="submit" value="save">
            <i class="fa fa-save"></i>
            &nbsp;<?= $this->lang->line('label_document_save')?>
        </button>
    </div>
    <div class="col-md-4 text-center">
        <button type="button"
                id="btn-document-cancel"
                class="btn btn-sm btn-danger"
                onclick="cancelDocument('<?php echo $id ?>')"
                name="submit" value="save">
            <i class="fa fa-close"></i>
            &nbsp;<?= $this->lang->line('label_document_cancel')?>
        </button>
    </div>
    <div class="col-md-4 text-right">
        <button type="button"
                id="btn-document-generate"
                class="btn btn-sm btn-success"
                data-toggle="modal"
                onclick="generateOrSaveDocument(TERMINEE)"
                name="submit" value="save">
            <i class="fa fa-check-square-o"></i>
            &nbsp;<?= $this->lang->line('label_document_generate')?>
        </button>
    </div>
</div>