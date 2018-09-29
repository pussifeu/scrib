<div class="modal fade" id="choice-document-ref-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-primary"><?= $this->lang->line('label_document_choice_ref')?></h4>
            </div>
            <div class="modal-body">
                <?php for ($i = 0; $i < sizeof($refDirectories); $i++):?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="page-header" ><?= utf8_encode($refDirectories[$i]); ?></h5>
                            <?php
                                $subDirectories = getDirectoryContent($pathRefDirectory.SEPARATOR.$refDirectories[$i]);
                                for($j = 0; $j < sizeof($subDirectories); $j++):
                            ?>
                                <div class="col-md-12 col-md-offset-2">
                                    <label>
                                        <input class="form-check-input" name="choice-doc-type" value="<?= utf8_encode($subDirectories[$j]).'$'.utf8_encode($refDirectories[$i]) ?>" type="radio">
                                        <?= utf8_encode($subDirectories[$j]); ?>
                                    </label>
                                    <i class="fa fa-info-circle menu-selection" data-toggle="tooltip" data-placement="right"  data-html="true" title="Tooltip on right"></i>
                                </div>
                            <?php endfor;?>
                        </div>
                    </div>
                <?php endfor;?>

                <div  style="text-align: right; margin-top: 50px">
                    <button type="button" disabled class="btn btn-success" onclick="choiceRefValidation()" data-toggle="modal" id="btn-valid-ref-button"><?= $this->lang->line('label_valid')?></button>
                    &nbsp
                    <button type="button" class="btn btn-danger" id="btn-cancel-ref-button" data-dismiss="modal"><?= $this->lang->line('label_cancel')?></button>
                </div>
            </div>
        </div>
    </div>
</div>