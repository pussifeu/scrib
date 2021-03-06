<?php require_once(APPPATH.'views'.SEPARATOR.'pages'.SEPARATOR.'connaisseur'.SEPARATOR.'vw_init_variable.php')  ?>
<div class="modal fade" id="create-lot">
    <div class="modal-dialog modal-md">
        <form id="create-lot-form" class="create-form" action="<?= base_url('connaisseur/lots/add') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="text-primary"><?= $this->lang->line('label_lots_creation') ?></h4>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php loadViewElement(array(
                                        'label'=>$this->lang->line('label_lots_perimeter'),
                                        'id'=>'lot-perimeter',
                                        'name'=>'lot-perimeter',
                                        'placeholder' =>'',
                                        'required' =>'required',
                                        'options' => $perimeters_array[0],
                                        'col_md_div' => 'col-md-12',
                                        'col_lg_label' => 'col-lg-4',
                                        'col_lg_element' => 'col-lg-8'
                                    ), $vwSelect); ?>

                                    <?php loadViewElement(array(
                                        'label'=>$this->lang->line('label_lots_name'),
                                        'type'=>'text', 'id'=>'lot-nom',
                                        'name'=>'lot-nom',
                                        'placeholder' =>'',
                                        'required' =>'required',
                                        'col_md_div' => 'col-md-12',
                                        'col_lg_label' => 'col-lg-4',
                                        'col_lg_element' => 'col-lg-8'
                                    ), $vwInput); ?>

                                    <?php loadViewElement(array(
                                        'label'=>$this->lang->line('label_lots_description'),
                                        'id'=>'lot-desc',
                                        'name'=>'lot-desc',
                                        'required' =>'',
                                        'col_md_div' => 'col-md-12',
                                        'col_lg_label' => 'col-lg-4',
                                        'col_lg_element' => 'col-lg-8',
                                        'rows' => 3
                                    ), $vwTextarea); ?>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?= $this->lang->line('label_cancel') ?></button>

                    <button id="btn-valid-lot" type="submit" class="btn btn-success btn-valid-form">
                        <i class="fa fa-plus-square"></i>&nbsp<?= $this->lang->line('label_add') ?>
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
