<?php include "vw_init_variable.php";?>
<div class="content-wrapper">
    <div class="container">
        <form action="<?php echo base_url('/redacteur/createDocumentAction')?>" method="post" id="create-document-form">
            <div class="panel-heading">
                <h3 class="panel-title">1 Lot concerné: [Lot Extension du RLA]</h3>
            </div>

            <div class="panel-group" id="accordion" style="margin-top: 20px">
                <div class="panel panel-default" id="1">
                    <fieldset>
                        <legend class="legend-use"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Responsable de l'entreprise et rôle</a></legend>
                    </fieldset>

                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <fieldset class="scheduler-border">
                                <legend class="legend-use-2"><a>Coordonnées Responsable</a></legend>
                                <?php loadViewElement(array('label'=>'Prénom', 'type'=>'text', 'id'=>'1-1', 'name'=>'1-1', 'placeholder' =>'', 'required' =>'required'), $vwInput); ?>
                                <?php loadViewElement(array('label'=>'Nom', 'type'=>'text', 'id'=>'1-2', 'name'=>'1-2','placeholder' =>'', 'required' =>'required'), $vwInput); ?>
                                <?php loadViewElement(array('label'=>'Téléphone', 'type'=>'text', 'id'=>'1-3', 'name'=>'1-3','placeholder' =>'' , 'required' =>'required'), $vwInputTel); ?>
                            </fieldset>

                            <fieldset class="scheduler-border"  id="1-2">
                                <legend class="legend-use-2"><a>Coordonnées Contributeur opérationnel</a></legend>
                                <?php loadViewElement(array('label'=>'Prénom', 'type'=>'text', 'id'=>'1-4', 'name'=>'1-4', 'placeholder' =>'' , 'required' =>''), $vwInput); ?>
                                <?php loadViewElement(array('label'=>'Nom', 'type'=>'text', 'id'=>'1-5', 'name'=>'1-5','placeholder' =>'' , 'required' =>''), $vwInput); ?>
                                <?php loadViewElement(array('label'=>'Téléphone', 'type'=>'text', 'id'=>'1-6', 'name'=>'1-6','placeholder' =>'', 'required' =>''), $vwInputTel); ?>
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
                                        '0'=>'Selectionnez le jour',
                                        '1'=>'Lundi',
                                        '2'=>'Mardi',
                                        '3'=>'Mercredi',
                                        '4'=>'Jeudi',
                                        '5'=>'Vendredi'
                                    ),
                                ), $vwSelect); ?>

                                <?php loadViewElement(array(
                                    'label'=>'Quel heure ?',
                                    'id'=>'2-2',
                                    'name'=>'2-2',
                                    'placeholder' =>'',
                                    'required' =>'required',
                                    'options' =>array(
                                        '0'=>'Selectionnez l\'heure',
                                        '1'=>'9h',
                                        '2'=>'10h',
                                        '3'=>'11h',
                                        '4'=>'12h',
                                        '5'=>'14h',
                                        '6'=>'15h',
                                        '7'=>'16h'
                                    ),
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
                                        'col_lg_label' => 'col-lg-6', 'col_lg_element' => 'col-lg-6'
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
                                        '0'=>'Selectionnez le type d\'architecture bureautique',
                                        '1'=>'GUOD',
                                        '2'=>'MUOD',
                                        '3'=>'LUOD'
                                    ),
                                ), $vwSelect); ?>
                                <?php loadViewElement(array(
                                    'label'=>'Type d\'architecture bureautique',
                                    'id'=>'4-2',
                                    'name'=>'4-2',
                                    'placeholder' =>'',
                                    'required' =>'',
                                    'options' =>array(
                                        '0'=>'Selectionnez le type d\'architecture téléphonique',
                                        '1'=>'TOIP',
                                        '2'=>'Classique',
                                        '3'=>'IPBX'
                                    ),
                                ), $vwSelect); ?>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="document-state" id="document-state" value="">
            <?php include 'vw_button.php'?>
            <?php include "modal/vw_modal_confirm.php" ?>
            <?php include "modal/vw_modal_confirm_cancel.php" ?>
        </form>
    </div>
</div>