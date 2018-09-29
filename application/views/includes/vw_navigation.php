<!-- HEADER END-->
<div class="container">
    <header>
        <div class="row">
            <div class="col-md-3 col-sm-2">
                <div class="logo" style="float: left">
                    <img src="<?php echo base_url('assets/img/edf_header_logo.png') ?>" alt="Logo EDF"/>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <h4 class="text-center text-primary title">
                    <img src="<?php echo base_url('assets/img/scrib_logo.png') ?>" alt="Logo PRESTO" width="60px"/>
                    <br/><?= $this->lang->line('label_header_tittle'); ?><br/>
                </h4>
                <h5 class="text-center text-primary title">
                    <?= $this->lang->line('label_scrib'); ?>
                </h5>
            </div>
            <div class="col-md-3 col-sm-4">
                <div style="font-size: 13px; line-height: 14px; text-align: right;">
                    <b><?php echo $this->session->userdata('cn');?></b>
                </div>

                <div class="list">
                    <p class="text-right">
                    <div style="font-size: 13px; line-height: 14px; text-align: right;">
                        <?php
                            $user = $this->session->userdata('USER');
                            if(isset($user) && !empty($user)):?>
                                <i class="text-success"> <?= $this->lang->line('label_connected'); ?></i>
                            <?php else:?>
                                <i class="text-danger"> <?= $this->lang->line('label_not_connected'); ?></i>
                            <?php endif;?>
                    </div>
                    </p>
                    <p class="text-right">
                    <div style="font-size: 12px; line-height: 13px; text-align: right;">
                        <i>Lecteur</i>
                    </div>
                    </p>
                </div>

                <div class="pull-right" style="margin-top:5px">
                    <a href="<?= base_url('login/logout') ?>" class="btn btn-xs btn-danger">
                        <?= $this->lang->line('label_logout'); ?>&nbsp; <i class="fa fa-power-off"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
</div>
<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <nav class="navbar-collapse" role="navigation">
            <!-- Navigation links starts here -->
            <ul class="nav navbar-nav nav-override" style="display: inline-block;float: none;">
                <li>
                    <a href="<?php echo base_url('redacteur') ?>" class="menu-top-active"><i class="fa fa fa-file-text-o fa-fw"></i> <?= $this->lang->line('label_header_redactor'); ?>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle orange" data-toggle="dropdown">
                        <i class="fa fa-user fa-fw"></i> <?= $this->lang->line('label_header_expert'); ?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url('connaisseur/perimeters') ?>">
                                <i class="fa fa-cubes"></i>&nbsp; <?= $this->lang->line('label_header_manage_perimeters') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('connaisseur/lots') ?>">
                                <i class="fa fa-tasks"></i>&nbsp; <?= $this->lang->line('label_header_manage_lots') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('connaisseur/references') ?>">
                                <i class="fa fa-industry"></i>&nbsp; <?= $this->lang->line('label_header_manage_references') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('connaisseur/sousReferences') ?>">
                                <i class="fa fa-bank"></i>&nbsp; <?= $this->lang->line('label_header_manage_ss_references') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('connaisseur/matrices') ?>">
                                <i class="fa fa-file-o"></i>&nbsp; <?= $this->lang->line('label_header_manage_matrices') ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url('admnistrateur') ?>"><i class="fa fa-cog fa-fw"></i> <?= $this->lang->line('label_header_admin'); ?></a>
                </li>
            </ul>
        </nav
    </div>
</div>
<!-- LOGO HEADER END-->

