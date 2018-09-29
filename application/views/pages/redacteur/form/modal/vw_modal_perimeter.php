<div class="modal fade" id="choice-perimeter-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-primary">Lots disponibles</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('/redacteur/addDocument')?>" method="post">
                    <input type="hidden" name="value-doc-ref-selected" id="value-doc-ref-selected"/>
                    <?php
                        $perimetersFirst = $perimeters[0];
                        $perimetersNoFirst = $perimeters;
                        unset($perimetersNoFirst[0]);
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="page-header" style="color: #337ab7;"><?= $perimetersFirst->PER_LIBELLE ?></h5>
                            <?php foreach (getLotsByPerimeter($perimetersFirst->PER_ID) as $lot): ?>
                                <div class="col-md-12 col-md-offset-2">
                                    <label>
                                        <span style="color: red; margin-left: -8px">!</span>
                                        <input class="form-check-input"
                                               id="perimeter-etude"
                                               name="choice-per-type[]"
                                               value="<?= $lot->LOT_ID ?>"
                                               type="checkbox"
                                               onchange="choiceLotAndPerimeter(this); disableAllLots(this)">
                                        <?= $lot->LOT_LIBELLE?>
                                    </label>
                                    <?php if(isset($lot->LOT_DESCRIPTION) && !empty($lot->LOT_DESCRIPTION)) : ?>
                                        <i class="fa fa-info-circle menu-selection" data-toggle="tooltip" data-placement="right" data-html="true" title="<?= $lot->LOT_DESCRIPTION ?>"></i>
                                    <?php endif;?>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="other-checkbox">
                        <?php foreach ($perimetersNoFirst as $perimeter) : ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="page-header" style="color: #337ab7;"><?= $perimeter->PER_LIBELLE ?></h5>
                                    <?php foreach (getLotsByPerimeter($perimeter->PER_ID) as $lot): ?>
                                        <div class="col-md-12 col-md-offset-2">
                                            <label>
                                                <input class="form-check-input"
                                                       id="perimeter-etude"
                                                       name="choice-per-type[]"
                                                       value="<?= $lot->LOT_ID ?>"
                                                       type="checkbox"
                                                       onchange="choiceLotAndPerimeter(this); disableOneLot(this)">
                                                <?= $lot->LOT_LIBELLE?>
                                            </label>
                                            <?php if(isset($lot->LOT_DESCRIPTION) && !empty($lot->LOT_DESCRIPTION)) : ?>
                                                <i class="fa fa-info-circle menu-selection" data-toggle="tooltip" data-placement="right" data-html="true" title="<?= $lot->LOT_DESCRIPTION ?>"></i>
                                            <?php endif;?>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div  style="text-align: right; margin-top: 50px">
                        <button type="submit" disabled class="btn btn-success" id="btn-valid-per-button" name="btn-valid-per-button" value="submit">Valider</button>
                        &nbsp
                        <button type="button" class="btn btn-danger" id="btn-cancel-per-button" data-dismiss="modal">Annuler</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
