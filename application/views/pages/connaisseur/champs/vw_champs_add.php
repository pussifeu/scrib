<?php require_once(APPPATH.'views'.SEPARATOR.'pages'.SEPARATOR.'connaisseur'.SEPARATOR.'vw_init_variable.php')  ?>
<div class="modal fade" id="create-champs">
    <div class="modal-dialog modal-lg">
        <form id="create-champs-form" class="create-form" action="<?= base_url('connaisseur/champs/add') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="text-primary"><?= $this->lang->line('label_champs_creation') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_champs_value'),
                                    'type'=>'text', 'id'=>'CHAMPS_VAL', 'name'=>'CHAMPS_VAL', 'placeholder' =>'',
                                    'required' =>'required',
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwInput); ?>
                            </div>

                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_champs_type'),
                                    'id'=>'CHAMPS_TYPE_ID',
                                    'name'=>'CHAMPS_TYPE_ID',
                                    'placeholder' =>'',
                                    'required' =>'required',
                                    'options' => $typeschampsarray[0],
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwSelect); ?>
                            </div>

                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_champs_default_value'),
                                    'type'=>'text', 'id'=>'CHAMPS_DEFAULT_VALUE', 'name'=>'CHAMPS_DEFAULT_VALUE', 'placeholder' =>'',
                                    'required' =>'required',
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwInput); ?>
                            </div>

                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_champs_required'),
                                    'type'=>'checkbox', 'id'=>'CHAMPS_OBLIGATOIRE', 'name'=>'CHAMPS_OBLIGATOIRE', 'placeholder' =>'',
                                    'required' =>'',
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwInput); ?>
                            </div>


                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_champs_unique_name'),
                                    'type'=>'text', 'id'=>'CHAMPS_UNIQUE_NAME', 'name'=>'CHAMPS_UNIQUE_NAME', 'placeholder' =>'',
                                    'required' =>'required',
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwInput); ?>
                            </div>

                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_champs_libelle'),
                                    'type'=>'text', 'id'=>'CHAMPS_LIBELLE', 'name'=>'CHAMPS_LIBELLE', 'placeholder' =>'',
                                    'required' =>'required',
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwInput); ?>
                            </div>

                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_champs_link'),
                                    'type'=>'text', 'id'=>'CHAMPS_LIEN', 'name'=>'CHAMPS_LIEN', 'placeholder' =>'',
                                    'required' =>'required',
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwInput); ?>
                            </div>


                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_champs_suffix'),
                                    'type'=>'text', 'id'=>'CHAMPS_SUFFIXE', 'name'=>'CHAMPS_SUFFIXE', 'placeholder' =>'',
                                    'required' =>'required',
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwInput); ?>
                            </div>

                            <div class="col-md-12">
                                <?php loadViewElement(array(
                                    'label'=>$this->lang->line('label_champs_msg_help'),
                                    'type'=>'text', 'id'=>'CHAMPS_MSG_HELP', 'name'=>'CHAMPS_MSG_HELP', 'placeholder' =>'',
                                    'required' =>'',
                                    'col_md_div' => 'col-md-12',
                                    'col_lg_label' => 'col-lg-4',
                                    'col_lg_element' => 'col-lg-8'
                                ), $vwTextarea); ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?= $this->lang->line('label_cancel') ?></button>
                    <button id="btn-valid-champs" type="submit" class="btn btn-success btn-valid-form">
                        <i class="fa fa-plus-square"></i>&nbsp<?= $this->lang->line('label_valid') ?>
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
