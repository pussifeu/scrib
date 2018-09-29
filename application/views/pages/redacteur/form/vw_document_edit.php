<?php include "vw_init_variable.php";?>
<div class="content-wrapper">
    <div class="container">
        <form action="<?php echo base_url('/redacteur/editDocumentAction')?>" method="post" id="create-document-form">
            <div class="panel-heading">
                <h3 class="panel-title">1 Lot concerné: [Lot Extension du RLA]</h3>
            </div>

            <input type="hidden" name="document-id" id="document-id" value="<?= $id ?>"/>
            <input type="hidden" name="document-version" id="document-version" value="<?= $version ?>"/>

            <div class="panel-group" id="accordion" style="margin-top: 20px">
                <div class="panel panel-default" id="1">
                    <fieldset>
                        <legend class="legend-use"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Responsable de l'entreprise et rôle</a></legend>
                    </fieldset>

                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="legend-use-2"><a>Coordonnées Responsable</a></legend>
                                <?php loadViewElement(array('label'=>'Prénom', 'type'=>'text', 'id'=>'1-1', 'name'=>'1-1', 'placeholder' =>'', 'required' =>'required', 'value' => get_value_by_name($datas['fields'], '1-1')), $vwInput); ?>
                                <?php loadViewElement(array('label'=>'Nom', 'type'=>'text', 'id'=>'1-2', 'name'=>'1-2','placeholder' =>'', 'required' =>'required', 'value' => get_value_by_name($datas['fields'], '1-2')), $vwInput); ?>
                                <?php loadViewElement(array('label'=>'Téléphone', 'type'=>'text', 'id'=>'1-3', 'name'=>'1-3','placeholder' =>'' , 'required' =>'required', 'value' => get_value_by_name($datas['fields'], '1-3')), $vwInputTel); ?>
                            </fieldset>

                            <fieldset class="scheduler-border"  id="1-2">
                                <legend class="legend-use-2"><a>Coordonnées Contributeur opérationnel</a></legend>
                                <?php loadViewElement(array('label'=>'Prénom', 'type'=>'text', 'id'=>'1-4', 'name'=>'1-4', 'placeholder' =>'' , 'required' =>'','value' => get_value_by_name($datas['fields'], '1-4')), $vwInput); ?>
                                <?php loadViewElement(array('label'=>'Nom', 'type'=>'text', 'id'=>'1-5', 'name'=>'1-5','placeholder' =>'' , 'required' =>'','value' => get_value_by_name($datas['fields'], '1-5')), $vwInput); ?>
                                <?php loadViewElement(array('label'=>'Téléphone', 'type'=>'text', 'id'=>'1-6', 'name'=>'1-6','placeholder' =>'', 'required' =>'','value' => get_value_by_name($datas['fields'], '1-6')), $vwInputTel); ?>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" id="2">
                    <fieldset>
                        <legend class="legend-use"><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Reporting hebdomadaire</a></legend>
                    </fieldset>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="legend-use-2"><a>Quand souhaitez-vous obtenir le reporting hebdomadaire ?</a></legend>
                                <?php loadViewElement(array(
                                    'label'=>'Quel jour ?',
                                    'id'=>'2-1',
                                    'name'=>'2-1',
                                    'placeholder' =>'',
                                    'required' =>'required',
                                    'options' =>array(
                                        '1'=>'Selectionnez le jour',
                                        '2'=>'Lundi',
                                        '3'=>'Mardi',
                                        '4'=>'Mercredi',
                                        '5'=>'Jeudi',
                                        '6'=>'Vendredi'
                                    ),
                                    'value' => get_value_by_name($datas['fields'], '2-1')
                                ), $vwSelect); ?>

                                <?php loadViewElement(array(
                                    'label'=>'Quel heure ?',
                                    'id'=>'2-2',
                                    'name'=>'2-2',
                                    'placeholder' =>'',
                                    'required' =>'required',
                                    'options' =>array(
                                        '1'=>'Selectionnez l\'heure',
                                        '2'=>'9h',
                                        '3'=>'10h',
                                        '4'=>'11h',
                                        '5'=>'12h',
                                        '6'=>'14h',
                                        '7'=>'15h',
                                        '8'=>'16h'
                                    ),
                                    'value' => get_value_by_name($datas['fields'], '2-2')
                                ), $vwSelect); ?>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" id="3">
                    <fieldset>
                        <legend class="legend-use"><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Perimètre géographique</a></legend>
                    </fieldset>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="legend-use-2"><a>Veuillez compléter le champ ci-dessous</a></legend>
                                <?php loadViewElement(array(
                                    'label'=>'Site cible au format Scope GP', 'type'=>'text', 'id'=>'3-1', 'name'=>'3-1', 'placeholder' =>'',
                                    'required' =>'required',
                                    'col_lg_label' => 'col-lg-6', 'col_lg_element' => 'col-lg-6',
                                    'value' => get_value_by_name($datas['fields'], '3-1')
                                ), $vwInput); ?>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" id="4">
                    <fieldset>
                        <legend class="legend-use"><a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Type d'architecture</a></legend>
                    </fieldset>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="legend-use-2"><a>Veuillez sélectionner le type d'architecture ci-dessous</a></legend>
                                <?php loadViewElement(array(
                                    'label'=>'Type d\'architecture bureautique',
                                    'id'=>'4-1',
                                    'name'=>'4-1',
                                    'placeholder' =>'',
                                    'required' =>'',
                                    'options' =>array(
                                        '1'=>'Selectionnez le type d\'architecture bureautique',
                                        '2'=>'GUOD',
                                        '3'=>'MUOD',
                                        '4'=>'LUOD'
                                    ),
                                    'value' => get_value_by_name($datas['fields'], '4-1')
                                ), $vwSelect); ?>
                                <?php loadViewElement(array(
                                    'label'=>'Type d\'architecture bureautique',
                                    'id'=>'4-2',
                                    'name'=>'4-2',
                                    'placeholder' =>'',
                                    'required' =>'',
                                    'options' =>array(
                                        '1'=>'Selectionnez le type d\'architecture téléphonique',
                                        '2'=>'TOIP',
                                        '3'=>'Classique',
                                        '4'=>'IPBX'
                                    ),
                                    'value' => get_value_by_name($datas['fields'], '4-2')
                                ), $vwSelect); ?>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="document-state" id="document-state" value="">
            <input type="hidden" name="document-directory" id="document-directory" value="<?= $dirReferences ?>">
            <input type="hidden" name="document-type" id="document-type" value="<?= $docType ?>">
            <?php if(sizeof($perimeters) > 0):  ?>
                <?php foreach($perimeters as $key=>$p) :?>
                    <input type="hidden" name="document-perimeters[]" id="document-perimeters['<?= $key ?>']" value="<?= $p ?>"/>
                <?php endforeach; ?>
            <?php else: ?>
                <input type="hidden" name="document-perimeters" id="document-perimeters" value=""/>
            <?php endif ?>

            <?php if(sizeof($references) > 0):  ?>
                <?php foreach($references as $key=>$d) :?>
                    <input type="hidden" name="document-references[]" id="document-references['<?= $key ?>']" value="<?= $d ?>"/>
                <?php endforeach; ?>
            <?php else: ?>
                <input type="hidden" name="document-references" id="document-references" value=""/>
            <?php endif ?>
            <?php include 'vw_button.php'?>
            <?php include "modal/vw_modal_confirm.php" ?>
            <?php include "modal/vw_modal_confirm_cancel.php" ?>
        </form>
    </div>
</div>