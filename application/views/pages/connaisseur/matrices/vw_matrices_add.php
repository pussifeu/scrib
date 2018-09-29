<?php require_once(APPPATH.'views'.SEPARATOR.'pages'.SEPARATOR.'connaisseur'.SEPARATOR.'vw_init_variable.php')  ?>
<div class="modal fade" id="create-matrices">
    <div class="modal-dialog modal-lg">
        <form id="create-matrices-form" class="create-form" action="<?= base_url('connaisseur/matrices/add') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="text-primary"><?= $this->lang->line('label_matrices_creation') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">

                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_references_creation_type'),
                                    'id'=>'MATRICES_CREATION_TYPE', 'name'=>'MATRICES_CREATION_TYPE',
                                    'onchange' => 'onchangeCreationType',
                                    'placeholder' =>'',
                                    'required' =>'required',
                                    'options' =>array(
                                        '0'=>'Selectionnez le type de création',
                                        '1'=>'Importer par des matrices existantes',
                                        '2'=>'Créer à partir d\'une matrice vide',
                                    ),
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwSelect); ?>
                            </div>

                            <div id="MATRICES_DIV_EMPTY" style="display: none">
                                <div class="col-md-12">
                                    <?php loadViewElement(array(
                                        'label'=>$this->lang->line('label_matrices_name'),
                                        'type'=>'text', 'id'=>'MATRICES_NAME', 'name'=>'MATRICES_NAME', 'placeholder' =>'',
                                        'required' =>'required',
                                        'col_md_div' => 'col-md-12',
                                        'col_lg_label' => 'col-lg-4',
                                        'col_lg_element' => 'col-lg-8'
                                    ), $vwInput); ?>
                                </div>

                                <div class="col-md-12">
                                    <?php loadViewElement(array(
                                        'label'=>$this->lang->line('label_matrices_version'),
                                        'type'=>'number', 'id'=>'MATRICES_VERSION', 'name'=>'MATRICES_VERSION', 'placeholder' =>'',
                                        'required' =>'required',
                                        'col_md_div' => 'col-md-12',
                                        'col_lg_label' => 'col-lg-4',
                                        'col_lg_element' => 'col-lg-8'
                                    ), $vwInput); ?>
                                </div>

                                <div class="col-md-12">
                                    <?php loadViewElement(array(
                                        'label'=>$this->lang->line('label_matrices_resume'),
                                        'type'=>'text', 'id'=>'MATRICES_RESUME', 'name'=>'MATRICES_RESUME', 'placeholder' =>'',
                                        'required' =>'required',
                                        'col_md_div' => 'col-md-12',
                                        'col_lg_label' => 'col-lg-4',
                                        'col_lg_element' => 'col-lg-8'
                                    ), $vwTextarea); ?>
                                </div>
                            </div>

                            <div class="col-md-12" style="display: none" id="MATRICES_DIV_DOC_REF">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_matrices_doc_ref'),
                                    'id'=>'MATRICES_DOC_REF', 'name'=>'MATRICES_DOC_REF',
                                    'file_id'=>'1',
                                    'required' =>'required',
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwInputFile); ?>
                            </div>

                            <div style="display: none" id="MATRICES_DIV_BY_DOC">
                                <div class="col-md-12">
                                    <?php loadViewElement(array(
                                        'label'=>$this->lang->line('label_matrices_ref'),
                                        'id'=>'MATRICES_INIT', 'name'=>'MATRICES_INIT',
                                        'file_id'=>'2',
                                        'required' =>'required',
                                        'col_md_div' => 'col-md-12',
                                        'col_lg_label' => 'col-lg-4',
                                        'col_lg_element' => 'col-lg-8'
                                    ), $vwInputFile); ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_references_name'),
                                    'id'=>'REFERENCE_ID', 'name'=>'REFERENCE_ID',
                                    'onchange' => 'onchangeReference',
                                    'placeholder' =>'',
                                    'required' =>'required',
                                    'options' => $references_array[0],
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwSelect); ?>
                            </div>


                            <div class="col-md-12" id="MATRICES_SS_REFERENCE_DIV" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label"><?= $this->lang->line('label_ss_references_name') ?><span class="text-danger">: *</span></label>
                                            <div class="col-lg-8 control-div">
                                                <select class="required"
                                                        onchange="onchangeFunction(this)"
                                                        id="SS_REFERENCE_ID"
                                                        name="SS_REFERENCE_ID">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?= $this->lang->line('label_cancel') ?></button>
                    <button id="btn-valid-matrices" type="submit" class="btn btn-success btn-valid-form" disabled>
                        <i class="fa fa-plus-square"></i>&nbsp<?= $this->lang->line('label_valid') ?>
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
