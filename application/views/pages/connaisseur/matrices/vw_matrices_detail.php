<div id="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= $breadcrumbs ?>
                    </div>
                    <br>
                    <div class="panel-body">
                        <div class="well">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="list-unstyled">
                                        <li><strong><?= normalizeToUpper($this->lang->line('label_matrices_name')); ?> : </strong><?= $matrice->MATRICES_NAME ?></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li><strong><?= normalizeToUpper($this->lang->line('label_matrices_doc_ref')); ?> : </strong><?= $matrice->MATRICES_DOC_REF ?></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li><strong><?= normalizeToUpper($this->lang->line('label_matrices_version')); ?> : </strong><?= $matrice->MATRICES_VERSION ?></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li><strong><?= normalizeToUpper($this->lang->line('label_matrices_resume')); ?> : </strong><br><?= $matrice->MATRICES_RESUME ?></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li><strong><?= normalizeToUpper($this->lang->line('label_references_name')); ?> : </strong><?= $matrice->REFERENCE_LIBELLE ?></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li><strong><?= normalizeToUpper($this->lang->line('label_ss_references_name')); ?> : </strong><?= $matrice->SS_REFERENCE_LIBELLE ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="matrice_id"  id="matrice_id" value="<?= $matrice->MATRICES_ID ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="panel-title">Configuration de la matrice</span>
                    </div>
                    <button class="btn btn-success" id="addPageTab" style="margin-top: 10px"><i class="glyphicon glyphicon-plus"></i> Ajouter une page</button>
                    <div class="panel-body" id="form-builder-pages" style="margin-top: 10px">
                        <?php if($fileIsEmpty): ?>
                            <ul class="nav nav-tabs" id="tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#page-1">Page 1</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="page-1" class="tab-pane fade active in"></div>
                            </div>
                            <div class="save-all-wrap"><button id="save-all" type="button" class="btn btn-primary">Enregistrer</button></div>
                        <?php else : ?>
                            <ul class="nav nav-tabs" id="tabs">
                                <?php for($i = 0; $i < sizeof(json_decode(json_decode($jsonData))); $i++): ?>
                                    <li class="<?php if($i == 0) echo "active" ?>"><a data-toggle="tab" href="#page-<?php echo $i+1 ?>">Page <?= $i+1 ?></a></li>
                                <?php endfor; ?>
                            </ul>

                            <div class="tab-content">
                                <?php for($i = 0; $i < sizeof(json_decode(json_decode($jsonData))); $i++): ?>
                                    <div id="page-<?php echo $i+1 ?>" class="tab-pane fade<?php if($i == 0) echo " in active" ?>"></div>
                                <?php endfor;?>
                            </div>
                            <div class="save-all-wrap"><button id="save-all" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-save"></i>  Enregistrer</button></div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var lots =  JSON.parse(JSON.stringify(<?= json_encode($lots) ?>));
    var perimeters =  JSON.parse(JSON.stringify(<?= json_encode($perimeters) ?>));
    var JSONDATA = <?= $jsonData ?>;
</script>
<!-- Form builder -->
<script src="<?php echo base_url('assets/vendor/form_builder/js/vendor.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/form_builder/js/form-builder.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/form_builder/js/form-render.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/form_builder/js/jquery.rateyo.min.js') ?>"></script>
<script src="<?php echo base_url('assets/dist/js/fbuilder.js') ?>"></script>