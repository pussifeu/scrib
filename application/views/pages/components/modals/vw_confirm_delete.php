<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <?= $this->lang->line('label_confirm_delete')?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= $this->lang->line('label_no')?></button>
                <a class="btn btn-sm btn-danger btn-ok"><?= $this->lang->line('label_yes')?></a>
            </div>
        </div>
    </div>
</div>